@if (strtolower($icon) == 'instagram')
	<i class='fa fa-instagram {{ $class }}'></i>
@elseif (strtolower($icon) == 'facebook')
	<i class='fa fa-facebook-square {{ $class }}'></i>
@elseif (strtolower($icon) == 'twitter')
	<i class='fa fa-facebook-twitter {{ $class }}'></i>
@else
	<i class='fa {{ $class }}'></i>
@endif
