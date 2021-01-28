<div class="modal fade" id="{{ $id }}">
	<div class="modal-dialog " role="document">
		<div class="modal-content">
			@isset ($form)
				{!! Form::open(['method' => $method ? $method : 'post', 'id' => 'form-'.$id ]) !!}
			@endisset

			@if ($title || $body || $footer)
				@if ($title)
					<div class="modal-header">
						<h4 class="modal-title">{!! $title !!}</h4>
						<button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							<span class="sr-only">Close</span>
						</button>
					</div>
				@endif

				@if ($body)
					<div class="modal-body">
						{!! $body !!}
					</div>
				@endif

				@if ($footer)
					<div class="modal-footer">
						{!! $footer !!}
					</div>
				@endif
			@endif

			{!! $slot !!}

			@isset ($form)
				{!! Form::close() !!}
			@endisset
		</div>
	</div>
</div>