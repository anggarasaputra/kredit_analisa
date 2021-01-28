<?php

namespace Thunderlabid\Manajemen\Listeners;

use Thunderlabid\Manajemen\Models\Orang;
use Thunderlabid\Manajemen\Models\PenempatanKaryawan;
use Thunderlabid\Manajemen\Events\PenempatanKaryawanSaving;
use Hash;

use Carbon\Carbon;

class AutoAssignNIP
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
		$penempatan  			= $event->data;

		//$call user
		$check_nip				= Orang::find($penempatan['orang_id']);
		if($check_nip && is_null($check_nip['nip']))
		{
			$riwayat_kerja 		= PenempatanKaryawan::where('orang_id', $check_nip['orang_id'])->orderby('tanggal_masuk', 'desc')->first();
			
			if($riwayat_kerja && $riwayat_kerja->tanggal_masuk < $penempatan->tanggal_masuk)
			{
				$first_letter	= Carbon::createFromFormat('d/m/Y H:i', $riwayat_kerja->tanggal_masuk)->format('Y').'.';
			}
			else
			{
				$first_letter	= Carbon::createFromFormat('d/m/Y H:i', $penempatan->tanggal_masuk)->format('Y').'.';
			}

			$prev_data          = Orang::where('nip', 'like', $first_letter.'%')->orderby('nip', 'desc')->first();

			if($prev_data)
			{
				$last_letter	= explode('.', $prev_data['nip']);
				$last_letter	= ((int)$last_letter[1] * 1) + 1;
			}
			else
			{
				$last_letter	= 1;
			}

			$last_letter		= str_pad($last_letter, 4, '0', STR_PAD_LEFT);

			$check_nip->nip 	= $first_letter.$last_letter;
			$check_nip->save();
		}

	}
}