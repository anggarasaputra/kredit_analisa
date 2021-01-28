<?php

use Illuminate\Database\Seeder;
use Thunderlabid\Manajemen\Models\Orang;
use Thunderlabid\Manajemen\Models\Kantor;

use Thunderlabid\Pengajuan\Models\Pengajuan;
use Thunderlabid\Pengajuan\Models\Jaminan;
use Thunderlabid\Pengajuan\Models\Status;

use Thunderlabid\Pengajuan\Traits\IDRTrait;

use Thunderlabid\Territorial\Models\Desa;
use Thunderlabid\Territorial\Models\Distrik;
use Thunderlabid\Territorial\Models\Regensi;

use Carbon\Carbon;

class PengajuanTableSeeder extends Seeder
{
	use IDRTrait;

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('p_jaminan')->truncate();
		DB::table('p_status')->truncate();
		DB::table('p_pengajuan')->truncate();
		
		//INIT VARIABLE HELPER
		$faker		= \Faker\Factory::create();

		$jk   		= ['pa', 'pt', 'rumah_delta'];
		$gndr   	= ['perempuan', 'laki-laki'];
		$sp   		= ['belum_kawin', 'kawin', 'cerai', 'cerai_mati'];
		
		$kel 		=  ['ARJOWINANGUN', 'TLOGOWARU', 'WONOKOYO', 'BUMIAYU', 'BURING', 'MERGOSONO', 'KOTALAMA', 'KEDUNGKANDANG', 'SAWOJAJAR', 'MADYOPURO', 'LESANPURO', 'CEMOROKANDANG', 'KEBONSARI', 'GADANG', 'CIPTOMULYO', 'SUKUN', 'BANDUNGREJOSARI', 'BAKALAN KRAJAN', 'MULYOREJO', 'BANDULAN', 'TANJUNGREJO', 'PISANG CANDI', 'KARANG BESUKI', 'KASIN', 'SUKOHARJO', 'KIDUL DALEM', 'KAUMAN', 'BARENG', 'GADINGKASRI', 'ORO ORO DOWO', 'KLOJEN', 'RAMPAL CELAKET', 'SAMAAN', 'PENANGGUNGAN', 'JODIPAN', 'POLEHAN', 'KESATRIAN', 'BUNULREJO', 'PURWANTORO', 'PANDANWANGI', 'BLIMBING', 'PURWODADI', 'POLOWIJEN', 'ARJOSARI', 'BALEARJOSARI', 'MERJOSARI', 'DINOYO', 'SUMBERSARI', 'KETAWANGGEDE', 'JATIMULYO', 'LOWOKWARU', 'TULUSREJO', 'MOJOLANGU', 'TUNJUNGSEKAR', 'TASIKMADU', 'TUNGGULWULUNG', 'TLOGOMAS', 'TRIWUNG KIDUL', 'KADEMANGAN', 'POHSANGIT KIDUL', 'PILANG', 'TRIWUNG LOR', 'KETAPANG', 'SUMBER WETAN', 'KARENG LOR', 'KEDOPOK', 'JREBENG KULON', 'JREBENG WETAN', 'JREBENG LOR', 'WONOASIH', 'JREBENG KIDUL', 'PAKISTAJI', 'KEDUNGGALENG', 'KEDUNGASEM', 'SUMBERTAMAN', 'WIROBORANG', 'JATI', 'SUKABUMI', 'MANGUNHARJO', 'MAYANGAN', 'CURAHGRINTING', 'KANIGARAN', 'KEBONSARI WETAN', 'SUKOHARJO', 'KEBONSARI KULON', 'TISNONEGARAN', 'KRAPYAKREJO', 'BUKIR', 'SEBANI', 'GENTONG', 'GADINGREJO', 'PETAHUNAN', 'RANDUSARI', 'KARANGKETUG', 'POHJENTREK', 'WIROGUNAN', 'TEMBOKREJO', 'PURUTREJO', 'KEBONAGUNG', 'PURWOREJO', 'SEKARGADUNG', 'BAKALAN', 'KRAMPYANGAN', 'BLANDONGAN', 'KEPEL', 'BUGULKIDUL', 'TAPAAN', 'PETAMANAN', 'PEKUNCEN', 'BUGULLOR', 'KANDANGSAPI', 'BANGILAN', 'KEBONSARI', 'KARANGANYAR', 'TRAJENG', 'MAYANGAN', 'MANDARANREJO', 'PANGGUNGREJO', 'NGEMPLAKREJO', 'TAMBAAN', 'SURODINAWAN', 'KRANGGAN', 'MIJI', 'PRAJURIT KULON', 'BLOOTO', 'MENTIKAN', 'KAUMAN', 'PULOREJO', 'MERI', 'GUNUNG GEDANGAN', 'KEDUNDUNG', 'BALONGSARI', 'JAGALAN', 'SENTANAN', 'PURWOTENGAH', 'GEDONGAN', 'MAGERSARI', 'WATES', 'NAMBANGAN KIDUL', 'NAMBANGAN LOR', 'MANGUHARJO', 'PANGONGANGAN', 'WINONGO', 'MADIUN LOR', 'PATIHAN', 'NGEGONG', 'SOGATEN', 'JOSENAN', 'KUNCEN', 'DEMANGAN', 'BANJAREJO', 'PANDEAN', 'KEJURON', 'TAMAN', 'MOJOREJO', 'MANISREJO', 'KARTOHARJO', 'ORO ORO OMBO', 'KLEGEN', 'KANIGORO', 'PILANGBANGO', 'REJOMULYO', 'SUKOSARI', 'TAWANGREJO', 'KELUN', 'WARUGUNUNG', 'KARANG PILANG', 'KEBRAON', 'KEDURUS', 'PAGESANGAN', 'KEBONSARI', 'JAMBANGAN', 'KARAH', 'DUKUH MENANGGAL', 'MENANGGAL', 'GAYUNGAN', 'KETINTANG', 'SIWALANKERTO', 'JEMUR WONOSARI', 'MARGOREJO', 'BENDUL MERISI', 'SIDOSERMO', 'KUTISARI', 'KENDANGSARI', 'TENGGILIS MEJOYO', 'PANJANG JIWO', 'RUNGKUT MENANGGAL', 'RUNGKUT TENGAH', 'GUNUNG ANYAR', 'GUNUNG ANYAR TAMBAK', 'RUNGKUT KIDUL', 'MEDOKAN AYU', 'WONOREJO', 'PENJARINGAN SARI', 'KEDUNG BARUK', 'KALI RUNGKUT', 'NGIDEN JANGKUNGAN', 'SEMOLOWARU', 'MEDOKAN SEMAMPIR', 'KEPUTIH', 'GEBANG PUTIH', 'KLAMPIS NGASEM', 'MENUR PUMPUNGAN', 'MANYAR SABRANGAN', 'MULYOREJO', 'KEJAWEN PUTIH TAMBAK', 'KALISARI', 'DUKUH SUTOREJO', 'KALIJUDAN', 'BARATAJAYA', 'PUCANG SEWU', 'KERTAJAYA', 'GUBENG', 'AIRLANGGA', 'MOJO', 'SAWUNGGALING', 'WONOKROMO', 'JAGIR', 'NGAGELREJO', 'NGAGEL', 'DARMO', 'GUNUNGSARI', 'DUKUH PAKIS', 'PRADAHKALI KENDAL', 'DUKUH KUPANG', 'BALAS KLUMPRIK', 'BABATAN', 'WIYUNG', 'JAJAR TUNGGAL', 'BANGKINGAN', 'SUMUR WELUT', 'LIDAH WETAN', 'LIDAH KULON', 'JERUK', 'LAKARSANTRI', 'MADE', 'BRINGIN', 'SAMBIKEREP', 'LONTAR', 'KARANGPOH', 'BALONGSARI', 'MANUKAN WETAN', 'MANUKAN KULON', 'BANJAR SUGIHAN', 'TANDES', 'PUTAT GEDE', 'SONO KWIJENAN', 'SIMOMULYO', 'SUKO MANUNGGAL', 'TANJUNGSARI', 'SIMOMULYO BARU', 'PAKIS', 'PUTAT JAYA', 'BANYU URIP', 'KUPANG KRAJAN', 'PETEMON', 'SAWAHAN', 'KEPUTRAN', 'DR. SUTOMO', 'TEGALSARI', 'WONOREJO', 'KEDUNGDORO', 'EMBONG KALIASIN', 'KETABANG', 'GENTENG', 'PENELEH', 'KAPASARI', 'PACAR KELING', 'PACAR KEMBANG', 'PLOSO', 'TAMBAKSARI', 'RANGKAH', 'GADING', 'KAPASMADYA BARU', 'DUKUH SETRO', 'TANAH KALI KEDINDING', 'SIDOTOPO WETAN', 'BULAK BANTENG', 'TAMBAK WEDI', 'KENJERAN', 'BULAK', 'KEDUNG COWEK', 'SUKOLILO BARU', 'KAPASAN', 'TAMBAKREJO', 'SIMOKERTO', 'SIDODADI', 'SIMOLAWANG', 'AMPEL', 'SIDOTOPO', 'PEGIRIAN', 'WONOKUSUMO', 'UJUNG', 'BONGKARAN', 'NYAMPLUNGAN', 'KREMBANGAN UTARA', 'PERAK TIMUR', 'PERAK UTARA', 'TEMBOK DUKUH', 'BUBUTAN', 'ALON-ALON CONTONG', 'GUNDIH', 'JEPARA', 'DUPAK', 'MOROKREMBANGAN', 'PERAK BARAT', 'KEMAYORAN', 'KREMBANGAN SELATAN', 'ASEMROWO', 'GENTING KALIANAK', 'TAMBAK SARIOSO', 'SEMEMI', 'KANDANGAN', 'TAMBAK OSO WILANGON', 'ROMOKALISARI', 'BABAT JERAWAT', 'PAKAL', 'BENOWO', 'SUMBERREJO', 'ORO-ORO OMBO', 'TEMAS', 'SISIR', 'NGAGLIK', 'PESANGGRAHAN', 'SONGGOKERTO', 'SUMBEREJO', 'SIDOMULYO', 'TLEKUNG', 'JUNREJO', 'MOJOREJO', 'TORONGREJO', 'BEJI', 'PENDEM', 'DADAPREJO', 'PANDANREJO', 'BUMIAJI', 'BULUKERTO', 'GUNUNGSARI', 'PUNTEN', 'TULUNGREJO', 'SUMBERGONDO', 'GIRIPURNO', 'SUMBER BRANTAS'];
		$kec 		= ['KEDUNGKANDANG', 'SUKUN', 'KLOJEN', 'BLIMBING', 'LOWOKWARU', 'KADEMANGAN', 'KEDOPOK', 'WONOASIH', 'MAYANGAN', 'KANIGARAN', 'GADINGREJO', 'PURWOREJO', 'BUGULKIDUL', 'PANGGUNGREJO', 'PRAJURIT', 'MAGERSARI', 'MANGU', 'TAMAN', 'KARTOHARJO', 'KARANG', 'JAMBANGAN', 'GAYUNGAN', 'WONOCOLO', 'TENGGILIS', 'GUNUNG', 'RUNGKUT', 'SUKOLILO', 'MULYOREJO', 'GUBENG', 'WONOKROMO', 'DUKUH', 'WIYUNG', 'LAKARSANTRI', 'SAMBIKEREP', 'TANDES', 'SUKO', 'SAWAHAN', 'TEGALSARI', 'GENTENG', 'TAMBAKSARI', 'KENJERAN', 'BULAK', 'SIMOKERTO', 'SEMAMPIR', 'PABEAN', 'BUBUTAN', 'KREMBANGAN', 'ASEMROWO', 'BENOWO', 'PAKAL', 'BATU', 'JUNREJO', 'BUMIAJI'];

		$kota		= ['KOTA MALANG', 'KOTA PROBOLINGGO', 'KOTA PASURUAN', 'KOTA MOJOKERTO', 'KOTA MADIUN', 'KOTA SURABAYA', 'KOTA BATU'];

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
		
		$hubungan		= ['orang_tua', 'suami', 'istri', 'anak'];

		//JAMINAN
		$jj	= ['bpkb', 'shm', 'shgb'];

		$this->type_k	= ['roda_2', 'roda_3', 'roda_4', 'roda_6'];
		$this->type_tb	= ['tanah', 'tanah_dan_bangunan'];
		$this->merk_k	= ['honda', 'yamaha', 'suzuki', 'kawasaki', 'mitsubishi', 'toyota', 'nissan', 'kia', 'daihatsu', 'isuzu'];
		$this->jenis_k	= ['roda_2' => ['bebek', 'ninja'], 'roda_3' => ['bajaj', 'backtruck'], 'roda_4' => ['suv', 'pickup'], 'roda_6' => ['truck', 'bis']];
		$this->char 	= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';


		//BASIC PENGAJUAN
		foreach (range(0, 99) as $value) 
		{
			$pokok_pinjaman 	= (rand(25,250)) * 100000;
			$bunga 				= (rand(100,500))/1000;
			$jangka_waktu 		= rand(4,12)*3;
			$angsuran 			= ($pokok_pinjaman + ($pokok_pinjaman*$bunga))/$jangka_waktu;
			$angsuran 			= ceil($angsuran/100000);
			$angsuran 			= $angsuran * 100000;
			$mobile 			= rand(0,1);
			$nip_ao				= null;

			$alamat		= 	[
								'alamat'			=> $faker->address,
								'rt'				=> '00'.rand(0,9),
								'rw'				=> '00'.rand(0,9),
								'kelurahan'			=> $kel[rand(0, count($kel)-1)],
								'kecamatan'			=> $this->rand_kec(),
								'kota'				=> $this->rand_kota(),
								'provinsi'			=> 'Jawa Timur',
								'negara'			=> 'Indonesia',
							];

			$nasabah['nik']					= '35-73-03-'.rand(100000,710000).'-000'.rand(1,4);
			$nasabah['nama'] 				= $faker->name;
			$nasabah['tanggal_lahir'] 		= Carbon::parse(rand(19,60).' years ago')->format('d/m/Y');
			$nasabah['tempat_lahir']		= $kota[rand(0,6)];
			$nasabah['jenis_kelamin']		= $gndr[rand(0,1)];
			$nasabah['telepon']				= $faker->phoneNumber;
			$nasabah['status_perkawinan']	= $sp[rand(0,3)];
			$nasabah['pekerjaan']			= $pekerjaan[rand(0,5)];
			$nasabah['penghasilan_bersih']	= 'Rp '.rand(1,9).rand(1,9).'00.000';
			$nasabah['alamat']				= $alamat;
			$idx_h 	= rand(0,3);
			if(in_array($idx_h, [1,2]))
			{
				if($gndr=='perempuan')
				{
					$nasabah['keluarga'][0]['hubungan']	= 'suami';
				}
				else
				{
					$nasabah['keluarga'][0]['hubungan']	= 'istri';
				}
			}
			else
			{
				$nasabah['keluarga'][0]['hubungan']	= $hubungan[$idx_h];
			}
			$nasabah['keluarga'][0]['nama']		= $faker->name;
			$nasabah['keluarga'][0]['nik']		= '35-73-03-'.rand(100000,710000).'-000'.rand(1,4);
			$nasabah['keluarga'][0]['telepon']	= $faker->phoneNumber;

			$dokumen_pelengkap 				= ['ktp' => $foto[rand(0,4)], 'kk' => $kk[rand(0,4)]];

			if($mobile)
			{
				$nip_ao 		= ['nip' => Orang::first()['nip'], 'nama' => Orang::first()['nama']];
				// $nasabah 		= [];
				// $nasabah['telepon']	= $faker->phoneNumber;
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

			$pengajuan 	= Pengajuan::create($data);
			$status 	= Status::where('pengajuan_id', $pengajuan['id'])->orderby('created_at', 'desc')->first();
			$status->tanggal 	= Carbon::now()->subHours(rand(48,72))->format('d/m/Y h:i');
			$status->save();
		}

		//SIMPAN JAMINAN
		$pengajuan 		= Pengajuan::get();

		foreach ($pengajuan as $key => $value) 
		{
			$jenis_jaminan 	= $jj[rand(0,2)];
			$nama 			= $value['nasabah']['nama'];
			$alamat 		= $value['nasabah']['alamat'];

			if(rand(0,1) || is_null($nama))
			{
				$nama 		= $faker->name;
				$alamat		= 	[
								'alamat'			=> $faker->address,
								'rt'				=> '00'.rand(0,9),
								'rw'				=> '00'.rand(0,9),
								'kelurahan'			=> $kel[rand(0, count($kel)-1)],
								'kecamatan'			=> $this->rand_kec(),
								'kota'				=> $this->rand_kota(),
								'provinsi'			=> 'Jawa Timur',
								'negara'			=> 'Indonesia',
							];
			}

			$alamat_2		= 	[
								'alamat'			=> $faker->address,
								'rt'				=> '00'.rand(0,9),
								'rw'				=> '00'.rand(0,9),
								'kelurahan'			=> $kel[rand(0, count($kel)-1)],
								'kecamatan'			=> $this->rand_kec(),
								'kota'				=> $this->rand_kota(),
								'provinsi'			=> 'Jawa Timur',
								'negara'			=> 'Indonesia',
							];
			switch ($jenis_jaminan) 
			{
				case 'shm':
				$jaminan 	= $this->generate_shm($value['id'], $nama, $alamat);
				$jaminan_2 	= $this->generate_shm($value['id'], $nama, $alamat_2);
				// $jaminan_3 	= $this->generate_shm($value['id'], $nama, $alamat);
				// $jaminan_4 	= $this->generate_shm($value['id'], $nama, $alamat);
					break;				
				case 'shgb':
				$jaminan 	= $this->generate_shgb($value['id'], $nama, $alamat);
				$jaminan_2 	= $this->generate_shgb($value['id'], $nama, $alamat_2);
				// $jaminan_3 	= $this->generate_shgb($value['id'], $nama, $alamat);
				// $jaminan_4 	= $this->generate_shgb($value['id'], $nama, $alamat);
					break;
				default:
				$jaminan 	= $this->generate_bpkb($value['id'], $nama);
				$jaminan_2 	= $this->generate_bpkb($value['id'], $nama);
				// $jaminan_3 	= $this->generate_bpkb($value['id'], $nama);
				// $jaminan_4 	= $this->generate_bpkb($value['id'], $nama);
					break;
			}

			Jaminan::create($jaminan);
			Jaminan::create($jaminan_2);
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
		$data['dokumen_jaminan']['bpkb']['nomor_bpkb']	= $this->char[rand(0,25)].' '.rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9);
		// $data['dokumen_jaminan']['bpkb']['nomor_bpkb']	= 'F 1111111';
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
		$data['dokumen_jaminan']['shgb']['nomor_sertifikat']		= rand(11,19).'-'.rand(11,99).'-'.rand(11,99).'-'.rand(11,99).'-'.rand(0,9).'-'.rand(10001, 99999);
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
		$data['dokumen_jaminan']['shm']['nomor_sertifikat']		= rand(11,19).'-'.rand(11,99).'-'.rand(11,99).'-'.rand(11,99).'-'.rand(0,9).'-'.rand(10001, 99999);
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

	private function rand_kel(){
		$total_kel 	= Desa::where(function($q){
			$q->where('territorial_distrik_id', 'like', '3505%')
			->where('territorial_distrik_id', 'like', '3506%')
			->orwhere('territorial_distrik_id', 'like', '3507%')
			->orwhere('territorial_distrik_id', 'like', '3508%')
			->orwhere('territorial_distrik_id', 'like', '3509%')
			->orwhere('territorial_distrik_id', 'like', '3510%');
		})->count();

		$kel 	= Desa::where(function($q){
			$q->where('territorial_distrik_id', 'like', '3505%')
			->where('territorial_distrik_id', 'like', '3506%')
			->orwhere('territorial_distrik_id', 'like', '3507%')
			->orwhere('territorial_distrik_id', 'like', '3508%')
			->orwhere('territorial_distrik_id', 'like', '3509%')
			->orwhere('territorial_distrik_id', 'like', '3510%');
		})->skip(rand(0,($total_kel-1)))->first();	

		$this->d_id = $kel['territorial_distrik_id'];
		
		return $kel['nama'];	
	}

	private function rand_kec(){
		if(isset($this->d_id))
		{
			$data 		= Distrik::where('id', $this->d_id)->first();
			$this->r_id = $data['territorial_regensi_id'];
			return $data['nama'];
		}

		$total_kec 	= Distrik::where(function($q){
			$q->where('territorial_regensi_id', 'like', '3505%')
			->orwhere('territorial_regensi_id', 'like', '3506%')
			->orwhere('territorial_regensi_id', 'like', '3507%')
			->orwhere('territorial_regensi_id', 'like', '3508%')
			->orwhere('territorial_regensi_id', 'like', '3509%')
			->orwhere('territorial_regensi_id', 'like', '3510%');
		})->count();	

		$data 	= Distrik::where(function($q){
			$q->where('territorial_regensi_id', 'like', '3505%')
			->orwhere('territorial_regensi_id', 'like', '3506%')
			->orwhere('territorial_regensi_id', 'like', '3507%')
			->orwhere('territorial_regensi_id', 'like', '3508%')
			->orwhere('territorial_regensi_id', 'like', '3509%')
			->orwhere('territorial_regensi_id', 'like', '3510%');
		})->skip(rand(0,($total_kec-1)))->first();	
		
		$this->r_id = $data['territorial_regensi_id'];
		return $data['nama'];
	}

	private function rand_kota(){
		if(isset($this->r_id))
		{
			$data 		= Regensi::where('id', $this->r_id)->first();
			$this->p_id = $data['territorial_provinsi_id'];
			return $data['nama'];
		}

		$total_kec 	= Regensi::where(function($q){
			$q->where('territorial_provinsi_id', 'like', '3505')
			->orwhere('territorial_provinsi_id', 'like', '3506')
			->orwhere('territorial_provinsi_id', 'like', '3507')
			->orwhere('territorial_provinsi_id', 'like', '3508')
			->orwhere('territorial_provinsi_id', 'like', '3509')
			->orwhere('territorial_provinsi_id', 'like', '3510');
		})->count();	

		$data 	= Regensi::where(function($q){
			$q->where('territorial_provinsi_id', 'like', '3505')
			->orwhere('territorial_provinsi_id', 'like', '3506')
			->orwhere('territorial_provinsi_id', 'like', '3507')
			->orwhere('territorial_provinsi_id', 'like', '3508')
			->orwhere('territorial_provinsi_id', 'like', '3509')
			->orwhere('territorial_provinsi_id', 'like', '3510');
		})->skip(rand(0,($total_kec-1)))->first();	
		
		$this->p_id = $kel['territorial_provinsi_id'];
		return $data['nama'];
	}
}
