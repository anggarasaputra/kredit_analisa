<h6 class="text-secondary"><strong><u>Kondisi</u></strong></h6>
<div class="row">
	<div class="col-auto col-md-6">
		{!! Form::bsSelect('Persaingan Usaha', '[condition][persaingan_usaha]', ['' => 'pilih', 'biasa' => 'biasa', 'sedang' => 'Sedang', 'padat' => 'Padat'], null, ['class' => 'custom-select form-control', 'placeholder' => '']) !!}
	</div>
</div>
<div class="row">
	<div class="col-auto col-md-6">
		{!! Form::bsSelect('Prospek Usaha', '[condition][prospek_usaha]', ['' => 'pilih', 'biasa' => 'biasa', 'sedang' => 'Sedang', 'padat' => 'Padat'], null, ['class' => 'form-control custom-select', 'placeholder' => '']) !!}
	</div>
</div>
<div class="row">
	<div class="col-auto col-md-6">
		{!! Form::bsSelect('perputaran usaha', '[condition][perputaran_usaha]', ['' => 'pilih', 'lambat' => 'lambat', 'sedang' => 'Sedang', 'padat' => 'Padat'], null, ['class' => 'form-control custom-select', 'placeholder' => '']) !!}
	</div>
</div>
<div class="row">
	<div class="col-auto col-md-6">
		{!! Form::bsText('pengalaman usaha', '[condition][pengalaman_usaha]', null, ['class' => 'form-control', 'placeholder' => 'pengalaman usaha']) !!}
	</div>
</div>
<div class="row">
	<div class="col-auto col-md-6">
		{!! Form::bsSelect('resiko usaha kedepan', '[condition][resiko_usaha_kedepan]', ['' => 'pilih', 'bagus' => 'bagus', 'biasa' => 'biasa', 'suram' => 'suram'], null, ['class' => 'form-control custom-select', 'placeholder' => '']) !!}
	</div>
</div>