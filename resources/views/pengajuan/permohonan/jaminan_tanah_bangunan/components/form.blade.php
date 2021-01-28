{{-- <h6 class="text-secondary ml-3"><strong><u>Jaminan Tanah &amp; Bangunan</u></strong></h6> --}}
<div class="row">
	<div class="col-auto col-md-6">
		{!! Form::bsSelect('Tipe', 'tipe', ['' => 'pilih', 'tanah' => 'Tanah', 'tanah_bangunan' => 'Tanah &amp; Bangunan'], null, ['class' => 'custom-select form-control']) !!}
	</div>
</div>
<div class="row">
	<div class="col-auto col-md-6">
		{!! Form::bsSelect('Sertifikat', 'jenis_sertifikat', array_merge(['' => 'pilih'], $jenis_sertifikat), null, ['class' => 'custom-select form-control']) !!}
	</div>
</div>
<div class="row">
	<div class="col-auto col-md-5">
		{!! Form::bsText('No. Sertifikat', 'nomor_sertifikat', null, ['class' => 'form-control']) !!}
	</div>
</div>
<div class="row">
	<div class="col-auto col-md-5">
		{!! Form::bsText('Jenis', 'jenis', null, ['class' => 'form-control']) !!}
	</div>
</div>
<div class="row">
	<div class="col-auto col-md-4 tanah">
		{!! Form::bsText('luas tanah', 'luas_tanah', null, ['class' => 'form-control mask-number'], true, null, null, 'M<sup>2</sup>') !!}
	</div>
	<div class="col-auto col-md-4 tanah_bangunan">
		{!! Form::bsText('luas bangunan', 'luas_bangunan', null, ['class' => 'form-control mask-number'], true, null, null, 'M<sup>2</sup>') !!}
	</div>
</div>
<div class="row">
	<div class="col-auto col-md-8">
		{!! Form::bsText('Atas Nama', 'atas_nama', null, ['class' => 'form-control']) !!}
	</div>
</div>
<div class="row">
	<div class="col-auto col-md-8">
		{!! Form::bsText('Alamat', 'alamat[alamat]', null, ['class' => 'form-control']) !!}
	</div>
</div>
<div class="row">
	<div class="col-auto col-md-4">
		{!! Form::bsText('RT', 'alamat[rt]', null, ['class' => 'form-control']) !!}
	</div>
	<div class="col-auto col-md-4">
		{!! Form::bsText('RW', 'alamat[rw]', null, ['class' => 'form-control']) !!}
	</div>
</div>
<div class="row">
	<div class="col-auto col-md-6">
		{!! Form::bsText('Kota/Kabupaten', 'alamat[kota]', null, ['class' => 'form-control']) !!}
	</div>
</div>
<div class="row">
	<div class="col-auto col-md-6">
		{!! Form::bsText('Kecamatan', 'alamat[kecamatan]', null, ['class' => 'form-control']) !!}
	</div>
</div>
<div class="row">
	<div class="col-auto col-md-6">
		{!! Form::bsText('Kelurahan', 'alamat[kelurahan]', null, ['class' => 'form-control']) !!}
	</div>
</div>
<div class="row">
	<div class="col-auto col-md-6">
		{!! Form::bsText('Nilai Jaminan', 'nilai_jaminan', null, ['class' => 'form-control mask-money']) !!}
	</div>
</div>
<div class="row">
	<div class="col-auto col-md-6">
		{!! Form::bsText('Tahun Perolehan', 'tahun_perolehan', null, ['class' => 'form-control mask-year']) !!}
	</div>
</div>