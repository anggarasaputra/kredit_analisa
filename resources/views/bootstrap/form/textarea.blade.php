<div class="form-group">
	@if ($label)
		{!! Form::label('', $label, ['class' => 'text-uppercase mb-1']) !!}
	@endif

	{!! Form::textarea($name, $value, array_merge(['class' => 'form-control ' . ($errors->has($name)  && $show_error ? 'is-invalid' : '')], ($attributes ? $attributes : []))) !!}

	@if ($helper_text)
		<small class="form-text text-muted">{!! $helper_text !!}</small>
	@endif
	
	@if ($errors->has($name) && $show_error)
		<div class="invalid-feedback">
			@foreach ($errors->get($name) as $v)
				{{ $v }}<br>
			@endforeach
		</div>
	@endif
</div>