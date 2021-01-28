{{-- <h6 class="text-secondary ml-3"><strong><u>Kerabat/Keluarga</u></strong></h6> --}}
<div class="row">
	<div class="col-auto col-md-4">
		{!! Form::bsSelect('Hubungan', 'hubungan', ['' => 'pilih', 'orang_tua' => 'Orang Tua', 'suami' => 'Suami', 'istri' => 'Istri', 'saudara' => 'Saudara'], null, ['class' => 'custom-select form-control']) !!}
	</div>
</div>
<div class="row">
	<div class="col-auto col-md-8">
		{!! Form::bsText('Nama', 'nama', null, ['class' => 'form-control']) !!}
	</div>
</div>
<div class="row">
	<div class="col-auto col-md-5">
		{!! Form::bsText('NIK', 'nik', null, ['class' => 'form-control']) !!}
	</div>
</div>
<div class="row">
	<div class="col-auto col-md-4">
		{!! Form::bsText('No. Telepon', 'telepon', null, ['class' => 'form-contro mask-no-telepon']) !!}
	</div>
</div>