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

		<title>SURAT PERJANJIAN  KREDIT</title>

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
		<div class="container" style="width: 21cm;height: 29.7cm;font-size:11px">
			<div class="row text-center">
				<div class="col-xs-12">
					<h3>SURAT PERJANJIAN  KREDIT</h3>
					<h5>No : {{$data['pengajuan']['id']}} </h5>
				</div> 
			</div> 

			<div class="clearfix">&nbsp;</div>
			<div class="clearfix">&nbsp;</div>
			<div class="row text-justify">
				<div class="col-xs-12">
					<p>
						Pada hari ini {{$hari[strtolower(Carbon\Carbon::createfromformat('d/m/Y H:i', $data['putusan']['tanggal'])->format('l'))]}} tanggal {{Carbon\Carbon::createfromformat('d/m/Y H:i', $data['putusan']['tanggal'])->format('d/m/Y')}}, telah dibuat dan ditandatangani perjanjian antara :
					</p>

					<p>
						<ol>
							<li> 
								{{$pimpinan['orang']['nama']}} jabatan {{ucwords($pimpinan['role'])}} {{strtoupper($pimpinan['kantor']['jenis'])}}, yang dalam hal ini bertindak untuk dan atas nama {{strtoupper($pimpinan['kantor']['jenis'])}} {{$pimpinan['kantor']['nama']}} yang berkedudukan di {{implode(' ', $pimpinan['kantor']['alamat'])}}, selanjutnya disebut {{strtoupper($pimpinan['kantor']['jenis'])}}, dengan :
							</li>
							<li>
								{{$data['pengajuan']['nasabah']['nama']}}, beralamat di {{implode(' ', $pimpinan['nasabah']['alamat'])}} yang dalam hal ini bertindak dan atas nama Pribadi selanjutnya disebut PEMINJAM.	
							</li>
						</ol>
					</p>

					<p>
						Kedua belah pihak setuju untuk mengadakan Perjanjian Kredit (selanjutnya disebut PERJANJIAN) dengan menggunakan syarat-syarat dan ketentuan-ketentuan sebagai berikut :
					</p>

					<p>
						<ol>
							<li>
								Peminjam mengakui menerima uang sebagai pinjaman atau kredit dari {{strtoupper($pimpinan['kantor']['jenis'])}} sebagaimana oleh {{strtoupper($pimpinan['kantor']['jenis'])}} telah diserahkan kepadanya uang sebesar  {{$data['putusan']['plafon_pinjaman']}} ({{\App\Http\Service\UI\Terbilang::dariRupiah($data['putusan']['plafon_pinjaman'])}}) dalam bentuk fasilitas Pinjaman Tetap. Jumlah Pinjaman yang diberikan {{strtoupper($pimpinan['kantor']['jenis'])}} kepada Peminjam yang cukup dibuktikan dengan PERJANJIAN ini sebagai bukti/kwitansi tanda penerimaan atas jumlah pinjaman tersebut;
							</li>
							<li>
								Atas fasilitas pinjaman tersebut peminjam berkewajiban untuk membayar provisi kredit sebesar {{$data['putusan']['perc_provisi']}} ({{\App\Http\Service\UI\Terbilang::terbilang($data['putusan']['perc_provisi'])}} ) % dari pinjaman pokok, yang dipungut sekali dalam masa perjanjian kredit ini dan harus dibayar segera setelah perjanjian ini ditandatangani
							</li>
							<li>
								Pengembalian pinjaman atau kredit wajib dilakukan oleh peminjam dengan cara mengangsur bunga dan/atau pokok pinjaman tiap bulan  dan dilakukan secara berturut-turut tanpa adanya suatu tunggakan atau penangguhan dengan jumlah angsuran per-bulan sebesar {{$data['analisa']['total_angsuran']}} ({{\App\Http\Service\UI\Terbilang::dariRupiah($data['analisa']['total_angsuran'])}}),  dengan jangka waktu pinjaman 6 (enam) bulan sejak tanggal PERJANJIAN ini ditandatangani, dibayar dalam  6 (enam) kali angsuran, pada tanggal {{Carbon\Carbon::createfromformat('d/m/Y H:i', $data['putusan']['tanggal'])->format('d')}} ({{\App\Http\Service\UI\Terbilang::terbilang(Carbon\Carbon::createfromformat('d/m/Y H:i', $data['putusan']['tanggal'])->format('d'))}}) setiap bulannya, pengembalian pinjaman atau kredit berlaku mulai {{Carbon\Carbon::createfromformat('d/m/Y H:i', $data['putusan']['tanggal'])->format('d/m/Y')}} dan berakhir pada {{Carbon\Carbon::createfromformat('d/m/Y H:i', $data['putusan']['tanggal'])->addMonths($data['putusan']['jangka_waktu'])->format('d/m/Y')}}, hingga seluruh pinjaman baik berupa pokok, bunga maupun biaya-biaya lainnya telah lunas;
							</li>
							<li>
								Sesuai keterangan dan pengakuan yang disampaikan Peminjam kepada {{strtoupper($pimpinan['kantor']['jenis'])}}, uang yang dipinjam dari {{strtoupper($pimpinan['kantor']['jenis'])}} hanya akan dipergunakan untuk keperluan Menambah Modal; Atas tujuan penggunaan fasilitas pinjaman tersebut, {{strtoupper($pimpinan['kantor']['jenis'])}} mempercayakan sepenuhnya kepada Peminjam dan tidak bertanggung jawab atas penggunaan uang hasil pinjaman tersebut dan {{strtoupper($pimpinan['kantor']['jenis'])}} sewaktu–waktu dapat meminta pelunasan pinjaman secara seketika apabila penggunaan uang hasil pinjaman diluar keperluan diatas;
							</li>
							<li>
								Peminjam, oleh karena kredit yang diterimanya dengan ini menyerahkan sebagai jaminan barang – barang beserta surat – suratnya berupa :	
								<div class="clearfix">&nbsp;</div>
								<div class="row">
									<ol type="i">
										@foreach($data['survei']['collateral'] as $k => $v)
											@if($v['dokumen_survei']['collateral']['jenis']=='bpkb')
												<div class="col-xs-12">
													<li> {{strtoupper($v['dokumen_survei']['collateral']['jenis'])}} 
														@foreach($v['dokumen_survei']['collateral'][$v['dokumen_survei']['collateral']['jenis']] as $k2 => $v2)
															@if(in_array($k2, ['tipe', 'merk', 'tahun', 'atas_nama', 'nomor_rangka', 'nomor_mesin', 'nomor_bpkb', 'nomor_polisi']))
																<div class="row">
																	<div class="col-xs-5">
																		{{ucwords(str_replace('_',' ',$k2))}} 
																	</div>
																	<div class="col-xs-1">
																		:
																	</div>
																	<div class="col-xs-6">
																		{{ucwords(str_replace('_',' ',$v2))}}
																	</div>
																</div>
															@endif
														@endforeach
														@php $nilai = $nilai + $terbilang->formatMoneyFrom($v['dokumen_survei']['collateral'][$v['dokumen_survei']['collateral']['jenis']]['harga_taksasi']); @endphp
													</li>
												</div>
											@else($v['dokumen_survei']['collateral']['jenis']=='bpkb')
												<div class="col-xs-12">
													<li> {{strtoupper($v['dokumen_survei']['collateral']['jenis'])}} 
														@foreach($v['dokumen_survei']['collateral'][$v['dokumen_survei']['collateral']['jenis']] as $k2 => $v2)
															@if(in_array($k2, ['nomor_sertifikat', 'masa_berlaku_sertifikat', 'tahun', 'atas_nama_sertifikat']))
																<div class="row">
																	<div class="col-xs-5">
																		{{ucwords(str_replace('_',' ',$k2))}} 
																	</div>
																	<div class="col-xs-1">
																		:
																	</div>
																	<div class="col-xs-6">
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
								<div class="clearfix">&nbsp;</div>
							</li>
							<li>
								PERJANJIAN ini mulai berlaku dan mengikat sejak tanggal ditandatangani oleh kedua belah pihak dan berakhir sampai kewajiban PEMINJAM selesai dipenuhi seluruhnya. Kedua belah pihak telah sepakat untuk tunduk dan patuh kepada seluruh syarat perjanjian sebagaimana yang tertulis pada bagian ii (kedua) PERJANJIAN ini yang juga merupakan satu kesatuan dari dan tidak terpisahkan dengan PERJANJIAN ini;
							</li>
						</ol>
					</p> 	
				</div> 
			</div> 

			<div class="clearfix">&nbsp;</div>
			<div class="clearfix">&nbsp;</div>

			<div class="row text-center">
				<div class="col-xs-6">
					{{strtoupper($pimpinan['kantor']['jenis'])}}
				</div>
				<div class="col-xs-6">
					PEMINJAM
				</div>
				<div class="clearfix">&nbsp;</div>
				<div class="clearfix">&nbsp;</div>
				<div class="clearfix">&nbsp;</div>
				<div class="clearfix">&nbsp;</div>

				<div class="col-xs-6">
					({{$pimpinan['orang']['nama']}})
				</div>
				<div class="col-xs-6">
					({{$data['pengajuan']['nasabah']['nama']}})
				</div>
			</div>
		</div>

		<div class="container" style="width: 21cm;height: 29.7cm;font-size:11px">
			<div class="row text-center">
				<div class="col-xs-12">
					<h3>SYARAT-SYARAT PERJANJIAN</h3>
				</div> 
			</div> 

			<div class="clearfix">&nbsp;</div>
			<div class="clearfix">&nbsp;</div>

			<div class="row text-justify">
				<div class="col-xs-12">
					<p>
						<ol>
							<li> 
								Pencairan Pinjaman Kredit dilakukan setelah PEMINJAM memenuhi seluruh kewajiban yang ditetapkan {{strtoupper($pimpinan['kantor']['jenis'])}};
							</li>
							<li>
								PEMINJAM wajib membayar setiap angsuran tepat pada waktunya sebagaimana ditentukan dalam PERJANJIAN. Bilamana PEMINJAM tidak menepati pelaksanaan pembayaran sesuai tanggal dari masing-masing angsuran sebagaimana diatur dalam PERJANJIAN ini, maka dianggap telah cukup bukti bahwa PEMINJAM telah lalai/wanprestasi, sehingga tanpa memerlukan teguran dari {{strtoupper($pimpinan['kantor']['jenis'])}} kepada PEMINJAM dikenakan kewajiban sebagai berikut:
								<ol type="a">
									<li>
										Apabila terjadi keterlambatan pembayaran lebih dari 3 (tiga) hari dari tanggal jatuh tempo angsuran, maka kepada PEMINJAM dikenakan denda sebesar 0,5% (nol koma lima persen) per hari keterlambatan dari jumlah angsuran yang dihitung dari tanggal jatuh tempo angsuran;
									</li>
									<li>
										Apabila {{strtoupper($pimpinan['kantor']['jenis'])}} memandang perlu melakukan tindakan-tindakan penagihan kepada PEMINJAM, maka seluruh biaya-biaya dan ongkos-ongkos penagihan tersebut baik di dalam atau di luar pengadilan akan ditanggung seluruhnya dan harus dibayar oleh PEMINJAM;
									</li>
									<li>
										Semua biaya-biaya atau ongkos-ongkos termasuk ongkos penafsiran, penyimpanan, pemeliharaan, dan pemeriksaan barang jaminan, ongkos pengacara, ongkos penjualan, biaya-biaya atau ongkos-ongkos lainnya, dan segala macam biaya-biaya atau ongkos-ongkos yang ditimbulkan karena perjanjian ini maupun yang akan timbul di kemudian hari selama biaya-biaya atau ongkos-ongkos tersebut masih berhubungan dengan perjanjian kredit ini akan dibebankan dan dipikul oleh Peminjam;
									</li>
								</ol>	
							</li>
							<li>
								Seluruh hutang PEMINJAM berikut denda dan biaya-biaya lain yang timbul kepada {{strtoupper($pimpinan['kantor']['jenis'])}} dapat ditagih secara seketika dan sekaligus bilamana :
								<ol type="a">
									<li>
										PEMINJAM meninggal dunia kecuali jika para ahli waris dan atau yang memperoleh hak dapat memenuhi seluruh kewajiban PEMINJAM dan memperoleh persetujuan {{strtoupper($pimpinan['kantor']['jenis'])}};
									</li>
									<li>
										PEMINJAM dinyatakan pailit atau mengajukan pailit atau dapat menunda pemba yaran hutang-hutangnya (surseance van betaling);
									</li>
									<li>
										Kekayaan PEMINJAM baik sebagian ataupun seluruhnya disita oleh pihak lain;
									</li>
									<li>
										Barang agunan tersebut dipindah tangankan atau dijaminkan kepada pihak ketiga  tanpa mendapatkan persetujuan tertulis dari {{strtoupper($pimpinan['kantor']['jenis'])}};
									</li>
									<li>
										PEMINJAM lalai dalam membayar salah satu angsuran atau angsuran-angsurannya ataupun pelunasan pinjaman yang berupa jasa pinjaman, pokok pinjaman, jasa tambahan maupun biaya–biaya lain yang cukup dibuktikan dengan lewatnya waktu;
									</li>
									<li>
										PEMINJAM tersangkut dalam perkara pidana;
									</li>
									<li>
										Bilamana barang jaminan musnah, berkurang nilainnya baik sebagian ataupun seluruhnya atau karena sesuatu hal yang berakhir hak penguasaannya;
									</li>
									<li>
										Bilamana pernyataan-pernyataan, surat-surat, maupun keterangan-keterangan yang diberikan oleh Peminjam kepada {{strtoupper($pimpinan['kantor']['jenis'])}} dalam rangka pemberian kredit ini ternyata tidak benar dan palsu atau dipalsukan atau tidak mengandung kebenaran materiil;
									</li>
									<li>
										Menurut penilaian {{strtoupper($pimpinan['kantor']['jenis'])}} bahwa PEMINJAM tidak dapat menjalankan usahanya dengan baik yang akan mempengaruhi pemenuhan kewajiban PEMINJAM kepada {{strtoupper($pimpinan['kantor']['jenis'])}};
									</li>
								</ol>
							</li>
							<li>
								Bilamana PEMINJAM bermaksud melunasi hutangnya kepada {{strtoupper($pimpinan['kantor']['jenis'])}} sebelum berakhirnya masa angsuran atau disebut dengan pelunasan dipercepat, maka PEMINJAM menyetujui untuk :
								<ol type="a">
									<li>
										Membayar penuh angsuran yang telah jatuh tempo;
									</li>
									<li>
										Membayar angsuran yang belum jatuh tempo dikurangi dengan discount yang diberikan oleh {{strtoupper($pimpinan['kantor']['jenis'])}}. Bilamana Peminjam melakukan pelunasan pinjaman dipercepat sampai dengan  ½ (setengah) masa kontrak pinjaman {{strtoupper($pimpinan['kantor']['jenis'])}} akan memberikan discount sebesar 50 % dari total sisa bunga yang harus dibayar; atau keringanan sebesar 20% dari total sisa bunga yang harus dibayar bilamana waktu pelunasan lebih dari ½ (setengah) masa kontrak pinjaman;
									</li>
								</ol>
							</li>
							<li>
								Peminjam menyetujui bahwa jumlah uang yang terhutang pada waktu tertentu didasarkan pada bukti dan catatan yang ada pada {{strtoupper($pimpinan['kantor']['jenis'])}} dan yang berlaku mengikat dan sah dalam menentukan dan menetapkan jumlah kredit atau hutang peminjam kepada {{strtoupper($pimpinan['kantor']['jenis'])}} serta melepaskan haknya untuk mengajukan keberatan atas pembuktian tersebut;
							</li>
							<li>
								Peminjam berjanji, menjamin serta mengikatkan diri untuk hal-hal sebagai berikut:
								<ol type="a">
									<li>
										Mendahulukan pembayaran yang terhutang berdasarkan perjanjian kredit ini dari pembayaran lainnya;
									</li>
									<li>
										Tidak mengadakan perjanjian kredit dengan Pihak Lain tanpa mendapat persetujuan tertulis terlebih dahulu dari {{strtoupper($pimpinan['kantor']['jenis'])}} sepanjang mengenai apa yang diberikan sebagai jaminan dalam perjanjian kredit ini;
									</li>
									<li>
										Bahwa Peminjam berjanji untuk memberikan jaminan pengganti ataupun jaminan tambahan bilamana dipandang perlu oleh pihak {{strtoupper($pimpinan['kantor']['jenis'])}} bilamana jaminan yang diberikan musnah atau berkurang nilainya baik sebagian ataupun seluruhnya atau karena sesuatu hal yang menyebabkan berakhirnya hak penguasaannya;
									</li>
									<li>
										Bahwa Peminjam tidak tersangkut dalam suatu perkara atau sengketa apapun;
									</li>
									<li>
										Bahwa Peminjam segera memberitahukan kepada {{strtoupper($pimpinan['kantor']['jenis'])}} segala perubahan dalam sifat dan/atau lingkup perusahaan atau kejadian/keadaan yang mempunyai pengaruh penting atau buruk atas usaha/kegiatan perusahaan Peminjam;
									</li>
									<li>
										Peminjam dengan ini berjanji akan tunduk kepada segala ketentuan-ketentuan dan kebiasaan-kebiasaan yang berlaku pada {{strtoupper($pimpinan['kantor']['jenis'])}}, baik yang berlaku sekarang maupun di kemudian hari;
									</li>
								</ol>
							</li>
							<li>
								Peminjam menyetujui dan memberi kuasa kepada {{strtoupper($pimpinan['kantor']['jenis'])}} untuk mengalihkan atau menggadai ulangkan atau dengan cara apapun memindahkan dan menyerahkan piutang atau tagihan-tagihan {{strtoupper($pimpinan['kantor']['jenis'])}} berdasarkan perjanjian ini kepada pihak lain dengan siapa pihak {{strtoupper($pimpinan['kantor']['jenis'])}} akan membuat perjanjian berikut semua hak, kekuasaan-kekuasaan dan jaminan-jaminan yang ada pada {{strtoupper($pimpinan['kantor']['jenis'])}} dengan syarat-syarat dan perjanjian-perjanjian yang dianggap baik menurut pandangan {{strtoupper($pimpinan['kantor']['jenis'])}} sendiri. Perjanjian ini mengikat dan dapat dieksekusi baik oleh {{strtoupper($pimpinan['kantor']['jenis'])}} maupun pengganti-penggantinya;
							</li>
							<li>
								Apabila timbul perselisihan sebagai akibat dari PERJANJIAN ini, pertama-tama akan diselesaikan secara musyawarah antara kedua belah pihak akan tetapi apabila tidak tercapai penyelesaian dalam musyawarah,maka kedua belah pihak sepakat agar sengketa yang timbul diselesaikan di Kantor Panitera Pengadilan Negeri Malang di Malang;
							</li>
							<li>
								Segala sesuatu yang belum diatur dengan PERJANJIAN ini termasuk pengurangan dan atau penambahan yang dianggap perlu oleh kedua belah pihak akan diatur kemudian dalam suatu perjanjian tambahan yang merupakan satu kesatuan dari dan tidak terpisahkan dengan PERJANJIAN ini;
							</li>
						</ol>
					</p>
					<p>
						Demikian syarat-syarat tersebut diatas merupakan satu kesatuan yang tidak terpisahkan dari SURAT PERJANJIAN KREDIT. No. _________________ tertanggal {{Carbon\Carbon::createfromformat('d/m/Y H:i', $data['putusan']['tanggal'])->format('d/m/Y')}} yang telah dimengerti dan disepakati oleh kedua belah pihak.
					</p>
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
