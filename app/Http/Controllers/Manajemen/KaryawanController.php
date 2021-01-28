<?php

namespace App\Http\Controllers\Manajemen;

use App\Http\Controllers\Controller;

use Thunderlabid\Manajemen\Models\Orang;
use Thunderlabid\Manajemen\Models\PenempatanKaryawan;

use Exception, Session, MessageBag, Redirect, DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class KaryawanController extends Controller
{
	protected $view_dir = 'manajemen.';

	public function __construct()
	{
		parent::__construct();
		
		$this->middleware('scope:karyawan');
		
		$this->middleware('required_password')->only('destroy');
	}

	public function index () 
	{
		$field 		= 'nama';
		$urut 		= 'asc';

		if (request()->has('order'))
		{
			list($field, $urut) 	= explode('-', request()->get('order'));
		}

		if (str_is($urut, 'asc'))
		{
			$order 	= ucwords($field).' A - Z';
		}
		else
		{
			$order 	= ucwords($field).' Z - A';
		}

		$orang 		= new Orang;

		if (request()->has('q'))
		{
			$cari 		= request()->get('q');
			$orang 	= $orang->where(function($q)use($cari){				
							$q
							->where('nama', 'like', '%'.$cari.'%')
							->orwhere('nip', 'like', '%'.$cari.'%');
						});
		}

		$orang 	= $orang->orderby($field, $urut)->with(['penempatan', 'penempatan.kantor'])->paginate();
		$scopes = explode(',', env('SU_SCOPES', 'pengajuan,permohonan,survei,analisa,keputusan,realisasi,kantor,karyawan'));

		$this->layout->pages 	= view($this->view_dir . 'karyawan.index', compact('orang', 'order', 'scopes'));
		return $this->layout;
	}

	public function create ($id = null) 
	{
		$title 			= 'KARYAWAN BARU';

		if(!is_null($id))
		{
			$title 		= 'EDIT KARYAWAN';
		}

		$karyawan		= Orang::findornew($id);

		$this->layout->pages 	= view($this->view_dir . '.karyawan.create', compact('karyawan', 'title'));
		return $this->layout;
	}


	public function upload() 
	{
		$title 			= 'UPLOAD KARYAWAN BARU';

		$this->layout->pages 	= view($this->view_dir . '.karyawan.upload', compact('title'));
		return $this->layout;
	}

	public function store($id = null) 
	{
		try {
			if(is_null($id))
			{
				$orang	= request()->only('nama', 'email', 'telepon', 'telepon', 'alamat', 'password', 'confirm_password');
			}
			else
			{
				$orang	= request()->only('nama', 'email', 'telepon', 'telepon', 'alamat');
			}
			$penempatan 		= request()->get('kantor');

			DB::beginTransaction();
			$orang_simpan 		= Orang::findornew($id);
			$orang_simpan->fill($orang);
			$orang_simpan->save();

			if(is_null($id))
			{
				$penempatan['kantor_id']= request()->get('kantor_id');
				$penempatan['orang_id']	= $orang_simpan['id'];
				if(in_array('keputusan', $penempatan['scopes']) && $penempatan['role']=='pimpinan')
				{
					$penempatan['policies']	= ['keputusan' => ['max:10000000']];
				}
				else
				{
					$penempatan['policies']	= [];
				}
				$penempatan_simpan 		= new PenempatanKaryawan;
				$penempatan_simpan->fill($penempatan);
				$penempatan_simpan->save();
			}
			DB::commit();

			return Redirect::route('manajemen.karyawan.index', ['kantor_aktif_id' => $this->kantor_aktif['id']]);
		} catch (Exception $e) {
			DB::rollback();
			return Redirect::back()->withInput()->withErrors($e->getMessage());
		}
	}

	public function edit($id)
	{
		return $this->create($id);
	}

	public function update($id)
	{
		if(request()->has('mode'))
		{
			switch (request()->get('mode')) {
				case 'mutasi':
					return $this->pindah(request()->get('penempatan_id'));
					break;
				case 'resign':
					return $this->resign(request()->get('penempatan_id'));
					break;
				default:
					return $this->penempatan_baru($id);
					break;
			}
		}
		return $this->store($id);
	}

	public function destroy($id)
	{
		try {
			$karyawan		= Orang::findorfail($id);
			if (!$karyawan)
			{
				throw new Exception("Data tidak ada!", 1);
			}

			$karyawan->delete();

			return redirect(route('manajemen.karyawan.index', ['kantor_aktif_id' => $this->kantor_aktif['id']]));
		} catch (Exception $e) {
			return redirect(route('manajemen.karyawan.index', ['id' => $id, 'kantor_aktif_id' => $this->kantor_aktif['id']]))->withErrors($e->getMessage());
		}
	}

	private function pindah($penempatan_id)
	{
		try {
			DB::beginTransaction();
			$penempatan 	= PenempatanKaryawan::findorfail($penempatan_id);
			$penempatan->tanggal_keluar 	= request()->get('tanggal_pindah');
			$penempatan->save();

			$penempatan_baru 	= new PenempatanKaryawan;
			$penempatan_baru->kantor_id 	= request()->get('kantor_id');
			$penempatan_baru->orang_id 		= $penempatan->orang_id;
			$penempatan_baru->role 			= $penempatan->role;
			$penempatan_baru->scopes 		= $penempatan->scopes;
			$penempatan_baru->policies 		= $penempatan->policies;
			$penempatan_baru->tanggal_masuk = request()->get('tanggal_pindah');
			$penempatan_baru->save();
			DB::commit();

			return redirect(route('manajemen.karyawan.index', ['kantor_aktif_id' => $this->kantor_aktif['id']]));
		} catch (Exception $e) {
			DB::rollback();
			return redirect(route('manajemen.karyawan.index', ['id' => $id, 'kantor_aktif_id' => $this->kantor_aktif['id']]))->withErrors($e->getMessage());
		}
	}

	private function resign($penempatan_id)
	{
		try {
			DB::beginTransaction();
			$penempatan 	= PenempatanKaryawan::findorfail($penempatan_id);
			$penempatan->tanggal_keluar 	= request()->get('tanggal_keluar');
			$penempatan->save();

			DB::commit();

			return redirect(route('manajemen.karyawan.index', ['kantor_aktif_id' => $this->kantor_aktif['id']]));
		} catch (Exception $e) {
			DB::rollback();
			return redirect(route('manajemen.karyawan.index', ['id' => $id, 'kantor_aktif_id' => $this->kantor_aktif['id']]))->withErrors($e->getMessage());
		}
	}

	private function penempatan_baru($orang_id)
	{
		try {
			DB::beginTransaction();
			$penempatan 			= request()->get('kantor');

			if(in_array('keputusan', $penempatan['scopes']) && $penempatan['role']=='pimpinan')
			{
				$penempatan['policies']	= ['keputusan' => ['max:10000000']];
			}
			else
			{
				$penempatan['policies']	= [];
			}
			$penempatan['kantor_id']	= request()->get('kantor_id');
			$penempatan['orang_id']		= $orang_id;
			$penempatan_simpan 			= new PenempatanKaryawan;
			$penempatan_simpan->fill($penempatan);
			$penempatan_simpan->save();

			DB::commit();

			return redirect(route('manajemen.karyawan.index', ['kantor_aktif_id' => $this->kantor_aktif['id']]));
		} catch (Exception $e) {
			DB::rollback();
			return redirect(route('manajemen.karyawan.index', ['id' => $id, 'kantor_aktif_id' => $this->kantor_aktif['id']]))->withErrors($e->getMessage());
		}
	}

	public function batch()
	{
		try {
			if(request()->hasfile('karyawan')){
				$file 		= request()->file('karyawan');

				$fn 		= 'karyawan-'.Str::slug(microtime()).'.'.$file->getClientOriginalExtension(); 

				$date 		= Carbon::now();
				$dp 		= $date->format('Y/m/d');

	      		$file->move(public_path().'/'.$dp, $fn); // uploading file to given path

				DB::beginTransaction();
				
				if (($handle = fopen(public_path().'/'.$dp.'/'.$fn, "r")) !== FALSE) 
				{
					$header 		= null;

					while (($data = fgetcsv($handle, 500, ",")) !== FALSE) 
					{
						if ($header === null) 
						{
							$header = $data;
							continue;
						}
					
						$all_row 	= array_combine($header, $data);

						$scopes 	= explode('|', $all_row['scopes']);

						foreach ($scopes as $k => $v) {
							$scopes[$k]	= str_replace('manage_', '', $v);
						}

						$policies 		= [];

						if($all_row['role']=='pimpinan')
						{
							$policies 	= ['keputusan' => ['max:10000000']];
						}

						$orang 		= Orang::where('nip', $all_row['nip'])->first();
						if(!$orang)
						{
							$orang 	= new Orang;
						}

						$karyawan 	= [
							'nama'			=> $all_row['nama'],
							'email'			=> $all_row['email'],
							'password'		=> $all_row['kode_kantor'],
							'telepon'		=> $all_row['nomor_telepon'],
							'alamat'		=> ['alamat' => $all_row['alamat']],
						];

						$orang->fill($karyawan);
						$orang->save();

						$penempatan_karyawan 	= [
							'kantor_id'		=> $all_row['kode_kantor'],
							'orang_id'		=> $orang['id'],
							'role'			=> $all_row['jabatan'],
							'scopes'		=> $scopes,
							'policies'		=> $policies,
							'tanggal_masuk'	=> $all_row['tanggal_masuk'],
						];
						$penempatan		= new PenempatanKaryawan;
						$penempatan->fill($penempatan_karyawan);
						$penempatan->save();
					}
					fclose($handle);
				}
				DB::commit();
			}
			return redirect(route('manajemen.karyawan.index', ['kantor_aktif_id' => $this->kantor_aktif['id']]));
		} catch (Exception $e) {
			DB::rollback();
			return Redirect::back()->withInput()->withErrors($e->getMessage());
		}
	}

	public function ajax () 
	{
		$hari_ini 	= Carbon::now();

		$gawe 		= PenempatanKaryawan::active($hari_ini);

		if (request()->has('kantor_aktif_id')){
			$gawe 	= $gawe->where('kantor_id', request()->get('kantor_aktif_id'));
		}

		if (request()->has('scope')){
			$gawe 	= $gawe->where('scopes', 'like', '%'.request()->get('scope').'%');
		}

		if (request()->has('q'))
		{
			$cari 	= request()->get('q');
			$gawe 	= $gawe->whereHas('orang',function($q)use($cari){				
							$q->where('nama', 'like', '%'.$cari.'%');
						});
		}

		$gawe 	= $gawe->with(['orang'])->get();

		return response()->json($gawe);
	}
}
