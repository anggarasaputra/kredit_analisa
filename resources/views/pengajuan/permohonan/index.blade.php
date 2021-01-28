@push('main')
	<div class="container bg-white bg-shadow p-4">
		<div class="row">
			<div class="col">
				<h4 class='mb-4 text-style text-secondary'>
					<span class="text-uppercase">Daftar {{ ($status) }} Kredit</span> 
					<small><small>@if($pengajuan->currentPage() > 1) Halaman {{$pengajuan->currentPage()}} @endif</small></small>
				</h4>
				<div class="row">
					<div class="col-8">
						<form action="{{route('pengajuan.permohonan.index', array_merge(request()->all(), ['status' => $status]))}}" method="GET">
							 <div class="input-group">
								@foreach(request()->all() as $k => $v)
									@if(!str_is($k, 'q'))
										<input type="hidden" name="{{$k}}" value="{{$v}}">
									@endif
								@endforeach
								<input type="text" name="q" class="form-control" placeholder="cari nama nasabah atau nomor pengajuan" value="{{request()->get('q')}}" style="padding:15px;">
								<span class="input-group-btn">
									<button class="btn btn-secondary" type="submit" style="background-color:#fff;color:#aaa;border-color:#ccc;border-radius:0px;padding:15px">Go!</button>
								</span>
							</div>
						</form>
					</div>
					<div class="col-2 text-right">
						<label style="border:0px;padding:10px;">Urut Berdasarkan</label>
					</div>
					<div class="col-2 text-right">
						<div class="input-group" style="float:right;">
							<div class="dropdown" style="width:100%;">
								<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color:#fff;color:#aaa;border-color:#ccc;border-radius:0px;padding:15px;">
									{{$order}}
								</button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
									<a class="dropdown-item" href="{{route('pengajuan.permohonan.index', array_merge(request()->all(), ['status' => $status, 'order' => 'date-asc']))}}">Tanggal terbaru &nbsp;&nbsp;&nbsp;&nbsp;</a>
									<a class="dropdown-item" href="{{route('pengajuan.permohonan.index', array_merge(request()->all(), ['status' => $status, 'order' => 'date-desc']))}}">Tanggal terlama &nbsp;&nbsp;&nbsp;&nbsp;</a>
									<!-- <a class="dropdown-item" href="{{route('pengajuan.permohonan.index', array_merge(request()->all(), ['status' => $status, 'order' => 'date-desc']))}}">Tanggal Z - A</a> -->
								</div>
							</div>
						</div>
					</div>
					<!-- <div class="col-4 text-right">
						<a href="{{ route('pengajuan.permohonan.create', ['kantor_aktif_id' => $kantor_aktif_id]) }}" class="btn btn-outline-primary text-capitalize text-style mb-2" style="border-radius:0px;">PENGAJUAN BARU</a>
					</div> -->
				</div>
				<div class="clearfix">&nbsp;</div>

				@forelse($pengajuan as $k => $v)
					<div class="card" style="border-radius:0px">
						<div class="card-header">
							<div class="row">
								<div class="col-sm-3">
									<p style="margin:5px;" class="text-secondary">NO.PENGAJUAN</p>
									<p style="margin:5px;">
										{{$v['id']}}
										@if($v['is_mobile'])
											<span class="badge badge-success">mobile</span>
										@endif
									</p>
								</div>
								<div class="col-sm-4">
									<p style="margin:5px;" class="text-secondary">POKOK PINJAMAN</p>
									<p style="margin:5px;">{{$v['pokok_pinjaman']}}</p>
								</div>
								<div class="col-sm-3">
									<p style="margin:5px;" class="text-secondary">TANGGAL PENGAJUAN</p>
									<p style="margin:5px;">{{$v['status_terakhir']['tanggal']}}</p>
								</div>
								<div class="col-sm-2 text-center" style="vertical-align:middle;padding-top:10px;">
									@if(!$v['is_complete'])
									<a href="{{route('pengajuan.permohonan.show', ['id' => $v['id'], 'kantor_aktif_id' => $kantor_aktif['id']])}}"><p style="padding:5px;border:1px solid;"><i class="fa fa-exclamation-triangle text-danger"></i>&nbsp;LIHAT</p></a>
									@else
										<a href="{{route('pengajuan.permohonan.show', ['id' => $v['id'], 'kantor_aktif_id' => $kantor_aktif['id']])}}"><p style="padding:5px;border:1px solid;">LIHAT</p></a>
										<!-- <a href="#"><p style="padding:5px;border:1px solid;">PRINT</p></a> -->
									@endif
								</div>
							</div>
						</div>
						<div class="card-block">
							<div class="row" style="padding:15px">
								<div class="col-sm-3">
									<p style="margin:5px;" class="text-secondary">NASABAH</p>
									<p style="margin:5px;">{{$v['nasabah']['nama']}}</p>
								</div>
								<div class="col-sm-4">
									<p style="margin:5px;" class="text-secondary">JAMINAN</p>
									@php $flag_j = true @endphp
									@foreach($v['jaminan_kendaraan'] as $jk)
										<p style="margin:5px;">{{strtoupper($jk['jenis'])}} Nomor : {{strtoupper($jk['dokumen_jaminan'][$jk['jenis']]['nomor_bpkb'])}}</p>
										@if($jk['dokumen_jaminan'][$jk['jenis']]['is_lama']==false)
											@php $flag_j 	= false @endphp
										@endif
									@endforeach
									@foreach($v['jaminan_tanah_bangunan'] as $jtk)
										<p style="margin:5px;">{{strtoupper($jtk['jenis'])}} Nomor : {{strtoupper($jtk['dokumen_jaminan'][$jtk['jenis']]['nomor_sertifikat'])}}</p>
										@if($jk['dokumen_jaminan'][$jk['jenis']]['is_lama']==false)
											@php $flag_j 	= false @endphp
										@endif
									@endforeach
								</div>
								<div class="col-sm-5">
								
								</div>
							</div>
						</div>
					</div>
					<div class="clearfix">&nbsp;</div>
				@empty
					<div class="card" style="background-color:#fff;border:none;border-radius:0">
						<div class="card-header" role="tab" style="background-color:#fff;border-bottom:1px solid #eee">
							<div class="row text-center">
								<div class="col-12"><p>Data tidak tersedia, silahkan pilih Koperasi/BPR lain</p></div>
							</div>
						</div>
					</div>
				@endforelse

				<div class="clearfix">&nbsp;</div>
				<div class="row">
					<div class="col">
						{{$pengajuan->appends(request()->all())}}
					</div>
				</div>
			</div>
		</div>
	</div>

	@component ('bootstrap.modal', ['id' => 'assign-survei', 'form' => true, 'method' => 'post', 'url' => route('pengajuan.permohonan.assign_survei', ['kantor_aktif_id' => $kantor_aktif['id'], 'status' => 'permohonan'])])
		@slot ('title')
			Assign Survei
		@endslot

		@slot ('body')
			<p>Untuk assign survei, harap melengkapi data berikut!</p>

			<div class="form-group">
				{!! Form::label('', 'SURVEYOR', ['class' => 'text-uppercase mb-1']) !!}
				<select class="ajax-karyawan custom-select form-control required" name="surveyor[nip][]" multiple="multiple" style="width:100%">
					<option value="">Pilih</option>
				</select>
			</div>
			<!-- {!! Form::bsText('Tanggal', 'tanggal', null, ['class' => 'mask-date form-control', 'placeholder' => 'dd/mm/yyyy']) !!} -->
			<!-- {!! Form::bsTextarea('catatan', 'catatan', null, ['class' => 'form-control', 'placeholder' => 'catatan', 'style' => 'resize:none;', 'rows' => 5]) !!} -->
			{!! Form::bsPassword('password', 'password', ['placeholder' => 'Password']) !!}
		@endslot

		@slot ('footer')
			<a href="#" data-dismiss="modal" class="btn btn-link text-secondary">Batal</a>
			{!! Form::bsSubmit('Simpan', ['class' => 'btn btn-primary']) !!}
		@endslot
	@endcomponent

	@include('pengajuan.ajax.modal_analisa')

@endpush

@push('submenu')
	@include('templates.submenu.submenu')
@endpush

@push ('js')	
	<script type="text/javascript">
	//SELECT2 UNTUK SURVEYOR//

	$(".ajax-karyawan").select2({
		ajax: {
			url: "{{route('manajemen.karyawan.ajax')}}",
			data: function (params) {
					return {
						q: params.term, // search term
						kantor_aktif_id: "{{$kantor_aktif['id']}}", // search term
						scope: 'survei'
					};
				},
			processResults: function (data, params) {
				return {
					results:  $.map(data, function (karyawan) {
						return {
							text: karyawan.orang.nama,
							id: karyawan.orang.nip
						}
					})
				};
			},
		}
	});
	
	//MODAL PARSE DATA ATTRIBUTE//
	$("a.modal_assign").on("click", parsingDataAttributeModalAssign);

	function parsingDataAttributeModalAssign(){
		$('#assign-survei').find('form').attr('action', $(this).attr("data-action"));
	}
	</script>

@endpush