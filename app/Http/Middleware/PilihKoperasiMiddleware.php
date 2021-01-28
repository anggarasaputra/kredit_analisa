<?php
namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure, Auth, Hash;
use Carbon\Carbon;

use App\Exceptions\AppException;

class PilihKoperasiMiddleware
{
	public function handle($request, Closure $next)
	{
		if(!request()->has('kantor_aktif_id'))
		{
			return redirect()->route('pilih.koperasi', ['prev_url' => request()->url()]);
		}

		return $next($request);
	}
}