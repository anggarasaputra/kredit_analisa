<?php

namespace Thunderlabid\Survei\Listeners;

///////////////
// Exception //
///////////////
use Thunderlabid\Survei\Exceptions\AppException;

///////////////
// Framework //
///////////////
use Hash;

class SavingSurveiDetail
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
		if (!$model->is_savable) 
		{
			throw new AppException($model->errors, AppException::DATA_VALIDATION);
		}

		// if ($model->isDirty()) {
		// 	if($model->dokumen_survei['collateral']['jenis']=='bpkb')
		// 	{
		// 		$prev 	= json_decode($model->getDirty()['dokumen_survei'], true);

		// 		if($model->dokumen_survei['collateral']['bpkb']['persentasi_bank'] != $orev['collateral']['bpkb']['persentasi_bank'] && $model->dokumen_survei['collateral']['bpkb']['persentasi_bank'] > 50){

		// 			if($model->dokumen_survei['collateral']['bpkb']['lock_bank_percentage'] != request()->has('lock_bank_percentage')){
		// 				throw new AppException(['Password kunci tidak cocok!'], AppException::DATA_VALIDATION);
		// 			}
		// 		}
		// 	}
		// }
	}
}