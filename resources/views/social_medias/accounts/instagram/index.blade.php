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
				<li class='nav-item'><a href='{{ route('social_media.instagram', ['id' => $account->id]) }}' class='nav-link {{ in_array($mode, ['overview', '']) ? 'active' : '' }}'>Overview</a></li>
				<li class='nav-item'><a href='{{ route('social_media.instagram.engage', ['id' => $account->id]) }}' class='nav-link {{ in_array($mode, ['engage']) ? 'active' : '' }}'>Engage</a></li>
				<li class='nav-item'><a href='{{ route('social_media.instagram.media', ['id' => $account->id]) }}' class='nav-link {{ in_array($mode, ['media']) ? 'active' : '' }}'>Media</a></li>
				<li class='nav-item'><a href='{{ route('social_media.instagram.tag', ['id' => $account->id]) }}' class='nav-link {{ in_array($mode, ['tag']) ? 'active' : '' }}'>Tag</a></li>
				<li class='nav-item'><a href='{{ route('social_media.instagram.audience', ['id' => $account->id]) }}' class='nav-link {{ in_array($mode, ['audience']) ? 'active' : '' }}'>Audience</a></li>
				<li class='nav-item'><a href='{{ route('social_media.instagram.activity', ['id' => $account->id]) }}' class='nav-link {{ in_array($mode, ['activity']) ? 'active' : '' }}'>Activity</a></li>
			</ul>
		</div>

		@if (in_array($mode, ['overview', '']))
			@include('social_medias.accounts.instagram.overview')
		@elseif (in_array($mode, ['engage']))
			@include('social_medias.accounts.instagram.engage')
		@elseif (in_array($mode, ['tag']))
			@include('social_medias.accounts.instagram.tag')
		@elseif (in_array($mode, ['audience']))
			@include('social_medias.accounts.instagram.audience')
		@elseif (in_array($mode, ['activity']))
			@include('social_medias.accounts.instagram.activity')
		@elseif (in_array($mode, ['media']))
			@include('social_medias.accounts.instagram.media')
		@endif
	</div>
</div>
@endpush