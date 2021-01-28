<?php

namespace App\Listeners;

///////////////
// Exception //
///////////////
use Thunderlabid\Survei\Exceptions\AppException;

///////////////
// Framework //
///////////////
use Carbon\Carbon, Auth;

use Thunderlabid\Log\Models\Nasabah;

class SimpanLogNasabah
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
	 * @param  SimpanLogNasabah $event [description]
	 * @return [type]             [description]
	 */
	public function handle($event)
	{
		$model = $event->data;
		
		if(isset($model->nasabah['nik']))
		{
			$find 	= Nasabah::where('nik', $model->nasabah['nik'])->first();

			if(!$find)
			{
				$nasabah 				= new Nasabah;
				$data_n_n				= $model->nasabah;
				$data_n_n['parent_id']	= null;
				$nasabah->fill($data_n_n);
				$nasabah->save();
			}
			else
			{
				//simpan versioning
				$old_nasabah 			= new Nasabah;
				$data_o_n 				= $find->toArray();
				$data_o_n['parent_id']	= $find->id;

				$data_n_n				= $model->nasabah;
				$find->fill($data_n_n);
				$find->save();
			}
		}
	}
}