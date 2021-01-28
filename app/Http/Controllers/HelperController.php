<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Input;

use Thunderlabid\Territorial\Models\Regensi;
use Thunderlabid\Territorial\Models\Distrik;
use Thunderlabid\Territorial\Models\Desa;

use Thunderlabid\Manajemen\Models\PenempatanKaryawan;
/**
 * Class HelperController
 * Description: digunakan untuk membantu UI untuk mengambil data
 *
 * author: @agilma <https://github.com/agilma>
 */
Class HelperController extends Controller
{
	/**
	 * fungsi get cities
	 * Description: berfungsi untuk mendapatkan city dari id province tertentu
	 */
	public function getRegensi()
	{
		$nama 		= request()->get('q');
		$regensi 	= Regensi::where('nama', 'like', '%'.$nama.'%')->where('territorial_provinsi_id', 'like', '35%')->get();

		return response()->json($regensi);
	}

	/**
	 * fungsi get distrik
	 * Description: untuk mendapatkan distrik dari regensi tertentu
	 */
	public function getDistrik()
	{
		$nama 		= request()->get('q');
		$distrik 	= Distrik::where('nama', 'like', '%'.$nama.'%')->where('territorial_regensi_id', 'like', '35%')->with(['kota'])->get();

		return response()->json($distrik);
	}

	/**
	 * fungsi get desa
	 * Description: untuk mendapatkan desa dari distrik tertentu
	 */
	public function getDesa()
	{
		$id 		= request()->input('id');
		// get data desa dari distrik 'nama';
		$desa 		= collect(Desa::where('territorial_distrik_id', $id)->get());// sort data desa by 'nama'
		$desa 		= $desa->sortBy('nama');
		$desa 		= $desa->pluck('nama', 'id');

		return response()->json($desa);
	}

	public function jabatan()
	{
		$jabatan 	= new PenempatanKaryawan;

		if(request()->has('kantor_aktif_id'))
		{
			$jabatan 	= $jabatan->where('kantor_id', request()->get('kantor_aktif_id'));
		}
		$jabatan 	= $jabatan->groupby('role')->get(['role'])->toArray();

		return response()->json($jabatan);
	}

	public function scopes()
	{
		$scopes 	= new PenempatanKaryawan;

		if(request()->has('role'))
		{
			$scopes = $scopes->where('role', request()->get('role'));
		}
		$scopes 	= $scopes->select('scopes')->orderby('tanggal_keluar', 'desc')->first();

		if(!$scopes)
		{
			$scopes = explode(',', 'pengajuan,permohonan,survei,analisa,keputusan,realisasi,kantor,karyawan,operasional');
			// $scopes = explode(',', env('SU_SCOPES', 'pengajuan,permohonan,survei,analisa,keputusan,realisasi,kantor,karyawan,operasional'));
		}
		else
		{
			$scopes = $scopes->toArray()['scopes'];
		}

		return response()->json($scopes);
	}

	public function storeGambar(Request $request)
	{		
		$input 		= request()->input('_file');

		$survei 	= base64_decode($input);
		$gambar 	= new UploadBase64Gambar('survei', ['image' => $survei]);
		$gambar 	= $gambar->handle();

		return JSend::success($gambar)->asArray();
	}

	public function destroyGambar()
	{
		$filename	= request()->get('url');
		$filename 	= str_replace(url('/'), public_path(), $filename);

		if (file_exists($filename) && str_is(public_path().'*', $filename)) 
		{
			unlink($filename);
			return JSend::success([])->asArray();
		} 

		return JSend::error(['File tidak ada!'])->asArray();
	}

	public function variable_list_select ()
	{
		
	}
}