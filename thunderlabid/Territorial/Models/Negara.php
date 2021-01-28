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
// use Thunderlabid\Territorial\Events\Territorial\NegaraCreating;
// use Thunderlabid\Territorial\Events\Territorial\NegaraCreated;
// use Thunderlabid\Territorial\Events\Territorial\NegaraUpdating;
// use Thunderlabid\Territorial\Events\Territorial\NegaraUpdated;
// use Thunderlabid\Territorial\Events\Territorial\NegaraDeleting;
// use Thunderlabid\Territorial\Events\Territorial\NegaraDeleted;

class Negara extends Model
{
	use SoftDeletes;

	protected $table	= 'territorial_negara';
	protected $fillable	= ['id', 'nama'];
	protected $hidden	= [];
	protected $dates	= [];

	protected $rules	= [];
	protected $errors;
	protected $latest_analysis;
    
	protected $events 	= [
		// 'creating' 	=> NegaraCreating::class,
		// 'created' 	=> NegaraCreated::class,
		// 'updating' 	=> NegaraUpdating::class,
		// 'updated' 	=> NegaraUpdated::class,
		// 'deleted' 	=> NegaraDeleted::class,
		// 'deleting' 	=> NegaraDeleting::class,
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
 	public function provinsi()
	{
		return $this->hasMany(Provinsi::class, 'territorial_negara_id');
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
