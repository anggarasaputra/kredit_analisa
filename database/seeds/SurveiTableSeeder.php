<?php

use Illuminate\Database\Seeder;
use Thunderlabid\Manajemen\Models\Orang;

use Thunderlabid\Pengajuan\Models\Pengajuan;

use Thunderlabid\Survei\Models\Survei;
use Thunderlabid\Survei\Models\SurveiFoto;
use Thunderlabid\Survei\Models\SurveiDetail;
use Thunderlabid\Survei\Models\AssignedSurveyor;

use Thunderlabid\Survei\Traits\IDRTrait;

use Carbon\Carbon;

class SurveiTableSeeder extends Seeder
{
	use IDRTrait;

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('s_survei')->truncate();
		DB::table('s_survei_detail')->truncate();
		DB::table('s_survei_foto')->truncate();
		DB::table('s_survei_lokasi')->truncate();
		DB::table('s_assigned_surveyor')->truncate();

		$faker		= \Faker\Factory::create();
		
		$char_kenal 		= ['dikenal', 'kurang_dikenal', 'tidak_dikenal'];
		$char_watak 		= ['baik', 'cukup_baik', 'tidak_baik'];
		$char_pola_hidup 	= ['mewah', 'sederhana'];
		$char_info			= ['Kurang tahu ya', 'Orangnya baik', 'Kayaknya jarang pulang', 'Ramah'];
		$char_catatan 		= ['Jarang membayar iuran RT', 'Selalu membayar iuran RT tahunan'];

		$cond_pu 			= ['padat', 'sedang', 'biasa'];
		$cond_ppu 			= ['padat', 'sedang', 'lambat'];
		$cond_pgu 			= ['<1 tahun', '2-3 tahun', '3-5 tahun', '>5 tahun'];
		$cond_risk 			= ['bagus', 'biasa', 'suram'];
		$cond_cust 			= ['0 - 10', '10 - 50', '50 - 100', '> 100'];
		$cond_catatan 		= ['Usaha bergantung musim', 'Usaha tidak bergantung musim'];

		$cap_sppj 			= ['Gaji', 'Laba Usaha'];
		$cap_catatan 		= ['Usaha memberi piutang', 'Usaha tidak memberi piutang'];

		$capi_owner 		= ['milik_sendiri','keluarga','dinas','sewa'];
		$capi_ousaha 		= ['milik_sendiri','milik_keluarga','kerjasama_bagi_hasil'];
		$capi_busaha		= ['media', 'perkebunan', 'garmen', 'kuliner'];
		$sper 				= ['K','TK','K-1','K-2','K-3'];
		$nm_bank 			= ['bca', 'bni', 'niaga', 'mandiri'];

		$this->warna		= ['putih', 'biru', 'pink', 'hitam', 'hijau', 'abu-abu'];
		$this->fs_harian	= ['Transportasi pribadi', 'Disewakan', 'Transportasi usaha', 'Dipinjamkan untuk NPO'];
		$this->y_n 			= ['ada', 'tidak_ada'];
		$this->jbpkb_kond 	= ['baik', 'cukup_baik', 'buruk'];
		$this->jbpkb_sowner	= ['an_sendiri','an_orang_lain_milik_sendiri','an_orang_lain_dengan_surat_kuasa'];
		$this->asuransi 	= ['all_risk','tlo','tidak_ada'];

		$this->fs_bangunan 		= ['ruko','rukan','rumah'];
		$this->bntk_bangunan 	= ['tingkat','tidak_tingkat'];
		$this->kons_bangunan 	= ['permanen','semi_permanen'];
		$this->lantai_bangunan 	= ['keramik','tegel_biasa'];
		$this->dinding 			= ['tembok','semi_tembok'];
		$this->listrik 			= ['450 watt','950 watt'];
		$this->air 				= ['pdam','sumur'];
		$this->lain_lain 		= ['ac','telepon'];

		$this->jalan 		= ['tanah','batu','aspal'];
		$this->lltj 		= ['sama','lebih_rendah','lebih_tinggi'];
		$this->ling 		= ['perumahan','kampung','pertokoan','pasar','perkantoran','industri'];

		$paket_foto_tanah 	= [
			[
				'url'			=> 'http://rumahdijual.org/athumb/b/3/8/big356208.jpg',
				'keterangan'	=> 'Pekarangan',
			],
			[
				'url'			=> 'http://www.balirealproperty.com/photo/property/property-1353644223-tjub144-jual-tanah-di-ubud-08jpg.jpg',
				'keterangan'	=> 'Lokasi Dekat Jalan',
			],
			[
				'url'			=> 'https://anekarumahjogja.files.wordpress.com/2011/06/jual-tanah-jogja4.jpg',
				'keterangan'	=> 'Tanah Garap',
			],
		];
		$paket_foto_rumah 	= [
			[
				'url'			=> 'https://tipsjualrumah13.files.wordpress.com/2011/12/rumah-dijual-murah.jpg',
				'keterangan'	=> 'Tampak Depan',
			],
			[
				'url'			=> 'http://gambar-rumah.com/attachments/bandung/3961277d1448412187-dijual-rumah-minimalis-di-kolmas-cimahi-bandung-tampak-samping.jpg',
				'keterangan'	=> 'Tampak Samping',
			],
			[
				'url'			=> 'http://gambar-rumah.com/attachments/jakarta-selatan/95789d1335353396-dijual-rumah-minimalis-di-bintaro-village-tampak-depan-dan-samping.jpg',
				'keterangan'	=> 'Lokasi Perempatan',
			],
		];
		
		$paket_foto_apartment = [
			[
				'url'			=> 'http://gambar-rumah.com/attachments/bandung/5538357d1463016564-jual-apartemen-baru-murah-bandung-utara-condotel-dago-clove-screenshot_2015-10-23-17-29-36.jpg',
				'keterangan'	=> 'Jacuzzi',
			],
			[
				'url'			=> 'http://rumahdijual.org/athumb/5/e/c/big3428868.jpg',
				'keterangan'	=> 'Denah Apartment',
			],
			[
				'url'			=> 'http://media.equityapartments.com/images/c_crop,x_0,y_0,w_1920,h_1080/c_fill,w_1920,h_1080/q_80/4206-28/the-kelvin-apartments-exterior.jpg',
				'keterangan'	=> 'Tampak Depan Lingkungan Apartment',
			],
		];


		$paket_foto_roda_2 	= [
			[
				'url'			=> 'https://lh3.googleusercontent.com/-sdfmrIX9xpA/VWZ8OAAsBRI/AAAAAAAAMdQ/SZfSz1MudRs/s2560/1432779830565.jpeg',
				'keterangan'	=> 'Foto Jaminan',
			],
			[
				'url'			=> 'https://img.olx.biz.id/A5B8/42424/308242424_3_644x461_dijual-motor-nmax-abs-th-2016-bln-09-km-baru-3-ribuan-yamaha.jpg',
				'keterangan'	=> 'Foto Jaminan',
			],
			[
				'url'			=> 'http://img.olx.biz.id/A197/41367/358876314_1_644x461_dijual-motor-yamaha-vixion-keluaran-tahun-2015-palembang-kota.jpg',
				'keterangan'	=> 'Foto Jaminan',
			],
		];

		$paket_foto_roda_3 	= [
			[
				'url'			=> 'http://otoboy.com/wp-content/uploads/2016/03/Harga-Motor-Roda-Tiga-Viar.jpg',
				'keterangan'	=> 'Foto Jaminan',
			],
			[
				'url'			=> 'https://storage.jualo.com/original/1343808/dijual-bajaj-bbg-tvs-lain-lain-1343808.jpg',
				'keterangan'	=> 'Foto Jaminan',
			],
			[
				'url'			=> 'https://i.pinimg.com/originals/73/87/d9/7387d9c18c4e24bebabd703706afc5a6.jpg',
				'keterangan'	=> 'Foto Jaminan',
			],
		];

		$paket_foto_roda_4 	= [
			[
				'url'			=> 'http://www.promosuzuki.com/wp-content/uploads/2015/11/keunggulan-mobil-carry.jpg',
				'keterangan'	=> 'Foto Jaminan',
			],
			[
				'url'			=> 'http://www.asapmobil.com/wp-content/uploads/2015/06/Harga-Mobil-Terbaru-Hyundai-Creta-Indonesia.jpg',
				'keterangan'	=> 'Foto Jaminan',
			],
			[
				'url'			=> 'http://1.bp.blogspot.com/-23MAGluLmKQ/VbJXdYG8rLI/AAAAAAAACqQ/AI5bcQxA1xI/s1600/Genio941.jpg',
				'keterangan'	=> 'Foto Jaminan',
			],
		];

		$paket_foto_roda_6 	= [
			[
				'url'			=> 'http://1.bp.blogspot.com/-mL_QUzgho94/VkoAA-HkIgI/AAAAAAAAP4U/0xkFAtD4DVw/s1600/Scania%2BK410%2BSatria%2BMuda%2B8.jpg',
				'keterangan'	=> 'Foto Jaminan',
			],
			[
				'url'			=> 'https://s.kaskus.id/images/2013/06/04/91010_20130604054053.jpg',
				'keterangan'	=> 'Foto Jaminan',
			],
			[
				'url'			=> 'http://4.bp.blogspot.com/-OK10G3m3BO0/Vpy1GMPLCaI/AAAAAAAACZo/Vg2zlFLYq40/s1600/fuso%2Bwing.jpg',
				'keterangan'	=> 'Foto Jaminan',
			],
		];

		$this->faker 		= \Faker\Factory::create();

		//SIMPAN JAMINAN
		$pengajuan 		= Pengajuan::skip(0)->take(rand(ceil(Pengajuan::count()/4),ceil(Pengajuan::count()/2)))->get();

		foreach ($pengajuan as $key => $value) 
		{
			//character
			$survei['tanggal']		= Carbon::now()->subHours(rand(24,47))->format('d/m/Y H:i');
			$survei['kode_kantor']	= $value['kode_kantor'];
			$survei['pengajuan_id'] = $value['id'];

			$surveyor[0] 			= ['nip' => Orang::first()['nip'], 'nama' => Orang::first()['nama']];
			$surveyor[1] 			= ['nip' => Orang::skip(1)->first()['nip'], 'nama' => Orang::skip(1)->first()['nama']];

			$s_survei_c1['jenis']	= 'character';
			$s_survei_c1['dokumen_survei']['character']['lingkungan_tinggal']	= $char_kenal[rand(0,2)];
			$s_survei_c1['dokumen_survei']['character']['lingkungan_kerja']		= $char_kenal[rand(0,2)];
			$s_survei_c1['dokumen_survei']['character']['watak']		= $char_watak[rand(0,2)];
			$s_survei_c1['dokumen_survei']['character']['pola_hidup']	= $char_pola_hidup[rand(0,1)];
			$s_survei_c1['dokumen_survei']['character']['informasi'][1]	= $char_info[rand(0,3)];
			$s_survei_c1['dokumen_survei']['character']['informasi'][2]	= $char_info[rand(0,3)];
			$s_survei_c1['dokumen_survei']['character']['catatan']		= $char_catatan[rand(0,1)];

			$s_survei_c2['jenis']	= 'condition';
			$s_survei_c2['dokumen_survei']['condition']['pekerjaan']				= $value->nasabah['pekerjaan'];
			if($value->nasabah['pekerjaan']!='pegawai_negeri' && $value->nasabah['pekerjaan']!='polri')
			{
				$s_survei_c2['dokumen_survei']['condition']['persaingan_usaha']			= $cond_pu[rand(0,2)];
				$s_survei_c2['dokumen_survei']['condition']['prospek_usaha']			= $cond_pu[rand(0,2)];
				$s_survei_c2['dokumen_survei']['condition']['perputaran_usaha']			= $cond_ppu[rand(0,2)];
				$s_survei_c2['dokumen_survei']['condition']['resiko_usaha_kedepan']		= $cond_risk[rand(0,2)];
				$s_survei_c2['dokumen_survei']['condition']['jumlah_pelanggan_harian']	= $cond_cust[rand(0,3)];
				$s_survei_c2['dokumen_survei']['condition']['catatan']				= $cond_catatan[rand(0,1)];
			}
			$s_survei_c2['dokumen_survei']['condition']['pengalaman_usaha']			= $cond_pgu[rand(0,3)];


			$s_survei_c3['jenis']	= 'capacity';
			$s_survei_c3['dokumen_survei']['capacity']['pekerjaan']						= $value->nasabah['pekerjaan'];
			$s_survei_c3['dokumen_survei']['capacity']['penghasilan']['utama']			= $this->formatMoneyTo(rand(10,50)*100000);
			$s_survei_c3['dokumen_survei']['capacity']['penghasilan']['pasangan']		= $this->formatMoneyTo(rand(20,50)*50000);
			$s_survei_c3['dokumen_survei']['capacity']['penghasilan']['usaha']			= $this->formatMoneyTo(rand(0,50)*50000);
			$s_survei_c3['dokumen_survei']['capacity']['penghasilan']['rincian']		= $cap_sppj[rand(0,1)];

			$s_survei_c3['dokumen_survei']['capacity']['pengeluaran']['biaya_rutin']		= $this->formatMoneyTo(rand(0,50)*500000);
			$s_survei_c3['dokumen_survei']['capacity']['pengeluaran']['angsuran_kredit']	= $this->formatMoneyTo(rand(0,50)*500000);
			$s_survei_c3['dokumen_survei']['capacity']['pengeluaran']['rincian']		= 'Biaya rumah tangga, pdam, telepon, listrik';
			$s_survei_c3['dokumen_survei']['capacity']['manajemen_usaha']				= $char_watak[rand(0,2)];

			$tgg 		= $sper[rand(0,4)];
			if(str_is('K-', $tgg)){
				$new_t 	= str_replace('K-', '', $tgg);
				$new_t 	= $new_t * 1250000;
				$tgg_k 	= $this->formatMoneyTo($new_t + 3000000);
			}
			elseif(str_is('TK', $tgg)){
				$tgg_k 	= 'Rp 3.000.000';
			}
			else{
				$tgg_k 	= 'Rp 1.500.000';
			}

			$s_survei_c3['dokumen_survei']['capacity']['status_pernikahan']		= $tgg;
			$s_survei_c3['dokumen_survei']['capacity']['tanggungan_keluarga']	= $tgg_k;
			$s_survei_c3['dokumen_survei']['capacity']['catatan']				= $cap_catatan[rand(0,1)];

			$s_survei_c4['jenis']	= 'capital';
			$status_rumah 	= $capi_owner[rand(0,3)];

			$s_survei_c4['dokumen_survei']['capital']['rumah']['status']	= $status_rumah;
			if(str_is($status_rumah, 'sewa'))
			{
				$s_survei_c4['dokumen_survei']['capital']['rumah']['sewa_sejak']= rand(1990,2016);
				$s_survei_c4['dokumen_survei']['capital']['rumah']['masa_sewa']	= rand(1,10);
			}
			if(rand(0,1))
			{
				$s_survei_c4['dokumen_survei']['capital']['rumah']['angsuran_bulanan']	= $this->formatMoneyTo(rand(1,50)*50000);
				$s_survei_c4['dokumen_survei']['capital']['rumah']['lama_angsuran']		= rand(12,24);
			}

			$luas_rumah 	= rand(60,120);
			$lebar_rumah 	= floor($luas_rumah/rand(2,4));
			$panjang_rumah 	= ceil($luas_rumah/$lebar_rumah);
			$s_survei_c4['dokumen_survei']['capital']['rumah']['lama_menempati']	= rand(1,20);
			$s_survei_c4['dokumen_survei']['capital']['rumah']['luas_rumah']		= $luas_rumah;
			$s_survei_c4['dokumen_survei']['capital']['rumah']['panjang_rumah']		= $panjang_rumah;
			$s_survei_c4['dokumen_survei']['capital']['rumah']['lebar_rumah']		= $lebar_rumah;
			$s_survei_c4['dokumen_survei']['capital']['rumah']['nilai_rumah']		= $this->formatMoneyTo(rand(1,10)*50000 * $luas_rumah);

			$jroda_4 	= rand(0,2);
			$jroda_2 	= rand(0,4);
			$h_roda_2 	= rand(120,220)*100000 * $jroda_2;
			$h_roda_4 	= rand(140,440)*1000000 * $jroda_4;

			$s_survei_c4['dokumen_survei']['capital']['kendaraan']['jumlah_kendaraan_roda_4']	= rand(0,4);
			$s_survei_c4['dokumen_survei']['capital']['kendaraan']['jumlah_kendaraan_roda_2']	= rand(0,2);
			$s_survei_c4['dokumen_survei']['capital']['kendaraan']['nilai_kendaraan']	= $this->formatMoneyTo($h_roda_2 + $h_roda_4);

			$s_survei_c4['dokumen_survei']['capital']['usaha']['nama_usaha']	= $faker->company;
			$s_survei_c4['dokumen_survei']['capital']['usaha']['bidang_usaha']	= $capi_busaha[rand(0,3)];
			
			$lama_usaha 	= rand(1,10);
			$s_survei_c4['dokumen_survei']['capital']['usaha']['lama_usaha']	= $lama_usaha;

			$stts_usaha 	= $capi_ousaha[rand(0,2)];

			$s_survei_c4['dokumen_survei']['capital']['usaha']['status']		= $stts_usaha;
			$s_survei_c4['dokumen_survei']['capital']['usaha']['omzet_bulanan']	= $this->formatMoneyTo(rand(1,10)*500000);

			if(str_is($stts_usaha, 'kerjasama_bagi_hasil'))
			{
				$s_survei_c4['dokumen_survei']['capital']['usaha']['bagi_hasil']= rand(30,70);
			}

			$s_survei_c4['dokumen_survei']['capital']['usaha']['nilai_aset']	= $this->formatMoneyTo(rand(1,10)*5000000 * $lama_usaha);

			$s_survei_c4['dokumen_survei']['capital']['hutang'][0]['lembaga_keuangan']	= $nm_bank[rand(0,3)];
			$jlh_pinjaman 	= rand(1,10)*2500000;
			$jww 			= rand(12,60);
			$angs_bul 		= rand(10,50)/1000;
			$rp_bunga 		= floor($jlh_pinjaman/$jww) * $angs_bul;
			$angsuran 		= floor($jlh_pinjaman/$jww) + $rp_bunga;

			$s_survei_c4['dokumen_survei']['capital']['hutang'][0]['jumlah_pinjaman']	= $this->formatMoneyTo($jlh_pinjaman);
			$s_survei_c4['dokumen_survei']['capital']['hutang'][0]['jumlah_angsuran']	= $this->formatMoneyTo($angsuran);
			$s_survei_c4['dokumen_survei']['capital']['hutang'][0]['jangka_waktu']		= $jww;

			///COLLATERAL///
			$s_survei_c5 	= [];
			foreach ($value->jaminan as $key_j => $value_j) 
			{
				switch ($value_j->jenis) {
					case 'shm':
						$s_survei_c5[] 		= $this->survei_shm($value_j, $value['nasabah']['alamat']);
						if($value_j['dokumen_jaminan']['shm']['tipe']=='tanah')
						{
							$s_survei_foto[] 	= $this->survei_foto($paket_foto_tanah);
						}
						else
						{
							$s_survei_foto[] 	= $this->survei_foto($paket_foto_rumah);
						}
						break;
					case 'shgb':
						$s_survei_c5[] 		= $this->survei_shgb($value_j);
						$s_survei_foto[] 	= $this->survei_foto($paket_foto_apartment);
						break;
					default:
						$s_survei_c5[] 		= $this->survei_bpkb($value_j, $value['nasabah']['alamat']);
						if($value_j['dokumen_jaminan']['shm']['tipe']=='roda_6')
						{
							$s_survei_foto[] 	= $this->survei_foto($paket_foto_roda_6);
						}
						elseif($value_j['dokumen_jaminan']['shm']['tipe']=='roda_4')
						{
							$s_survei_foto[] 	= $this->survei_foto($paket_foto_roda_4);
						}
						elseif($value_j['dokumen_jaminan']['shm']['tipe']=='roda_3')
						{
							$s_survei_foto[] 	= $this->survei_foto($paket_foto_roda_3);
						}
						else
						{
							$s_survei_foto[] 	= $this->survei_foto($paket_foto_roda_2);
						}
						break;
				}
			}

			$saved_survei 				= Survei::create($survei);
			foreach ($surveyor as $ks => $vs) {
				$a_s 	= AssignedSurveyor::create(['nip' => $vs['nip'], 'nama' => $vs['nama'], 'survei_id' => $saved_survei['id']]);
			}
			$s_survei_c1['survei_id']	= $saved_survei['id'];
			$s_survei_c2['survei_id']	= $saved_survei['id'];
			$s_survei_c3['survei_id']	= $saved_survei['id'];
			$s_survei_c4['survei_id']	= $saved_survei['id'];

			SurveiDetail::create($s_survei_c1);
			SurveiDetail::create($s_survei_c2);
			SurveiDetail::create($s_survei_c3);
			SurveiDetail::create($s_survei_c4);

			foreach ($s_survei_c5 as $keys5 => $values5) 
			{
				if($values5['dokumen_survei']['collateral']['jenis']=='bpkb')
				{
					$s_detail 	= SurveiDetail::where('survei_id', $saved_survei['id'])->where('jenis', 'collateral')
					->where('dokumen_survei->collateral->bpkb->nomor_bpkb', $values5['dokumen_survei']['collateral']['bpkb']['nomor_bpkb'])->first();

					$bpkb	= array_merge($s_detail->dokumen_survei['collateral']['bpkb'], $values5['dokumen_survei']['collateral']['bpkb']);
					$values5['dokumen_survei']['collateral']['bpkb'] 	= $bpkb;
				}
				elseif($values5['dokumen_survei']['collateral']['jenis']=='shm')
				{
					$s_detail 		= SurveiDetail::where('survei_id', $saved_survei['id'])->where('jenis', 'collateral')
					->where('dokumen_survei->collateral->shm->nomor_sertifikat', $values5['dokumen_survei']['collateral']['shm']['nomor_sertifikat'])->first();
					$shm	= array_merge($s_detail->dokumen_survei['collateral']['shm'], $values5['dokumen_survei']['collateral']['shm']);
					$values5['dokumen_survei']['collateral']['shm'] 	= $shm;
				}
				else
				{
					$s_detail 		= SurveiDetail::where('survei_id', $saved_survei['id'])->where('jenis', 'collateral')
					->where('dokumen_survei->collateral->shgb->nomor_sertifikat', $values5['dokumen_survei']['collateral']['shgb']['nomor_sertifikat'])->first();
					$shgb	= array_merge($s_detail->dokumen_survei['collateral']['shgb'], $values5['dokumen_survei']['collateral']['shgb']);
					$values5['dokumen_survei']['collateral']['shgb'] 	= $shgb;
				}

				$s_detail->fill($values5);
				$s_detail->save();
				// $s_survei_foto[$keys5]['survei_detail_id']	= $s_detail['id'];
				// SurveiFoto::create($s_survei_foto[$keys5]);
			}
		}
	}

	private function survei_bpkb($jaminan, $alamat)
	{
		$s_survei_c5['jenis']	= 'collateral';
		$s_survei_c5['dokumen_survei']['collateral']['jenis']					= 'bpkb';
		$s_survei_c5['dokumen_survei']['collateral']['bpkb']['merk']			= $jaminan['dokumen_jaminan']['bpkb']['merk'];
		$s_survei_c5['dokumen_survei']['collateral']['bpkb']['tipe']			= $jaminan['dokumen_jaminan']['bpkb']['tipe'];
		$s_survei_c5['dokumen_survei']['collateral']['bpkb']['nomor_polisi']	= rand('A','Z').' '.rand(1001,9999).' '.rand('A','Z').rand('A','Z');
		$s_survei_c5['dokumen_survei']['collateral']['bpkb']['warna']			= $this->warna[rand(0,5)];
		$s_survei_c5['dokumen_survei']['collateral']['bpkb']['tahun']			= $jaminan['dokumen_jaminan']['bpkb']['tahun'];
		$s_survei_c5['dokumen_survei']['collateral']['bpkb']['atas_nama']		= $jaminan['dokumen_jaminan']['bpkb']['atas_nama'];			
		$s_survei_c5['dokumen_survei']['collateral']['bpkb']['alamat']			= $alamat;			
		$s_survei_c5['dokumen_survei']['collateral']['bpkb']['nomor_bpkb']		= $jaminan['dokumen_jaminan']['bpkb']['nomor_bpkb'];			
		$s_survei_c5['dokumen_survei']['collateral']['bpkb']['nomor_mesin']		= $this->faker->ean13;			
		$s_survei_c5['dokumen_survei']['collateral']['bpkb']['nomor_rangka']	= $this->faker->ean13;			
		$s_survei_c5['dokumen_survei']['collateral']['bpkb']['masa_berlaku_stnk']	= Carbon::now()->addMonths(rand(-60,60))->format('d/m/Y');			
		$s_survei_c5['dokumen_survei']['collateral']['bpkb']['fungsi_sehari_hari']	= $this->fs_harian[rand(0,3)];			
		$s_survei_c5['dokumen_survei']['collateral']['bpkb']['faktur']				= $this->y_n[rand(0,1)];			
		$s_survei_c5['dokumen_survei']['collateral']['bpkb']['kwitansi_jual_beli']	= $this->y_n[rand(0,1)];			
		$s_survei_c5['dokumen_survei']['collateral']['bpkb']['kwitansi_kosong']		= $this->y_n[rand(0,1)];			
		$s_survei_c5['dokumen_survei']['collateral']['bpkb']['ktp_an_bpkb']			= $this->y_n[rand(0,1)];			
		$s_survei_c5['dokumen_survei']['collateral']['bpkb']['kondisi_kendaraan']	= $this->jbpkb_kond[rand(0,2)];			
		$s_survei_c5['dokumen_survei']['collateral']['bpkb']['status_kepemilikan']	= $this->jbpkb_sowner[rand(0,2)];			
		$s_survei_c5['dokumen_survei']['collateral']['bpkb']['asuransi']			= $this->asuransi[rand(0,2)];	

		$ht 	= abs((date('Y') * 1) - $jaminan['dokumen_jaminan']['bpkb']['tahun']);

		if(str_is($jaminan['dokumen_jaminan']['bpkb']['jenis'], 'roda_2') || str_is($jaminan['dokumen_jaminan']['bpkb']['jenis'], 'roda_3'))
		{
			$b	= rand(120,220)*100000;
			$ht = $b - (0.025 * $ht * $b);
		}
		else
		{
			$b	= rand(140,440)*1000000;
			$ht = $b - (0.025 * $ht * $b);
		}

		$perc 	= rand(20,40);
		$s_survei_c5['dokumen_survei']['collateral']['bpkb']['harga_taksasi']	= $this->formatMoneyTo($ht);	
		$s_survei_c5['dokumen_survei']['collateral']['bpkb']['persentasi_bank']	= $perc/100;			
		$s_survei_c5['dokumen_survei']['collateral']['bpkb']['harga_bank']		= $this->formatMoneyTo($ht - ($ht*($perc/100)));

		return $s_survei_c5;
	}

	private function survei_shm($jaminan)
	{
		$s_survei_c5['jenis']	= 'collateral';
		$s_survei_c5['dokumen_survei']['collateral']['jenis']					= 'shm';
		$s_survei_c5['dokumen_survei']['collateral']['shm']['nomor_sertifikat']		= $jaminan['dokumen_jaminan']['shm']['nomor_sertifikat'];
		$s_survei_c5['dokumen_survei']['collateral']['shm']['atas_nama_sertifikat']	= $jaminan['dokumen_jaminan']['shm']['atas_nama'];
		$s_survei_c5['dokumen_survei']['collateral']['shm']['alamat']				= $jaminan['dokumen_jaminan']['shm']['alamat'];

		$lebar_tanah 	= floor($jaminan['dokumen_jaminan']['shm']['luas_tanah']/rand(2,4));
		$panjang_tanah 	= $jaminan['dokumen_jaminan']['shm']['luas_tanah'] - $lebar_tanah;

		$s_survei_c5['dokumen_survei']['collateral']['shm']['tipe']				= $jaminan['dokumen_jaminan']['shm']['tipe'];
		$s_survei_c5['dokumen_survei']['collateral']['shm']['luas_tanah']		= $jaminan['dokumen_jaminan']['shm']['luas_tanah'];
		$s_survei_c5['dokumen_survei']['collateral']['shm']['panjang_tanah']	= $panjang_tanah;
		$s_survei_c5['dokumen_survei']['collateral']['shm']['lebar_tanah']		= $lebar_tanah;

		$nilai_bangunan = 0;
		$njop_bangunan 	= 0;
		if(isset($jaminan['dokumen_jaminan']['shm']['luas_bangunan']))
		{
			$lebar_bangunan 	= floor($jaminan['dokumen_jaminan']['shm']['luas_bangunan']/rand(2,4));
			$panjang_bangunan 	= $jaminan['dokumen_jaminan']['shm']['luas_bangunan'] - $lebar_bangunan;

			$s_survei_c5['dokumen_survei']['collateral']['shm']['luas_bangunan']	= $jaminan['dokumen_jaminan']['shm']['luas_bangunan'];
			$s_survei_c5['dokumen_survei']['collateral']['shm']['lebar_bangunan']	= $lebar_bangunan;
			$s_survei_c5['dokumen_survei']['collateral']['shm']['panjang_bangunan']	= $panjang_bangunan;

			$s_survei_c5['dokumen_survei']['collateral']['shm']['fungsi_bangunan']		= $this->fs_bangunan[rand(0,2)];
			$s_survei_c5['dokumen_survei']['collateral']['shm']['bentuk_bangunan']		= $this->bntk_bangunan[rand(0,1)];
			$s_survei_c5['dokumen_survei']['collateral']['shm']['konstruksi_bangunan']	= $this->kons_bangunan[rand(0,1)];
			$s_survei_c5['dokumen_survei']['collateral']['shm']['lantai_bangunan']		= $this->lantai_bangunan[rand(0,1)];
			$s_survei_c5['dokumen_survei']['collateral']['shm']['dinding']				= $this->dinding[rand(0,1)];
			$s_survei_c5['dokumen_survei']['collateral']['shm']['listrik']				= $this->listrik[rand(0,1)];
			$s_survei_c5['dokumen_survei']['collateral']['shm']['catatan']				= $this->lain_lain[rand(0,1)];
			
			$njop_bangunan 		= rand(5,10) * 100000;
			$nilai_bangunan 	= $jaminan['dokumen_jaminan']['shm']['luas_bangunan'] * $njop_bangunan;
			$s_survei_c5['dokumen_survei']['collateral']['shm']['njop_bangunan']		= $this->formatMoneyTo($njop_bangunan);
			$s_survei_c5['dokumen_survei']['collateral']['shm']['nilai_bangunan']		= $this->formatMoneyTo($nilai_bangunan);
		}

		$s_survei_c5['dokumen_survei']['collateral']['shm']['air']							= $this->air[rand(0,1)];
		$s_survei_c5['dokumen_survei']['collateral']['shm']['jalan']						= $this->jalan[rand(0,2)];
		$s_survei_c5['dokumen_survei']['collateral']['shm']['letak_lokasi_terhadap_jalan']	= $this->lltj[rand(0,2)];
		$s_survei_c5['dokumen_survei']['collateral']['shm']['lingkungan']					= $this->ling[rand(0,5)];
		$s_survei_c5['dokumen_survei']['collateral']['shm']['ajb']							= $this->y_n[rand(0,1)];
		$s_survei_c5['dokumen_survei']['collateral']['shm']['pbb_terakhir']					= $this->y_n[rand(0,1)];
		$s_survei_c5['dokumen_survei']['collateral']['shm']['imb']							= $this->y_n[rand(0,1)];
		$s_survei_c5['dokumen_survei']['collateral']['shm']['asuransi']						= $this->y_n[rand(0,1)];
		
		$njop_tanah		= rand(5,10) * 50000;
		$nilai_tanah 	= $jaminan['dokumen_jaminan']['shm']['luas_tanah'] * $njop_tanah;

		$s_survei_c5['dokumen_survei']['collateral']['shm']['njop_tanah']			= $this->formatMoneyTo($njop_tanah);
		$s_survei_c5['dokumen_survei']['collateral']['shm']['nilai_tanah']			= $this->formatMoneyTo($nilai_tanah);
		$s_survei_c5['dokumen_survei']['collateral']['shm']['persentasi_taksasi']	= rand(30,40);
		
		$total 	= $nilai_tanah + $nilai_bangunan;
		$perc 	= $s_survei_c5['dokumen_survei']['collateral']['shm']['persentasi_taksasi']/100;

		$s_survei_c5['dokumen_survei']['collateral']['shm']['harga_taksasi']		= $this->formatMoneyTo($total - ($total*$perc));

		return $s_survei_c5;
	}

	private function survei_shgb($jaminan)
	{
		$s_survei_c5['jenis']	= 'collateral';
		$s_survei_c5['dokumen_survei']['collateral']['jenis']					= 'shgb';
		$s_survei_c5['dokumen_survei']['collateral']['shgb']['atas_nama_sertifikat']	= $jaminan['dokumen_jaminan']['shgb']['atas_nama'];
		$s_survei_c5['dokumen_survei']['collateral']['shgb']['nomor_sertifikat']		= $jaminan['dokumen_jaminan']['shgb']['nomor_sertifikat'];
		$s_survei_c5['dokumen_survei']['collateral']['shgb']['alamat']					= $jaminan['dokumen_jaminan']['shgb']['alamat'];

		$lebar_tanah 	= floor($jaminan['dokumen_jaminan']['shgb']['luas_tanah']/rand(2,4));
		$panjang_tanah 	= $jaminan['dokumen_jaminan']['shgb']['luas_tanah'] - $lebar_tanah;

		$s_survei_c5['dokumen_survei']['collateral']['shgb']['tipe']					= $jaminan['dokumen_jaminan']['shgb']['tipe'];
		$s_survei_c5['dokumen_survei']['collateral']['shgb']['masa_berlaku_sertifikat']	= $jaminan['dokumen_jaminan']['shgb']['masa_berlaku_sertifikat'];
		$s_survei_c5['dokumen_survei']['collateral']['shgb']['luas_tanah']		= $jaminan['dokumen_jaminan']['shgb']['luas_tanah'];
		$s_survei_c5['dokumen_survei']['collateral']['shgb']['panjang_tanah']	= $panjang_tanah;
		$s_survei_c5['dokumen_survei']['collateral']['shgb']['lebar_tanah']		= $lebar_tanah;

		$nilai_bangunan = 0;
		$njop_bangunan 	= 0;
		if(isset($jaminan['dokumen_jaminan']['shgb']['luas_bangunan']))
		{
			$lebar_bangunan 	= floor($jaminan['dokumen_jaminan']['shgb']['luas_bangunan']/rand(2,4));
			$panjang_bangunan 	= $jaminan['dokumen_jaminan']['shgb']['luas_bangunan'] - $lebar_bangunan;

			$s_survei_c5['dokumen_survei']['collateral']['shgb']['luas_bangunan']		= $jaminan['dokumen_jaminan']['shgb']['luas_bangunan'];
			$s_survei_c5['dokumen_survei']['collateral']['shgb']['lebar_bangunan']		= $lebar_bangunan;
			$s_survei_c5['dokumen_survei']['collateral']['shgb']['panjang_bangunan']	= $panjang_bangunan;

			$s_survei_c5['dokumen_survei']['collateral']['shgb']['fungsi_bangunan']		= $this->fs_bangunan[rand(0,2)];
			$s_survei_c5['dokumen_survei']['collateral']['shgb']['bentuk_bangunan']		= $this->bntk_bangunan[rand(0,1)];
			$s_survei_c5['dokumen_survei']['collateral']['shgb']['konstruksi_bangunan']	= $this->kons_bangunan[rand(0,1)];
			$s_survei_c5['dokumen_survei']['collateral']['shgb']['lantai_bangunan']		= $this->lantai_bangunan[rand(0,1)];
			$s_survei_c5['dokumen_survei']['collateral']['shgb']['dinding']				= $this->dinding[rand(0,1)];
			$s_survei_c5['dokumen_survei']['collateral']['shgb']['listrik']				= $this->listrik[rand(0,1)];
			$s_survei_c5['dokumen_survei']['collateral']['shgb']['catatan']				= $this->lain_lain[rand(0,1)];
			
			$njop_bangunan 		= rand(5,10) * 100000;
			$nilai_bangunan 	= $jaminan['dokumen_jaminan']['shgb']['luas_bangunan'] * $njop_bangunan;
			$s_survei_c5['dokumen_survei']['collateral']['shgb']['njop_bangunan']	= $this->formatMoneyTo($njop_bangunan);
			$s_survei_c5['dokumen_survei']['collateral']['shgb']['nilai_bangunan']	= $this->formatMoneyTo($nilai_bangunan);
		}

		$s_survei_c5['dokumen_survei']['collateral']['shgb']['air']					= $this->air[rand(0,1)];

		$s_survei_c5['dokumen_survei']['collateral']['shgb']['jalan']						= $this->jalan[rand(0,2)];
		$s_survei_c5['dokumen_survei']['collateral']['shgb']['letak_lokasi_terhadap_jalan']	= $this->lltj[rand(0,2)];
		$s_survei_c5['dokumen_survei']['collateral']['shgb']['lingkungan']					= $this->ling[rand(0,5)];
		$s_survei_c5['dokumen_survei']['collateral']['shgb']['ajb']							= $this->y_n[rand(0,1)];
		$s_survei_c5['dokumen_survei']['collateral']['shgb']['pbb_terakhir']				= $this->y_n[rand(0,1)];
		$s_survei_c5['dokumen_survei']['collateral']['shgb']['imb']							= $this->y_n[rand(0,1)];
		$s_survei_c5['dokumen_survei']['collateral']['shgb']['asuransi']					= $this->y_n[rand(0,1)];
		
		$njop_tanah		= rand(5,10) * 50000;
		$nilai_tanah 	= $jaminan['dokumen_jaminan']['shgb']['luas_tanah'] * $njop_tanah;

		$s_survei_c5['dokumen_survei']['collateral']['shgb']['njop_tanah']			= $this->formatMoneyTo($njop_tanah);
		$s_survei_c5['dokumen_survei']['collateral']['shgb']['nilai_tanah']			= $this->formatMoneyTo($nilai_tanah);
		$s_survei_c5['dokumen_survei']['collateral']['shgb']['persentasi_taksasi']	= rand(30,40);
	
		$total 	= $nilai_tanah + $nilai_bangunan;
		$perc 	= $s_survei_c5['dokumen_survei']['collateral']['shgb']['persentasi_taksasi']/100;

		$s_survei_c5['dokumen_survei']['collateral']['shgb']['harga_taksasi']		= $this->formatMoneyTo($total - ($total*$perc));

		return $s_survei_c5;
	}

	private function survei_foto($paket_foto)
	{
		$survei_foto['arsip_foto'][0]	= $paket_foto[rand(0,2)];
		$survei_foto['arsip_foto'][1]	= $paket_foto[rand(0,2)];
		$survei_foto['arsip_foto'][2]	= $paket_foto[rand(0,2)];
		$survei_foto['arsip_foto'][3]	= $paket_foto[rand(0,2)];

		return $survei_foto;
	}
}
