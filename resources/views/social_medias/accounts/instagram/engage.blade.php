<div class='card-body'>
	{!! Form::open(['method' => 'get']) !!}
	{!! Form::hidden('active', request()->input('active')) !!}
	<div class="form-row">
		<div class="col-auto">{!! Form::bsSelect(null, 'type', ['' => "Semua"] + $engage_type, null, ['placeholder' => ''], false) !!}</div>
		<div class="col-auto">{!! Form::bsText(null, 'q', '', [], false) !!}</div>
		<div class='col-auto'>
			{!! Form::bsSubmit('<i class="fa fa-search"></i>', ['class' => 'btn btn-primary']) !!}
		</div>
		<div class='col-auto ml-auto'>
			<a href='' class='btn btn-primary' data-toggle='modal' data-target='#addengagementModal'><i class='fa fa-plus'></i></a>
		</div>

	</div>
	{!! Form::close() !!}

	{{-- TAB --}}
	<ul class='nav nav-tabs'>
		<li class='nav-item'><a href='{{ route('social_media.instagram.engage', ['account_id' => $account->id] + array_except($filters, ['active']) + ['active' => 1]) }}' class='nav-link {{ request()->input('active') > 0 || !request()->has('active') ? 'active' : '' }}'>Active</a></li>
		<li class='nav-item'><a href='{{ route('social_media.instagram.engage', ['account_id' => $account->id] + array_except($filters, ['active']) + ['active' => 0]) }}' class='nav-link {{ request()->input('active') == 0 && request()->has('active') ? 'active' : '' }}'>Nonactive</a></li>
	</ul>

	{{-- DATA --}}
	<table class="table table-responsive">
		<thead>
			<tr>
				<th>Engage</th>
				<th>Last Run</th>
				<th>Added On</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@php
				$type = '';
			@endphp

			@forelse ($ig_engages as $ig_engage)
				@if ($type != $ig_engage->type)
					@php
						$type = $ig_engage->type;
					@endphp
					<tr class='bg-light'>
						<th colspan='5'>{{ $engage_type[$type] }}</th>
					</tr>
				@endif
				<tr>
					<td>{{ $ig_engage->value }}</td>
					<td>{{ $ig_engage->executed_at ? $ig_engage->executed_at->diffForHumans() : '-' }}</td>
					<td>{{ $ig_engage->created_at->diffForHumans() }}</td>
					<td>
						@if ($ig_engage->is_active)
							<a href='{{ route('social_media.instagram.engage.activate', ['account_id' => $account->id, 'engage_id' => $ig_engage->id, 'is_active' => 0]) }}'><i class='fa fa-toggle-on text-success fa-2x'></i></a>
						@else
							<a href='{{ route('social_media.instagram.engage.activate', ['account_id' => $account->id, 'engage_id' => $ig_engage->id, 'is_active' => 1]) }}'><i class='fa fa-toggle-off text-secondary fa-2x'></i></a>
						@endif
					</td>
				</tr>
			@empty
				<tr>
					<td colspan='10'>You don't have any engagement for this account</td>
				</tr>
			@endforelse
		</tbody>
	</table>

	{!! $ig_engages->appends($filters)->links('vendor.pagination.bootstrap-4') !!}
</div>

@push('js')
	<div class="modal fade" id='addengagementModal'>
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Add engagement</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					{!! Form::open(['method' => 'post', 'url' => route('social_media.instagram.engage.post', ['id' => $account->id])]) !!}
					<div class='form-row'>
						<div class='col-auto'>{!! Form::bsSelect(null, 'type', $engage_type, null, ['placeholder' => '']) !!}</div>
						<div class='col-auto'>{!! Form::bsText(null, 'engage', '', [], true) !!}</div>
						<div class='col-auto'>{!! Form::bsSubmit('Add', ['class' => 'btn btn-primary']) !!}</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@endpush

@push('js')
	@if ($errors->has('engagement'))
		<script>
			$(document).ready(function(){
				$('#addengagementModal').modal('show');
			});
		</script>
	@endif

	<script>
		$('#addengagementModal').on('show.bs.modal', function(e){
			if ($(e.relatedTarget).data('toggle') == 'modal')
			{
				$(this).find('input[name=engagement]').val('');
				$(this).find('input[name=engagement]').removeClass('is-invalid');
			}
		});

		$('#addengagementModal').on('shown.bs.modal', function(e){
			$(this).find('input[name=engagement]').focus();
		});
	</script>
@endpush