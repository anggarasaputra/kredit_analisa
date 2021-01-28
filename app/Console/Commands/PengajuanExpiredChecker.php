<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Thunderlabid\Pengajuan\Models\Pengajuan;
use Carbon\Carbon;
use App\Events\PengajuanExpired;

class PengajuanExpiredChecker extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'gokredit:PengajuanExpiredChecker';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Check pengajuan yang sudah expired';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		$this->info("--------------------------------------------------------");
		$this->info('EXPIRED PENGAJUAN');
		$this->info("--------------------------------------------------------");
		$this->checking();
		$this->info("\n--------------------------------------------------------");
		$this->info('DONE');
		$this->info("--------------------------------------------------------\n");
	}

	public function checking()
	{
		$pengajuan 	= Pengajuan::status('setuju')->with(['status_terakhir'])->get();

		foreach ($pengajuan as $k => $v) {
			$date_diff 	= Carbon::now()->diffInDays(Carbon::createFromFormat('d/m/Y H:i', $v['status_terakhir']['tanggal']));

			if($date_diff >= 7)
			{
				event(new PengajuanExpired($v));
			}
		}
	}
}
