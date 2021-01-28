<div class="row {{ $class_row ? $class_row : '' }}">
	<div class="col-3 text-right {!! $class_col_field ? $class_col_field : '' !!}">
		<p class="text-secondary">{!! ucfirst($field) !!}</p>
	</div>
	<div class="col {!! $class_col_value ? $class_col_value : '' !!}">
		<p>{!! ucfirst(str_replace('_', ' ', $value)) !!}</p>
	</div>
</div>