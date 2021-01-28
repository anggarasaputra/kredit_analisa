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

class DeletingPenempatan
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

		foreach ($model->penempatan as $k => $v) {
			$v->delete();
		}
	}
}