<?php

namespace Thunderlabid\Manajemen\Listeners;

///////////////
// Exception //
///////////////
use Thunderlabid\Manajemen\Exceptions\AppException;

///////////////
// Framework //
///////////////
use Hash;
use Carbon\Carbon;
use Thunderlabid\Manajemen\Models\PenempatanKaryawan;

class SavingPenempatanKaryawan
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
	 * @param  PenempatanKaryawanCreated $event [description]
	 * @return [type]             [description]
	 */
	public function handle($event)
	{
		$model = $event->data;
		if (!$model->is_savable) 
		{
			throw new AppException($model->errors, AppException::DATA_VALIDATION);
		}

		//check possibility of duplicate kantor
		$id 			= $model->id;
		if(is_null($model->id))
		{
			$id 		= 0;
		}
		$penempatan 	= PenempatanKaryawan::where('kantor_id', $model->kantor_id)->where('orang_id', $model->orang_id)->where('id', '<>', $id)->active(Carbon::createFromFormat('d/m/Y H:i', $model->tanggal_masuk));

		if(!is_null($model->tanggal_keluar))
		{
			$penempatan = $penempatan->active(Carbon::createFromFormat('d/m/Y H:i', $model->tanggal_keluar));
		}
		$penempatan 	= $penempatan->first();
		
		if($penempatan)
		{
			throw new AppException('Karyawan sudah terdaftar di cabang ini pada tanggal rentang waktu tersebut', AppException::DATA_VALIDATION);
		}
	}
}