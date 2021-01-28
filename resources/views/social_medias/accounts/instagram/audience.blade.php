{{-- DATE --}}
<div class="card-body border border-light border-right-0 border-left-0 border-top-0 mt-3">
	{!! Form::open(['method' => 'get']) !!}
	<div class="form-row">
		<div class="col-9 col-md-11">{!! Form::bsText(null, 'date', $since->format('d-m-Y') . ' to ' . $until->format('d-m-Y'), ['class' => 'daterangepicker form-control bg-white', 'placeholder' => 'please select the date']) !!}</div>
		<div class="col-auto">{!! Form::bsSubmit('<i class="fa fa-search"></i>', ['class' => 'btn btn-primary']) !!}</div>
	</div>
	{!! Form::close() !!}
</div>

{{-- DATA --}}
<div class='card-body'>
	<h3>MOST ACTIVE AUDIENCE</h3>
	<div class="alert alert-info" role="alert">
	    <strong>Wait for it!</strong> Coming soon
	</div>
</div>

<div class='card-body'>
	<h3>MOST ENGAGED USER</h3>
	<div class="alert alert-info" role="alert">
	    <strong>Wait for it!</strong> Coming soon
	</div>
</div>

<div class='card-body'>
	<h3>SUCCESFULLY ENGAGED AUDIENCE</h3>
	<div class="alert alert-info" role="alert">
	    <strong>Wait for it!</strong> Coming soon
	</div>
</div>