<!doctype html>
<html lang="{{ app()->getLocale() }}">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>{{ $html['title'] }}</title>
		<link rel="stylesheet" href="{{ asset('css/app.css') }}">
		<style>
			html,body{
					min-height:100%;
					height:100%;
					overflow:hidden;
			}
		</style>
		@stack('css')
	</head>
	<body class='d-flex justify-content-center align-items-center' style='background:#333'>
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 col-md-6">
					<div class="card">
						@stack('logo')
						@include('templates.alerts.alert')
						<div class="card-body">
							<h4 class="card-title">@stack('title')</h4>
							<p class="card-text">
								@stack('body')
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
		<script src="{{ asset('js/app.js') }}"></script>
		@stack('js')
	</body>
</html>
