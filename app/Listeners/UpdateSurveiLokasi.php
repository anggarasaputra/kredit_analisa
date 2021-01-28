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

use Thunderlabid\Pengajuan\Models\Pengajuan;
use Thunderlabid\Survei\Models\SurveiLokasi;

class UpdateSurveiLokasi
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
		
		$find 	= Pengajuan::where('id', $model->pengajuan_id)->first();

		//hapus semua
		// $prev_survei 	= SurveiLokasi::where('survei_id', $model->id)->delete();

		$alamat_nasabah 	= implode(' ', $find->nasabah['alamat']);

		$sl_nasabah 		= SurveiLokasi::where('survei_id', $model->id)
		->where('kelurahan', $find->nasabah['alamat']['kelurahan'])
		->where('kecamatan', $find->nasabah['alamat']['kecamatan'])
		->where('kota', $find->nasabah['alamat']['kota'])
		->where('agenda', 'nasabah')
		->where('alamat', $alamat_nasabah)
		->where('nama', $find->nasabah['nama'])
		->where('telepon', $find->nasabah['telepon'])->first();

		if(!$sl_nasabah)
		{
			$prev_survei 	= SurveiLokasi::where('survei_id', $model->id)->where('agenda', 'nasabah')->delete();
			$sl_nasabah 	= new SurveiLokasi;
		}

		$sl_nasabah->survei_id		= $model->id;
		$sl_nasabah->kelurahan 		= $find->nasabah['alamat']['kelurahan'];
		$sl_nasabah->kecamatan 		= $find->nasabah['alamat']['kecamatan'];
		$sl_nasabah->kota 			= $find->nasabah['alamat']['kota'];
		$sl_nasabah->agenda 		= 'nasabah';
		$sl_nasabah->alamat 		= $alamat_nasabah;
		$sl_nasabah->nama 			= $find->nasabah['nama'];
		$sl_nasabah->telepon 		= $find->nasabah['telepon'];
		$sl_nasabah->save();
		$bobot 						= 0;

		foreach ($find->jaminan_tanah_bangunan as $key => $value) {
			$alamat_tb 	= implode(' ', $value->dokumen_jaminan[$value['jenis']]['alamat']);
			$all_sl 	= SurveiLokasi::where('survei_id', $model->id)->get();
			foreach ($all_sl as $ksl => $vsl) {
				similar_text($vsl->alamat, $alamat_tb, $percent);
				$bobot 	= max($bobot, $percent);
			}

			if($percent < 85)
			{
				$survei_lokasi 		= SurveiLokasi::where('survei_id', $model->id)
				->where('kelurahan', $value->dokumen_jaminan[$value['jenis']]['alamat']['kelurahan'])
				->where('kecamatan', $value->dokumen_jaminan[$value['jenis']]['alamat']['kecamatan'])
				->where('kota', $value->dokumen_jaminan[$value['jenis']]['alamat']['kota'])
				->where('agenda', 'jaminan')
				->where('alamat', $alamat_tb)
				->where('nama', $find->nasabah['nama'])
				->where('telepon', $find->nasabah['telepon'])->first();

				if(!$survei_lokasi)
				{
					$prev_survei 	= SurveiLokasi::where('survei_id', $model->id)->where('agenda', 'jaminan')->delete();
					$survei_lokasi 	= new SurveiLokasi;
				}

				$survei_lokasi->survei_id		= $model->id;
				$survei_lokasi->kelurahan 		= $value->dokumen_jaminan[$value['jenis']]['alamat']['kelurahan'];
				$survei_lokasi->kecamatan 		= $value->dokumen_jaminan[$value['jenis']]['alamat']['kecamatan'];
				$survei_lokasi->kota 			= $value->dokumen_jaminan[$value['jenis']]['alamat']['kota'];
				$survei_lokasi->alamat 			= $alamat_tb;
				$survei_lokasi->agenda 			= 'jaminan';
				$survei_lokasi->nama 			= $find->nasabah['nama'];
				$survei_lokasi->telepon 		= $find->nasabah['telepon'];
				$survei_lokasi->save();
			}
		}
	}
}