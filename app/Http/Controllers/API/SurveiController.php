<?php

namespace App\Http\Controllers\API;

use Illuminate\Routing\Controller as BaseController;

use Thunderlabid\Pengajuan\Models\Pengajuan;

use Thunderlabid\Survei\Models\Survei;
use Thunderlabid\Survei\Models\SurveiDetail;
use Thunderlabid\Survei\Models\SurveiFoto;

use Thunderlabid\Manajemen\Models\Orang;
use Thunderlabid\Manajemen\Models\PenempatanKaryawan;

use Exception, Response, Carbon\Carbon;

class SurveiController extends BaseController
{
	public function simpan_foto($pengajuan_id, $survei_detail_id)
	{
		try {
			//1. find latest survei
			if(request()->has('nip_karyawan'))
			{
				$survei			= Survei::where('pengajuan_id', $pengajuan_id)->orderby('tanggal', 'desc')->first();
				$survei_detail 	= SurveiDetail::where('survei_id', $survei['id'])->where('id', $survei_detail_id)->firstorfail();

				$fotos 		= request()->get('foto');

				$s_foto 	= SurveiFoto::where('survei_detail_id', $survei_detail_id)->first();

				if(!$s_foto)
				{
					$s_foto = new SurveiFoto;
				}

				$s_foto->survei_detail_id 	= $survei_detail_id;
				$s_foto->arsip_foto 		= $fotos;
				$s_foto->save();
			}

			return Response::json(['status' => 1, 'data' => []]);
		} catch (Exception $e) {
			return Response::json(['status' => 0, 'data' => [], 'pesan' => $e->getMessage()]);
		}
	}

	public function index()
	{
		try {
			//1. find pengajuan
			//check kalau karyawan itu komisaris
			if(request()->has('nip_karyawan')){
				$user 			= Orang::where('nip', request()->get('nip_karyawan'))->first();

				$penempatan 	= PenempatanKaryawan::where('orang_id', $user['id'])->active(Carbon::now())->first();

				if(str_is($penempatan['role'], 'komisaris') || str_is($penempatan['role'], 'pimpinan'))
				{
					$pengajuan	= Survei::where('kode_kantor', $penempatan['kantor_id'])->wherehas('pengajuan', function($q){$q->status('survei');})->wherehas('collateral', function($q){$q->wheredoesnthave('foto', function($q){$q;});})->with(['collateral', 'collateral.foto'])->get();
				}else{
					$pengajuan	= Survei::wherehas('pengajuan', function($q){$q->status('survei');})->whereHas('surveyor', function($q){$q->where('nip', request()->get('nip_karyawan'));})->wherehas('collateral', function($q){$q->wheredoesnthave('foto', function($q){$q;});})->with(['collateral', 'collateral.foto'])->get();
				}
			}
			else{
				throw new Exception("Harus login sebagai karyawan", 1);
			}

			return Response::json(['status' => 1, 'data' => $pengajuan->toArray()]);

		} catch (Exception $e) {
			return Response::json(['status' => 0, 'data' => [], 'pesan' => $e->getMessage()]);
		}
	}
}
