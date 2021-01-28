{{-- STATUS --}}
<div class="card-body border border-light border-right-0 border-left-0 border-top-0">
	{!! Form::open(['method' => 'get']) !!}
	<div class="form-row">
		<div class="col-9 col-md-11">
			{!! Form::bsText(null, 'date', $since->format('d-m-Y') . ' to ' . $until->format('d-m-Y'), ['class' => 'daterangepicker form-control bg-white', 'placeholder' => 'please select the date']) !!}
		</div>
		<div class="col-auto">
		{!! Form::bsSubmit('<i class="fa fa-search"></i>', ['class' => 'btn btn-primary']) !!}
		</div>
	</div>
	{!! Form::close() !!}

	@if ($first_analysis && $last_analysis)
		<div class="row">
			<div class="col mb-3">
				<div class="card">
					<div class="card-body text-center">
						<h4 class="card-title">{{ number_format($first_analysis->followers) }} <i class='fa fa-caret-right'></i> {{ number_format($last_analysis->followers) }}</h4>
						<p class="card-text">Followers</p>
					</div>
				</div>
			</div>
			<div class="col mb-3">
				<div class="card">
					<div class="card-body text-center">
						<h4 class="card-title">{{ number_format(count($first_analysis->compare($last_analysis)['unfollowers'])) }}</h4>
						<p class="card-text">Unfollowers</p>
					</div>
				</div>
			</div>
			<div class="col mb-3">
				<div class="card">
					<div class="card-body text-center">
						<h4 class="card-title">{{ number_format(count($first_analysis->compare($last_analysis)['new_followers'])) }}</h4>
						<p class="card-text">New Followers</p>
					</div>
				</div>
			</div>
		</div>
	@else
		<div class='alert alert-info'>
			There's no analysis between these dates
		</div>
	@endif
</div>


