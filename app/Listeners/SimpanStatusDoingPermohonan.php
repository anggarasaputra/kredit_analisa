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

class SimpanStatusDoingPermohonan
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

		if(!is_null($model->ao))
		{
			$karyawan 	= $model->ao;
		}
		elseif(Auth::check())
		{
			$karyawan 	= ['nip' => Auth::user()['nip'], 'nama' => Auth::user()['nama']];
		}
		else
		{
			$karyawan 	= [];
		}

		$data 			= [
			'tanggal'		=> Carbon::now()->format('d/m/Y H:i'),
			'status'		=> 'permohonan',
			'progress'		=> 'sedang',
			'karyawan'		=> $karyawan,
			'pengajuan_id'	=> $model->id,
		];

		$status 		= Status::create($data);
	}
}