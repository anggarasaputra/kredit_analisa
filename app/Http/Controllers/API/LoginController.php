<?php

namespace App\Http\Controllers\API;

use Illuminate\Routing\Controller as BaseController;

////////////////////
// INFRASTRUCTURE //
////////////////////
use Auth;
use Hash;
use Response;
use Carbon\Carbon;

////////////////////
// MODEL 		  //
////////////////////
use Thunderlabid\Manajemen\Models\MobileApi;
use Thunderlabid\Manajemen\Models\PenempatanKaryawan;

class LoginController extends BaseController
{
	public function post_login_device() {
		$key 		= request()->input('key');
		$secret 	= request()->input('secret');
		
		$device 	= MobileApi::where('key', $key)->first();

		if(!$device)
		{
			return Response::json(['status' => 0, 'data' => [], 'pesan' =>  ['Aplikasi tidak terdaftar.']]);
		}

		if(!Hash::check($secret, $device->secret))
		{
			return Response::json(['status' => 0, 'data' => [], 'pesan' =>  ['Secret tidak cocok.']]);
		}
		$salt 		= explode(',', env('APP_SALT', 'ABC,ACB'));

		$token 		= base64_encode($key.'::'.$salt[rand(0,3)].'::'.$secret);
	
		return Response::json(['status' => 1, 'data' => ['token' => $token]]);
	}


	public function post_login_with_username() {
		$key 		= request()->input('key');
		$secret 	= request()->input('secret');

		$device 	= MobileApi::where('key', $key)->first();

		if(!$device)
		{
			return Response::json(['status' => 0, 'data' => [], 'pesan' =>  ['Aplikasi tidak terdaftar.']]);
		}

		if(!Hash::check($secret, $device->secret))
		{
			return Response::json(['status' => 0, 'data' => [], 'pesan' =>  ['Secret tidak cocok.']]);
		}
	
		$nip 		= request()->input('nip');
		$password 	= request()->input('password');
		$credential = ['nip' => $nip, 'password' => $password];
		if (Auth::attempt($credential))
		{
			//get kantor id
			$hari_ini 	= Carbon::now();
			$penempatan	= PenempatanKaryawan::where('orang_id', Auth::user()['id'])->active($hari_ini)->first();

			if(!$penempatan)
			{
				return Response::json(['status' => 0, 'data' => [], 'pesan' =>  ['Harap menghubungi HOLDING untuk mendaftarkan akses Anda.']]);
			}

			$salt 		= explode(',', env('APP_SALT', 'ABC,ACB'));
			$user 		= Auth::user();
			$kode_kantor= $penempatan['kantor_id'];

			$token 		= base64_encode($key.'::'.$salt[rand(0,3)].'::'.$secret.'::'.$user['nip'].'::'.$kode_kantor);
			
			return Response::json(['status' => 1, 'data' => ['token' => $token, 'user' => $user, 'scopes' => $penempatan['scopes']]]);
		}
		else
		{
			return Response::json(['status' => 0, 'data' => [], 'pesan' =>  ['NIP/Password Invalid.']]);
		}
	}
}

