@component ('bootstrap.modal', ['id' => 'passcode_baru', 'form' => true, 'method' => 'post', 'url' => route('pengajuan.passcode.store', ['kantor_aktif_id' => $kantor_aktif['id']])])
	@slot ('title')
		Passcode Baru
	@endslot

	@slot ('body')
		<p>Untuk membuat passcode, harap melengkapi data berikut!</p>

		<div class="form-group">
			{!! Form::label('', 'Nomor Pengajuan', ['class' => 'text-uppercase mb-1']) !!}
			<select class="ajax-pengajuan custom-select form-control required" name="pengajuan_id" style="width:100%">
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
		$(".ajax-pengajuan").select2({
			ajax: {
				url: "{{route('pengajuan.pengajuan.ajax')}}",
				data: function (params) {
						return {
							q: params.term, // search term
							kantor_aktif_id: "{{$kantor_aktif['id']}}",
							status: "survei" // search term
						};
					},
				processResults: function (data, params) {
					return {
						results:  $.map(data, function (pengajuan) {
							return {
								text: pengajuan.id,
								id: pengajuan.id
							}
						})
					};
				},
			}
		});
		
		//MODAL PARSE DATA ATTRIBUTE//
		$("a.modal_passcode").on("click", parsingDataAttributeModalAnalisa);

		function parsingDataAttributeModalAnalisa(){
			$('#passcode_baru').find('form').attr('action', $(this).attr("data-action"));
		}
	</script>
@endpush