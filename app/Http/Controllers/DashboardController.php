<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;

use Thunderlabid\Manajemen\Models\PenempatanKaryawan;

use App\Http\Service\Policy\PerhitunganBunga;

class DashboardController extends Controller
{
	public function home() 
	{
		$hari_ini 			= Carbon::now();
		$is_holder			= false;
		$holder_scopes		= [];

		foreach ($this->kantor as $key => $value) {
			if($value['tipe']=='holding'){
				$is_holder 		= true;
				$holder_scopes	= PenempatanKaryawan::where('orang_id', $this->me['id'])->active($hari_ini)->where('kantor_id', $value['id'])->first();
			}
		}
		//atur menu scopes
		view()->share('kantor_aktif_id', request()->get('kantor_aktif_id'));
		
		$this->layout->pages 	= view('dashboard.overview', compact('is_holder', 'holder_scopes'));
		return $this->layout;
	}

	public function simulasi($mode) 
	{
		//atur menu scopes
		view()->share('kantor_aktif_id', request()->get('kantor_aktif_id'));

		$rincian 	= [];

		if(request()->has('pokok_pinjaman'))
		{
			if($mode=='pa')
			{
				$rincian 	= new PerhitunganBunga(request()->get('pokok_pinjaman'), request()->get('kemampuan_angsur'), request()->get('bunga_per_tahun')/12);
				$rincian 	= $rincian->pa();
			}
			elseif($mode=='pt')
			{
				$rincian 	= new PerhitunganBunga(request()->get('pokok_pinjaman'), request()->get('kemampuan_angsur'), request()->get('bunga_per_tahun')/6);
				$rincian 	= $rincian->pt();
			}
		}
		
		$this->layout->pages 	= view('dashboard.simulasi', compact('mode', 'rincian'));
		return $this->layout;
	}

	public function pilih_koperasi(){
		$url 	= request()->get('prev_url');

		return view('dashboard.koperasi', compact('url'));
	}
}
