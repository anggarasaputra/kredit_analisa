<?php

namespace Thunderlabid\Pengajuan;

use Illuminate\Support\ServiceProvider;
use Event;

class PengajuanServiceProvider extends ServiceProvider
{
	public function boot()
	{
		////////////////
		// Validation //
		////////////////
		Event::listen('Thunderlabid\Pengajuan\Events\Status\StatusCreating', 'Thunderlabid\Pengajuan\Listeners\SavingStatus');
		Event::listen('Thunderlabid\Pengajuan\Events\Status\StatusUpdating', 'Thunderlabid\Pengajuan\Listeners\SavingStatus');

		Event::listen('Thunderlabid\Pengajuan\Events\Pengajuan\PengajuanCreating', 'Thunderlabid\Pengajuan\Listeners\AssignIDPengajuan');
		Event::listen('Thunderlabid\Pengajuan\Events\Pengajuan\PengajuanCreating', 'Thunderlabid\Pengajuan\Listeners\SavingPengajuan');
		Event::listen('Thunderlabid\Pengajuan\Events\Pengajuan\PengajuanUpdating', 'Thunderlabid\Pengajuan\Listeners\SavingPengajuan');
		Event::listen('Thunderlabid\Pengajuan\Events\Pengajuan\PengajuanCreating', 'Thunderlabid\Pengajuan\Listeners\BatasanPengajuan');
		Event::listen('Thunderlabid\Pengajuan\Events\Pengajuan\PengajuanUpdating', 'Thunderlabid\Pengajuan\Listeners\BatasanPengajuan');
		Event::listen('Thunderlabid\Pengajuan\Events\Pengajuan\PengajuanDeleting', 'Thunderlabid\Pengajuan\Listeners\HanyaProsesPermohonan');

		Event::listen('Thunderlabid\Pengajuan\Events\Jaminan\JaminanCreating', 'Thunderlabid\Pengajuan\Listeners\SavingJaminan');
		Event::listen('Thunderlabid\Pengajuan\Events\Jaminan\JaminanUpdating', 'Thunderlabid\Pengajuan\Listeners\SavingJaminan');

		Event::listen('Thunderlabid\Pengajuan\Events\Jaminan\JaminanCreating', 'Thunderlabid\Pengajuan\Listeners\BatasanJaminan');
		Event::listen('Thunderlabid\Pengajuan\Events\Jaminan\JaminanUpdating', 'Thunderlabid\Pengajuan\Listeners\BatasanJaminan');

		Event::listen('Thunderlabid\Pengajuan\Events\Jaminan\JaminanCreating', 'Thunderlabid\Pengajuan\Listeners\DuplikasiJaminan');
		Event::listen('Thunderlabid\Pengajuan\Events\Jaminan\JaminanUpdating', 'Thunderlabid\Pengajuan\Listeners\DuplikasiJaminan');

		Event::listen('Thunderlabid\Pengajuan\Events\Analisa\AnalisaCreating', 'Thunderlabid\Pengajuan\Listeners\SavingAnalisa');
		Event::listen('Thunderlabid\Pengajuan\Events\Analisa\AnalisaUpdating', 'Thunderlabid\Pengajuan\Listeners\SavingAnalisa');

		Event::listen('Thunderlabid\Pengajuan\Events\Putusan\PutusanCreating', 'Thunderlabid\Pengajuan\Listeners\SavingPutusan');
		Event::listen('Thunderlabid\Pengajuan\Events\Putusan\PutusanUpdating', 'Thunderlabid\Pengajuan\Listeners\SavingPutusan');

		Event::listen('Thunderlabid\Pengajuan\Events\LegalRealisasi\LegalRealisasiCreating', 'Thunderlabid\Pengajuan\Listeners\SavingLegalRealisasi');
		Event::listen('Thunderlabid\Pengajuan\Events\LegalRealisasi\LegalRealisasiUpdating', 'Thunderlabid\Pengajuan\Listeners\SavingLegalRealisasi');
	}

	public function register()
	{
		
	}
}