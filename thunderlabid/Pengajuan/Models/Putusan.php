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
use Thunderlabid\Pengajuan\Events\Putusan\PutusanCreating;
use Thunderlabid\Pengajuan\Events\Putusan\PutusanCreated;
use Thunderlabid\Pengajuan\Events\Putusan\PutusanUpdating;
use Thunderlabid\Pengajuan\Events\Putusan\PutusanUpdated;
// use Thunderlabid\Pengajuan\Events\Putusan\PutusanDeleting;
// use Thunderlabid\Pengajuan\Events\Putusan\PutusanDeleted;

use Thunderlabid\Pengajuan\Traits\WaktuTrait;
use Thunderlabid\Pengajuan\Traits\IDRTrait;

class Putusan extends Model
{
	use SoftDeletes;
	use WaktuTrait;
	use IDRTrait;

	protected $table	= 'p_putusan';
	protected $fillable	= ['pengajuan_id', 'pembuat_keputusan', 'tanggal', 'is_baru', 'plafon_pinjaman', 'suku_bunga', 'jangka_waktu', 'perc_provisi', 'provisi', 'administrasi', 'legal', 'checklists', 'putusan', 'catatan'];
	protected $hidden	= [];
	protected $dates	= [];

	protected $rules	= [];
	protected $errors;
	protected $latest_analysis;

	protected $events 	= [
		'creating' 	=> PutusanCreating::class,
		'created' 	=> PutusanCreated::class,
		'updating' 	=> PutusanUpdating::class,
		'updated' 	=> PutusanUpdated::class,
		// 'deleted' 	=> PutusanDeleted::class,
		// 'deleting' 	=> PutusanDeleting::class,
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
	public function pengajuan()
	{
		return $this->belongsTo(Pengajuan::class, 'pengajuan_id');
	}

	// ------------------------------------------------------------------------------------------------------------
	// FUNCTION
	// ------------------------------------------------------------------------------------------------------------

	// ------------------------------------------------------------------------------------------------------------
	// SCOPE
	// ------------------------------------------------------------------------------------------------------------

	// ------------------------------------------------------------------------------------------------------------
	// MUTATOR
	// ------------------------------------------------------------------------------------------------------------
	public function setTanggalAttribute($variable)
	{
		$this->attributes['tanggal']  			= $this->formatDateTimeFrom($variable);
	}
	
	public function setPembuatKeputusanAttribute($variable)
	{
		$this->attributes['pembuat_keputusan']	= json_encode($variable);
	}

	public function setPlafonPinjamanAttribute($variable)
	{
		$this->attributes['plafon_pinjaman']	= $this->formatMoneyFrom($variable);
	}

	public function setProvisiAttribute($variable)
	{
		$this->attributes['provisi']			= $this->formatMoneyFrom($variable);
	}

	public function setAdministrasiAttribute($variable)
	{
		$this->attributes['administrasi']		= $this->formatMoneyFrom($variable);
	}

	public function setLegalAttribute($variable)
	{
		$this->attributes['legal']				= $this->formatMoneyFrom($variable);
	}
	
	public function setChecklistsAttribute($variable)
	{
		$this->attributes['checklists']			= json_encode($variable);
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
		$rules['tanggal']			= ['required', 'date_format:"Y-m-d H:i:s"'];
		$rules['pembuat_keputusan']['nip']		= ['required'];
		$rules['pembuat_keputusan']['nama']		= ['required'];
		$rules['pengajuan_id']		= ['required', 'exists:p_pengajuan,id'];
		$rules['is_baru']			= ['boolean'];
		$rules['plafon_pinjaman']	= ['required', 'numeric'];
		$rules['suku_bunga']		= ['required', 'numeric'];
		$rules['jangka_waktu']		= ['required', 'numeric'];
		$rules['perc_provisi']		= ['required', 'numeric'];
		$rules['provisi']			= ['required', 'numeric'];
		$rules['administrasi']		= ['required', 'numeric'];
		$rules['legal']				= ['required', 'numeric'];
		$rules['putusan']			= ['required', 'in:setuju,tolak'];

		$rules['checklists.objek.fotokopi_ktp_pemohon']		= ['in:ada,tidak_ada,cadangkan'];
		$rules['checklists.objek.fotokopi_ktp_keluarga']	= ['in:ada,tidak_ada,cadangkan'];
		$rules['checklists.objek.fotokopi_kk']				= ['in:ada,tidak_ada,cadangkan'];
		$rules['checklists.objek.fotokopi_akta_nikah_cerai_pisah_harta']	= ['in:ada,tidak_ada,cadangkan'];
		$rules['checklists.objek.fotokopi_npwp_siup']			= ['in:ada,tidak_ada,cadangkan'];
		$rules['checklists.objek.bpkb_asli_dan_fotokopi']		= ['in:ada,tidak_ada,cadangkan'];
		$rules['checklists.objek.fotokopi_faktur_dan_stnk']		= ['in:ada,tidak_ada,cadangkan'];
		$rules['checklists.objek.kwitansi_jual_beli_kosongan']	= ['in:ada,tidak_ada,cadangkan'];
		$rules['checklists.objek.kwitansi_ktp_sesuai_bpkb']		= ['in:ada,tidak_ada,cadangkan'];
		$rules['checklists.objek.asuransi_kendaraan']			= ['in:ada,tidak_ada,cadangkan'];
		$rules['checklists.objek.sertifikat_asli_dan_fotokopi']	= ['in:ada,tidak_ada,cadangkan'];
		$rules['checklists.objek.ajb']			= ['in:ada,tidak_ada,cadangkan'];
		$rules['checklists.objek.imb']			= ['in:ada,tidak_ada,cadangkan'];
		$rules['checklists.objek.pbb_terakhir']	= ['in:ada,tidak_ada,cadangkan'];
		$rules['checklists.objek.check_fisik']	= ['in:ada,tidak_ada,cadangkan'];
		$rules['checklists.objek.foto_jaminan']	= ['in:ada,tidak_ada,cadangkan'];

		$rules['checklists.pengikat.permohonan_kredit']		= ['in:ada,tidak_ada,cadangkan'];
		$rules['checklists.pengikat.survei_report']			= ['in:ada,tidak_ada,cadangkan'];
		$rules['checklists.pengikat.persetujuan_komite']	= ['in:ada,tidak_ada,cadangkan'];
		$rules['checklists.pengikat.perjanjian_kredit']		= ['in:ada,tidak_ada,cadangkan'];
		$rules['checklists.pengikat.pengakuan_hutang']		= ['in:ada,tidak_ada,cadangkan'];
		$rules['checklists.pengikat.pernyataan_analis']		= ['in:ada,tidak_ada,cadangkan'];
		$rules['checklists.pengikat.penggantian_jaminan']	= ['in:ada,tidak_ada,cadangkan'];
		$rules['checklists.pengikat.skmht_apht']			= ['in:ada,tidak_ada,cadangkan'];
		$rules['checklists.pengikat.feo']					= ['in:ada,tidak_ada,cadangkan'];
		$rules['checklists.pengikat.surat_persetujuan_keluarga']	= ['in:ada,tidak_ada,cadangkan'];
		$rules['checklists.pengikat.surat_persetujuan_plang']		= ['in:ada,tidak_ada,cadangkan'];
		$rules['checklists.pengikat.pernyataan_belum_balik_nama']	= ['in:ada,tidak_ada,cadangkan'];
		$rules['checklists.pengikat.kuasa_pembebanan_feo']			= ['in:ada,tidak_ada,cadangkan'];
		$rules['checklists.pengikat.kuasa_menjual_dan_menarik_jaminan']		= ['in:ada,tidak_ada,cadangkan'];

		//////////////
		// Validate //
		//////////////
		$data 						= $this->attributes;
		$data['pembuat_keputusan'] 	= json_decode($data['pembuat_keputusan'], true);
		$data['checklists'] 		= json_decode($data['checklists'], true);

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

	public function getTanggalAttribute($variable)
	{
		return $this->formatDateTimeTo($this->attributes['tanggal']);
	}

	public function getPembuatKeputusanAttribute($variable)
	{
		return json_decode($this->attributes['pembuat_keputusan'], true);
	}

	public function getChecklistsAttribute($variable)
	{
		return json_decode($this->attributes['checklists'], true);
	}

	public function getPlafonPinjamanAttribute($variable)
	{
		return $this->formatMoneyTo($this->attributes['plafon_pinjaman']);
	}

	public function getProvisiAttribute($variable)
	{
		return $this->formatMoneyTo($this->attributes['provisi']);
	}

	public function getAdministrasiAttribute($variable)
	{
		return $this->formatMoneyTo($this->attributes['administrasi']);
	}

	public function getLegalAttribute($variable)
	{
		return $this->formatMoneyTo($this->attributes['legal']);
	}

	public function getErrorsAttribute()
	{
		return $this->errors;
	}

	public static function rule_of_valid()
	{
		$rules['tanggal']			= ['required'];
		$rules['plafon_pinjaman']	= ['required'];
		$rules['suku_bunga']		= ['required'];
		$rules['jangka_waktu']		= ['required'];
		$rules['perc_provisi']		= ['required'];
		$rules['provisi']			= ['required'];
		$rules['administrasi']		= ['required'];
		$rules['legal']				= ['required'];
		$rules['putusan']			= ['required'];

		return $rules;
	}
}
