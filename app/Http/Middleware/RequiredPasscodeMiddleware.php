<?php
namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure, Auth, Hash;
use Carbon\Carbon;

use App\Exceptions\AppException;

use Thunderlabid\Survei\Models\SurveiDetail;
use Thunderlabid\Survei\Models\SurveiPasscode;

class RequiredPasscodeMiddleware
{
	public function handle($request, Closure $next)
	{
		if(request()->has('collateral')){
			$key = key(request()->get('collateral')[request()->get('survei_detail_id')]);
			if($key=='bpkb'){
				$perc = request()->get('collateral')[request()->get('survei_detail_id')]['bpkb'];
				if($perc['persentasi_bank']>50){

					//checkpasscode
					$collateral	= SurveiDetail::where('id', request()->get('survei_detail_id'))->where('jenis', 'collateral')->first();

					$passcode_validate 	= SurveiPasscode::where('survei_id', $collateral['survei_id'])->where('passcode', request()->get('passcode'))->where('expired_at', '>', Carbon::now()->format('Y-m-d H:i:s'))->first();

					if(!$passcode_validate)
					{
						return redirect()->back()->withErrors('Passcode tidak valid!');
					}
				}
			}
		}

		return $next($request);
	}
}