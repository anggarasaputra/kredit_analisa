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

class SimpanStatusDonePutusan
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
		
		if(Auth::check())
		{
			$karyawan 	= ['nip' => Auth::user()['nip'], 'nama' => Auth::user()['nama']];
		}
		else
		{
			$karyawan 	= $model->pembuat_keputusan;
		}

		$mulai_putusan 		= Carbon::createFromFormat('d/m/Y H:i', $model->tanggal)->startofday()->format('Y-m-d H:i:s');
		$selesai_putusan 	= Carbon::createFromFormat('d/m/Y H:i', $model->tanggal)->endofday()->format('Y-m-d H:i:s');

		$status_last 	= Status::where('status', ['setuju', 'tolak'])->where('progress', 'sudah')->where('pengajuan_id', $model->putusan->pengajuan_id)->where('tanggal', '>=', $mulai_putusan)->where('tanggal', '<=', $selesai_putusan)->orderby('tanggal', 'desc')->first();

		if(!($status_last && isset($karyawan['nip']) && $status_last->karyawan['nip'] == $karyawan['nip']))
		{
			$data 			= [
				'tanggal'		=> $model->tanggal,
				'status'		=> $model->putusan,
				'progress'		=> 'sudah',
				'karyawan'		=> $karyawan,
				'pengajuan_id'	=> $model->pengajuan_id,
			];

			$status 		= Status::create($data);
		}
	}
}