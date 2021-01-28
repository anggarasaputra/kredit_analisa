<button  type='submit' 
	@foreach ((array_merge(['class' => 'btn'], (is_array($attributes) ? $attributes : []))) as $k => $v)
		{{ $k }}="{{ $v }}"
	@endforeach
>
	{!! $label !!}
</button>