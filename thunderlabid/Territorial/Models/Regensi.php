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
// use Thunderlabid\Territorial\Events\Territorial\RegensiCreating;
// use Thunderlabid\Territorial\Events\Territorial\RegensiCreated;
// use Thunderlabid\Territorial\Events\Territorial\RegensiUpdating;
// use Thunderlabid\Territorial\Events\Territorial\RegensiUpdated;
// use Thunderlabid\Territorial\Events\Territorial\RegensiDeleting;
// use Thunderlabid\Territorial\Events\Territorial\RegensiDeleted;

class Regensi extends Model
{
	use SoftDeletes;

	protected $table	= 'territorial_regensi';
	protected $fillable	= ['id', 'territorial_provinsi_id', 'nama'];
	protected $hidden	= [];
	protected $dates	= [];

	protected $rules	= [];
	protected $errors;
	protected $latest_analysis;
    
	protected $events 	= [
		// 'creating' 	=> RegensiCreating::class,
		// 'created' 	=> RegensiCreated::class,
		// 'updating' 	=> RegensiUpdating::class,
		// 'updated' 	=> RegensiUpdated::class,
		// 'deleted' 	=> RegensiDeleted::class,
		// 'deleting' 	=> RegensiDeleting::class,
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
 	public function distrik()
	{
		return $this->hasMany(Distrik::class, 'territorial_provinsi_id');
	}

 	public function provinsi()
	{
		return $this->belongsto(Provinsi::class, 'territorial_provinsi_id');
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
