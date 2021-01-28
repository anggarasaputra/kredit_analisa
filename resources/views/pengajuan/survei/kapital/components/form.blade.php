<h6 class="text-secondary"><strong><u>Kapital</u></strong></h6>
{{-- rumah --}}
<p><strong>rumah</strong></p>
<div class="row">
	<div class="col-auto col-md-6">
		{!! Form::bsSelect('status', '[capital][rumah][status]', ['' => 'pilih', 'dinas' => 'dinas', 'keluarga' => 'keluarga', 'milik_sendiri' => 'milik sendiri', 'sewa' => 'sewa'], null, ['class' => 'custom-select form-control', 'placeholder' => '']) !!}
	</div>
</div>

{{-- khusus status sewa --}}
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsText('sewa sejak', '[capital][rumah][sewa_sejak]', null, ['class' => 'form-control', 'placeholder' => 'sewa sejak tahun']) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsText('masa sewa', '[capital][rumah][masa_sewa]', null, ['class' => 'form-control', 'placeholder' => 'masa sewa']) !!}
		</div>
	</div>
{{-- khusus status sewa --}}


<div class="row">
	<div class="col-auto col-md-6">
		{!! Form::bsText('angsuran bulanan', '[capital][rumah][angsuran_bulanan]', null, ['class' => 'form-control', 'placeholder' => 'angsuran bulanan']) !!}
	</div>
</div>
<div class="row">
	<div class="col-auto col-md-6">
		{!! Form::bsText('lama angsuran', '[capital][rumah][lama_angsuran]', null, ['class' => 'form-control', 'placeholder' => 'lama angsuran']) !!}
	</div>
</div>
<div class="row">
	<div class="col-auto col-md-6">
		{!! Form::bsText('lama menempati', '[capital][rumah][lama_menempati]', null, ['class' => 'form-control', 'placeholder' => 'lama menempati']) !!}
	</div>
</div>
<div class="row">
	<div class="col-auto col-md-6">
		{!! Form::bsText('luas rumah', '[capital][rumah][luas_rumah]', null, ['class' => 'form-control', 'placeholder' => 'luas ukuran rumah']) !!} <!-- kurang ukuran satuan -->
	</div>
</div>
<div class="row">
	<div class="col-auto col-md-6">
		{!! Form::bsText('harga nilai jual rumah', '[capital][rumah][nilai_rumah]', null, ['class' => 'form-control', 'placeholder' => 'harga nilai jual rumah']) !!}
	</div>
</div>

{{-- kendaraan --}}
<p><strong>kendaraan</strong></p>
<div class="row">
	<div class="col-auto col-md-6">
		{!! Form::bsText('jumlah kendaran roda 2', '[capital][kendaraan][jumlah_kendaraan_roda_2]', null, ['class' => 'form-control', 'placeholder' => 'jumlah kendaraan roda 2']) !!}
	</div>
</div>
<div class="row">
	<div class="col-auto col-md-6">
		{!! Form::bsText('jumlah kendaran roda 4', '[capital][kendaraan][jumlah_kendaraan_roda_4]', null, ['class' => 'form-control', 'placeholder' => 'jumlah kendaraan roda 4']) !!}
	</div>
</div>
<div class="row">
	<div class="col-auto col-md-6">
		{!! Form::bsText('jumlah kendaran roda 4', '[capital][kendaraan][jumlah_kendaraan_roda_4]', null, ['class' => 'form-control', 'placeholder' => 'jumlah kendaraan roda 4']) !!}
	</div>
</div>
<div class="row">
	<div class="col-auto col-md-6">
		{!! Form::bsText('Harga nilai jual semua kendaraan', '[capital][kendaraan][nilai_kendaraan]', null, ['class' => 'form-control', 'placeholder' => 'harga nilai jual semua kendaraan']) !!}
	</div>
</div>

{{-- usaha --}}
<p><strong>usaha</strong></p>
<div class="row">
	<div class="col-auto col-md-6">
		{!! Form::bsText('nama usaha', '[capital][usaha][nama_usaha]', null, ['class' => 'form-control', 'placeholder' => 'nama usaha']) !!}
	</div>
</div>
<div class="row">
	<div class="col-auto col-md-6">
		{!! Form::bsText('bidang usaha', '[capital][usaha][bidang_usaha]', null, ['class' => 'form-control', 'placeholder' => 'usaha bergerak dibidang']) !!}
	</div>
</div>
<div class="row">
	<div class="col-auto col-md-6">
		{!! Form::bsText('lama usaha', '[capital][usaha][lama_usaha]', null, ['class' => 'form-control', 'placeholder' => 'lama usaha berdiri']) !!}
	</div>
</div>
<div class="row">
	<div class="col-auto col-md-6">
		{!! Form::bsSelect('status usaha', '[capital][usaha][status_usaha]', ['' => 'pilih', 'kerja_sama_bagi_hasil' => 'kerja sama bagi hasil', 'milik_keluarga' => 'milik keluarga', 'milik_sendiri' => 'milik sendiri'], null, ['class' => 'custom-select form-control', 'placeholder' => '']) !!}
	</div>
</div>

{{-- khusus status bagi hasil --}}
	<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsText('bagi hasil', '[capital][usaha][bagi_hasil]', null, ['class' => 'form-control', 'placeholder' => 'persentasi bagi hasil']) !!} <!-- kurang satuan persen -->
		</div>
	</div>
{{-- khusus status bagi hasil --}}

<div class="row">
		<div class="col-auto col-md-6">
			{!! Form::bsText('nilai aset usaha', '[capital][usaha][nilai_aset]', null, ['class' => 'form-control', 'placeholder' => 'harga nilai aset']) !!}
		</div>
	</div>