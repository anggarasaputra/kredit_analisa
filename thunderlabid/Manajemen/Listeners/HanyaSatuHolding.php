<?php

namespace Thunderlabid\Manajemen\Listeners;

///////////////
// Exception //
///////////////
use Thunderlabid\Manajemen\Exceptions\AppException;

///////////////
// Framework //
///////////////
use Hash;

use Thunderlabid\Manajemen\Models\Kantor;

class HanyaSatuHolding
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
		if ($model->tipe=='holding') 
		{
			$kantor 	= Kantor::where('tipe', 'holding')->where('id', '<>', $model->id)->first();
			if($kantor)
			{
				throw new AppException(['Holding tidak boleh lebih dari 1'], AppException::DATA_VALIDATION);
			}
		}
	}
}