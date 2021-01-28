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
// use Thunderlabid\Territorial\Events\Territorial\ProvinsiCreating;
// use Thunderlabid\Territorial\Events\Territorial\ProvinsiCreated;
// use Thunderlabid\Territorial\Events\Territorial\ProvinsiUpdating;
// use Thunderlabid\Territorial\Events\Territorial\ProvinsiUpdated;
// use Thunderlabid\Territorial\Events\Territorial\ProvinsiDeleting;
// use Thunderlabid\Territorial\Events\Territorial\ProvinsiDeleted;

class Provinsi extends Model
{
	use SoftDeletes;

	protected $table	= 'territorial_provinsi';
	protected $fillable	= ['id', 'territorial_negara_id', 'nama'];
	protected $hidden	= [];
	protected $dates	= [];

	protected $rules	= [];
	protected $errors;
	protected $latest_analysis;
    
	protected $events 	= [
		// 'creating' 	=> ProvinsiCreating::class,
		// 'created' 	=> ProvinsiCreated::class,
		// 'updating' 	=> ProvinsiUpdating::class,
		// 'updated' 	=> ProvinsiUpdated::class,
		// 'deleted' 	=> ProvinsiDeleted::class,
		// 'deleting' 	=> ProvinsiDeleting::class,
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
 	public function regensi()
	{
		return $this->hasMany(Regensi::class, 'territorial_provinsi_id');
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
