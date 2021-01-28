<div class="clearfix">&nbsp;</div>
@isset ($survei[0]['capital']['dokumen_survei']['capital'])
	@foreach ($survei[0]['capital']['dokumen_survei']['capital']['rumah'] as $k => $v)
		@if ($k == 'lama_menempati')
			<div class="row">
				<div class="col-3 text-right">
					<p class="text-secondary">{!! ucfirst(str_replace('_', ' ', $k)) !!}</p>
				</div>
				<div class="col">
					<p>{!! ucfirst(str_replace('_', ' ', $v)) !!} Tahun</p>
				</div>
			</div>
		@elseif ($k == 'luas_rumah')
			<div class="row">
				<div class="col-3 text-right">
					<p class="text-secondary">{!! ucfirst(str_replace('_', ' ', $k)) !!}</p>
				</div>
				<div class="col">
					<p>{!! ucfirst(str_replace('_', ' ', $v)) !!} M<sup>2</sup></p>
				</div>
			</div>
		@elseif ($k == 'panjang_rumah' || $k == 'lebar_rumah')
			<div class="row">
				<div class="col-3 text-right">
					<p class="text-secondary">{!! ucfirst(str_replace('_', ' ', $k)) !!}</p>
				</div>
				<div class="col">
					<p>{!! ucfirst(str_replace('_', ' ', $v)) !!} M</p>
				</div>
			</div>
		@else
			@component ('bootstrap.field_value', ['field' => str_replace('_', ' ', $k), 'value' => str_replace('_', ' ', $v)]) @endcomponent			
		@endif
	@endforeach
@endisset