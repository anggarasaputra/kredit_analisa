<h6 class="text-secondary ml-3"><strong><u>Profil</u></strong></h6>
<div class="col-auto col-md-5">
	<div class="form-group">
		<label class="mb-1">NIK</label>
		<div class="input-group">
			<div class="input-group-addon">35-</div>
			{!! Form::text('nasabah[nik]', null, ['class' => 'form-control mask-id-card', 'placeholder' => 'masukkan NIK']) !!}
			<div class="input-group-addon bg-white border-0 invisible">
				<i class="fa fa-circle-o-notch fa-spin fa-fw"></i>
				<span class="hidden-xs">Memeriksa NIK</span>
			</div>
		</div>

		@if ($errors->has($name) && $show_error)
			<div class="invalid-feedback">
				@foreach ($errors->get($name) as $v)
					{{ $v }}<br>
				@endforeach
			</div>
		@endif
	</div>
</div>
<div class="col-auto col-md-9 pb-3">
	{!! Form::bsCheckbox('Nasabah menggunakan e-KTP', 'nasabah[is_ktp]', null, ['class' => 'form-check-input'], true) !!}
</div>
<div class="col-auto col-md-6">
	{!! Form::bsText('Nama', 'nasabah[nama]', null, ['class' => 'form-control', 'placeholder' => 'masukkan nama lengkap']) !!}
</div>
<div class="col-auto col-md-3">
	{!! Form::bsText('Tempat lahir', 'nasabah[tempat_lahir]', null, ['class' => 'form-control', 'placeholder' => 'masukkan tempat lahir']) !!}
</div>
<div class="col-auto col-md-3">
	{!! Form::bsText('Tanggal lahir', 'nasabah[tanggal_lahir]', null, ['class' => 'form-control mask-date', 'placeholder' => 'masukkan tanggal dd/mm/yyyy']) !!}
</div>
<div class="col-auto col-md-2">
	{!! Form::bsSelect('Jenis Kelamin', 'nasabah[jenis_kelamin]', ['' => 'pilih', 'laki-laki' => 'Laki-Laki', 'perempuan' => 'perempuan'], null, ['class' => 'custom-select form-control']) !!}
</div>
<div class="col-auto col-md-2">
	{!! Form::bsSelect('Status pernikahan', 'nasabah[status_perkawinan]', array_merge(['' => 'pilih'], $status_perkawinan), null, ['class' => 'custom-select form-control']) !!}
</div>
<div class="clearfix">&nbsp;</div>

<h6 class="text-secondary"><strong><u>Pekerjaan</u></strong></h6>
<div class="col-auto col-md-4">
	{!! Form::bsSelect('Pekerjaan', 'nasabah[pekerjaan]', array_merge(['' => 'pilih'], $jenis_pekerjaan), null, ['class' => 'custom-select form-control', 'placeholder' => '']) !!}
</div>
<div class="col-auto col-md-4">
	{!! Form::bsText('Penghasilan Bersih', 'nasabah[penghasilan_bersih]', null, ['class' => 'form-control mask-money', 'placeholder' => 'masukkan penghasilan bersih']) !!}
</div>
<div class="clearfix">&nbsp;</div>

<h6 class="text-secondary"><strong><u>Alamat</u></strong></h6>
<div class="col-auto col-md-6">
	<div class="row"> 
		@include('templates.alamat.ajax-alamat', ['kecamatan' => $kantor_aktif['alamat']['kecamatan'], 'prefix' => 'nasabah[alamat]'])
	</div>
</div>
<div class="clearfix">&nbsp;</div>

<div class="clearfix">&nbsp;</div>
<h6 class="text-secondary ml-3"><strong><u>Kontak</u></strong></h6>
<div class="col-auto col-md-3">
	{!! Form::bsText('No. Telp', 'nasabah[telepon]', null, ['class' => 'form-control mask-no-telepon', 'placeholder' => 'masukkan no. telp']) !!}
</div>	
<div class="col-auto col-md-3">
	{!! Form::bsText('No. Whatsapp', 'nasabah[nomor_whatsapp]', null, ['class' => 'form-control mask-no-handphone', 'placeholder' => 'masukkan no. whatsapp']) !!}
</div>
<div class="col-auto col-md-4">
	{!! Form::bsText('Email', 'nasabah[email]', null, ['class' => 'form-control', 'placeholder' => 'masukkan email']) !!}
</div>
<div class="clearfix">&nbsp;</div>
<h6 class="text-secondary ml-3"><strong><u>Dokumen Pelengkap</u></strong></h6>
<div class="col-auto col-md-5">
	<div class="form-group">
		<label class="mb-1">FOTO KTP</label><br/>
		{{-- <div class="thunder-imgUploader" thunder-imgUploader-subtitle = "* File maksimum 1MB" 
			thunder-imageUploader-store-url="{{ route('upload.image.store') }}" thunder-imageUploader-remove-url="{{ route('upload.image.destroy') }}">
			<input id="jaminan_kendaraan[foto]" name="jaminan_kendaraan[foto]" type="file" multiple accept='image/jpeg'/>
		</div> --}}
		<label class="custom-file">
			{!! Form::file('dokumen_pelengkap[ktp]', ['class' => 'custom-file-input']) !!}
			<span class="custom-file-control"></span>
		</label>
	</div>
</div>
<div class="col-auto col-md-5">
	<div class="form-group">
		<label class="mb-1">FOTO KK</label><br/>
		<label class="custom-file">
			{!! Form::file('dokumen_pelengkap[kk]', ['class' => 'custom-file-input']) !!}
			<span class="custom-file-control"></span>
		</label>
	</div>
</div>