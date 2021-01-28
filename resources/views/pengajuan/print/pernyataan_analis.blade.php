@inject('terbilang', 'App\Http\Service\UI\Terbilang')
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>REKOMENDASI ANALISIS KREDIT</title>

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
					<h3>REKOMENDASI ANALISIS KREDIT</h3>
				</div> 
			</div> 

			<div class="clearfix">&nbsp;</div>

			<div style="font-size:11px;">
				<div class="row">
					<div class="col-xs-6">
						<div class="row text-justify">
							<div class="col-xs-12 text-left">
								<p>Dari hasil wawancara dan survey lapangan, analisa yang dapat direkomendasikan tentang nasabah tersebut mempunyai :</p>
							</div>
						</div>
						<div class="row text-justify">
							<div class="col-xs-6 text-left">
								Character
							</div>
							<div class="col-xs-6 text-left">
								{{ucwords(str_replace('_',' ', $data['analisa']['character']))}}
							</div>
						</div>
						<div class="row text-justify">
							<div class="col-xs-6 text-left">
								Capacity
							</div>
							<div class="col-xs-6 text-left">
								{{ucwords(str_replace('_',' ', $data['analisa']['capacity']))}}
							</div>
						</div>
						<div class="row text-justify">
							<div class="col-xs-6 text-left">
								Collateral
							</div>
							<div class="col-xs-6 text-left">
								{{ucwords(str_replace('_',' ', $data['analisa']['collateral']))}}
							</div>
						</div>
						<div class="row text-justify">
							<div class="col-xs-6 text-left">
								Capital
							</div>
							<div class="col-xs-6 text-left">
								{{ucwords(str_replace('_',' ', $data['analisa']['capital']))}}
							</div>
						</div>
						<div class="row text-justify">
							<div class="col-xs-6 text-left">
								Condition
							</div>
							<div class="col-xs-6 text-left">
								{{ucwords(str_replace('_',' ', $data['analisa']['condition']))}}</p>
							</div>
						</div>
					</div>
					<div class="col-xs-6">
						<div class="row text-justify">
							<div class="col-xs-12 text-left">
								<p>Plafon Kredit yang direkomendasikan :</p>
							</div>
						</div>

						<div class="row text-justify">
							<div class="col-xs-6 text-left">
								Jenis Pinjaman
							</div>
							<div class="col-xs-6 text-right">
								{{strtoupper($data['analisa']['jenis_pinjaman'])}}
							</div>
						</div>
						<div class="row text-justify">
							<div class="col-xs-6 text-left">
								Suku Bunga
							</div>
							<div class="col-xs-6 text-right">
								{{$data['analisa']['suku_bunga']}} %
							</div>
						</div>

						<div class="row text-justify">
							<div class="col-xs-6 text-left">
								Jangka Waktu
							</div>
							<div class="col-xs-6 text-right">
								{{$data['analisa']['jangka_waktu']}} bulan
							</div>
						</div>
						<div class="row text-justify">
							<div class="col-xs-6 text-left">
								Max. Plafon Kredit
							</div>
							<div class="col-xs-6 text-left">
								{{$data['analisa']['limit_angsuran']}} x {{$data['analisa']['limit_jangka_waktu']}} bulan
							</div>
						</div>
						<div class="row text-justify">
							<div class="col-xs-6 text-left">
							</div>
							<div class="col-xs-6 text-right">
								{{$terbilang->formatMoneyTo($terbilang->formatmoneyfrom($data['analisa']['limit_angsuran']) * $data['analisa']['limit_jangka_waktu'])}} 
							</div>
						</div>
						<div class="row text-justify">
							<div class="col-xs-6 text-left">
								Kredit yang diusulkan
							</div>
							<div class="col-xs-6 text-right">
								{{$data['analisa']['kredit_diusulkan']}}
							</div>
						</div>
						<div class="row text-justify">
							<div class="col-xs-12 text-left">
								<p>Pengembalian Angsuran Kredit Perbulan :</p>
							</div>
						</div>
						<div class="row text-justify">
							<div class="col-xs-6 text-left">
								Angsuran Pokok
							</div>
							<div class="col-xs-6 text-right">
								{{$data['analisa']['angsuran_pokok']}}
							</div>
						</div>
						<div class="row text-justify">
							<div class="col-xs-6 text-left">
								Angsuran Bunga
							</div>
							<div class="col-xs-6 text-right">
								{{$data['analisa']['angsuran_bunga']}}
							</div>
						</div>
						<div class="row text-justify">
							<div class="col-xs-6 text-left">
								Total Angsuran
							</div>
							<div class="col-xs-6 text-right">
								{{$terbilang->formatMoneyTo($terbilang->formatmoneyfrom($data['analisa']['angsuran_pokok']) + $terbilang->formatmoneyfrom($data['analisa']['angsuran_bunga']))}} 
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 text-left">
						{{$pimpinan['kantor']['alamat']['kota']}}, {{Carbon\Carbon::createFromFormat('d/m/Y H:i', $data['putusan']['tanggal'])->format('d/m/Y')}}
					</div>
				</div>
				<div class="row">
					<div class="clearfix">&nbsp;</div>
					<div class="col-xs-3 text-left">
						Analis Kredit
						<br/>
						<br/>
						<br/>
						{{$data['analisa']['analis']['nama']}}
					</div>
					<div class="col-xs-3 text-left">
						Pimpinan
						<br/>
						<br/>
						<br/>
						{{$pimpinan['orang']['nama']}}
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
