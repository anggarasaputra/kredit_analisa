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

use Thunderlabid\Pengajuan\Models\Pengajuan;

class BatasanPengajuan
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
		$model = $event->data;

		//check duplikasi Pengajuan
		$exists_pengajuan	= Pengajuan::status('permohonan')->where('p_pengajuan.id', '<>', $model->id)->where('nasabah->telepon', $model->nasabah['telepon'])->count();

		if($exists_pengajuan > 2)
		{
			throw new AppException("Maksimal pengajuan untuk nasabah yang sama adalah 3 kali", AppException::DATA_VALIDATION);
		}
	}
}