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

class DeletingOrang
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
	 * @param  OrangCreated $event [description]
	 * @return [type]             [description]
	 */
	public function handle($event)
	{
		$model = $event->data;

		if (!$model->is_deletable) 
		{
			throw new AppException($model->errors, AppException::DATA_VALIDATION);
		}
	}
}