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
use Carbon\Carbon;

use Thunderlabid\Manajemen\Models\Kantor;

class AssignIDKantor
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
		$model 			= $event->data;
		$model->id 		= $this->setIDKantor($model);
	}

	protected function setIDKantor()
	{
		$first_letter       = Carbon::now()->format('ym').'.';
		$prev_data          = Kantor::where('id', 'like', $first_letter.'%')->orderby('id', 'desc')->first();

		if($prev_data)
		{
			$last_letter	= explode('.', $prev_data['id']);
			$last_letter	= ((int)$last_letter[1] * 1) + 1;
		}
		else
		{
			$last_letter	= 1;
		}

		$last_letter		= str_pad($last_letter, 4, '0', STR_PAD_LEFT);

		return $first_letter.$last_letter;
	}
}