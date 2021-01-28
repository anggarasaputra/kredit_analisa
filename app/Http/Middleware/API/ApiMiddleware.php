<?php

namespace App\Http\Middleware\API;

use Closure, Response, Hash;
use Illuminate\Http\Request;

use Thunderlabid\Manajemen\Models\MobileApi;

class ApiMiddleware
{
	public function handle($request, Closure $next)
	{
		try
		{
			// $header 		= explode(' ', $request->header('Authorization'));
			// $decoder 		= base64_decode($header[1]);
			$decoder 		= base64_decode($request->get('token'));

			$credentials  	= explode('::', $decoder);
			$salt 			= explode(',', env('APP_SALT', 'ABC,ACB'));

			$device 		= MobileApi::where('key', $credentials[0])->first();

			if(!$device)
			{
				\Log::info('device 1 : '.$decoder);
				return Response::json(['status' => 0, 'data' => [], 'pesan' =>  ['Unauthorized.']]);
			}

			if(!Hash::check($credentials[2], $device->secret))
			{
				\Log::info('device 2 : '.$decoder);
				return Response::json(['status' => 0, 'data' => [], 'pesan' =>  ['Unauthorized.']]);
			}

			if(!in_array($credentials[1], $salt))
			{
				\Log::info('device 3 : '.$decoder);
				return Response::json(['status' => 0, 'data' => [], 'pesan' =>  ['Unauthorized.']]);
			}

			if(count($credentials)==5)
			{
				$request->request->add(['nip_karyawan' => $credentials[3]]);
				$request->request->add(['kode_kantor' => $credentials[4]]);
			}

			return $next($request);
		}
		catch(Exception $e)
		{
			throw $e;
		}

	}
}