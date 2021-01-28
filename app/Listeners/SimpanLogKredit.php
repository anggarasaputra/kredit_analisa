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

class SimpanLogKredit
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
		
		$find 	= Kredit::where('pengajuan_id', $model->id)->delete();

		$nasabah_id 	= null;

		if(isset($model->nasabah['nik']))
		{
			$nasabah_id 	= $model->nasabah['nik'];
		}

		if($model->jaminan()->count())
		{
			foreach ($model->jaminan as $key => $value) 
			{
				switch ($value->jenis) {
					case 'bpkb':
						$jaminan_id 	= $value->dokumen_jaminan['bpkb']['nomor_bpkb'];
						break;
					case 'shm':
						$jaminan_id 	= $value->dokumen_jaminan['shm']['nomor_sertifikat'];
						break;
					case 'shgb':
						$jaminan_id 	= $value->dokumen_jaminan['shgb']['nomor_sertifikat'];
						break;
				}

				$jaminan_tipe 		= $value->jenis;

				$kredit  	= new Kredit;
				$kredit->fill([
					'pengajuan_id'	=> $model->id,
					'nasabah_id'	=> $nasabah_id,
					'jaminan_id'	=> $jaminan_id,
					'jaminan_tipe'	=> $jaminan_tipe,
					]);
				$kredit->save();
			}
		}
	}
}