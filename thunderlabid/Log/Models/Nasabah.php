<?php

namespace Thunderlabid\Log\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;
use Validator;

///////////////
// Exception //
///////////////
use Thunderlabid\Log\Exceptions\AppException;

////////////
// EVENTS //
////////////
use Thunderlabid\Log\Events\Nasabah\NasabahCreating;
// use Thunderlabid\Log\Events\Nasabah\NasabahCreated;
use Thunderlabid\Log\Events\Nasabah\NasabahUpdating;
// use Thunderlabid\Log\Events\Nasabah\NasabahUpdated;
// use Thunderlabid\Log\Events\Nasabah\NasabahDeleting;
// use Thunderlabid\Log\Events\Nasabah\NasabahDeleted;

use Thunderlabid\Log\Traits\IDRTrait;
use Thunderlabid\Log\Traits\TanggalTrait;

class Nasabah extends Model
{
	use SoftDeletes;
	use TanggalTrait;
	use IDRTrait;

	protected $table	= 'l_nasabah';
	protected $fillable	= ['parent_id', 'nik', 'nama', 'tanggal_lahir', 'tempat_lahir', 'jenis_kelamin', 'telepon', 'nomor_whatsapp', 'email', 'status_perkawinan', 'pekerjaan', 'penghasilan_bersih', 'alamat', 'keluarga'];

	protected $hidden	= [];
	protected $dates	= [];
	protected $rules	= [];
	protected $errors;
	protected $latest_analysis;

	protected $events 		= [
		'creating' 	=> NasabahCreating::class,
		'updating' 	=> NasabahUpdating::class,
		// 'deleted' 	=> NasabahDeleted::class,
		// 'deleting' 	=> NasabahDeleting::class,
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
	// public function log()
	// {
	// 	return $this->hasMany(NasabahLog::class, 'nasabah_id');
	// }
	
	// ------------------------------------------------------------------------------------------------------------
	// FUNCTION
	// ------------------------------------------------------------------------------------------------------------

	// ------------------------------------------------------------------------------------------------------------
	// SCOPE
	// ------------------------------------------------------------------------------------------------------------

	// ------------------------------------------------------------------------------------------------------------
	// MUTATOR
	// ------------------------------------------------------------------------------------------------------------
	public function setTanggalLahirAttribute($variable)
	{
		$this->attributes['tanggal_lahir']	= $this->formatDateFrom($variable);
	}

	public function setKeluargaAttribute($variable)
	{
		$this->attributes['keluarga']		= json_encode($variable);
	}

	public function setAlamatAttribute($variable)
	{
		$this->attributes['alamat']			= json_encode($variable);
	}

	public function setPenghasilanBersihAttribute($variable)
	{
		$this->attributes['penghasilan_bersih']		= $this->formatMoneyFrom($variable);
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
		$rules['nik']					= ['required', 'max:255'];
		$rules['nama']					= ['required', 'max:255'];
		$rules['tanggal_lahir']			= ['required', 'date_format:"Y-m-d"'];
		$rules['tempat_lahir']			= ['required', 'max:255'];
		$rules['jenis_kelamin']			= ['required', 'in:laki-laki,perempuan'];
		$rules['status_perkawinan']		= ['required', 'in:belum_kawin,kawin,cerai,cerai_mati'];
		$rules['pekerjaan']				= ['required', 'max:255'];
		$rules['penghasilan_bersih']	= ['required', 'numeric'];
		$rules['telepon']				= ['required', 'max:40'];
		$rules['nomor_whatsapp']		= ['max:255'];
		$rules['email']					= ['max:40'];
		$rules['alamat']				= ['required', 'array'];
		$rules['keluarga']				= ['array'];

		$data 				= $this->attributes;
		$data['alamat']		= json_decode($data['alamat'], true);
		$data['keluarga']	= json_decode($data['keluarga'], true);

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

	public function getTanggalLahirAttribute($variable)
	{
		return $this->formatDateTo($this->attributes['tanggal_lahir']);
	}

	public function getPenghasilanBersihAttribute($variable)
	{
		return $this->formatMoneyTo($this->attributes['penghasilan_bersih']);
	}

	public function getKeluargaAttribute($variable)
	{
		return json_decode($this->attributes['keluarga'], true);
	}

	public function getAlamatAttribute($variable)
	{
		return json_decode($this->attributes['alamat'], true);
	}

	public function getErrorsAttribute()
	{
		return $this->errors;
	}

	public static function rule_of_valid()
	{
		$rules['nik']					= ['required'];
		$rules['nama']					= ['required'];
		$rules['tanggal_lahir']			= ['required'];
		$rules['tempat_lahir']			= ['required'];
		$rules['jenis_kelamin']			= ['required'];
		$rules['status_perkawinan']		= ['required'];
		$rules['pekerjaan']				= ['required'];
		$rules['penghasilan_bersih']	= ['required'];
		$rules['telepon']				= ['required'];
		$rules['nomor_whatsapp']		= ['required'];
		$rules['email']					= ['required'];
		$rules['alamat']['alamat']		= ['required'];
		$rules['alamat']['rt']			= ['required'];
		$rules['alamat']['rw']			= ['required'];
		$rules['alamat']['kecamatan']	= ['required'];
		$rules['alamat']['kota']		= ['required'];

		return $rules;
	}

	public static function rule_of_valid_family()
	{
		$rules['nik']				= ['required'];
		$rules['nama']				= ['required'];
		$rules['hubungan']			= ['required'];
		$rules['telepon']			= ['required'];

		return $rules;
	}
}
