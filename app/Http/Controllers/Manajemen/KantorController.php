<?php

namespace App\Http\Controllers\Manajemen;

use App\Http\Controllers\Controller;

use Thunderlabid\Manajemen\Models\Kantor;

use Exception, Session, MessageBag, Redirect, DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class KantorController extends Controller
{
	protected $view_dir = 'manajemen.';

	public function __construct()
	{
		parent::__construct();
		
		$this->middleware('scope:kantor');
		
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

		$kantor 	= new Kantor;

		if (request()->has('q'))
		{
			$cari 		= request()->get('q');
			$kantor 	= $kantor->where(function($q)use($cari){				
							$q
							->where('nama', 'like', '%'.$cari.'%')
							->orwhere('id', 'like', '%'.$cari.'%');
						});
		}

		$kantor 	= $kantor->orderby($field, $urut)->paginate();

		$this->layout->pages 	= view($this->view_dir . 'kantor.index', compact('kantor', 'order'));
		return $this->layout;
	}

	public function create ($id = null) 
	{
		$title 			= 'KANTOR BARU';

		if(!is_null($id))
		{
			$title 		= 'EDIT KANTOR';
		}

		$kantor 				= Kantor::findornew($id);

		$this->layout->pages 	= view($this->view_dir . '.kantor.create', compact('kantor', 'breadcrumb', 'title'));
		return $this->layout;
	}

	public function store($id = null) 
	{
		try {
			$kantor 				= request()->only('nama', 'tipe', 'jenis', 'kantor_id', 'telepon');
			$kantor['alamat']		= ['alamat' => request()->get('alamat')];
			$kantor['geolocation']	= ['latitude' => request()->get('latitude'), 'longitude' => request()->get('longitude')];

			$kantor_simpan 	= Kantor::findornew($id);
			$kantor_simpan->fill($kantor);
			$kantor_simpan->save();

			return Redirect::route('manajemen.kantor.index', ['kantor_aktif_id' => $this->kantor_aktif['id']]);
		} catch (Exception $e) {
			return Redirect::back()->withInput()->withErrors($e->getMessage());
		}
	}

	public function edit($id)
	{
		return $this->create($id);
	}

	public function update($id)
	{
		return $this->store($id);
	}

	public function destroy($id)
	{
		try {
			$kantor		= Kantor::findorfail($id);
			if (!$kantor)
			{
				throw new Exception("Data tidak ada!", 1);
			}
			
			foreach ($kantor->penempatan as $k => $v) {
				$v->delete();
			}

			$kantor->delete();

			return redirect(route('manajemen.kantor.index', ['kantor_aktif_id' => $this->kantor_aktif['id']]));
		} catch (Exception $e) {
			return redirect(route('manajemen.kantor.index', ['kantor_aktif_id' => $this->kantor_aktif['id']]))->withErrors($e->getMessage());
		}
	}

	public function batch()
	{
		try {
			if(request()->hasfile('kantor')){
				$file 		= request()->file('kantor');

				$fn 		= 'kantor-'.Str::slug(microtime()).'.'.$file->getClientOriginalExtension(); 

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

						$pusat 		= Kantor::findornew($all_row['kode_pusat']);


						$kantor_baru	= Kantor::findornew($all_row['kode_kantor']);

						$kantor 	= [
							'id'			=> strtoupper(str_replace(' ', '', $all_row['nama_kantor'])),
							'kantor_id'		=> $pusat->id,
							'nama'			=> $all_row['nama_kantor'],
							'kode'			=> $all_row['kode_kantor'],
							'jenis'			=> $all_row['jenis_kantor'],
							'tipe'			=> $all_row['tipe_kantor'],
							'geolocation'	=> ['latitude' => $all_row['latitude'], 'longitude' => $all_row['longitude']],
							'telepon'		=> $all_row['nomor_telepon'],
							'alamat'		=> ['alamat' => $all_row['alamat']],
						];

						$kantor_baru->fill($kantor);
						$kantor_baru->save();
					}
					fclose($handle);
				}
				DB::commit();
			}
			return redirect(route('manajemen.kantor.index', ['kantor_aktif_id' => $this->kantor_aktif['id']]));
		} catch (Exception $e) {
			DB::rollback();
			return Redirect::back()->withInput()->withErrors($e->getMessage());
		}
	}

	public function ajax () 
	{
		$kantor 	= new Kantor;

		if (request()->has('q'))
		{
			$cari 		= request()->get('q');
			$kantor 	= $kantor->where(function($q)use($cari){				
							$q
							->where('nama', 'like', '%'.$cari.'%')
							->orwhere('id', 'like', '%'.$cari.'%');
						});
		}

		$kantor 	= $kantor->orderby('nama', 'asc')->get(['id', 'nama']);

		return response()->json($kantor);
	}
}
