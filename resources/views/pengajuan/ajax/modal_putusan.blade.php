@component ('bootstrap.modal', ['id' => 'ajukan-putusan', 'form' => true, 'method' => 'post', 'url' => route('pengajuan.pengajuan.assign_putusan', ['kantor_aktif_id' => $kantor_aktif['id'], 'status' => $status])])
	@slot ('title')
		Ajukan Ke Komite Kredit
	@endslot

	@slot ('body')
		<p>Untuk mengajukan ke komite kredit, harap mengisi password Anda!</p>

		{!! Form::bsPassword('password', 'password', ['placeholder' => 'Password']) !!}
	@endslot

	@slot ('footer')
		<a href="#" data-dismiss="modal" class="btn btn-link text-secondary">Batal</a>
		{!! Form::bsSubmit('Simpan', ['class' => 'btn btn-primary']) !!}
	@endslot
@endcomponent

@push('js')
	<script type="text/javascript">
		//MODAL PARSE DATA ATTRIBUTE//
		$("a.modal_putusan").on("click", parsingDataAttributeModalPutusan);

		function parsingDataAttributeModalPutusan(){
			$('#ajukan-putusan').find('form').attr('action', $(this).attr("data-action"));
		}
	</script>
@endpush