<div class="clearfix">&nbsp;</div>
@isset ($survei[0]['capital']['dokumen_survei']['capital'])
	@foreach ($survei[0]['capital']['dokumen_survei']['capital']['kendaraan'] as $k => $v)
		@component ('bootstrap.field_value', ['field' => str_replace('_', ' ', $k), 'value' => str_replace('_', ' ', $v)]) @endcomponent			
	@endforeach
@endisset