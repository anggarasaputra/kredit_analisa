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
use Thunderlabid\Log\Models\Nasabah;

class SimpanLogKreditViaJaminan
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
	 * @param  SimpanLogKreditViaJaminan $event [description]
	 * @return [type]             [description]
	 */
	public function handle($event)
	{
		$model 	= $event->data;

		switch ($model->jenis) {
			case 'bpkb':
				$jaminan_id 	= $model->dokumen_jaminan['bpkb']['nomor_bpkb'];
				break;
			case 'shm':
				$jaminan_id 	= $model->dokumen_jaminan['shm']['nomor_sertifikat'];
				break;
			case 'shgb':
				$jaminan_id 	= $model->dokumen_jaminan['shgb']['nomor_sertifikat'];
				break;
		}
		
		$find 	= Kredit::where('pengajuan_id', $model->pengajuan_id)->where('jaminan_id', $jaminan_id)->delete();

		$nasabah_id 		= null;

		if(isset($model->pengajuan->nasabah['nik']))
		{
			$nasabah_id 	= $model->pengajuan->nasabah['nik'];
		}

		$jaminan_tipe 		= $model->jenis;

		$kredit  			= new Kredit;
		$kredit->fill([
			'pengajuan_id'	=> $model->pengajuan_id,
			'nasabah_id'	=> $nasabah_id,
			'jaminan_id'	=> $jaminan_id,
			'jaminan_tipe'	=> $jaminan_tipe,
			]);
		$kredit->save();
	}
}