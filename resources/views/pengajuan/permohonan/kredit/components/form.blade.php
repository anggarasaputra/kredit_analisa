{{-- <div class="col-auto col-md-3">
	{!! Form::bsText('Tanggal Pengajuan', 'tanggal_pengajuan', $hari_ini, ['class' => 'form-control', 'placeholder' => 'Masukkan tanggal dd/mm/yyyy']) !!}
</div> --}}
<div class="col-auto col-md-3">
	{!! Form::bsText('Pokok Jaminan', 'pokok_pinjaman', null, ['class' => 'form-control mask-money', 'placeholder' => 'masukkan pokok pinjaman'], true, 'Min. Rp. 2.500.000') !!}
</div>
<div class="col-auto col-md-3">
	{!! Form::bsText('Kemampuan Angsuran', 'kemampuan_angsur', null, ['class' => 'form-control mask-money', 'placeholder' => 'masukkan kemampuan angsur']) !!}
</div>