<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Thunderlabid\Manajemen\Models\Kantor;
use Thunderlabid\Manajemen\Models\PenempatanKaryawan;

use Thunderlabid\Log\Models\Kredit;
use Thunderlabid\Pengajuan\Models\Pengajuan;

use Auth;
use Carbon\Carbon;

class Controller extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	function __construct()
	{
		$this->me 		= Auth::user();
		$hari_ini 		= Carbon::now();

		//GET PILIHAN KANTOR
		$this->kantor 		= Kantor::wherehas('penempatan', function($q)use($hari_ini){$q->where('orang_id', $this->me['id'])->active($hari_ini);})->get(['id', 'nama', 'jenis', 'tipe']);

		$this->kantor_aktif	= Kantor::find(request()->get('kantor_aktif_id'));
		$this->scopes 		= PenempatanKaryawan::where('orang_id', $this->me['id'])->active($hari_ini)->where('kantor_id', request()->get('kantor_aktif_id'))->first();

		//////////////////
		// General Info //
		//////////////////
		view()->share('me', $this->me);
		view()->share('kantor', $this->kantor);
		view()->share('kantor_aktif', $this->kantor_aktif);
		view()->share('scopes', $this->scopes);

		$this->layout 	= view('templates.html.layout');
		$this->layout->html['title'] = 'GO-KREDIT.COM';
	}
	
	protected function riwayat_kredit_nasabah($nik, $id)
	{
		if(is_null($nik))
		{
			return [];
		}
		
		$k_ids	= array_column(Kredit::where('nasabah_id', $nik)->where('pengajuan_id', '<>', $id)->get()->toArray(), 'pengajuan_id');

		return Pengajuan::wherein('id', $k_ids)->get();
	}

	protected function riwayat_kredit_jaminan($kendaraan, $tanah_bangunan, $id)
	{
		$w_id 	= [];

		foreach ($kendaraan as $key => $value) {
			$w_id[] = $value['dokumen_jaminan']['bpkb']['nomor_bpkb'];
		}

		$w_id  		= array_unique($w_id);
		$k_ids_1	= array_column(Kredit::whereIn('jaminan_id', $w_id)->where('jaminan_tipe', 'bpkb')->where('pengajuan_id', '<>', $id)->get(['pengajuan_id'])->toArray(), 'pengajuan_id');

		foreach ($tanah_bangunan as $key => $value) {
			$w_id[] = $value['dokumen_jaminan'][$value['jenis']]['nomor_sertifikat'];
		}
		$w_id 	 	= array_unique($w_id);
		$k_ids_2	= array_column(Kredit::whereIn('jaminan_id', $w_id)->whereIn('jaminan_tipe', ['shgb', 
			'shm'])->where('pengajuan_id', '<>', $id)->get(['pengajuan_id'])->toArray(), 'pengajuan_id');

		$k_ids 		= array_unique(array_merge($k_ids_1, $k_ids_2));

		return Pengajuan::wherein('id', $k_ids)->get();
	}

}
