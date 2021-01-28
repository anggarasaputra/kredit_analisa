<?php

namespace Thunderlabid\Log\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;
use Validator;

///////////////
// Exception //
///////////////
use Thunderlabid\Log\Exceptions\AppException;

////////////
// EVENTS //
////////////
use Thunderlabid\Log\Events\BPKB\BPKBCreating;
// use Thunderlabid\Log\Events\BPKB\BPKBCreated;
use Thunderlabid\Log\Events\BPKB\BPKBUpdating;
// use Thunderlabid\Log\Events\BPKB\BPKBUpdated;
// use Thunderlabid\Log\Events\BPKB\BPKBDeleting;
// use Thunderlabid\Log\Events\BPKB\BPKBDeleted;

use Thunderlabid\Log\Traits\WaktuTrait;
use Thunderlabid\Log\Traits\IDRTrait;

class BPKB extends Model
{
	use SoftDeletes;
	use WaktuTrait;
	use IDRTrait;

	protected $table	= 'l_bpkb';
	protected $fillable	= ['parent_id', 'tipe', 'merk', 'tahun', 'nomor_bpkb', 'atas_nama', 'jenis', 'tahun_perolehan', 'nilai'];

	protected $hidden	= [];
	protected $dates	= [];
	protected $rules	= [];
	protected $errors;
	protected $latest_analysis;

	protected $events 		= [
		'creating' 	=> BPKBCreating::class,
		'updating' 	=> BPKBUpdating::class,
		// 'deleted' 	=> BPKBDeleted::class,
		// 'deleting' 	=> BPKBDeleting::class,
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
	// public function log()
	// {
	// 	return $this->hasMany(BPKBLog::class, 'BPKB_id');
	// }
	
	// ------------------------------------------------------------------------------------------------------------
	// FUNCTION
	// ------------------------------------------------------------------------------------------------------------

	// ------------------------------------------------------------------------------------------------------------
	// SCOPE
	// ------------------------------------------------------------------------------------------------------------

	// ------------------------------------------------------------------------------------------------------------
	// MUTATOR
	// ------------------------------------------------------------------------------------------------------------
	public function setNilaiAttribute($variable)
	{
		$this->attributes['nilai']		= $this->formatMoneyFrom($variable);
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
		$rules['tipe']			= ['required', 'max:255', 'in:roda_2,roda_3,roda_4,roda_6'];
		$rules['merk']			= ['required', 'max:255'];
		$rules['tahun']			= ['required', 'date_format:"Y"', 'before:'.date('Y')];
		$rules['nomor_bpkb']	= ['required', 'max:255'];
		$rules['atas_nama']		= ['required', 'max:255'];
		$rules['jenis']			= ['required', 'max:255'];
		$rules['tahun_perolehan']	= ['required', 'date_format:"Y"', 'before:'.date('Y')];
		$rules['nilai']			= ['required', 'numeric'];

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

	public function getNilaiAttribute()
	{
		return $this->formatMoneyTo($this->attributes['nilai'], true);
	}

	public function getErrorsAttribute()
	{
		return $this->errors;
	}
}
