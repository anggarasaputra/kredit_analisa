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
use Thunderlabid\Survei\Events\SurveiFoto\SurveiFotoCreating;
use Thunderlabid\Survei\Events\SurveiFoto\SurveiFotoCreated;
use Thunderlabid\Survei\Events\SurveiFoto\SurveiFotoUpdating;
use Thunderlabid\Survei\Events\SurveiFoto\SurveiFotoUpdated;
// use Thunderlabid\Survei\Events\SurveiFoto\SurveiFotoDeleting;
// use Thunderlabid\Survei\Events\SurveiFoto\SurveiFotoDeleted;

use Thunderlabid\Survei\Traits\WaktuTrait;

class SurveiFoto extends Model
{
	use SoftDeletes;
	use WaktuTrait;

	protected $table	= 's_survei_foto';
	protected $fillable	= ['survei_detail_id', 'arsip_foto'];
	protected $hidden	= [];
	protected $dates	= [];

	protected $rules		= [];
	protected $errors;
	protected $latest_analysis;

	protected $events 		= [
		'creating' 	=> SurveiFotoCreating::class,
		'created' 	=> SurveiFotoCreated::class,
		'updating' 	=> SurveiFotoUpdating::class,
		'updated' 	=> SurveiFotoUpdated::class,
		// 'deleted' 	=> SurveiFotoDeleted::class,
		// 'deleting' 	=> SurveiFotoDeleting::class,
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
	public function surveidetail()
	{
		return $this->belongsTo(SurveiDetail::class, 'survei_detail_id');
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
	public function setArsipFotoAttribute($variable)
	{
		$this->attributes['arsip_foto']	= json_encode($variable);
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
		$rules['arsip_foto.*.url']			= ['required', 'url'];
		// $rules['arsip_foto.*.keterangan']	= ['required'];

		$data 				= $this->attributes;
		$data['arsip_foto']	= json_decode($data['arsip_foto'], true);

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

	public function getArsipFotoAttribute($variable)
	{
		return json_decode($this->attributes['arsip_foto'], true);
	}

	public function getErrorsAttribute()
	{
		return $this->errors;
	}
}
