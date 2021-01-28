<?php

namespace Thunderlabid\Manajemen\Traits;

use Carbon\Carbon;

/**
 * Trait tanggal
 *
 * Digunakan untuk reformat tanggal sesuai kontrak
 *
 * @package    Thunderlabid
 * @subpackage Credit
 * @author     C Mooy <chelsy@thunderlab.od>
 */
trait WaktuTrait {

 	/**
	 * parse input tanggal
	 * @param d/m/Y H:i $value 
	 * @return Y-m-d H:i:s $value 
	 */
	public function formatDateTimeFrom($value)
	{
		return Carbon::createFromFormat('d/m/Y H:i', $value)->format('Y-m-d H:i:s');
	}

	/**
	 * parse output tanggal
	 * @param Y-m-d H:i:s $value 
	 * @return d/m/Y H:i $value 
	 */
	public function formatDateTimeTo($value)
	{
		return Carbon::parse($value)->format('d/m/Y H:i');
	}
}