<?php

namespace App\Listeners;

///////////////
// Exception //
///////////////
use Thunderlabid\Survei\Exceptions\AppException;

///////////////
// Framework //
///////////////
use Carbon\Carbon, Auth;

use Thunderlabid\Log\Models\Kredit;

class UpdatingNasabahIsLama
{
	/**
	 * Create the event listener.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Handle event
	 * @param  UpdatingNasabahIsLama $event [description]
	 * @return [type]             [description]
	 */
	public function handle($event)
	{
		$model 	= $event->data;
		
		$find 	= Kredit::where('nasabah_id', $model->nasabah['nik'])->where('pengajuan_id', '<>', $model->id)->first();

		if($find && (is_null($model->nasabah['is_lama']) || $model->nasabah['is_lama']==false))
		{
			$n				= $model->nasabah;
			$n['is_lama']	= true;
			$model->nasabah = $n;
			$model->save();
		}			
	}
}