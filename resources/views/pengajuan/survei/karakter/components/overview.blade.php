<div class="clearfix">&nbsp;</div>
@isset ($survei[0]['character']['dokumen_survei']['character'])
	@foreach ($survei[0]['character']['dokumen_survei']['character'] as $k => $v)
		@if ($k == 'informasi')
			<div class="clearfix">&nbsp;</div>
			<div class="row">
				<div class="col-3 text-right">
					<p class="text-secondary mb-1"><strong><u>{{ ucfirst($k) }}</u></strong></p>
				</div>
			</div>
			@if (is_array($v))
				@foreach ($v as $k2 => $v2)	
					@component ('bootstrap.field_value', [
							'field' 			=> '&nbsp;&nbsp;&nbsp; Orang ' . str_replace('_', ' ', $k2), 
							'value' 			=> $v ? str_replace('_', ' ', $v2) : '',
							'class_col_field' 	=> 'pl-4',
					]) @endcomponent
				@endforeach
			@endif
			<div class="clearfix">&nbsp;</div>
		@else
			@component ('bootstrap.field_value', ['field' => str_replace('_', ' ', $k), 'value' => $v ? str_replace('_', ' ', $v) : '']) @endcomponent			
		@endif
	@endforeach
@endisset