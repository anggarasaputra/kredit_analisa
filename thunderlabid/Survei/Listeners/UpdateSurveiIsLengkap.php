<?php

namespace Thunderlabid\Survei\Listeners;

///////////////
// Exception //
///////////////
use Thunderlabid\Survei\Exceptions\AppException;

///////////////
// Framework //
///////////////
use Validator;
use Thunderlabid\Survei\Models\SurveiDetail;

class UpdateSurveiIsLengkap
{
	/**
	 * Create the event listener.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Handle event
	 * @param  KantorCreated $event [description]
	 * @return [type]             [description]
	 */
	public function handle($event)
	{		
		$model = $event->data;
		$model->survei->is_lengkap 	= true;
		
		//checker character
		$c_char 	= SurveiDetail::rule_of_valid_character();

		if(count($model->survei['character']))
		{
			$validator 	= Validator::make($model->survei['character']['dokumen_survei']['character'], $c_char);
			if ($validator->fails())
			{
				$model->survei->is_lengkap 	= false;
			}
		}
		else
		{
			$model->survei->is_lengkap 	= false;
		}

		//checker condition
		$c_cond 	= SurveiDetail::rule_of_valid_condition();

		if(count($model->survei['condition']))
		{
			$validator 	= Validator::make($model->survei['condition']['dokumen_survei']['condition'], $c_cond);
			if ($validator->fails())
			{
				$model->survei->is_lengkap 	= false;
			}
		}
		else
		{
			$model->survei->is_lengkap 	= false;
		}

		//checker capital
		$c_capi 	= SurveiDetail::rule_of_valid_capital();

		if(count($model->survei['capital']))
		{
			$validator 	= Validator::make($model->survei['capital']['dokumen_survei']['capital'], $c_capi);
			if ($validator->fails())
			{
				$model->survei->is_lengkap 	= false;
			}
		}
		else
		{
			$model->survei->is_lengkap 	= false;
		}

		//checker capacity
		$c_capa 	= SurveiDetail::rule_of_valid_capacity();

		if(count($model->survei['capacity']))
		{
			$validator 	= Validator::make($model->survei['capacity']['dokumen_survei']['capacity'], $c_capa);
			if ($validator->fails())
			{
				$model->survei->is_lengkap 	= false;
			}
		}
		else
		{
			$model->survei->is_lengkap 	= false;
		}


		//checker collateral
		if(count($model->survei['jaminan_kendaraan'])){
			foreach ($model->survei['jaminan_kendaraan'] as $k => $v) {
				$c_col 		= SurveiDetail::rule_of_valid_collateral_bpkb();

				$validator 	= Validator::make($v['dokumen_survei']['collateral']['bpkb'], $c_col);
				if ($validator->fails())
				{
					$model->survei->is_lengkap 	= false;
				}
			}
		}

		if(count($model->survei['jaminan_tanah_bangunan'])){
			foreach ($model->survei['jaminan_tanah_bangunan'] as $k => $v) {
				$c_col 		= SurveiDetail::rule_of_valid_collateral_sertifikat($v['dokumen_survei']['collateral']['jenis'], $v['dokumen_survei']['collateral'][$v['dokumen_survei']['collateral']['jenis']]['tipe']);

				$validator 	= Validator::make($v['dokumen_survei']['collateral'][$v['dokumen_survei']['collateral']['jenis']], $c_col);
				if ($validator->fails())
				{
					$model->survei->is_lengkap 	= false;
				}
			}
		}

		$model->survei->save();
	}
}