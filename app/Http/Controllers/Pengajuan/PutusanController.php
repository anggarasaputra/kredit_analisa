<?php

namespace App\Http\Controllers\Pengajuan;

use App\Http\Controllers\Controller;

use Thunderlabid\Pengajuan\Models\Pengajuan;
use Thunderlabid\Pengajuan\Models\Putusan;

use Thunderlabid\Survei\Models\Survei;

use Thunderlabid\Manajemen\Models\PenempatanKaryawan;

use Exception, Auth, Validator;
use Carbon\Carbon;

use Thunderlabid\Pengajuan\Traits\IDRTrait;

class PutusanController extends Controller
{
	use IDRTrait;

	public function __construct()
	{
		parent::__construct();

		$this->middleware('scope:operasional.putusan')->only(['index', 'show']);
		$this->middleware('scope:putusan')->only(['store', 'update']);
	}

	public function index ($status = ['putusan', 'setuju', 'tolak']) 
	{
		$order 		= 'Tanggal ';
		$urut 		= 'asc';

		$penempatan 		= PenempatanKaryawan::where('kantor_id', request()->get('kantor_aktif_id'))->where('orang_id', Auth::user()['id'])->active(Carbon::now())->first();

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

		$pengajuan 				= Pengajuan::status($status)->kantor(request()->get('kantor_aktif_id'))->with(['status_terakhir', 'jaminan_kendaraan', 'jaminan_tanah_bangunan', 'status_permohonan', 'putusan']);

		if (request()->has('q'))
		{
			$cari 				= request()->get('q');
			$pengajuan 			= $pengajuan->where(function($q)use($cari)
			{				
							$q
							// ->whereRaw('lower(nasabah) like ?', '%'.$cari.'%')
							->where('nasabah->nama', 'like', '%'.$cari.'%')
							->orwhere('id', 'like', '%'.$cari.'%');
			});
		}

		if(str_is($penempatan['role'], 'komisaris') || str_is($penempatan['role'], 'pimpinan') || in_array('operasional', $penempatan['scopes']))
		{
			$pengajuan 			= $pengajuan->whereIn('p_status.progress', ['perlu', 'sedang', 'sudah']);
		}
		else
		{
			$pengajuan 			= $pengajuan->whereIn('p_status.progress', ['sudah']);
		}

		$pengajuan 				= $pengajuan->orderby('p_pengajuan.created_at', $urut)->paginate();

		view()->share('pengajuan', $pengajuan);
		view()->share('status', 'putusan');
		view()->share('order', $order);
		view()->share('kantor_aktif_id', request()->get('kantor_aktif_id'));

		$this->layout->pages 	= view('pengajuan.index');
		return $this->layout;
	}

	public function show($id, $status = 'putusan')
	{
		try {
			$status 		= ['putusan', 'tolak', 'setuju'];

			$permohonan		= Pengajuan::where('p_pengajuan.id', $id)->status($status)->kantor(request()->get('kantor_aktif_id'))->with('jaminan_kendaraan', 'jaminan_tanah_bangunan', 'riwayat_status', 'status_terakhir')->first();

			$breadcrumb 	= [
				[
					'title'	=> 'Putusan',
					'route' => route('pengajuan.putusan.index', ['status' => $status, 'kantor_aktif_id' => request()->get('kantor_aktif_id')])
				], 
				[
					'title'	=> $id,
					'route' => route('pengajuan.putusan.index', ['status' => $status, 'id' => $id, 'kantor_aktif_id' => request()->get('kantor_aktif_id')])
				]
			];

			if (!$permohonan)
			{
				throw new Exception("Data tidak ada!", 1);
			}

			$survei 		= Survei::where('pengajuan_id', $id)->orderby('tanggal', 'desc')->with(['character', 'condition', 'capacity', 'capital', 'jaminan_kendaraan', 'jaminan_tanah_bangunan'])->first();

			$r_nasabah 		= $this->riwayat_kredit_nasabah($permohonan['nasabah']['nik'], $id);
			$r_jaminan 		= $this->riwayat_kredit_jaminan($permohonan['jaminan_kendaraan'], $permohonan['jaminan_tanah_bangunan'], $id);
	
			$pimpinan 		= PenempatanKaryawan::where('kantor_id', request()->get('kantor_aktif_id'))->where('orang_id', Auth::user()['id'])->active(Carbon::now())->first();

			$putusan 				= Putusan::where('pengajuan_id', $id)->first();

			$checker 	= [];
			$complete 	= 0;
			$total 		= 0;

			//checker character
			$r_putusan 	= Putusan::rule_of_valid();
			$total 		= $total + count($r_putusan);

			if($putusan)
			{
				$validator 	= Validator::make($putusan->toArray(), $r_putusan);
				if ($validator->fails())
				{
					$complete 				= $complete + (count($r_putusan) - count($validator->messages()));
					$checker['putusan'] 	= false;
				}
				else
				{
					$complete 				= $complete + count($r_putusan);
					$checker['putusan'] 	= true;
				}
			}
			else
			{
				$checker['putusan'] 		= false;
			}

			$percentage 	= floor(($complete / max($total, 1)) * 100);

			view()->share('permohonan', $permohonan);
			view()->share('survei', $survei);

			view()->share('kantor_aktif_id', request()->get('kantor_aktif_id'));
			view()->share('breadcrumb', $breadcrumb);
			view()->share('status', 'putusan');
		

			$this->layout->pages 	= view('pengajuan.putusan.show', compact('r_nasabah', 'r_jaminan', 'putusan', 'pimpinan', 'checker', 'percentage'));
			return $this->layout;

		} catch (Exception $e) {
			return redirect(route('pengajuan.putusan.index', ['status' => $status, 'kantor_aktif_id' => request()->get('kantor_aktif_id')]))->withErrors($e->getMessage());
		}
	}


	public function store($id = null)
	{
		try {
			$putusan 			= Putusan::where('pengajuan_id', $id)->wherehas('pengajuan', function($q){$q->where('kode_kantor', request()->get('kantor_aktif_id'));})->orderby('tanggal', 'desc')->first();

			if(!$putusan)
			{
				$putusan 		= new Putusan;
			}

			if(!request()->has('checklists'))
			{
				$data_input 						= request()->only('tanggal', 'plafon_pinjaman', 'suku_bunga', 'jangka_waktu', 'perc_provisi', 'administrasi', 'legal', 'putusan', 'catatan');

				$data_input['pembuat_keputusan']	= ['nip' => Auth::user()['nip'], 'nama' => Auth::user()['nama']];
				$data_input['pengajuan_id']			= $id;
				$data_input['provisi']				= $this->formatMoneyTo(($this->formatMoneyFrom($data_input['plafon_pinjaman']) * $data_input['perc_provisi'])/100);

				$data_input['is_baru']				= true;
				$r_nasabah 		= $this->riwayat_kredit_nasabah($putusan['pengajuan']['nasabah']['nik'], $id);
				if(count($r_nasabah))
				{
					$data_input['is_baru']		= false;
				}
			}

			if(request()->has('checklists'))
			{
				$data_input['checklists'] 		= request()->get('checklists');
			}

			$putusan->fill($data_input);
			$putusan->save();

			return redirect(route('pengajuan.putusan.show', ['id' => $id, 'kantor_aktif_id' => request()->get('kantor_aktif_id'), 'status' => $data_input['putusan']]));

		} catch (Exception $e) {
			return redirect()->back()->withErrors($e->getMessage());
		}

	}

	public function update($id)
	{
		return $this->store($id);
	}
}
