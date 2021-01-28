<div class="row">
	<div class="col">
		<h5 class="pb-4">Keputusan</h5>
	</div>
</div>

@if(count($putusan) && ($permohonan['status_terakhir']['status']== 'realisasi' || $permohonan['status_terakhir']['status']== 'expired'))
	<div class="row pl-3">
		<div class="col-3">
			<p class="text-secondary text-capitalize">Oleh</p>
		</div>
		<div class="col">
			<p class="text-capitalize">{{$putusan['pembuat_keputusan']['nama']}}</p>
		</div>
	</div>
	<div class="row pl-3">
		<div class="col-3">
			<p class="text-secondary text-capitalize">Tanggal</p>
		</div>
		<div class="col">
			<p class="text-capitalize">{{$putusan['tanggal']}}</p>
		</div>
	</div>


	<h5 class="text-gray mb-4 pl-3">Putusan Komite</h5>
	@foreach($putusan->toArray() as $k2 => $v2)
		@if($k2=='is_baru')
			<div class="row pl-3">
				<div class="col-3">
					<p class="text-secondary text-capitalize">Nasabah</p>
				</div>
				<div class="col">
					<p class="text-capitalize">
						@if($v2)
							Baru
						@else
							Lama
						@endif
					</p>
				</div>
			</div>
		@elseif(!in_array($k2, ['id', 'pengajuan_id', 'pembuat_keputusan', 'created_at', 'updated_at', 'deleted_at', 'tanggal', 'checklists']))
			<div class="row pl-3">
				<div class="col-3">
					<p class="text-secondary text-capitalize">{{ str_replace('_', ' ', $k2) }}</p>
				</div>
				<div class="col">
					<p class="text-capitalize">{{ str_replace('_', ' ', $v2) }}</p>
				</div>
			</div>
		@endif
	@endforeach
@else
	<h5 class="text-gray mb-4 pl-3">Putusan Komite</h5>

	{{Form::open(['url' => route('pengajuan.keputusan.update', ['id' => $permohonan['id'], 'kantor_aktif_id' => $kantor_aktif['id']]), 'method' => 'PATCH'])}}

	<div class="row pl-3">
		<div class="col-auto col-md-6">
			{!! Form::bsText('Tanggal', 'tanggal', !is_null($putusan['tanggal']) ? $putusan['tanggal'] : Carbon\Carbon::now()->format('d/m/Y H:i'), ['class' => 'form-control', 'placeholder' => 'Masukkan tanggal dd/mm/yyyy hh:ii']) !!}
		</div>
	</div>

	<div class="row pl-3">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('Nasabah', 'is_baru', ['' => 'pilih', 1 => 'Baru', 0 => 'Lama'], $putusan['is_baru'], ['class' => 'custom-select form-control']) !!}
		</div>
	</div>

	<div class="row pl-3">
		<div class="col-auto col-md-6">
			{!! Form::bsText('Plafon Pinjaman', 'plafon_pinjaman', $putusan['plafon_pinjaman'], ['class' => 'form-control mask-money', 'placeholder' => 'masukkan plafon pinjaman']) !!}
		</div>
	</div>

	<div class="row pl-3">
		<div class="col-auto col-md-6">
			{!! Form::bsText('Suku Bunga', 'suku_bunga', $putusan['suku_bunga'], ['class' => 'form-control', 'placeholder' => 'masukkan suku bunga']) !!}
		</div>
	</div>

	<div class="row pl-3">
		<div class="col-auto col-md-6">
			{!! Form::bsText('Jangka Waktu', 'jangka_waktu', $putusan['jangka_waktu'], ['class' => 'form-control', 'placeholder' => 'masukkan jangka waktu']) !!}
		</div>
	</div>

	<div class="row pl-3">
		<div class="col-auto col-md-6">
			{!! Form::bsText('Persentasi Provisi', 'perc_provisi', $putusan['perc_provisi'], ['class' => 'form-control', 'placeholder' => 'masukkan persentasi provisi']) !!}
		</div>
	</div>

	<div class="row pl-3">
		<div class="col-auto col-md-6">
			{!! Form::bsText('Administrasi', 'administrasi', $putusan['administrasi'], ['class' => 'form-control mask-money', 'placeholder' => 'masukkan biaya administrasi']) !!}
		</div>
	</div>

	<div class="row pl-3">
		<div class="col-auto col-md-6">
			{!! Form::bsText('Legal', 'legal', $putusan['legal'], ['class' => 'form-control mask-money', 'placeholder' => 'masukkan biaya legal']) !!}
		</div>
	</div>

	<div class="row pl-3">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('Putusan', 'putusan', ['' => 'pilih', 'setuju' => 'Setuju', 'tolak' => 'Tolak'], $putusan['putusan'], ['class' => 'custom-select form-control']) !!}
		</div>
	</div>

	<div class="row pl-3">
		<div class="col-auto col-md-6">
			{!! Form::bsTextarea('Catatan', 'catatan', $putusan['catatan'], ['class' => 'form-control', 'placeholder' => 'catatan', 'cols' => 20, 'rows' => 5, 'style' => 'resize:none;']) !!}
		</div>
	</div>

	<h6 class="text-gray mb-4 pl-3">Checklists Dokumen Nasabah/Jaminan</h6>
	<div class="row pl-3">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('Fotokopi KTP Pemohon', 'checklists[objek][fotokopi_ktp_pemohon]', ['' => 'pilih', 'ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['objek']['fotokopi_ktp_pemohon'], ['class' => 'custom-select form-control']) !!}
		</div>
	</div>

	<div class="row pl-3">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('Fotokopi KTP Keluarga', 'checklists[objek][fotokopi_ktp_keluarga]', ['' => 'pilih', 'ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['objek']['fotokopi_ktp_keluarga'], ['class' => 'custom-select form-control']) !!}
		</div>
	</div>

	<div class="row pl-3">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('Fotokopi Akta Nika/Cerai/Pisah Harta', 'checklists[objek][fotokopi_akta_nikah_cerai_pisah_harta]', ['' => 'pilih', 'ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['objek']['fotokopi_akta_nikah_cerai_pisah_harta'], ['class' => 'custom-select form-control']) !!}
		</div>
	</div>

	<div class="row pl-3">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('Fotokopi NPWP/SIUP', 'checklists[objek][fotokopi_npwp_siup]', ['' => 'pilih', 'ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['objek']['fotokopi_npwp_siup'], ['class' => 'custom-select form-control']) !!}
		</div>
	</div>

	<div class="row pl-3">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('BPKB Asli dan Fotokopi', 'checklists[objek][bpkb_asli_dan_fotokopi]', ['' => 'pilih', 'ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['objek']['bpkb_asli_dan_fotokopi'], ['class' => 'custom-select form-control']) !!}
		</div>
	</div>

	<div class="row pl-3">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('Fotokopi Faktur Asli dan STNK', 'checklists[objek][fotokopi_faktur_dan_stnk]', ['' => 'pilih', 'ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['objek']['fotokopi_faktur_dan_stnk'], ['class' => 'custom-select form-control']) !!}
		</div>
	</div>

	<div class="row pl-3">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('Kwitansi Jual Beli (Kosongan)', 'checklists[objek][kwitansi_jual_beli_kosongan]', ['' => 'pilih', 'ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['objek']['kwitansi_jual_beli_kosongan'], ['class' => 'custom-select form-control']) !!}
		</div>
	</div>

	<div class="row pl-3">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('Kwitansi dan KTP Sesuai BPKB', 'checklists[objek][kwitansi_ktp_sesuai_bpkb]', ['' => 'pilih', 'ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['objek']['kwitansi_ktp_sesuai_bpkb'], ['class' => 'custom-select form-control']) !!}
		</div>
	</div>

	<div class="row pl-3">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('Asuransi Kendaraan', 'checklists[objek][asuransi_kendaraan]', ['' => 'pilih', 'ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['objek']['asuransi_kendaraan'], ['class' => 'custom-select form-control']) !!}
		</div>
	</div>

	<div class="row pl-3">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('Sertifikat Asli dan Fotokopi', 'checklists[objek][sertifikat_asli_dan_fotokopi]', ['' => 'pilih', 'ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['objek']['sertifikat_asli_dan_fotokopi'], ['class' => 'custom-select form-control']) !!}
		</div>
	</div>

	<div class="row pl-3">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('AJB', 'checklists[objek][ajb]', ['' => 'pilih', 'ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['objek']['ajb'], ['class' => 'custom-select form-control']) !!}
		</div>
	</div>

	<div class="row pl-3">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('IMB', 'checklists[objek][imb]', ['' => 'pilih', 'ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['objek']['imb'], ['class' => 'custom-select form-control']) !!}
		</div>
	</div>

	<div class="row pl-3">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('PBB Terakhir', 'checklists[objek][pbb_terakhir]', ['' => 'pilih', 'ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['objek']['pbb_terakhir'], ['class' => 'custom-select form-control']) !!}
		</div>
	</div>

	<div class="row pl-3">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('Check Fisik', 'checklists[objek][check_fisik]', ['' => 'pilih', 'ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['objek']['check_fisik'], ['class' => 'custom-select form-control']) !!}
		</div>
	</div>

	<div class="row pl-3">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('Foto Jaminan', 'checklists[objek][foto_jaminan]', ['' => 'pilih', 'ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['objek']['foto_jaminan'], ['class' => 'custom-select form-control']) !!}
		</div>
	</div>

	<h6 class="text-gray mb-4 pl-3">Checklists Dokumen Pengikat</h6>
	<div class="row pl-3">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('Permohonan Kredit', 'checklists[pengikat][permohonan_kredit]', ['' => 'pilih', 'ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['pengikat']['permohonan_kredit'], ['class' => 'custom-select form-control']) !!}
		</div>
	</div>

	<div class="row pl-3">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('Survei Kredit', 'checklists[pengikat][survei_report]', ['' => 'pilih', 'ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['pengikat']['survei_report'], ['class' => 'custom-select form-control']) !!}
		</div>
	</div>

	<div class="row pl-3">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('Persetujuan Komite', 'checklists[pengikat][persetujuan_komite]', ['' => 'pilih', 'ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['pengikat']['persetujuan_komite'], ['class' => 'custom-select form-control']) !!}
		</div>
	</div>

	<div class="row pl-3">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('Perjanjian Kredit', 'checklists[pengikat][perjanjian_kredit]', ['' => 'pilih', 'ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['pengikat']['perjanjian_kredit'], ['class' => 'custom-select form-control']) !!}
		</div>
	</div>

	<div class="row pl-3">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('Pengakuan Hutang', 'checklists[pengikat][pengakuan_hutang]', ['' => 'pilih', 'ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['pengikat']['pengakuan_hutang'], ['class' => 'custom-select form-control']) !!}
		</div>
	</div>

	<div class="row pl-3">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('Pernyataan Analis', 'checklists[pengikat][pernyataan_analis]', ['' => 'pilih', 'ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['pengikat']['pernyataan_analis'], ['class' => 'custom-select form-control']) !!}
		</div>
	</div>

	<div class="row pl-3">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('Penggantian Jaminan', 'checklists[pengikat][penggantian_jaminan]', ['' => 'pilih', 'ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['pengikat']['penggantian_jaminan'], ['class' => 'custom-select form-control']) !!}
		</div>
	</div>

	<div class="row pl-3">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('SKMHT/APHT', 'checklists[pengikat][skmht_apht]', ['' => 'pilih', 'ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['pengikat']['skmht_apht'], ['class' => 'custom-select form-control']) !!}
		</div>
	</div>

	<div class="row pl-3">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('FEO', 'checklists[pengikat][feo]', ['' => 'pilih', 'ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['pengikat']['feo'], ['class' => 'custom-select form-control']) !!}
		</div>
	</div>

	<div class="row pl-3">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('Surat Persetujuan Keluarga', 'checklists[pengikat][surat_persetujuan_keluarga]', ['' => 'pilih', 'ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['pengikat']['surat_persetujuan_keluarga'], ['class' => 'custom-select form-control']) !!}
		</div>
	</div>

	<div class="row pl-3">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('Surat Persetujuan Pemasangan Plang', 'checklists[pengikat][surat_persetujuan_plang]', ['' => 'pilih', 'ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['pengikat']['surat_persetujuan_plang'], ['class' => 'custom-select form-control']) !!}
		</div>
	</div>


	<div class="row pl-3">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('Pernyataan Belum Balik Nama', 'checklists[pengikat][pernyataan_belum_balik_nama]', ['' => 'pilih', 'ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['pengikat']['pernyataan_belum_balik_nama'], ['class' => 'custom-select form-control']) !!}
		</div>
	</div>

	<div class="row pl-3">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('Kuasa Pembebanan FEO', 'checklists[pengikat][kuasa_pembebanan_feo]', ['' => 'pilih', 'ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['pengikat']['kuasa_pembebanan_feo'], ['class' => 'custom-select form-control']) !!}
		</div>
	</div>

	<div class="row pl-3">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('Kuasa Menjual dan Menarik Jaminan', 'checklists[pengikat][kuasa_menjual_dan_menarik_jaminan]', ['' => 'pilih', 'ada' => 'Ada', 'tidak_ada' => 'Tidak Ada', 'cadangkan' => 'Tidak Perlu'], $putusan['checklists']['pengikat']['kuasa_menjual_dan_menarik_jaminan'], ['class' => 'custom-select form-control']) !!}
		</div>
	</div>

	{!! Form::bsSubmit('Simpan Putusan', ['class' => 'btn btn-primary float-right mr-3 pl-3']) !!}
	{!!Form::close()!!}
@endif