<?php

use Illuminate\Database\Seeder;
use Thunderlabid\Manajemen\Models\Orang;
use Thunderlabid\Manajemen\Models\Kantor;
use Thunderlabid\Manajemen\Models\PengaturanScopes;
use Thunderlabid\Manajemen\Models\PenempatanKaryawan;

use Thunderlabid\Manajemen\Models\MobileApi;

use Carbon\Carbon;

class ManajemenTableSeeder extends Seeder
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
		Kantor::create(['nama'   => 'Kantor Holding', 'alamat' => ['alamat' => 'Perum Hladiola', 'rt' => '002', 'rw' => '006', 'kelurahan' => 'Angkasa Purna', 'kecamatan' => 'Kota Lama', 'kota' => 'Surabaya', 'provinsi' => 'Jawa Timur'], 'geolocation' => ['latitude' => -7.275614, 'longitude' => 112.6414716], 'telepon' => '031 888888', 'tipe' => 'holding']);
		
		//pusat malang
		Kantor::create(['nama'   => 'BPR Artha Makmur', 'alamat' => ['alamat' => 'Jl. Letjen Sutoyo 102B', 'rt' => '002', 'rw' => '006', 'kelurahan' => 'Blimbing', 'kecamatan' => 'Blimbing', 'kota' => 'Malang', 'provinsi' => 'Jawa Timur'], 'geolocation' => ['latitude' => -7.9786394, 'longitude' => 112.5615702], 'telepon' => '0341 777777', 'tipe' => 'pusat', 'jenis' => 'bpr']);
		
		//cabang kediri
		Kantor::create(['nama'   => 'Koperasi Surya Gemilang', 'alamat' => ['alamat' => 'Jl. Adi Sucipto No. 93', 'rt' => '004', 'rw' => '004', 'kelurahan' => 'Banju Biore', 'kecamatan' => 'Savana', 'kota' => 'Kediri', 'provinsi' => 'Jawa Timur'], 'geolocation' => ['latitude' => -7.8424163, 'longitude' => 111.946147], 'telepon' => '031 635366', 'tipe' => 'cabang', 'jenis' => 'koperasi']);

		//cabang jombang
		Kantor::create(['nama'   => 'Koperasi Mentari Jaya', 'alamat' => ['alamat' => 'Jl. Mulawarman 3', 'rt' => '004', 'rw' => '001', 'kelurahan' => 'Coban Camit', 'kecamatan' => 'Kota Lama', 'kota' => 'Jombang', 'provinsi' => 'Jawa Timur'], 'geolocation' => ['latitude' => -7.5613891, 'longitude' => 111.9783402], 'telepon' => '031 844366', 'tipe' => 'cabang', 'jenis' => 'koperasi']);

		//BASIC ADMIN
		Orang::create(['nama'   => 'Chelsy Mooy', 'email' => 'chelsy@thunderlab.id', 'password' => 'adminadmin']);
		Orang::create(['nama'   => 'Agil Mahendra', 'email' => 'agil@thunderlab.id', 'password' => 'adminadmin']);
		Orang::create(['nama'   => 'Budi Purnomo', 'email' => 'budi@thunderlab.id', 'password' => 'adminadmin']);

		//BASIC SCOPES = DISCONTINUED
		// $this->scopes();

		//BASIC PENEMPATAN
		PenempatanKaryawan::create(['kantor_id' => Kantor::orderby('created_at', 'asc')->first()['id'], 'orang_id' => Orang::orderby('created_at', 'asc')->first()['id'], 'role' => 'komisaris', 'scopes' => ['pengajuan','permohonan', 'survei', 'analisa', 'putusan', 'setujui', 'tolak', 'realisasi', 'expired', 'kantor', 'karyawan', 'passcode'], 'policies' => '', 'tanggal_masuk' => Carbon::now()->format('d/m/Y H:i')]);
		
		PenempatanKaryawan::create(['kantor_id' => Kantor::orderby('created_at', 'asc')->skip(1)->first()['id'], 'orang_id' => Orang::orderby('created_at', 'asc')->first()['id'], 'role' => 'komisaris', 'scopes' => ['pengajuan','permohonan', 'survei', 'analisa', 'putusan', 'setujui', 'tolak', 'realisasi', 'expired', 'kantor', 'karyawan', 'passcode'], 'policies' => ['putusan' => ['max:10000000']], 'tanggal_masuk' => Carbon::now()->format('d/m/Y H:i')]);
	
		PenempatanKaryawan::create(['kantor_id' => Kantor::orderby('created_at', 'asc')->skip(2)->first()['id'], 'orang_id' => Orang::orderby('created_at', 'asc')->first()['id'], 'role' => 'komisaris', 'scopes' => ['pengajuan','permohonan', 'survei', 'analisa', 'putusan', 'setujui', 'tolak', 'realisasi', 'expired', 'kantor', 'karyawan', 'passcode'], 'policies' => ['putusan' => ['max:10000000']], 'tanggal_masuk' => Carbon::now()->format('d/m/Y H:i')]);

		PenempatanKaryawan::create(['kantor_id' => Kantor::orderby('created_at', 'asc')->skip(3)->first()['id'], 'orang_id' => Orang::orderby('created_at', 'asc')->first()['id'], 'role' => 'komisaris', 'scopes' => ['pengajuan','permohonan', 'survei', 'analisa', 'putusan', 'setujui', 'tolak', 'realisasi', 'expired', 'kantor', 'karyawan', 'passcode'], 'policies' => ['putusan' => ['max:10000000']], 'tanggal_masuk' => Carbon::now()->format('d/m/Y H:i')]);
		
		PenempatanKaryawan::create(['kantor_id' => Kantor::orderby('created_at', 'asc')->skip(1)->first()['id'], 'orang_id' => Orang::orderby('created_at', 'asc')->skip(1)->first()['id'], 'role' => 'pimpinan', 'scopes' => ['pengajuan','permohonan', 'survei', 'analisa', 'putusan', 'setujui', 'tolak', 'realisasi', 'expired', 'kantor', 'karyawan', 'passcode'], 'policies' => ['putusan' => ['max:10000000']], 'tanggal_masuk' => Carbon::now()->format('d/m/Y H:i')]);

		PenempatanKaryawan::create(['kantor_id' => Kantor::orderby('created_at', 'asc')->skip(1)->first()['id'], 'orang_id' => Orang::orderby('created_at', 'asc')->skip(2)->first()['id'], 'role' => 'kabag_kredit', 'scopes' => ['pengajuan','permohonan', 'survei', 'analisa', 'putusan', 'setujui', 'tolak', 'realisasi', 'expired', 'kantor', 'karyawan', 'passcode'], 'policies' => ['putusan' => ['max:10000000']], 'tanggal_masuk' => Carbon::now()->format('d/m/Y H:i')]);

		//BASIC MOBILE
		MobileApi::create(['key' => 'THUNDERCUTE', 'secret' => 'AWAWAWLAND', 'tipe' => 'customer', 'versi' => 1]);
		MobileApi::create(['key' => 'THUNDERSWAG', 'secret' => 'WKWKWKLAND', 'tipe' => 'admin', 'versi' => 1]);
	}

	private function scopes()
	{
		//iterasi 1
		$scopes             = [[
			'id'			=> 1,
			'scope'         => 'pengajuan',  
			'policies'      => [],  
			'icon'          => null,  
			'scope_id'      => null,
			'features'		=> [[
				'id'			=> 2,
				'scope'         => 'permohonan',  
				'policies'      => [],  
				'icon'          => 'fa fa-please',  
				'scope_id'      => 1,
				'features'		=> [],
			],[
				'id'			=> 3,
				'scope'         => 'survei',  
				'policies'      => [],  
				'icon'          => 'fa fa-survei',  
				'scope_id'      => 1,
				'features'		=> [],
			],[
				'id'			=> 4,
				'scope'         => 'analisa',  
				'policies'      => [],  
				'icon'          => 'fa fa-analisa',  
				'scope_id'      => 1,
				'features'		=> [],
			],[
				'id'			=> 5,
				'scope'         => 'putusan',  
				'policies'      => [],  
				'icon'          => 'fa fa-putusan',  
				'scope_id'      => 1,
				'features'		=> [[
					'id'			=> 6,
					'scope'         => 'setujui',  
					'policies'      => ['max:10000000'],  
					'icon'          => 'fa fa-check',  
					'scope_id'      => 5,
					'features'		=> [[
						'id'			=> 7,
						'scope'         => 'realisasi',  
						'policies'      => [],  
						'icon'          => 'fa fa-check',  
						'scope_id'      => 6,
						'features'		=> [],
					],[
						'id'			=> 8,
						'scope'         => 'expired',  
						'policies'      => [],  
						'icon'          => 'fa fa-uncheck',  
						'scope_id'      => 6,
						'features'		=> [],
					]],
				],[
					'id'			=> 9,
					'scope'         => 'tolak',  
					'policies'      => [],  
					'icon'          => 'fa fa-uncheck',  
					'scope_id'      => 5,
					'features'		=> [],
				]],
			]]  
		]];

		$store 	= $this->storeScopes($scopes);
	}


	private function storeScopes($scopes)
	{
		foreach ($scopes as $key => $value) 
		{
			$new_val 	= $value;
			unset($new_val['features']);

			$scope 	= new PengaturanScopes;
			$scope->fill($new_val);
			$scope->save();
			
			if((array)$value['features'])
			{
				$store = $this->storeScopes($value['features']);
			}
			elseif(!isset($scopes[$key+1]))
			{
				return true;
			}
		}
	}
}
