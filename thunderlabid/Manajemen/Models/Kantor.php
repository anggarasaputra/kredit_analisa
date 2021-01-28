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
use Thunderlabid\Manajemen\Events\Kantor\KantorCreating;
use Thunderlabid\Manajemen\Events\Kantor\KantorCreated;
use Thunderlabid\Manajemen\Events\Kantor\KantorUpdating;
// use Thunderlabid\Manajemen\Events\Kantor\KantorUpdated;
use Thunderlabid\Manajemen\Events\Kantor\KantorDeleting;
// use Thunderlabid\Manajemen\Events\Kantor\KantorDeleted;

class Kantor extends Model
{
	use SoftDeletes;

	protected $table	= 'm_kantor';
	protected $fillable	= ['kantor_id', 'nama', 'alamat', 'geolocation', 'telepon', 'tipe', 'jenis'];
	protected $hidden	= [];
	protected $dates	= [];

	protected $rules	= [];
	protected $errors;
	protected $latest_analysis;

	protected $keyType  	= 'string';
    public $incrementing 	= false;

	public static $types 	= ['holding', 'pusat', 'cabang'];

	protected $events = [
        'created' 	=> KantorCreated::class,
        'creating' 	=> KantorCreating::class,
        // 'updated' 	=> KantorUpdated::class,
        'updating' 	=> KantorUpdating::class,
        // 'deleted' 	=> KantorDeleted::class,
        'deleting' 	=> KantorDeleting::class,
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
	public function penempatan()
	{
		return $this->hasMany(PenempatanKaryawan::class, 'kantor_id');
	}

	public function pusat()
	{
		return $this->belongsto(Kantor::class, 'kantor_id');
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
    public function setGeolocationAttribute($variable)
    {
    	$this->attributes['geolocation']	= json_encode($variable);
    }

    public function setAlamatAttribute($variable)
    {
    	$this->attributes['alamat']			= json_encode($variable);
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
		$rules['kantor_id']						= ['exists:m_kantor,id'];
		$rules['nama']							= ['required', 'string'];
		$rules['alamat'] 						= ['required', 'json'];
		$rules['geolocation']['latitude'] 		= ['required'];
		$rules['geolocation']['longitude'] 		= ['required'];
		$rules['telepon'] 						= ['required'];
		$rules['tipe'] 							= ['required', 'in:' . implode(',',SELF::$types)];
		$rules['jenis'] 						= ['in:bpr,koperasi'];

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

    public function getGeolocationAttribute()
    {
    	return json_decode($this->attributes['geolocation'], true);
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
