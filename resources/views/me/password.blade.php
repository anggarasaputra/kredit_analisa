@push('main')
	<div class="container bg-white bg-shadow p-4">
		<div class="row">
			<div class="col">
				<h4 class='mb-4 text-style text-secondary'>
					<span class="text-uppercase">GANTI PASSWORD</span> 
				</h4>
			</div>
		</div>
		
		<div class="clearfix">&nbsp;</div>
		<div class="row p-b-sm">
			<div class="col-sm-6">
					{!! Form::open(['url' => route('password.post', ['kantor_aktif_id' => $kantor_aktif['id']])]) !!}
					{!! Form::hidden('kantor_aktif_id', $kantor_aktif['id']) !!}
					<fieldset class="form-group">
						<label class="text-sm">Password</label>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-10">
								{!! Form::password('password', ['class' => 'form-control required', 'placeholder' => 'Password Anda']) !!}
							</div>
						</div>
					</fieldset>	

					<fieldset class="form-group">
						<label class="text-sm">Konfirmasi Password</label>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-10">
								{!! Form::password('confirm_password', ['class' => 'form-control required', 'placeholder' => 'Konfirmasi Password Anda']) !!}
							</div>
						</div>
					</fieldset>	

					<fieldset class="form-group">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-10">
								<button type="submit" class="btn btn-primary">Simpan</button>
							</div>
						</div>
					</fieldset>
				{!! Form::close() !!}

			</div>
		</div>
	</div>

@endpush


@push('submenu')
	@include('templates.submenu.submenu')
@endpush
