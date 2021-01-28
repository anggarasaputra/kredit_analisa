<select class="kode-pusat-kantor form-control required" name="kantor_id" style="width:100%;">
	<option value="{{$kantor['pusat']['id']}}">{{$kantor['pusat']['nama']}}</option>
</select>

@push('js')
	<script type="text/javascript">
		$(".kode-pusat-kantor").select2({
			ajax: {
				url: "{{route('manajemen.kantor.ajax', ['kantor_aktif_id' => $kantor_aktif['id']])}}",
				data: function (params) {
						return {
							q: params.term // search term
						};
					},
				processResults: function (data, params) {
					return {
						results:  $.map(data, function (users) {
							return {
								text: users.nama,
								id: users.id
							}
						})
					};
				},
			}
		});
	</script>
@endpush
