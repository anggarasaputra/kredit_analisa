<?php

use Illuminate\Database\Seeder;
use Thunderlabid\Manajemen\Models\Orang;

use Thunderlabid\Pengajuan\Models\Analisa;
use Thunderlabid\Pengajuan\Models\Putusan;

use Thunderlabid\Pengajuan\Traits\IDRTrait;

use Carbon\Carbon;

class PutusanTableSeeder extends Seeder
{
	use IDRTrait;

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('p_putusan')->truncate();
		DB::table('p_legal_realisasi')->truncate();
		
		//INIT VARIABLE HELPER
		$faker		= \Faker\Factory::create();

		$jk   			= ['pa', 'pt'];
		$hsl_putusan 	= ['tidak ada', 'melalui pleno', 'mengganti jaminan dengan aset'];
		$stts_kptsn 	= ['setuju', 'tolak'];
		$opsi 			= ['ada', 'tidak_ada', 'cadangkan'];

		$pengajuan 	= Analisa::skip(0)->take(rand(ceil(Analisa::count()/4),ceil(Analisa::count()/2)))->get();

		//BASIC PENGAJUAN
		foreach ($pengajuan as $key => $value) 
		{
			$data['pengajuan_id']	= $value['pengajuan_id'];
			$data['tanggal']		= Carbon::now()->subHours(rand(1,11))->format('d/m/Y H:i');
			$data['pembuat_keputusan']['nip']	= Orang::first()['nip'];
			$data['pembuat_keputusan']['nama']	= Orang::first()['nama'];
			$data['plafon_pinjaman']			= $value['kredit_diusulkan'];
			$data['suku_bunga']		= $value['suku_bunga'];
			$data['jangka_waktu']	= $value['jangka_waktu'];
			$data['perc_provisi']	= (rand(100,200)/100);
			$data['provisi']		= $this->formatMoneyTo(($this->formatMoneyFrom($data['plafon_pinjaman'])*$data['perc_provisi'])/100);
			$data['administrasi']	= $this->formatMoneyTo(rand(1,10)*1000);
			$data['legal']			= $this->formatMoneyTo(rand(10,50)*10000);
			$data['is_baru']		= rand(0,1);

			$data['checklists']['objek']['fotokopi_ktp_pemohon']	= $opsi[rand(0,1)];
			$data['checklists']['objek']['fotokopi_ktp_keluarga']	= $opsi[rand(0,1)];
			$data['checklists']['objek']['fotokopi_kk']				= $opsi[rand(0,1)];
			$data['checklists']['objek']['fotokopi_akta_nikah_cerai_pisah_harta']	= $opsi[rand(0,1)];
			$data['checklists']['objek']['fotokopi_npwp_siup']		= $opsi[rand(0,1)];
			
			$flag_bpkb 	= false;
			$flag_sert 	= false;
			foreach ($value->pengajuan->jaminan as $key2 => $value2) 
			{
				if(str_is($value2->jenis, 'bpkb'))
				{
					$flag_bpkb 		= true;	
				}
				else
				{
					$flag_sert 		= true;	
				}
			}

			if($flag_bpkb)
			{
				$data['checklists']['objek']['bpkb_asli_dan_fotokopi']		= $opsi[rand(0,1)];
				$data['checklists']['objek']['fotokopi_faktur_dan_stnk']	= $opsi[rand(0,1)];
				$data['checklists']['objek']['kwitansi_jual_beli_kosongan']	= $opsi[rand(0,1)];
				$data['checklists']['objek']['kwitansi_ktp_sesuai_bpkb']	= $opsi[rand(0,1)];
				$data['checklists']['objek']['asuransi_kendaraan']			= $opsi[rand(0,1)];
				$data['checklists']['objek']['check_fisik']		= $opsi[rand(0,1)];
				$data['checklists']['objek']['foto_jaminan']	= $opsi[rand(0,1)];
			}
			else
			{
				$data['checklists']['objek']['bpkb_asli_dan_fotokopi']		= $opsi[rand(2,2)];
				$data['checklists']['objek']['fotokopi_faktur_dan_stnk']	= $opsi[rand(2,2)];
				$data['checklists']['objek']['kwitansi_jual_beli_kosongan']	= $opsi[rand(2,2)];
				$data['checklists']['objek']['kwitansi_ktp_sesuai_bpkb']	= $opsi[rand(2,2)];
				$data['checklists']['objek']['asuransi_kendaraan']			= $opsi[rand(2,2)];
				$data['checklists']['objek']['check_fisik']		= $opsi[rand(2,2)];
				$data['checklists']['objek']['foto_jaminan']	= $opsi[rand(2,2)];
			}

			if($flag_sert)
			{
				$data['checklists']['objek']['sertifikat_asli_dan_fotokopi']	= $opsi[rand(0,1)];
				$data['checklists']['objek']['ajb']				= $opsi[rand(0,1)];
				$data['checklists']['objek']['imb']				= $opsi[rand(0,1)];
				$data['checklists']['objek']['pbb_terakhir']	= $opsi[rand(0,1)];
				$data['checklists']['objek']['foto_jaminan']	= $opsi[rand(0,1)];
			}
			else
			{
				$data['checklists']['objek']['sertifikat_asli_dan_fotokopi']	= $opsi[rand(2,2)];
				$data['checklists']['objek']['ajb']				= $opsi[rand(2,2)];
				$data['checklists']['objek']['imb']				= $opsi[rand(2,2)];
				$data['checklists']['objek']['pbb_terakhir']	= $opsi[rand(2,2)];
				$data['checklists']['objek']['foto_jaminan']	= $opsi[rand(2,2)];
			}

			$data['checklists']['pengikat']['permohonan_kredit']	= $opsi[rand(0,1)];
			$data['checklists']['pengikat']['survei_report']		= $opsi[rand(0,1)];
			$data['checklists']['pengikat']['persetujuan_komite']	= $opsi[rand(0,1)];
			$data['checklists']['pengikat']['perjanjian_kredit']	= $opsi[rand(0,1)];
			$data['checklists']['pengikat']['pengakuan_hutang']		= $opsi[rand(0,1)];
			$data['checklists']['pengikat']['pernyataan_analis']	= $opsi[rand(0,1)];
			$data['checklists']['pengikat']['penggantian_jaminan']	= $opsi[rand(0,1)];
			
			if($flag_bpkb)
			{
				$data['checklists']['pengikat']['feo']					= $opsi[rand(0,1)];
				$data['checklists']['pengikat']['kuasa_pembebanan_feo']	= $opsi[rand(0,1)];
			}
			else
			{
				$data['checklists']['pengikat']['feo']					= $opsi[rand(2,2)];
				$data['checklists']['pengikat']['kuasa_pembebanan_feo']	= $opsi[rand(2,2)];
			}

			if($flag_sert)
			{
				$data['checklists']['pengikat']['skmht_apht']				= $opsi[rand(0,1)];
				$data['checklists']['pengikat']['surat_persetujuan_plang']	= $opsi[rand(0,1)];
			}
			else
			{
				$data['checklists']['pengikat']['skmht_apht']				= $opsi[rand(2,2)];
				$data['checklists']['pengikat']['surat_persetujuan_plang']	= $opsi[rand(2,2)];
			}

			$data['checklists']['pengikat']['surat_persetujuan_keluarga']	= $opsi[rand(0,1)];
			$data['checklists']['pengikat']['pernyataan_belum_balik_nama']	= $opsi[rand(0,1)];
			$data['checklists']['pengikat']['kuasa_menjual_dan_menarik_jaminan']	= $opsi[rand(0,1)];

			$data['putusan']		= $stts_kptsn[rand(0,1)];
			$data['catatan']		= $hsl_putusan[rand(0,2)];

			$putusan = Putusan::create($data);
		}

	}
}
