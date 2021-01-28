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
use Carbon\Carbon;

use Thunderlabid\Pengajuan\Models\Pengajuan;

class AssignIDPengajuan
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
	 * @param  PengajuanCreated $event [description]
	 * @return [type]             [description]
	 */
	public function handle($event)
	{
		$model 			= $event->data;
		$model->id 		= $this->setIDPengajuan($model);
	}

	protected function setIDPengajuan($model)
	{
		$first_letter       = Carbon::now()->format('ym').'.'.$model->kode_kantor.'.';
		$prev_data          = Pengajuan::where('id', 'like', $first_letter.'%')->orderby('id', 'desc')->first();

		if($prev_data)
		{
			$last_letter	= explode('.', $prev_data['id']);
			$last_letter	= ((int)$last_letter[3] * 1) + 1;
		}
		else
		{
			$last_letter	= 1;
		}

		$last_letter		= str_pad($last_letter, 4, '0', STR_PAD_LEFT);

		return $first_letter.$last_letter;
	}
}