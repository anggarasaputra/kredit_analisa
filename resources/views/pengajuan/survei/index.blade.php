@push('main')
	<div class="container-fluid bg-white bg-shadow p-4">
		<div class="row">
			<div class="col">
				<h4 class='mb-4 text-style text-secondary'>
					<span class="text-uppercase">Lokasi Survei</span> 
					<small><small>@if($survei->currentPage() > 1) Halaman {{$survei->currentPage()}} @endif</small></small>
				</h4>
			</div>
		</div>
		<div class="clearfix">&nbsp;</div>
		<div class="row">
			@if(count($kecamatan))
			<div class="col-3">
				<div class="card" style="border-radius:0px">
					<h6 class="card-header">CARI</h6>
					<div class="card-block">
						@php $prev_kota = null @endphp
						@foreach($kecamatan as $k => $v)
							@if($prev_kota != $v['kota'])
								@php $prev_kota = $v['kota'] @endphp
								<div class="row">
									<div class="col-sm-12">
										<p class="pt-3 pl-3"><label><strong>
											@if(!request()->has('kecamatan') && $v['kota']==request()->get('kota'))
											<a href="{{route('pengajuan.survei.index', ['status' => 'survei', 'kantor_aktif_id' => $kantor_aktif['id']])}}">
											@else
											<a href="{{route('pengajuan.survei.index', ['status' => 'survei', 'kantor_aktif_id' => $kantor_aktif['id'], 'kota' => $v['kota']])}}">
											@endif
											{{$v['kota']}}
										</strong></label></p>
									</div>
								</div>
							@endif
							<div class="row">
								<div class="col-sm-1"></div>
								<div class="col-sm-7">
									<p>
									@if($v['kecamatan']==request()->get('kecamatan') && $v['kota']==request()->get('kota'))
									<a href="{{route('pengajuan.survei.index', ['status' => 'survei', 'kantor_aktif_id' => $kantor_aktif['id']])}}">
									<i class="fa fa-check-square-o"></i>
									@elseif(!request()->has('kecamatan') && $v['kota']==request()->get('kota'))
									<a href="{{route('pengajuan.survei.index', ['status' => 'survei', 'kantor_aktif_id' => $kantor_aktif['id'], 'kecamatan' => $v['kecamatan'], 'kota' => $v['kota']])}}">
									<i class="fa fa-check-square-o"></i>
									@else
									<a href="{{route('pengajuan.survei.index', ['status' => 'survei', 'kantor_aktif_id' => $kantor_aktif['id'], 'kecamatan' => $v['kecamatan'], 'kota' => $v['kota']])}}">
									<i class="fa fa-square-o"></i>
									@endif
									&nbsp;{{$v['kecamatan']}} </a> </p>
								</div>
								<div class="col-sm-3 text-right">
									<span class="badge badge-success">{{$v['total']}}</span>
								</div>
								<div class="col-sm-1"></div>
							</div>
						@endforeach
					</div>
				</div>
			</div>
			<div class="col-9">
				<div class="row">
					@foreach($survei as $k => $v)
						<div class="col-sm-4">
							<div class="card" style="border-radius:0px">
								<div class="card-header" style="min-height:70px;">
									<div class="row">
										<div class="col-sm-10">
											<h6 class="text-secondary">{{$v['nama']}}</h6>
											<h7><i class="fa fa-phone"></i>&nbsp;{{$v['telepon']}}</h7><br/>
										</div>
										<div class="col-sm-2">
											@if(!$v['survei']['is_lengkap'])
											<h4 class="text-danger" style="padding-top:5px;"><i class="fa fa-exclamation"></i></h4>
											@endif
										</div>
									</div>
								</div>
								<div class="card-body" style="min-height:175px;max-height:175px">
								<h7 class="badge badge-info">{{$v['agenda']}}</h7>
								<br/>
								<h7>{{$v['alamat']}}</h7>
								</div>
								<div class="card-footer">
									<h7>
										<a href="https://www.google.co.id/maps/search/{{$v['alamat']}}" target="__blank">
											<i class="fa fa-map-marker"></i>&nbsp;Temukan di Google Maps
										</a>
									</h7><br/>
									@if(!$v['survei']['is_lengkap'])
									<h7>
										<a href="{{route('pengajuan.survei.show', ['id' => $v['id'], 'status' => 'survei', 'kantor_aktif_id' => $kantor_aktif['id']])}}">
											<i class="fa fa-edit"></i>&nbsp;Lengkapi Form Survei
										</a>
									</h7>
									@else
									<h7>
										<a data-toggle="modal" data-target="#lanjut-analisa" data-action="{{route('pengajuan.pengajuan.assign_analisa', ['id' => $v['survei']['pengajuan_id'], 'kantor_aktif_id' => $kantor_aktif['id'], 'status' => 'permohonan'])}}" class="modal_analisa text-primary"><i class="fa fa-edit"></i>&nbsp; Lanjutkan Analisa</a>
									</h7>
									@endif
								</div>
							</div>
						<div class="clearfix">&nbsp;</div>
						</div>
					@endforeach
				</div>
				<div class="row text-right">
					<div class="col text-right">
						{{$survei->appends(request()->all())}}
					</div>
				</div>
			</div>
			@else
				<div class="col-sm-12 text-center"><p>Data tidak tersedia, silahkan pilih Koperasi/BPR lain</p></div>
			@endif
		</div>
	</div>
	@include('pengajuan.ajax.modal_analisa')
@endpush

@push('submenu')
	@include('templates.submenu.submenu')
@endpush

@push ('js')
@endpush