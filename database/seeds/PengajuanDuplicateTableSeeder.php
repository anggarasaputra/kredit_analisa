<?php

use Illuminate\Database\Seeder;
use Thunderlabid\Manajemen\Models\Orang;
use Thunderlabid\Manajemen\Models\Kantor;

use Thunderlabid\Pengajuan\Models\Pengajuan;
use Thunderlabid\Pengajuan\Models\Jaminan;

use Thunderlabid\Pengajuan\Traits\IDRTrait;

use Carbon\Carbon;

class PengajuanDuplicateTableSeeder extends Seeder
{
	use IDRTrait;

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		//INIT VARIABLE HELPER
		$faker		= \Faker\Factory::create();

		$jk   		= ['pa', 'pt', 'rumah_delta'];
		$gndr   	= ['perempuan', 'laki-laki'];
		$sp   		= ['belum_kawin', 'kawin', 'cerai', 'cerai_mati'];
		
		$kab 		= ['Banyuwangi', 'Gresik', 'Kediri', 'Lamongan', 'Magetan', 'malang', 'Mojokerto', 'Pamekasan', 'Pasuruan', 'Ponorogo', 'Situbondo', 'Sumenep', 'Tuban', 'Bangkalan', 'Bondowoso', 'Jember', 'Ngawi', 'Pacitan', 'Sampang', 'tulungagung', 'Blitar', 'Bojonegoro', 'Jombang', 'Lumajang', 'Madiun', 'Nganjuk', 'Probolinggo', 'Sidoarjo', 'Trenggalek'];

		$pekerjaan 	= ['karyawan_swasta', 'wiraswasta', 'pegawai_negeri', 'tni', 'polri', 'belum_bekerja'];

		$foto 		= 	[
			'http://rumahpengaduan.com/wp-content/uploads/2015/02/KTP.jpg',
			'https://pbs.twimg.com/media/BwlhnFOCQAAvDGp.jpg',
			'https://pbs.twimg.com/media/A_Cc4keCAAAAP-2.jpg',
			'https://balyanurmd.files.wordpress.com/2013/12/ktp-masa-depan.jpg',
			'https://pbs.twimg.com/media/BXjQAxjIEAAVhox.jpg',
		];

		$kk 		= 	[
			'https://www.lapor.go.id/images/stream/8abb1c77577392d48d9c4c9f81cecd3f.jpg',
			'http://3.bp.blogspot.com/-vEZuGYwBWqc/VkA4avQYhMI/AAAAAAAAAGg/-5dZ2L0rF04/s1600/Kartu-Keluarga.jpg',
			'http://sid.sidoarjokab.go.id/tulangan-tulangan/assets/files/artikel/sedang_1471592254ksk.JPG',
			'http://2.bp.blogspot.com/-TEYKgyEzn60/VS-wFtO8XjI/AAAAAAAAKZI/U_Fg3PvrHks/w1200-h630-p-k-no-nu/kk-eri-kurniawan.jpg',
			'https://i1.wp.com/www.azzhura.com/wp-content/uploads/2015/11/kartu-keluarga.jpg',
		];
		
		$hubungan		= ['orang_tua', 'pasangan', 'anak'];

		//JAMINAN
		$jj	= ['bpkb', 'shm', 'shgb'];

		$this->type_k	= ['roda_2', 'roda_3', 'roda_4', 'roda_6'];
		$this->type_tb	= ['tanah', 'tanah_dan_bangunan'];
		$this->merk_k	= ['honda', 'yamaha', 'suzuki', 'kawasaki', 'mitsubishi', 'toyota', 'nissan', 'kia', 'daihatsu', 'isuzu'];
		$this->jenis_k	= ['roda_2' => ['bebek', 'ninja'], 'roda_3' => ['bajaj', 'backtruck'], 'roda_4' => ['suv', 'pickup'], 'roda_6' => ['truck', 'bis']];
		$this->char 	= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';


		//BASIC PENGAJUAN
		foreach (range(0, 0) as $value) 
		{
			$pokok_pinjaman 	= (rand(25,250)) * 100000;
			$bunga 				= (rand(100,500))/1000;
			$jangka_waktu 		= rand(4,12)*3;
			$angsuran 			= ($pokok_pinjaman + ($pokok_pinjaman*$bunga))/$jangka_waktu;
			$angsuran 			= ceil($angsuran/100000);
			$angsuran 			= $angsuran * 100000;
			$mobile 			= rand(0,0);
			// $mobile 			= rand(0,1);
			$nip_ao				= null;

			$alamat		= 	[
								'alamat'			=> $faker->address,
								'rt'				=> '00'.rand(0,9),
								'rw'				=> '00'.rand(0,9),
								'kota'				=> $kab[rand(0,28)],
								'provinsi'			=> 'Jawa Timur',
								'negara'			=> 'Indonesia',
							];

			// $nasabah['nik']					= '35-73-03-'.rand(100000,710000).'-000'.rand(1,4);
			$nasabah['nik']					= Pengajuan::first()['nasabah']['nik'];
			$nasabah['nama'] 				= $faker->name;
			$nasabah['tanggal_lahir'] 		= Carbon::parse(rand(17,60).' years ago')->format('d/m/Y');
			$nasabah['tempat_lahir']		= $kab[rand(0,28)];
			$nasabah['jenis_kelamin']		= $gndr[rand(0,1)];
			$nasabah['telepon']				= $faker->phoneNumber;
			$nasabah['status_perkawinan']	= $sp[rand(0,3)];
			$nasabah['pekerjaan']			= $pekerjaan[rand(0,5)];
			$nasabah['penghasilan_bersih']	= 'Rp '.rand(1,9).rand(1,9).'00.000';
			$nasabah['alamat']				= $alamat;
			$nasabah['keluarga'][0]['hubungan']	= $hubungan[rand(0,2)];
			$nasabah['keluarga'][0]['nama']		= $faker->name;
			$nasabah['keluarga'][0]['nik']		= '35-73-03-'.rand(100000,710000).'-000'.rand(1,4);
			$nasabah['keluarga'][0]['telepon']	= $faker->phoneNumber;

			$dokumen_pelengkap 				= ['ktp' => $foto[rand(0,4)], 'kk' => $kk[rand(0,4)]];

			if($mobile)
			{
				$nip_ao 		= ['nip' => Orang::first()['nip'], 'nama' => Orang::first()['nama']];
				$nasabah 		= [];
				$nasabah['telepon']	= $faker->phoneNumber;
				$dokumen_pelengkap 	= ['ktp' => $foto[rand(0,4)]];
			}
			elseif(rand(1,1))
			{
				$nip_ao 		= ['nip' => Orang::first()['nip'], 'nama' => Orang::first()['nama']];
			}

			$data 	= [
				'kemampuan_angsur'	=> $this->formatMoneyTo($angsuran),	
				'pokok_pinjaman'	=> $this->formatMoneyTo($pokok_pinjaman),
				'is_mobile'			=> $mobile,
				'ao'				=> $nip_ao,
				'kode_kantor'		=> Kantor::whereIn('jenis', ['koperasi', 'bpr'])->first()['id'],
				'nasabah'			=> $nasabah,
				'dokumen_pelengkap'	=> $dokumen_pelengkap,
			];

			$pengajuan[] =	Pengajuan::create($data);
		}

		//SIMPAN JAMINAN
		foreach ($pengajuan as $key => $value) 
		{
			$jenis_jaminan 	= $jj[rand(0,2)];
			// $jenis_jaminan 	= 'shm';
			$nama 			= $value['nasabah']['nama'];
			$alamat 		= $value['nasabah']['alamat'];

			if(rand(0,1) || is_null($nama))
			{
				$nama 		= $faker->name;
				$alamat		= 	[
							'alamat'			=> $faker->address,
							'rt'				=> '00'.rand(0,9),
							'rw'				=> '00'.rand(0,9),
							'kota'				=> $kab[rand(0,28)],
							'provinsi'			=> 'Jawa Timur',
							'negara'			=> 'Indonesia',
						];
			}

			switch ($jenis_jaminan) 
			{
				case 'shm':
				$jaminan 	= $this->generate_shm($value['id'], $nama, $alamat);
				// $jaminan_2 	= $this->generate_shm($value['id'], $nama, $alamat);
				// $jaminan_3 	= $this->generate_shm($value['id'], $nama, $alamat);
				// $jaminan_4 	= $this->generate_shm($value['id'], $nama, $alamat);
					break;				
				case 'shgb':
				$jaminan 	= $this->generate_shgb($value['id'], $nama, $alamat);
				// $jaminan_2 	= $this->generate_shgb($value['id'], $nama, $alamat);
				// $jaminan_3 	= $this->generate_shgb($value['id'], $nama, $alamat);
				// $jaminan_4 	= $this->generate_shgb($value['id'], $nama, $alamat);
					break;
				default:
				$jaminan 	= $this->generate_bpkb($value['id'], $nama);
				// $jaminan_2 	= $this->generate_bpkb($value['id'], $nama);
				// $jaminan_3 	= $this->generate_bpkb($value['id'], $nama);
				// $jaminan_4 	= $this->generate_bpkb($value['id'], $nama);
					break;
			}

			Jaminan::create($jaminan);
			// Jaminan::create($jaminan_2);
			// Jaminan::create($jaminan_3);
			// Jaminan::create($jaminan_4);
		}

	}

	private function generate_bpkb($pengajuan_id, $name)
	{
		$data['pengajuan_id']			= $pengajuan_id;
		$data['jenis']					= 'bpkb';
		$data['nilai_jaminan']			= $this->formatMoneyTo(rand(10,100)*1000000);
		$data['tahun_perolehan']		= rand(1990,2016);
		$data['dokumen_jaminan']['bpkb']['jenis']		= $this->type_k[rand(0,3)];
		$data['dokumen_jaminan']['bpkb']['merk']		= $this->merk_k[rand(0,9)];
		$data['dokumen_jaminan']['bpkb']['tahun']		= rand(1990,2016);
		$data['dokumen_jaminan']['bpkb']['nomor_bpkb']	= Jaminan::where('jenis', 'bpkb')->first()['dokumen_jaminan']['bpkb']['nomor_bpkb'];
		// $data['dokumen_jaminan']['bpkb']['nomor_bpkb']	= $this->char[rand(0,25)].' '.rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9);
		$data['dokumen_jaminan']['bpkb']['atas_nama']		= $name;
		$data['dokumen_jaminan']['bpkb']['tipe']			= $this->jenis_k[$data['dokumen_jaminan']['bpkb']['jenis']][rand(0,1)];
		$data['dokumen_jaminan']['bpkb']['tahun_perolehan']	= rand(1990,2016);

		return $data;
	}

	private function generate_shgb($pengajuan_id, $name, $address)
	{
		$ltanah 						= rand(36,108);

		$data['pengajuan_id']			= $pengajuan_id;
		$data['jenis']					= 'shgb';
		$data['nilai_jaminan']			= $this->formatMoneyTo(rand(100,500)*1000000);
		$data['tahun_perolehan']		= rand(1990,2016);
		$data['dokumen_jaminan']['shgb']['tipe']					= 'tanah_dan_bangunan';
		$data['dokumen_jaminan']['shgb']['nomor_sertifikat']		= Jaminan::where('jenis', 'shgb')->first()['dokumen_jaminan']['shgb']['nomor_sertifikat'];
		// $data['dokumen_jaminan']['shgb']['nomor_sertifikat']		= rand(11,19).'-'.rand(11,99).'-'.rand(11,99).'-'.rand(11,99).'-'.rand(0,9).'-'.rand(10001, 99999);
		$data['dokumen_jaminan']['shgb']['masa_berlaku_sertifikat']	= rand(2018,2050);
		$data['dokumen_jaminan']['shgb']['atas_nama']				= $name;
		$data['dokumen_jaminan']['shgb']['luas_tanah']				= $ltanah;
		$data['dokumen_jaminan']['shgb']['luas_bangunan']			= round(($ltanah/(rand(200,500)) *100), 2);
		$data['dokumen_jaminan']['shgb']['alamat']					= $address;
		$data['dokumen_jaminan']['shgb']['tahun_perolehan']			= rand(1990,2016);

		return $data;
	}

	private function generate_shm($pengajuan_id, $name, $address)
	{
		$ltanah 						= rand(36,108);

		$tipe 							= $this->type_tb[rand(0,1)];

		$data['pengajuan_id']			= $pengajuan_id;
		$data['jenis']					= 'shm';
		$data['nilai_jaminan']			= $this->formatMoneyTo(rand(100,500)*1000000);
		$data['tahun_perolehan']		= rand(1990,2016);
		$data['dokumen_jaminan']['shm']['tipe']					= $tipe;
		$data['dokumen_jaminan']['shm']['nomor_sertifikat']		= Jaminan::where('jenis', 'shm')->first()['dokumen_jaminan']['shm']['nomor_sertifikat'];
		// $data['dokumen_jaminan']['shm']['nomor_sertifikat']		= rand(11,19).'-'.rand(11,99).'-'.rand(11,99).'-'.rand(11,99).'-'.rand(0,9).'-'.rand(10001, 99999);
		$data['dokumen_jaminan']['shm']['atas_nama']			= $name;
		$data['dokumen_jaminan']['shm']['luas_tanah']			= $ltanah;
		$data['dokumen_jaminan']['shm']['alamat']				= $address;
		$data['dokumen_jaminan']['shm']['tahun_perolehan']		= rand(1990,2016);

		if($tipe=='tanah_dan_bangunan')
		{
			$data['dokumen_jaminan']['shm']['luas_bangunan']	= round(($ltanah/(rand(200,500)) *100), 2);
		}

		return $data;
	}
}
