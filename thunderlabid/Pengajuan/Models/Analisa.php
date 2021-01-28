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
use Thunderlabid\Pengajuan\Events\Analisa\AnalisaCreating;
use Thunderlabid\Pengajuan\Events\Analisa\AnalisaCreated;
use Thunderlabid\Pengajuan\Events\Analisa\AnalisaUpdating;
use Thunderlabid\Pengajuan\Events\Analisa\AnalisaUpdated;
// use Thunderlabid\Pengajuan\Events\Analisa\AnalisaDeleting;
// use Thunderlabid\Pengajuan\Events\Analisa\AnalisaDeleted;

use Thunderlabid\Pengajuan\Traits\WaktuTrait;
use Thunderlabid\Pengajuan\Traits\IDRTrait;

class Analisa extends Model
{
	use SoftDeletes;
	use WaktuTrait;
	use IDRTrait;

	protected $table	= 'p_analisa';
	protected $fillable	= ['pengajuan_id', 'analis', 'tanggal', 'character', 'capacity', 'capital', 'condition', 'collateral', 'jenis_pinjaman', 'suku_bunga', 'jangka_waktu', 'limit_angsuran', 'limit_jangka_waktu', 'kredit_diusulkan', 'angsuran_pokok', 'angsuran_bunga'];
	protected $hidden	= [];
	protected $dates	= [];

	protected $rules	= [];
	protected $errors;
	protected $latest_analysis;

	protected $appends 	= ['total_angsuran'];

	protected $events 	= [
		'creating' 	=> AnalisaCreating::class,
		'created' 	=> AnalisaCreated::class,
		'updating' 	=> AnalisaUpdating::class,
		'updated' 	=> AnalisaUpdated::class,
		// 'deleted' 	=> AnalisaDeleted::class,
		// 'deleting' 	=> AnalisaDeleting::class,
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
	public function setTanggalAttribute($variable)
	{
		$this->attributes['tanggal']  	= $this->formatDateTimeFrom($variable);
	}
	
	public function setAnalisAttribute($variable)
	{
		$this->attributes['analis']		= json_encode($variable);
	}

	public function setLimitAngsuranAttribute($variable)
	{
		$this->attributes['limit_angsuran']		= $this->formatMoneyFrom($variable);
	}

	public function setKreditDiusulkanAttribute($variable)
	{
		$this->attributes['kredit_diusulkan']	= $this->formatMoneyFrom($variable);
	}

	public function setAngsuranPokokAttribute($variable)
	{
		$this->attributes['angsuran_pokok']		= $this->formatMoneyFrom($variable);
	}

	public function setAngsuranBungaAttribute($variable)
	{
		$this->attributes['angsuran_bunga']		= $this->formatMoneyFrom($variable);
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
		$rules['tanggal']			= ['required', 'date_format:"Y-m-d H:i:s"'];
		$rules['analis']['nip']		= ['required'];
		$rules['analis']['nama']	= ['required'];
		$rules['pengajuan_id']		= ['required', 'exists:p_pengajuan,id'];
		$rules['character']			= ['required', 'in:sangat_baik,baik,cukup_baik,tidak_baik,buruk'];
		$rules['capacity']			= ['required', 'in:sangat_baik,baik,cukup_baik,tidak_baik,buruk'];
		$rules['capital']			= ['required', 'in:sangat_baik,baik,cukup_baik,tidak_baik,buruk'];
		$rules['condition']			= ['required', 'in:sangat_baik,baik,cukup_baik,tidak_baik,buruk'];
		$rules['collateral']		= ['required', 'in:sangat_baik,baik,cukup_baik,tidak_baik,buruk'];
		$rules['jenis_pinjaman']	= ['required', 'in:pa,pt'];
		$rules['suku_bunga']		= ['required', 'numeric'];
		$rules['jangka_waktu']		= ['required', 'numeric'];
		$rules['limit_angsuran']	= ['required', 'numeric'];
		$rules['limit_jangka_waktu']= ['required', 'numeric'];
		
		$rules['kredit_diusulkan']	= ['required', 'numeric'];
		$rules['angsuran_pokok']	= ['required', 'numeric'];
		$rules['angsuran_bunga']	= ['required', 'numeric'];

		//////////////
		// Validate //
		//////////////
		$data 				= $this->attributes;
		$data['analis'] 	= json_decode($data['analis'], true);

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

	public function getAnalisAttribute($variable)
	{
		return json_decode($this->attributes['analis'], true);
	}

	public function getLimitAngsuranAttribute($variable)
	{
		return $this->formatMoneyTo($this->attributes['limit_angsuran']);
	}

	public function getKreditDiusulkanAttribute($variable)
	{
		return $this->formatMoneyTo($this->attributes['kredit_diusulkan']);
	}

	public function getAngsuranPokokAttribute($variable)
	{
		return $this->formatMoneyTo($this->attributes['angsuran_pokok']);
	}

	public function getAngsuranBungaAttribute($variable)
	{
		return $this->formatMoneyTo($this->attributes['angsuran_bunga']);
	}

	public function getTotalAngsuranAttribute($variable)
	{
		return $this->formatMoneyTo($this->attributes['angsuran_pokok'] + $this->attributes['angsuran_bunga']);
	}

	public function getErrorsAttribute()
	{
		return $this->errors;
	}

	public static function rule_of_valid()
	{
		$rules['tanggal']			= ['required'];
		$rules['character']			= ['required'];
		$rules['capacity']			= ['required'];
		$rules['capital']			= ['required'];
		$rules['condition']			= ['required'];
		$rules['collateral']		= ['required'];
		$rules['jenis_pinjaman']	= ['required'];
		$rules['suku_bunga']		= ['required'];
		$rules['jangka_waktu']		= ['required'];
		$rules['limit_angsuran']	= ['required'];
		$rules['limit_jangka_waktu']= ['required'];
		$rules['kredit_diusulkan']	= ['required'];
		$rules['angsuran_pokok']	= ['required'];
		$rules['angsuran_bunga']	= ['required'];

		return $rules;
	}
}
