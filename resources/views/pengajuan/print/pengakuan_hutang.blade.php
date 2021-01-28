@php
	$hari 	= ['monday' => 'senin', 'tuesday' => 'selasa', 'wednesday' => 'rabu', 'thursday' => 'kamis', 'friday' => 'jumat', 'saturday' => 'sabtu', 'sunday' => 'minggu'];
@endphp
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>SURAT PERNYATAAN SEBAGAI PENJAMIN</title>

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
					<h2>SURAT PERNYATAAN SEBAGAI PENJAMIN</h2>
				</div> 
			</div> 

			<div class="clearfix">&nbsp;</div>
			<div class="clearfix">&nbsp;</div>

			<div class="row text-justify">
				<div class="col-xs-12">
					<p>
						Pada hari ini {{$hari[strtolower(Carbon\Carbon::createfromformat('d/m/Y H:i', $data['putusan']['tanggal'])->format('l'))]}} tanggal {{Carbon\Carbon::createfromformat('d/m/Y H:i', $data['putusan']['tanggal'])->format('d/m/Y')}}
					</p>

					<p>
						<ol>
							<li>
								<p>Nama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{$data['pengajuan']['nasabah']['nama']}}</p>
								<p>Pekerjaan&nbsp;&nbsp;: {{ucwords(str_replace('_',' ', $data['pengajuan']['nasabah']['pekerjaan']))}}</p>
								<p>Alamat&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{implode(' ', $data['pengajuan']['nasabah']['alamat'])}}</p>
								<p>Untuk selanjutnya disebut Pihak Pertama.</p>
							</li>
							<li>
								<p>Nama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{$pimpinan['orang']['nama']}}</p>
								<p>Pekerjaan&nbsp;&nbsp;: {{ucwords($pimpinan['role'])}} {{$pimpinan['kantor']['nama']}}</p>
								<p>Alamat&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{implode(' ', $pimpinan['orang']['alamat'])}}</p>
								<p>Dalam hal ini bertindak dalam kedudukannya sebagai {{ucwords($pimpinan['role'])}} dari {{$pimpinan['kantor']['nama']}} dan karena itu dan atas nama serta mewakili {{strtoupper($pimpinan['kantor']['jenis'])}} {{$pimpinan['kantor']['nama']}}; 
								<br/>Untuk selanjutnya disebut Pihak Kedua</p>
							</li>
						</ol>
					</p>

					<p>
						Menerangkan :
						<ul>
							<li>
								Bahwa {{$data['pengajuan']['nasabah']['nama']}} (selanjutnya disebut Debitur) telah memperoleh fasilitas kredit dari Pihak Kedua, sejumlah {{$data['putusan']['plafon_pinjaman']}} ({{\App\Http\Service\UI\Terbilang::dariRupiah($data['putusan']['plafon_pinjaman'])}}) sebagaimana tersebut dalam Perjanjian Kredit Nomer _________________, tanggal {{Carbon\Carbon::createfromformat('d/m/Y H:i', $data['putusan']['tanggal'])->format('d/m/Y')}} ;
							</li>
							<li>
								Bahwa dalam memberikan kredit/pinjaman tersebut, Pihak Kedua membutuhkan jaminan pribadi Pihak Pertama untuk pelunasan hutang Debitur tersebut;
							</li>
							<li>
								Bahwa untuk menjamin pembayaran kembali hutang Debitur kepada Pihak Kedua tersebut, baik yang sekarang ada maupun dikemudian hari akan ada, maka Pihak Pertama bersedia sebagai Penjamin/Penanggung hutang (borg);
							</li>
						</ul>
					</p>
					<p>
						Selanjutnya sehubungan dengan hal – hal yang diuraikan diatas, maka Pihak Pertama menerangkan bahwa terhadap pelunasan hutang Debitur, baik berupa pokok kredit, bunga, provisi, denda dan ongkos – ongkos penagihan maupun beban – beban lainnya yang timbul, maka Pihak Pertama dengan ini mengikat diri sebagai Penjamin (borg), untuk secara pribadi turut bertanggung jawab sepenuhnya dan sanggup untuk menyelesaikan seluruh pinjaman Debitur termaksuddengan melepaskan hak – hak yang diberikan oleh Undang – Undang kepada Penjamin, yaitu hak – hak dalam pasal – pasal 1430, 1831, 1837, 1847, 1848, 1849, 1830 dan 1832 Kitab Undang – Undang Hukum Perdata dan dengan sukarela menyerahkan Jaminan berupa :
					</p>
					<p>
						Surat Pernyataan Sebagai Penjamin ini merupakan bagian yang penting dan tidak terpisahkan dari Perjanjian Kredit Nomer _________________, tanggal {{Carbon\Carbon::createfromformat('d/m/Y H:i', $data['putusan']['tanggal'])->format('d/m/Y')}} dan karenanya selama Perjanjian Kredit sebagaimana dimaksud masih berlaku, maka surat pernyataan ini tidak dapat dicabut dan atau tidak dapat dibatalkan oleh karena sebab apapun.
						Demikian Surat Pernyataan Sebagai Penjamin ini dibuat untuk dapat dipergunakan sebagaimana mestinya.
					</p>
				</div> 
			</div> 

			<div class="clearfix">&nbsp;</div>
			<div class="clearfix">&nbsp;</div>


			<div class="row text-center">
				<div class="col-xs-8">
				</div>
				<div class="col-xs-4">
					Penjamin
				</div>
				<div class="clearfix">&nbsp;</div>
				<div class="clearfix">&nbsp;</div>
				<div class="clearfix">&nbsp;</div>
				<div class="clearfix">&nbsp;</div>

				<div class="col-xs-4">
				</div>
				<div class="col-xs-4">
				</div>
				<div class="col-xs-4">
					({{$data['pengajuan']['nasabah']['nama']}})
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
