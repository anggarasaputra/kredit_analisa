<div class="clearfix">&nbsp;</div>
@isset ($survei[0]['condition']['dokumen_survei']['condition'])
	@foreach ($survei[0]['condition']['dokumen_survei']['condition'] as $k => $v)
		@if ($k == 'jumlah_pelanggan_harian')
			<div class="row">
				<div class="col-3 text-right">
					<p class="text-secondary">{{ ucfirst(str_replace('_', ' ', $k)) }}</p>
				</div>
				<div class="col">
					<p>{!! $v !!} &nbsp;&nbsp;Orang</p>
				</div>
			</div>
		@else
			@component ('bootstrap.field_value', [
					'field' => str_replace('_', ' ', $k), 
					'value' => $v ? str_replace('_', ' ', $v) : ''
			]) @endcomponent			
		@endif
	@endforeach
@endisset