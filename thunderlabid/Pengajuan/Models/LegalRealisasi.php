<?php

namespace Thunderlabid\Pengajuan\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;
use Validator, DB;

///////////////
// Exception //
///////////////
use Thunderlabid\Pengajuan\Exceptions\AppException;

////////////
// EVENTS //
////////////
use Thunderlabid\Pengajuan\Events\LegalRealisasi\LegalRealisasiCreating;
// use Thunderlabid\Pengajuan\Events\LegalRealisasi\LegalRealisasiCreated;
use Thunderlabid\Pengajuan\Events\LegalRealisasi\LegalRealisasiUpdating;
// use Thunderlabid\Pengajuan\Events\LegalRealisasi\LegalRealisasiUpdated;
// use Thunderlabid\Pengajuan\Events\LegalRealisasi\LegalRealisasiDeleting;
// use Thunderlabid\Pengajuan\Events\LegalRealisasi\LegalRealisasiDeleted;

class LegalRealisasi extends Model
{
	use SoftDeletes;

	protected $table	= 'p_legal_realisasi';
	protected $fillable	= ['pengajuan_id', 'nomor', 'jenis', 'isi'];
	protected $hidden	= [];
	protected $dates	= [];

	protected $rules	= [];
	protected $errors;
	protected $latest_analysis;

	protected $events 	= [
		'creating' 	=> LegalRealisasiCreating::class,
		// 'created' 	=> LegalRealisasiCreated::class,
		'updating' 	=> LegalRealisasiUpdating::class,
		// 'updated' 	=> LegalRealisasiUpdated::class,
		// 'deleted' 	=> LegalRealisasiDeleted::class,
		// 'deleting' 	=> LegalRealisasiDeleting::class,
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
	public function pengajuan()
	{
		return $this->belongsTo(Pengajuan::class, 'pengajuan_id');
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

	public function setIsiAttribute($variable)
	{
		$this->attributes['isi']		= json_encode($variable);
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
		$rules['pengajuan_id']		= ['required', 'exists:p_pengajuan,id'];
		$rules['nomor']				= ['required'];
		$rules['jenis']				= ['required'];
		$rules['isi']				= ['required'];

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

	public function getIsiAttribute($variable)
	{
		return json_decode($this->attributes['isi'], true);
	}
}
