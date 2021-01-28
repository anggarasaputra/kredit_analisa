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
use Thunderlabid\Survei\Models\SurveiDetail;

class CreateCollateralSurveiDetail
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

		$pengajuan 	= Pengajuan::where('p_pengajuan.id', $model->pengajuan_id)->with(['jaminan_kendaraan', 'jaminan_tanah_bangunan'])->first();

		$model->details()->delete();

		//save jaminan kendaraan 
		foreach ($pengajuan['jaminan_kendaraan'] as $key => $value) {
			$isi['survei_id']	= $model->id;
			$isi['jenis']		= 'collateral';
			$isi['dokumen_survei']['collateral']['jenis']				= $value['jenis'];
			$isi['dokumen_survei']['collateral']['bpkb']['jenis']		= $value['dokumen_jaminan']['bpkb']['jenis'];
			$isi['dokumen_survei']['collateral']['bpkb']['merk']		= $value['dokumen_jaminan']['bpkb']['merk'];
			$isi['dokumen_survei']['collateral']['bpkb']['tipe']		= $value['dokumen_jaminan']['bpkb']['tipe'];
			$isi['dokumen_survei']['collateral']['bpkb']['tahun']		= $value['dokumen_jaminan']['bpkb']['tahun'];
			$isi['dokumen_survei']['collateral']['bpkb']['nomor_bpkb']	= $value['dokumen_jaminan']['bpkb']['nomor_bpkb'];

			SurveiDetail::create($isi);
		}
	
		//save jaminan tanah bangunan 
		foreach ($pengajuan['jaminan_tanah_bangunan'] as $key => $value) {
			$isi['survei_id']	= $model->id;
			$isi['jenis']		= 'collateral';
			$isi['dokumen_survei']['collateral']['jenis']					= $value['jenis'];
			$isi['dokumen_survei']['collateral'][$value['jenis']]['tipe']	= $value['dokumen_jaminan'][$value['jenis']]['tipe'];
			$isi['dokumen_survei']['collateral'][$value['jenis']]['nomor_sertifikat']	= $value['dokumen_jaminan'][$value['jenis']]['nomor_sertifikat'];
			$isi['dokumen_survei']['collateral'][$value['jenis']]['luas_tanah']			= $value['dokumen_jaminan'][$value['jenis']]['luas_tanah'];

			if($isi['dokumen_survei']['collateral'][$value['jenis']]['tipe']=='tanah_dan_bangunan'){
				$isi['dokumen_survei']['collateral'][$value['jenis']]['luas_bangunan']		= $value['dokumen_jaminan'][$value['jenis']]['luas_bangunan'];
			}
			
			if($value['jenis']=='shgb'){
				$isi['dokumen_survei']['collateral'][$value['jenis']]['masa_berlaku_sertifikat']	= $value['dokumen_jaminan'][$value['jenis']]['masa_berlaku_sertifikat'];
			}

			$isi['dokumen_survei']['collateral'][$value['jenis']]['alamat']	= $value['dokumen_jaminan'][$value['jenis']]['alamat'];

			SurveiDetail::create($isi);
		}
	}
}