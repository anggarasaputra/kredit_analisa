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
use Thunderlabid\Manajemen\Events\PengaturanScopes\PengaturanScopesCreating;
// use Thunderlabid\Manajemen\Events\PengaturanScopes\PengaturanScopesCreated;
use Thunderlabid\Manajemen\Events\PengaturanScopes\PengaturanScopesUpdating;
// use Thunderlabid\Manajemen\Events\PengaturanScopes\PengaturanScopesUpdated;
// use Thunderlabid\Manajemen\Events\PengaturanScopes\PengaturanScopesDeleting;
// use Thunderlabid\Manajemen\Events\PengaturanScopes\PengaturanScopesDeleted;

class PengaturanScopes extends Model
{
	use SoftDeletes;

	protected $table	= 'm_pengaturan_scopes';
	protected $fillable	= ['scope_id', 'scope', 'policies', 'icon', 'urutan'];
	protected $hidden	= [];
	protected $dates	= [];

	protected $rules	= [];
	protected $errors;
	protected $latest_analysis;

	protected $events = [
        'creating' 	=> PengaturanScopesCreating::class,
        // 'created' 	=> PengaturanScopesCreated::class,
        'updating' 	=> PengaturanScopesUpdating::class,
        // 'updated' 	=> PengaturanScopesUpdated::class,
        // 'deleting' 	=> PengaturanScopesDeleting::class,
        // 'deleted' 	=> PengaturanScopesDeleted::class,
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
    	return $this->hasMany(PengaturanScopes::class, 'scope_id');
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
    public function setPoliciesAttribute($variable)
    {
    	$this->attributes['policies']	= json_encode($variable);
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
		$rules['scope']		= ['required'];
		$rules['policies']	= ['json'];

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

    public function getPoliciesAttribute()
    {
    	return json_decode($this->attributes['policies'], true);
    }


	public function getErrorsAttribute()
	{
		return $this->errors;
	}
}
