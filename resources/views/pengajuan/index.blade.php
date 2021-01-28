@push('main')
	<div class="container bg-white bg-shadow p-4">
		<div class="row">
			<div class="col">
				<h4 class='mb-4 text-style text-secondary'>
					<span class="text-uppercase">Daftar {{ ($status) }} Kredit</span> 
					<small><small>@if($pengajuan->currentPage() > 1) Halaman {{$pengajuan->currentPage()}} @endif</small></small>
				</h4>
				<div class="row">
					<div class="col-5">
					@if(str_is($status, 'permohonan'))
						<a href="{{ route('pengajuan.permohonan.create', ['kantor_aktif_id' => $kantor_aktif_id]) }}" class="btn btn-outline-primary text-capitalize text-style mb-2">pengajuan baru</a>
					@endif
					</div>
					<div class="col-4">
						<form action="{{route('pengajuan.'.$status.'.index', array_merge(request()->all(), ['status' => $status]))}}" method="GET">
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
									<a class="dropdown-item" href="{{route('pengajuan.'.$status.'.index', array_merge(request()->all(), ['status' => $status, 'order' => 'date-asc']))}}">Tanggal terbaru &nbsp;&nbsp;&nbsp;&nbsp;</a>
									<a class="dropdown-item" href="{{route('pengajuan.'.$status.'.index', array_merge(request()->all(), ['status' => $status, 'order' => 'date-desc']))}}">Tanggal terlama &nbsp;&nbsp;&nbsp;&nbsp;</a>
									<!-- <a class="dropdown-item" href="{{route('pengajuan.'.$status.'.index', array_merge(request()->all(), ['status' => $status, 'order' => 'date-desc']))}}">Tanggal Z - A</a> -->
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
								<div class="col-3"><strong>No. Pengajuan</strong></div>
								<div class="col-2"><strong>Tgl Pengajuan</strong></div>
								<div class="col-2"><strong>Jumlah Pinjaman</strong></div>
								<div class="col-2"><strong>Nasabah</strong></div>
								<div class="col-2"></div>
							</div>
						</div>
	 				</div>
					@forelse($pengajuan as $k => $v)
	  					<div class="card" style="background-color:#fff;border:none;border-radius:0">
	    					<div class="card-header" role="tab" id="heading{{$k}}" style="background-color:#fff;border-bottom:1px solid #eee">
	    						<div class="row text-left">
									<div class="col-1">{{ (($pengajuan->currentPage() - 1) * $pengajuan->perPage()) + $loop->iteration }}</div>
									<div class="col-3">
			    						<a href="{{ route('pengajuan.'.$status.'.show', ['id' => $v['id'], 'kantor_aktif_id' => request()->get('kantor_aktif_id'), 'status' => $status]) }}">
											{{ $v['id'] }} 
										</a>
										@if ($v['is_mobile']) 
											<span class="badge badge-primary"><small>Mobile</small></span> 
										@endif
									</div>
									<div class="col-2">{{ $v['status_permohonan']['tanggal'] }}</div>
									<div class="col-2">{{ $v['pokok_pinjaman'] }}</div>
									<div class="col-2">
										{{ $v['nasabah']['nama'] }}
									</div>
									<div class="col-2">
			    						<div class="row text-right">
											<!-- <div class="col-4">
												<a href="{{ route('pengajuan.'.$status.'.show', ['id' => $v['id'], 'kantor_aktif_id' => request()->get('kantor_aktif_id'), 'status' => $status]) }}"><i class="fa fa-eye"></i></a>
											</div> -->
											<!-- <div class="col-4">
												@if(str_is($status, 'permohonan'))
													<a href="#" data-toggle="modal" data-target="#delete" data-url="{{route('pengajuan.'.$status.'.destroy', ['id' => $v['id'], 'status' => $status, 'kantor_aktif_id' => $kantor_aktif['id']])}}"><i class="fa fa-trash"></i></a>
												@else
												<span class="text-muted">
													<i class="fa fa-trash"></i>
												</span>
												@endif
											</div> -->
											<div class="col-12">
												<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $loop->index }}" aria-expanded="false" aria-controls="collapse{{ $loop->index }}"><i class="fa fa-chevron-down"></i></a>
											</div>
										</div>
									</div>
								</div>
						    </div>
							<div id="collapse{{ $loop->index }}" class="collapse" role="tabpanel" aria-labelledby="heading{{ $loop->index }}">
								<div class="card-block" style="border-bottom:1px solid #bbb;padding-bottom:20px;">
									<div class="row">
										<div class="col-1">
										</div>
										<div class="col-10">
											<div class="row" style="padding-top:20px;">
												<div class="col-12 text-right">
													<p>
														<i>
															@if(str_is($v['status_terakhir']['progress'], 'perlu'))
																menunggu {{$v['status_terakhir']['status']}}
															@elseif(str_is($v['status_terakhir']['progress'], 'sedang'))
																dalam proses {{$v['status_terakhir']['status']}}
															@elseif(str_is($v['status_terakhir']['progress'], 'sudah'))
																selesai proses {{$v['status_terakhir']['status']}}
															@endif
														</i>
													</p>
												</div>
											</div>
											@if(!count($v['putusan']['checklists']))
											<div class="row" style="padding-top:20px;">
												<div class="col-6 text-left">
													<p>Jaminan :</p>
												</div>
												<div class="col-6 text-right">
													<p><i class="fa fa-mobile"></i> {{$v['nasabah']['telepon']}}</p>
												</div>
											</div>

											@include ('pengajuan.permohonan.jaminan_kendaraan.components.table', ['jaminan_kendaraan' => $v['jaminan_kendaraan']])

											@include ('pengajuan.permohonan.jaminan_tanah_bangunan.components.table', ['jaminan_tanah_bangunan' => $v['jaminan_tanah_bangunan']])
											@else
											<div class="row">
												<!-- <div class="col-6">
													<h7 class="text-secondary">CETAK IDENTITAS NASABAH DAN JAMINAN KREDIT</h7>
													<br/>
													@foreach($v['putusan']['checklists']['objek'] as $kc => $vc)
														@if($vc=='ada')
														<a href="{{route('pengajuan.pengajuan.print', ['id' => $v['id'], 'mode' => $kc, 'kantor_aktif_id' => $kantor_aktif['id']])}}" target="__blank" style="width:100%" class="text-success">
															{{strtoupper(str_replace('_', ' ', $kc))}}
														</a><br/>
														@endif
													@endforeach
												</div> -->
												<div class="col-12">
													<h7 class="text-secondary">CETAK DOKUMEN PENGIKAT KREDIT</h7>
												</div>
											</div>
											<div class="row">
												@foreach($v['putusan']['checklists']['pengikat'] as $kc => $vc)
													@if($vc=='ada')
														<div class="col-6">
															<a href="{{route('pengajuan.pengajuan.print', ['id' => $v['id'], 'mode' => $kc, 'kantor_aktif_id' => $kantor_aktif['id']])}}" target="__blank" style="width:100%" class="text-success">
															{{strtoupper(str_replace('_', ' ', $kc))}}
															</a><br/>
														</div>
													@endif
												@endforeach
											</div>
											@endif
										</div>
									</div>
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
						{{$pengajuan->appends(request()->all())}}
					</div>
				</div>
			</div>
		</div>
	</div>
@endpush

@push('submenu')
	@include('templates.submenu.submenu')
@endpush

@push ('js')
@endpush