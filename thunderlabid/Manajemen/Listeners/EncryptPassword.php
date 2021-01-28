<?php

namespace Thunderlabid\Manajemen\Listeners;

use Thunderlabid\Manajemen\Events\OrangCreated;
use Hash;

class EncryptPassword
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
		$user = $event->data;

		if (Hash::needsRehash($user->password)) 
		{
			$user->password = Hash::make($user->password); 
		}
	}
}