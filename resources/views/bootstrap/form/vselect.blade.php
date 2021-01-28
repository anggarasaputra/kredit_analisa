<div class="row form-group">
	@if ($label)
		<div class="col-sm-4 text-right">
			{!! Form::label('', $label, ['class' => 'text-uppercase mt-1 mb-1']) !!}
		</div>
		<div class="col text-left">
	@endif
		@if($errors->has($name)  && $show_error && isset($attributes['class']))
			@php
			$attributes['class'] 	= $attributes['class'].' is-invalid';
			@endphp
		@endif
		
		{!! Form::select($name, $options, $value, array_merge(['class' => 'custom-select ' . ($errors->has($name)  && $show_error ? 'is-invalid' : '')], ($attributes ? $attributes : []))) !!}
		@if ($errors->has($name) && $show_error)
			<div class="invalid-feedback">
				@foreach ($errors->get($name) as $v)
					{{ $v }}<br>
				@endforeach
			</div>
		@endif
	@if ($label)
	</div>
	@endif
</div>