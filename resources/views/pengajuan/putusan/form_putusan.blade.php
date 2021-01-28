{!! Form::open(['url' => route('pengajuan.putusan.update', ['id' => $permohonan['id'], 'kantor_aktif_id' => $kantor_aktif_id]), 'method' => 'PATCH']) !!}
	<div class="row">
		<div class="col">
			{!! Form::vText('Tanggal Putusan', 'tanggal', $putusan['tanggal'], ['class' => 'form-control mask-date-time inline-edit text-info', 'placeholder' => 'dd/mm/yyyy hh:mm'], true) !!}
		</div>
	</div>
	<div class="row">
		<div class="col">
			{!! Form::vText('Plafon Pinjaman', 'plafon_pinjaman', $putusan['plafon_pinjaman'], ['class' => 'form-control inline-edit text-info mask-money', 'placeholder' => 'Rp 6.000.000'], true) !!}
		</div>
	</div>
	<div class="row">
		<div class="col">
			{!! Form::vText('Suku Bunga', 'suku_bunga', $putusan['suku_bunga'], ['class' => 'form-control inline-edit text-info', 'placeholder' => '0.4'], true) !!}
		</div>
	</div>
	<div class="row">
		<div class="col">
			{!! Form::vText('Jangka Waktu', 'jangka_waktu', $putusan['jangka_waktu'], ['class' => 'form-control inline-edit text-info', 'placeholder' => '12'], true) !!}
		</div>
	</div>
	<div class="row">
		<div class="col">
			{!! Form::vText('Provisi', 'perc_provisi', $putusan['perc_provisi'], ['class' => 'form-control inline-edit text-info', 'placeholder' => '0.4'], true) !!}
		</div>
	</div>
	<div class="row">
		<div class="col">
			{!! Form::vText('Administrasi', 'administrasi', $putusan['administrasi'], ['class' => 'form-control inline-edit text-info mask-money', 'placeholder' => 'Rp 60.000'], true) !!}
		</div>
	</div>
	<div class="row">
		<div class="col">
			{!! Form::vText('Legal', 'legal', $putusan['legal'], ['class' => 'form-control inline-edit text-info mask-money', 'placeholder' => 'Rp 70.000'], true) !!}
		</div>
	</div>
	<div class="row">
		<div class="col">
			{!! Form::vSelect('Putusan', 'putusan', ['setuju' => 'Setuju', 'tolak' => 'Tolak'], $putusan['putusan'], ['class' => 'form-control text-info inline-edit'], true) !!}
		</div>
	</div>
	<div class="row">
		<div class="col">
			{!! Form::vTextarea('Catatan', 'catatan', $putusan['catatan'], ['class' => 'form-control inline-edit text-info', 'placeholder' => 'Ganti Jaminan', 'rows' => 5], true) !!}
		</div>
	</div>


{!! Form::bsSubmit('Simpan', ['class' => 'btn btn-primary float-right mr-3']) !!}
{!! Form::close() !!}