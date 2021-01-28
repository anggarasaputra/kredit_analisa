<?php

namespace Thunderlabid\Manajemen\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;
use Validator;
use Exception;
use Hash;

///////////////
// Exception //
///////////////
use Thunderlabid\Manajemen\Exceptions\AppException;

////////////
// EVENTS //
////////////
use Thunderlabid\Manajemen\Events\Orang\OrangCreated;
use Thunderlabid\Manajemen\Events\Orang\OrangCreating;
use Thunderlabid\Manajemen\Events\Orang\OrangUpdated;
use Thunderlabid\Manajemen\Events\Orang\OrangUpdating;
use Thunderlabid\Manajemen\Events\Orang\OrangDeleted;
use Thunderlabid\Manajemen\Events\Orang\OrangDeleting;

class Orang extends Authenticatable
{
	use Notifiable, SoftDeletes;

	protected $table 	= 'm_orang';
	protected $fillable = [ 'nip', 'nama', 'email', 'password', 'alamat', 'telepon'];
	protected $hidden 	= ['password', 'remember_token',];
	protected $dates	= ['deleted_at'];
	protected $appends	= ['is_savable', 'is_deletable'];
	protected $rules	= [];
	protected $errors;

	protected $events = [
        'created' 	=> OrangCreated::class,
        'creating' 	=> OrangCreating::class,
        'updated' 	=> OrangUpdated::class,
        'updating' 	=> OrangUpdating::class,
        'deleted' 	=> OrangDeleted::class,
        'deleting' 	=> OrangDeleting::class,
    ];

	// ------------------------------------------------------------------------------------------------------------
	// CONSTRUCT
	// ------------------------------------------------------------------------------------------------------------

	// ------------------------------------------------------------------------------------------------------------
	// BOOT
	// ------------------------------------------------------------------------------------------------------------
	
	// ------------------------------------------------------------------------------------------------------------
	// RELATION
	// ------------------------------------------------------------------------------------------------------------
	public function penempatan()
	{
		return $this->hasMany(PenempatanKaryawan::class, 'orang_id')->orderby('tanggal_masuk', 'asc');
	}
	
	// ------------------------------------------------------------------------------------------------------------
	// FUNCTION
	// ------------------------------------------------------------------------------------------------------------
	public function getAuthEmail()
	{
	    return $this->nip;
	}

	// ------------------------------------------------------------------------------------------------------------
	// SCOPE
	// ------------------------------------------------------------------------------------------------------------
	public function scopeEmail($q, $v = null)
	{
		if (!$v) return $q;
		return $q->where('email', 'like', $v);
	}

	// ------------------------------------------------------------------------------------------------------------
	// MUTATOR
	// ------------------------------------------------------------------------------------------------------------
    public function setAlamatAttribute($variable)
    {
    	$this->attributes['alamat']			= json_encode($variable);
    }

	// ------------------------------------------------------------------------------------------------------------
	// ACCESSOR
	// ------------------------------------------------------------------------------------------------------------
	public function getIsDeletableAttribute()
	{
		if(!is_null($this->attributes['nip']))
		{
			$this->errors = ['Tidak dapat menghapus karyawan.'];

			return false;
		}

		return true;
	}

	public function getIsSavableAttribute()
	{
		//////////////////
		// Create Rules //
		//////////////////
		$rules['nama'] 			= ['required', 'string'];
		$rules['email'] 		= ['required', 'email', Rule::unique($this->table)->ignore($this->id)];
		$rules['password']		= ['required', 'min:6', 'string'];

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
	
	public function getAlamatAttribute()
    {
    	return json_decode($this->attributes['alamat'], true);
    }

	public function getErrorsAttribute()
	{
		return $this->errors;
	}
}
