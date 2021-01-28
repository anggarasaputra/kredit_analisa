@push('main')
	<div class="container bg-white bg-shadow p-4">
		<div class="row">
			<div class="col">
				<h4 class='mb-4 text-style text-secondary'>
					<span class="text-uppercase">{{$title}}</span> 
				</h4>
			</div>
		</div>
		
		<div class="clearfix">&nbsp;</div>
		<div class="row p-b-sm">
			<div class="col-sm-6">
				@if(is_null($kantor['id']))
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-10">
						<h5 class="text-uppercase">Input Data</h5>
						<p>Isi form dibawah ini untuk menambahkan kantor baru.</p>
						<br/>
					</div>
				</div>
				@endif

				@if(is_null($kantor['id']))
					{!! Form::open(['url' => route('manajemen.kantor.store', ['kantor_aktif_id' => $kantor_aktif['id']])]) !!}
				@else
					{!! Form::open(['url' => route('manajemen.kantor.update', ['id' => $kantor['id'], 'kantor_aktif_id' => $kantor_aktif['id']]), 'method' => 'PATCH']) !!}
				@endif
					<fieldset class="form-group">
						<label class="text-sm">Nama kantor</label>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-10">
								{!! Form::text('nama', $kantor['nama'], ['class' => 'form-control required', 'placeholder' => 'Masukkan nama kantor']) !!}			
							</div>
						</div>
					</fieldset>

					<fieldset class="form-group">
						<label class="text-sm">Tipe Kantor</label>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-10">
								{!! Form::select('tipe', ['cabang' => 'Cabang', 'pusat' => 'Pusat'], $kantor['tipe'], ['class' => 'form-control required', 'placeholder' => 'Masukkan tipe kantor']) !!}			
							</div>
						</div>
					</fieldset>
					<fieldset class="form-group">
						<label class="text-sm">Jenis Kantor</label>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-10">
								{!! Form::select('jenis', ['bpr' => 'BPR', 'koperasi' => 'Koperasi'], $kantor['jenis'], ['class' => 'form-control required', 'placeholder' => 'Masukkan jenis kantor']) !!}			
							</div>
						</div>
					</fieldset>

					<fieldset class="form-group">
						<label class="text-sm">Kode Pusat</label>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-10">
								@include('manajemen.kantor.ajax-kode-pusat')
							</div>
						</div>
					</fieldset>

					<fieldset class="gllpLatlonPicker">
						<label class="text-sm">Alamat Lengkap</label>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-10">
								<div class="input-group">
									{!! Form::text('alamat', $kantor['alamat'], [
										'class' => 'form-control gllpSearchField required', 
										'placeholder' => 'Masukkan alamat',
										'onFocus' => 'geolocate()',
										'id' => 'autocomplete'
									]) !!}
									<span class="input-group-btn">
										<button class="btn btn-default gllpSearchButton" type="button" style="padding-bottom: 9px;">
											<i class="fa fa-search" aria-hidden="true"></i>
										</button>
									</span>
								</div>							
							</div>
						</div>
						<br/>
						{{--
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-10">
								<label class="text-sm">Lokasi Dalam Peta</label>
							</div>
						</div>
						--}}
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-10">
								<div class="gllpMap">
									Loading Google Maps
									<i class="fa fa-circle-o-notch fa-spin fa-fw"></i>
								</div>
							</div>
						</div>
						<br/>
						{!! Form::hidden('latitude', $kantor['latitude'], ['class' => 'gllpLatitude']) !!}
						{!! Form::hidden('longitude', $kantor['longitude'], ['class' => 'gllpLongitude']) !!}

						<input type="hidden" name="latitude" class="gllpLatitude" value="{{ $kantor['latitude'] }}" />
						<input type="hidden" name="longitude" class="gllpLongitude" value="{{ $kantor['longitude'] }}" />
						<input type="hidden" class="gllpZoom"/>
					</fieldset>

					<fieldset class="form-group">
						<label class="text-sm">Telepon</label>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-10">
								{!! Form::text('telepon', $kantor['telepon'], ['class' => 'form-control required', 'placeholder' => 'Masukkan nomor telepon']) !!}			
							</div>
						</div>
					</fieldset>	

					<fieldset class="form-group">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-10">
								<!-- @if(!is_null($kantor['id']))
								<a class="btn btn-default" href="{{ URL::previous() }}" no-data-pjax>Batal</a>
								@endif -->
								<button type="submit" class="btn btn-primary">{{ is_null($kantor['id']) ? 'Tambahkan' : 'Simpan' }}</button>
							</div>
						</div>
					</fieldset>
				{!! Form::close() !!}

			</div>

			@if(is_null($kantor['id']))
				<div class="col-sm-6 hidden-xs">
					<div class="row">
						<div class="col-xs-12">
							<h5 class="text-uppercase">Impor Data CSV</h5>
							<p class="text-muted">
								Impor Data CSV mudahkan Anda untuk melakukan proses input data kantor dalam jumlah banyak. Anda hanya perlu mengikuti 3 langkah mudah berikut.
							</p>
							<br/>
							<p class="p-b-md">
								<strong>1. Persiapkan Template</strong><br/><span class="text-muted">
								Tenang, kami sudah menyiapkan template yang siap Anda gunakan dengan mengunduh tautan dibawah ini.<br/> 
								</span>
								<a target="_blank" href="{{ route('download', ['filename' => 'template_kantor.csv']) }}" no-data-pjax>
									<i class="fa fa-download" aria-hidden="true"></i>
									Mulai Unduh Template
								</a>
							</p>
							<p class="p-b-md">
								<strong>2. Isikan Data</strong><br/><span class="text-muted">
								Setelah template ter-unduh, buka dokumen dan isikan data kantor sesuai dengan inputan yang telah tersedia. Setelah Anda selesai mengisikan data, simpan dokumen tersebut.
								</span>
							</p>
							<p class="p-b-md">
								<strong>3. Impor Data</strong><br/><span class="text-muted">
								Pilih dokumen yang akan Anda unggah pada section <strong>Upload File</strong>. Tekan Impor Data, dan tunggu proses hingga selesai.
								</span>
							</p>						
						</div>
					</div>		

					<div class="clearfix">&nbsp;</div>
					{!! Form::open(['url' => route('manajemen.kantor.batch', ['kantor_aktif_id' => $kantor_aktif['id']]), 'files' => true]) !!}
					
						<fieldset class="form-group">
							<label class="text-sm">Upload File</label>
							<div class="row">
								<div class="col-xs-12 p-b-md">
									{!! Form::file('kantor') !!}
								</div>
								<div class="col-xs-12">
									{!! Form::submit('Impor Data', ['class' => 'btn btn-primary']) !!}
								</div>
							</div>
						</fieldset>

					{!! Form::close() !!}
				</div>
			@endif
		</div>
	</div>

@endpush


@push('submenu')
	@include('templates.submenu.submenu')
@endpush

@push('js')
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDhGU-wSjC89hoHPStx7bYGOjHpULJQHGI&libraries=places&callback=initAutocomplete" async defer></script>        

	// This example displays an address form, using the autocomplete feature
	// of the Google Places API to help users fill in the information.

	// This example requires the Places library. Include the libraries=places
	// parameter when you first load the API. For example:
	// <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places"></script>

	<script type="text/javascript">
	var placeSearch, autocomplete;
	var componentForm = {
	street_number: 'short_name',
	route: 'long_name',
	locality: 'long_name',
	administrative_area_level_1: 'short_name',
	country: 'long_name',
	postal_code: 'short_name'
	};

	function initAutocomplete() {
	// Create the autocomplete object, restricting the search to geographical
	// location types.
	autocomplete = new google.maps.places.Autocomplete(
		/** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
		{types: ['geocode']});

	// When the user selects an address from the dropdown, populate the address
	// fields in the form.
	autocomplete.addListener('place_changed', fillInAddress);
	}

	function fillInAddress() {
	// Get the place details from the autocomplete object.
	var place = autocomplete.getPlace();

	for (var component in componentForm) {
		document.getElementById(component).value = '';
		document.getElementById(component).disabled = false;
	}

	// Get each component of the address from the place details
	// and fill the corresponding field on the form.
	for (var i = 0; i < place.address_components.length; i++) {
		var addressType = place.address_components[i].types[0];
		if (componentForm[addressType]) {
			var val = place.address_components[i][componentForm[addressType]];
			document.getElementById(addressType).value = val;
		}
	}
	}

	// Bias the autocomplete object to the user's geographical location,
	// as supplied by the browser's 'navigator.geolocation' object.
	function geolocate() {
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function(position) {
				var geolocation = {
					lat: position.coords.latitude,
					lng: position.coords.longitude
				};
				var circle = new google.maps.Circle({
					center: geolocation,
					radius: position.coords.accuracy
				});
				autocomplete.setBounds(circle.getBounds());
			});
		}
	}

	$(window).load( function() {
		window.mapInit();
	});	
	</script>
@endpush