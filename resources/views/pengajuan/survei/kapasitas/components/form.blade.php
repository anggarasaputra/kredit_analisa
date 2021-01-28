<h6 class="text-secondary"><strong><u>Kapasitas</u></strong></h6>
<div class="row">
	<div class="col-auto col-md-6">
		{!! Form::bsSelect('Manajemen usaha', '[capacity][manajemen_usaha]', ['' => 'pilih', 'baik' => 'Baik', 'cukup_baik' => 'Cukup Baik', 'tidak_baik' => 'Tidak Baik'], null, ['class' => 'custom-select form-control', 'placeholder' => '']) !!}
	</div>
</div>
<div class="row">
	<div class="col-auto col-md-6">
		{!! Form::bsText('Kemampuan Angsur', '[capacity][kemampuan_angsur]', null, ['class' => 'form-control', 'placeholder' => 'kemampuang angsur']) !!}
	</div>
</div>
<div class="row">
	<div class="col-auto col-md-6">
		{!! Form::bsText('Sumber Penghasilan Pokok Pinjaman', '[capacity][sumber_penghasilan_pokok_pinjaman]', null, ['class' => 'form-control', 'placeholder' => 'sumber penghasilan untuk pokok pinjaman']) !!}
	</div>
</div>
<div class="row">
	<div class="col-auto col-md-6">
		{!! Form::bsText('Tempat Kerja Pasangan', '[capacity][tempat_kerja_pasangan]', null, ['class' => 'form-control', 'placeholder' => 'tempat kerja pasangan']) !!}
	</div>
</div>

{{-- Penghasilan --}}
<div class="row">
	<div class="col-auto col-md-6">
		{!! Form::bsText('Penghasilan Gaji', '[capacity][penghasilan][gaji]', null, ['class' => 'form-control', 'placeholder' => 'Penghasilan dari Gaji']) !!}
	</div>
</div>
<div class="row">
	<div class="col-auto col-md-6">
		{!! Form::bsText('Penghasilan Pasangan', '[capacity][penghasilan][pasangan]', null, ['class' => 'form-control', 'placeholder' => 'Penghasilan dari Pasangan']) !!}
	</div>
</div>
<div class="row">
	<div class="col-auto col-md-6">
		{!! Form::bsText('Penghasilan lain-lain', '[capacity][penghasilan][lain_lain]', null, ['class' => 'form-control', 'placeholder' => 'Penghasilan lain-lain']) !!}
	</div>
</div>


{{-- pengeluaran --}}
<div class="row">
	<div class="col-auto col-md-6">
		{!! Form::bsText('Biaya Rumah tangga', '[capacity][pengeluaran][biaya_rumah_tangga]', null, ['class' => 'form-control', 'placeholder' => 'Pengeluaran biaya untuk rumah tangga']) !!}
	</div>
</div>
<div class="row">
	<div class="col-auto col-md-6">
		{!! Form::bsText('Biaya listrik, PDAM, telepon', '[capacity][pengeluaran][biaya_listrik_pdam_telepon]', null, ['class' => 'form-control', 'placeholder' => 'Pengeluaran biaya untuk listrik, PDAM, dan telepon']) !!}
	</div>
</div>
<div class="row">
	<div class="col-auto col-md-6">
		{!! Form::bsText('Biaya pendidikan', '[capacity][pengeluaran][biaya_pendidikan]', null, ['class' => 'form-control', 'placeholder' => 'Pengeluaran biaya untuk pendidikan']) !!}
	</div>
</div>
<div class="row">
	<div class="col-auto col-md-6">
		{!! Form::bsText('Biaya produksi', '[capacity][pengeluaran][biaya_produksi]', null, ['class' => 'form-control', 'placeholder' => 'Pengeluaran biaya untuk produksi']) !!}
	</div>
</div>
<div class="row">
	<div class="col-auto col-md-6">
		{!! Form::bsText('Biaya lain-lain', '[capacity][pengeluaran][lain_lain]', null, ['class' => 'form-control', 'placeholder' => 'Pengeluaran biaya lain-lain']) !!}
	</div>
</div>

<div class="row">
	<div class="col-auto col-md-6">
		{!! Form::bsTextarea('Catatan', '[capacity][catatan]', null, ['class' => 'form-control', 'placeholder' => 'catatan', 'cols' => 20, 'rows' => 5, 'style' => 'resize:none;']) !!}
	</div>
</div>