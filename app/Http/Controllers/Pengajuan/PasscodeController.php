<?php

namespace App\Http\Controllers\Pengajuan;

use App\Http\Controllers\Controller;

use Thunderlabid\Survei\Models\Survei;
use Thunderlabid\Survei\Models\SurveiPasscode;

use Exception, Auth;
use Carbon\Carbon;

use Thunderlabid\Pengajuan\Traits\IDRTrait;

class PasscodeController extends Controller
{
	use IDRTrait;

	public function __construct()
	{
		parent::__construct();

		$this->middleware('scope:passcode');

		$this->middleware('required_password')->only('store');
	}

	public function index () 
	{
		$order 		= 'Tanggal ';
		$urut 		= 'asc';

		if (request()->has('order'))
		{
			list($field, $urut) 	= explode('-', request()->get('order'));
		}

		if (str_is($urut, 'asc'))
		{
			$order 	= $order.' terbaru';
		}
		else
		{
			$order 	= $order.' terlama';
		}

		$passcode 				= SurveiPasscode::wherehas('survei', function($q){$q->where('kode_kantor', request()->get('kantor_aktif_id'));})->where('expired_at', '>', Carbon::now()->format('Y-m-d H:i:s'))->with(['survei', 'survei.pengajuan']);

		if(request()->has('q'))
		{
			$cari 		= request()->get('q');
			$passcode	= $passcode->wherehas('survei.pengajuan', function($q)use($cari){$q
							->where('nasabah->nama', 'like', '%'.$cari.'%')
							->orwhere('p_pengajuan.id', 'like', '%'.$cari.'%');});
		}
		
		$passcode 		= $passcode->paginate();

		view()->share('passcode', $passcode);
		view()->share('order', $order);
		view()->share('kantor_aktif_id', request()->get('kantor_aktif_id'));

		$this->layout->pages 	= view('pengajuan.passcode.index');
		return $this->layout;
	}

	public function store($id = null)
	{
		try {
			$survei 	= Survei::where('pengajuan_id', request()->get('pengajuan_id'))->where('kode_kantor', request()->get('kantor_aktif_id'))->orderby('tanggal', 'desc')->first();

			$passcode 				= new SurveiPasscode;
			$passcode->survei_id 	= $survei['id'];
			$passcode->passcode 	= $this->generatePasscode();
			$passcode->expired_at 	= Carbon::now()->addHours(2)->format('d/m/Y H:i');
			$passcode->save();

			return redirect(route('pengajuan.passcode.index', ['kantor_aktif_id' => request()->get('kantor_aktif_id')]));
		} catch (Exception $e) {
			return redirect()->back()->withErrors($e->getMessage());
		}
	}

	private function generatePasscode($length = 8){
		$str = '';

		do {
			if(rand(0,1)){
				$str 	= $str.strtoupper(chr(rand(97,122)));
			}
			else{
				$str 	= $str.rand(0,9);
			}
			$length = $length - 1;
		} while ($length > 0);

		return $str;
	}
}
