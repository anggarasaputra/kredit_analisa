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

use Thunderlabid\Pengajuan\Models\Status;

class SimpanStatusDoneExpire
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
		
		if(Auth::check())
		{
			$karyawan 	= ['nip' => Auth::user()['nip'], 'nama' => Auth::user()['nama']];
		}
		else
		{
			$karyawan 	= [];
		}

		$data 			= [
			'tanggal'		=> Carbon::now()->format('d/m/Y H:i'),
			'status'		=> 'expired',
			'progress'		=> 'sudah',
			'karyawan'		=> $karyawan,
			'pengajuan_id'	=> $model->id,
			'catatan'		=> 'Otomasi Sistem'
		];

		$status 		= Status::create($data);
	}
}