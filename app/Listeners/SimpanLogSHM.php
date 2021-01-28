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

use Thunderlabid\Log\Models\SHM;

class SimpanLogSHM
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
	 * @param  SimpanLogSHM $event [description]
	 * @return [type]             [description]
	 */
	public function handle($event)
	{
		$model 		= $event->data;
		
		if(str_is($model->jenis, 'shm'))
		{
			$find 	= SHM::where('nomor_sertifikat', $model->dokumen_jaminan['shm']['nomor_sertifikat'])->first();

			if(!$find)
			{
				$SHM 					= new SHM;
				$data_n_n				= $model->dokumen_jaminan['shm'];
				$data_n_n['tahun_perolehan']	= $model->tahun_perolehan;
				$data_n_n['nilai']				= $model->nilai_jaminan;
				$data_n_n['parent_id']	= null;
				$SHM->fill($data_n_n);
				$SHM->save();
			}
			else
			{
				//simpan versioning
				$old_SHM 				= new SHM;
				$data_o_n 				= $find->toArray();
				unset($data_o_n['id']);
				$data_o_n['parent_id']	= $find->id;
				$old_SHM->fill($data_o_n);
				$old_SHM->save();

				$data_n_n				= $model->dokumen_jaminan['shm'];
				$data_n_n['tahun_perolehan']	= $model->tahun_perolehan;
				$data_n_n['nilai']				= $model->nilai_jaminan;
				$find->fill($data_n_n);
				$find->save();
			}
		}
	}
}