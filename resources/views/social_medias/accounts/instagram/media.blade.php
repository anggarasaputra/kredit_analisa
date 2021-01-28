{{-- DATE --}}
<div class="card-body border border-light border-right-0 border-left-0 border-top-0 mt-3">
	{!! Form::open(['method' => 'get']) !!}
	<div class="form-row">
		<div class="col-9 col-md-11">{!! Form::bsText(null, 'date', $since->format('d-m-Y') . ' to ' . $until->format('d-m-Y'), ['class' => 'daterangepicker form-control bg-white', 'placeholder' => 'please select the date']) !!}</div>
		<div class="col-auto">{!! Form::bsSubmit('<i class="fa fa-search"></i>', ['class' => 'btn btn-primary']) !!}</div>
	</div>
	{!! Form::close() !!}
</div>

{{-- MEDIA DISTRIBUTION --}}
<div class='card-body border border-light border-right-0 border-left-0 border-top-0'>
	<div class="row">
		<div class="col text-center">
			<h5>{{ number_format($total_image) }}</h5>
			PHOTO
		</div>
		<div class="col text-center">
			<h5>{{ number_format($total_video) }}</h5>
			VIDEO
		</div>
	</div>
</div>


<div class='card-body'>
	<h3>MOST LIKED MEDIA</h3>
	<table class="table table-responsive table-hover w-100 mw-100" width="100%">
		<thead>
			<tr>
				<th width='5'>#</th>
				<th>Media</th>
				<th class='text-right'>Likes <i class='fa fa-caret-down'></i></th>
				<th class='text-right'>Comments</th>
				<th>Posted At</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($most_liked_media as $k => $x)
				<tr>
					<td>{{ $k+1 }}</td>
					<td><img src='{{ $x->url }}' height='150'></td>
					<td class='text-right'>{{ number_format($x->likes) }}</td>
					<td class='text-right'>{{ number_format($x->comments) }}</td>
					<td>{{ $x->posted_at->format('d-M-Y [H:i]') }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>



<div class='card-body'>
	<h3>MOST COMMENTED MEDIA</h3>
</div>

<table class="table table-responsive table-hover w-100 mw-100" width="100%">
	<thead>
		<tr>
			<th width='5'>#</th>
			<th>Media</th>
			<th class='text-right'>Likes</th>
			<th class='text-right'>Comments <i class='fa fa-caret-down'></i></th>
			<th>Posted At</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($most_commented_media as $k => $x)
			<tr>
				<td>{{ $k+1 }}</td>
				<td><img src='{{ $x->url }}' height='150'></td>
				<td class='text-right'>{{ number_format($x->likes) }}</td>
				<td class='text-right'>{{ number_format($x->comments) }}</td>
				<td>{{ $x->posted_at->format('d-M-Y [H:i]') }}</td>
			</tr>
		@endforeach
	</tbody>
</table>