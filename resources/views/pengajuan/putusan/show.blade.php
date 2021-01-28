@inject('terbilang', 'App\Http\Service\UI\Terbilang')
@push('main')
	<div class="container bg-white bg-shadow p-4">
		<div class="row">
			<div class="col">
				<h4 class='mb-2 text-style text-secondary'>
					<span class="text-uppercase">PUTUSAN KREDIT</span> 
				</h4>
			</div>
		</div>
		<div class="row ml-0 mr-0">
			<div class="col p-0">
				<ol class="breadcrumb" style="border-radius:0;">
					@foreach($breadcrumb as $k => $v)
						@if ($loop->count - 1 == $k)
							<li class="breadcrumb-item active">{{ ucwords($v['title']) }}</li>
						@else
							<li class="breadcrumb-item"><a href="{{ $v['route'] }}">{{ ucwords($v['title']) }}</a></li>
						@endif
					@endforeach
				</ol>
			</div>
		</div>
		<div class="row">
			<div class="col-3">
				@stack('menu_sidebar')
				<div class="card text-left">
					<div class="card-body">
						<h6 class="card-title">PUTUSAN KREDIT</h6>

						<br/>
						<div class="progress">
							<div class="progress-bar" role="progressbar" style="width: {{$percentage}}%" aria-valuenow="{{$percentage}}" aria-valuemin="0" aria-valuemax="100">{{$percentage}}%</div>
						</div>
						<hr/>

						@if(!is_null($putusan['pembuat_keputusan']))
							<h7 class="text-secondary">PIMPINAN</h7>
							<br/>
							<h7>{{$putusan['pembuat_keputusan']['nama']}}</h7>
							<br/>
							<hr/>
						@endif

						<h7 class="text-secondary">NASABAH</h7>
						<ul class="fa-ul mt-1">
							<li class="mb-1"><i class="fa-li fa fa-user mt-1"></i> {{ $permohonan['nasabah']['nama'] }}</li>
							<li class="mb-1"><i class="fa-li fa fa-phone mt-1"></i> {{ $permohonan['nasabah']['telepon'] }}</li>
							<li class="mb-1"><i class="fa-li fa fa-map-marker mt-1"></i> {{ implode(', ', $permohonan['nasabah']['alamat']) }}</li>
						</ul>

						@if(!is_null($putusan['id']) && $permohonan['status_terakhir']['progress']!='sudah' && $percentage==100)
						<hr/>
						<p>Kredit sudah diputuskan</p>
							<a data-toggle="modal" data-target="#ajukan-putusan" data-action="{{route('pengajuan.pengajuan.validasi_putusan', ['id' => $permohonan['id'], 'kantor_aktif_id' => $kantor_aktif['id'], 'status' => 'putusan'])}}" data-desc="Untuk validasi putusan, harap mengisi data berikut" data-title="Validasi Putusan" class="modal_putusan  btn btn-primary btn-sm text-white" style="width: 100%">
								Validasi Putusan
							</a> 
						@endif
					</div>
				</div>
			</div>
			<div class="col">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#overview" role="tab">
							Overview
						</a>
					</li>
					@if($permohonan['status_terakhir']['progress']!='sudah')
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#hasil_survei" role="tab">
							Laporan Survei
						</a>
					</li>
					@endif
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#pernyataan_analis" role="tab">
							Pernyataan Analis
						</a>
					</li>
					@if($permohonan['status_terakhir']['progress']!='sudah')
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#rknasabah" role="tab">
							Riwayat Kredit Nasabah 
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#fputusan" role="tab">
							Putusan Komite Kredit @if(!$checker['putusan']) <span class="text-danger">&nbsp;<i class="fa fa-exclamation"></i></span> @endif
						</a>
					</li>
					@else
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#putusan" role="tab">
							Putusan Komite Kredit 
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#fputusan" role="tab">
							Checklists <!-- @if(!$checker['checklists']) <span class="text-danger">&nbsp;<i class="fa fa-exclamation"></i></span> @endif -->
						</a>
					</li>
					@endif
				</ul>
				
				<!-- Tab panes -->
				<div class="tab-content">
					<div class="tab-pane active" id="overview" role="tabpanel">
						@include('pengajuan.analisa.permohonan_kredit')

						<!-- @if(!is_null($putusan['id']) && $permohonan['status_terakhir']['progress']!='sudah')
							<div class="row">
								<div class="col-sm-12 text-right">
									Kredit sudah diputuskan.
									<a data-toggle="modal" data-target="#ajukan-putusan" data-action="{{route('pengajuan.pengajuan.validasi_putusan', ['id' => $permohonan['id'], 'kantor_aktif_id' => $kantor_aktif['id'], 'status' => 'putusan'])}}" data-desc="Untuk validasi putusan, harap mengisi data berikut" data-title="Validasi Putusan" class="modal_putusan text-success">
										<i>Validasi Putusan</i>
									</a> 
								</div>
							</div>
						@elseif($permohonan['status_terakhir']['progress']=='sudah' && count($permohonan['putusan']['checklists']))
							<div class="row">
								<div class="col-sm-12 text-right">
									Checklists Sudah Diperiksa.
									<a data-toggle="modal" data-target="#ajukan-putusan" data-action="{{route('pengajuan.pengajuan.assign_putusan', ['id' => $permohonan['id'], 'kantor_aktif_id' => $kantor_aktif['id'], 'status' => 'putusan'])}}" data-title="Validasi Legalitas" data-desc="Untuk validasi legalitas, harap mengisi data berikut" class="modal_putusan text-success">
										<i>Validasi Legalitas</i>
									</a> 
								</div>
							</div>
						@endif -->
						<!-- <div class="row">
							<div class="col-sm-12 text-right">
								<a href="{{route('pengajuan.pengajuan.print', ['id' => $survei['pengajuan_id'], 'mode' => 'permohonan_kredit', 'kantor_aktif_id' => $kantor_aktif['id']])}}" target="__blank">Tampilkan Penuh Layar</a>
							</div>
						</div> -->
					</div>

					@if($permohonan['status_terakhir']['progress']!='sudah')
					<div class="tab-pane" id="hasil_survei" role="tabpanel">
						@include('pengajuan.analisa.survei_report')
						<div class="row">
							<div class="col-sm-12 text-right">
								<a href="{{route('pengajuan.pengajuan.print', ['id' => $survei['pengajuan_id'], 'mode' => 'survei_report', 'kantor_aktif_id' => $kantor_aktif['id']])}}" target="__blank">Tampilkan Penuh Layar</a>
							</div>
						</div>
					</div>
					@endif
					<div class="tab-pane" id="pernyataan_analis" role="tabpanel">
						@include('pengajuan.analisa.pernyataan_analis')
						<div class="clearfix">&nbsp;</div>
						<div class="clearfix">&nbsp;</div>
						<div class="row">
							<div class="col-sm-12 text-right">
								<a href="{{route('pengajuan.pengajuan.print', ['id' => $survei['pengajuan_id'], 'mode' => 'pernyataan_analis', 'kantor_aktif_id' => $kantor_aktif['id']])}}" target="__blank">Tampilkan Penuh Layar</a>
							</div>
						</div>
					</div>

					@if($permohonan['status_terakhir']['progress']!='sudah')
					<div class="tab-pane" id="rknasabah" role="tabpanel">
						<div class="clearfix">&nbsp;</div>
						<div class="row">
							<div class="col-sm-12">
								<table class="table table-sm table-bordered" style="">
									<thead class="thead-default">
										<tr>
											<th style="border:1px #aaa solid" class="text-center">#</th>
											<th style="border:1px #aaa solid" class="text-center">Tanggal Pengajuan</th>
											<th style="border:1px #aaa solid" class="text-center">Pokok Pinjaman</th>
											<th style="border:1px #aaa solid" class="text-center">Status Terakhir</th>
										</tr>
									</thead> 
									<tbody>
										@forelse ($r_nasabah as $k => $v)
										<tr>
											<td style="border:1px #aaa solid" class="text-center">{{ $v['id'] }}</td>
											<td style="border:1px #aaa solid" class="text-center">{{ $v['status_permohonan']['tanggal'] }}</td>
											<td style="border:1px #aaa solid" class="text-center">{{ $v['pokok_pinjaman'] }}</td>
											<td style="border:1px #aaa solid" class="text-center">{{ $v['status_terakhir']['status'] }}</td>
										</tr>
										@empty
											<tr>
												<td style="border:1px #aaa solid" colspan="4" class="text-center"><i class="text-secondary">tidak ada data</i></td>
											</tr>
										@endforelse
									</tbody>
								</table>
							</div>
						</div>
					</div>
					@else
					<div class="tab-pane" id="putusan" role="tabpanel">
						@include('pengajuan.analisa.persetujuan_komite')
						<div class="clearfix">&nbsp;</div>
						<div class="clearfix">&nbsp;</div>
						<div class="row">
							<div class="col-sm-12 text-right">
								<a href="{{route('pengajuan.pengajuan.print', ['id' => $survei['pengajuan_id'], 'mode' => 'persetujuan_komite', 'kantor_aktif_id' => $kantor_aktif['id']])}}" target="__blank">Tampilkan Penuh Layar</a>
							</div>
						</div>
					</div>
					@endif
					<div class="tab-pane" id="fputusan" role="tabpanel">
						<div class="clearfix">&nbsp;</div>
						<div class="clearfix">&nbsp;</div>
						@if($permohonan['status_terakhir']['status']=='setuju' && $permohonan['status_terakhir']['progress']=='sudah')
							@include('pengajuan.putusan.form_checklists')
						@elseif($permohonan['status_terakhir']['status']=='putusan')
							@include('pengajuan.putusan.form_putusan')
						@else
							<p><i>Kredit Ditolak</i></p>
						@endif
					</div>
				</div>
			</div>
		</div>
		<div class="clearfix">&nbsp;</div>
	</div>
	@include('pengajuan.ajax.modal_putusan')
@endpush

@push('submenu')
	@include('templates.submenu.submenu')
@endpush

@push('css')
@endpush
@push ('js')
	<script type="text/javascript">
		$("a.modal_putusan").on("click", gantiCaption);

		function gantiCaption(){
			$('.modal-title').text($(this).attr("data-title"));
			$('.modal-body').find('p:first').text($(this).attr("data-desc"));
		}
	</script>
@endpush