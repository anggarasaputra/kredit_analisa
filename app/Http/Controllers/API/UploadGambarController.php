<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Http\Service\UI\UploadBase64Gambar;
use Exception, Response;

/**
 * Class UploadGambarController
 * Description: digunakan untuk membantu UI untuk mengambil data
 *
 * author: @agilma <https://github.com/agilma>
 */
Class UploadGambarController extends Controller
{
	public function store()
	{		
		try {
			//1. find latest survei
			if(request()->has('nip_karyawan'))
			{
				$foto		= base64_decode(request()->get('foto'));
				$fotos		= new UploadBase64Gambar('survei', $foto);
				$fotos		= $fotos->handle();

				return Response::json(['status' => 1, 'data' => $fotos]);
			}

			return Response::json(['status' => 1, 'data' => []]);
		} catch (Exception $e) {
			return Response::json(['status' => 0, 'data' => [], 'pesan' => $e->getMessage()]);
		}
	}

	public function destroy()
	{
		if(request()->has('nip_karyawan'))
		{
			$filename	= request()->get('foto')['url'];
			$filename 	= str_replace(url('/'), public_path(), $filename);

			if (file_exists($filename) && str_is(public_path().'*', $filename)) 
			{
				unlink($filename);

				return Response::json(['status' => 1, 'data' => []]);
			}
		} 

		return Response::json(['status' => 0, 'data' => [], 'pesan' => ['Data tidak ada!']]);
	}
}