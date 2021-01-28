{{-- STATUS --}}
<div class="card-body border border-light border-right-0 border-left-0 border-top-0">
	<div class="row">
		<div class="col text-center">
			<h5>
				{{ number_format($statistics->last()->media) }}
				@if ($statistics->last()->media > $statistics->first()->media)
					<i class='fa fa-caret-up text-success'></i>
				@elseif ($statistics->last()->media < $statistics->first()->media)
					<i class='fa fa-caret-down text-danger'></i>
				@endif
			</h5>
			MEDIA
		</div>
		<div class="col text-center">
			<h5>
				{{ number_format($statistics->last()->followers) }}
				@if ($statistics->last()->followers > $statistics->first()->followers)
					<i class='fa fa-caret-up text-success'></i>
				@elseif ($statistics->last()->followers < $statistics->first()->followers)
					<i class='fa fa-caret-down text-danger'></i>
				@endif
			</h5>
			FOLLOWERS
		</div>
		<div class="col text-center">
			<h5>
				{{ number_format($statistics->last()->follows) }}
				@if ($statistics->last()->follows > $statistics->first()->follows)
					<i class='fa fa-caret-up text-success'></i>
				@elseif ($statistics->last()->follows < $statistics->first()->follows)
					<i class='fa fa-caret-down text-danger'></i>
				@endif
			</h5>
			FOLLOWS
		</div>
	</div>
</div>

{{-- FOLLOWERS --}}
@if ($statistics)
	<div class="card-body border border-light border-right-0 border-left-0 border-top-0">
		<h4 class="card-title">GROWTH STATISTICS</h4>
		<div class="row">
			<div class="col">
			  	<canvas class='chartjs' data-chart-type='line' 
						data-chart-label='{{ json_encode($chart_label) }}'
						data-chart-dataset='{{ json_encode($chart_dataset) }}'></canvas>
			</div>
		</div>
	</div>
@else
	<div class='alert alert-info'>
		No data has been fetched for this account. Please come back later
	</div>
@endif