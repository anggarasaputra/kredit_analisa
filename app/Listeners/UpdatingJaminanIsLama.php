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

class UpdatingJaminanIsLama
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
	 * @param  UpdatingJaminanIsLama $event [description]
	 * @return [type]             [description]
	 */
	public function handle($event)
	{
		$model 		= $event->data;
		
		if(str_is($model->jenis, 'bpkb'))
		{
			$find 	= Kredit::where('jaminan_id', $model->dokumen_jaminan['bpkb']['nomor_bpkb'])->where('jaminan_tipe', 'bpkb')->where('pengajuan_id', '<>', $model->pengajuan_id)->first();

			if($find && (is_null($model->dokumen_jaminan['bpkb']['is_lama']) || $model->dokumen_jaminan['bpkb']['is_lama']==false))
			{
				$dj 					= $model->dokumen_jaminan;
				$dj['bpkb']['is_lama']	= true;
				$model->dokumen_jaminan = $dj;
				$model->save();
			}
		}
		else
		{
			$find 	= Kredit::where('jaminan_id', $model->dokumen_jaminan[$model->jenis]['nomor_sertifikat'])->where('jaminan_tipe', $model->jenis)->where('pengajuan_id', '<>', $model->pengajuan_id)->first();

			if($find && (is_null($model->dokumen_jaminan[$model->jenis]['is_lama']) || $model->dokumen_jaminan[$model->jenis]['is_lama']==false))
			{
				$dj 							= $model->dokumen_jaminan;
				$dj[$model->jenis]['is_lama']	= true;
				$model->dokumen_jaminan 		= $dj;
				$model->save();
			}			
		}
	}
}