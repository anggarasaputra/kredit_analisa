@push('main')
	<div class="container bg-white bg-shadow p-4">
		<div class="row">
			<div class="col">
				<h4 class='mb-4 text-style text-secondary'>
					<span class="text-uppercase">{{$title}}</span> 
					@if(is_null($karyawan['id']))
						<small> / <small><a href="{{route('manajemen.karyawan.upload', ['kantor_aktif_id' => $kantor_aktif['id']])}}" class="">Upload Data Karyawan</a></small></small>
					@endif
				</h4>
			</div>
		</div>
		
		<div class="clearfix">&nbsp;</div>

		@if(is_null($karyawan['id']))
			{!! Form::open(['url' => route('manajemen.karyawan.store', ['kantor_aktif_id' => $kantor_aktif['id']])]) !!}
		@else
			{!! Form::open(['url' => route('manajemen.karyawan.update', ['id' => $karyawan['id'], 'kantor_aktif_id' => $kantor_aktif['id']]), 'method' => 'PATCH']) !!}
		@endif

			<div class="row p-b-sm">
				<div class="col-sm-6">
					<fieldset class="form-group">
						<label class="text-sm">
							<strong>
								DATA PRIBADI
							</strong>
						</label>
					</fieldset>

					<fieldset class="form-group">
						<label class="text-sm">NAMA</label>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-10">
								{!! Form::text('nama', $karyawan['nama'], ['class' => 'form-control required', 'placeholder' => 'Masukkan nama karyawan']) !!}			
							</div>
						</div>
					</fieldset>

					<fieldset class="form-group">
						<label class="text-sm">EMAIL</label>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-10">
								{!! Form::email('email', $karyawan['email'], ['class' => 'form-control required', 'placeholder' => 'Masukkan email karyawan']) !!}			
							</div>
						</div>
					</fieldset>

					<fieldset class="form-group">
						<label class="text-sm">TELEPON</label>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-10">
								{!! Form::text('telepon', $karyawan['telepon'], ['class' => 'form-control required', 'placeholder' => 'Masukkan nomor telepon']) !!}			
							</div>
						</div>
					</fieldset>	

					<fieldset class="form-group">
						<label class="text-sm">
							<strong>
								ALAMAT
							</strong>
						</label>
						<!-- <label class="text-sm">Alamat Lengkap</label> -->
						<div class="row">
							@include('templates.alamat.ajax-alamat', ['kecamatan' => $karyawan['alamat']['kecamatan'], 'prefix' => 'alamat'])
						</div>
					</fieldset>

					@if(!is_null($karyawan['id']))
						<fieldset class="form-group">
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-10">
									<!-- @if(!is_null($karyawan['id']))
									<a class="btn btn-default" href="{{ URL::previous() }}" no-data-pjax>Batal</a>
									@endif -->
									<button type="submit" class="btn btn-primary">{{ is_null($karyawan['id']) ? 'Tambahkan' : 'Simpan' }}</button>
								</div>
							</div>
						</fieldset>
					@endif
				</div>
				<div class="col-sm-6">
					@if(is_null($karyawan['id']))
					<fieldset class="form-group">
						<label class="text-sm">
							<strong>
								DATA PENEMPATAN
							</strong>
						</label>
					</fieldset>

					<fieldset class="form-group">
						<label class="text-sm">PASSWORD</label>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-10">
								{!! Form::password('password', ['class' => 'form-control required', 'placeholder' => 'Password Karyawan']) !!}
							</div>
						</div>
					</fieldset>	

					<fieldset class="form-group">
						<label class="text-sm">KONFIRMASI PASSWORD</label>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-10">
								{!! Form::password('confirm_password', ['class' => 'form-control required', 'placeholder' => 'Konfirmasi Password Karyawan']) !!}
							</div>
						</div>
					</fieldset>	

					<fieldset class="form-group">
						<label class="text-sm">KODE KANTOR</label>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-10">
								@include('manajemen.kantor.ajax-kode-pusat', ['kantor' => ['pusat' => $kantor_aktif]])
							</div>
						</div>
					</fieldset>

					<fieldset class="form-group">
						<label class="text-sm">TANGGAL MASUK KERJA</label>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-10">
								{!! Form::text('kantor[tanggal_masuk]', null, ['class' => 'form-control required mask-date-time', 'placeholder' => 'Masukkan tanggal masuk']) !!}			
							</div>
						</div>
					</fieldset>

					<fieldset class="form-group">
						<label class="text-sm">JABATAN</label>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-10">
								<select class="jabatan-select form-control" name="kantor[role]"></select>
							</div>
						</div>
					</fieldset>

					<fieldset class="form-group">
						<label class="text-sm">WEWENANG</label>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-10">
								<select class="scopes-select form-control" name="kantor[scopes][]" multiple="multiple"></select>	
							</div>
						</div>
					</fieldset>
					<fieldset class="form-group">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-10">
								<!-- @if(!is_null($karyawan['id']))
								<a class="btn btn-default" href="{{ URL::previous() }}" no-data-pjax>Batal</a>
								@endif -->
								<button type="submit" class="btn btn-primary">{{ is_null($karyawan['id']) ? 'Tambahkan' : 'Simpan' }}</button>
							</div>
						</div>
					</fieldset>
					@endif
				</div>
			</div>
		{!! Form::close() !!}
	</div>
@endpush

@push('submenu')
	@include('templates.submenu.submenu')
@endpush

@push('js')
	<script type="text/javascript">
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