@push('main')
<div class="container">
	<div class="row">
		<div class="col">
			{{-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– --}}
			{{-- TITLE	 																																 --}}
			{{-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– --}}
			<h4 class='mb-3'>
				{!! Form::bsIcon($account->type) !!} {{ $account->name }}
			</h4>
		</div>
	</div>
</div>
@endpush

{{-- MENU --}}
@push('main')
<div class="container">
	<div class="card">
		<div class="card-body border border-light border-top-0 border-right-0 border-left-0">
			<ul class='nav nav-pills'>
				<li class='nav-item'><a href='{{ route('social_media.show', ['id' => $account->id]) }}' class='nav-link {{ in_array($mode, ['overview', '']) ? 'active' : '' }}'>Overview</a></li>
				<li class='nav-item'><a href='{{ route('social_media.show', ['id' => $account->id, 'mode' => 'followers']) }}' class='nav-link {{ in_array($mode, ['followers']) ? 'active' : '' }}'>Followers</a></li>
				<li class='nav-item'><a href='{{ route('social_media.show', ['id' => $account->id, 'mode' => 'poke']) }}' class='nav-link {{ in_array($mode, ['poke']) ? 'active' : '' }}'>Poke 'em</a></li>
			</ul>
		</div>

		@if (in_array($mode, ['overview', '']))
			@include('social_medias.accounts.manage.overview')
		@elseif (in_array($mode, ['followers']))
			@include('social_medias.accounts.manage.followers')
		@elseif (in_array($mode, ['poke']))
			@include('social_medias.accounts.manage.poke')
		@endif
	</div>
</div>
@endpush