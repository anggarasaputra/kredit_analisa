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

class SimpanStatusDoingSurvei
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

		foreach ($model->survei->surveyor as $key => $value) {
			$karyawan 		= ['nip' => $value['nip'], 'nama' => $value['nama']];

			$mulai_survei 	= Carbon::createFromFormat('d/m/Y H:i', $model->survei->tanggal)->startofday()->format('Y-m-d H:i:s');
			$selesai_survei = Carbon::createFromFormat('d/m/Y H:i', $model->survei->tanggal)->endofday()->format('Y-m-d H:i:s');

			$status_last 	= Status::where('status', 'survei')->where('progress', 'sedang')->where('pengajuan_id', $model->survei->pengajuan_id)->where('tanggal', '>=', $mulai_survei)->where('tanggal', '<=', $selesai_survei)->orderby('tanggal', 'desc')->first();

			if(!($status_last && isset($karyawan['nip']) && $status_last->karyawan['nip'] == $karyawan['nip']))
			{
				$data 			= [
					'tanggal'		=> $model->survei->tanggal,
					'status'		=> 'survei',
					'progress'		=> 'sedang',
					'karyawan'		=> $karyawan,
					'pengajuan_id'	=> $model->survei->pengajuan_id,
				];

				$status 		= Status::create($data);
			}
		}
		
	}
}