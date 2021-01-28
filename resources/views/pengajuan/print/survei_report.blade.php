<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>SURVEI REPORT</title>

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

		<!-- Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

		<!-- Styles -->
		<style>

		</style>
	</head>
	<body>
		<div class="container" style="width: 21cm;height: 29.7cm; ">
			<div class="clearfix">&nbsp;</div>
			
			<div class="row text-center">
				<div class="col-xs-6 col-xs-offset-3">
					<h3>SURVEI REPORT</h3>
				</div> 
				<div class="col-xs-3" style="border:1px solid;">
					<p style="padding:15px;margin:0px;">
						{{$data['survei']['pengajuan_id']}} / {{$data['survei']['id']}}
					</p>
				</div>
			</div> 

			<div class="clearfix">&nbsp;</div>

			<div style="font-size:11px;">
				<div class="row text-justify">
					<div class="col-xs-6 text-center">
						<div class="row" style="background-color:#aaa;padding:5px;">
							<div class="col">
								<strong>
								CHARACTER
								</strong>
							</div>
						</div>
						@foreach($data['survei']['character']['dokumen_survei']['character'] as $k => $v )
							@if(is_array($v))
								@foreach($v as $k2 => $v2)
									<div class="row text-justify" style="margin:10px 0px 10px 0px;border-bottom:1px solid #aaa;">
										<div class="col-xs-6 text-left">
											{{strtoupper(str_replace('_', ' ', $k))}} {{strtoupper(str_replace('_', ' ', $k2))}}
										</div> 
										<div class="col-xs-6 text-right">
											{{strtoupper(str_replace('_', ' ', $v2))}}
										</div> 
									</div>
								@endforeach
							@else
								<div class="row text-justify" style="margin:10px 0px @if($k=='catatan') -1px @else 10px @endif 0px;border-bottom:1px solid #aaa;">
									<div class="col-xs-6 text-left">
										{{strtoupper(str_replace('_', ' ', $k))}}
									</div> 
									<div class="col-xs-6 text-right">
										{{strtoupper(str_replace('_', ' ', $v))}}
									</div> 
								</div>
							@endif
						@endforeach
					</div> 
					
					<div class="col-xs-6 text-center">
						<div class="row" style="background-color:#aaa;padding:5px;">
							<div class="col">
								<strong>
								CONDITION
								</strong>
							</div>
						</div>
						@foreach($data['survei']['condition']['dokumen_survei']['condition'] as $k => $v )
							@if(is_array($v))
								@foreach($v as $k2 => $v2)
									<div class="row text-justify" style="margin:10px 0px 10px 0px;border-bottom:1px solid #aaa;">
										<div class="col-xs-6 text-left">
											{{strtoupper(str_replace('_', ' ', $k))}} {{strtoupper(str_replace('_', ' ', $k2))}}
										</div> 
										<div class="col-xs-6 text-right">
											{{strtoupper(str_replace('_', ' ', $v2))}}
										</div> 
									</div>
								@endforeach
							@else
								<div class="row text-justify" style="margin:10px 0px @if($k=='catatan') -1px @else 10px @endif 0px;border-bottom:1px solid #aaa;">
									<div class="col-xs-6 text-left">
										{{strtoupper(str_replace('_', ' ', $k))}}
									</div> 
									<div class="col-xs-6 text-right">
										{{strtoupper(str_replace('_', ' ', $v))}}
									</div> 
								</div>
							@endif
						@endforeach
					</div> 

					<div class="col-xs-12 text-center">
						<div class="row" style="background-color:#aaa;padding:5px;">
							<div class="col">
								<strong>
								CAPACITY
								</strong>
							</div>
						</div>
						@foreach($data['survei']['capacity']['dokumen_survei']['capacity'] as $k => $v )
							<div class="row text-justify">
								<div class="col-xs-12 text-left">
									@if(!is_array($v))
										<div class="row text-justify" style="margin:10px 0px 10px 0px;border-bottom:1px solid #aaa;">
											<div class="col-xs-6 text-left">
												{{strtoupper(str_replace('_', ' ', $k))}}
											</div> 
											<div class="col-xs-6 text-right">
												{{strtoupper(str_replace('_', ' ', $v))}}
											</div> 
										</div>
									@endif
								</div> 
							</div>
						@endforeach
						<div class="row text-justify" style="margin:10px 0px 10px 0px;">
							<div class="col-xs-6" style="padding:0px 15px 0px 0px">
								<strong>{{strtoupper('PENGHASILAN')}}</strong>
								@foreach($data['survei']['capacity']['dokumen_survei']['capacity']['penghasilan'] as $k => $v )
								<div class="row text-justify" style="margin:10px 0px 10px 0px;border-bottom:1px solid #aaa;">
									<div class="col-xs-6 text-left">
										{{strtoupper(str_replace('_', ' ', $k))}}
									</div> 
									<div class="col-xs-6 text-right">
										{{strtoupper(str_replace('_', ' ', $v))}}
									</div> 
								</div>
								@endforeach
							</div>
							<div class="col-xs-6" style="padding:0px 0px 0px 15px">
								<strong>{{strtoupper('PENGELUARAN')}}</strong>
								@foreach($data['survei']['capacity']['dokumen_survei']['capacity']['pengeluaran'] as $k => $v )
								<div class="row text-justify" style="margin:10px 0px 10px 0px;border-bottom:1px solid #aaa;">
									<div class="col-xs-6 text-left">
										{{strtoupper(str_replace('_', ' ', $k))}}
									</div> 
									<div class="col-xs-6 text-right">
										{{strtoupper(str_replace('_', ' ', $v))}}
									</div> 
								</div>
								@endforeach
							</div>
						</div>
					</div> 
					<div class="col-xs-12 text-center">
						<div class="row" style="background-color:#aaa;padding:5px;">
							<div class="col">
								<strong>
								CAPITAL
								</strong>
							</div>
						</div>
						<div class="row text-justify" style="margin:10px 0px 10px 0px;">
							<div class="col-xs-6" style="padding:0px 15px 0px 0px">
								<strong>{{strtoupper('RUMAH')}}</strong>
								@foreach($data['survei']['capital']['dokumen_survei']['capital']['rumah'] as $k => $v )
								<div class="row text-justify" style="margin:10px 0px 10px 0px;border-bottom:1px solid #aaa;">
									<div class="col-xs-6 text-left">
										{{strtoupper(str_replace('_', ' ', $k))}}
									</div> 
									<div class="col-xs-6 text-right">
										{{strtoupper(str_replace('_', ' ', $v))}}
									</div> 
								</div>
								@endforeach
								<strong>{{strtoupper('HUTANG')}}</strong>
								@foreach($data['survei']['capital']['dokumen_survei']['capital']['hutang'] as $k => $v )
								@foreach($v as $k1 => $v1)
								<div class="row text-justify" style="margin:10px 0px 10px 0px;border-bottom:1px solid #aaa;">
									<div class="col-xs-6 text-left">
										{{strtoupper(str_replace('_', ' ', $k1))}}
									</div> 
									<div class="col-xs-6 text-right">
										{{strtoupper(str_replace('_', ' ', $v1))}}
									</div> 
								</div>
								@endforeach
								@endforeach
							</div>
							<div class="col-xs-6" style="padding:0px 0px 0px 15px">
								<strong>{{strtoupper('KENDARAAN')}}</strong>
								@foreach($data['survei']['capital']['dokumen_survei']['capital']['kendaraan'] as $k => $v )
								<div class="row text-justify" style="margin:10px 0px 10px 0px;border-bottom:1px solid #aaa;">
									<div class="col-xs-6 text-left">
										{{strtoupper(str_replace('_', ' ', $k))}}
									</div> 
									<div class="col-xs-6 text-right">
										{{strtoupper(str_replace('_', ' ', $v))}}
									</div> 
								</div>
								@endforeach
								<strong>{{strtoupper('USAHA')}}</strong>
								@foreach($data['survei']['capital']['dokumen_survei']['capital']['usaha'] as $k => $v )
								<div class="row text-justify" style="margin:10px 0px 10px 0px;border-bottom:1px solid #aaa;">
									<div class="col-xs-6 text-left">
										{{strtoupper(str_replace('_', ' ', $k))}}
									</div> 
									<div class="col-xs-6 text-right">
										{{strtoupper(str_replace('_', ' ', $v))}}
									</div> 
								</div>
								@endforeach
							</div>
						</div>

					</div> 
				</div> 
			</div>
		</div> 

		<div class="container" style="width: 21cm;height: 29.7cm; ">
			<div class="clearfix">&nbsp;</div>
			<div class="row text-center">
				<div class="col-xs-6 col-xs-offset-3">
					<h3>SURVEI REPORT (2)</h3>
				</div> 
				<div class="col-xs-3" style="border:1px solid;">
					<p style="padding:15px;margin:0px;">
						{{$data['survei']['pengajuan_id']}} / {{$data['survei']['id']}}
					</p>
				</div>
			</div> 
			
			<div class="clearfix">&nbsp;</div>

			<div style="font-size:11px;">
				<div class="row text-justify">
					<div class="col-xs-12 text-center">
						<div class="row" style="background-color:#aaa;padding:5px;">
							<div class="col">
								<strong>
								COLLATERAL
								</strong>
							</div>
						</div>
						<div class="row text-justify" style="margin:10px 0px 10px 0px;">
						@foreach($data['survei']['collateral'] as $k0 => $v0 )
							@foreach($v0['dokumen_survei']['collateral'] as $k => $v )
								@if(!str_is($k, 'jenis'))
								<div class="col-xs-6 text-left" @if($k0%2==0) style="padding: 0px 15px 0px 0px" @else  style="padding: 0px 0px 0px 15px" @endif>
									@if(is_array($v))
										<strong>{{strtoupper(str_replace('_', ' ', $k))}}</strong>
										@foreach((array)$v as $k2 => $v2)
											@if(is_array($v2))
												@foreach((array)$v2 as $k3 => $v3)
													<div class="row text-justify" style="margin:10px 0px 10px 0px;border-bottom:1px solid #aaa;">
														<div class="col-xs-6 text-left">
															{{strtoupper(str_replace('_', ' ', $k3))}}
														</div> 
														<div class="col-xs-6 text-right">
															{{strtoupper(str_replace('_', ' ', $v3))}}
														</div> 
													</div>
												@endforeach
											@else
												<div class="row text-justify" style="margin:10px 0px 10px 0px;border-bottom:1px solid #aaa;">
													<div class="col-xs-6 text-left">
														{{strtoupper(str_replace('_', ' ', $k2))}}
													</div> 
													<div class="col-xs-6 text-right">
														{{strtoupper(str_replace('_', ' ', $v2))}}
													</div> 
												</div>
											@endif
										@endforeach
									@else
										<div class="row text-justify" style="margin:10px 0px 10px 0px;border-bottom:1px solid #aaa;">
											<div class="col-xs-6 text-left">
												{{strtoupper(str_replace('_', ' ', $k))}}
											</div> 
											<div class="col-xs-6 text-right">
												{{strtoupper(str_replace('_', ' ', $v))}}
											</div> 
										</div>
									@endif
									<div class="row">
										@foreach($v0['foto']['arsip_foto'] as $k2 => $v2)
											<div class="col-xs-6">
												<img src="{{$v2['url']}}"  class="img img-fluid" alt="Foto Jaminan" style="max-width: 100%;padding: 15px 0px">
											</div>
										@endforeach
									</div>
								</div> 
								@endif
							@endforeach
						@endforeach
						</div> 
					</div> 
				</div>

				<div class="row text-justify" style="background-color:#aaa;padding:5px;">
					<div class="col-xs-12 text-center">
						<strong>
						SURVEYOR
						</strong>
					</div> 
				</div> 
				<div class="clearfix">&nbsp;</div>
				<div class="row">
				@foreach($data['survei']['surveyor'] as $k => $v)
					<div class="col-sm-6">
						<div class="row">
							<div class="col-xs-4 text-left">
								TANGGAL 
							</div>
							<div class="col-xs-8 text-right">
								{{$data['survei']['tanggal']}}
							</div>
						</div>
						<div class="row">
							<div class="col-xs-4 text-left">
								NAMA 
							</div>
							<div class="col-xs-8 text-right">
								{{strtoupper($v['nama'])}}
							</div>
						</div>
						<div class="row">
							<div class="col-xs-4 text-left">
								PARAF 
							</div>
							<div class="col-xs-8 text-right">
								
							</div>
						</div>
					</div>
				@endforeach
				</div>
			</div>
			<div class="clearfix">&nbsp;</div>
			<div class="clearfix">&nbsp;</div>
			<div class="clearfix">&nbsp;</div>
			<div class="clearfix">&nbsp;</div>
			<div class="clearfix">&nbsp;</div>
			<div class="clearfix">&nbsp;</div>
		</div>
	</body>
</html>
