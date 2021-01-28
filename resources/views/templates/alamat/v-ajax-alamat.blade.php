@inject('regensi', 'Thunderlabid\Territorial\Models\Regensi')
@inject('distrik', 'Thunderlabid\Territorial\Models\Distrik')
@php $kec 	= $distrik->where('territorial_regensi_id', 'like', '35%')->get(); @endphp
@php $kab 	= $regensi->where('territorial_provinsi_id', 'like', '35%')->get(); @endphp

<div class="col-auto col-md-12">
	{!! Form::vText('Jalan', $prefix.'[alamat]'.$suffix, $alamat['alamat'], ['class' => $class.' alamat form-control inline-edit text-info', 'placeholder' => 'JL. Adi Sucipto Gang 2 Nomor 11']) !!}
</div>
<div class="col-auto col-md-12">
	{!! Form::vText('RT', $prefix.'[rt]'.$suffix, $alamat['rt'], ['class' => $class.' rt form-control inline-edit mask-rt-rw text-info', 'placeholder' => '001']) !!}
</div>
<div class="col-auto col-md-12">
	{!! Form::vText('RW', $prefix.'[rw]'.$suffix, $alamat['rw'], ['class' => $class.' rw form-control inline-edit mask-rt-rw text-info', 'placeholder' => '002']) !!}
</div>
<div class="col-auto col-md-12">
	{!! Form::vText('Desa/Dusun', $prefix.'[kelurahan]'.$suffix, $alamat['kelurahan'], ['class' => $class.' kelurahan form-control inline-edit text-info', 'placeholder' => 'MERGAN']) !!}
</div>

<div class="col-auto col-md-12">
	<div class="row form-group">
		<div class="col-sm-4 text-right">
			{!! Form::label('', 'KEC', ['class' => 'text-uppercase mb-1']) !!}
		</div>
		<div class="col-sm-8">
			<!-- <select class="ajax-teritori-kecamatan custom-select {{$class}} kecamatan form-control inline-edit required" name="{{$prefix}}[kecamatan]{{$suffix}}" style="width:100%">
				<option value="{{$kecamatan}}">{{$kecamatan}}</option>
			</select> -->
			<select class=" {{$class}} kecamatan form-control inline-edit required" name="{{$prefix}}[kecamatan]{{$suffix}}">
				@foreach($kec as $k=>$v)
					<option value="{{$v['nama']}}" @if($kecamatan==$v['nama']) selected @endif>{{$v['nama']}}</option>
				@endforeach
			</select>
		</div>
	</div>
</div>

<div class="col-auto col-md-12">
	<div class="row form-group">
		<div class="col-sm-4 text-right">
			{!! Form::label('', 'KOTA/KAB', ['class' => 'text-uppercase mb-1']) !!}
		</div>
		<div class="col-sm-8">
			<!-- <select class="ajax-teritori-kota custom-select {{$class}} kota form-control inline-edit required" name="{{$prefix}}[kota]{{$suffix}}" style="width:100%">
				<option value="{{$kota}}">{{$kota}}</option>
			</select> -->
			<select class=" {{$class}} kota form-control inline-edit required" name="{{$prefix}}[kota]{{$suffix}}">
				@foreach($kab as $k=>$v)
					<option value="{{$v['nama']}}" @if($kota==$v['nama']) selected @endif>{{$v['nama']}}</option>
				@endforeach
			</select>
		</div>
	</div>
</div>

@push('js')
	<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
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
						return {
							q: params.term // search term
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
