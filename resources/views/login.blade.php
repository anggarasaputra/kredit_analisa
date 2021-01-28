@push('logo')
	<img class="card-img-top" src="/images/background.jpg">
@endpush

@push('title')
	LOGIN
@endpush

@push('body')
	{!! Form::open(['url' => route('login.post'), 'method' => 'post']) !!}
	{!! Form::bsText(null, 'nip', null, ['placeholder' => 'nip', 'class' => 'setfocus form-control']) !!}
	{!! Form::bsPassword(null, 'password', ['placeholder' => 'password']) !!}
	<!-- <a href='{{ route('forget_password') }}'>Forget my password</a> -->
	{!! Form::bsSubmit('LOGIN', ['class' => 'btn btn-primary float-right']) !!}

	{!! Form::close() !!}
	<p class='pt-5'>
		<hr>
	</p>
	<p class='text-center'>
	</p>
@endpush

@push ('js')
	<script>
		$(document).ready(function(){
			$('.setfocus').focus();
		});
	</script>
@endpush
