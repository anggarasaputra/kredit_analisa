<h6 class="text-secondary"><strong><u>Karakter</u></strong></h6>
<div class="row">
	<div class="col-auto col-md-6">
		{!! Form::bsSelect('Watak', '[character][watak]', ['' => 'pilih', 'baik' => 'Baik', 'cukup_baik' => 'Cukup Baik', 'tidak_baik' => 'Tidak Baik'], null, ['class' => 'custom-select form-control', 'placeholder' => '']) !!}
	</div>
</div>
<div class="row">
	<div class="col-auto col-md-6">
		{!! Form::bsSelect('Watak', '[character][pola_hidup]', ['' => 'pilih', 'mewah' => 'mewah', 'sederhana' => 'Sederhana'], null, ['class' => 'form-control custom-select', 'placeholder' => '']) !!}
	</div>
</div>
<div class="row">
	<div class="col-auto col-md-6">
		{!! Form::bsText('Informasi', '[character][informasi]', null, ['class' => 'form-control', 'placeholder' => 'informasi dari tetangga']) !!}
	</div>
</div>
<div class="row">
	<div class="col-auto col-md-6">
		{!! Form::bsTextarea('Catatan', '[character][catatan]', null, ['class' => 'form-control', 'placeholder' => 'catatan dari tetangga', 'cols' => 20, 'rows' => 5, 'style' => 'resize:none;']) !!}
	</div>
</div>