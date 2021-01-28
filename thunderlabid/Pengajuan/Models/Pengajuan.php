<?php

namespace Thunderlabid\Pengajuan\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;
use Validator, DB;

///////////////
// Exception //
///////////////
use Thunderlabid\Pengajuan\Exceptions\AppException;

////////////
// EVENTS //
////////////
use Thunderlabid\Pengajuan\Events\Pengajuan\PengajuanCreating;
use Thunderlabid\Pengajuan\Events\Pengajuan\PengajuanCreated;
use Thunderlabid\Pengajuan\Events\Pengajuan\PengajuanUpdating;
use Thunderlabid\Pengajuan\Events\Pengajuan\PengajuanUpdated;
use Thunderlabid\Pengajuan\Events\Pengajuan\PengajuanDeleting;
use Thunderlabid\Pengajuan\Events\Pengajuan\PengajuanDeleted;

////////////
// TRAITS //
////////////
use Thunderlabid\Pengajuan\Traits\IDRTrait;
use Thunderlabid\Pengajuan\Traits\TanggalTrait;
use Thunderlabid\Pengajuan\Traits\WaktuTrait;
use Thunderlabid\Pengajuan\Traits\NIKTrait;

class Pengajuan extends Model
{
	use SoftDeletes;

	use NIKTrait;
	use IDRTrait;
	use TanggalTrait;
	use WaktuTrait;

	protected $table	= 'p_pengajuan';
	protected $fillable	= ['pokok_pinjaman', 'kemampuan_angsur', 'is_mobile', 'nasabah', 'dokumen_pelengkap', 'kode_kantor', 'ao'];
	protected $hidden	= [];
	protected $dates	= [];

	protected $rules	= [];
	protected $errors;
	protected $latest_analysis;
	protected $appends 	= ['tanggal', 'is_complete'];

	protected $keyType  	= 'string';
    public $incrementing 	= false;
    
	protected $events 	= [
		'creating' 	=> PengajuanCreating::class,
		'created' 	=> PengajuanCreated::class,
		'updating' 	=> PengajuanUpdating::class,
		'updated' 	=> PengajuanUpdated::class,
		'deleting' 	=> PengajuanDeleting::class,
		'deleted' 	=> PengajuanDeleted::class,
	];
	
	// ------------------------------------------------------------------------------------------------------------
	// CONSTRUCT
	// ------------------------------------------------------------------------------------------------------------

	// ------------------------------------------------------------------------------------------------------------
	// BOOT
	// -----------------------------------------------------------------------------------------------------------
	
	// ------------------------------------------------------------------------------------------------------------
	// RELATION
	// ------------------------------------------------------------------------------------------------------------
	public function status_terakhir()
	{
		return $this->hasOne(Status::class, 'pengajuan_id')->orderby('tanggal', 'desc');
	}

	public function status_permohonan()
	{
		return $this->hasOne(Status::class, 'pengajuan_id')->where('status', 'permohonan')->orderby('tanggal', 'asc');
	}

	public function jaminan()
	{
		return $this->hasMany(Jaminan::class, 'pengajuan_id');
	}

	public function jaminan_kendaraan()
	{
		return $this->hasMany(Jaminan::class, 'pengajuan_id')->where('jenis', 'bpkb');
	}

	public function jaminan_tanah_bangunan()
	{
		return $this->hasMany(Jaminan::class, 'pengajuan_id')->whereIn('jenis', ['shm', 'shgb'])->orderby('jenis', 'asc');
	}

	public function riwayat_status()
	{
		return $this->hasMany(Status::class, 'pengajuan_id');
	}

	public function analisa()
	{
		return $this->hasOne(Analisa::class, 'pengajuan_id');
	}

	public function putusan()
	{
		return $this->hasOne(Putusan::class, 'pengajuan_id');
	}

	// ------------------------------------------------------------------------------------------------------------
	// FUNCTION
	// ------------------------------------------------------------------------------------------------------------

	// ------------------------------------------------------------------------------------------------------------
	// SCOPE
	// ------------------------------------------------------------------------------------------------------------
	public function setAoAttribute($variable)
	{
		$this->attributes['ao']		= json_encode($variable);
	}

	public function scopeKantor($query, $variable)
	{
		if(is_array($variable))
		{
			return $query->whereIn('kode_kantor', $variable);
		}

		return $query->where('kode_kantor', $variable);
	}

	public function scopeStatus($query, $variable)
	{
		$query 	= $query->select('p_pengajuan.*');

		// return $query->whereHas('status_terakhir', function($q)use($variable){$q->status($variable);});
		if(!is_array($variable))
		{
			return $query
			 ->join('p_status', function ($join) use($variable) 
			 {
									$join->on ( 'p_status.pengajuan_id', '=', 'p_pengajuan.id' )
									->where('p_status.status', '=', $variable)
									->wherenull('p_status.deleted_at')
									;
			})
			 ->leftJoin(DB::raw('p_status as p_status_now'), function ($join) use($variable) 
			 {
									$join->on ( 'p_status_now.pengajuan_id', '=', 'p_pengajuan.id' )
									->on ( 'p_status.tanggal', '<', 'p_status_now.tanggal' )
									->wherenull('p_status_now.deleted_at')
									;
			})->wherenull('p_status_now.tanggal')->groupby('p_pengajuan.id');
		}

		return $query
		 ->join('p_status', function ($join) use($variable) 
		 {
								$join->on ( 'p_status.pengajuan_id', '=', 'p_pengajuan.id' )
								->whereIn('p_status.status', $variable)
								->wherenull('p_status.deleted_at')
								;
		})
		 ->leftJoin(DB::raw('p_status as p_status_now'), function ($join) use($variable) 
		 {
								$join->on ( 'p_status_now.pengajuan_id', '=', 'p_pengajuan.id' )
								->on ( 'p_status.tanggal', '<', 'p_status_now.tanggal' )
								->wherenull('p_status_now.deleted_at')
								;
		})->wherenull('p_status_now.tanggal')->groupby('p_pengajuan.id');
	}

	// ------------------------------------------------------------------------------------------------------------
	// MUTATOR
	// ------------------------------------------------------------------------------------------------------------
	public function setKemampuanAngsurAttribute($variable)
	{
		$this->attributes['kemampuan_angsur']	= $this->formatMoneyFrom($variable);
	}

	public function setPokokPinjamanAttribute($variable)
	{
		$this->attributes['pokok_pinjaman']	= $this->formatMoneyFrom($variable);
	}

	public function setNasabahAttribute($variable)
	{
		//NIK
		if(isset($variable['nik']))
		{
			$variable['nik']			= $this->formatNikFrom($variable['nik']);
		}

		//TANGGAL LAHIR
		if(isset($variable['tanggal_lahir']))
		{
			$variable['tanggal_lahir']	= $this->formatDateFrom($variable['tanggal_lahir']);
		}

		//PENGHASILAN BERSIH
		if(isset($variable['penghasilan_bersih']))
		{
			$variable['penghasilan_bersih']	= $this->formatMoneyFrom($variable['penghasilan_bersih']);
		}

		$this->attributes['nasabah']		= json_encode($variable);
	}

	public function setDokumenPelengkapAttribute($variable)
	{
		$this->attributes['dokumen_pelengkap']	= json_encode($variable);
	}

	// ------------------------------------------------------------------------------------------------------------
	// ACCESSOR
	// ------------------------------------------------------------------------------------------------------------
	public function getIsDeletableAttribute()
	{
		return true;
	}

	public function getIsSavableAttribute()
	{
		//////////////////
		// Create Rules //
		//////////////////
		$rules['pokok_pinjaman']				= ['required', 'numeric', 'min:2500000'];
		$rules['kemampuan_angsur']				= ['required', 'numeric'];
		$rules['is_mobile']						= ['boolean'];
		$rules['dokumen_pelengkap.ktp']			= ['url'];
		// $rules['dokumen_pelengkap.ktp']			= ['required', 'url'];
		// $rules['dokumen_pelengkap.kk']			= ['required_with:nasabah.keluarga', 'url'];
		$rules['dokumen_pelengkap.kk']			= ['url'];
		$rules['kode_kantor']					= ['required_if:is_mobile,false'];

		$rules['nasabah.nik']					= ['required_if:is_mobile,false', 'max:255'];
		$rules['nasabah.nama']					= ['required_with:nasabah.nik', 'max:255'];
		$rules['nasabah.tanggal_lahir']			= ['required_with:nasabah.nik', 'date_format:"Y-m-d"', 'before:'.date('Y-m-d', strtotime('- 17 years'))];
		$rules['nasabah.tempat_lahir']			= ['required_with:nasabah.nik', 'max:255'];
		$rules['nasabah.jenis_kelamin']			= ['required_with:nasabah.nik', 'in:laki-laki,perempuan'];
		$rules['nasabah.status_perkawinan']		= ['required_with:nasabah.nik', 'in:belum_kawin,kawin,cerai,cerai_mati'];
		$rules['nasabah.pekerjaan']				= ['required_with:nasabah.nik', 'max:255'];
		$rules['nasabah.penghasilan_bersih']	= ['required_with:nasabah.nik', 'numeric'];
		$rules['nasabah.telepon']				= ['required_with:nasabah.nik', 'max:40'];
		// $rules['nasabah.telepon']				= ['required', 'max:40'];
		$rules['nasabah.nomor_whatsapp']		= ['max:255'];
		$rules['nasabah.email']					= ['max:40'];
		$rules['nasabah.alamat.alamat']			= ['required_with:nasabah.nik'];
		$rules['nasabah.alamat.rt']				= ['required_with:nasabah.nik'];
		$rules['nasabah.alamat.rw']				= ['required_with:nasabah.nik'];
		$rules['nasabah.alamat.kelurahan']		= ['required_with:nasabah.nik'];
		$rules['nasabah.alamat.kecamatan']		= ['required_with:nasabah.nik'];
		$rules['nasabah.alamat.kota']			= ['required_with:nasabah.nik'];
		
		$rules['nasabah.keluarga.*.hubungan']	= ['in:orang_tua,anak,suami,istri,saudara'];
		$rules['nasabah.keluarga.*.nik']		= ['required_with:nasabah.keluarga.*.hubungan'];
		$rules['nasabah.keluarga.*.nama']		= ['required_with:nasabah.keluarga.*.hubungan'];
		$rules['nasabah.keluarga.*.telepon']	= ['required_with:nasabah.keluarga.*.hubungan'];

		$data 						= $this->attributes;
		$data['nasabah'] 			= json_decode($data['nasabah'], true);
		$data['dokumen_pelengkap'] 	= json_decode($data['dokumen_pelengkap'], true);

		//////////////
		// Validate //
		//////////////
		$validator = Validator::make($data, $rules);
		if ($validator->fails())
		{
			$this->errors = $validator->messages();
			return false;
		}
		else
		{
			$this->errors = null;
			return true;
		}
	}

	public function getKemampuanAngsurAttribute($variable)
	{
		return $this->formatMoneyTo($this->attributes['kemampuan_angsur']);
	}

	public function getPokokPinjamanAttribute($variable)
	{
		return $this->formatMoneyTo($this->attributes['pokok_pinjaman']);
	}

	public function getTanggalAttribute($variable)
	{
		return $this->formatDateTimeTo($this->attributes['created_at']);
	}

	public function getNasabahAttribute($variable)
	{
		$variable 							= json_decode($this->attributes['nasabah'], true);

		//NIK
		if(isset($variable['nik']))
		{
			$variable['nik']				= $this->formatNikTo($variable['nik']);
		}

		//TANGGAL LAHIR
		if(isset($variable['tanggal_lahir']))
		{
			$variable['tanggal_lahir']		= $this->formatDateTo($variable['tanggal_lahir']);
		}

		//PENGHASILAN BERSIH
		if(isset($variable['penghasilan_bersih']))
		{
			$variable['penghasilan_bersih']	= $this->formatMoneyTo($variable['penghasilan_bersih']);
		}

		return $variable;
	}

	public function getAoAttribute($variable)
	{
		return json_decode($this->attributes['ao'], true);
	}

	public function getDokumenPelengkapAttribute($variable)
	{
		return json_decode($this->attributes['dokumen_pelengkap'], true);
	}

	public function getIsCompleteAttribute($variable)
	{
		if(!count($this->jaminan_kendaraan) && !count($this->jaminan_tanah_bangunan))
		{
			return false;
		}

		if(!count($this->nasabah['keluarga']))
		{
			return false;
		}

		if(is_null($this->nasabah['nik']))
		{
			return false;
		}

		return true;
	}

	public function getErrorsAttribute()
	{
		return $this->errors;
	}
}
