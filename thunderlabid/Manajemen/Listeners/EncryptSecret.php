<?php

namespace Thunderlabid\Manajemen\Listeners;

use Hash;

class EncryptSecret
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
	 * @param  MobileApiSaving 	$event [description]
	 * @return [type]             [description]
	 */
	public function handle($event)
	{
		$mobile = $event->data;

		if (Hash::needsRehash($mobile->secret)) 
		{
			$mobile->secret = Hash::make($mobile->secret); 
		}
	}
}