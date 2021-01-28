<div class="row">
	<div class="col">
		<h5 class="pb-4">Analisa</h5>
	</div>
</div>

@if(count($analisa) && $permohonan['status_terakhir']['status']!= 'analisa')
	<div class="row pl-3">
		<div class="col-3">
			<p class="text-secondary text-capitalize">Oleh</p>
		</div>
		<div class="col">
			<p class="text-capitalize">{{$analisa['analis']['nama']}}</p>
		</div>
	</div>
	<div class="row pl-3">
		<div class="col-3">
			<p class="text-secondary text-capitalize">Tanggal</p>
		</div>
		<div class="col">
			<p class="text-capitalize">{{$analisa['tanggal']}}</p>
		</div>
	</div>


	<h5 class="text-gray mb-4 pl-3">Analisa Kredit</h5>
	@foreach($analisa->toArray() as $k2 => $v2)
		@if(!in_array($k2, ['id', 'pengajuan_id', 'analis', 'created_at', 'updated_at', 'deleted_at', 'tanggal']))
			<div class="row pl-3">
				<div class="col-3">
					<p class="text-secondary text-capitalize">{{ str_replace('_', ' ', $k2) }}</p>
				</div>
				<div class="col">
					<p class="text-capitalize">{{ str_replace('_', ' ', $v2) }}</p>
				</div>
			</div>
		@endif
	@endforeach
@else
	<h5 class="text-gray mb-4 pl-3">Form Analisa</h5>
	
	{{Form::open(['url' => route('pengajuan.analisa.update', ['id' => $permohonan['id'], 'kantor_aktif_id' => $kantor_aktif['id']]), 'method' => 'PATCH'])}}

	<div class="row pl-3">
		<div class="col-auto col-md-3">
			{!! Form::bsText('Tanggal', 'tanggal', !is_null($analisa['tanggal']) ? $analisa['tanggal'] : Carbon\Carbon::now()->format('d/m/Y H:i'), ['class' => 'form-control', 'placeholder' => 'Masukkan tanggal dd/mm/yyyy hh:ii']) !!}
		</div>
	</div>

	<div class="row pl-3">
		<div class="col-auto col-md-3">
			{!! Form::bsSelect('Character', 'character', ['' => 'pilih', 'sangat_baik' => 'Sangat Baik', 'baik' => 'Baik', 'cukup_baik' => 'Cukup Baik', 'tidak_baik' => 'Tidak Baik', 'buruk' => 'Buruk'], $analisa['character'], ['class' => 'custom-select form-control']) !!}
		</div>
	</div>

	<div class="row pl-3">
		<div class="col-auto col-md-3">
			{!! Form::bsSelect('Capacity', 'capacity', ['' => 'pilih', 'sangat_baik' => 'Sangat Baik', 'baik' => 'Baik', 'cukup_baik' => 'Cukup Baik', 'tidak_baik' => 'Tidak Baik', 'buruk' => 'Buruk'], $analisa['capacity'], ['class' => 'custom-select form-control']) !!}
		</div>
	</div>

	<div class="row pl-3">
		<div class="col-auto col-md-3">
			{!! Form::bsSelect('Capital', 'capital', ['' => 'pilih', 'sangat_baik' => 'Sangat Baik', 'baik' => 'Baik', 'cukup_baik' => 'Cukup Baik', 'tidak_baik' => 'Tidak Baik', 'buruk' => 'Buruk'], $analisa['capital'], ['class' => 'custom-select form-control']) !!}
		</div>
	</div>

	<div class="row pl-3">
		<div class="col-auto col-md-3">
			{!! Form::bsSelect('Condition', 'condition', ['' => 'pilih', 'sangat_baik' => 'Sangat Baik', 'baik' => 'Baik', 'cukup_baik' => 'Cukup Baik', 'tidak_baik' => 'Tidak Baik', 'buruk' => 'Buruk'], $analisa['condition'], ['class' => 'custom-select form-control']) !!}
		</div>
	</div>

	<div class="row pl-3">
		<div class="col-auto col-md-3">
			{!! Form::bsSelect('Collateral', 'collateral', ['' => 'pilih', 'sangat_baik' => 'Sangat Baik', 'baik' => 'Baik', 'cukup_baik' => 'Cukup Baik', 'tidak_baik' => 'Tidak Baik', 'buruk' => 'Buruk'], $analisa['collateral'], ['class' => 'custom-select form-control']) !!}
		</div>
	</div>

	<div class="row pl-3">
		<div class="col-auto col-md-3">
			{!! Form::bsSelect('Jenis Pinjaman', 'jenis_pinjaman', ['' => 'pilih', 'pa' => 'Angsuran (PA)', 'pt' => 'Musiman (PT)'], $analisa['jenis_pinjaman'], ['class' => 'custom-select form-control']) !!}
		</div>
	</div>

	<div class="row pl-3">
		<div class="col-auto col-md-3">
			{!! Form::bsText('Suku Bunga', 'suku_bunga', $analisa['suku_bunga'], ['class' => 'form-control', 'placeholder' => 'masukkan suku bunga']) !!}
		</div>
	</div>

	<div class="row pl-3">
		<div class="col-auto col-md-3">
			{!! Form::bsText('Jangka Waktu', 'jangka_waktu', $analisa['jangka_waktu'], ['class' => 'form-control', 'placeholder' => 'masukkan jangka waktu']) !!}
		</div>
	</div>

	<div class="row pl-3">
		<div class="col-auto col-md-3">
			{!! Form::bsText('Limit Angsuran', 'limit_angsuran', $analisa['limit_angsuran'], ['class' => 'form-control mask-money', 'placeholder' => 'masukkan limit angsuran']) !!}
		</div>
	</div>

	<div class="row pl-3">
		<div class="col-auto col-md-3">
			{!! Form::bsText('Limit Jangka Waktu', 'limit_jangka_waktu', $analisa['limit_jangka_waktu'], ['class' => 'form-control', 'placeholder' => 'masukkan limit jangka waktu']) !!}
		</div>
	</div>

	<div class="row pl-3">
		<div class="col-auto col-md-3">
			{!! Form::bsText('Kredit Diusulkan', 'kredit_diusulkan', $analisa['kredit_diusulkan'], ['class' => 'form-control mask-money', 'placeholder' => 'masukkan kredit diusulkan']) !!}
		</div>
	</div>

	<div class="row pl-3">
		<div class="col-auto col-md-3">
			{!! Form::bsText('Angsuran Pokok', 'angsuran_pokok', $analisa['angsuran_pokok'], ['class' => 'form-control mask-money', 'placeholder' => 'masukkan angsuran pokok']) !!}
		</div>
	</div>

	<div class="row pl-3">
		<div class="col-auto col-md-3">
			{!! Form::bsText('Angsuran Bunga', 'angsuran_bunga', $analisa['angsuran_bunga'], ['class' => 'form-control mask-money', 'placeholder' => 'masukkan angsuran bunga']) !!}
		</div>
	</div>

	{!! Form::bsSubmit('Simpan Analisa', ['class' => 'btn btn-primary float-right mr-3 pl-3']) !!}

	{!!Form::close()!!}
@endif