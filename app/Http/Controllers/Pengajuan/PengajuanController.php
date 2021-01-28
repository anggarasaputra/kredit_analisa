<?php

namespace App\Http\Controllers\Pengajuan;

use App\Http\Controllers\Controller;

use Thunderlabid\Pengajuan\Models\Pengajuan;
use Thunderlabid\Pengajuan\Models\Analisa;
use Thunderlabid\Pengajuan\Models\Putusan;
use Thunderlabid\Pengajuan\Models\Status;
use Thunderlabid\Pengajuan\Models\LegalRealisasi;
use Thunderlabid\Survei\Models\Survei;

use Thunderlabid\Manajemen\Models\Orang;
use Thunderlabid\Manajemen\Models\PenempatanKaryawan;

use Exception, Session, MessageBag, DB, Carbon\Carbon, Auth;

use Thunderlabid\Log\Traits\IDRTrait;

class PengajuanController extends Controller
{
	use IDRTrait;

	protected $view_dir = 'pengajuan.';

	public function __construct()
	{
		parent::__construct();

		$this->middleware('scope:'.request()->segment(2));
		
		$this->middleware('required_password')->only('destroy', 'assign_analisa', 'assign_putusan');
	}

	public function index ($status) 
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

		$pengajuan 				= Pengajuan::status($status)->kantor(request()->get('kantor_aktif_id'))->with(['status_terakhir', 'jaminan_kendaraan', 'jaminan_tanah_bangunan', 'status_permohonan']);

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

		$pengajuan 				= $pengajuan->orderby('p_pengajuan.created_at', $urut)->paginate();

		view()->share('pengajuan', $pengajuan);
		view()->share('status', $status);
		view()->share('order', $order);
		view()->share('kantor_aktif_id', request()->get('kantor_aktif_id'));

		$this->layout->pages 	= view($this->view_dir . 'index');
		return $this->layout;
	}

	public function show($status, $id)
	{
		try {
			$permohonan		= Pengajuan::where('p_pengajuan.id', $id)->status($status)->kantor(request()->get('kantor_aktif_id'))->with('jaminan_kendaraan', 'jaminan_tanah_bangunan', 'riwayat_status', 'status_terakhir')->first();

			$breadcrumb 	= [
				[
					'title'	=> $status,
					'route' => route('pengajuan.pengajuan.index', ['status' => $status, 'kantor_aktif_id' => request()->get('kantor_aktif_id')])
				], 
				[
					'title'	=> $id,
					'route' => route('pengajuan.pengajuan.index', ['status' => $status, 'id' => $id, 'kantor_aktif_id' => request()->get('kantor_aktif_id')])
				]
			];

			if (!$permohonan)
			{
				throw new Exception("Data tidak ada!", 1);
			}
			$survei 		= Survei::where('pengajuan_id', $id)->orderby('tanggal', 'desc')->with(['character', 'condition', 'capacity', 'capital', 'jaminan_kendaraan', 'jaminan_tanah_bangunan'])->get()->toArray();

			$analisa 		= Analisa::where('pengajuan_id', $id)->orderby('tanggal', 'desc')->first();
			$putusan 		= Putusan::where('pengajuan_id', $id)->orderby('tanggal', 'desc')->first();
			$r_nasabah 		= $this->riwayat_kredit_nasabah($permohonan['nasabah']['nik'], $id);
			$r_jaminan 		= $this->riwayat_kredit_jaminan($permohonan['jaminan_kendaraan'], $permohonan['jaminan_tanah_bangunan'], $id);

			view()->share('permohonan', $permohonan);
			view()->share('survei', $survei);
			view()->share('analisa', $analisa);
			view()->share('putusan', $putusan);

			view()->share('kantor_aktif_id', request()->get('kantor_aktif_id'));
			view()->share('breadcrumb', $breadcrumb);
			view()->share('status', $status);

			$this->layout->pages 	= view('pengajuan.show', compact('r_nasabah', 'r_jaminan'));
			return $this->layout;

		} catch (Exception $e) {
			return redirect(route('pengajuan.pengajuan.index', ['status' => $status, 'kantor_aktif_id' => request()->get('kantor_aktif_id')]))->withErrors($e->getMessage());
		}
	}

	public function destroy($status, $id)
	{
		try {
			$permohonan		= Pengajuan::where('id', $id)->kantor(request()->get('kantor_aktif_id'))->with('jaminan')->first();
			if (!$permohonan)
			{
				throw new Exception("Data tidak ada!", 1);
			}

			foreach ($permohonan->jaminan as $key => $value)
			{
				$value->delete();
			}

			$permohonan->delete();

			return redirect(route('pengajuan.pengajuan.index', ['status' => $status, 'kantor_aktif_id' => request()->get('kantor_aktif_id')]));
		} catch (Exception $e) {
			return redirect(route('pengajuan.pengajuan.index', ['status' => $status, 'id' => $id, 'kantor_aktif_id' => request()->get('kantor_aktif_id')]))->withErrors($e->getMessage());
		}
	}

	public function print($id, $mode)
	{
		// $realisasi 		= LegalRealisasi::where('pengajuan_id', $id)->where('jenis', $mode)->first();
		// if($realisasi)
		// {
		// 	$realisasi 	= $realisasi->toArray();
		// }
		// else
		// {
		// 	if($mode=='permohonan_kredit')
		// 	{
				$data['pengajuan']	= Pengajuan::where('id', $id)->where('kode_kantor', request()->get('kantor_aktif_id'))->first()->toArray();
				
				$data['survei']		=  Survei::where('pengajuan_id', $id)->orderby('tanggal', 'desc')->with(['character', 'condition', 'capacity', 'capital', 'jaminan_kendaraan', 'jaminan_kendaraan.foto', 'jaminan_tanah_bangunan', 'jaminan_tanah_bangunan.foto', 'surveyor'])->first();
				
				$data['analisa']	= Analisa::where('pengajuan_id', $data['pengajuan']['id'])->first();

				$data['putusan']	= Putusan::where('pengajuan_id', $data['pengajuan']['id'])->first();

				if(!is_null($data['putusan']))
				{
					$tanggal 		= Carbon::createFromFormat('d/m/Y H:i', $data['putusan']['tanggal'])->format('Y-m-d H:i:s');
				}
				else
				{
					$tanggal 		= Carbon::now()->format('Y-m-d H:i:s');
				}

				$pimpinan 			= PenempatanKaryawan::where('kantor_id', request()->get('kantor_aktif_id'))->where('role', 'pimpinan')->where('tanggal_masuk', '>=', $tanggal)->where(function($q)use($tanggal){$q->where('tanggal_keluar', '<=', $tanggal)->orwherenull('tanggal_keluar');})->first();
			// }
			// else
			// {
			// 	$realisasi['isi']['pengajuan']	= Pengajuan::where('id', $id)->where('kode_kantor', request()->get('kantor_aktif_id'))->first()->toArray();
				
			// }
		// }
				if($mode=='perjanjian_kredit' && $data['analisa']['jenis_pinjaman']=='pa')
				{
					$mode 	= 'perjanjian_kredit_angsuran';
				}
				elseif($mode=='perjanjian_kredit')
				{
					$mode 	= 'perjanjian_kredit_musiman';
				}

		return view('pengajuan.print.'.$mode, compact('data', 'pimpinan'));
	}

	public function assign_analisa($id = null)
	{
		try {
			$permohonan		= Pengajuan::where('p_pengajuan.id', $id)->status(['permohonan', 'survei'])->kantor(request()->get('kantor_aktif_id'))->first();

			if(!$permohonan)
			{
				throw new Exception("Permohonan Kredit tidak ditemukan", 1);
			}

			if(is_null(request()->get('analis')['nip'])){
				throw new Exception("Analis Belum dipilih", 1);
			}

			DB::BeginTransaction();

			$analis['nip']			= request()->get('analis')['nip'];
			$analis['nama']			= Orang::where('nip', request()->get('analis')['nip'])->first()['nama'];
			if(is_null($analis['nama'])){
				throw new Exception("Analis Tidak Valid", 1);
			}

			$status 				= new Status;
			$status->pengajuan_id 	= $permohonan['id'];
			$status->status 		= 'analisa';
			$status->progress 		= 'perlu';
			$status->karyawan 		= $analis;
			$status->tanggal 		= Carbon::now()->format('d/m/Y H:i');
			$status->save();

			DB::commit();
			return redirect(route('pengajuan.analisa.index', ['kantor_aktif_id' => request()->get('kantor_aktif_id'), 'status' => 'analisa']));
		} catch (Exception $e) {
			DB::rollback();
			return redirect()->back()->withErrors($e->getMessage());
		}
 	}

	public function assign_putusan($id = null)
	{
		try {
			$permohonan		= Pengajuan::where('p_pengajuan.id', $id)->status('analisa')->kantor(request()->get('kantor_aktif_id'))->first();

			if(!$permohonan)
			{
				throw new Exception("Permohonan Kredit tidak ditemukan", 1);
			}

			DB::BeginTransaction();

			//pimpinan
			$kredit_diusulkan 	= $this->formatMoneyFrom($permohonan['analisa']['kredit_diusulkan']);
			
			if($kredit_diusulkan > 10000000)
			{
				$pimpinan 		= PenempatanKaryawan::where('kantor_id', request()->get('kantor_aktif_id'))->active(Carbon::now())->where('role', 'komisaris')->first();
			}
			else
			{
				$pimpinan 		= PenempatanKaryawan::where('kantor_id', request()->get('kantor_aktif_id'))->active(Carbon::now())->where('role', 'pimpinan')->first();
			}

			if(!$pimpinan)
			{
				throw new Exception("Tidak ada data pimpinan", 1);
			}

			$pk['nip']			= $pimpinan['orang']['nip'];
			$pk['nama']			= $pimpinan['orang']['nama'];

			$status 				= new Status;
			$status->pengajuan_id 	= $permohonan['id'];
			$status->status 		= 'putusan';
			$status->progress 		= 'perlu';
			$status->karyawan 		= $pk;
			$status->tanggal 		= Carbon::now()->format('d/m/Y H:i');
			$status->save();

			DB::commit();
			return redirect(route('pengajuan.putusan.index', ['kantor_aktif_id' => request()->get('kantor_aktif_id'), 'status' => 'putusan']));
		} catch (Exception $e) {
			DB::rollback();
			return redirect()->back()->withErrors($e->getMessage());
		}
 	}

	public function validasi_putusan($id = null)
	{
		try {
			$permohonan		= Pengajuan::where('p_pengajuan.id', $id)->status('putusan')->kantor(request()->get('kantor_aktif_id'))->first();

			if(!$permohonan)
			{
				throw new Exception("Permohonan Kredit tidak ditemukan", 1);
			}

			DB::BeginTransaction();

			$pk['nip']			= Auth::user()['nip'];
			$pk['nama']			= Auth::user()['nama'];

			$status 				= new Status;
			$status->pengajuan_id 	= $permohonan['id'];
			$status->status 		= $permohonan->putusan['putusan'];
			$status->progress 		= 'sudah';
			$status->karyawan 		= $pk;
			$status->tanggal 		= Carbon::now()->format('d/m/Y H:i');
			$status->save();

			DB::commit();
			return redirect(route('pengajuan.putusan.index', ['kantor_aktif_id' => request()->get('kantor_aktif_id'), 'status' => 'putusan']));
		} catch (Exception $e) {
			DB::rollback();
			return redirect()->back()->withErrors($e->getMessage());
		}
 	}
 	
 	public function ajax ()
	{
		$pengajuan 		= Pengajuan::status(request()->get('status'))->kantor(request()->get('kantor_aktif_id'));
		if(request()->has('q'))
		{
			$pengajuan	= $pengajuan->where('p_pengajuan.id', 'like', '%'.request()->get('q').'%');
		}
		$pengajuan 		= $pengajuan->get();

		return response()->json($pengajuan);
	} 
}
