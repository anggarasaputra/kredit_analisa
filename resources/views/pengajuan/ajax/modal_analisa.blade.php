@component ('bootstrap.modal', ['id' => 'lanjut-analisa', 'form' => true, 'method' => 'post', 'url' => route('pengajuan.pengajuan.assign_analisa', ['kantor_aktif_id' => $kantor_aktif['id'], 'status' => $status])])
	@slot ('title')
		Lanjutkan Analisa
	@endslot

	@slot ('body')
		<p>Untuk melanjutkan analisa, harap melengkapi data berikut!</p>

		<div class="form-group">
			{!! Form::label('', 'ANALIS', ['class' => 'text-uppercase mb-1']) !!}
			<select class="ajax-analis custom-select form-control required" name="analis[nip]" style="width:100%">
				<option value="">Pilih</option>
			</select>
		</div>
		{!! Form::bsPassword('password', 'password', ['placeholder' => 'Password']) !!}
	@endslot

	@slot ('footer')
		<a href="#" data-dismiss="modal" class="btn btn-link text-secondary">Batal</a>
		{!! Form::bsSubmit('Simpan', ['class' => 'btn btn-primary']) !!}
	@endslot
@endcomponent

@push('js')
	<script type="text/javascript">
		//ASSIGN SURVEYOR
		$(".ajax-analis").select2({
			ajax: {
				url: "{{route('manajemen.karyawan.ajax')}}",
				data: function (params) {
						return {
							q: params.term, // search term
							kantor_aktif_id: "{{$kantor_aktif['id']}}", // search term
							scope: 'analisa'
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
		$("a.modal_analisa").on("click", parsingDataAttributeModalAnalisa);

		function parsingDataAttributeModalAnalisa(){
			$('#lanjut-analisa').find('form').attr('action', $(this).attr("data-action"));
		}
	</script>
@endpush