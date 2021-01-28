@inject('regensi', 'Thunderlabid\Territorial\Models\Regensi')
@inject('distrik', 'Thunderlabid\Territorial\Models\Distrik')
@php $kec 	= $distrik->where('territorial_regensi_id', 'like', '35%')->get(); @endphp
@php $kab 	= $regensi->where('territorial_provinsi_id', 'like', '35%')->get(); @endphp
<div class="col-auto col-md-12">
	{!! Form::vText('Jalan', $prefix.'[alamat]'.$suffix, $alamat['alamat'], ['class' => 'alamat form-control border-input w-100 text-info pb-1 '.$inline, 'placeholder' => 'JL. Adi Sucipto Gang 2 Nomor 11'], true) !!}
</div>
{{--  <div class="row ml-0 mr-0">  --}}
	<div class="col-auto col-md-12">
		{!! Form::vText('RT', $prefix.'[rt]'.$suffix, $alamat['rt'], ['class' => 'rt form-control mask-rt-rw border-input w-25 text-info pb-1 '.$inline, 'placeholder' => '001'], true) !!}
	</div>
	<div class="col-auto col-md-12">
		{!! Form::vText('RW', $prefix.'[rw]'.$suffix, $alamat['rw'], ['class' => 'rw form-control mask-rt-rw border-input w-25 text-info pb-1 '.$inline, 'placeholder' => '002'], true) !!}
	</div>
{{--  </div>  --}}

<div class="col-auto col-md-12">
	{!! Form::vText('Desa/Dusun', $prefix.'[kelurahan]'.$suffix, $alamat['kelurahan'], ['class' => 'kelurahan form-control border-input w-50 text-info pb-1 '.$inline, 'placeholder' => 'MERGAN'], true) !!}
</div>

<div class="col-auto col-md-12">
	<div class="row form-group">
		<div class="col-sm-4 text-right">
			{!! Form::label('', 'KECAMATAN', ['class' => 'text-uppercase mt-1 mb-1']) !!}
		</div>
		<div class="col text-left">
			<!-- <select class="ajax-teritori-kecamatan custom-select {{$inline}} kecamatan form-control inline-edit required border-input w-75 text-info pb-1 @if($errors->has($prefix.'[kecamatan]'.$suffix)) is-invalid @endif" name="{{ $prefix }}[kecamatan]{{ $suffix }}" style="width:100%">
				<option value="{{ $kecamatan }}">{{$kecamatan}}</option>
			</select> -->
			<select class=" {{$inline}} kecamatan form-control required @if($errors->has($prefix.'[kecamatan]'.$suffix)) is-invalid @endif" name="{{$prefix}}[kecamatan]{{$suffix}}" style="width:100%">
				@foreach($kec as $k => $v)
					<option value="{{$v['nama']}}" @if($kecamatan==$v['nama']) selected @endif>{{$v['nama']}}</option>
				@endforeach
			</select>

			@if ($errors->has($prefix.'[kecamatan]'.$suffix))
				<div class="invalid-feedback">
					@foreach ($errors->get($name) as $v)
						{{ $v }}<br>
					@endforeach
				</div>
			@endif
		</div>
	</div>
</div>

<div class="col-auto col-md-12">
	<div class="row form-group">
		<div class="col-sm-4 text-right">
			{!! Form::label('', 'KOTA/KABUPATEN', ['class' => 'text-uppercase mt-1 mb-1']) !!}
		</div>
		<div class="col text-left">
			<!-- <select class="ajax-teritori-kota custom-select {{$inline}} kota form-control required border-input w-75 text-info pb-1  @if($errors->has($prefix.'[kota]'.$suffix)) is-invalid @endif" name="{{$prefix}}[kota]{{$suffix}}" style="width:100%">
				<option value="{{$kota}}">{{$kota}}</option>
			</select> -->
			<select class=" {{$inline}} kota form-control required @if($errors->has($prefix.'[kota]'.$suffix)) is-invalid @endif" name="{{$prefix}}[kota]{{$suffix}}" style="width:100%">
				@foreach($kab as $k => $v)
					<option value="{{$v['nama']}}" @if($kota==$v['nama']) selected @endif>{{$v['nama']}}</option>
				@endforeach
			</select>

			@if ($errors->has($prefix.'[kota]'.$suffix))
				<div class="invalid-feedback">
					@foreach ($errors->get($name) as $v)
						{{ $v }}<br>
					@endforeach
				</div>
			@endif
		</div>
	</div>
</div>

@push('js')
<!-- 	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

	<script type="text/javascript">
		$(".ajax-teritori-kecamatan").select2({
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

		$(".ajax-teritori-kota").select2({
			ajax: {
				url: "{{route('regensi.index')}}",
				data: function (params) {
				var kecamatan = $('.ajax-teritori-kecamatan').select2('data');
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
	</script> -->
@endpush
