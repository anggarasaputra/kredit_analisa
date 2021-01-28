<!doctype html>
<html lang="{{ app()->getLocale() }}">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>{{ $html['title'] }}</title>
		<link rel="stylesheet" href="{{ mix('css/app.css') }}">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
		@stack('css')
		<style type="text/css">
		.progress_menu {
			display: inline-block;
			position: relative;
			background: #00c69b;
			padding: 15px 0;
			height: 100px;
			width: 75%;
			text-align: center;
			margin: 25px;
		}
		.progress_menu:after {
			content: '';
			display: block;  
			position: absolute;
			top: 0;
			left: 100%;
			width: 0;
			height: 0;
			border-left: 20px solid #00c69b;
			border-top: 50px solid transparent;
			border-right: 0 solid transparent;
			border-bottom: 50px solid transparent;
		}
		.progress_menu:before {
			content: '';
			display: block;  
			position: absolute;
			top: 0;
			left: 0;
			width: 0;
			height: 0;
			border-left: 20px solid #fff;
			border-top: 50px solid transparent;
			border-right: 0 solid transparent;
			border-bottom: 50px solid transparent;
		}
		.progress_menu_disabled {
			display: inline-block;
			position: relative;
			background: #aaa;
			padding: 15px 0;
			height: 100px;
			width: 75%;
			text-align: center;
			margin: 25px;
		}
		.progress_menu_disabled:after {
			content: '';
			display: block;  
			position: absolute;
			top: 0;
			left: 100%;
			width: 0;
			height: 0;
			border-left: 20px solid #aaa;
			border-top: 50px solid transparent;
			border-right: 0 solid transparent;
			border-bottom: 50px solid transparent;
		}
		.progress_menu_disabled:before {
			content: '';
			display: block;  
			position: absolute;
			top: 0;
			left: 0;
			width: 0;
			height: 0;
			border-left: 20px solid #fff;
			border-top: 50px solid transparent;
			border-right: 0 solid transparent;
			border-bottom: 50px solid transparent;
		}

		.block_menu {
			display: inline-block;
			position: relative;
			background: #00c69b;
			padding: 15px 0;
			height: 100px;
			width: 75%;
			text-align: center;
			margin: 25px;
		}

		.block_menu_disabled {
			display: inline-block;
			position: relative;
			background: #aaa;
			padding: 15px 0;
			height: 100px;
			width: 75%;
			text-align: center;
			margin: 25px;
		}

		.results tr[visible='false'],
		.no-result{
		  display:none;
		}

		.results tr[visible='true']{
		  display:table-row;
		}

		.counter{
		  padding:8px; 
		  color:#ccc;
		}

		/* Make an input blend into its parent */
		.inline-edit{
		  /* Eliminate borders and padding */
		  border: none;
		  padding: 0;
		  margin: 0;

		  /* Inherit the parent element's typography */
		  font: inherit;
		  color: inherit;
		  line-height: inherit;
		  font-size: inherit;
		  text-align: inherit;

		  /* Seems to help alignment in headers */
		  vertical-align: top;
		}

		/* Add interaction cues on hover and focus */
		.inline-edit:hover,
		.inline-edit:focus{
		  /* Change the background to a light yellow */
		  background-color: #FFD;

		  /* A subtle transition never hurts */
		  -webkit-transition: background-color 0.5s;
			 -moz-transition: background-color 0.5s;
			  -ie-transition: background-color 0.5s;
				  transition: background-color 0.5s;
		}
		</style>
	</head>
	<body class=''>
		<nav class="navbar navbar-expand navbar-dark bg-success text-white main">
			<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
				<a class="navbar-brand" href="{{ route('home', ['kantor_aktif_id' => $kantor_aktif['id']]) }}"  style="padding-top: 0px !important; margin-top: 0px !important;">
					<img src="{{url('/images/logo.png')}}" class="img img-fluid">
				</a>
				@if (!Route::is('privacy.policy'))
					<ul class="navbar-nav mr-auto mt-lg-0">
						<li class="nav-item btn btn-outline-primary {{ str_is('dashboard', $active_menu) ? 'active' : '' }}">
							<a class="nav-link text-white" href="#" data-toggle='modal' data-target='#select_social_media'>
								@if ($active_account)
									{!! Form::bsIcon($active_account->type) !!} {{ $active_account->name }}
								@else
									<i class="fa fa-building-o"></i>&nbsp;&nbsp;&nbsp; {{$kantor_aktif['nama']}} &nbsp;&nbsp;&nbsp;&nbsp;
								@endif
								<i class='fa fa-caret-down'></i>
							</a>
						</li>
					</ul>
					<ul class="navbar-nav ml-auto mt-lg-0">
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<div class='d-none d-sm-inline'>
									<i class="fa fa-user-circle"></i>&nbsp;&nbsp;&nbsp; {{ $me->email }} &nbsp;&nbsp;&nbsp;
								</div>
								<span class='d-sm-none'><i class='fa fa-user'></i></span>
							</a>
							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
								<a class="dropdown-item" href="{{ route('password.get', ['kantor_aktif_id' => $kantor_aktif['id']]) }}">Ganti Password</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
							</div>
						</li>
					</ul>
				@endif
			</div>
		</nav>

		@stack('submenu')
		@include('templates.alerts.alert')

		<div class="container-fluid mt-4 pb-5">
			<div class="row">
				<div class="col-12">
					@stack('main')
				</div>
			</div>
		</div>


		<footer class='pt-5 pb-3 align-items-end'>
			<div class="container">
				<div class="row">
					<div class="col text-center">
						{{ config('app.name') }}.com &copy; {{ date('Y') }} - Developed by <a href='http://thunderlab.id' target='_blank'>Thunderlab.id</a>
					</div>
				</div>
			</div>
		</footer>

		{{-- modal delete --}}
		@component ('bootstrap.modal', ['id' => 'delete', 'form' => true, 'method' => 'delete'])
			@slot ('title')
				Hapus Data
			@endslot

			@slot ('body')
				<p>Untuk menghapus data ini, silahkan masukkan password dibawah!</p>
				{!! Form::bsPassword('password', 'password', ['placeholder' => 'Password']) !!}
				{!! Form::bsTextarea('catatan', 'catatan', null, ['class' => 'form-control', 'placeholder' => 'catatan', 'style' => 'resize:none;', 'rows' => 5]) !!}
			@endslot

			@slot ('footer')
				<a href="#" data-dismiss="modal" class="btn btn-link text-secondary">Batal</a>
				{!! Form::submit('Hapus', ['class' => 'btn btn-outline-danger']) !!}
			@endslot
		@endcomponent	

		<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
		<script src="{{ mix('js/app.js') }}"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

		<script>
			$(document).ready(function(){
				
				// Daterange picker
				$(".daterangepicker").flatpickr({
					dateFormat: "d-m-Y",
					mode: 'range'
				});

				// Chart
				var ctx = document.getElementsByClassName('chartjs');
				for (var i = 0; i < ctx.length; i++)
				{
					new Chart(ctx[i].getContext('2d'), {
															type: ctx[i].getAttribute('data-chart-type'),
															data: {
																labels: JSON.parse(ctx[i].getAttribute('data-chart-label')),
																datasets: JSON.parse(ctx[i].getAttribute('data-chart-dataset'))
															},
															options: {}
														}
					);
				}

			});

			$('#delete').on('show.bs.modal', function(element) {
				urlDelete = $(element.relatedTarget).attr('data-url');
				
				$(this).find('form')
					.attr('action', urlDelete);
			});
		</script>
		
		@stack('js')

		{{-- SHOW MY ACCOUNT --}}
		<div class="modal fade" id="select_social_media" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">BPR / Koperasi</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-row">
							@php
								$all = request()->all();
							@endphp

							<div class="form-group pull-right">
								<input type="text" class="search form-control" placeholder="Cari Koperasi">
							</div>
							<span class="counter pull-right"></span>
							<table class="table table-hover table-bordered results">
								<thead>
									<tr>
										<th>#</th>
										<th class="col-md-5 col-xs-5">Nama</th>
									</tr>
									<tr class="warning no-result">
										<td colspan="2"><i class="fa fa-warning"></i> No result</td>
									</tr>
							  	</thead>
								<tbody>
								@foreach ($kantor as $k => $x)
									@if (in_array(strtolower($x['jenis']), ['bpr', 'koperasi']))
										@php
											$all['kantor_aktif_id'] = $x['id'];
										@endphp
											<tr>
												<td scope="row">{{$k+1}}</td>
										 		<td>
										 			@if($kantor_aktif['id']==$x['id'])
														{{ $x['nama'] }}
													@else 
												  		<a href="{{request()->url().'?'.http_build_query($all)}}">
															{{ $x['nama'] }}
														</a>
										 			@endif
												</td>
											</tr>
									@else
										<tr>
											<td scope="row">{{$k+1}}</td>
									 		<td>
										 		@if($kantor_aktif['id']==$x['id'])
													{{ $x['nama'] }}
												@else 
													<a href="{{route('home', ['kantor_aktif_id' => $x['id']])}}">
														{{ $x['nama'] }}
													</a>
												@endif
											</td>
										</tr>
									@endif
								@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>

		<script type="text/javascript">
			$(document).ready(function() {
			  $(".search").keyup(function () {
				var searchTerm = $(".search").val();
				var listItem = $('.results tbody').children('tr');
				var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
				
			  $.extend($.expr[':'], {'containsi': function(elem, i, match, array){
					return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
				}
			  });
				
			  $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e){
				$(this).attr('visible','false');
			  });

			  $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e){
				$(this).attr('visible','true');
			  });

			  var jobCount = $('.results tbody tr[visible="true"]').length;
				$('.counter').text(jobCount + ' item');

			  if(jobCount == '0') {$('.no-result').show();}
				else {$('.no-result').hide();}
					  });
			});
		</script>
	</body>
</html>
