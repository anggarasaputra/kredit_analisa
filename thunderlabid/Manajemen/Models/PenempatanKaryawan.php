<?php

namespace Thunderlabid\Manajemen\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;
use Validator;
use Carbon\Carbon;

use Thunderlabid\Manajemen\Traits\WaktuTrait;

///////////////
// Exception //
///////////////
use Thunderlabid\Manajemen\Exceptions\AppException;

////////////
// EVENTS //
////////////
use Thunderlabid\Manajemen\Events\PenempatanKaryawan\PenempatanKaryawanCreating;
// use Thunderlabid\Manajemen\Events\PenempatanKaryawan\PenempatanKaryawanCreated;
use Thunderlabid\Manajemen\Events\PenempatanKaryawan\PenempatanKaryawanUpdating;
// use Thunderlabid\Manajemen\Events\PenempatanKaryawan\PenempatanKaryawanUpdated;
// use Thunderlabid\Manajemen\Events\PenempatanKaryawan\PenempatanKaryawanDeleting;
// use Thunderlabid\Manajemen\Events\PenempatanKaryawan\PenempatanKaryawanDeleted;

class PenempatanKaryawan extends Model
{
	use SoftDeletes;
	use WaktuTrait;

	protected $table	= 'm_penempatan_karyawan';
	protected $fillable	= ['kantor_id', 'orang_id', 'role', 'scopes', 'policies', 'tanggal_masuk', 'tanggal_keluar'];
	protected $hidden	= [];
	protected $dates	= [];
	protected $appends	= ['is_savable', 'is_deletable'];

	protected $rules	= [];
	protected $errors;
	protected $latest_analysis;

	protected $events = [
		'creating' 	=> PenempatanKaryawanCreating::class,
		// 'created' 	=> PenempatanKaryawanCreated::class,
		'updating' 	=> PenempatanKaryawanUpdating::class,
		// 'updated' 	=> PenempatanKaryawanUpdated::class,
		// 'deleting' 	=> PenempatanKaryawanDeleting::class,
		// 'deleted' 	=> PenempatanKaryawanDeleted::class,
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
	public function kantor()
	{
		return $this->belongsTo(Kantor::class, 'kantor_id');
	}
	
	public function orang()
	{
		return $this->belongsTo(Orang::class, 'orang_id');
	}

	// ------------------------------------------------------------------------------------------------------------
	// FUNCTION
	// ------------------------------------------------------------------------------------------------------------

	// ------------------------------------------------------------------------------------------------------------
	// SCOPE
	// ------------------------------------------------------------------------------------------------------------

	public function scopeActive($query, Carbon $tanggal_aktif)
	{
		return $query->where(function($q)use($tanggal_aktif){$q->wherenull('tanggal_keluar')->orwhere('tanggal_keluar', '>', $tanggal_aktif->format('Y-m-d H:i:s'));});
	}

	// ------------------------------------------------------------------------------------------------------------
	// MUTATOR
	// ------------------------------------------------------------------------------------------------------------
	public function setTanggalMasukAttribute($variable)
	{
		$this->attributes['tanggal_masuk']	= $this->formatDateTimeFrom($variable);
	}

	public function setTanggalKeluarAttribute($variable)
	{
		$this->attributes['tanggal_keluar']	= $this->formatDateTimeFrom($variable);
	}

	public function setScopesAttribute($variable)
	{
		$this->attributes['scopes']		= json_encode($variable);
	}

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
		$rules['kantor_id']	= ['required', 'exists:m_kantor,id'];
		$rules['orang_id']	= ['required', 'exists:m_orang,id'];
		$rules['role']		= ['required'];
		$rules['scopes']	= ['required', 'json'];
		$rules['policies']	= ['json'];
		$rules['tanggal_masuk']		= ['required','date_format:"Y-m-d H:i:s"'];
		$rules['tanggal_keluar']	= ['date_format:"Y-m-d H:i:s"', 'after:tanggal_masuk'];

		//////////////
		// Validate //
		//////////////
		$validator = Validator::make($this->attributes, $rules);
		if ($validator->fails())
		{
			$this->errors = $validator->messages();
			return false;
		}

		return true;
	}

	public function getPoliciesAttribute()
	{
		return json_decode($this->attributes['policies'], true);
	}

	public function getScopesAttribute()
	{
		return json_decode($this->attributes['scopes'], true);
	}

	public function getTanggalMasukAttribute($value)
	{
		return $this->formatDateTimeTo($value);
	}

	public function getTanggalKeluarAttribute($value)
	{
		if(is_null($value))
		{
			return null;
		}
		
		return $this->formatDateTimeTo($value);
	}

	public function getErrorsAttribute()
	{
		return $this->errors;
	}
}
