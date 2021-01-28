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

use Thunderlabid\Log\Models\BPKB;

class SimpanLogBPKB
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
	 * @param  SimpanLogBPKB $event [description]
	 * @return [type]             [description]
	 */
	public function handle($event)
	{
		$model 		= $event->data;
		
		if(str_is($model->jenis, 'bpkb'))
		{
			$find 	= BPKB::where('nomor_bpkb', $model->dokumen_jaminan['bpkb']['nomor_bpkb'])->first();

			if(!$find)
			{
				$bpkb 					= new BPKB;
				$data_n_n				= $model->dokumen_jaminan['bpkb'];
				$data_n_n['tahun_perolehan']	= $model->tahun_perolehan;
				$data_n_n['nilai']				= $model->nilai_jaminan;
				$data_n_n['parent_id']	= null;
				$bpkb->fill($data_n_n);
				$bpkb->save();
			}
			else
			{
				//simpan versioning
				$old_BPKB 				= new BPKB;
				$data_o_n 				= $find->toArray();
				unset($data_o_n['id']);
				$data_o_n['parent_id']	= $find->id;
				$old_BPKB->fill($data_o_n);
				$old_BPKB->save();

				$data_n_n				= $model->dokumen_jaminan['bpkb'];
				$data_n_n['tahun_perolehan']	= $model->tahun_perolehan;
				$data_n_n['nilai']				= $model->nilai_jaminan;
				$find->fill($data_n_n);
				$find->save();
			}
		}
	}
}