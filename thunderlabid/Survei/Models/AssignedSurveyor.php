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
use Thunderlabid\Survei\Events\AssignedSurveyor\AssignedSurveyorCreating;
use Thunderlabid\Survei\Events\AssignedSurveyor\AssignedSurveyorCreated;
use Thunderlabid\Survei\Events\AssignedSurveyor\AssignedSurveyorUpdating;
use Thunderlabid\Survei\Events\AssignedSurveyor\AssignedSurveyorUpdated;
// use Thunderlabid\Survei\Events\AssignedSurveyor\AssignedSurveyorDeleting;
// use Thunderlabid\Survei\Events\AssignedSurveyor\AssignedSurveyorDeleted;

class AssignedSurveyor extends Model
{
	use SoftDeletes;

	protected $table	= 's_assigned_surveyor';
	protected $fillable	= ['survei_id', 'nip', 'nama'];
	protected $hidden	= [];
	protected $dates	= [];

	protected $rules		= [];
	protected $errors;
	protected $latest_analysis;

	protected $events 		= [
		'creating' 	=> AssignedSurveyorCreating::class,
		'created' 	=> AssignedSurveyorCreated::class,
		'updating' 	=> AssignedSurveyorUpdating::class,
		'updated' 	=> AssignedSurveyorUpdated::class,
		// 'deleted' 	=> AssignedSurveyorDeleted::class,
		// 'deleting' 	=> AssignedSurveyorDeleting::class,
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
		$rules['survei_id']		= ['required', 'exists:s_survei,id'];
		$rules['nip']			= ['required', 'exists:m_orang,nip'];
		$rules['nama']			= ['exists:m_orang,nama'];

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
