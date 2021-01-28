<?php

namespace Thunderlabid\Pengajuan\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;
use Validator;

///////////////
// Exception //
///////////////
use Thunderlabid\Pengajuan\Exceptions\AppException;

////////////
// EVENTS //
////////////
use Thunderlabid\Pengajuan\Events\Status\StatusCreating;
use Thunderlabid\Pengajuan\Events\Status\StatusCreated;
use Thunderlabid\Pengajuan\Events\Status\StatusUpdating;
use Thunderlabid\Pengajuan\Events\Status\StatusUpdated;
// use Thunderlabid\Pengajuan\Events\Status\StatusDeleting;
// use Thunderlabid\Pengajuan\Events\Status\StatusDeleted;

use Thunderlabid\Pengajuan\Traits\WaktuTrait;

class Status extends Model
{
	use SoftDeletes;
	use WaktuTrait;

	protected $table	= 'p_status';
	protected $fillable	= ['tanggal', 'status', 'progress', 'catatan', 'karyawan', 'pengajuan_id'];
	protected $hidden	= [];
	protected $dates	= [];

	protected $rules		= [];
	protected $errors;
	protected $latest_analysis;

	public static $types	= ['permohonan', 'survei', 'analisa', 'putusan', 'tolak', 'setuju', 'realisasi', 'expired', 'void'];

	protected $events 		= [
		'creating' 	=> StatusCreating::class,
		'created' 	=> StatusCreated::class,
		'updating' 	=> StatusUpdating::class,
		'updated' 	=> StatusUpdated::class,
		// 'deleted' 	=> StatusDeleted::class,
		// 'deleting' 	=> StatusDeleting::class,
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

	// ------------------------------------------------------------------------------------------------------------
	// FUNCTION
	// ------------------------------------------------------------------------------------------------------------

	// ------------------------------------------------------------------------------------------------------------
	// SCOPE
	// ------------------------------------------------------------------------------------------------------------
	public function scopeStatus($query, $variable)
	{
		if(is_array($variable))
		{
			return $query->whereIn('status', $variable);
		}

		return $query->where('status', $variable);
	}

	// ------------------------------------------------------------------------------------------------------------
	// MUTATOR
	// ------------------------------------------------------------------------------------------------------------
	public function setKaryawanAttribute($variable)
	{
		$this->attributes['karyawan']	= json_encode($variable);
	}

	public function setTanggalAttribute($variable)
	{
		$this->attributes['tanggal']  	= $this->formatDateTimeFrom($variable);
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
		$rules['tanggal']		= ['required', 'date_format:"Y-m-d H:i:s"'];
		$rules['status']		= ['required', 'in:' . implode(',',SELF::$types)];
		$rules['progress']		= ['required', 'in:perlu,sedang,sudah'];
		// $rules['catatan']		= ['required'];
		$rules['pengajuan_id']	= ['required', 'exists:p_pengajuan,id'];
		$rules['karyawan.nip']	= ['max:255'];
		$rules['karyawan.nama']	= ['max:255'];

		$data 				= $this->attributes;
		$data['karyawan']	= json_decode($data['karyawan'], true);

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

	public function getTanggalAttribute($variable)
	{
		return $this->formatDateTimeTo($this->attributes['tanggal']);
	}

	public function getKaryawanAttribute($variable)
	{
		return json_decode($this->attributes['karyawan'], true);
	}

	public function getErrorsAttribute()
	{
		return $this->errors;
	}
}
