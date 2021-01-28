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

use Thunderlabid\Pengajuan\Models\Pengajuan;
use Thunderlabid\Pengajuan\Models\LegalRealisasi;
use Thunderlabid\Pengajuan\Models\Analisa;
use Thunderlabid\Pengajuan\Models\Putusan;
use Thunderlabid\Survei\Models\Survei;

use Thunderlabid\Manajemen\Models\PenempatanKaryawan;

class GenerateLegalitasRealisasi
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

		if($model->putusan=='setuju')
		{
			foreach ($model->checklists['pengikat'] as $k => $v) 
			{
				$data['jenis']			= $k;
				$data['pengajuan_id']	= $model->pengajuan['id'];

				$data['isi']['pengajuan']	= Pengajuan::where('id', $model->pengajuan_id)->orderby('created_at', 'desc')->with(['jaminan'])->first()->toArray();
				$data['isi']['survei']		= Survei::where('pengajuan_id', $model->pengajuan_id)->orderby('tanggal', 'desc')->with(['character', 'condition', 'capital', 'capacity', 'collateral', 'pengajuan'])->first()->toArray();
				$data['isi']['analisa']		= Analisa::where('pengajuan_id', $model->pengajuan_id)->orderby('tanggal', 'desc')->first()->toArray();
				$data['isi']['putusan']		= Putusan::where('pengajuan_id', $model->pengajuan_id)->orderby('tanggal', 'desc')->first()->toArray();
				$data['isi']['pimpinan']	= PenempatanKaryawan::where('kantor_id', $model->pengajuan->kode_kantor)->where('role', 'pimpinan')->active(Carbon::createFromFormat('d/m/Y H:i', $model->tanggal))->with(['orang', 'kantor'])->first()->toArray();
				$data['nomor']	= $model->pengajuan['id'];
			
				switch ($k) {
					case 'perjanjian_kredit':
						if(strtolower($data['isi']['jenis_pinjaman'])=='pa')
						{
							$data['jenis']	= $k.'_angsuran';
						}
						else
						{
							$data['jenis']	= $k.'_musiman';
						}
						break;
				}

				$legal 		= LegalRealisasi::where('pengajuan_id', $model->pengajuan_id)->where('jenis', $data['jenis'])->first();
				if(!$legal)
				{
					$legal 	= new LegalRealisasi;
				}

				$legal->fill($data);
				$legal->save();
			}
		}
	}
}
