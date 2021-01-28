@push('main')
	<div class="container-fluid bg-white bg-shadow p-4">
		<div class="row">
			<div class="col">
				<h4 class='mb-2 text-style text-secondary'>
					<span class="text-uppercase">{{$title}}</span> 
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
						<h6 class="card-title">PERMOHONAN KREDIT</h6>

						<br/>
						<div class="progress">
							<div class="progress-bar" role="progressbar" style="width: {{$percentage}}%" aria-valuenow="{{$percentage}}" aria-valuemin="0" aria-valuemax="100">{{$percentage}}%</div>
						</div>
						<hr/>

						@if(!is_null($permohonan['ao']))
							<h7 class="text-secondary">AO</h7>
							<br/>
							<h7>{{$permohonan['ao']['nama']}}</h7>
							<br/>
							<hr/>
						@endif

						
						@if(!is_null($permohonan['dokumen_pelengkap']['tanda_tangan']))
							<h7 class="text-secondary">SPESIMEN TTD</h7>
							<br/>
							<img src="{{$permohonan['dokumen_pelengkap']['tanda_tangan']}}" class="img-fluid" alt="Foto KTP">
							<hr/>
						@endif

						<p>Form Pengajuan</p>
						<a href="{{route('pengajuan.pengajuan.print', ['id' => $permohonan['id'], 'mode' => 'permohonan_kredit', 'kantor_aktif_id' => $kantor_aktif['id']])}}" target="__blank" style="width:100%" class="btn btn-primary btn-sm">
							Print
						</a>

						@if($percentage==100)
							<hr/>
							<p>Data Sudah Lengkap</p>
							<a data-toggle="modal" data-target="#assign-survei" data-action="{{route('pengajuan.permohonan.assign_survei', ['id' => $permohonan['id'], 'kantor_aktif_id' => $kantor_aktif['id'], 'status' => 'permohonan'])}}" class="modal_assign btn btn-primary btn-sm text-white" style="width:100%">Assign Untuk Survei</a>
						@endif

						@if($percentage==100 && $v['nasabah']['is_lama'] && $flag_jam)
							<hr/>
							<p>Nasabah & Jaminan Lama</p>
							<a data-toggle="modal" data-target="#lanjut-analisa" data-action="{{route('pengajuan.pengajuan.assign_analisa', ['id' => $survei['pengajuan_id'], 'kantor_aktif_id' => $kantor_aktif['id'], 'status' => 'permohonan'])}}" class="modal_analisa btn btn-primary btn-sm text-white" style="width:100%">Lanjutkan Analisa</a>
						@endif
					</div>
				</div>
			</div>
			<div class="col">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#kredit" role="tab">
							Kredit @if(!$checker['kredit']) <span class="text-danger">&nbsp;<i class="fa fa-exclamation"></i></span> @endif
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#nasabah" role="tab">
							Nasabah @if(!$checker['nasabah']) <span class="text-danger">&nbsp;<i class="fa fa-exclamation"></i></span> @endif
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#keluarga" role="tab">
							Data Keluarga @if(!$checker['keluarga']) <span class="text-danger">&nbsp;<i class="fa fa-exclamation"></i></span> @endif
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#jaminan" role="tab">
							Jaminan @if(!$checker['jaminan']) <span class="text-danger">&nbsp;<i class="fa fa-exclamation"></i></span> @endif
						</a>
					</li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content">
					<!-- tab kredit -->
					<div class="tab-pane active" id="kredit" role="tabpanel">
						<div class="clearfix">&nbsp;</div>
						<p class="text-right text-secondary"><i>*klik untuk mengubah data</i></p>
						@if(is_null($permohonan['id']))
							{!! Form::open(['url' => route('pengajuan.permohonan.store', ['id' => $permohonan['id'], 'kantor_aktif_id' => $kantor_aktif_id])]) !!}
						@else
							{!! Form::open(['url' => route('pengajuan.permohonan.update', ['id' => $permohonan['id'], 'kantor_aktif_id' => $kantor_aktif_id]), 'method' => 'PATCH']) !!}
						@endif
						
						<div class="row">
							<div class="col">
								{!! Form::vText('Pokok Pinjaman', 'pokok_pinjaman', $permohonan['pokok_pinjaman'], ['class' => 'form-control mask-money inline-edit border-input w-25 text-info pb-1', 'placeholder' => 'pokok pinjaman'], true, 'Min. Rp. 2.500.000') !!}
							</div>
						</div>
						<div class="row">
							<div class="col">
								{!! Form::vText('Kemampuan Angsur', 'kemampuan_angsur', $permohonan['kemampuan_angsur'], ['class' => 'form-control mask-money inline-edit border-input w-25 text-info pb-1', 'placeholder' => 'kemampuan angsur'], true) !!}
							</div>
						</div>
						{!! Form::bsSubmit('Simpan', ['class' => 'btn btn-primary float-right mr-3']) !!}
						{!! Form::close() !!}
					</div>
					<!-- tab nasabah -->
					<div class="tab-pane" id="nasabah" role="tabpanel">
						<div class="clearfix">&nbsp;</div>
						<p class="text-right text-secondary"><i>*klik untuk mengubah data</i></p>
						@if(is_null($permohonan['id']))
							{!! Form::open(['url' => route('pengajuan.permohonan.store', ['id' => $permohonan['id'], 'kantor_aktif_id' => $kantor_aktif_id, 'status' => 'permohonan']), 'files' => true]) !!}
						@else
							{!! Form::open(['url' => route('pengajuan.permohonan.update', ['id' => $permohonan['id'], 'kantor_aktif_id' => $kantor_aktif_id, 'status' => 'permohonan']), 'files' => true, 'method' => 'PATCH']) !!}
						@endif
							<div class="row">
								<div class="col-sm-12">
									<h6 class="text-secondary"><strong><u>Profil</u></strong></h6>
								</div>
								<div class="col-sm-5 order-2">
									@if(!is_null($permohonan['dokumen_pelengkap']['ktp']))
										<img src="{{$permohonan['dokumen_pelengkap']['ktp']}}" class="img-fluid d-block mx-auto" alt="Responsive image" style="width:320px">
										<br/>
										<label class="mb-1">GANTI FOTO KTP</label><br/>
										<label class="custom-file">
											{!! Form::file('dokumen_pelengkap[ktp]', ['class' => 'custom-file-input']) !!}
											<span class="custom-file-control"></span>
										</label>
									@else
										<div class="d-block mx-auto">
											<img src="https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg" class="img-fluid d-block mx-auto" alt="Responsive image" style="width: 250px;">
											<br/>
											<label class="mb-1">FOTO KTP</label><br/>
											<label class="custom-file">
												<input type="file" class="custom-file-input" name="dokumen_pelengkap[ktp]">

												<span class="custom-file-control"></span>
											</label>
										</div>
									@endif
								</div>
								<div class="col-sm-7 order-1">
									<div class="row form-group mb-2">
										<div class="col-sm-4 text-right">
											{!! Form::label('', 'NIK', ['class' => 'text-uppercase mb-0']) !!}
										</div>
										<div class="col">
												{!! Form::text('nasabah[nik]', $permohonan['nasabah']['nik'], ['class' => 'nnik form-control inline-edit mask-id-card border-input w-75 text-info pb-1', 'placeholder' => '35-73-03-148014-0001']) !!}
												<small class="hidden-xs text-muted invisible"><i class="fa fa-circle-o-notch fa-spin fa-fw"></i> Memeriksa NIK</small>
												@if ($errors->has($name) && $show_error)
													<div class="invalid-feedback">
														@foreach ($errors->get($name) as $v)
															{{ $v }}<br>
														@endforeach
													</div>
												@endif
											</div>
									</div>
									<div class="row form-group">
										<div class="col-sm-8 ml-auto">
											{!! Form::checkbox('nasabah[is_ektp]', $permohonan['nasabah']['edit'], ['class' => 'nis_ektp form-check-input inline-edit']) !!} Nasabah menggunakan E-KTP
										</div>
									</div>
									{{--  {!! Form::bsCheckbox('Nasabah menggunakan e-KTP', 'nasabah[is_ektp]', $permohonan['nasabah']['is_ektp'], ['class' => 'nis_ektp form-check-input inline-edit'], true) !!}  --}}
									{!! Form::vText('Nama', 'nasabah[nama]', $permohonan['nasabah']['nama'], ['class' => 'nnama form-control inline-edit border-input w-100 text-info pb-1', 'placeholder' => 'Tukimin'], true) !!}
									{!! Form::vText('Tempat lahir', 'nasabah[tempat_lahir]', $permohonan['nasabah']['tempat_lahir'], ['class' => 'ntempat_lahir form-control inline-edit border-input w-75 text-info pb-1', 'placeholder' => 'Malang'], true) !!}
									{!! Form::vText('Tanggal lahir', 'nasabah[tanggal_lahir]', $permohonan['nasabah']['tanggal_lahir'], ['class' => 'ntanggal_lahir form-control inline-edit mask-date border-input w-50 text-info pb-1', 'placeholder' => 'dd/mm/yyyy'], true) !!}
									{!! Form::vSelect('Jenis Kelamin', 'nasabah[jenis_kelamin]', ['' => 'pilih', 'laki-laki' => 'Laki-Laki', 'perempuan' => 'perempuan'], $permohonan['nasabah']['jenis_kelamin'], ['class' => 'custom-select njenis_kelamin form-control inline-edit border-input w-50 text-info pb-1'], true) !!}
									{!! Form::vSelect('Status pernikahan', 'nasabah[status_perkawinan]', array_merge(['' => 'pilih'], $status_perkawinan), $permohonan['nasabah']['status_perkawinan'], ['class' => 'custom-select nstatus_perkawinan form-control inline-edit border-input w-50 text-info pb-1'], true) !!}
									{!! Form::vSelect('Pekerjaan', 'nasabah[pekerjaan]', array_merge(['' => 'pilih'], $jenis_pekerjaan), $permohonan['nasabah']['pekerjaan'], ['class' => 'custom-select npekerjaan form-control inline-edit border-input w-50 text-info pb-1'], true) !!}
									{!! Form::vText('Penghasilan Bersih', 'nasabah[penghasilan_bersih]', $permohonan['nasabah']['penghasilan_bersih'], ['class' => 'npenghasilan_bersih form-control inline-edit mask-money border-input w-50 text-info pb-1', 'placeholder' => 'masukkan penghasilan bersih'], true) !!}
									<div class="clearfix">&nbsp;</div>
									<div class="clearfix">&nbsp;</div>

									<h6 class="text-secondary"><strong><u>Alamat</u></strong></h6>
									<div class="row form-group">
										@if(count($permohonan['nasabah']['alamat']))
											@include('templates.alamat.ajax-alamat', ['kecamatan' => $permohonan['nasabah']['alamat']['kecamatan'], 'kota' => $permohonan['nasabah']['alamat']['kota'], 'prefix' => 'nasabah[alamat]', 'inline' => 'inline-edit', 'alamat' => $permohonan['nasabah']['alamat']])
										@else
											@include('templates.alamat.ajax-alamat', ['kecamatan' => $kantor_aktif['alamat']['kecamatan'], 'prefix' => 'nasabah[alamat]', 'inline' => 'inline-edit'])
										@endif
									</div>
									<div class="clearfix">&nbsp;</div>

									<h6 class="text-secondary"><strong><u>Kontak</u></strong></h6>
									{!! Form::vText('No. Telp', 'nasabah[telepon]', $permohonan['nasabah'][telepon], ['class' => 'ntelepon form-control inline-edit mask-no-telepon border-input w-50 text-info pb-1', 'placeholder' => '0123 4567 8910'], true) !!}
									{!! Form::vText('No. Whatsapp', 'nasabah[nomor_whatsapp]', $permohonan['nasabah']['nomor_whatsapp'], ['class' => 'nnomor_whatsapp form-control inline-edit mask-no-handphone border-input w-50 text-info pb-1', 'placeholder' => '0123 4567 8910'], true) !!}
									{!! Form::vText('Email', 'nasabah[email]', $permohonan['nasabah'][email], ['class' => 'nemail form-control inline-edit border-input w-75 text-info pb-1', 'placeholder' => 'example@gmail.com'], true) !!}
								</div>
							</div>
						{!! Form::bsSubmit('Simpan', ['class' => 'btn btn-primary float-right mr-3']) !!}
						{!! Form::close() !!}
					</div>
					<!-- tab keluarga -->
					<div class="tab-pane" id="keluarga" role="tabpanel">
						<div class="clearfix">&nbsp;</div>
						<p class="text-right text-secondary"><i>*klik untuk mengubah data</i></p>

						@if(!is_null($permohonan['nasabah']['is_lama']) && $permohonan['nasabah']['is_lama'] == true && !count($permohonan['nasabah']['keluarga']))
							<a class="btn btn-primary text-right mb-3 text-white" id="bantuIsiKeluarga">Bantuan Pengisian</a>
						@endif
						
						@if(is_null($permohonan['id']))
						{!! Form::open(['url' => route('pengajuan.permohonan.store', ['id' => $permohonan['id'], 'kantor_aktif_id' => $kantor_aktif_id, 'status' => 'permohonan']), 'files' => true]) !!}
						@else
						{!! Form::open(['url' => route('pengajuan.permohonan.update', ['id' => $permohonan['id'], 'kantor_aktif_id' => $kantor_aktif_id, 'status' => 'permohonan']), 'files' => true, 'method' => 'PATCH']) !!}
						@endif
						<table class="table table-bordered">
							<thead class="thead-default">
								<tr>
									<th>Hubungan</th>
									<th>NIK</th>
									<th>Nama</th>
									<th>Telepon</th>
									<th colspan="2">&nbsp;</th>
								</tr>
							</thead>
							<tbody id="formKeluarga">
								@forelse($permohonan['nasabah']['keluarga'] as $k => $v)
									<tr id="clonedKeluarga{{$k+1}}" class="clonedKeluarga">
										<td class="align-text-top">
											{!! Form::vSelect(null, 'keluarga['.($k+1).'][hubungan]', ['anak' => 'Anak', 'orang_tua' => 'Orang Tua', 'suami' => 'Suami', 'istri' => 'Istri', 'saudara' => 'Saudara'], $v['hubungan'], ['class' => 'khubungan form-control text-info inline-edit'], true) !!}
										</td>
										<td class="align-text-top">
											{!! Form::vText(null, 'keluarga['.($k+1).'][nik]', $v['nik'], ['class' => 'knik form-control text-info inline-edit', 'placeholder' => '35-73-03-148014-0001'], true) !!}
										</td>
										<td class="align-text-top">
											{!! Form::vText(null, 'keluarga['.($k+1).'][nama]', $v['nama'], ['class' => 'knama form-control text-info inline-edit', 'placeholder' => 'Sukinem'], true) !!}
										</td>
										<td class="align-text-top">
											{!! Form::vText(null, 'keluarga['.($k+1).'][telepon]', $v['telepon'], ['class' => 'ktelepon form-control text-info inline-edit', 'placeholder' => '0818 3319 4748'], true) !!}
										</td>
										<td class="align-text-top text-center" colspan="2">
											<a class="cloneKeluarga text-primary" data-toggle="tooltip" data-placement="bottom" title="tambah/duplikat keluarga">
												<i class="fa fa-copy fa-lg"></i>
											</a>
											&nbsp;&nbsp;&nbsp;
											<a class="removeKeluarga text-danger" data-toggle="tooltip" data-placement="bottom" title="hapus keluarga">
												<i class="fa fa-trash fa-lg"></i>
											</a>
										</td>
									</tr>
								@empty
									<tr id="clonedKeluarga1" class="clonedKeluarga">
										<td class="align-text-top">
											{!! Form::vSelect(null, 'keluarga[1][hubungan]', ['anak' => 'Anak', 'orang_tua' => 'Orang Tua', 'suami' => 'Suami', 'istri' => 'Istri', 'saudara' => 'Saudara'], null, ['class' => 'khubungan form-control text-info inline-edit'], true) !!}
										</td>
										<td class="align-text-top">
											{!! Form::vText(null, 'keluarga[1][nik]', null, ['class' => 'knik form-control text-info inline-edit', 'placeholder' => '35-73-03-148014-0001'], true) !!}
										</td>
										<td class="align-text-top">
											{!! Form::vText(null, 'keluarga[1][nama]', null, ['class' => 'knama form-control text-info inline-edit', 'placeholder' => 'Sukinem'], true) !!}
										</td>
										<td class="align-text-top">
											{!! Form::vText(null, 'keluarga[1][telepon]', null, ['class' => 'ktelepon form-control text-info inline-edit', 'placeholder' => '0818 3319 4748'], true) !!}
										</td>
										<td class="align-text-top text-center" colspan="2">
											<a class="cloneKeluarga text-primary" data-toggle="tooltip" data-placement="bottom" title="tambah/duplikat keluarga">
												<i class="fa fa-copy fa-lg"></i>
											</a>
											&nbsp;&nbsp;&nbsp;
											<a class="removeKeluarga text-danger" data-toggle="tooltip" data-placement="bottom" title="hapus keluarga">
												<i class="fa fa-trash fa-lg"></i>
											</a>
										</td>
									</tr>
								@endforelse
							</tbody>
						</table>
						{!! Form::bsSubmit('Simpan', ['class' => 'btn btn-primary float-right mr-3']) !!}
						{!! Form::close() !!}
					</div>
					<!-- tab jaminan -->
					<div class="tab-pane" id="jaminan" role="tabpanel">
						<div class="clearfix">&nbsp;</div>
						<p class="text-right text-secondary"><i>*klik untuk mengubah data</i></p>
						@if(is_null($permohonan['id']))
						{!! Form::open(['url' => route('pengajuan.permohonan.store', ['id' => $permohonan['id'], 'kantor_aktif_id' => $kantor_aktif_id])]) !!}
						@else
						{!! Form::open(['url' => route('pengajuan.permohonan.update', ['id' => $permohonan['id'], 'kantor_aktif_id' => $kantor_aktif_id]), 'method' => 'PATCH']) !!}
						@endif
						{!!Form::hidden('jaminan_kendaraan', 1)!!}
						{!!Form::hidden('jaminan_tanah_bangunan', 1)!!}
						<p class="text-left text-secondary">JAMINAN KENDARAAN</p>
						<table class="table table-bordered">
							<thead class="thead-default">
								<tr>
									<th class="text-center">Jenis</th>
									<th class="text-center">No. BPKB</th>
									<th class="text-center">Detail</th>
									<th class="text-center">Tahun Perolehan</th>
									<th class="text-center">Harga Jaminan (*)</th>
									<th class="text-center" colspan="2">Action</th>
								</tr>
							</thead> 
							<tbody id="formJaminanKendaraan">
								@forelse ($permohonan['jaminan_kendaraan'] as $kj => $vj)
									<tr id="clonedJaminanKendaraan{{$kj+1}}" class="clonedJaminanKendaraan">
										<td class="text-center align-text-top">
											{!! Form::vSelect(null, 'jaminan_kendaraan['.($kj+1).'][jenis]', $jenis_kendaraan, $vj['dokumen_jaminan']['bpkb']['jenis'], ['class' => 'jkjenis form-control text-info inline-edit', 'style' => 'width: 65px;'], true) !!}
										</td>
										<td class="text-center align-text-top tdnomorbpkb">
											{!! Form::vText(null, 'jaminan_kendaraan['.($kj+1).'][nomor_bpkb]', $vj['dokumen_jaminan']['bpkb']['nomor_bpkb'], ['class' => 'jknomorbpkb form-control text-info inline-edit', 'placeholder' => 'F 12345678'], true) !!}
										</td>
										<td class="text-center align-text-top">
											{!! Form::vText('Merk', 'jaminan_kendaraan['.($kj+1).'][merk]', $vj['dokumen_jaminan']['bpkb']['merk'], ['class' => 'jkmerk form-control text-info inline-edit', 'placeholder' => 'Honda'], true) !!}
											{!! Form::vText('Tipe', 'jaminan_kendaraan['.($kj+1).'][tipe]', $vj['dokumen_jaminan']['bpkb']['tipe'], ['class' => 'jktipe form-control text-info inline-edit', 'placeholder' => 'Sedan'], true) !!}
											{!! Form::vText('Tahun', 'jaminan_kendaraan['.($kj+1).'][tahun]', $vj['dokumen_jaminan']['bpkb']['tahun'], ['class' => 'jktahun form-control text-info inline-edit', 'placeholder' => '2000'], true) !!}
										</td>
										<td class="text-center align-text-top">
											{!! Form::vText(null, 'jaminan_kendaraan['.($kj+1).'][tahun_perolehan]', $vj['tahun_perolehan'], ['class' => 'jktahunoleh form-control text-info inline-edit', 'placeholder' => '2000'], true) !!}
										</td>
										<td class="text-right align-text-top">
											{!! Form::vText(null, 'jaminan_kendaraan['.($kj+1).'][nilai_jaminan]', $vj['nilai_jaminan'], ['class' => 'jknilai form-control text-info inline-edit mask-money', 'placeholder' => 'harga jaminan'], true) !!}
										</td>
										<td class="text-center align-text-top" colspan="2">
											<div class="d-inline">
												<a class="cloneJaminanKendaraan text-primary" data-toggle="tooltip" data-placement="bottom" title="tambah/duplikat jaminan kendaraan">
													<i class="fa fa-copy fa-lg"></i>
												</a> 
												&nbsp;&nbsp;&nbsp;
												<a class="removeJaminanKendaraan text-danger" data-toggle="tooltip" data-placement="bottom" title="hapus jaminan kendaraan">
													<i class="fa fa-trash fa-lg"></i>
												</a>
											</div>
										</td>
									</tr>
								@empty
									<tr id="clonedJaminanKendaraan1" class="clonedJaminanKendaraan">
										<td class="text-center align-text-top">
											{!! Form::vSelect(null, 'jaminan_kendaraan[1][jenis]', $jenis_kendaraan, null, ['class' => 'jkjenis form-control text-info inline-edit', 'style' => 'width: 65px;'], true) !!}
										</td>
										<td class="text-center align-text-top tdnomorbpkb">
											{!! Form::vText(null, 'jaminan_kendaraan[1][nomor_bpkb]', null, ['class' => 'jknomorbpkb form-control text-info inline-edit', 'placeholder' => 'F 12345678'], true) !!}
										</td>
										<td class="text-center align-text-top">
											{!! Form::vText('Merk', 'jaminan_kendaraan[1][merk]', null, ['class' => 'jkmerk form-control text-info inline-edit', 'placeholder' => 'Honda'], true) !!}
											{!! Form::vText('Tipe', 'jaminan_kendaraan[1][tipe]', null, ['class' => 'jktipe form-control text-info inline-edit', 'placeholder' => 'Sedan'], true) !!}
											{!! Form::vText('Tahun', 'jaminan_kendaraan[1][tahun]', null, ['class' => 'jktahun form-control text-info inline-edit', 'placeholder' => '2000'], true) !!}
										</td>
										<td class="text-center align-text-top">
											{!! Form::vText(null, 'jaminan_kendaraan[1][tahun_perolehan]', null, ['class' => 'jktahunoleh form-control text-info inline-edit', 'placeholder' => '2000'], true) !!}
										</td>
										<td class="text-right align-text-top">
											{!! Form::vText(null, 'jaminan_kendaraan[1][nilai_jaminan]', null, ['class' => 'jknilai form-control text-info inline-edit mask-money', 'placeholder' => 'harga jaminan'], true) !!}
										</td>
										<td class="text-center align-text-top" colspan="2">
											<div class="d-inline">
												<a class="cloneJaminanKendaraan text-primary" data-toggle="tooltip" data-placement="bottom" title="tambah/duplikat jaminan kendaraan">
													<i class="fa fa-copy fa-lg"></i>
												</a> 
												&nbsp;&nbsp;&nbsp;
												<a class="removeJaminanKendaraan text-danger" data-toggle="tooltip" data-placement="bottom" title="hapus jaminan kendaraan">
													<i class="fa fa-trash fa-lg"></i>
												</a>
											</div>
										</td>
									</tr>
								@endforelse
							</tbody>
							<tfoot>
								<tr>
									<td colspan="8" class="text-right align-text-top">
										<small class="text-secondary"><i>* menurut nasabah</i></small>
									</td>
								</tr>
							</tfoot>		
						</table>
						<div class="clearfix">&nbsp;</div>
						<p class="text-left text-secondary">JAMINAN TANAH BANGUNAN</p>
						<table class="table table-bordered">
							<thead class="thead-default">
								<tr>
									<th class="text-center">Jenis</th>
									<th class="text-center">Detail</th>
									<th class="text-center" style="width: 15%">Tahun Perolehan</th>
									<th class="text-center">Harga Jaminan (*)</th>
									<th class="text-center">Action</th>
								</tr>
							</thead> 
							<tbody id="formJaminanTB">
								@forelse ($permohonan['jaminan_tanah_bangunan'] as $ktb => $vtb)
									<tr id="clonedJaminanTB{{$ktb+1}}" class="clonedJaminanTB">
										<td class="text-center align-text-top p-4">
											{!! Form::vSelect(null, 'jaminan_tanah_bangunan['.($ktb+1).'][jenis]', $jenis_sertifikat, $vtb['jenis'], ['class' => 'jtbjenis form-control text-info inline-edit'], true) !!}
										</td>
										<td class="text-center align-text-top">
											{!! Form::vText('No. Sertifikat', 'jaminan_tanah_bangunan['.($ktb+1).'][nomor_sertifikat]', $vtb['dokumen_jaminan'][$vtb['jenis']]['nomor_sertifikat'], ['class' => 'jtbnomorsertifikat form-control text-info inline-edit', 'placeholder' => '12-27-98-36-3-54502'], true) !!}
											
											{!! Form::vSelect('Tipe', 'jaminan_tanah_bangunan['.($ktb+1).'][tipe]', $tipe_sertifikat, $vtb['dokumen_jaminan'][$vtb['jenis']]['tipe'], ['class' => 'jtbtipe form-control text-info inline-edit'], true) !!}

											<div class="maber" style="@if($vtb['jenis']=='shm') display: none; @endif">
												{!! Form::vText('Berlaku Hingga', 'jaminan_tanah_bangunan['.($ktb+1).'][masa_berlaku_sertifikat]', $vtb['dokumen_jaminan'][$vtb['jenis']]['masa_berlaku_sertifikat'], ['class' => 'jtbmaber mask-year form-control text-info inline-edit', 'placeholder' => '2000'], true) !!}
											</div>
											
											{!! Form::vText('L. Tanah', 'jaminan_tanah_bangunan['.($ktb+1).'][luas_tanah]', $vtb['dokumen_jaminan'][$vtb['jenis']]['luas_tanah'], ['class' => 'jtbltanah form-control text-info inline-edit', 'placeholder' => '36'], true) !!}
										
											<div class="laban" style="@if($vtb['dokumen_jaminan'][$vtb['jenis']]['tipe']!='tanah_dan_bangunan') display: none; @endif">
												{!! Form::vText('L. Bangunan', 'jaminan_tanah_bangunan['.($ktb+1).'][luas_bangunan]', $vtb['dokumen_jaminan'][$vtb['jenis']]['luas_bangunan'], ['class' => 'jtblbangunan form-control text-info inline-edit', 'placeholder' => '24'], true) !!}
											</div>

											@include('templates.alamat.v-ajax-alamat', ['kecamatan' => $vtb['dokumen_jaminan'][$vtb['jenis']]['alamat']['kecamatan'], 'kota' => $vtb['dokumen_jaminan'][$vtb['jenis']]['alamat']['kota'], 'prefix' => 'jaminan_tanah_bangunan['.($ktb+1).'][alamat]', 'alamat' => $vtb['dokumen_jaminan'][$vtb['jenis']]['alamat'], 'class' => 'jtbalamat'])
										</td>
										<td class="text-center align-text-top">
											{!! Form::vText(null, 'jaminan_tanah_bangunan['.($ktb+1).'][tahun_perolehan]', $vtb['tahun_perolehan'], ['class' => 'jtbtahunoleh form-control text-info inline-edit', 'placeholder' => '2000', 'style' => 'padding:7px;'], true) !!}
										</td>
										<td class="text-right align-text-top">
											{!! Form::vText(null, 'jaminan_tanah_bangunan['.($ktb+1).'][nilai_jaminan]', $vtb['nilai_jaminan'], ['class' => 'jtbnilai form-control text-info inline-edit mask-money', 'placeholder' => 'harga jaminan'], true) !!}
										</td>
										<td class="text-center align-text-top">
											<div class="d-inline">
												<a class="cloneJaminanTB text-primary" data-toggle="tooltip" data-placement="bottom" title="tambah/duplikat jaminan tanah bangunan">
													<i class="fa fa-copy fa-lg"></i>
												</a> 
												&nbsp;&nbsp;&nbsp;
												<a class="removeJaminanTB text-danger" data-toggle="tooltip" data-placement="bottom" title="hapus jaminan tanah bangunan">
													<i class="fa fa-trash fa-lg"></i>
												</a>
											</div>
										</td>
									</tr>
								@empty
								<tr id="clonedJaminanTB1" class="clonedJaminanTB">
									<td class="text-center align-text-top">
										{!! Form::vSelect(null, 'jaminan_tanah_bangunan[1][jenis]', $jenis_sertifikat, null, ['class' => 'jtbjenis form-control text-info inline-edit'], true) !!}
									</td>
									<td class="text-center align-text-top">
										{!! Form::vText('No. Sertifikat', 'jaminan_tanah_bangunan[1][nomor_sertifikat]', null, ['class' => 'jtbnomorsertifikat form-control text-info inline-edit', 'placeholder' => '12-27-98-36-3-54502'], true) !!}
										{!! Form::vSelect('Tipe', 'jaminan_tanah_bangunan[1][tipe]', $tipe_sertifikat, null, ['class' => 'jtbtipe form-control text-info inline-edit'], true) !!}

										<div class="maber" style="display: none;">
											{!! Form::vText('Berlaku Hingga', 'jaminan_tanah_bangunan[1][masa_berlaku_sertifikat]', null, ['class' => 'jtbmaber mask-year form-control text-info inline-edit', 'placeholder' => '2000'], true) !!}
										</div>
										
										{!! Form::vText('L. Tanah', 'jaminan_tanah_bangunan[1][luas_tanah]', null, ['class' => 'jtbltanah form-control text-info inline-edit', 'placeholder' => '36'], true) !!}
									
										<div class="laban" style="display: none;">
											{!! Form::vText('L. Bangunan', 'jaminan_tanah_bangunan[1][luas_bangunan]', null, ['class' => 'jtblbangunan form-control text-info inline-edit', 'placeholder' => '24'], true) !!}
										</div>

										@include('templates.alamat.v-ajax-alamat', ['kecamatan' => $kantor_aktif['alamat']['kecamatan'], 'kota' => $kantor_aktif['alamat']['kota'], 'prefix' => 'jaminan_tanah_bangunan[1][alamat]', 'alamat' => $kantor_aktif['alamat'], 'class' => 'jtbalamat'])
									</td>
									<td class="text-center align-text-top">
										{!! Form::vText(null, 'jaminan_tanah_bangunan[1][tahun_perolehan]', null, ['class' => 'jtbtahunoleh form-control text-info inline-edit', 'placeholder' => '2000'], true) !!}
									</td>
									<td class="text-right align-text-top">
										{!! Form::vText(null, 'jaminan_tanah_bangunan[1][nilai_jaminan]', null, ['class' => 'jtbnilai form-control text-info inline-edit mask-money', 'placeholder' => 'harga jaminan'], true) !!}
									</td>
									<td class="text-center align-text-op">
										<div class="d-inline">
											<a class="cloneJaminanTB text-primary" data-toggle="tooltip" data-placement="bottom" title="tambah/duplikat jaminan tanah bangunan">
												<i class="fa fa-copy fa-lg"></i>
											</a>
											&nbsp;&nbsp;&nbsp;
											<a class="removeJaminanTB text-danger" data-toggle="tooltip" data-placement="bottom" title="hapus jaminan tanah bangunan">
												<i class="fa fa-trash fa-lg"></i>
											</a>
										</div>
									</td>
								</tr>
								@endforelse
							</tbody>
							<tfoot>
								<tr>
									<td colspan="8" class="text-right">
										<small class="text-secondary"><i>* menurut nasabah</i></small>
									</td>
								</tr>
							</tfoot>		
						</table>
						{!! Form::bsSubmit('Simpan', ['class' => 'btn btn-primary float-right mr-3']) !!}
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
		<div class="clearfix">&nbsp;</div>
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

@push('css')
	<style type="text/css">
	
		.clonedKeluarga { padding: 10px; border-radius: 5px; margin-bottom: 10px; }

		.clonedKeluarga div { margin: 5px; }

		.clonedJaminanKendaraan { padding: 10px; border-radius: 5px; margin-bottom: 10px; }

		.clonedJaminanKendaraan div { margin: 5px; }
	</style>
@endpush
@push ('js')
		<script>

		///CLONE FORM KELUARGA///
		var regex = /^(.+?)(\d+)$/i;
		var cloneIndexKeluarga = $(".clonedKeluarga").length;

		function cloneKeluarga(){
			cloneIndexKeluarga++;

			$(this).parents(".clonedKeluarga").clone()
				.appendTo("#formKeluarga")
				.attr("id", "clonedKeluarga" +  cloneIndexKeluarga)
				.find("*")
				.each(function() {
					var id = this.id || "";
					var match = id.match(regex) || [];
					if (match.length == 3) {
						this.id = match[1] + (cloneIndexKeluarga);
					}
				})
				.on('click', 'a.cloneKeluarga', cloneKeluarga)
				.on('click', 'a.removeKeluarga', removeKeluarga);

			$("#clonedKeluarga"+cloneIndexKeluarga).find('.khubungan').attr('name', 'keluarga['+cloneIndexKeluarga+'][hubungan]');
			$("#clonedKeluarga"+cloneIndexKeluarga).find('.knik').attr('name', 'keluarga['+cloneIndexKeluarga+'][nik]');
			$("#clonedKeluarga"+cloneIndexKeluarga).find('.knama').attr('name', 'keluarga['+cloneIndexKeluarga+'][nama]');
			$("#clonedKeluarga"+cloneIndexKeluarga).find('.ktelepon').attr('name', 'keluarga['+cloneIndexKeluarga+'][telepon]');
		}

		function removeKeluarga(){
			$(this).parents(".clonedKeluarga").remove();
		}
		$("a.cloneKeluarga").on("click", cloneKeluarga);

		$("a.removeKeluarga").on("click", removeKeluarga);


		///CLONE FORM JAMINAN KENDARAAN///
		var cloneIndexJaminanKendaraan = $(".clonedJaminanKendaraan").length;

		function cloneJaminanKendaraan(){
			cloneIndexJaminanKendaraan++;

			$(this).parents(".clonedJaminanKendaraan").clone()
				.appendTo("#formJaminanKendaraan")
				.attr("id", "clonedJaminanKendaraan" +  cloneIndexJaminanKendaraan)
				.find("*")
				.each(function() {
					var id = this.id || "";
					var match = id.match(regex) || [];
					if (match.length == 3) {
						this.id = match[1] + (cloneIndexJaminanKendaraan);
					}
				})
				.on('click', 'a.cloneJaminanKendaraan', cloneJaminanKendaraan)
				.on('click', 'a.removeJaminanKendaraan', removeJaminanKendaraan)
				.on('change', 'input.jknomorbpkb', autoFillJaminanKendaraan);

				$("#clonedJaminanKendaraan"+cloneIndexJaminanKendaraan).find('.jknomorbpkb').attr('name', 'jaminan_kendaraan['+cloneIndexJaminanKendaraan+'][nomor_bpkb]');
				$("#clonedJaminanKendaraan"+cloneIndexJaminanKendaraan).find('.jkjenis').attr('name', 'jaminan_kendaraan['+cloneIndexJaminanKendaraan+'][jenis]');
				$("#clonedJaminanKendaraan"+cloneIndexJaminanKendaraan).find('.jkmerk').attr('name', 'jaminan_kendaraan['+cloneIndexJaminanKendaraan+'][merk]');
				$("#clonedJaminanKendaraan"+cloneIndexJaminanKendaraan).find('.jktipe').attr('name', 'jaminan_kendaraan['+cloneIndexJaminanKendaraan+'][tipe]');
				$("#clonedJaminanKendaraan"+cloneIndexJaminanKendaraan).find('.jktahun').attr('name', 'jaminan_kendaraan['+cloneIndexJaminanKendaraan+'][tahun]');
				$("#clonedJaminanKendaraan"+cloneIndexJaminanKendaraan).find('.jktahunoleh').attr('name', 'jaminan_kendaraan['+cloneIndexJaminanKendaraan+'][tahun_perolehan]');
				$("#clonedJaminanKendaraan"+cloneIndexJaminanKendaraan).find('.jknilai').attr('name', 'jaminan_kendaraan['+cloneIndexJaminanKendaraan+'][nilai_jaminan]');
		}

		function removeJaminanKendaraan(){
			$(this).parents(".clonedJaminanKendaraan").remove();
		}
		$("a.cloneJaminanKendaraan").on("click", cloneJaminanKendaraan);

		$("a.removeJaminanKendaraan").on("click", removeJaminanKendaraan);

		$("input.jknomorbpkb").on("change", autoFillJaminanKendaraan);
	
		///AUTO FILL JAMINAN KENDARAAN BERDASARKAN NOMOR BPKB///
		function autoFillJaminanKendaraan(){
			var tr = $(this).closest('tr');
			$.ajax({
				url: "{{route('log.bpkb')}}",
			   	data: {
					q: $(this).val()
				},
			   	success: function(data) {
			   		if(Object.keys(data).length > 1) {
						tr.find('.jkjenis').val(data.jenis);
						tr.find('.jkmerk').val(data.merk);
						tr.find('.jktipe').val(data.tipe);
						tr.find('.jktahun').val(data.tahun);
						tr.find('.jktahunoleh').val(data.tahun_perolehan);
						tr.find('.jknilai').val("Rp 0");
						// tr.find('.jknilai').val(data.nilai);
			   		}
			   },
			   type: 'GET'
			});
		}

		///CLONE FORM JAMINAN TANAH BANGUNAN///
		// $( document ).ready(function() {
		// 	var len = $(".clonedJaminanTB").length;
		// 	for (var i = 1; i <= len; i++) {
		// 		reInitAjaxAlamat($("#clonedJaminanTB"+i));
		// 	}
		// });

		var cloneIndexJaminanTB = $(".clonedJaminanTB").length;

		function cloneJaminanTB(){
			cloneIndexJaminanTB++;
			$(this).parents(".clonedJaminanTB").clone()
				.appendTo("#formJaminanTB")
				.attr("id", "clonedJaminanTB" +  cloneIndexJaminanTB)
				.find("*")
				.each(function() {
					var id = this.id || "";
					var match = id.match(regex) || [];
					if (match.length == 3) {
						this.id = match[1] + (cloneIndexJaminanTB);
					}
				})
				.on('click', 'a.cloneJaminanTB', cloneJaminanTB)
				.on('click', 'a.removeJaminanTB', removeJaminanTB)
				.on('change', 'input.jtbnomorsertifikat', autoFillJaminanTB)
				.on('change', 'select.jtbjenis', checkJenisSTF)
				.on('change', 'select.jtbtipe', checkTipeSTF);


				$("#clonedJaminanTB"+cloneIndexJaminanTB).find('.jtbnomorsertifikat').attr('name', 'jaminan_tanah_bangunan['+cloneIndexJaminanTB+'][nomor_sertifikat]');
				$("#clonedJaminanTB"+cloneIndexJaminanTB).find('.jtbjenis').attr('name', 'jaminan_tanah_bangunan['+cloneIndexJaminanTB+'][jenis]');
				$("#clonedJaminanTB"+cloneIndexJaminanTB).find('.jtbtipe').attr('name', 'jaminan_tanah_bangunan['+cloneIndexJaminanTB+'][tipe]');
				$("#clonedJaminanTB"+cloneIndexJaminanTB).find('.jtbmaber').attr('name', 'jaminan_tanah_bangunan['+cloneIndexJaminanTB+'][masa_berlaku_sertifikat]');
				$("#clonedJaminanTB"+cloneIndexJaminanTB).find('.jtbltanah').attr('name', 'jaminan_tanah_bangunan['+cloneIndexJaminanTB+'][luas_tanah]');
				$("#clonedJaminanTB"+cloneIndexJaminanTB).find('.jtblbangunan').attr('name', 'jaminan_tanah_bangunan['+cloneIndexJaminanTB+'][luas_bangunan]');

				$("#clonedJaminanTB"+cloneIndexJaminanTB).find('.jtbalamat.alamat').attr('name', 'jaminan_tanah_bangunan['+cloneIndexJaminanTB+'][alamat][alamat]');
				$("#clonedJaminanTB"+cloneIndexJaminanTB).find('.jtbalamat.rt').attr('name', 'jaminan_tanah_bangunan['+cloneIndexJaminanTB+'][alamat][rt]');
				$("#clonedJaminanTB"+cloneIndexJaminanTB).find('.jtbalamat.rw').attr('name', 'jaminan_tanah_bangunan['+cloneIndexJaminanTB+'][alamat][rw]');
				$("#clonedJaminanTB"+cloneIndexJaminanTB).find('.jtbalamat.kelurahan').attr('name', 'jaminan_tanah_bangunan['+cloneIndexJaminanTB+'][alamat][kelurahan]');
				$("#clonedJaminanTB"+cloneIndexJaminanTB).find('.jtbalamat.kecamatan').attr('name', 'jaminan_tanah_bangunan['+cloneIndexJaminanTB+'][alamat][kecamatan]');
				$("#clonedJaminanTB"+cloneIndexJaminanTB).find('.jtbalamat.kota').attr('name', 'jaminan_tanah_bangunan['+cloneIndexJaminanTB+'][alamat][kota]');

				$("#clonedJaminanTB"+cloneIndexJaminanTB).find('.jtbtahunoleh').attr('name', 'jaminan_tanah_bangunan['+cloneIndexJaminanTB+'][tahun_perolehan]');
				$("#clonedJaminanTB"+cloneIndexJaminanTB).find('.jtbnilai').attr('name', 'jaminan_tanah_bangunan['+cloneIndexJaminanTB+'][nilai_jaminan]');
				
			// reInitAjaxAlamat($("#clonedJaminanTB"+cloneIndexJaminanTB));
		}

		function removeJaminanTB(){
			$(this).parents(".clonedJaminanTB").remove();
		}
		$("a.cloneJaminanTB").on("click", cloneJaminanTB);

		$("a.removeJaminanTB").on("click", removeJaminanTB);

		$("input.jtbnomorsertifikat").on("change", autoFillJaminanTB);

		$("select.jtbjenis").on("change", checkJenisSTF);

		$("select.jtbtipe").on("change", checkTipeSTF);
	
		///AUTO FILL JAMINAN TB BERDASARKAN NOMOR SERTIFIKAT///
		function autoFillJaminanTB(){
			var tr = $(this).closest('tr');
			$.ajax({
				url: "{{route('log.sertifikat')}}",
			   	data: {
					q: $(this).val()
				},
			   	success: function(data) {
			   		if(Object.keys(data).length > 1) {
						tr.find('.jtbjenis').val(data.jenis);
						tr.find('.jtbtipe').val(data.tipe);
						tr.find('.jtbmaber').val(data.masa_berlaku_sertifikat);
						tr.find('.jtbltanah').val(data.luas_tanah);
						tr.find('.jtblbangunan').val(data.luas_bangunan);
						tr.find('.jtbalamat.alamat').val(data.alamat.alamat);
						tr.find('.jtbalamat.rt').val(data.alamat.rt);
						tr.find('.jtbalamat.rw').val(data.alamat.rw);
						tr.find('.jtbalamat.kelurahan').val(data.alamat.kelurahan);
						tr.find('.jtbalamat.kecamatan').val(data.alamat.kecamatan);
						tr.find('.jtbalamat.kota').val(data.alamat.kota);
						tr.find('.jtbtahunoleh').val(data.tahun_perolehan);
						tr.find('.jtbnilai').val("Rp 0");
						// tr.find('.jknilai').val(data.nilai);
					}
			   },
			   type: 'GET'
			});
		}

		///HIDE MASA BERLAKU JAMINAN TB JIKA JENIS SHM///
		function checkJenisSTF(){
			var tr 	= $(this).closest('tr');
			if($(this).val()=='shm'){
				tr.find('.maber').hide();
			}else{
				tr.find('.maber').show();
			}
		}

		///HIDE LUAS BANGUNAN JAMINAN TB JIKA TIPE TANAH///
		function checkTipeSTF(){
			var tr 	= $(this).closest('tr');
			if($(this).val()=='tanah_dan_bangunan'){
				tr.find('.laban').show();
			}else{
				tr.find('.laban').hide();
			}
		}

		///AUTO FILL NASABAH///
		$("input.nnik").on("change", autoFillNasabah);

		function autoFillNasabah(){
			var form = $(this).closest('form');
			$.ajax({
				url: "{{route('log.nasabah')}}",
			   	data: {
					q: $(this).val()
				},
			   	success: function(data) {
			   		if(Object.keys(data).length > 1) {
						form.find('.nis_ektp').val(data.is_ektp);
						form.find('.nnama').val(data.nama);
						form.find('.ntempat_lahir').val(data.tempat_lahir);
						form.find('.ntanggal_lahir').val(data.tanggal_lahir);
						form.find('.njenis_kelamin').val(data.jenis_kelamin);
						form.find('.nstatus_perkawinan').val(data.status_perkawinan);
						form.find('.npekerjaan').val(data.pekerjaan);
						form.find('.npenghasilan_bersih').val(data.penghasilan_bersih);
						form.find('.ntelepon').val(data.telepon);
						form.find('.nnomor_whatsapp').val(data.nomor_whatsapp);
						form.find('.nemail').val(data.email);
						form.find('.alamat').val(data.alamat.alamat);
						form.find('.rt').val(data.alamat.rt);
						form.find('.rw').val(data.alamat.rw);
						form.find('.kelurahan').val(data.alamat.kelurahan);
						form.find('.kecamatan').val(data.alamat.kecamatan);
						form.find('.kota').val(data.alamat.kota);
					}
			   },
			   type: 'GET'
			});
		}

		///AUTO FILL KELUARGA///
		$("#bantuIsiKeluarga").on("click", autoFillKeluarga);

		function autoFillKeluarga(){
			var form = $('#clonedKeluarga1');
			$.ajax({
				url: "{{route('log.nasabah')}}",
			   	data: {
					q: "{{$permohonan['nasabah']['nik']}}"
				},
			   	error: function(data) {
					alert('Maaf, tidak ada data keluarga tersimpan');
			   },
			   	success: function(data) {
			   		var count = Object.keys(data.keluarga).length;
			   		var isi = 0;
			   		$.each(data.keluarga, function (key, keluarga) {
			   			isi++;
   						$("#clonedKeluarga"+cloneIndexKeluarga).find('.khubungan').val(keluarga.hubungan);
						$("#clonedKeluarga"+cloneIndexKeluarga).find('.knik').val(keluarga.nik);
						$("#clonedKeluarga"+cloneIndexKeluarga).find('.knama').val(keluarga.nama);
						$("#clonedKeluarga"+cloneIndexKeluarga).find('.ktelepon').val(keluarga.telepon);

						if(isi<count) {
							$("#clonedKeluarga"+cloneIndexKeluarga).find('.cloneKeluarga').trigger('click');
						}
					});
			   },
			   type: 'GET'
			});

			$(this).hide();
		}

		//ASSIGN SURVEYOR
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

		function reInitAjaxAlamat(parent){
			parent.find(".ajax-teritori-kecamatan").select2({
				ajax: {
					url: "{{route('distrik.index')}}",
					data: function (params) {
							return {
								q: params.term // search term
							};
						},
					processResults: function (data, params) {
						return {
							results:  $.map(data, function (kecamatan) {
								return {
									pusat: kecamatan.kota.nama,
									text: kecamatan.nama,
									id: kecamatan.nama
								}
							})
						};
					},
				}
			});

			parent.find(".ajax-teritori-kota").select2({
				ajax: {
					url: "{{route('regensi.index')}}",
					data: function (params) {
					var kecamatan = parent.find('.ajax-teritori-kecamatan').select2('data');
							return {
								q: kecamatan[0].pusat // search term
							};
						},
					processResults: function (data, params) {
						return {
							results:  $.map(data, function (kota) {
								return {
									text: kota.nama,
									id: kota.nama
								}
							})
						};
					},
				}
			});
		}
	</script>
@endpush