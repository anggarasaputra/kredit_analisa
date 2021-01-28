<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>PUTUSAN KOMITE KREDIT</title>

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
					<h3>PUTUSAN KOMITE KREDIT</h3>
				</div> 
			</div> 

			<div class="clearfix">&nbsp;</div>

			<div style="font-size:11px;">
				<div class="row text-justify">
					<div class="col-xs-12 text-left">
						<p>DISETUJUI UNTUK DIBERI FASILITAS PINJAMAN @if($data['putusan']['is_baru']) BARU @else PERPANJANGAN @endif</p>
					</div>
				</div>
				<div class="row text-justify">
					<div class="col-xs-3 text-left">
						<p>PLAFON PINJAMAN</p>
					</div>
					<div class="col-xs-9 text-left">
						<p>{{$data['putusan']['plafon_pinjaman']}}</p>
					</div>
				</div>
				<div class="row text-justify">
					<div class="col-xs-3 text-left">
						<p>SUKU BUNGA</p>
					</div>
					<div class="col-xs-9 text-left">
						<p>{{$data['putusan']['suku_bunga']}} %</p>
					</div>
				</div>
				<div class="row text-justify">
					<div class="col-xs-3 text-left">
						<p>JANGKA WAKTU</p>
					</div>
					<div class="col-xs-9 text-left">
						<p>{{$data['putusan']['jangka_waktu']}}</p>
					</div>
				</div>
				<div class="row text-justify">
					<div class="col-xs-3 text-left">
						<p>BIAYA TAMBAHAN</p>
					</div>
					<div class="col-xs-9 text-left">
						<p>{{$data['putusan']['provisi']}} PROVISI, {{$data['putusan']['administrasi']}} ADMINISTRASI,
						{{$data['putusan']['legal']}} LEGAL</p>
					</div>
				</div>
				<div class="row text-justify">
					<div class="col-xs-12 text-left">
						JAMINAN
					</div>
					<ol>
						@foreach($data['survei']['collateral'] as $k => $v)
						<div class="col-xs-6 text-left">
							<li>
								{{strtoupper($v['dokumen_survei']['collateral']['jenis'])}}<br/>
								@foreach($v['dokumen_survei']['collateral'][$v['dokumen_survei']['collateral']['jenis']] as $k2 => $v2)
									@if(in_array($k2, ['nomor_sertifikat', 'atas_nama_sertifikat', 'nilai_tanah', 'nilai_bangunan', 'harga_taksasi', 'nomor_bpkb', 'merk', 'tipe', 'atas', 'atas_nama', 'tahun', 'harga_bank']))
										{{strtoupper(str_replace('_',' ',$k2))}} : {{strtoupper(str_replace('_',' ',$v2))}} <br/>
									@endif
								@endforeach
							</li>
						</div>
						@endforeach
					</ol>
				</div>
				<div class="clearfix">&nbsp;</div>
				<div class="row text-justify">
					<div class="col-xs-12 text-left">
						{{strtoupper($data['putusan']['putusan'])}} DENGAN CATATAN {{strtoupper($data['putusan']['catatan'])}}
					</div>
				</div>
				<div class="clearfix">&nbsp;</div>
				<div class="row text-center" style="padding:5px;">
					<div class="col-12" style="background-color:#aaa;border:1px solid; padding:5px;">
						<strong>
						KOMITE KREDIT
						</strong>
					</div>
				</div>
				<div class="row text-center" style="padding:5px;">
					<div class="col-xs-3" style="background-color:#aaa;border:1px solid; padding:5px;">
						<strong>
						ANALIS KREDIT
						</strong>
					</div>
					<div class="col-xs-3" style="background-color:#aaa;border:1px solid; border-left:none;padding:5px;">
						<strong>
						KABAG KREDIT
						</strong>
					</div>
					<div class="col-xs-3" style="background-color:#aaa;border:1px solid; border-left:none;padding:5px;">
						<strong>
						PIMPINAN
						</strong>
					</div>
					<div class="col-xs-3" style="background-color:#aaa;border:1px solid; border-left:none;padding:5px;">
						<strong>
						KOMISARIS
						</strong>
					</div>
					<div class="col-xs-3" style="border:1px solid;border-top:none;padding:5px;">
						<div class="clearfix">&nbsp;</div>
						<div class="clearfix">&nbsp;</div>
						<div class="clearfix">&nbsp;</div>
						<div class="clearfix">&nbsp;</div>
					</div>
					<div class="col-xs-3" style="border:1px solid;border-top:none;border-left:none;padding:5px;">
						<div class="clearfix">&nbsp;</div>
						<div class="clearfix">&nbsp;</div>
						<div class="clearfix">&nbsp;</div>
						<div class="clearfix">&nbsp;</div>
					</div>
					<div class="col-xs-3" style="border:1px solid;border-top:none;border-left:none;padding:5px;">
						<div class="clearfix">&nbsp;</div>
						<div class="clearfix">&nbsp;</div>
						<div class="clearfix">&nbsp;</div>
						<div class="clearfix">&nbsp;</div>
					</div>
					<div class="col-xs-3" style="border:1px solid;border-top:none;border-left:none;padding:5px;">
						<div class="clearfix">&nbsp;</div>
						<div class="clearfix">&nbsp;</div>
						<div class="clearfix">&nbsp;</div>
						<div class="clearfix">&nbsp;</div>
					</div>
				</div>
				<div class="clearfix">&nbsp;</div>
				<div class="row text-center" style="padding:5px;">
					<div class="col-12" style="background-color:#aaa;border:1px solid; padding:5px;">
						<strong>
						CHECKLIST DOKUMEN UMUM
						</strong>
					</div>
				</div>
				<div class="row text-center" style="padding:5px;">
					<div class="col-xs-6" style="background-color:#aaa;border:1px solid; padding:5px;">
						<strong>
						IDENTITAS NASABAH DAN JAMINAN KREDIT
						</strong>
					</div>
					<div class="col-xs-6" style="background-color:#aaa;border:1px solid; border-left:none;padding:5px;">
						<strong>
						DOKUMEN PENGIKAT KREDIT
						</strong>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6">
						@foreach($data['putusan']['checklists']['objek'] as $k3 => $v3)
							@if($v3!='cadangkan')
								<div class="row">
									<div class="col-xs-8 text-left">
										{{strtoupper(str_replace('_',' ',$k3))}}
									</div>
									<div class="col-xs-4 text-right">
										{{strtoupper(str_replace('_',' ',$v3))}}
									</div>
								</div>
							@endif
						@endforeach
					</div>
					<div class="col-xs-6">
						@foreach($data['putusan']['checklists']['pengikat'] as $k3 => $v3)
							@if($v3!='cadangkan')
								<div class="row">
									<div class="col-xs-8 text-left">
										{{strtoupper(str_replace('_',' ',$k3))}}
									</div>
									<div class="col-xs-4 text-right">
										{{strtoupper(str_replace('_',' ',$v3))}}
									</div>
								</div>
							@endif
						@endforeach
					</div>
				</div>
				
				<div class="clearfix">&nbsp;</div>
				<div class="row text-center">
					<div class="col-xs-12" style="background-color:#aaa;border:1px solid; padding:5px;">
						<strong>
							DIPERIKSA
						</strong>
					</div> 
				</div> 
				<div class="clearfix">&nbsp;</div>
				<div class="row">
					<div class="col-xs-2 text-left">
						TANGGAL 
					</div>
					<div class="col-xs-4 text-right">
						{{$data['putusan']['tanggal']}}
					</div>
				</div>
				<div class="row">
					<div class="col-xs-2 text-left">
						NAMA 
					</div>
					<div class="col-xs-4 text-right">
						{{strtoupper($data['putusan']['pembuat_keputusan']['nama'])}}
					</div>
				</div>
				<div class="row">
					<div class="col-xs-2 text-left">
						PARAF 
					</div>
					<div class="col-xs-4 text-right">
						
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
