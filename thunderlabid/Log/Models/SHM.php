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
use Thunderlabid\Log\Events\SHM\SHMCreating;
// use Thunderlabid\Log\Events\SHM\SHMCreated;
use Thunderlabid\Log\Events\SHM\SHMUpdating;
// use Thunderlabid\Log\Events\SHM\SHMUpdated;
// use Thunderlabid\Log\Events\SHM\SHMDeleting;
// use Thunderlabid\Log\Events\SHM\SHMDeleted;

use Thunderlabid\Log\Traits\WaktuTrait;
use Thunderlabid\Log\Traits\IDRTrait;

class SHM extends Model
{
	use SoftDeletes;
	use WaktuTrait;
	use IDRTrait;

	protected $table	= 'l_shm';
	protected $fillable	= ['parent_id', 'tipe', 'nomor_sertifikat', 'atas_nama', 'luas_tanah', 'luas_bangunan', 'alamat', 'nilai', 'tahun_perolehan'];

	protected $hidden	= [];
	protected $dates	= [];
	protected $rules	= [];
	protected $errors;
	protected $latest_analysis;

	protected $events 		= [
		'creating' 	=> SHMCreating::class,
		'updating' 	=> SHMUpdating::class,
		// 'deleted' 	=> BPKBDeleted::class,
		// 'deleting' 	=> BPKBDeleting::class,
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
	// 	return $this->hasMany(BPKBLog::class, 'BPKB_id');
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
	public function setAlamatAttribute($variable)
	{
		$this->attributes['alamat']		= json_encode($variable);
	}
	
	public function setNilaiAttribute($variable)
	{
		$this->attributes['nilai']		= $this->formatMoneyFrom($variable);
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
		$rules['tipe']				= ['required', 'max:255', 'in:tanah,tanah_dan_bangunan'];
		$rules['nomor_sertifikat']	= ['required', 'max:255'];
		$rules['atas_nama']			= ['required', 'max:255'];
		$rules['luas_tanah']		= ['required', 'numeric'];
		$rules['luas_bangunan']		= ['required_if:tipe,tanah_dan_bangunan', 'numeric'];
		$rules['alamat']			= ['required', 'array'];
		$rules['tahun_perolehan']	= ['required', 'date_format:"Y"', 'before:'.date('Y')];
		$rules['nilai']				= ['required', 'numeric'];

		//////////////
		// Validate //
		//////////////
		$data 				= $this->attributes;
		$data['alamat']		= json_decode($data['alamat'], true);

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

	public function getNilaiAttribute()
	{
		return $this->formatMoneyTo($this->attributes['nilai'], true);
	}

	public function getAlamatAttribute($variable)
	{
		return json_decode($this->attributes['alamat'], true);
	}

	public function getErrorsAttribute()
	{
		return $this->errors;
	}
}
