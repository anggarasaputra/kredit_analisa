@push('logo')
	<img class="card-img-top" src="/images/bg.jpg">
@endpush

@push('title')
	SIGN UP
@endpush

@push('body')
	{!! Form::open(['url' => route('register.post'), 'method' => 'post']) !!}
	{!! Form::bsText('Name', 'name', null, ['placeholder' => 'please enter your name'], session()->flash('alert_danger') ? false : true) !!}
	{!! Form::bsText('Email', 'email', null, ['placeholder' => 'please enter your email'], session()->flash('alert_danger') ? false : true) !!}
	{!! Form::bsPassword('Password', 'password', ['placeholder' => 'password must be at least 6 characters'], session()->flash('alert_danger') ? false : true) !!}
	{!! Form::bsPassword('Password Confirmation', 'password_confirmation', ['placeholder' => 'please reenter your password'], session()->flash('alert_danger') ? false : true) !!}
	<a href='{{ route('login') }}' class='btn btn-secondary'>CANCEL</a>
	{!! Form::bsSubmit('REGISTER', ['class' => 'btn btn-primary float-right']) !!}

	{!! Form::close() !!}
@endpush