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

class DuplikasiJaminan
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
		$exists_jaminan		= collect(Jaminan::where('jenis', $model->jenis)->where('pengajuan_id', '<>', $model->pengajuan_id)->whereHas('pengajuan', function($q){$q->status(['permohonan', 'survei', 'analisa', 'putusan']);})->get()->toArray());

		switch ($model->jenis) {
			case 'shgb':
				$cari 		= $exists_jaminan->where('dokumen_jaminan.shgb.nomor_sertifikat', $model->dokumen_jaminan['shgb']['nomor_sertifikat'])->where('dokumen_jaminan.jenis', $model->dokumen_jaminan['jenis'])->where('dokumen_jaminan.shgb.alamat.kota', $model->dokumen_jaminan['shgb']['alamat']['kota']);
				break;
			case 'shm':
				$cari 		= $exists_jaminan->where('dokumen_jaminan.shm.nomor_sertifikat', $model->dokumen_jaminan['shm']['nomor_sertifikat'])->where('dokumen_jaminan.jenis', $model->dokumen_jaminan['jenis'])->where('dokumen_jaminan.shm.alamat.kota', $model->dokumen_jaminan['shm']['alamat']['kota']);
				break;
			default:
				$cari 		= $exists_jaminan->where('dokumen_jaminan.bpkb.nomor_bpkb', $model->dokumen_jaminan['bpkb']['nomor_bpkb']);
				break;
		}

		if(count($cari))
		{
			throw new AppException("Duplikasi jaminan dengan pengajuan nomor ".$cari->first()['pengajuan_id'], AppException::DATA_VALIDATION);
		}
	}
}