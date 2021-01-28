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

use Thunderlabid\Pengajuan\Models\Pengajuan;

class TidakAdaKredit
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
	 * @param  KantorCreated $event [description]
	 * @return [type]             [description]
	 */
	public function handle($event)
	{
		$model 			= $event->data;

		$pengajuan 		= Pengajuan::where('kode_kantor', $model->id)->count();

		if($pengajuan) 
		{
			throw new AppException('Tidak dapat menghapus kantor yang memiliki kredit', AppException::DATA_VALIDATION);
		}
	}
}