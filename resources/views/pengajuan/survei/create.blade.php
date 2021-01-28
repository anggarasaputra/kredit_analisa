@isset ($title)
	<div class="row">
		<div class="col">
			<h5 class="pb-4">Tambah Survei</h5>
		</div>
	</div>
@endif

{{-- nav survei --}}
<nav class="nav nav-tabs">
	<a href="#karakter" class="nav-item nav-link active" role="tab" data-toggle="tab" aria-expanded="true">Karakter</a>
	<a href="#kondisi" class="nav-item nav-link" role="tab" data-toggle="tab">Kondisi</a>
	<a href="#kapasitas" class="nav-item nav-link" role="tab" data-toggle="tab">Kapasitas</a>
	<a href="#kapital" class="nav-item nav-link" role="tab" data-toggle="tab">Kapital</a>
	<a href="#kolateral" class="nav-item nav-link" role="tab" data-toggle="tab">Kolateral</a>
</nav>

{{Form::open(['url' => route('pengajuan.survei.update', ['id' => $permohonan['id'], 'kantor_aktif_id' => $kantor_aktif['id']]), 'method' => 'PATCH'])}}
	<div class="row">
		<div class="col">
			<div class="tab-content">
				{{-- character --}}
				<div class="tab-pane fade show active mb-4" id="karakter" role="tabpanel">
					<div class="clearfix">&nbsp;</div>
					@include ('pengajuan.survei.karakter.components.form')
				</div>
				{{-- condition --}}
				<div class="tab-pane fade mb-4" id="kondisi" role="tabpanel">
					<div class="clearfix">&nbsp;</div>
					@include ('pengajuan.survei.kondisi.components.form')
				</div>
				{{-- capacity --}}
				<div class="tab-pane fade mb-4" id="kapasitas" role="tabpanel">
					<div class="clearfix">&nbsp;</div>
					@include ('pengajuan.survei.kapasitas.components.form')
				</div>
				{{-- capital --}}
				<div class="tab-pane fade mb-4" id="kapital" role="tabpanel">
					<div class="clearfix">&nbsp;</div>
					@include ('pengajuan.survei.kapital.components.form')
				</div>
				{{-- collateral --}}
				<div class="tab-pane fade mb-4" id="kolateral" role="tabpanel">
					<div class="clearfix">&nbsp;</div>
					@include ('pengajuan.survei.kolateral.components.form')
				</div>
			</div>
		</div>
	</div>
	{!! Form::bsSubmit('Simpan Survei', ['class' => 'btn btn-primary float-right mr-3']) !!}
{{Form::close()}}