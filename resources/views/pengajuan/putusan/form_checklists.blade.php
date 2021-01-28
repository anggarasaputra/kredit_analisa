{!! Form::open(['url' => route('pengajuan.putusan.update', ['id' => $permohonan['id'], 'kantor_aktif_id' => $kantor_aktif_id]), 'method' => 'PATCH']) !!}
	<div class="row">
		<div class="col">
			{!! Form::vSelect('Fotokopi KTP Pemohon', 'checklists[objek][fotokopi_ktp_pemohon]', ['ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['objek']['fotokopi_ktp_pemohon'], ['class' => 'form-control text-info inline-edit'], true) !!}
		</div>
	</div>

	<div class="row">
		<div class="col">
			{!! Form::vSelect('Fotokopi KTP Keluarga', 'checklists[objek][fotokopi_ktp_keluarga]', ['ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['objek']['fotokopi_ktp_keluarga'], ['class' => 'form-control text-info inline-edit'], true) !!}
		</div>
	</div>

	<div class="row">
		<div class="col">
			{!! Form::vSelect('Fotokopi KK', 'checklists[objek][fotokopi_kk]', ['ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['objek']['fotokopi_kk'], ['class' => 'form-control text-info inline-edit'], true) !!}
		</div>
	</div>

	<div class="row">
		<div class="col">
			{!! Form::vSelect('Fotokopi Akta Nikah/Cerai/Pisah Harta', 'checklists[objek][fotokopi_akta_nikah_cerai_pisah_harta]', ['ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['objek']['fotokopi_akta_nikah_cerai_pisah_harta'], ['class' => 'form-control text-info inline-edit'], true) !!}
		</div>
	</div>

	<div class="row">
		<div class="col">
			{!! Form::vSelect('Fotokopi NPWP/SIUP', 'checklists[objek][fotokopi_npwp_siup]', ['ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['objek']['fotokopi_npwp_siup'], ['class' => 'form-control text-info inline-edit'], true) !!}
		</div>
	</div>

	<div class="row">
		<div class="col">
			{!! Form::vSelect('BPKB Asli & Fotocopy', 'checklists[objek][bpkb_asli_dan_fotokopi]', ['ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['objek']['bpkb_asli_dan_fotokopi'], ['class' => 'form-control text-info inline-edit'], true) !!}
		</div>
	</div>

	<div class="row">
		<div class="col">
			{!! Form::vSelect('Fotokopi Faktur & STNK', 'checklists[objek][fotokopi_faktur_dan_stnk]', ['ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['objek']['fotokopi_faktur_dan_stnk'], ['class' => 'form-control text-info inline-edit'], true) !!}
		</div>
	</div>

	<div class="row">
		<div class="col">
			{!! Form::vSelect('Kwitansi Jual/Beli Kosongan', 'checklists[objek][kwitansi_jual_beli_kosongan]', ['ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['objek']['kwitansi_jual_beli_kosongan'], ['class' => 'form-control text-info inline-edit'], true) !!}
		</div>
	</div>

	<div class="row">
		<div class="col">
			{!! Form::vSelect('Kwitansi KTP Sesuai BPKB', 'checklists[objek][kwitansi_ktp_sesuai_bpkb]', ['ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['objek']['kwitansi_ktp_sesuai_bpkb'], ['class' => 'form-control text-info inline-edit'], true) !!}
		</div>
	</div>
	<div class="row">
		<div class="col">
			{!! Form::vSelect('Asuransi Kendaraan', 'checklists[objek][asuransi_kendaraan]', ['ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['objek']['asuransi_kendaraan'], ['class' => 'form-control text-info inline-edit'], true) !!}
		</div>
	</div>
	<div class="row">
		<div class="col">
			{!! Form::vSelect('Sertifikat Asli & Fotokopi', 'checklists[objek][sertifikat_asli_dan_fotokopi]', ['ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['objek']['sertifikat_asli_dan_fotokopi'], ['class' => 'form-control text-info inline-edit'], true) !!}
		</div>
	</div>
	<div class="row">
		<div class="col">
			{!! Form::vSelect('AJB', 'checklists[objek][ajb]', ['ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['objek']['ajb'], ['class' => 'form-control text-info inline-edit'], true) !!}
		</div>
	</div>
	<div class="row">
		<div class="col">
			{!! Form::vSelect('IMB', 'checklists[objek][imb]', ['ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['objek']['imb'], ['class' => 'form-control text-info inline-edit'], true) !!}
		</div>
	</div>
	<div class="row">
		<div class="col">
			{!! Form::vSelect('PBB Terakhir', 'checklists[objek][pbb_terakhir]', ['ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['objek']['pbb_terakhir'], ['class' => 'form-control text-info inline-edit'], true) !!}
		</div>
	</div>
	<div class="row">
		<div class="col">
			{!! Form::vSelect('Check Fisik', 'checklists[objek][check_fisik]', ['ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['objek']['check_fisik'], ['class' => 'form-control text-info inline-edit'], true) !!}
		</div>
	</div>
	<div class="row">
		<div class="col">
			{!! Form::vSelect('Foto Jaminan', 'checklists[objek][foto_jaminan]', ['ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['objek']['foto_jaminan'], ['class' => 'form-control text-info inline-edit'], true) !!}
		</div>
	</div>

	<div class="row">
		<div class="col">
			{!! Form::vSelect('Permohonan Kredit', 'checklists[pengikat][permohonan_kredit]', ['ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['pengikat']['permohonan_kredit'], ['class' => 'form-control text-info inline-edit'], true) !!}
		</div>
	</div>

	<div class="row">
		<div class="col">
			{!! Form::vSelect('Survei Report', 'checklists[pengikat][survei_report]', ['ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['pengikat']['survei_report'], ['class' => 'form-control text-info inline-edit'], true) !!}
		</div>
	</div>

	<div class="row">
		<div class="col">
			{!! Form::vSelect('Persetujuan Komite', 'checklists[pengikat][persetujuan_komite]', ['ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['pengikat']['persetujuan_komite'], ['class' => 'form-control text-info inline-edit'], true) !!}
		</div>
	</div>

	<div class="row">
		<div class="col">
			{!! Form::vSelect('Perjanjian Kredit', 'checklists[pengikat][perjanjian_kredit]', ['ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['pengikat']['perjanjian_kredit'], ['class' => 'form-control text-info inline-edit'], true) !!}
		</div>
	</div>

	<div class="row">
		<div class="col">
			{!! Form::vSelect('Pengakuan Hutang', 'checklists[pengikat][pengakuan_hutang]', ['ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['pengikat']['pengakuan_hutang'], ['class' => 'form-control text-info inline-edit'], true) !!}
		</div>
	</div>
	<div class="row">
		<div class="col">
			{!! Form::vSelect('Pernyataan Analis', 'checklists[pengikat][pernyataan_analis]', ['ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['pengikat']['pernyataan_analis'], ['class' => 'form-control text-info inline-edit'], true) !!}
		</div>
	</div>
	<div class="row">
		<div class="col">
			{!! Form::vSelect('Penggantian Jaminan', 'checklists[pengikat][penggantian_jaminan]', ['ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['pengikat']['penggantian_jaminan'], ['class' => 'form-control text-info inline-edit'], true) !!}
		</div>
	</div>
	<div class="row">
		<div class="col">
			{!! Form::vSelect('SKMHT/APHT', 'checklists[pengikat][skmht_apht]', ['ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['pengikat']['skmht_apht'], ['class' => 'form-control text-info inline-edit'], true) !!}
		</div>
	</div>
	<div class="row">
		<div class="col">
			{!! Form::vSelect('FEO', 'checklists[pengikat][feo]', ['ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['pengikat']['feo'], ['class' => 'form-control text-info inline-edit'], true) !!}
		</div>
	</div>
	<div class="row">
		<div class="col">
			{!! Form::vSelect('Surat Persetujuan Keluarga', 'checklists[pengikat][surat_persetujuan_keluarga]', ['ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['pengikat']['surat_persetujuan_keluarga'], ['class' => 'form-control text-info inline-edit'], true) !!}
		</div>
	</div>
	<div class="row">
		<div class="col">
			{!! Form::vSelect('Surat Persetujuan Pemasangan Plang', 'checklists[pengikat][surat_persetujuan_plang]', ['ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['pengikat']['surat_persetujuan_plang'], ['class' => 'form-control text-info inline-edit'], true) !!}
		</div>
	</div>
	<div class="row">
		<div class="col">
			{!! Form::vSelect('Surat Pernyataan Belum Balik Nama', 'checklists[pengikat][pernyataan_belum_balik_nama]', ['ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['pengikat']['pernyataan_belum_balik_nama'], ['class' => 'form-control text-info inline-edit'], true) !!}
		</div>
	</div>
	<div class="row">
		<div class="col">
			{!! Form::vSelect('Surat Kuasa Pembebanan FEO', 'checklists[pengikat][kuasa_pembebanan_feo]', ['ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['pengikat']['kuasa_pembebanan_feo'], ['class' => 'form-control text-info inline-edit'], true) !!}
		</div>
	</div>
	<div class="row">
		<div class="col">
			{!! Form::vSelect('Surat Kuasa Menjual & Menarik Jaminan', 'checklists[pengikat][kuasa_menjual_dan_menarik_jaminan]', ['ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['pengikat']['kuasa_menjual_dan_menarik_jaminan'], ['class' => 'form-control text-info inline-edit'], true) !!}
		</div>
	</div>
{!! Form::bsSubmit('Simpan', ['class' => 'btn btn-primary float-right mr-3']) !!}
{!! Form::close() !!}
