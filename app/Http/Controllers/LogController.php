<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Input;

use Thunderlabid\Log\Models\Nasabah;
use Thunderlabid\Log\Models\BPKB;
use Thunderlabid\Log\Models\SHM;
use Thunderlabid\Log\Models\SHGB;

/**
 * Class LogController
 * Description: digunakan untuk membantu UI untuk mengambil data
 *
 * author: @agilma <https://github.com/agilma>
 */
Class LogController extends Controller
{
	public function nasabah()
	{
		$nasabah	= Nasabah::where('nik', request()->get('q'))->wherenull('parent_id')->first();

        return response()->json($nasabah);
	}

	public function bpkb()
	{
		$bpkb		= BPKB::where('nomor_bpkb', request()->get('q'))->wherenull('parent_id')->first();

        return response()->json($bpkb);
	}

	public function sertifikat()
	{
		$sertifikat	= SHM::where('nomor_sertifikat', request()->get('q'))->wherenull('parent_id')->first();

		if(!$sertifikat)
		{
			$sertifikat				= SHGB::where('nomor_sertifikat', request()->get('q'))->wherenull('parent_id')->first();
			$sertifikat['jenis']	= 'shgb';
		}
		else
		{
			$sertifikat['jenis']	= 'shm';
		}

        return response()->json($sertifikat);
	}
}