<div class="form-check">
	<label class="form-check-label pl-0">
		{!! Form::checkbox($name, $value, $is_checked, array_merge(['class' => 'custom-checkbox' . ($errors->has($name)  && $show_error ? 'is-invalid' : '')], ($attributes ? $attributes : []))) !!}
		{!! $label !!}
		@if ($errors->has($name) && $show_error)
			<div class="invalid-feedback">
				@foreach ($errors->get($name) as $v)
					{{ $v }}<br>
				@endforeach
			</div>
		@endif
	</label>
</div>