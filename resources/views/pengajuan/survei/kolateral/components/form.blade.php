<h6 class="text-secondary"><strong><u>Kolateral</u></strong></h6>
<div class="row">
	<div class="col-auto col-md-6">
		{!! Form::bsSelect('status', '[collateral][jenis]', ['' => 'pilih', 'bpkb' => 'bpkb', 'shm' => 'shm', 'shgb' => 'shgb'], null, ['class' => 'custom-select form-control', 'placeholder' => '']) !!}
	</div>
</div>

{{-- bkpb --}}
	<p><strong>bpkb</strong></p>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsText('merk', 'merk', null, ['class' => 'form-control', 'placeholder' => 'merk', 'readonly' => true]) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('Jenis', 'jenis', array_merge(['' => 'pilih'], $jenis_kendaraan), null, ['class' => 'custom-select form-control', 'readonly' => true]) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsText('tipe', 'tipe', null, ['class' => 'form-control', 'placeholder' => 'tipe kendaraan', 'readonly' => true]) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsText('nomor polisi', 'nomor_polisi', null, ['class' => 'form-control', 'placeholder' => 'nomor polisi']) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsText('warna', 'warna', null, ['class' => 'form-control', 'placeholder' => 'warna']) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsText('tahun', 'tahun', null, ['class' => 'form-control', 'placeholder' => 'tahun pembuatan', 'readonly' => true]) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsText('atas nama', 'atas_nama', null, ['class' => 'form-control', 'placeholder' => 'atas nama', 'readonly' => true]) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsText('nomor bpkb', 'nomor_bpkb', null, ['class' => 'form-control', 'placeholder' => 'nomor bpkb', 'readonly' => true]) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsText('nomor rangka', 'nomor_rangka', null, ['class' => 'form-control', 'placeholder' => 'nomor rangka']) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsText('masa berlaku stnk', 'masa_berlaku_stnk', null, ['class' => 'form-control', 'placeholder' => 'masa berlaku stnk (tgl/bln/tahun)']) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsText('fungsi sehari-hari', 'fungsi_sehari_hari', null, ['class' => 'form-control', 'placeholder' => 'fungsi sehari-hari']) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('faktur', 'faktur', ['' => 'pilih', 'ada' => 'ada', 'tidak_ada' => 'tidak ada'], null, ['class' => 'custom-select form-control', 'placeholder' => '']) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('kwintasi jual beli', 'kwintasi_jual_beli', ['' => 'pilih', 'ada' => 'ada', 'tidak_ada' => 'tidak ada'], null, ['class' => 'custom-select form-control', 'placeholder' => '']) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('kwintasi kosong', 'kwintasi_kosong', ['' => 'pilih', 'ada' => 'ada', 'tidak_ada' => 'tidak ada'], null, ['class' => 'custom-select form-control', 'placeholder' => '']) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('ktp an bpkb', 'ktp_an_bpkb', ['' => 'pilih', 'ada' => 'ada', 'tidak_ada' => 'tidak ada'], null, ['class' => 'custom-select form-control', 'placeholder' => '']) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('kondisi kendaraan', 'kondisi_kendaraan', ['' => 'pilih', 'baik' => 'baik', 'cukup_baik' => 'cukup baik', 'buruk' => 'buruk'], null, ['class' => 'custom-select form-control', 'placeholder' => '']) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('status kepemilikan', 'status_kepemilikan', ['' => 'pilih', 'an_sendiri' => 'atas nama sendiri', 'an_orang_lain_milik_sendiri' => 'atas nama orang lain dan milik sendiri', 'an_orang_lain_dengan_surat_kuasa' => 'atas nama orang lain dengan surat kuasa'], null, ['class' => 'custom-select form-control', 'placeholder' => '']) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('asuransi', 'asuransi', ['' => 'pilih', 'all_risk' => 'all risk', 'tlo' => 'total loss only', 'tidak_ada' => 'tidak ada'], null, ['class' => 'custom-select form-control', 'placeholder' => '']) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsText('harga taksasi', 'harga_taksasi', null, ['class' => 'form-control', 'placeholder' => 'harga taksasi']) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsText('persentasi bank', 'persentasi_bank', null, ['class' => 'form-control', 'placeholder' => 'persentasi bank']) !!} <!-- kurang satuan -->
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsText('nilai harga bank', 'harga_bank', null, ['class' => 'form-control', 'placeholder' => 'nilai harga bank']) !!}
		</div>
	</div>

	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsText('Jalan', 'alamat', null, ['class' => 'form-control', 'placeholder' => 'masukkan alamat lengkap']) !!}
		</div>
	</div>
	<div class="row ml-0 mr-0">
		<div class="col-auto col-md-2">
			{!! Form::bsText('RT', 'rt', null, ['class' => 'form-control', 'placeholder' => '']) !!}
		</div>
		<div class="col-auto col-md-2">
			{!! Form::bsText('RW', 'rw', null, ['class' => 'form-control', 'placeholder' => '']) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-4">
			{!! Form::bsSelect('Kota/Kabupaten', 'kota', array_merge(['' => 'pilih'], $list_kota), null, ['class' => 'custom-select form-control', 'placeholder' => '']) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-4">
			{!! Form::bsSelect('Kecamatan', 'kecamatan', array_merge(['' => 'pilih'], $list_kecamatan), null, ['class' => 'custom-select form-control', 'placeholder' => '']) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-4">
			{!! Form::bsText('Desa/Dusun', 'kelurahan', null, ['class' => 'form-control', 'placeholder' => '']) !!}
		</div>
	</div>
{{-- bpkb --}}

{{-- shm --}}
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsText('atas nama sertifikat', 'atas_nama_sertifikat', null, ['class' => 'form-control', 'placeholder' => 'atas nama sertifikat', 'readonly' => true]) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsText('no. sertifikat', 'nomor_sertifikat', null, ['class' => 'form-control', 'placeholder' => 'no. sertifikat', 'readonly' => true]) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('tipe', 'tipe', ['' => 'pilih', 'tanah' => 'Tanah', 'tanah_bangunan' => 'Tanah &amp; Bangunan'], null, ['class' => 'custom-select form-control']) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsText('luas tanah', 'luas_tanah', null, ['class' => 'form-control', 'placeholder' => 'luas tanah', 'readonly' => true]) !!} <!-- kurang satuan m2 -->
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsText('panjang tanah', 'panjang_tanah', null, ['class' => 'form-control', 'placeholder' => 'panjang tanah']) !!} <!-- kurang satuan m -->
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsText('lebar tanah', 'lebar_tanah', null, ['class' => 'form-control', 'placeholder' => 'lebar tanah']) !!} <!-- kurang satuan m -->
		</div>
	</div>

	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsText('luas bangunan', 'luas_bangunan', null, ['class' => 'form-control', 'placeholder' => 'luas bangunan']) !!} <!-- kurang satuan m2 -->
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsText('panjang_bangunan', 'panjang_bangunan', null, ['class' => 'form-control', 'placeholder' => 'panjang_bangunan']) !!} <!-- kurang satuan m -->
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsText('lebar bangunan', 'lebar_bangunan', null, ['class' => 'form-control', 'placeholder' => 'lebar bangunan']) !!} <!-- kurang satuan m -->
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('fungsi bangunan', 'fungsi_bangunan', ['' => 'pilih', 'ruko' => 'ruko', 'rukan' => 'rukan (rumah dan kantor)', 'rumah' => 'rumah'], null, ['class' => 'custom-select form-control']) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('bentuk bangunan', 'bentuk_bangunan', ['' => 'pilih', 'tingkat' => 'tingkat', 'tidak_tingkat' => 'tidak tingkat'], null, ['class' => 'custom-select form-control']) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('konstruksi bangunan', 'konstruksi_bangunan', ['' => 'pilih', 'permanen' => 'permanen', 'semi_permanen' => 'semi permanen'], null, ['class' => 'custom-select form-control']) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('lantai bangunan', 'lantai_bangunan', ['' => 'pilih', 'keramik' => 'keramik', 'tegel_biasa' => 'tegel biasa'], null, ['class' => 'custom-select form-control']) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('dinding', 'dinding', ['' => 'pilih', 'tembok' => 'tembok', 'semi_tembok' => 'semi tembok'], null, ['class' => 'custom-select form-control']) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsText('listrik', 'listrik', null, ['class' => 'custom-select form-control', 'placeholder' => 'listrik']) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsText('air', 'air', null, ['class' => 'custom-select form-control', 'placeholder' => 'air']) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsText('lain-lain', 'lain_lain', null, ['class' => 'custom-select form-control', 'placeholder' => 'lain-lain']) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('jalan', 'jalan', ['' => 'pilih', 'aspal' => 'aspal', 'batu' => 'batu', 'tanah' => 'tanah'], null, ['class' => 'custom-select form-control']) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('letak_lokasi_terhadap_jalan', 'letak_lokasi_terhadap_jalan', ['' => 'pilih', 'sama' => 'sama', 'lebih_rendah' => 'lebih rendah', 'lebih_tinggi' => 'lebih tinggi'], null, ['class' => 'custom-select form-control']) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('lingkungan', 'lingkungan', ['' => 'pilih', 'industri' => 'industri', 'kampung' => 'kampung', 'pasar' => 'pasar', 'perkantoran' => 'perkantoran', 'pertokoan' => 'pertokoan', 'perumahan' => 'perumahan'], null, ['class' => 'custom-select form-control']) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('akta jual beli', 'ajb', ['' => 'pilih', 'ada' => 'ada', 'tidak_ada' => 'tidak ada'], null, ['class' => 'custom-select form-control']) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('pbb terakhir', 'pbb_teakhir', ['' => 'pilih', 'ada' => 'ada', 'tidak_ada' => 'tidak ada'], null, ['class' => 'custom-select form-control']) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('imb', 'imb', ['' => 'pilih', 'ada' => 'ada', 'tidak_ada' => 'tidak ada'], null, ['class' => 'custom-select form-control']) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsSelect('asuransi', 'asuransi', ['' => 'pilih', 'ada' => 'ada', 'tidak_ada' => 'tidak ada'], null, ['class' => 'custom-select form-control']) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsText('njop', 'njop', null, ['class' => 'custom-select form-control', 'placeholder' => 'njop']) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsText('nilai tanah', 'nilai_tanah', null, ['class' => 'custom-select form-control', 'placeholder' => 'nilai tanah']) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsText('njop tanah', 'njop_tanah', null, ['class' => 'custom-select form-control', 'placeholder' => 'njop tanah']) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsText('nilai bangunan', 'nilai_bangunan', null, ['class' => 'custom-select form-control', 'placeholder' => 'nilai bangunan']) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsText('njop bangunan', 'njop_bangunan', null, ['class' => 'custom-select form-control', 'placeholder' => 'njop bangunan']) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsText('persentasi taksasi', 'persentasi_taksasi', null, ['class' => 'custom-select form-control', 'placeholder' => 'persentasi taksasi']) !!} <!-- kurang satuan persen -->
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsText('harga taksasi', 'harga_taksasi', null, ['class' => 'custom-select form-control', 'placeholder' => 'harga taksasi']) !!}
		</div>
	</div>

	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsText('Jalan', 'alamat', null, ['class' => 'form-control', 'placeholder' => 'masukkan alamat lengkap']) !!}
		</div>
	</div>
	<div class="row ml-0 mr-0">
		<div class="col-auto col-md-2">
			{!! Form::bsText('RT', 'rt', null, ['class' => 'form-control', 'placeholder' => '']) !!}
		</div>
		<div class="col-auto col-md-2">
			{!! Form::bsText('RW', 'rw', null, ['class' => 'form-control', 'placeholder' => '']) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-4">
			{!! Form::bsSelect('Kota/Kabupaten', 'kota', array_merge(['' => 'pilih'], $list_kota), null, ['class' => 'custom-select form-control', 'placeholder' => '']) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-4">
			{!! Form::bsSelect('Kecamatan', 'kecamatan', array_merge(['' => 'pilih'], $list_kecamatan), null, ['class' => 'custom-select form-control', 'placeholder' => '']) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-4">
			{!! Form::bsText('Desa/Dusun', 'kelurahan', null, ['class' => 'form-control', 'placeholder' => '']) !!}
		</div>
	</div>