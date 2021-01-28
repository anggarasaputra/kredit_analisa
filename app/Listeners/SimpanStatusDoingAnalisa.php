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

class SimpanStatusDoingAnalisa
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
			$karyawan 	= $model->analis;
		}

		$mulai_analisa 		= Carbon::createFromFormat('d/m/Y H:i', $model->tanggal)->startofday()->format('Y-m-d H:i:s');
		$selesai_analisa 	= Carbon::createFromFormat('d/m/Y H:i', $model->tanggal)->endofday()->format('Y-m-d H:i:s');

		$status_last 	= Status::where('status', 'analisa')->where('progress', 'sedang')->where('pengajuan_id', $model->analisa->pengajuan_id)->where('tanggal', '>=', $mulai_analisa)->where('tanggal', '<=', $selesai_analisa)->orderby('tanggal', 'desc')->first();

		if(!($status_last && isset($karyawan['nip']) && $status_last->karyawan['nip'] == $karyawan['nip']))
		{
			$data 			= [
				'tanggal'		=> $model->tanggal,
				'status'		=> 'analisa',
				'progress'		=> 'sedang',
				'karyawan'		=> $karyawan,
				'pengajuan_id'	=> $model->pengajuan_id,
			];

			$status 		= Status::create($data);
		}
	}
}