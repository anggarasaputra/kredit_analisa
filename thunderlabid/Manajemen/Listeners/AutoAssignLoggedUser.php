<?php

namespace Thunderlabid\Manajemen\Listeners;

use Thunderlabid\Manajemen\Models\PenempatanKaryawan;
use Hash, Auth;

use Carbon\Carbon;

class AutoAssignLoggedUser
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
	 * @param  PenempatanKaryawanSaving $event [description]
	 * @return [type]             [description]
	 */
	public function handle($event)
	{
		$model			= $event->data;

		if(Auth::check())
		{
			$logged_user 	= Auth::user();

			$logged_kantor 	= PenempatanKaryawan::where('kantor_id', request()->get('kantor_aktif_id'))->where('orang_id', $logged_user['id'])->active(Carbon::now())->first();

			$data['kantor_id']		= $model->id;
			$data['orang_id']		= $logged_user['id'];
			$data['role'] 			= $logged_kantor['role'];
			$data['scopes'] 		= $logged_kantor['scopes'];
			$data['policies'] 		= $logged_kantor['policies'];
			$data['tanggal_masuk']	= Carbon::now()->format('d/m/Y H:i');

			$penempatan		= new PenempatanKaryawan;
			$penempatan->fill($data);
			$penempatan->save();
		}
	}
}