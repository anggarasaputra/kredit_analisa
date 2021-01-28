{{-- <h6 class="text-secondary"><strong><u>Jaminan Kendaraan</u></strong></h6> --}}
<div class="row">
	<div class="col-auto col-md-4">
		{!! Form::bsSelect('Jenis', 'jenis', array_merge(['' => 'pilih'], $jenis_kendaraan), null, ['class' => 'custom-select form-control']) !!}
	</div>
</div>
<div class="row">
	<div class="col-auto col-md-6">
		{!! Form::bsText('Merk', 'merk', null, ['class' => 'form-control']) !!}
	</div>
</div>
<div class="row">
	<div class="col-auto col-md-5">
		{!! Form::bsText('Tipe', 'tipe', null, ['class' => 'form-control']) !!}
	</div>
</div>
<div class="row">
	<div class="col-auto col-md-4">
		{!! Form::bsText('tahun', 'tahun', null, ['class' => 'form-control mask-year']) !!}
	</div>
</div>
<div class="row">
	<div class="col-auto col-md-4">
		{!! Form::bsText('No. BPKB', 'nomor_bpkb', null, ['class' => 'form-control']) !!}
	</div>
</div>
<div class="row">
	<div class="col-auto col-md-8">
		{!! Form::bsText('Atas Nama', 'atas_nama', null, ['class' => 'form-control']) !!}
	</div>
</div>
<div class="row">
	<div class="col-auto col-md-6">
		{!! Form::bsText('Nilai Jaminan', 'nilai_jaminan', null, ['class' => 'form-control mask-money']) !!}
	</div>
</div>
<div class="row">
	<div class="col-auto col-md-4">
		{!! Form::bsText('Tahun Perolehan', 'tahun_perolehan', null, ['class' => 'form-control mask-year']) !!}
	</div>
</div>