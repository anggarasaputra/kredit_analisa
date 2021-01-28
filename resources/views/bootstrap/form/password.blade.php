<div class="form-group">
	@if ($label)
		{!! Form::label('', $label, ['class' => 'text-uppercase mb-1']) !!}
	@endif
	{!! Form::password($name, array_merge(['class' => 'form-control ' . ($errors->has($name) && $show_error ? 'is-invalid' : '')], ($attributes ? $attributes : []))) !!}
	@if ($errors->has($name) && $show_error)
		<div class="invalid-feedback">
			@foreach ($errors->get($name) as $v)
				{{ $v }}<br>
			@endforeach
		</div>
	@endif
</div>