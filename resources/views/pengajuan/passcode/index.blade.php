@push('main')
	<div class="container bg-white bg-shadow p-4">
		<div class="row">
			<div class="col">
				<h4 class='mb-4 text-style text-secondary'>
					<span class="text-uppercase">PASSCODE</span> 
					<small><small>@if($passcode->currentPage() > 1) Halaman {{$passcode->currentPage()}} @endif</small></small>
				</h4>
				<div class="row">
					<div class="col-5">
						<a href="#" data-toggle="modal" data-target="#passcode_baru" data-action="{{route('pengajuan.passcode.store', ['kantor_aktif_id' => $kantor_aktif['id']])}}" class="modal_passcode btn btn-outline-primary text-capitalize text-style mb-2">passcode baru</a>
					</div>
					<div class="col-4">
						<form action="{{route('pengajuan.passcode.index', array_merge(request()->all(), ['status' => $status]))}}" method="GET">
							 <div class="input-group">
							 	@foreach(request()->all() as $k => $v)
							 		@if(!str_is($k, 'q'))
								 		<input type="hidden" name="{{$k}}" value="{{$v}}">
							 		@endif
							 	@endforeach
								<input type="text" name="q" class="form-control" placeholder="cari nama nasabah atau nomor pengajuan" value="{{request()->get('q')}}">
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
									<a class="dropdown-item" href="{{route('pengajuan.passcode.index', array_merge(request()->all(), ['status' => $status, 'order' => 'date-asc']))}}">Tanggal terbaru &nbsp;&nbsp;&nbsp;&nbsp;</a>
									<a class="dropdown-item" href="{{route('pengajuan.passcode.index', array_merge(request()->all(), ['status' => $status, 'order' => 'date-desc']))}}">Tanggal terlama &nbsp;&nbsp;&nbsp;&nbsp;</a>
									<!-- <a class="dropdown-item" href="{{route('pengajuan.passcode.index', array_merge(request()->all(), ['status' => $status, 'order' => 'date-desc']))}}">Tanggal Z - A</a> -->
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="clearfix">&nbsp;</div>

				<table class="table table-border">
					<thead>
						<tr>
							<th>#</th>
							<th>Kredit</th>
							<th>Passcode</th>
							<th>Expired</th>
						</tr>
					</thead>
					<tbody>
						@foreach($passcode as $k => $v)
						<tr>
							<td>{{ (($passcode->currentPage() - 1) * $passcode->perPage()) + $loop->iteration }}</td>
							<td>
								{{$v['survei']['pengajuan']['id']}} <br/>
								{{$v['survei']['pengajuan']['nasabah']['nama']}}
							</td>
							<td>{{$v['passcode']}}</td>
							<td>{{$v['expired_at']}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>

				<div class="clearfix">&nbsp;</div>
				<div class="row">
					<div class="col">
						{{$passcode->appends(request()->all())}}
					</div>
				</div>
			</div>
		</div>
	</div>

	@include('pengajuan.passcode.modal_passcode')
@endpush

@push('submenu')
	@include('templates.submenu.submenu')
@endpush

@push ('js')
@endpush