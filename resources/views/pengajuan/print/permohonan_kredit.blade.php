<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>PERMOHONAN KREDIT</title>

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
					<h3>PERMOHONAN KREDIT</h3>
				</div> 
				<div class="col-xs-3" style="border:1px solid;">
					<p style="padding:15px;margin:0px;">{{$data['pengajuan']['id']}}</p>
				</div>
			</div> 

			<div class="clearfix">&nbsp;</div>

			<div class="row text-justify">
				<div class="col-xs-12 text-center" style="background-color:#aaa;padding:5px;">
					<strong>RENCANA KREDIT</strong>
				</div> 
			</div> 
			<div class="row text-justify" style="border-bottom:1px solid #aaa;padding:5px;">
				<div class="col-xs-4 text-left">
					PENGAJUAN KREDIT
				</div> 
				<div class="col-xs-8 text-right">
					{{$data['pengajuan']['pokok_pinjaman']}}
				</div> 
			</div> 
			<div class="row text-justify" style="border-bottom:1px solid #aaa;padding:5px;">
				<div class="col-xs-4 text-left">
					KEMAMPUAN ANGSUR
				</div> 
				<div class="col-xs-8 text-right">
					{{$data['pengajuan']['kemampuan_angsur']}}
				</div> 
			</div> 

			<div class="row text-justify">
				<div class="col-xs-6 text-center">
					<div class="row" style="background-color:#aaa;padding:5px;">
						<div class="col">
							<strong>
							DATA PRIBADI
							</strong>
						</div>
					</div>
					@foreach($data['pengajuan']['nasabah'] as $k => $v )
						@if($k!='keluarga' && $k!='alamat' && $k!='is_ektp' && $k!='is_lama')
							<div class="row text-justify" style="margin:10px 0px @if($k=='penghasilan_bersih') -1px @else 10px @endif -15px;border-bottom:1px solid #aaa;">
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
					@foreach($data['pengajuan']['nasabah']['keluarga'] as $k => $v )
						<div class="row" style="background-color:#aaa;padding:5px;">
							<div class="col">
								<strong>
								DATA {{strtoupper(str_replace('_', ' ', $v['hubungan']))}}
								</strong>
							</div>
						</div>
						@foreach($v as $k2 => $v2)
							@if($k2!='hubungan')
								<div class="row text-justify" style="margin:10px -15px @if($k=='telepon') -1px @else 10px @endif 0px;border-bottom:1px solid #aaa;">
									<div class="col-xs-4 text-left">
										{{strtoupper(str_replace('_', ' ', $k2))}}
									</div> 
									<div class="col-xs-8 text-right">
										{{strtoupper(str_replace('_', ' ', $v2))}}
									</div> 
								</div>
							@endif
						@endforeach
					@endforeach

					<div class="row text-justify" style="padding-left:15px;">
						<div class="col-xs-12 text-center" style="background-color:#aaa;padding:5px;">
							<strong>
							ALAMAT
							</strong>
						</div> 
					</div>
					<div class="row text-justify" style="margin:10px -15px 10px 0px;border-bottom:1px solid #aaa;">
						<div class="col-xs-12 text-left">
							@foreach($data['pengajuan']['nasabah']['alamat'] as $k => $v )
								{{strtoupper(str_replace('_', ' ', $k))}} {{strtoupper(str_replace('_', ' ', $v))}}
							@endforeach
						</div> 
					</div>

				</div> 
			</div> 

			<div class="row text-justify">
				@foreach($data['pengajuan']['jaminan_kendaraan'] as $k => $v)
					<div class="col-xs-6 text-center">
						<div class="row" style="background-color:#aaa;padding:5px;">
							<div class="col-xs-12">
								<strong>
								DATA JAMINAN {{strtoupper(str_replace('_', ' ', $v['jenis']))}} {{($k+1)}}
								</strong>
							</div> 
						</div> 
						@foreach($v['dokumen_jaminan'][$v['jenis']] as $k2 => $v2)
							@if($k2!='alamat')
								<div class="row text-justify" style="margin:10px 0px @if($k2 =='tahun_perolehan') -1px @else 10px @endif -15px;border-bottom:1px solid #aaa;">
									<div class="col-xs-6 text-left">
										{{strtoupper(str_replace('_', ' ', $k2))}}
									</div> 
									<div class="col-xs-6 text-right" >
										{{strtoupper(str_replace('_', ' ', $v2))}}
									</div> 
								</div>
							@else
								<div class="row text-justify" style="margin:10px 0px 10px -15px;border-bottom:1px solid #aaa;">
									<div class="col-xs-12 text-left">
										@foreach($v2 as $k3 => $v3) 
											{{strtoupper(str_replace('_', ' ', $k3))}} {{strtoupper(str_replace('_', ' ', $v3))}}
										@endforeach
									</div> 
								</div>
							@endif

						@endforeach
					</div> 
				@endforeach
				@foreach($data['pengajuan']['jaminan_tanah_bangunan'] as $k => $v)
					<div class="col-xs-6 text-center">
						<div class="row" style="background-color:#aaa;padding:5px;">
							<div class="col-xs-12">
								<strong>
								DATA JAMINAN {{strtoupper(str_replace('_', ' ', $v['jenis']))}} {{($k+1)}}
								</strong>
							</div> 
						</div> 
						@foreach($v['dokumen_jaminan'][$v['jenis']] as $k2 => $v2)
							@if($k2!='alamat')
								<div class="row text-justify" style="margin:10px 0px @if($k2 =='tahun_perolehan') -1px @else 10px @endif -15px;border-bottom:1px solid #aaa;">
									<div class="col-xs-6 text-left">
										{{strtoupper(str_replace('_', ' ', $k2))}}
									</div> 
									<div class="col-xs-6 text-right" >
										{{strtoupper(str_replace('_', ' ', $v2))}}
									</div> 
								</div>
							@else
								<div class="row text-justify" style="margin:10px 0px 10px -15px;border-bottom:1px solid #aaa;">
									<div class="col-xs-12 text-left">
										@foreach($v2 as $k3 => $v3) 
											{{strtoupper(str_replace('_', ' ', $k3))}} {{strtoupper(str_replace('_', ' ', $v3))}}
										@endforeach
									</div> 
								</div>
							@endif

						@endforeach
					</div> 
				@endforeach
			</div> 
				

			<div class="row text-justify" style="background-color:#aaa;padding:5px;">
				<div class="col-xs-12 text-center">
					<strong>
					TANDA TANGAN
					</strong>
				</div> 
			</div> 
			<div class="clearfix">&nbsp;</div>
			<div class="row">
				<div class="col-xs-4 text-center">
					{{strtoupper($kantor_aktif['alamat']['kota'])}}, {{Carbon\Carbon::parse($data['pengajuan']['created_at'])->format('d/m/Y')}}
				</div>
			</div>
			<div class="clearfix">&nbsp;</div>
			<div class="row">
				<div class="col-xs-4 text-center">
					PEMOHON
					<br/>
					<br/>
					<br/>
					{{strtoupper($data['pengajuan']['nasabah']['nama'])}}
				</div>
				<div class="col-xs-4 text-center">
					@if(!is_null($data['pengajuan']['nasabah']['keluarga'][0]))
						{{strtoupper(str_replace('_',' ',$data['pengajuan']['nasabah']['keluarga'][0]['hubungan']))}}
						<br/>
						<br/>
						<br/>
						{{strtoupper($data['pengajuan']['nasabah']['keluarga'][0]['nama'])}}
					@endif
				</div>
				<div class="col-xs-4 text-center">
					@if(!is_null($data['pengajuan']['ao']['nama']))
						REFERENSI
						<br/>
						<br/>
						<br/>
						{{strtoupper($data['pengajuan']['ao']['nama'])}}
					@endif
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
