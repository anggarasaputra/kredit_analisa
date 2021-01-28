<div class="clearfix">&nbsp;</div>
@isset ($survei[0]['capacity']['dokumen_survei']['capacity'])
	@foreach ($survei[0]['capacity']['dokumen_survei']['capacity'] as $k => $v)
		@if (($k == 'penghasilan') || ($k == 'pengeluaran'))
			<div class="row">
				<div class="col-3 text-right">
					<p class="text-secondary mb-1"><strong><u>{{ ucfirst(str_replace('_', ' ', $k)) }}</u></strong></p>
				</div>
			</div>
			@if (is_array($v))
				@foreach ($v as $k2 => $v2)	
					@component ('bootstrap.field_value', [
							'field' 			=> '&nbsp;&nbsp;&nbsp;' . ucfirst(str_replace('_', ' ', $k2)),
							'value' 			=> $v ? ucfirst(str_replace('_', ' ', $v2)) : '',
							'class_col_field' 	=> 'pl-4'
					]) @endcomponent
				@endforeach
			@endif
		@else
			@component ('bootstrap.field_value', [
					'field' 	=> ucfirst(str_replace('_', ' ', $k)),
					'value' 	=> $v ? ucfirst(str_replace('_', ' ', $v)) : '', 
			]) @endcomponent			
		@endif
	@endforeach
@endisset