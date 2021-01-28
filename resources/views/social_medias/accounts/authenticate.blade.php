@push('main')
<div class="container">
	<h1 class="display-4">
		{{ $data->name }}
	</h1>
	<p class="lead">Redirecting to {{ $type }} for authentication process ... </p>
</div>
@endpush

@push('main')
	@if (str_is('instagram', $type))
		<iframe data-src="https://instagram.com/accounts/logout/" width="0" height="0" frameborder=0></iframe>
	@endif
@endpush

@push('js')
<script>
	$(document).ready(function(){
		$('iframe').on('load', function(){ window.location = '{{ $redirect_url }}' }); 
		$('iframe').attr('src',$('iframe').data('src'));
	});
</script>
@endpush