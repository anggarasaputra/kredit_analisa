<?php

namespace App\Http\Controllers\Pengajuan;

use App\Http\Controllers\Controller;

use Thunderlabid\Pengajuan\Models\Status;
use Thunderlabid\Pengajuan\Models\Putusan;

use Exception, Auth;
use Carbon\Carbon;

class RealisasiController extends Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->middleware('scope:realisasi');
	}

	public function done($id)
	{
		try {
			$putusan 		= Putusan::where('pengajuan_id', $id)->wherehas('pengajuan', function($q){$q->where('kode_kantor', request()->get('kantor_aktif_id'));})->orderby('tanggal', 'desc')->first();

			if(!$putusan)
			{
				throw new Exception("Tidak dapat realisasi dokumen yang belum diputuskan", 1);
			}

			$status 				= new Status;
			$status->tanggal 		= Carbon::now()->format('d/m/Y H:i');
			$status->progress 		= 'sudah';
			$status->status 		= 'realisasi';
			$status->karyawan 		= ['nip' => Auth::user()['nip'], 'nama' => Auth::user()['nama']];
			$status->pengajuan_id 	= $id;
			$status->save();

			return redirect(route('pengajuan.pengajuan.show', ['id' => $id, 'kantor_aktif_id' => request()->get('kantor_aktif_id'), 'status' => 'realisasi']));

		} catch (Exception $e) {
			return redirect()->back()->withErrors($e->getMessage());
		}
	}
}
