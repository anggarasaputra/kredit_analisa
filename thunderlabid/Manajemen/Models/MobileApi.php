<?php

namespace Thunderlabid\Manajemen\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;
use Validator;

///////////////
// Exception //
///////////////
use Thunderlabid\Manajemen\Exceptions\AppException;

////////////
// EVENTS //
////////////
use Thunderlabid\Manajemen\Events\MobileApi\MobileApiCreating;
// use Thunderlabid\Manajemen\Events\MobileApi\MobileApiCreated;
use Thunderlabid\Manajemen\Events\MobileApi\MobileApiUpdating;
// use Thunderlabid\Manajemen\Events\MobileApi\MobileApiUpdated;
// use Thunderlabid\Manajemen\Events\MobileApi\MobileApiDeleting;
// use Thunderlabid\Manajemen\Events\MobileApi\MobileApiDeleted;

class MobileApi extends Model
{
	use SoftDeletes;

	protected $table	= 'm_mobile_api';
	protected $fillable	= ['key', 'secret', 'tipe', 'versi'];
	protected $hidden	= [];
	protected $dates	= [];

	protected $rules	= [];
	protected $errors;
	protected $latest_analysis;

	protected $events = [
        'creating' 	=> MobileApiCreating::class,
        // 'created' 	=> MobileApiCreated::class,
        'updating' 	=> MobileApiUpdating::class,
        // 'updated' 	=> MobileApiUpdated::class,
        // 'deleting' 	=> MobileApiDeleting::class,
        // 'deleted' 	=> MobileApiDeleted::class,
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
    public function features()
    {
    	return $this->hasMany(MobileApi::class, 'scope_id');
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
		$rules['key']		= ['required'];
		$rules['secret']	= ['required'];
		$rules['tipe']		= ['required'];
		$rules['versi']		= ['required'];

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
