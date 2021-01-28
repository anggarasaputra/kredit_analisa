<?php

namespace Thunderlabid\Pengajuan\Listeners;

///////////////
// Exception //
///////////////
use Thunderlabid\Pengajuan\Exceptions\AppException;

///////////////
// Framework //
///////////////
use Hash;

use Thunderlabid\Pengajuan\Models\Jaminan;

class BatasanJaminan
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
	 * @param  JaminanCreated $event [description]
	 * @return [type]             [description]
	 */
	public function handle($event)
	{
		$model = $event->data;

		//check duplikasi jaminan
		$exists_jaminan		= Jaminan::where('jenis', $model->jenis)->where('pengajuan_id', $model->pengajuan_id)->count();

		switch ($model->jenis) {
			case 'shm': case 'shgb':
				if($exists_jaminan > 2)
				{
					throw new AppException("Jaminan berupa ".strtoupper($model->jenis)." tidak boleh lebih dari 3 jaminan ");
				}
				break;
			
			default:
				if($exists_jaminan > 1)
				{
					throw new AppException("Jaminan berupa ".strtoupper($model->jenis)." tidak boleh lebih dari 2 jaminan ");
				}
				break;
		}
	}
}