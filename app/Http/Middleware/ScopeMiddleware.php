<?php
namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure, Auth, Exception;
use Carbon\Carbon;

use Thunderlabid\Manajemen\Models\PenempatanKaryawan;

class ScopeMiddleware
{
	public function handle($request, Closure $next, $scope)
	{
		$hari_ini 	= Carbon::now();
		
		$active_u	= Auth::user();
		$active_p 	= PenempatanKaryawan::where('kantor_id', $request->get('kantor_aktif_id'))->where('orang_id', $active_u['id'])->active($hari_ini)->first();

		if(!$active_p)
		{
			return redirect()->back()->withErrors('Anda tidak memiliki wewenang untuk data ini!');
		}

		if(str_is($scope, 'setuju') || str_is($scope, 'tolak'))
		{
			$scope 	= 'keputusan';
		}
		if(in_array($scope, $active_p['scopes']))
		{
			return $next($request);
		}

		if(str_is('*.*', $scope)){
			$scopes 	= explode('.', $scope);
			foreach ($scopes as $k => $v) {
				if(in_array($v, $active_p['scopes']))
				{
					return $next($request);
				}
			}
		}

		return redirect()->back()->withErrors('Anda tidak memiliki wewenang untuk data ini!');
		throw new Exception("Anda tidak memiliki wewenang untuk data ini", 403);
	}
}