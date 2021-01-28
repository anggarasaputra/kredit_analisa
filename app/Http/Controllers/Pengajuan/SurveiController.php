<?php

namespace App\Http\Controllers\Pengajuan;

use App\Http\Controllers\Controller;

use Thunderlabid\Pengajuan\Models\Pengajuan;
use Thunderlabid\Survei\Models\Survei;
use Thunderlabid\Survei\Models\SurveiDetail;
use Thunderlabid\Survei\Models\SurveiLokasi;

use Exception, Auth, Validator;
use Carbon\Carbon;

use Thunderlabid\Survei\Traits\IDRTrait;

use Thunderlabid\Manajemen\Models\PenempatanKaryawan;

class SurveiController extends Controller
{
	use IDRTrait;

	protected $view_dir = 'pengajuan.survei.';

	public function __construct()
	{
		parent::__construct();

		$this->middleware('scope:operasional.survei')->only(['index', 'show']);
		$this->middleware('scope:survei')->only(['store', 'update', 'assign_survei']);

		$this->middleware('required_passcode')->only(['store', 'update']);
	}

	public function index ($status = 'survei') 
	{
		$penempatan 	= PenempatanKaryawan::where('kantor_id', request()->get('kantor_aktif_id'))->where('orang_id', Auth::user()['id'])->active(Carbon::now())->first();

		if(str_is($penempatan['role'], 'komisaris') || str_is($penempatan['role'], 'pimpinan') || in_array('operasional', $penempatan['scopes']))
		{
			$kecamatan 	= SurveiLokasi::whereHas('survei', function($q){
								$q->where('kode_kantor', request()->get('kantor_aktif_id'));
							})->wherenotnull('kota')->wherenotnull('kecamatan')
							->select('kota', 'kecamatan')->selectraw('count(id) as total')
							->orderby('kota', 'asc')->groupby('kota', 'kecamatan')->get();

			$survei 	= SurveiLokasi::whereHas('survei', function($q){
								$q->where('kode_kantor', request()->get('kantor_aktif_id'));
							})->wherenotnull('kota')->wherenotnull('kecamatan');
		}
		else
		{
			$kecamatan 	= SurveiLokasi::whereHas('survei', function($q){
								$q->where('kode_kantor', request()->get('kantor_aktif_id'));
							})->whereHas('survei.surveyor', function($q){
								$q->where('nip', Auth::user()['nip']);
							})->wherenotnull('kota')->wherenotnull('kecamatan')
							->select('kota', 'kecamatan')->selectraw('count(id) as total')
							->orderby('kota', 'asc')->groupby('kota', 'kecamatan')->get();

			$survei 	= SurveiLokasi::whereHas('survei', function($q){
								$q->where('kode_kantor', request()->get('kantor_aktif_id'));
							})->whereHas('survei.surveyor', function($q){
								$q->where('nip', Auth::user()['nip']);
							})->wherenotnull('kota')->wherenotnull('kecamatan');
		}
		

		if(request()->has('kota'))
		{
			$survei = $survei->where('kota', 'like', request()->get('kota'));
		}

		if(request()->has('kecamatan'))
		{
			$survei = $survei->where('kecamatan', 'like', request()->get('kecamatan'));
		}

		if(count($kecamatan) > 23)
		{
			$take 	= 15;
		}
		else
		{
			$take 	= 12;
		}

		$survei 	= $survei->with(['survei'])->orderby('created_at', 'desc')->paginate($take);

		view()->share('survei', $survei);
		view()->share('status', $status);
		view()->share('order', $order);
		view()->share('kantor_aktif_id', request()->get('kantor_aktif_id'));

		$this->layout->pages 	= view($this->view_dir . 'index', compact('kecamatan'));
		return $this->layout;
	}

	public function store($id = null)
	{
		try {
			$survei 			= Survei::where('id', $id)->wherehas('pengajuan', function($q){$q->where('kode_kantor', request()->get('kantor_aktif_id'));})->with(['character', 'condition', 'capacity', 'capital', 'collateral'])->orderby('tanggal', 'desc')->first();

			if(!$survei)
			{
				throw new Exception("Dokumen ini tidak diijinkan untuk survei", 1);
			}
			if(request()->has('tanggal_survei'))
			{
				$survei->tanggal 	= request()->get('tanggal_survei');
				$survei->save();
			}

			if(request()->has('character'))
			{
				$character 			= SurveiDetail::where('survei_id', $id)->where('jenis', 'character')->first();
				if(!$character){
					$character 		= new SurveiDetail;
				}

				$character->survei_id 		= $id;
				$character->jenis 			= 'character';
				$character->dokumen_survei 	= request()->only('character');
				$character->save();
			}
	
			if(request()->has('condition'))
			{
				$condition 					= SurveiDetail::where('survei_id', $id)->where('jenis', 'condition')->first();
				if(!$condition){
					$condition 				= new SurveiDetail;
				}

				$condition->survei_id 		= $id;
				$condition->jenis 			= 'condition';
				$ds_condition 				= request()->only('condition');
				$ds_condition['condition']['pekerjaan'] 	= $survei->pengajuan->nasabah['pekerjaan'];
				$ds_condition 				= array_map('array_filter', $ds_condition);;
				$condition->dokumen_survei 	= $ds_condition;
				$condition->save();
			}

			if(request()->has('capacity'))
			{
				$capacity 					= SurveiDetail::where('survei_id', $id)->where('jenis', 'capacity')->first();
				if(!$capacity){
					$capacity 				= new SurveiDetail;
				}

				$capacity->survei_id 		= $id;
				$capacity->jenis 			= 'capacity';
				$ds_capacity 			 	= request()->only('capacity');
				$sp 						= strtolower($ds_capacity['capacity']['status_pernikahan']);

				if(str_is($sp, 'tk')){
					$ds_capacity['capacity']['tanggungan_keluarga']	= $this->formatMoneyTo(1500000);
				}elseif(str_is($sp, 'k')){
					$ds_capacity['capacity']['tanggungan_keluarga']	= $this->formatMoneyTo(3000000);
				}else{
					$anak 					= str_replace('k-', '', $sp) * 1;
					$ds_capacity['capacity']['tanggungan_keluarga']	= $this->formatMoneyTo(3000000 + ($anak * 1250000));
				}
				$ds_capacity['capacity']['pekerjaan'] 	= $survei->pengajuan->nasabah['pekerjaan'];

				$capacity->dokumen_survei 	= $ds_capacity;
				$capacity->save();
			}

			if(request()->has('capital'))
			{
				$capital 					= SurveiDetail::where('survei_id', $id)->where('jenis', 'capital')->first();
				if(!$capital){
					$capital 				= new SurveiDetail;
				}

				$capital->survei_id 		= $id;
				$capital->jenis 			= 'capital';
				$ds_capital 				= request()->only('capital');
				$ds_capital['capital']['pekerjaan'] 	= $survei->pengajuan->nasabah['pekerjaan'];
				$ds_capital 				= array_map('array_filter', $ds_capital);;
				$capital->dokumen_survei 	= $ds_capital;
				$capital->save();
			}

			if(request()->has('collateral'))
			{
				$collateral 				= SurveiDetail::where('survei_id', $id)->where('id', request()->get('survei_detail_id'))->where('jenis', 'collateral')->first();
				if(!$collateral){
					throw new Exception("Jaminan tidak terdaftar!", 1);
				}

				$collateral->survei_id 		= $id;
				$collateral->jenis 			= 'collateral';
				$key 	= key(request()->get('collateral')[request()->get('survei_detail_id')]);

				$ds_all = $collateral->dokumen_survei;
				$ds		= array_merge($collateral->dokumen_survei['collateral'][$key], request()->get('collateral')[request()->get('survei_detail_id')][$key]);

				$ds_all['collateral'][$key] = $ds;

				if($key=='bpkb')
				{
					$ds_all['collateral'][$key]['harga_taksasi']	= $this->formatMoneyTo($this->formatMoneyFrom($ds_all['collateral'][$key]['nilai_kendaraan']) * ($ds_all['collateral'][$key]['persentasi_taksasi']/100));
					$ds_all['collateral'][$key]['harga_bank']		= $this->formatMoneyTo($this->formatMoneyFrom($ds_all['collateral'][$key]['nilai_kendaraan']) * ($ds_all['collateral'][$key]['persentasi_bank']/100));
				}else{
					$nilai_t 	= $this->formatMoneyFrom($ds_all['collateral'][$key]['nilai_tanah']); 
					if(isset($ds_all['collateral'][$key]['nilai_bangunan'])){
						$nilai_b 	= $this->formatMoneyFrom($ds_all['collateral'][$key]['nilai_bangunan']); 
					}else{
						$nilai_b 	= 0;
					}
					$ds_all['collateral'][$key]['harga_taksasi']	= $this->formatMoneyTo(($nilai_b + $nilai_t) * ($ds_all['collateral'][$key]['persentasi_taksasi']/100));
				}
				$collateral->dokumen_survei = $ds_all;
				$collateral->save();
			}

			return redirect(route('pengajuan.survei.show', ['id' => request()->get('lokasi_id'), 'kantor_aktif_id' => request()->get('kantor_aktif_id'), 'status' => 'survei']));
		} catch (Exception $e) {
			foreach ($e->getMessage()->toarray() as $k => $v) {
				$exp 	= explode('.', $k);

				if(request()->has('collateral'))
				{
					if(count($exp) ==4)
					{
						$msg[$exp[1].'['.request()->get('survei_detail_id').']['.$exp[2].']['.$exp[3].']'] 	= $v;
					}
					elseif(count($exp) ==3)
					{
						$msg[$exp[1].'['.request()->get('survei_detail_id').']['.$exp[2].']'] 	= $v;
					}
					elseif(count($exp) ==2)
					{
						$msg[$exp[1].'['.request()->get('survei_detail_id').']'] 	= $v;
					}
					else
					{
						$msg[$exp[0].'['.request()->get('survei_detail_id').']'] 	= $v;
					}
				}
				else
				{
					if(count($exp) ==4)
					{
						$msg[$exp[1].'['.$exp[2].']['.$exp[3].']'] 	= $v;
					}
					elseif(count($exp) ==3)
					{
						$msg[$exp[1].'['.$exp[2].']'] 	= $v;
					}
					elseif(count($exp) ==2)
					{
						$msg[$exp[1]] 	= $v;
					}
					else
					{
						$msg[$exp[0]] = $v;
					}
				}
			}
			return redirect()->back()->withErrors($msg);
		}

	}

	public function update($id)
	{
		return $this->store($id);
	}

	public function show($id, $status = 'survei')
	{
		try {
			$penempatan 	= PenempatanKaryawan::where('kantor_id', request()->get('kantor_aktif_id'))->where('orang_id', Auth::user()['id'])->active(Carbon::now())->first();

			if(str_is($penempatan['role'], 'komisaris') || str_is($penempatan['role'], 'pimpinan') || in_array('operasional', $penempatan['scopes']))
			{
				$lokasi 	= SurveiLokasi::whereHas('survei', function($q){
						$q->where('kode_kantor', request()->get('kantor_aktif_id'));
					})->where('id', $id)->first();
			}else{
				$lokasi 	= SurveiLokasi::whereHas('survei', function($q){
						$q->where('kode_kantor', request()->get('kantor_aktif_id'));
					})->whereHas('survei.surveyor', function($q){
						$q->where('nip', Auth::user()['nip']);
					})->where('id', $id)->first();
			}

			$survei 		= Survei::where('id', $lokasi['survei_id'])->orderby('tanggal', 'desc')->with(['character', 'condition', 'capacity', 'capital', 'jaminan_kendaraan', 'jaminan_tanah_bangunan', 'surveyor', 'jaminan_kendaraan.foto', 'jaminan_tanah_bangunan.foto'])->first()->toArray();

			$permohonan 	= Pengajuan::where('id', $survei['pengajuan_id'])->with(['jaminan_kendaraan', 'jaminan_tanah_bangunan'])->first();

			$breadcrumb 	= [
				[
					'title'	=> $status,
					'route' => route('pengajuan.survei.index', ['status' => $status, 'kantor_aktif_id' => request()->get('kantor_aktif_id')])
				], 
				[
					'title'	=> 'Kredit '.$survei['pengajuan_id'],
					'route' => route('pengajuan.survei.index', ['status' => $status, 'id' => $id, 'kantor_aktif_id' => request()->get('kantor_aktif_id')])
				]
			];

			$checker 	= [];
			$complete 	= 0;
			$total 		= 0;

			//checker character
			$c_char 	= SurveiDetail::rule_of_valid_character();
			$total 		= $total + count($c_char);

			if(count($survei['character']))
			{
				$validator 	= Validator::make($survei['character']['dokumen_survei']['character'], $c_char);
				if ($validator->fails())
				{
					$complete 				= $complete + (count($c_char) - count($validator->messages()));
					$checker['character'] 	= false;
				}
				else
				{
					$complete 				= $complete + count($c_char);
					$checker['character'] 	= true;
				}
			}
			else
			{
				$checker['character'] 		= false;
			}

			//checker condition
			$c_cond 	= SurveiDetail::rule_of_valid_condition();
			$total 		= $total + count($c_cond);

			if(count($survei['condition']))
			{
				$validator 	= Validator::make($survei['condition']['dokumen_survei']['condition'], $c_cond);
				if ($validator->fails())
				{
					$complete 				= $complete + (count($c_cond) - count($validator->messages()));
					$checker['condition'] 	= false;
				}
				else
				{
					$complete 				= $complete + count($c_cond);
					$checker['condition'] 	= true;
				}
			}
			else
			{
				$checker['condition'] 		= false;
			}

			//checker capital
			$c_capi 	= SurveiDetail::rule_of_valid_capital();
			$total 		= $total + count($c_capi);

			if(count($survei['capital']))
			{
				$validator 	= Validator::make($survei['capital']['dokumen_survei']['capital'], $c_capi);
				if ($validator->fails())
				{
					$complete 				= $complete + (count($c_capi) - count($validator->messages()));
					$checker['capital'] 	= false;
				}
				else
				{
					$complete 				= $complete + count($c_capi);
					$checker['capital'] 	= true;
				}
			}
			else
			{
				$checker['capital'] 		= false;
			}

			//checker capacity
			$c_capa 	= SurveiDetail::rule_of_valid_capacity();
			$total 		= $total + count($c_capa);

			if(count($survei['capacity']))
			{
				$validator 	= Validator::make($survei['capacity']['dokumen_survei']['capacity'], $c_capa);
				if ($validator->fails())
				{
					$complete 				= $complete + (count($c_capa) - count($validator->messages()));
					$checker['capacity'] 	= false;
				}
				else
				{
					$complete 				= $complete + count($c_capa);
					$checker['capacity'] 	= true;
				}
			}
			else
			{
				$checker['capacity'] 		= false;
			}

			//checker collateral
			if(count($survei['jaminan_kendaraan'])){
				foreach ($survei['jaminan_kendaraan'] as $k => $v) {
					$c_col 		= SurveiDetail::rule_of_valid_collateral_bpkb();
					$total 		= $total + count($c_col);
					$v['dokumen_survei']['collateral'][$v['dokumen_survei']['collateral']['jenis']]['has_foto']	= $v['has_foto'];

					$validator 	= Validator::make($v['dokumen_survei']['collateral']['bpkb'], $c_col);
					if ($validator->fails())
					{
						$complete 				= $complete + (count($c_col) - count($validator->messages()));
						$checker['collateral'] 	= false;
						$survei['jaminan_kendaraan'][$k]['is_lengkap'] = false;
					}
					else
					{
						$complete 				= $complete + count($c_col);
						if(is_null($checker['collateral']) || $checker['collateral'])
						{
							$checker['collateral'] 	= true;
						}
						$survei['jaminan_kendaraan'][$k]['is_lengkap'] = true;
					}
				}
			}

			if(count($survei['jaminan_tanah_bangunan'])){
				foreach ($survei['jaminan_tanah_bangunan'] as $k => $v) {
					$c_col 		= SurveiDetail::rule_of_valid_collateral_sertifikat($v['dokumen_survei']['collateral']['jenis'], $v['dokumen_survei']['collateral'][$v['dokumen_survei']['collateral']['jenis']]['tipe']);
					$total 		= $total + count($c_col);

					$v['dokumen_survei']['collateral'][$v['dokumen_survei']['collateral']['jenis']]['has_foto']	= $v['has_foto'];
					$validator 	= Validator::make($v['dokumen_survei']['collateral'][$v['dokumen_survei']['collateral']['jenis']], $c_col);
					if ($validator->fails())
					{
						$complete 				= $complete + (count($c_col) - count($validator->messages()));
						$checker['collateral'] 	= false;
						$survei['jaminan_tanah_bangunan'][$k]['is_lengkap'] = false;
					}
					else
					{
						$complete 				= $complete + count($c_col);
						if(is_null($checker['collateral']) || $checker['collateral'])
						{
							$checker['collateral'] 	= true;
						}
						$survei['jaminan_tanah_bangunan'][$k]['is_lengkap'] = true;
					}
				}
			}
			
			$percentage 	= floor(($complete / max($total, 1)) * 100);
			
			view()->share('kantor_aktif_id', request()->get('kantor_aktif_id'));
			view()->share('breadcrumb', $breadcrumb);
			view()->share('status', $status);

			$this->layout->pages 	= view('pengajuan.survei.show', compact('survei', 'lokasi', 'checker', 'percentage', 'permohonan'));
			return $this->layout;

		} catch (Exception $e) {
			return redirect(route('pengajuan.survei.index', ['status' => $status, 'kantor_aktif_id' => request()->get('kantor_aktif_id')]))->withErrors($e->getMessage());
		}
	}

	public function assign_survei($id = null)
	{
		try {
			$permohonan		= Pengajuan::where('p_pengajuan.id', $id)->status('permohonan')->kantor(request()->get('kantor_aktif_id'))->first();

			if(!$permohonan)
			{
				throw new Exception("Permohonan Kredit tidak ditemukan", 1);
			}

			DB::BeginTransaction();

			$survei 				= new Survei;
			$survei->pengajuan_id 	= $permohonan['id'];
			$survei->kode_kantor 	= $permohonan['kode_kantor'];
			$survei->tanggal 		= Carbon::now()->format('d/m/Y H:i');
			$survei->save();
			foreach (request()->get('surveyor')['nip'] as $k => $v) {
				$assign_survei 				= new AssignedSurveyor;
				$assign_survei->survei_id 	= $survei->id;
				$assign_survei->nip			= $v;
				$assign_survei->nama		= Orang::where('nip', $v)->first()['nama'];
				$assign_survei->save();
			}

			DB::commit();
			return redirect(route('pengajuan.permohonan.index', ['kantor_aktif_id' => request()->get('kantor_aktif_id'), 'status' => 'permohonan']));
		} catch (Exception $e) {
			DB::rollback();
			return redirect()->back()->withErrors($e->getMessage());
		}
 	}
}
