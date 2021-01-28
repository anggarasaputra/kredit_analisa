@push('main')
	<div class="container bg-white bg-shadow p-4">
		<div class="row">
			<div class="col">
				<h4 class='mb-4 text-style text-secondary'>
					<span class="text-uppercase">Daftar Kantor</span> 
					<small><small>@if($kantor->currentPage() > 1) Halaman {{$kantor->currentPage()}} @endif</small></small>
				</h4>
				<div class="row">
					<div class="col-5">
						<a href="{{ route('manajemen.kantor.create', ['kantor_aktif_id' => $kantor_aktif['id']]) }}" class="btn btn-primary text-capitalize text-style mb-2">kantor baru</a>
					</div>
					<div class="col-4">
						<form action="{{route('manajemen.kantor.index', array_merge(request()->all(), ['status' => $status]))}}" method="GET">
							 <div class="input-group">
							 	@foreach(request()->all() as $k => $v)
							 		@if(!str_is($k, 'q'))
								 		<input type="hidden" name="{{$k}}" value="{{$v}}">
							 		@endif
							 	@endforeach
								<input type="text" name="q" class="form-control" placeholder="cari nama atau kode kantor" value="{{request()->get('q')}}">
								<span class="input-group-btn">
									<button class="btn btn-secondary" type="submit" style="background-color:#fff;color:#aaa;border-color:#ccc">Go!</button>
								</span>
							</div>
						</form>
					</div>
					<div class="col-3 text-right">
						<div class="input-group">
							<label style="border:0px;padding:7px;">Urut Berdasarkan</label>
							<div class="dropdown">
								<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color:#fff;color:#aaa;border-color:#ccc">
									{{$order}}
								</button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
									<a class="dropdown-item" href="{{route('manajemen.kantor.index', array_merge(request()->all(), ['status' => $status, 'order' => 'nama-asc']))}}">Nama A-Z &nbsp;&nbsp;&nbsp;&nbsp;</a>
									<a class="dropdown-item" href="{{route('manajemen.kantor.index', array_merge(request()->all(), ['status' => $status, 'order' => 'nama-desc']))}}">Nama Z-A &nbsp;&nbsp;&nbsp;&nbsp;</a>
									<!-- <a class="dropdown-item" href="{{route('manajemen.kantor.index', array_merge(request()->all(), ['status' => $status, 'order' => 'tipe-asc']))}}">Tipe A-Z &nbsp;&nbsp;&nbsp;&nbsp;</a>
									<a class="dropdown-item" href="{{route('manajemen.kantor.index', array_merge(request()->all(), ['status' => $status, 'order' => 'tipe-desc']))}}">Tipe Z-A &nbsp;&nbsp;&nbsp;&nbsp;</a> -->
									<!-- <a class="dropdown-item" href="{{route('manajemen.kantor.index', array_merge(request()->all(), ['status' => $status, 'order' => 'date-desc']))}}">Tanggal Z - A</a> -->
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="clearfix">&nbsp;</div>

				<div id="accordion" role="tablist" aria-multiselectable="true">
  					<div class="card" style="border:none;border-radius:0">
						<div class="card-header" role="tab" id="headingOne">
							<div class="row text-left">
								<div class="col-1"><strong>#</strong></div>
								<div class="col-2"><strong>Kode kantor</strong></div>
								<div class="col-2"><strong>Nama</strong></div>
								<div class="col-2"><strong>Tipe</strong></div>
								<div class="col-3"><strong>Alamat</strong></div>
								<div class="col-2"></div>
							</div>
						</div>
	 				</div>
					@forelse($kantor as $k => $v)
	  					<div class="card" style="background-color:#fff;border:none;border-radius:0">
	    					<div class="card-header" role="tab" id="heading{{$k}}" style="background-color:#fff;border-bottom:1px solid #eee">
	    						<div class="row text-left">
									<div class="col-1">{{(($kantor->currentPage() - 1) * $kantor->perPage()) + $k + 1}}</div>
									<div class="col-2">
										{{$v['id']}} 
									</div>
									<div class="col-2">
										<span class="badge badge-primary">{{$v['jenis']}}</span> 
										{{$v['nama']}}
										<br/><i class="fa fa-phone"></i> {{$v['telepon']}}
									</div>
									<div class="col-2">{{$v['tipe']}}</div>
									<div class="col-3">
										@foreach($v['alamat'] as $k2 => $v2)
											{{$k2}} {{$v2}}
										@endforeach
									</div>
									<div class="col-2">
			    						<div class="row text-center">
											<!-- <div class="col-4">
												<a href="{{ route('manajemen.kantor.show', ['id' => $v['id'], 'kantor_aktif_id' => request()->get('kantor_aktif_id')]) }}"><i class="fa fa-eye"></i></a>
											</div> -->
											@if($v['tipe']!='holding')
											<div class="col-6">
												<a href="#" data-toggle="modal" data-target="#delete" data-url="{{route('manajemen.kantor.destroy', ['id' => $v['id'], 'kantor_aktif_id' => $kantor_aktif['id']])}}"><i class="fa fa-trash"></i></a>
											</div>
											<div class="col-6">
												<a href="{{ route('manajemen.kantor.edit', ['id' => $v['id'], 'kantor_aktif_id' => $kantor_aktif['id']]) }}"><i class="fa fa-pencil"></i></a>
											</div>
											@endif
											<!-- <div class="col-4">
												<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$k}}" aria-expanded="false" aria-controls="collapse{{$k}}"><i class="fa fa-arrow-down"></i></a>
											</div> -->
										</div>
									</div>
								</div>
						    </div>
							<div id="collapse{{$k}}" class="collapse" role="tabpanel" aria-labelledby="heading{{$k}}">
								<div class="card-block" style="border-bottom:1px solid #bbb;padding-bottom:20px;">
									
								</div>
							</div>
						</div>
					@empty
	  					<div class="card" style="background-color:#fff;border:none;border-radius:0">
	    					<div class="card-header" role="tab" id="heading{{$k}}" style="background-color:#fff;border-bottom:1px solid #eee">
	    						<div class="row text-center">
									<div class="col-12"><p>Data tidak tersedia, silahkan pilih Koperasi/BPR lain</p></div>
								</div>
						    </div>
						</div>
  					@endforelse
				</div>

				<div class="clearfix">&nbsp;</div>
				<div class="row">
					<div class="col">
						{{$kantor->appends(request()->all())}}
					</div>
				</div>
			</div>
		</div>
	</div>
@endpush

@push('submenu')
	@include('templates.submenu.submenu')
@endpush

