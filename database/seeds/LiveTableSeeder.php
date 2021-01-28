<?php

use Illuminate\Database\Seeder;
use Thunderlabid\Manajemen\Models\Orang;
use Thunderlabid\Manajemen\Models\Kantor;
use Thunderlabid\Manajemen\Models\PengaturanScopes;
use Thunderlabid\Manajemen\Models\PenempatanKaryawan;

use Thunderlabid\Manajemen\Models\MobileApi;

use Carbon\Carbon;

class LiveTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('m_kantor')->truncate();
		DB::table('m_orang')->truncate();
		DB::table('m_pengaturan_scopes')->truncate();
		DB::table('m_penempatan_karyawan')->truncate();
		DB::table('m_mobile_api')->truncate();
		
		//
		//BASIC HOLDING SURABAYA
		Kantor::create(['nama'   => 'Kantor Holding', 'alamat' => ['alamat' => 'Letjen S. Parman 21', 'rt' => '002', 'rw' => '006', 'kelurahan' => 'Purwantoro', 'kecamatan' => 'Blimbing', 'kota' => 'Malang', 'provinsi' => 'Jawa Timur'], 'geolocation' => ['latitude' => -7.954028, 'longitude' => 112.6363283], 'telepon' => '0341 404900', 'tipe' => 'holding']);
		
		//BASIC ADMIN
		Orang::create(['nama'   => 'KOMISARIS', 'email' => 'chelsy@thunderlab.id', 'password' => 'padinet123']);

		//BASIC PENEMPATAN
		PenempatanKaryawan::create(['kantor_id' => Kantor::orderby('created_at', 'asc')->first()['id'], 'orang_id' => Orang::orderby('created_at', 'asc')->first()['id'], 'role' => 'komisaris', 'scopes' => ['pengajuan','permohonan', 'survei', 'analisa', 'putusan', 'setujui', 'tolak', 'realisasi', 'expired', 'kantor', 'karyawan', 'passcode'], 'policies' => '', 'tanggal_masuk' => Carbon::now()->format('d/m/Y H:i')]);

		//BASIC MOBILE
		MobileApi::create(['key' => 'THUNDERCUTE', 'secret' => 'AWAWAWLAND', 'tipe' => 'customer', 'versi' => 1]);
		MobileApi::create(['key' => 'THUNDERSWAG', 'secret' => 'WKWKWKLAND', 'tipe' => 'admin', 'versi' => 1]);
	}
}
