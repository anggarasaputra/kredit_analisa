@php
	$hari 	= ['monday' => 'senin', 'tuesday' => 'selasa', 'wednesday' => 'rabu', 'thursday' => 'kamis', 'friday' => 'jumat', 'saturday' => 'sabtu', 'sunday' => 'minggu'];
@endphp
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>SURAT PERNYATAAN PERSETUJUAN PEMASANGAN PLANG</title>

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
				<div class="col-xs-12">
					<h3>SURAT PERNYATAAN<br/>PERSETUJUAN PEMASANGAN PLANG</h3>
				</div> 
			</div> 

			<div class="clearfix">&nbsp;</div>
			<div class="clearfix">&nbsp;</div>

			<div class="row text-justify">
				<div class="col-xs-12">
					<p>
						Saya yang bertanda tangan di bawah ini : 
					</p>
				</div>
				<div class="col-xs-2">
					Nama : 
				</div>
				<div class="col-xs-10">
					{{$data['pengajuan']['nasabah']['nama']}}
				</div>
				<div class="col-xs-2">
					Alamat :
				</div>
				<div class="col-xs-10">
					{{implode(' ', $data['pengajuan']['nasabah']['alamat'])}}
				</div>
				<div class="col-xs-2">
					No SPK :
				</div>
				<div class="col-xs-10">
					_________________
				</div>
				<div class="clearfix">&nbsp;</div>
				<div class="col-xs-12">
					<p>
						Dengan ini menyatakan bahwa bilamana saya tidak melakukan kewajiban membayar angsuran dan/atau pokok pinjaman beserta biaya-biaya lainnya secara tepat waktu, maka saya secara sadar dan tanpa paksaan dari pihak manapun menyetujui tanah/rumah saya dipasang plang atau dicat dengan tulisan “Tanah dan Bangunan ini menjadi jaminan di {{strtoupper($pimpinan['kantor']['jenis'])}} {{$pimpinan['kantor']['nama']}}“ dan atas pemasangan plang atau pengecatan tersebut saya tidak akan melakukan tuntutan baik pidana maupun perdata kepada {{strtoupper($pimpinan['kantor']['jenis'])}} {{$pimpinan['kantor']['nama']}} atau pihak manapun yang mewakili.
					</p> 	

					<div class="clearfix">&nbsp;</div>

					<p>
						Demikian surat pernyataan ini saya buat agar dapat dipergunakan sebagaimana mestinya.
					</p>
				</div> 
			</div> 

			<div class="clearfix">&nbsp;</div>
			<div class="clearfix">&nbsp;</div>

			<div class="row text-left">
				<div class="col-xs-6">
					<p>{{$pimpinan['kantor']['alamat']['kota']}}, {{\Carbon\Carbon::createFromFormat('d/m/Y H:i', $data['putusan']['tanggal'])->format('d/m/Y')}}</p>
					<p>Hormat Kami,</p>
				</div>
				<div class="col-xs-6">
					
				</div>
				<div class="clearfix">&nbsp;</div>
				<div class="clearfix">&nbsp;</div>
				<div class="clearfix">&nbsp;</div>
				<div class="clearfix">&nbsp;</div>

				<div class="col-xs-6">
					<p>{{$data['pengajuan']['nasabah']['nama']}}</p>
					<p>Debitur</p>
				</div>
				<div class="col-xs-6">
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
