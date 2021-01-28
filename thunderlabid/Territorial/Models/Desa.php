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
// use Thunderlabid\Territorial\Events\Territorial\DesaCreating;
// use Thunderlabid\Territorial\Events\Territorial\DesaCreated;
// use Thunderlabid\Territorial\Events\Territorial\DesaUpdating;
// use Thunderlabid\Territorial\Events\Territorial\DesaUpdated;
// use Thunderlabid\Territorial\Events\Territorial\DesaDeleting;
// use Thunderlabid\Territorial\Events\Territorial\DesaDeleted;

class Desa extends Model
{
	use SoftDeletes;

	protected $table	= 'territorial_desa';
	protected $fillable	= ['id', 'territorial_distrik_id', 'nama'];
	protected $hidden	= [];
	protected $dates	= [];

	protected $rules	= [];
	protected $errors;
	protected $latest_analysis;
    
	protected $events 	= [
		// 'creating' 	=> DesaCreating::class,
		// 'created' 	=> DesaCreated::class,
		// 'updating' 	=> DesaUpdating::class,
		// 'updated' 	=> DesaUpdated::class,
		// 'deleted' 	=> DesaDeleted::class,
		// 'deleting' 	=> DesaDeleting::class,
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
		return $this->belongsto(Distrik::class, 'territorial_distrik_id');
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
