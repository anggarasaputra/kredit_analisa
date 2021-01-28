@push('logo')
	<img class="card-img-top" src="/images/bg.jpg">
@endpush

@push('title')
	FORGOT PASSWORD
@endpush

@push('body')
	{!! Form::open(['url' => route('forget_password.post'), 'method' => 'post']) !!}
	<p>Please enter your email address below and we will send a link to reset your password to your mail</p>
	{!! Form::bsText('Email', 'email', null, ['placeholder' => 'please enter your email'], session()->flash('alert_danger') ? false : true) !!}
	<a href='{{ route('login') }}' class='btn btn-secondary'>CANCEL</a>
	{!! Form::bsSubmit('RESET PASSWORD', ['class' => 'btn btn-primary float-right']) !!}

	{!! Form::close() !!}
@endpush