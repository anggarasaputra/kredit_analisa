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
use Thunderlabid\Log\Events\Kredit\KreditCreating;
// use Thunderlabid\Log\Events\Kredit\KreditCreated;
use Thunderlabid\Log\Events\Kredit\KreditUpdating;
// use Thunderlabid\Log\Events\Kredit\KreditUpdated;
// use Thunderlabid\Log\Events\Kredit\KreditDeleting;
// use Thunderlabid\Log\Events\Kredit\KreditDeleted;

use Thunderlabid\Log\Traits\WaktuTrait;

class Kredit extends Model
{
	use SoftDeletes;
	use WaktuTrait;

	protected $table	= 'l_kredit';
	protected $fillable	= ['pengajuan_id', 'nasabah_id', 'jaminan_id', 'jaminan_tipe'];

	protected $hidden	= [];
	protected $dates	= [];
	protected $rules	= [];
	protected $errors;
	protected $latest_analysis;

	protected $events 		= [
		'creating' 	=> KreditCreating::class,
		'updating' 	=> KreditUpdating::class,
		// 'deleted' 	=> KreditDeleted::class,
		// 'deleting' 	=> KreditDeleting::class,
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
	// 	return $this->hasMany(KreditLog::class, 'Kredit_id');
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
		$rules['pengajuan_id']	= ['required', 'max:255'];
		$rules['nasabah_id']	= ['required', 'max:255'];
		$rules['jaminan_id']	= ['required', 'max:255'];
		$rules['jaminan_tipe']	= ['required', 'in:bpkb,shgb,shm'];

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
