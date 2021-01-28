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

class HanyaProsesPermohonan
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
	 * @param  PengajuanCreated $event [description]
	 * @return [type]             [description]
	 */
	public function handle($event)
	{
		$model 		= $event->data;
		if ($model->status_terakhir->status!='permohonan') 
		{
			throw new AppException('Kredit dalam proses ini tidak dapat dihapus', AppException::DATA_VALIDATION);
		}
	}
}