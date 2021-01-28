<?php

namespace Thunderlabid\Pengajuan\Listeners;

///////////////
// Exception //
///////////////
use Thunderlabid\Pengajuan\Exceptions\AppException;

///////////////
// Framework //
///////////////
use Hash;

class SavingAnalisa
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
	}
}