<?php

namespace Thunderlabid\Survei\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;
use Validator;

///////////////
// Exception //
///////////////
use Thunderlabid\Survei\Exceptions\AppException;

////////////
// EVENTS //
////////////
use Thunderlabid\Survei\Events\SurveiLokasi\SurveiLokasiCreating;
// use Thunderlabid\Survei\Events\SurveiLokasi\SurveiLokasiCreated;
use Thunderlabid\Survei\Events\SurveiLokasi\SurveiLokasiUpdating;
// use Thunderlabid\Survei\Events\SurveiLokasi\SurveiLokasiUpdated;
// use Thunderlabid\Survei\Events\SurveiLokasi\SurveiLokasiDeleting;
// use Thunderlabid\Survei\Events\SurveiLokasi\SurveiLokasiDeleted;

class SurveiLokasi extends Model
{
	use SoftDeletes;

	protected $table	= 's_survei_lokasi';
	protected $fillable	= ['survei_id', 'kelurahan', 'kecamatan', 'kota', 'agenda', 'alamat', 'nama', 'telepon'];
	protected $hidden	= [];
	protected $dates	= [];

	protected $rules		= [];
	protected $errors;
	protected $latest_analysis;

	protected $events 		= [
		'creating' 	=> SurveiLokasiCreating::class,
		// 'created' 	=> SurveiLokasiCreated::class,
		'updating' 	=> SurveiLokasiUpdating::class,
		// 'updated' 	=> SurveiLokasiUpdated::class,
		// 'deleted' 	=> SurveiLokasiDeleted::class,
		// 'deleting' 	=> SurveiLokasiDeleting::class,
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
	public function survei()
	{
		return $this->belongsTo(Survei::class, 'survei_id');
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
		$rules['kelurahan']		= ['max:255'];
		$rules['kecamatan']		= ['max:255'];
		$rules['kota']			= ['max:255'];

		//////////////
		// Validate //
		//////////////
		$validator = Validator::make($this->attributes, $rules);
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

	public function getErrorsAttribute()
	{
		return $this->errors;
	}
}
