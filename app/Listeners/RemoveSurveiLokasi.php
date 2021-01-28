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
use Thunderlabid\Survei\Models\Survei;
use Thunderlabid\Survei\Models\SurveiLokasi;

class RemoveSurveiLokasi
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
	 * @param  SimpanLogKredit $event [description]
	 * @return [type]             [description]
	 */
	public function handle($event)
	{
		$model 	= $event->data;

		if($model->status == 'analisa' && $model->progress=='perlu')
		{
			$tanggal 		= Carbon::createFromFormat('d/m/Y H:i', $model->tanggal);
			$find 			= Survei::where('pengajuan_id', $model->pengajuan_id)->where('created_at', '<=', $tanggal->format('Y-m-d H:i:s'))->get()->toArray();
			$ids 		 	= array_column($find, 'id');

			//DELETE ALL LOCATION
			$prev_lokasi 	= SurveiLokasi::whereIn('survei_id', $ids)->delete();
		}
	}
}