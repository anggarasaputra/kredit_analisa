@push('main')
	<div class="container bg-white bg-shadow p-4">
		<div class="row">
			<div class="col">
				<h4 class='mb-4 text-style text-secondary'>
					<span class="text-uppercase">Daftar Karyawan</span> 
					<small><small>@if($orang->currentPage() > 1) Halaman {{$orang->currentPage()}} @endif</small></small>
				</h4>
				<div class="row">
					<div class="col-5">
						<a href="{{ route('manajemen.karyawan.create', ['kantor_aktif_id' => $kantor_aktif['id']]) }}" class="btn btn-primary text-capitalize text-style mb-2">Karyawan baru</a>
					</div>
					<div class="col-4">
						<form action="{{route('manajemen.karyawan.index', array_merge(request()->all(), ['status' => $status]))}}" method="GET">
							 <div class="input-group">
							 	@foreach(request()->all() as $k => $v)
							 		@if(!str_is($k, 'q'))
								 		<input type="hidden" name="{{$k}}" value="{{$v}}">
							 		@endif
							 	@endforeach
								<input type="text" name="q" class="form-control" placeholder="cari nama atau nip karyawan" value="{{request()->get('q')}}">
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
									<a class="dropdown-item" href="{{route('manajemen.karyawan.index', array_merge(request()->all(), ['status' => $status, 'order' => 'nama-asc']))}}">Nama A-Z &nbsp;&nbsp;&nbsp;&nbsp;</a>
									<a class="dropdown-item" href="{{route('manajemen.karyawan.index', array_merge(request()->all(), ['status' => $status, 'order' => 'nama-desc']))}}">Nama Z-A &nbsp;&nbsp;&nbsp;&nbsp;</a>
									<!-- <a class="dropdown-item" href="{{route('manajemen.karyawan.index', array_merge(request()->all(), ['status' => $status, 'order' => 'tipe-asc']))}}">Tipe A-Z &nbsp;&nbsp;&nbsp;&nbsp;</a>
									<a class="dropdown-item" href="{{route('manajemen.karyawan.index', array_merge(request()->all(), ['status' => $status, 'order' => 'tipe-desc']))}}">Tipe Z-A &nbsp;&nbsp;&nbsp;&nbsp;</a> -->
									<!-- <a class="dropdown-item" href="{{route('manajemen.karyawan.index', array_merge(request()->all(), ['status' => $status, 'order' => 'date-desc']))}}">Tanggal Z - A</a> -->
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
								<div class="col-2"><strong>NIP</strong></div>
								<div class="col-2"><strong>Nama</strong></div>
								<div class="col-2"><strong>Email</strong></div>
								<div class="col-3"><strong>Alamat</strong></div>
								<div class="col-2"></div>
							</div>
						</div>
	 				</div>
					@forelse($orang as $k => $v)
	  					<div class="card" style="background-color:#fff;border:none;border-radius:0">
	    					<div class="card-header" role="tab" id="heading{{$k}}" style="background-color:#fff;border-bottom:1px solid #eee">
	    						<div class="row text-left">
									<div class="col-1">{{(($orang->currentPage() - 1) * $orang->perPage()) + $k + 1}}</div>
									<div class="col-2">
										{{$v['nip']}} 
									</div>
									<div class="col-2">
										{{$v['nama']}}
										<br/><i class="fa fa-phone"></i> {{$v['telepon']}}
									</div>
									<div class="col-2">{{$v['email']}}</div>
									<div class="col-3">
										@foreach($v['alamat'] as $k2 => $v2)
											{{$k2}} {{$v2}}
										@endforeach
									</div>
									<div class="col-2">
			    						<div class="row text-center">
											<!-- <div class="col-4">
												<a href="{{ route('manajemen.karyawan.show', ['id' => $v['id'], 'kantor_aktif_id' => request()->get('kantor_aktif_id')]) }}"><i class="fa fa-eye"></i></a>
											</div> -->
											<div class="col-4">
												<a href="#" data-toggle="modal" data-target="#delete" data-url="{{route('manajemen.karyawan.destroy', ['id' => $v['id'], 'kantor_aktif_id' => $kantor_aktif['id']])}}"><i class="fa fa-trash"></i></a>
											</div>
											<div class="col-4">
												<a href="{{ route('manajemen.karyawan.edit', ['id' => $v['id'], 'kantor_aktif_id' => $kantor_aktif['id']]) }}"><i class="fa fa-pencil"></i></a>
											</div>
											<div class="col-4">
												<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$k}}" aria-expanded="false" aria-controls="collapse{{$k}}"><i class="fa fa-arrow-down"></i></a>
											</div>
										</div>
									</div>
								</div>
						    </div>
							<div id="collapse{{$k}}" class="collapse" role="tabpanel" aria-labelledby="heading{{$k}}">
								<div class="card-block" style="border-bottom:1px solid #bbb;padding-bottom:20px;">
									<div class="row p-5">
										<div class="col">
											<p class="text-secondary text-capitalize mb-1">Penempatan</p>
											<table class="table table-sm table-bordered">
												<thead class="thead-default">
													<tr>
														<th class="text-center">#</th>
														<th class="text-center">Kantor</th>
														<th class="text-center">Jabatan</th>
														<th class="text-center" style="max-width:320px;">Scopes</th>
														<th class="text-center">Masa Kerja</th>
														<th class="text-center">&nbsp;</th>
													</tr>
												</thead> 
												<tbody>
													@forelse($v->penempatan as $k2 => $v2)
													<tr>
														<td class="text-center">{{ ($k2 + 1) }}</td>
														<td class="text-center">{{ ucwords(str_replace('_', ' ', $v2['kantor']['nama'])) }}</td>
														<td class="text-center">{{ ucwords(str_replace('_', ' ', $v2['role'])) }}</td>
														<td class="text-center" style="max-width:320px;">
															@foreach($v2['scopes'] as $k3 => $v3)
																<span class="badge badge-primary"> manage {{$v3}} </span>
															@endforeach
														</td>
														<td class="text-center">{{ $v2['tanggal_masuk'] }} - 
															@if(is_null($v2['tanggal_keluar']))
																<i>sekarang</i>
															@else
																{{ $v2['tanggal_keluar'] }}
															@endif
														</td>
														<td class="text-center">
															<a href="#" data-toggle="modal" class="mutasi_karyawan" data-target="#mutasi" data-action="{{route('manajemen.karyawan.update', ['orang_id' => $v['id'],'penempatan_id' => $v2['id'], 'kantor_aktif_id' => $kantor_aktif['id'], 'mode' => 'mutasi'])}}">
																<i class="fa fa-exchange"></i>
															</a> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
															<a href="#" data-toggle="modal" class="resign_karyawan" data-target="#resign" data-action="{{route('manajemen.karyawan.update', ['orang_id' => $v['id'],'penempatan_id' => $v2['id'], 'kantor_aktif_id' => $kantor_aktif['id'], 'mode' => 'resign'])}}">
																<i class="fa fa-close"></i>
															</a>
														</td>
													</tr>
													@empty
														<tr>
															<td colspan="6" class="text-center"><i class="text-secondary">tidak ada data</i></td>
														</tr>
													@endforelse
													<tr>
														<td colspan="6" class="text-right">
															<a href="#" class="assign_karyawan" data-toggle="modal" data-target="#assign" data-action="{{route('manajemen.karyawan.update', ['orang_id' => $v['id'], 'kantor_aktif_id' => $kantor_aktif['id'], 'mode' => 'assign'])}}">
																Penempatan Baru
															</a>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					@empty
	  					<div class="card" style="background-color:#fff;border:none;border-radius:0">
	    					<div class="card-header" role="tab" id="heading{{$k}}" style="background-color:#fff;border-bottom:1px solid #eee">
	    						<div class="row text-center">
									<div class="col-12"><p>Data tidak tersedia</p></div>
								</div>
						    </div>
						</div>
  					@endforelse
				</div>

				<div class="clearfix">&nbsp;</div>
				<div class="row">
					<div class="col">
						{{$orang->appends(request()->all())}}
					</div>
				</div>
			</div>
		</div>
	</div>

	@component ('bootstrap.modal', ['id' => 'resign', 'form' => true, 'method' => 'patch', 'url' => '#'])
		@slot ('title')
			Resign dari jabatan ini
		@endslot

		@slot ('body')
			<p>Untuk resign jabatan ini, harap mengisi tanggal resign</p>
			<fieldset class="form-group">
				<label class="text-sm">Tanggal Keluar</label>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-10">
						{!! Form::text('tanggal_keluar', Carbon\Carbon::now()->format('d/m/Y H:i'), ['class' => 'form-control required', 'placeholder' => 'Masukkan tanggal keluar']) !!}			
					</div>
				</div>
			</fieldset>
		@endslot

		@slot ('footer')
			<a href="#" data-dismiss="modal" class="btn btn-link text-secondary">Batal</a>
			{!! Form::bsSubmit('Simpan', ['class' => 'btn btn-primary']) !!}
		@endslot
	@endcomponent

	@component ('bootstrap.modal', ['id' => 'mutasi', 'form' => true, 'method' => 'patch', 'url' => '#'])
		@slot ('title')
			Pindah dari jabatan ini
		@endslot

		@slot ('body')
			<p>Untuk pindah jabatan ini, harap mengisi kode kantor yang baru dan tanggal pindah</p>

			<fieldset class="form-group">
				<label class="text-sm">KODE KANTOR</label>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12">
						@include('manajemen.kantor.ajax-kode-pusat', ['kantor' => ['pusat' => $kantor_aktif]])
					</div>
				</div>
			</fieldset>

			<fieldset class="form-group">
				<label class="text-sm">Tanggal pindah</label>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-10">
						{!! Form::text('tanggal_pindah', Carbon\Carbon::now()->format('d/m/Y H:i'), ['class' => 'form-control required', 'placeholder' => 'Masukkan tanggal pindah']) !!}			
					</div>
				</div>
			</fieldset>
		@endslot

		@slot ('footer')
			<a href="#" data-dismiss="modal" class="btn btn-link text-secondary">Batal</a>
			{!! Form::bsSubmit('Simpan', ['class' => 'btn btn-primary']) !!}
		@endslot
	@endcomponent

	@component ('bootstrap.modal', ['id' => 'assign', 'form' => true, 'method' => 'patch', 'url' => '#'])
		@slot ('title')
			Penempatan Baru
		@endslot

		@slot ('body')
			<p>Untuk penempatan baru, harap mengisi form berikut</p>
			<fieldset class="form-group">
				<label class="text-sm">KODE KANTOR</label>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12">
						@include('manajemen.kantor.ajax-kode-pusat', ['kantor' => ['pusat' => $kantor_aktif]])
					</div>
				</div>
			</fieldset>

			<fieldset class="form-group">
				<label class="text-sm">Tanggal Masuk Kerja</label>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12">
						{!! Form::text('kantor[tanggal_masuk]', null, ['class' => 'form-control required mask-date-time', 'placeholder' => 'Masukkan tanggal masuk']) !!}			
					</div>
				</div>
			</fieldset>

			<fieldset class="form-group">
				<label class="text-sm">JABATAN</label>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12">
						<select class="jabatan-select form-control" name="kantor[role]" style="width:100%"></select>
					</div>
				</div>
			</fieldset>

			<fieldset class="form-group">
				<label class="text-sm">WEWENANG</label>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12">
						<select class="scopes-select form-control" name="kantor[scopes][]" multiple="multiple" style="width:100%"></select>	
					</div>
				</div>
			</fieldset>
		@endslot

		@slot ('footer')
			<a href="#" data-dismiss="modal" class="btn btn-link text-secondary">Batal</a>
			{!! Form::bsSubmit('Simpan', ['class' => 'btn btn-primary']) !!}
		@endslot
	@endcomponent
@endpush

@push('submenu')
	@include('templates.submenu.submenu')
@endpush

@push('js')
	<script type="text/javascript">
		//MODAL PARSE DATA ATTRIBUTE//
		$("a.assign_karyawan").on("click", parsingDataAttributeAssign);

		function parsingDataAttributeAssign(){
			$('#assign').find('form').attr('action', $(this).attr("data-action"));
		}

		$("a.resign_karyawan").on("click", parsingDataAttributeResign);

		function parsingDataAttributeResign(){
			$('#resign').find('form').attr('action', $(this).attr("data-action"));
		}

		$("a.mutasi_karyawan").on("click", parsingDataAttributeMutasi);

		function parsingDataAttributeMutasi(){
			$('#mutasi').find('form').attr('action', $(this).attr("data-action"));
		}

   		$(".scopes-select").select2({
			ajax: {
				url: "{{route('scopes.index')}}",
				data: function (params) {
				var jabatan = $('.jabatan-select').select2('data');
						return {
							role: jabatan[0].id // search term
						};
					},
				processResults: function (data, params) {
					return {
						results:  $.map(data, function (scope) {
							return {
								text: 'Manage '+scope,
								id: scope
							}
						})
					};
				},
			}
		});

		$(".jabatan-select").select2({
			tags: true,
			ajax: {
				url: "{{route('jabatan.index')}}",
				data: function (params) {
				var kantor = $('.kode-pusat-kantor').select2('data');
						return {
							// kantor_aktif_id: kantor[0].id // search term
						};
					},
				processResults: function (data, params) {
					return {
						results:  $.map(data, function (jabatan) {
							return {
								text: jabatan.role,
								id: jabatan.role
							}
						})
					};
				},
			}
		});
	</script>
@endpush