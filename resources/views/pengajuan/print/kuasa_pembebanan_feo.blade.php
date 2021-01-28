@inject('terbilang', 'App\Http\Service\UI\Terbilang')
@php
	$hari 	= ['monday' => 'senin', 'tuesday' => 'selasa', 'wednesday' => 'rabu', 'thursday' => 'kamis', 'friday' => 'jumat', 'saturday' => 'sabtu', 'sunday' => 'minggu'];
@endphp
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>SURAT KUASA PEMBEBANAN FIDUSIA</title>

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
					<h4>SURAT KUASA PEMBEBANAN FIDUSIA</h4>
				</div> 
			</div> 

			<div class="clearfix">&nbsp;</div>
			<div class="clearfix">&nbsp;</div>

			<div class="row text-justify" style="font-size:11px;">
				<div class="col-xs-12">
					<p>
						Saya yang bertanda tangan dibawah ini :	
					</p>
					<p>
					&emsp;&emsp;Nama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{$data['pengajuan']['nasabah']['nama']}}<br/>

					&emsp;&emsp;Pekerjaan&nbsp;&nbsp;: {{ucwords(str_replace('_',' ',$data['pengajuan']['nasabah']['pekerjaan']))}}<br/>
					
					&emsp;&emsp;Alamat&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{implode(' ', $data['pengajuan']['nasabah']['alamat'])}}<br/>
					
					&emsp;&emsp;( Selanjutnya  disebut Pemberi Kuasa )</p>
					
					<p>Dengan ini memberi kuasa kepada : </p>
					<p>
					&emsp;&emsp;{{strtoupper($pimpinan['kantor']['jenis'])}} {{$pimpinan['kantor']['nama']}}<br/>
					&emsp;&emsp;{{implode(' ',$pimpinan['kantor']['alamat'])}}<br/>
					<br/>
					
					&emsp;&emsp;Nama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{$pimpinan['orang']['nama']}}</br>
					
					&emsp;&emsp;Pekerjaan&nbsp;&nbsp;: {{ucwords(str_replace('_', ' ', $pimpinan['role']))}} {{$pimpinan['kantor']['nama']}}<br/>
					
					&emsp;&emsp;Alamat&emsp;&emsp;: {{implode(' ',$pimpinan['orang']['alamat'])}}<br/>
					
					&emsp;&emsp;( Selanjutnya disebut Penerima Kuasa )</p>

					<div class="clearfix">&nbsp;</div>
					<p>
						Pemberi kuasa menerangkan dengan ini memberi kuasa kepada Penerima Kuasa
					</p>
					<p>
						----------------------------------------------------------------------------------------------
						<strong>
							K H U S U S
						</strong>
						-----------------------------------------------------------------------------------------------
					</p>
					<p>
						Dengan hak subtitusi untuk membebankan jaminan fiducia atas obyek jaminan fiducia yang akan disebut dibawah ini, guna menjamin pelunasan hutang kredit atas nama  {{$data['pengajuan']['nasabah']['nama']}} selaku debitur, sejumlah {{$data['putusan']['plafon_pinjaman']}} ({{\App\Http\Service\UI\Terbilang::dariRupiah($data['putusan']['plafon_pinjaman'])}}). Sejumlah uang yang dapat ditentukan dikemudian hari berdasarkan Perjanjian Kredit yang ditandatangani oleh debitur Pemberi Kuasa dengan {{strtoupper($pimpinan['kantor']['jenis'])}} {{$pimpinan['kantor']['nama']}} {{implode(' ',$pimpinan['kantor']['alamat'])}} selaku kreditur dan dibuktikan dengn Perjanjian Kredit No. {{$data['pengajuan']['id']}} tertanggal {{$data['pengajuan']['putusan']['tanggal']}} berikut penambahan, perubahan, perpanjangan serta pembaharuannya yang mungkin diadakan kemudian, sampai nilai penjaminan sebesar {{$data['putusan']['plafon_pinjaman']}}  atas obyek fiducia berupa kendaraan dengan spesifikasi sebagai berikut :
					</p>

					@php $nilai = 0; @endphp
					<div class="row">
						<ol>
							@foreach($realisasi['isi']['survei']['collateral'] as $k => $v)
								@if($v['dokumen_survei']['collateral']['jenis']=='bpkb')
									<div class="col-xs-6">
										<li> Kendaraan 
											@foreach($v['dokumen_survei']['collateral'][$v['dokumen_survei']['collateral']['jenis']] as $k2 => $v2)
												@if(in_array($k2, ['tipe', 'merk', 'tahun', 'atas_nama', 'nomor_rangka', 'nomor_mesin', 'nomor_bpkb', 'nomor_polisi']))
													<div class="row">
														<div class="col-xs-4">
															{{ucwords(str_replace('_',' ',$k2))}} 
														</div>
														<div class="col-xs-1">
															:
														</div>
														<div class="col-xs-7">
															{{ucwords(str_replace('_',' ',$v2))}}
														</div>
													</div>
												@endif
											@endforeach
											@php $nilai = $nilai + $terbilang->formatMoneyFrom($v['dokumen_survei']['collateral'][$v['dokumen_survei']['collateral']['jenis']]['harga_taksasi']); @endphp
										</li>
									</div>
								@endif
							@endforeach
						</ol>
					</div>

					<p class="clearfix">&nbsp;</p>
					<p>
						Yang bernilai {{$terbilang->formatMoneyTo($nilai)}}
					</p>
					<p>
						Yang selanjutnya cukup disebut <strong>OBYEK JAMINAN FIDUCIA.</strong>
					</p>
						Kuasa untuk membebankan fiducia ini meliputi kuasa untuk menghadap tiap –tiap pejabat yang berwenang dimana perlu memberikan keterangan–keterangan serta memperlihatkan dan menyerahkan surat – surat yang diminta, membuat/minta dibuatkan serta menandatangani akta pemberian jaminan fiducia serta surat  -surat lain yang diperlukan, memilih domisili, memberikan pernyataan bahwa obyek jaminan fiducia betul milik Pemberi Kuasa. Tidak tersangkut dalam sengketa bebas dari sitaan dan dari beban – beban apapun, mendaftarkan hak pemberi jaminan fiducia tersebut kepada notaries maupun pejabat lain yang berwenang berdasarkan ketentuan Undang – undang yang berlaku, diantaranya Undang – undang No.42 tahun 1999 dan selanjutnya melakukan segala sesuatu yang dipandang baik dan berguna untuk mencapai maksud pemberian kuasa tersebut diatas dengan tidak ada satupun yang dikecualikan dan apabila untuk melakukan suatu tindakan tersebut dalam surat ini masih diperlukan kuasa dan lebih khusus lagi maka kuasa yang dimaksud kata demi kata dianggap telah termaktub dalam surat ini.
					</p>
				
				</div> 
			</div> 

			<div class="clearfix">&nbsp;</div>
			<div class="clearfix">&nbsp;</div>

			<div class="row text-center" style="font-size:11px;">
				<div class="col-xs-6">
					{{$pimpinan['kantor']['alamat']['kota']}}, {{Carbon\Carbon::createFromFormat('d/m/Y H:i', $data['putusan']['tanggal'])->format('d/m/Y')}}
					<br/>Pemberi Kuasa
				</div>
				<div class="col-xs-6">
					<br/>Penerima Kuasa
				</div>
				<div class="clearfix">&nbsp;</div>
				<div class="clearfix">&nbsp;</div>
				<div class="clearfix">&nbsp;</div>
				<div class="clearfix">&nbsp;</div>

				<div class="col-xs-6">
					({{$data['pengajuan']['nasabah']['nama']}})
				</div>
				<div class="col-xs-6">
					({{$pimpinan['orang']['nama']}})
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
