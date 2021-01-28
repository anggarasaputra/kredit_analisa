@push('main')
<div class="container">
	<div class="row">
		<div class="col">
			{{-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– --}}
			{{-- TITLE	 																																 --}}
			{{-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– --}}
			<h4 class='mb-3'>
				Add Social Media
				<br><small class='font-weight-normal text-muted'>Create and manage your social media in {{ config('app.name') }}</small>
			</h4>

			{{-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– --}}
			{{-- CONTENTS 																																 --}}
			{{-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– --}}
			<div class="card">

				{{-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– --}}
				{{-- FORM 																																 --}}
				{{-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– --}}
				<div class="py-3 form-row mx-2 text-center">
					<div class="col-auto">
						<a href='{{ route("social_media.authenticate", ['type' => 'instagram']) }}' class='btn bg-instagram'>
							<i class='fa fa-plus-circle'></i> Instagram
						</a>
					</div>
				</div>

				{{-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– --}}
				{{-- LIST 																																	 --}}
				{{-- ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––– --}}
				<ul class="list-group list-group-flush">
					<li class="list-group-item bg-dark text-white font-weight-bold">
						<div class="row">
							<div class="col">ACCOUNT</div>
							<div class="col">STATUS</div>
							<div class="col"></div>
						</div>
					</li>
					@forelse ($data as $x)
						<li class="list-group-item">
							<div class="row">
								<div class="col">
									{!! Form::bsIcon($x->type) !!} {{ $x->name }}
								</div>
								<div class="col">
									@if ($x->is_active)
										<span class='text-success'>Active</span>
									@else
										<span class='font-italic'>Waiting for your permission</span>
									@endif
								</div>
								<div class="col text-right">
									@if ($x->is_active && $x->type == 'instagram')
										<a href='{{ route('social_media.instagram', ['id' => $x->id]) }}' class='btn btn-primary'>Manage</a>
									@endif
								</div>
							</div>
						</li>
					@empty
						<li class="list-group-item">You have not setup any social media account with {{ config('app.name') }}</li>
					@endforelse
				</ul>
			</div>
		</div>
	</div>
	
</div>
@endpush