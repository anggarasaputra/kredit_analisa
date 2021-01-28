<?php

namespace Thunderlabid\Territorial\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;
use Validator, DB;

///////////////
// Exception //
///////////////
use Thunderlabid\Territorial\Exceptions\AppException;

////////////
// EVENTS //
////////////
// use Thunderlabid\Territorial\Events\Territorial\DistrikCreating;
// use Thunderlabid\Territorial\Events\Territorial\DistrikCreated;
// use Thunderlabid\Territorial\Events\Territorial\DistrikUpdating;
// use Thunderlabid\Territorial\Events\Territorial\DistrikUpdated;
// use Thunderlabid\Territorial\Events\Territorial\DistrikDeleting;
// use Thunderlabid\Territorial\Events\Territorial\DistrikDeleted;

class Distrik extends Model
{
	use SoftDeletes;

	protected $table	= 'territorial_distrik';
	protected $fillable	= ['id', 'territorial_regensi_id', 'nama'];
	protected $hidden	= [];
	protected $dates	= [];

	protected $rules	= [];
	protected $errors;
	protected $latest_analysis;
    
	protected $events 	= [
		// 'creating' 	=> DistrikCreating::class,
		// 'created' 	=> DistrikCreated::class,
		// 'updating' 	=> DistrikUpdating::class,
		// 'updated' 	=> DistrikUpdated::class,
		// 'deleted' 	=> DistrikDeleted::class,
		// 'deleting' 	=> DistrikDeleting::class,
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
 	public function desa()
	{
		return $this->hasMany(Desa::class, 'territorial_regensi_id');
	}

 	public function regensi()
	{
		return $this->belongsto(Regensi::class, 'territorial_regensi_id');
	}

 	public function kota()
	{
		return $this->belongsto(Regensi::class, 'territorial_regensi_id');
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
		$rules['nama']	= ['required'];

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

	public function getErrorsAttribute()
	{
		return $this->errors;
	}
}
