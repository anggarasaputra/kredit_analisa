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
use Thunderlabid\Survei\Events\SurveiPasscode\SurveiPasscodeCreating;
use Thunderlabid\Survei\Events\SurveiPasscode\SurveiPasscodeCreated;
use Thunderlabid\Survei\Events\SurveiPasscode\SurveiPasscodeUpdating;
use Thunderlabid\Survei\Events\SurveiPasscode\SurveiPasscodeUpdated;
// use Thunderlabid\Survei\Events\SurveiPasscode\SurveiPasscodeDeleting;
// use Thunderlabid\Survei\Events\SurveiPasscode\SurveiPasscodeDeleted;

use Thunderlabid\Survei\Traits\WaktuTrait;

class SurveiPasscode extends Model
{
	use SoftDeletes;
	use WaktuTrait;

	protected $table	= 's_survei_passcode';
	protected $fillable	= ['survei_id', 'passcode', 'expired_at'];
	protected $hidden	= [];
	protected $dates	= [];

	protected $rules		= [];
	protected $errors;
	protected $latest_analysis;

	protected $events 		= [
		'creating' 	=> SurveiPasscodeCreating::class,
		'created' 	=> SurveiPasscodeCreated::class,
		'updating' 	=> SurveiPasscodeUpdating::class,
		'updated' 	=> SurveiPasscodeUpdated::class,
		// 'deleted' 	=> SurveiPasscodeDeleted::class,
		// 'deleting' 	=> SurveiPasscodeDeleting::class,
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
	public function setExpiredAtAttribute($variable)
	{
		$this->attributes['expired_at']  	= $this->formatDateTimeFrom($variable);
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
		$rules['survei_id']		= ['required', 'exists:s_survei,id'];
		$rules['passcode']		= ['required'];
		$rules['expired_at']	= ['required', 'date_format:"Y-m-d H:i:s"'];

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

	public function getExpiredAtAttribute($variable)
	{
		return $this->formatDateTimeTo($this->attributes['expired_at']);
	}
}
