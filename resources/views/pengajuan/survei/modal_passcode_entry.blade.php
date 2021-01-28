@component ('bootstrap.modal', ['id' => 'modal_passcode_entry', 'form' => true, 'method' => 'post', 'url' => '#'])
	@slot ('title')
		Isi Passcode
	@endslot

	@slot ('body')
		<p>Untuk persentasi bank > 50%, harap mengisi passcode</p>

		{!! Form::bsText('Passcode', 'passcode_oke', 'PASSCODE', ['placeholder' => 'passcode', 'id' => 'passcode_oke']) !!}
	@endslot

	@slot ('footer')
		<a href="#" data-dismiss="modal" id="passcode_batal" class="btn btn-link text-secondary">Batal</a>
		<a href="#" data-dismiss="modal" id="passcode_simpan" class="btn btn-primary">Simpan</a>
	@endslot
@endcomponent
