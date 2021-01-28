@push('main')
	<div class="container bg-white p-4 bg-shadow">
		<div class="row">
			<div class="col">
				<h4 class='mb-4 text-style text-uppercase text-secondary'>
					MENU CEPAT
				</h4>
			</div>
		</div>
		<div class="row align-items-center">
			<div class="col-3">
				<a href="{{ route('simulasi', ['mode' => 'pa', 'kantor_aktif_id' => $kantor_aktif_id]) }}" class="card-link text-style" style="color:#fff">
					<div class="block_menu">
						<i class="d-block fa fa-calculator fa-2x" style="padding-bottom:5px;"></i>
						SIMULASI<br/>KREDIT PA
					</div>
				</a>
			</div>
			<div class="col-3">
				<a href="{{ route('simulasi', ['mode' => 'pt', 'kantor_aktif_id' => $kantor_aktif_id]) }}" class="card-link text-style" style="color:#fff">
					<div class="block_menu">
						<i class="d-block fa fa-calculator fa-2x" style="padding-bottom:5px;"></i>
						SIMULASI<br/>KREDIT PT
					</div>
				</a>
			</div>
		</div>
		<div class="clearfix">&nbsp;</div>
		<div class="clearfix">&nbsp;</div>
		<div class="clearfix">&nbsp;</div>
		
		<div class="row">
			<div class="col">
				<h4 class='mb-4 text-style text-uppercase text-secondary'>
					PENGAJUAN KREDIT
				</h4>
			</div>
		</div>
		<div class="row align-items-center">
			<div class="col">
				@if(in_array('permohonan', $scopes['scopes']) || in_array('operasional', $scopes['scopes']))
					<a href="{{ route('pengajuan.permohonan.index', ['status' => 'permohonan', 'kantor_aktif_id' => $kantor_aktif_id]) }}" class="card-link text-style" style="color:#fff">
						<div class="progress_menu">
							<i class="d-block fa fa-file-o fa-2x" style="padding-bottom:5px;padding-top:10px;"></i>
							PERMOHONAN
						</div>
					</a>
				@else
					<div class="progress_menu_disabled">
						<i class="d-block fa fa-file-o fa-2x" style="padding-bottom:5px;padding-top:10px;"></i>
						PERMOHONAN
					</div>
				@endif
			</div>
			<div class="col">
				@if(in_array('survei', $scopes['scopes']) || in_array('operasional', $scopes['scopes']))
					<a href="{{ route('pengajuan.survei.index', ['status' => 'survei', 'kantor_aktif_id' => $kantor_aktif_id]) }}" class="card-link text-style" style="color:#fff">
						<div class="progress_menu">
							<i class="d-block fa fa-file-o fa-2x" style="padding-bottom:5px;padding-top:10px;"></i>
							SURVEI
						</div>
					</a>
				@else
					<div class="progress_menu_disabled">
						<i class="d-block fa fa-file-o fa-2x" style="padding-bottom:5px;padding-top:10px;"></i>
						SURVEI
					</div>
				@endif
			</div>
			<div class="col">
				@if(in_array('analisa', $scopes['scopes']) || in_array('operasional', $scopes['scopes']))
					<a href="{{ route('pengajuan.analisa.index', ['status' => 'analisa', 'kantor_aktif_id' => $kantor_aktif_id]) }}" class="card-link text-style" style="color:#fff">
						<div class="progress_menu">
							<i class="d-block fa fa-file-o fa-2x" style="padding-bottom:5px;padding-top:10px;"></i>
							ANALISA
						</div>
					</a>
				@else
					<div class="progress_menu_disabled">
						<i class="d-block fa fa-file-o fa-2x" style="padding-bottom:5px;padding-top:10px;"></i>
						ANALISA
					</div>
				@endif
			</div>
			<div class="col">
				@if(in_array('analisa', $scopes['scopes']) || in_array('operasional', $scopes['scopes']))
					<a href="{{ route('pengajuan.putusan.index', ['status' => 'putusan', 'kantor_aktif_id' => $kantor_aktif_id]) }}" class="card-link text-style" style="color:#fff">
						<div class="progress_menu">
							<i class="d-block fa fa-file-o fa-2x" style="padding-bottom:5px;padding-top:10px;"></i>
							KEPUTUSAN
						</div>
					</a>
				@else
					<div class="progress_menu_disabled">
						<i class="d-block fa fa-file-o fa-2x" style="padding-bottom:5px;padding-top:10px;"></i>
						KEPUTUSAN
					</div>
				@endif
			</div>
		</div><!-- 
		<div class="clearfix">&nbsp;</div>
		<div class="clearfix">&nbsp;</div>
		<div class="clearfix">&nbsp;</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="row">
					<div class="col">
						<h4 class='mb-4 text-style text-uppercase text-secondary'>
							KEPUTUSAN KREDIT
						</h4>
					</div>
				</div>
				<div class="row align-items-center">
					<div class="col-6">
						@if(in_array('keputusan', $scopes['scopes']))
							<a href="{{ route('pengajuan.permohonan.index', ['status' => 'setuju', 'kantor_aktif_id' => $kantor_aktif_id]) }}" class="card-link text-style" style="color:#fff">
								<div class="progress_menu">
									<i class="d-block fa fa-check fa-2x" style="padding-bottom:5px;"></i>
									SETUJU
								</div>
							</a>
						@else
							<div class="progress_menu_disabled">
								<i class="d-block fa fa-check fa-2x" style="padding-bottom:5px;"></i>
								SETUJU
							</div>
						@endif
					</div>
					<div class="col-6">
						@if(in_array('keputusan', $scopes['scopes']))
							<a href="{{ route('pengajuan.permohonan.index', ['status' => 'tolak', 'kantor_aktif_id' => $kantor_aktif_id]) }}" class="card-link text-style" style="color:#fff">
								<div class="progress_menu">
									<i class="d-block fa fa-times fa-2x" style="padding-bottom:5px;"></i>
									TOLAK
								</div>
							</a>
						@else
							<div class="progress_menu_disabled">
								<i class="d-block fa fa-times fa-2x" style="padding-bottom:5px;"></i>
								TOLAK
							</div>
						@endif
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="row">
					<div class="col">
						<h4 class='mb-4 text-style text-uppercase text-secondary'>
							PERSETUJUAN KREDIT
						</h4>
					</div>
				</div>
				<div class="row align-items-start">
					<div class="col-6">
						@if(in_array('realisasi', $scopes['scopes']))
							<a href="{{ route('pengajuan.permohonan.index', ['status' => 'realisasi', 'kantor_aktif_id' => $kantor_aktif_id]) }}" class="card-link text-style" style="color:#fff">
								<div class="progress_menu">
									<i class="d-block fa fa-edit fa-2x" style="padding-bottom:5px;"></i>
									REALISASI
								</div>
							</a>
						@else
							<div class="progress_menu_disabled">
								<i class="d-block fa fa-edit fa-2x" style="padding-bottom:5px;"></i>
								REALISASI
							</div>
						@endif
					</div>
					<div class="col-6">
						@if(in_array('realisasi', $scopes['scopes']))
							<a href="{{ route('pengajuan.permohonan.index', ['status' => 'expired', 'kantor_aktif_id' => $kantor_aktif_id]) }}" class="card-link text-style" style="color:#fff">
								<div class="progress_menu">
									<i class="d-block fa fa-exclamation fa-2x" style="padding-bottom:5px;"></i>
									EXPIRED
								</div>
							</a>
						@else
							<div class="progress_menu_disabled">
								<i class="d-block fa fa-exclamation fa-2x" style="padding-bottom:5px;"></i>
								EXPIRED
							</div>
						@endif
					</div>
				</div>
			</div>
		</div> -->
	</div>

	@if($is_holder)
	<div class="container bg-white p-4 bg-shadow">
		<div class="row">
			<div class="col">
				<h4 class='mb-4 text-style text-uppercase text-secondary'>
					Manajemen Kantor
				</h4>
			</div>
		</div>

		<div class="row align-items-center" style="color:#fff">
			<!-- <div class="col">
				@if(in_array('kantor', $holder_scopes['scopes']))
					<a href="{{ route('manajemen.kantor.create', ['kantor_aktif_id' => $kantor_aktif['id']]) }}" class="card-link text-style">
						<div class="block_menu">
							<i class="d-block fa fa-building-o fa-2x" style="padding-top:10px;padding-bottom:5px;"></i>
							KANTOR BARU
						</div>
					</a>
				@else
					<div class="block_menu_disabled">
						<i class="d-block fa fa-building-o fa-2x" style="padding-top:10px;padding-bottom:5px;"></i>
						KANTOR BARU
					</div>
				@endif
			</div> -->
			<div class="col-sm-3">
				@if(in_array('kantor', $holder_scopes['scopes']))
					<a href="{{ route('manajemen.kantor.index', ['kantor_aktif_id' => $kantor_aktif['id']]) }}" class="card-link text-style" style="color:#fff">
						<div class="block_menu">
							<i class="d-block fa fa-building fa-2x" style="padding-top:10px;padding-bottom:5px;"></i>
							SEMUA KANTOR
						</div>
					</a>
				@else
					<div class="block_menu_disabled">
						<i class="d-block fa fa-building fa-2x" style="padding-top:10px;padding-bottom:5px;"></i>
						SEMUA KANTOR
					</div>
				@endif
			</div>
			<!-- <div class="col">
				@if(in_array('karyawan', $holder_scopes['scopes']))
					<a href="{{ route('manajemen.karyawan.create', ['kantor_aktif_id' => $kantor_aktif['id']]) }}" class="card-link text-style">
						<div class="block_menu">
							<i class="d-block fa fa-user-o fa-2x" style="padding-top:10px;padding-bottom:5px;"></i>
							KARYAWAN BARU
						</div>
					</a>
				@else
					<div class="block_menu_disabled">
						<i class="d-block fa fa-user-o fa-2x" style="padding-top:10px;padding-bottom:5px;"></i>
						KARYAWAN BARU
					</div>
				@endif
			</div> -->
			<div class="col-sm-3">
				@if(in_array('karyawan', $holder_scopes['scopes']))
					<a href="{{ route('manajemen.karyawan.index', ['kantor_aktif_id' => $kantor_aktif['id']]) }}" class="card-link text-style" style="color:#fff">
						<div class="block_menu">
							<i class="d-block fa fa-users fa-2x" style="padding-top:10px;padding-bottom:5px;"></i>
							SEMUA KARYAWAN
						</div>
					</a>
				@else
					<div class="block_menu_disabled">
						<i class="d-block fa fa-users fa-2x" style="padding-top:10px;padding-bottom:5px;"></i>
						SEMUA KARYAWAN
					</div>
				@endif
			</div>
		</div>
	</div>
	@endif
@endpush