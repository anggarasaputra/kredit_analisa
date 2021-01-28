<select class="ajax-teritori-kecamatan custom-select form-control required" name="kecamatan" style="width:100%">
	<option value="{{$kecamatan}}">{{$kecamatan}}</option>
</select>

<select class="ajax-teritori-kota custom-select form-control required" name="kota" style="width:100%">
	<option value="{{$kota}}">{{$kota}}</option>
</select>

@push('js')
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
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
	</script>
@endpush
