@push('main')
	<div class="container-fluid bg-white bg-shadow p-4">
		<div class="row">
			<div class="col">
				<h4 class='mb-2 text-style text-secondary'>
					<span class="text-uppercase">FORM SURVEI</span> 
				</h4>
			</div>
		</div>
		<div class="row ml-0 mr-0">
			<div class="col p-0">
				<ol class="breadcrumb" style="border-radius:0;">
					@foreach($breadcrumb as $k => $v)
						@if ($loop->count - 1 == $k)
							<li class="breadcrumb-item active">{{ ucwords($v['title']) }}</li>
						@else
							<li class="breadcrumb-item"><a href="{{ $v['route'] }}">{{ ucwords($v['title']) }}</a></li>
						@endif
					@endforeach
				</ol>
			</div>
		</div>
		<div class="row">
			<div class="col-3">
				@stack('menu_sidebar')
				<div class="card text-left">
					<div class="card-body">
						<h6 class="card-title">SURVEI KREDIT</h6>

						<br/>
						<div class="progress">
							<div class="progress-bar" role="progressbar" style="width: {{$percentage}}%" aria-valuenow="{{$percentage}}" aria-valuemin="0" aria-valuemax="100">{{$percentage}}%</div>
						</div>
						<hr/>

						@if(!is_null($survei['surveyor']))
							<h7 class="text-secondary">SURVEYOR</h7>
							<br/>
							@foreach($survei['surveyor'] as $k => $v)
								<h7>{{$v['nama']}}</h7>
								<br/>
							@endforeach
						@endif
						<hr/>

						{!! Form::open(['url' => route('pengajuan.survei.update', ['id' => $survei['id'], 'kantor_aktif_id' => $kantor_aktif_id, 'lokasi_id' => $lokasi['id']]), 'method' => 'PATCH']) !!}
							<div class="row">
								<div class="col">
									{!! Form::bsText('Tanggal Survei', 'tanggal_survei', $survei['tanggal'], ['class' => 'form-control mask-date-time inline-edit text-info', 'placeholder' => 'dd/mm/yyyy hh:mm'], true) !!}
								</div>
							</div>
							<div class="row">
								<div class="col">
									{!! Form::bsSubmit('Ubah Tanggal', ['class' => 'btn btn-primary', 'style' => "width:100%"]) !!}
								</div>
							</div>
						{!! Form::close() !!}
						<hr/>

						<h7 class="text-secondary">NASABAH</h7>
						<ul class="fa-ul mt-1">
							<li class="mb-1"><i class="fa-li fa fa-user mt-1"></i> {{ $lokasi['nama'] }}</li>
							<li class="mb-1"><i class="fa-li fa fa-phone mt-1"></i> {{ $lokasi['telepon'] }}</li>
							<li class="mb-1"><i class="fa-li fa fa-map-marker mt-1"></i> {{ $lokasi['alamat'] }}</li>
						</ul>

						<hr/>
						<p>Form Survei</p>
						<a href="{{route('pengajuan.pengajuan.print', ['id' => $survei['pengajuan_id'], 'mode' => 'survei_report', 'kantor_aktif_id' => $kantor_aktif['id']])}}" target="__blank" style="width:100%" class="btn btn-primary btn-sm">
							Print
						</a>
						@if($percentage==100)
						<hr/>
						<p>Survei Sudah Lengkap</p>
							<a data-toggle="modal" data-target="#lanjut-analisa" data-action="{{route('pengajuan.pengajuan.assign_analisa', ['id' => $survei['pengajuan_id'], 'kantor_aktif_id' => $kantor_aktif['id'], 'status' => 'permohonan'])}}" class="modal_analisa btn btn-primary btn-sm text-white" style="width:100%">Lanjutkan Analisa</a>
						@endif
					</div>
				</div>
			</div>
			<div class="col">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#permohonan" role="tab">
							Permohonan Kredit
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link @if($lokasi['agenda']=='nasabah') active @endif" data-toggle="tab" href="#character" role="tab">
							Character @if(!$checker['character']) <span class="text-danger">&nbsp;<i class="fa fa-exclamation"></i></span> @endif
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#condition" role="tab">
							Condition @if(!$checker['condition']) <span class="text-danger">&nbsp;<i class="fa fa-exclamation"></i></span> @endif
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#capacity" role="tab">
							Capacity @if(!$checker['capacity']) <span class="text-danger">&nbsp;<i class="fa fa-exclamation"></i></span> @endif
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#capital" role="tab">
							Capital @if(!$checker['capital']) <span class="text-danger">&nbsp;<i class="fa fa-exclamation"></i></span> @endif
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link @if($lokasi['agenda']=='jaminan') active @endif " data-toggle="tab" href="#collateral" role="tab">
							Collateral @if(!$checker['collateral']) <span class="text-danger">&nbsp;<i class="fa fa-exclamation"></i></span> @endif
						</a>
					</li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content">
					<div class="tab-pane" id="permohonan" role="tabpanel">
						<div class="clearfix">&nbsp;</div>
						@include('pengajuan.analisa.permohonan_kredit')
					</div>
					<div class="tab-pane @if($lokasi['agenda']=='nasabah') active @endif" id="character" role="tabpanel">
						<div class="clearfix">&nbsp;</div>
						<p class="text-right text-secondary"><i>*klik untuk mengubah data</i></p>
						{!! Form::open(['url' => route('pengajuan.survei.update', ['id' => $survei['id'], 'kantor_aktif_id' => $kantor_aktif_id, 'lokasi_id' => $lokasi['id']]), 'method' => 'PATCH']) !!}
						<div class="row">
							<div class="col">
								{!! Form::vSelect('Lingkungan Tinggal', 'character[lingkungan_tinggal]', ['dikenal' => 'Dikenal', 'kurang_dikenal' => 'Kurang Dikenal', 'tidak_dikenal' => 'Tidak Dikenal'], $survei['character']['dokumen_survei']['character']['lingkungan_tinggal'], ['class' => 'clingkungantinggal form-control inline-edit border-input w-50 text-info pb-1'], true) !!}
							</div>
						</div>
						<div class="row">
							<div class="col">
								{!! Form::vSelect('Lingkungan Kerja', 'character[lingkungan_kerja]', ['dikenal' => 'Dikenal', 'kurang_dikenal' => 'Kurang Dikenal', 'tidak_dikenal' => 'Tidak Dikenal'], $survei['character']['dokumen_survei']['character']['lingkungan_kerja'], ['class' => 'clingkungankerja form-control inline-edit border-input w-50 text-info pb-1'], true) !!}
							</div>
						</div>

						<div class="row">
							<div class="col">
								{!! Form::vSelect('Watak', 'character[watak]', ['baik' => 'Baik', 'cukup_baik' => 'Cukup Baik', 'tidak_baik' => 'Tidak Baik'], $survei['character']['dokumen_survei']['character']['watak'], ['class' => 'cwatak form-control inline-edit border-input w-50 text-info pb-1'], true) !!}
							</div>
						</div>

						<div class="row">
							<div class="col">
								{!! Form::vSelect('Pola Hidup', 'character[pola_hidup]', ['mewah' => 'Mewah', 'sederhana' => 'Sederhana'], $survei['character']['dokumen_survei']['character']['pola_hidup'], ['class' => 'cpolahidup form-control inline-edit border-input w-50 text-info pb-1'], true) !!}
							</div>
						</div>
						@forelse($survei['character']['dokumen_survei']['character']['informasi'] as $k => $v)
						<div class="row">
							<div class="col">
								{!! Form::vText('Informasi '.$k, 'character[informasi][$k]', $v, ['class' => 'form-control inline-edit border-input w-50 text-info pb-1', 'placeholder' => 'Baru pindah ke lingkungan ini'], true) !!}
							</div>
						</div>
						@empty
						<div class="row">
							<div class="col">
								{!! Form::vText('Informasi 1', 'character[informasi][1]', null, ['class' => 'form-control inline-edit border-input w-50 text-info pb-1', 'placeholder' => 'Baru pindah ke lingkungan ini'], true) !!}
							</div>
						</div>
						<div class="row">
							<div class="col">
								{!! Form::vText('Informasi 2', 'character[informasi][2]', null, ['class' => 'form-control inline-edit border-input w-50 text-info pb-1', 'placeholder' => 'Baru pindah ke lingkungan ini'], true) !!}
							</div>
						</div>
						@endforelse

						{!! Form::bsSubmit('Simpan', ['class' => 'btn btn-primary float-right mr-3']) !!}
						{!! Form::close() !!}
					</div>

					<div class="tab-pane" id="condition" role="tabpanel">
						<div class="clearfix">&nbsp;</div>
						<p class="text-right text-secondary"><i>*klik untuk mengubah data</i></p>
						{!! Form::open(['url' => route('pengajuan.survei.update', ['id' => $survei['id'], 'kantor_aktif_id' => $kantor_aktif_id, 'lokasi_id' => $lokasi['id']]), 'method' => 'PATCH']) !!}
						<div class="row">
							<div class="col">
								{!! Form::vSelect('Persaingan Usaha', 'condition[persaingan_usaha]', [null => 'Pilih', 'padat' => 'Padat', 'sedang' => 'Sedang', 'biasa' => 'Biasa'], $survei['condition']['dokumen_survei']['condition']['persaingan_usaha'], ['class' => 'copersainganusaha form-control inline-edit border-input w-50 text-info pb-1'], true) !!}
							</div>
						</div>
						<div class="row">
							<div class="col">
								{!! Form::vSelect('Prospek Usaha', 'condition[prospek_usaha]', [null => 'Pilih', 'padat' => 'Padat', 'sedang' => 'Sedang', 'biasa' => 'Biasa'], $survei['condition']['dokumen_survei']['condition']['prospek_usaha'], ['class' => 'coprospekusaha form-control inline-edit border-input w-50 text-info pb-1'], true) !!}
							</div>
						</div>
						<div class="row">
							<div class="col">
								{!! Form::vSelect('Perputaran Usaha', 'condition[perputaran_usaha]', [null => 'Pilih', 'padat' => 'Padat', 'sedang' => 'Sedang', 'lambat' => 'Lambat'], $survei['condition']['dokumen_survei']['condition']['perputaran_usaha'], ['class' => 'coperputaranusaha form-control inline-edit border-input w-50 text-info pb-1'], true) !!}
							</div>
						</div>
						<div class="row">
							<div class="col">
								{!! Form::vSelect('Pengalaman Usaha / Lama Bekerja', 'condition[pengalaman_usaha]', ['< 1 Tahun' => '< 1 Tahun', '2 - 3 Tahun' => '2 - 3 Tahun', '3 - 5 Tahun' => '3 - 5 Tahun', '> Tahun' => '> Tahun'], $survei['condition']['dokumen_survei']['condition']['pengalaman_usaha'], ['class' => 'copengalamanusaha form-control inline-edit border-input w-50 text-info pb-1'], true) !!}
							</div>
						</div>
						<div class="row">
							<div class="col">
								{!! Form::vSelect('Resiko Usaha Ke Depan', 'condition[resiko_usaha_kedepan]', [null => 'Pilih', 'bagus' => 'Bagus', 'biasa' => 'Biasa', 'suram' => 'Suram'], $survei['condition']['dokumen_survei']['condition']['resiko_usaha_kedepan'], ['class' => 'coresikousaha form-control inline-edit border-input w-50 text-info pb-1'], true) !!}
							</div>
						</div>
						<div class="row">
							<div class="col">
								{!! Form::vSelect('Jumlah Pelanggan Harian', 'condition[jumlah_pelanggan_harian]', [null => 'Pilih', '0 - 10' => '0 - 10', '10 - 50' => '10 - 50', '50 - 100' => '50 - 100', '> 100' => '> 100'], $survei['condition']['dokumen_survei']['condition']['jumlah_pelanggan_harian'], ['class' => 'cjumlahpelanggan form-control inline-edit border-input w-50 text-info pb-1'], true) !!}
							</div>
						</div>
						{!! Form::bsSubmit('Simpan', ['class' => 'btn btn-primary float-right mr-3']) !!}
						{!! Form::close() !!}
					</div>

					<div class="tab-pane" id="capacity" role="tabpanel">
						<div class="clearfix">&nbsp;</div>
						<p class="text-right text-secondary"><i>*klik untuk mengubah data</i></p>
						{!! Form::open(['url' => route('pengajuan.survei.update', ['id' => $survei['id'], 'kantor_aktif_id' => $kantor_aktif_id, 'lokasi_id' => $lokasi['id']]), 'method' => 'PATCH']) !!}
						<div class="row">
							<div class="col">
								{!! Form::vSelect('Manajemen Usaha', 'capacity[manajemen_usaha]', ['baik' => 'Baik', 'cukup_baik' => 'Cukup Baik', 'tidak_baik' => 'Tidak Baik'], $survei['capacity']['dokumen_survei']['capacity']['manajemen_usaha'], ['class' => 'camanajemenusaha form-control inline-edit border-input w-50 text-info pb-1'], true) !!}
							</div>
						</div>
						<h6 class="text-secondary"><strong><u>Penghasilan</u></strong></h6>
						<div class="row">
							<div class="col">
								{!! Form::vText('Penghasilan Utama', 'capacity[penghasilan][utama]', $survei['capacity']['dokumen_survei']['capacity']['penghasilan']['utama'], ['class' => 'capengahasilanutama mask-money form-control inline-edit border-input w-50 text-info pb-1', 'placeholder' => 'Rp 3.000.000'], true) !!}
							</div>
						</div>
						<div class="row">
							<div class="col">
								{!! Form::vText('Penghasilan Suami / Istri', 'capacity[penghasilan][pasangan]', $survei['capacity']['dokumen_survei']['capacity']['penghasilan']['pasangan'], ['class' => 'capengahasilanpasangan mask-money form-control inline-edit border-input w-50 text-info pb-1', 'placeholder' => 'Rp 3.000.000'], true) !!}
							</div>
						</div>
						<div class="row">
							<div class="col">
								{!! Form::vText('Penghasilan Usaha', 'capacity[penghasilan][usaha]', $survei['capacity']['dokumen_survei']['capacity']['penghasilan']['usaha'], ['class' => 'capengahasilanusaha mask-money form-control inline-edit border-input w-50 text-info pb-1', 'placeholder' => 'Rp 3.000.000'], true) !!}
							</div>
						</div>
						<div class="row">
							<div class="col">
								{!! Form::vText('Rincian Penghasilan Utama', 'capacity[penghasilan][rincian]', $survei['capacity']['dokumen_survei']['capacity']['penghasilan']['rincian'], ['class' => 'carincianpenghasilan form-control inline-edit border-input w-50 text-info pb-1', 'placeholder' => 'Gaji Rutin'], true) !!}
							</div>
						</div>
						<h6 class="text-secondary mt-4"><strong><u>Pengeluaran</u></strong></h6>
						<div class="row">
							<div class="col">
								{!! Form::vText('Biaya Rutin', 'capacity[pengeluaran][biaya_rutin]', $survei['capacity']['dokumen_survei']['capacity']['pengeluaran']['biaya_rutin'], ['class' => 'cabiayarutin mask-money form-control inline-edit border-input w-50 text-info pb-1', 'placeholder' => 'Rp 3.000.000'], true) !!}
							</div>
						</div>
						<div class="row">
							<div class="col">
								{!! Form::vText('Biaya Angsuran Kredit', 'capacity[pengeluaran][angsuran_kredit]', $survei['capacity']['dokumen_survei']['capacity']['pengeluaran']['angsuran_kredit'], ['class' => 'cabiayaangsuran mask-money form-control inline-edit border-input w-50 text-info pb-1', 'placeholder' => 'Rp 3.000.000'], true) !!}
							</div>
						</div>
						<div class="row">
							<div class="col">
								{!! Form::vText('Rincian Biaya Rutin', 'capacity[pengeluaran][rincian]', $survei['capacity']['dokumen_survei']['capacity']['pengeluaran']['rincian'], ['class' => 'carincianpengeluaran form-control inline-edit border-input w-50 text-info pb-1', 'placeholder' => 'Rumah Tangga'], true) !!}
							</div>
						</div>
						<div class="row">
							<div class="col">
								{!! Form::vText('Status Pernikahan', 'capacity[status_pernikahan]', $survei['capacity']['dokumen_survei']['capacity']['status_pernikahan'], ['class' => 'catstatuspernikahan form-control inline-edit border-input w-50 text-info pb-1', 'placeholder' => 'K-1'], true) !!}
							</div>
						</div>
						<div class="row">
							<div class="col">
								{!! Form::vLabel('Tanggungan Keluarga', 'capacity[tanggungan_keluarga]', $survei['capacity']['dokumen_survei']['capacity']['tanggungan_keluarga'], ['class' => 'cattanggungankeluarga form-control inline-edit border-input w-50 text-info pb-1', 'placeholder' => 'K-1'], true) !!}
							</div>
						</div>
						{!! Form::bsSubmit('Simpan', ['class' => 'btn btn-primary float-right mr-3']) !!}
						{!! Form::close() !!}
					</div>

					<div class="tab-pane" id="capital" role="tabpanel">
						<div class="clearfix">&nbsp;</div>
						<p class="text-right text-secondary"><i>*klik untuk mengubah data</i></p>
						{!! Form::open(['url' => route('pengajuan.survei.update', ['id' => $survei['id'], 'kantor_aktif_id' => $kantor_aktif_id, 'lokasi_id' => $lokasi['id']]), 'method' => 'PATCH']) !!}
						<h6 class="text-secondary"><strong><u>Rumah</u></strong></h6>
						<div class="row">
							<div class="col">
								{!! Form::vSelect('Status Kepemilikan', 'capital[rumah][status]', ['milik_sendiri' => 'Milik Sendiri', 'keluarga' => 'Keluarga', 'dinas' => 'Dinas', 'sewa' => 'Sewa', 'angsuran' => 'KPR/KPA'], $survei['capital']['dokumen_survei']['capital']['rumah']['status'], ['class' => 'caprumahstatus form-control inline-edit border-input w-50 text-info pb-1'], true) !!}
							</div>
						</div>

						<div id="capisewa" @if($survei['capital']['dokumen_survei']['capital']['rumah']['status']!='sewa') style="display:none" @endif>
							<div class="row">
								<div class="col">
									{!! Form::vText('Sewa Sejak', 'capital[rumah][sewa_sejak]', $survei['capital']['dokumen_survei']['capital']['rumah']['sewa_sejak'], ['class' => 'caprumahsewasejak form-control inline-edit border-input w-25 text-info pb-1', 'placeholder' => '2015'], true) !!}
								</div>
							</div>
							<div class="row">
								<div class="col">
									{!! Form::vText('Masa Sewa', 'capital[rumah][masa_sewa]', $survei['capital']['dokumen_survei']['capital']['rumah']['masa_sewa'], ['class' => 'caprumahmasasewa form-control inline-edit border-input text-info pb-1', 'placeholder' => '2'], true, null, null, 'Tahun', ['class_input_group' => 'w-25', 'class_input_group_append' => 'border-0 bg-white']) !!}
								</div>
							</div>
						</div>

						<div id="capiangs" @if($survei['capital']['dokumen_survei']['capital']['rumah']['status']!='angsuran') style="display:none" @endif>
						<div class="row">
							<div class="col">
								{!! Form::vText('Angsuran Bulanan', 'capital[rumah][angsuran_bulanan]', $survei['capital']['dokumen_survei']['capital']['rumah']['angsuran_bulanan'], ['class' => 'carumahangsuranbulanan mask-money form-control inline-edit border-input w-50 text-info pb-1', 'placeholder' => 'Rp 3.500.000'], true) !!}
							</div>
						</div>
						<div class="row">
							<div class="col">
								{!! Form::vText('Lama Angsuran', 'capital[rumah][lama_angsuran]', $survei['capital']['dokumen_survei']['capital']['rumah']['lama_angsuran'], ['class' => 'caprumahlamaangsuran form-control inline-edit border-input w-50 text-info pb-1', 'placeholder' => '2'], true, null, null, 'Tahun',  ['class_input_group' => 'w-25', 'class_input_group_append' => 'border-0 bg-white']) !!}
							</div>
						</div>
						</div>
						<div class="row">
							<div class="col">
								{!! Form::vText('Lama Menempati', 'capital[rumah][lama_menempati]', $survei['capital']['dokumen_survei']['capital']['rumah']['lama_menempati'], ['class' => 'caprumahlamamenempati form-control inline-edit border-input text-info pb-1 d-inline', 'placeholder' => '2'], true, null, null, 'Tahun', ['class_input_group' => 'w-25', 'class_input_group_append' => 'border-0 bg-white']) !!}
							</div>
						</div>
						<div class="row">
							<div class="col">
								{!! Form::vText('Luas Rumah', 'capital[rumah][luas_rumah]', $survei['capital']['dokumen_survei']['capital']['rumah']['luas_rumah'], ['class' => 'caprumahluas form-control inline-edit border-input text-info pb-1', 'placeholder' => '30 * 30 m'], true, null, null, 'M<sup>2</sup>',  ['class_input_group' => 'w-25', 'class_input_group_append' => 'border-0 bg-white']) !!}
							</div>
						</div>
						<div class="row">
							<div class="col">
								{!! Form::vText('Nilai Rumah', 'capital[rumah][nilai_rumah]', $survei['capital']['dokumen_survei']['capital']['rumah']['nilai_rumah'], ['class' => 'caprumahnilai mask-money form-control inline-edit border-input w-50 text-info pb-1', 'placeholder' => 'Rp 120.000.000'], true) !!}
							</div>
						</div>
						<h6 class="text-secondary mt-4"><strong><u>Kendaraan</u></strong></h6>
						<div class="row">
							<div class="col">
								{!! Form::vText('Jumlah Kendaraan Roda 4', 'capital[kendaraan][jumlah_kendaraan_roda_4]', $survei['capital']['dokumen_survei']['capital']['kendaraan']['jumlah_kendaraan_roda_4'], ['class' => 'capkendaraanr4 form-control inline-edit border-input w-25 text-info pb-1', 'placeholder' => '2'], true) !!}
							</div>
						</div>
						<div class="row">
							<div class="col">
								{!! Form::vText('Jumlah Kendaraan Roda 2', 'capital[kendaraan][jumlah_kendaraan_roda_2]', $survei['capital']['dokumen_survei']['capital']['kendaraan']['jumlah_kendaraan_roda_2'], ['class' => 'capkendaraanr2 form-control inline-edit border-input w-25 text-info pb-1', 'placeholder' => '4'], true) !!}
							</div>
						</div>
						<div class="row">
							<div class="col">
								{!! Form::vText('Nilai Kendaraan', 'capital[kendaraan][nilai_kendaraan]', $survei['capital']['dokumen_survei']['capital']['kendaraan']['nilai_kendaraan'], ['class' => 'caprumahnilai mask-money form-control inline-edit border-input w-50 text-info pb-1', 'placeholder' => 'Rp 320.000.000'], true) !!}
							</div>
						</div>
						<h6 class="text-secondary mt-4"><strong><u>Usaha</u></strong></h6>
						<div class="row">
							<div class="col">
								{!! Form::vText('Nama Usaha', 'capital[usaha][nama_usaha]', $survei['capital']['dokumen_survei']['capital']['usaha']['nama_usaha'], ['class' => 'capusahanama form-control inline-edit border-input w-50 text-info pb-1', 'placeholder' => 'UD Maju Terus'], true) !!}
							</div>
						</div>
						<div class="row">
							<div class="col">
								{!! Form::vText('Bidang Usaha', 'capital[usaha][bidang_usaha]', $survei['capital']['dokumen_survei']['capital']['usaha']['bidang_usaha'], ['class' => 'capusahabidang form-control inline-edit border-input w-50 text-info pb-1', 'placeholder' => 'Sembako'], true) !!}
							</div>
						</div>
						<div class="row">
							<div class="col">
								{!! Form::vText('Lama Usaha', 'capital[usaha][lama_usaha]', $survei['capital']['dokumen_survei']['capital']['usaha']['lama_usaha'], ['class' => 'capusahalama form-control inline-edit border-input text-info pb-1', 'placeholder' => '2'], true, null, null, 'Tahun',  ['class_input_group' => 'w-25', 'class_input_group_append' => 'border-0 bg-white']) !!}
							</div>
						</div>
						<div class="row">
							<div class="col">
								{!! Form::vSelect('Status Usaha', 'capital[usaha][status]', ['milik_sendiri' => 'Milik Sendiri', 'milik_keluarga' => 'Milik Keluarga', 'kerjasama_bagi_hasil' => 'Kerjasama Bagi Hasil'], $survei['capital']['dokumen_survei']['capital']['usaha']['status'], ['class' => 'capusahastatus form-control inline-edit border-input w-50 text-info pb-1'], true) !!}
							</div>
						</div>
						<div class="row rowcapusahabagihasil" @if($survei['capital']['dokumen_survei']['capital']['usaha']['status']!='kerjasama_bagi_hasil') style="display:none" @endif>
							<div class="col">
								{!! Form::vText('Bagi Hasil', 'capital[usaha][bagi_hasil]', $survei['capital']['dokumen_survei']['capital']['usaha']['bagi_hasil'], ['class' => 'capusahabagihasil form-control inline-edit border-input text-info pb-1', 'placeholder' => '40'], true, null, null, '%',  ['class_input_group' => 'w-25', 'class_input_group_append' => 'border-0 bg-white']) !!}
							</div>
						</div>
						<div class="row">
							<div class="col">
								{!! Form::vText('Nilai Aset', 'capital[usaha][nilai_aset]', $survei['capital']['dokumen_survei']['capital']['usaha']['nilai_aset'], ['class' => 'capusahanilai mask-money form-control inline-edit border-input w-50 text-info pb-1', 'placeholder' => 'Rp 320.000.000'], true) !!}
							</div>
						</div>
						<div class="row">
							<div class="col">
								{!! Form::vText('Omzet Bulanan', 'capital[usaha][omzet_bulanan]', $survei['capital']['dokumen_survei']['capital']['usaha']['omzet_bulanan'], ['class' => 'capomzetbulanan mask-money form-control inline-edit border-input w-50 text-info pb-1', 'placeholder' => 'Rp 10.000.000'], true) !!}
							</div>
						</div>
						<h6 class="text-secondary mt-4"><strong><u>Hutang</u></strong></h6>
						<table class="table table-bordered">
							<thead class="thead-default">
								<tr>
									<th>Lembaga Keuangan</th>
									<th>Jumlah Pinjaman</th>
									<th>Jumlah Angsuran</th>
									<th>Jangka Waktu</th>
									<th colspan="2">Action</th>
								</tr>
							</thead>
							<tbody id="formHutang">
								@forelse($survei['capital']['dokumen_survei']['capital']['hutang'] as $k => $v)
									<tr id="clonedHutang{{$k+1}}" class="clonedHutang">
										<td class="align-text-top">
											{!! Form::vText(null, 'capital[hutang]['.($k+1).'][lembaga_keuangan]', $v['lembaga_keuangan'], ['class' => 'klembagakeuangan form-control text-info inline-edit', 'placeholder' => 'BCA'], true) !!}
										</td>
										<td class="align-text-top">
											{!! Form::vText(null, 'capital[hutang]['.($k+1).'][jumlah_pinjaman]', $v['jumlah_pinjaman'], ['class' => 'kjumlahpinjaman mask-money form-control text-info inline-edit', 'placeholder' => 'Rp 40.000.000'], true) !!}
										</td>
										<td class="align-text-top">
											{!! Form::vText(null, 'capital[hutang]['.($k+1).'][jumlah_angsuran]', $v['jumlah_angsuran'], ['class' => 'kjumlahangsuran mask-money form-control text-info inline-edit', 'placeholder' => 'Rp 2.000.000'], true) !!}
										</td>
										<td class="align-text-top">
											{!! Form::vText(null, 'capital[hutang]['.($k+1).'][jangka_waktu]', $v['jangka_waktu'], ['class' => 'kjangkawaktu form-control text-info inline-edit', 'placeholder' => '1'], true, null, null, 'Tahun',  ['class_input_group' => 'w-50', 'class_input_group_append' => 'border-0 bg-white']) !!}
										</td>
										<td class="align-text-top">
											<a class="cloneHutang text-primary" data-toggle="tooltip" data-placement="bottom" title="tambah/duplikat hutang"><i class="fa fa-copy fa-lg"></i></a> 
											&nbsp;&nbsp;&nbsp;
											<a class="removeHutang text-danger" data-toggle="tooltip" data-placement="bottom" title="hapus hutang"><i class="fa fa-trash fa-lg"></i></a>
										</td>
									</tr>
								@empty
									<tr id="clonedHutang1" class="clonedHutang">
										<td class="align-text-top">
											{!! Form::vText(null, 'capital[hutang][1][lembaga_keuangan]', null, ['class' => 'klembagakeuangan form-control text-info inline-edit', 'placeholder' => 'BCA'], true) !!}
										</td>
										<td class="align-text-top">
											{!! Form::vText(null, 'capital[hutang][1][jumlah_pinjaman]', null, ['class' => 'kjumlahpinjaman form-control mask-money text-info inline-edit', 'placeholder' => 'Rp 60.000.000'], true) !!}
										</td>
										<td class="align-text-top">
											{!! Form::vText(null, 'capital[hutang][1][jumlah_angsuran]', null, ['class' => 'kjumlahangsuran form-control mask-money text-info inline-edit', 'placeholder' => 'Rp 2.000.000'], true) !!}
										</td>
										<td class="align-text-top">
											{!! Form::vText(null, 'capital[hutang][1][jangka_waktu]', null, ['class' => 'kjangkawaktu form-control text-info inline-edit', 'placeholder' => '1'], true, null, null, 'Tahun',  ['class_input_group' => 'w-50', 'class_input_group_append' => 'border-0 bg-white']) !!}
										</td>
										<td class="align-text-top">
											<a class="cloneHutang text-primary" data-toggle="tooltip" data-placement="bottom" title="tambah/duplikat hutang"><i class="fa fa-copy fa-lg"></i></a> 
											&nbsp;&nbsp;&nbsp;
											<a class="removeHutang text-danger" data-toggle="tooltip" data-placement="bottom" title="hapus hutang"><i class="fa fa-trash fa-lg"></i></a>
										</td>
									</tr>
								@endforelse
							</tbody>
						</table>
						{!! Form::bsSubmit('Simpan', ['class' => 'btn btn-primary float-right mr-3']) !!}
						{!! Form::close() !!}
					</div>

					<div class="tab-pane @if($lokasi['agenda']=='jaminan') active @endif" id="collateral" role="tabpanel">
						<div class="clearfix">&nbsp;</div>
						<div class="row">
							<div class="col-sm-3">
								<div class="card text-left">
									<div class="card-body">
										<h6 class="card-title">JAMINAN</h6>
										<small><i>*Pilih Jaminan</i></small>
										<ul class="nav flex-column nav-pills"  role="tablist">
											@foreach($survei['jaminan_kendaraan'] as $k => $v)
												<li class="nav-item">
													<a class="nav-link" href="#jaminan{{$v['id']}}" role="tab" data-toggle="tab">
														<small>
														KENDARAAN {{strtoupper(str_replace('_',' ',$v['dokumen_survei']['collateral']['bpkb']['jenis']))}}
														</small>
														<br/>
														{{strtoupper($v['dokumen_survei']['collateral']['bpkb']['merk'])}}
														@if(!$v['is_lengkap'])
															<span class="text-danger">&nbsp;<i class="fa fa-exclamation"></i></span>
														@endif
													</a>
												</li>
											@endforeach
											@foreach($survei['jaminan_tanah_bangunan'] as $k => $v)
												<li class="nav-item">
													@php similar_text(implode(' ', $v['dokumen_survei']['collateral'][$v['dokumen_survei']['collateral']['jenis']]['alamat']), $lokasi['alamat'], $perc[$k]) @endphp
													<a class="nav-link @if($lokasi['agenda']=='jaminan' && $perc[$k]==100) active @endif " href="#jaminan{{$v['id']}}" role="tab" data-toggle="tab">
														{{strtoupper($v['dokumen_survei']['collateral']['jenis'])}}
														@if(!$v['is_lengkap'])
															<span class="text-danger">&nbsp;<i class="fa fa-exclamation"></i></span>
														@endif
														<br/>
														<small>
															<!-- {{strtoupper($v['dokumen_survei']['collateral'][$v['dokumen_survei']['collateral']['jenis']]['tipe'])}}
															<br/> -->
															KEC {{$v['dokumen_survei']['collateral'][$v['dokumen_survei']['collateral']['jenis']]['alamat']['kecamatan']}}
															<br/>
															 {{$v['dokumen_survei']['collateral'][$v['dokumen_survei']['collateral']['jenis']]['alamat']['kota']}}
														</small>
														<br/>
													</a>
												</li>
											@endforeach
										</ul>
									</div>
								</div>
							</div>
							<div class="col-sm-9">
								<p class="text-right text-secondary"><i>*klik untuk mengubah data</i></p>
								<div class="tab-content">
									@foreach($survei['jaminan_kendaraan'] as $k => $v)
										<div class="tab-pane" id="jaminan{{$v['id']}}" role="tabpanel">
												<h6 class="text-secondary"><strong><u>Foto Jaminan</u></strong></h6>
												<div class="row">
													@forelse($v['foto']['arsip_foto'] as $k2 => $v2)
													<div class="col-sm-4">
														<img src="{{$v2['url']}}"  class="img-fluid" alt="Foto Jaminan" style="border:1px solid #aaa">
													</div>
													@empty
													<div class="col-sm-4"></div>
													<div class="col-sm-4">
														<img src="https://images-na.ssl-images-amazon.com/images/I/31PkEHsnkXL._SX342_.jpg"  class="img-fluid" alt="Foto Jaminan" style="border:1px solid #aaa">
													</div>
													<div class="col-sm-4"></div>
													<div class="col-sm-12 text-right text-secondary"><i>*harap melengkapi foto melalui aplikasi mobile</i></div>
													@endforelse
												</div>
												<div class="clearfix">&nbsp;</div>
												<div class="clearfix">&nbsp;</div>

											{!! Form::open(['url' => route('pengajuan.survei.update', ['id' => $survei['id'], 'kantor_aktif_id' => $kantor_aktif_id, 'lokasi_id' => $lokasi['id'], 'survei_detail_id' => $v['id']]), 'method' => 'PATCH']) !!}
												<h6 class="text-secondary"><strong><u>Data Survei</u></strong></h6>
												<div class="row">
													<div class="col">
														{!! Form::vLabel('Merk', 'collateral['.$v['id'].'][bpkb][merk]', $v['dokumen_survei']['collateral']['bpkb']['merk'], ['class' => 'form-control inline-edit text-info'], true) !!}
													</div>
												</div>
												<div class="row">
													<div class="col">
														{!! Form::vLabel('Tipe', 'collateral['.$v['id'].'][bpkb][tipe]', $v['dokumen_survei']['collateral']['bpkb']['tipe'], ['class' => 'form-control inline-edit text-info'], true) !!}
													</div>
												</div>
												<div class="row">
													<div class="col">
														{!! Form::vLabel('Jenis', 'collateral['.$v['id'].'][bpkb][jenis]', ucwords(str_replace('_',' ',$v['dokumen_survei']['collateral']['bpkb']['jenis'])), ['class' => 'form-control inline-edit text-info'], true) !!}
													</div>
												</div>
												<div class="row">
													<div class="col">
														{!! Form::vLabel('Tahun', 'collateral['.$v['id'].'][bpkb][tahun]', $v['dokumen_survei']['collateral']['bpkb']['tahun'], ['class' => 'form-control inline-edit text-info'], true) !!}
													</div>
												</div>
												<div class="row">
													<div class="col">
														{!! Form::vLabel('Nomor BPKB', 'collateral['.$v['id'].'][bpkb][nomor_bpkb]', $v['dokumen_survei']['collateral']['bpkb']['nomor_bpkb'], ['class' => 'form-control inline-edit text-info'], true) !!}
													</div>
												</div>

												<div class="row">
													<div class="col">
														{!! Form::vText('Nomor Polisi', 'collateral['.$v['id'].'][bpkb][nomor_polisi]', $v['dokumen_survei']['collateral']['bpkb']['nomor_polisi'], ['class' => 'form-control inline-edit text-info', 'placeholder' => 'N 5577 CC'], true) !!}
													</div>
												</div>
												<div class="row">
													<div class="col">
														{!! Form::vText('Atas Nama', 'collateral['.$v['id'].'][bpkb][atas_nama]', $v['dokumen_survei']['collateral']['bpkb']['atas_nama'], ['class' => 'form-control inline-edit text-info', 'placeholder' => 'Tukimin'], true) !!}
													</div>
												</div>

												<div class="row">
													<div class="col">
														{!! Form::vText('Nomor Mesin', 'collateral['.$v['id'].'][bpkb][nomor_mesin]', $v['dokumen_survei']['collateral']['bpkb']['nomor_mesin'], ['class' => 'form-control inline-edit text-info', 'placeholder' => 'JJ09E1266700'], true) !!}
													</div>
												</div>
												<div class="row">
													<div class="col">
														{!! Form::vText('Nomor Rangka', 'collateral['.$v['id'].'][bpkb][nomor_rangka]', $v['dokumen_survei']['collateral']['bpkb']['nomor_rangka'], ['class' => 'form-control inline-edit text-info', 'placeholder' => 'MM9PK0322CJ173615'], true) !!}
													</div>
												</div>

												<div class="row">
													<div class="col">
														{!! Form::vText('Warna', 'collateral['.$v['id'].'][bpkb][warna]', $v['dokumen_survei']['collateral']['bpkb']['warna'], ['class' => 'form-control inline-edit text-info', 'placeholder' => 'Merah'], true) !!}
													</div>
												</div>
												<div class="row">
													<div class="col">
														{!! Form::vText('Masa Berlaku STNK', 'collateral['.$v['id'].'][bpkb][masa_berlaku_stnk]', $v['dokumen_survei']['collateral']['bpkb']['masa_berlaku_stnk'], ['class' => 'mask-date form-control inline-edit text-info', 'placeholder' => 'dd/mm/yyyy'], true) !!}
													</div>
												</div>
												<div class="row">
													<div class="col">
														{!! Form::vText('Fungsi Sehari Hari', 'collateral['.$v['id'].'][bpkb][fungsi_sehari_hari]', $v['dokumen_survei']['collateral']['bpkb']['fungsi_sehari_hari'], ['class' => 'form-control inline-edit text-info', 'placeholder' => 'Transportasi Pribadi'], true) !!}
													</div>
												</div>
												
												<div class="row">
													<div class="col">
														{!! Form::vSelect('Faktur Pembelian', 'collateral['.$v['id'].'][bpkb][faktur]', ['ada' => 'Ada', 'tidak_ada' => 'Tidak Ada'], $v['dokumen_survei']['collateral']['bpkb']['faktur'], ['class' => 'form-control text-info inline-edit'], true) !!}
													</div>
												</div>
												<div class="row">
													<div class="col">
														{!! Form::vSelect('Kwitansi Jual Beli', 'collateral['.$v['id'].'][bpkb][kwitansi_jual_beli]', ['ada' => 'Ada', 'tidak_ada' => 'Tidak Ada'], $v['dokumen_survei']['collateral']['bpkb']['kwitansi_jual_beli'], ['class' => 'form-control text-info inline-edit'], true) !!}
													</div>
												</div>
												<div class="row">
													<div class="col">
														{!! Form::vSelect('Kwitansi Kosong', 'collateral['.$v['id'].'][bpkb][kwitansi_kosong]', ['ada' => 'Ada', 'tidak_ada' => 'Tidak Ada'], $v['dokumen_survei']['collateral']['bpkb']['kwitansi_kosong'], ['class' => 'form-control text-info inline-edit'], true) !!}
													</div>
												</div>
												<div class="row">
													<div class="col">
														{!! Form::vSelect('KTP a.n. BPKB', 'collateral['.$v['id'].'][bpkb][ktp_an_bpkb]', ['ada' => 'Ada', 'tidak_ada' => 'Tidak Ada'], $v['dokumen_survei']['collateral']['bpkb']['ktp_an_bpkb'], ['class' => 'form-control text-info inline-edit'], true) !!}
													</div>
												</div>
												<div class="row">
													<div class="col">
														{!! Form::vSelect('Asuransi', 'collateral['.$v['id'].'][bpkb][asuransi]', ['all_risk' => 'All Risk', 'tlo' => 'TLO', 'tidak_ada' => 'Tidak Ada'], $v['dokumen_survei']['collateral']['bpkb']['asuransi'], ['class' => 'form-control text-info inline-edit'], true) !!}
													</div>
												</div>


												<div class="row">
													<div class="col">
														{!! Form::vSelect('Status Kepemilikan', 'collateral['.$v['id'].'][bpkb][status_kepemilikan]', ['an_sendiri' => 'a.n. Sendiri', 'an_orang_lain_milik_sendiri' => 'a.n. Orang Lain Milik Sendiri', 'an_orang_lain_dengan_surat_kuasa' => 'a.n. Orang Lain dengan Surat Kuasa'], $v['dokumen_survei']['collateral']['bpkb']['status_kepemilikan'], ['class' => 'form-control text-info inline-edit'], true) !!}
													</div>
												</div>
												<div class="row">
													<div class="col">
														{!! Form::vSelect('Kondisi Kendaraan', 'collateral['.$v['id'].'][bpkb][kondisi_kendaraan]', ['baik' => 'Baik', 'cukup_baik' => 'Cukup Baik', 'buruk' => 'Buruk'], $v['dokumen_survei']['collateral']['bpkb']['kondisi_kendaraan'], ['class' => 'form-control text-info inline-edit'], true) !!}
													</div>
												</div>

												<div class="row">
													<div class="col">
														{!! Form::vText('Nilai Kendaraan', 'collateral['.$v['id'].'][bpkb][nilai_kendaraan]', $v['dokumen_survei']['collateral']['bpkb']['nilai_kendaraan'], ['class' => 'colbpkbnilaik form-control inline-edit text-info mask-money', 'placeholder' => 'Rp 8.000.000', 'id' => 'colbpkbnilaik'.$v['id']], true) !!}
													</div>
												</div>
												<div class="row">
													<div class="col">
														{!! Form::vText('Persentasi Taksasi', 'collateral['.$v['id'].'][bpkb][persentasi_taksasi]', $v['dokumen_survei']['collateral']['bpkb']['persentasi_taksasi'], ['class' => 'colbpkbperctax form-control inline-edit text-info', 'placeholder' => '40', 'id' => 'colbpkbperctax'.$v['id']], true) !!}
													</div>
												</div>	
												<div class="row">
													<div class="col">
														{!! Form::vLabel('Harga Taksasi', 'collateral['.$v['id'].'][bpkb][harga_taksasi]', $v['dokumen_survei']['collateral']['bpkb']['harga_taksasi'], ['class' => 'colnilaitaxbpkb form-control inline-edit text-info mask-money', 'placeholder' => 'Rp 6.000.000', 'id' => 'colnilaitaxbpkb'.$v['id']], true) !!}
													</div>
												</div>

												<div class="row">
													<div class="col">
														{!! Form::vText('Persentasi Bank', 'collateral['.$v['id'].'][bpkb][persentasi_bank]', $v['dokumen_survei']['collateral']['bpkb']['persentasi_bank'], ['class' => 'colbpkbpercbank form-control inline-edit text-info', 'placeholder' => '40', 'id' => 'colbpkbpercbank'.$v['id']], true) !!}
													</div>
												</div>
												<div class="row">
													<div class="col">
													{!!Form::hidden('passcode', 'passcode', ['id' => 'passcode'.$v['id']])!!}
													</div>
												</div>
												<div class="row">
													<div class="col">
														{!! Form::vLabel('Harga Bank', 'collateral['.$v['id'].'][bpkb][harga_bank]', $v['dokumen_survei']['collateral']['bpkb']['harga_bank'], ['class' => 'colbpkbnilaibank form-control inline-edit text-info mask-money', 'placeholder' => 'Rp 6.000.000', 'id' => 'colbpkbnilaibank'.$v['id']], true) !!}
													</div>
												</div>

												<div class="row">
													<div class="col">
														{!! Form::vTextarea('Catatan', 'collateral['.$v['id'].'][bpkb][catatan]', $v['dokumen_survei']['collateral']['bpkb']['catatan'], ['class' => 'form-control inline-edit text-info', 'placeholder' => 'Ada cacat', 'rows' => 5], true) !!}
													</div>
												</div>
												
											{!! Form::bsSubmit('Simpan', ['class' => 'btn btn-primary float-right mr-3']) !!}
											{!! Form::close() !!}
										</div>
									@endforeach
									@foreach($survei['jaminan_tanah_bangunan'] as $k => $v)
										@php $jenis = $v['dokumen_survei']['collateral']['jenis']; @endphp
										<div class="tab-pane  {{ ($lokasi['agenda']=='jaminan' && $perc[$k]==100) ? 'active' : '' }}" id="jaminan{{$v['id']}}" role="tabpanel">
											
											<h6 class="text-secondary"><strong><u>Foto Jaminan</u></strong></h6>
											<div class="row">
												@forelse($v['foto']['arsip_foto'] as $k2 => $v2)
												<div class="col-sm-4">
													<img src="{{$v2['url']}}"  class="img-fluid" alt="Foto Jaminan" style="border:1px solid #aaa">
												</div>
												@empty
												<div class="col-sm-4"></div>
												<div class="col-sm-4">
													<img src="https://images-na.ssl-images-amazon.com/images/I/31PkEHsnkXL._SX342_.jpg"  class="img-fluid" alt="Foto Jaminan" style="border:1px solid #aaa">
												</div>
												<div class="col-sm-4"></div>
												<div class="col-sm-12 text-right text-secondary"><i>*harap melengkapi foto melalui aplikasi mobile</i></div>
												@endforelse
											</div>
											<div class="clearfix">&nbsp;</div>
											<div class="clearfix">&nbsp;</div>

											<h6 class="text-secondary"><strong><u>Data Survei</u></strong></h6>
											{!! Form::open(['url' => route('pengajuan.survei.update', ['id' => $survei['id'], 'kantor_aktif_id' => $kantor_aktif_id, 'lokasi_id' => $lokasi['id'], 'survei_detail_id' => $v['id']]), 'method' => 'PATCH']) !!}
											<h6 class="text-secondary"><strong><u>Alamat</u></strong></h6>
											<div class="row">
												<div class="col">
													{!! Form::vLabel('Alamat', 'collateral['.$v['id'].']['.$jenis.'][alamat]', $v['dokumen_survei']['collateral'][$jenis]['alamat']['alamat'], ['class' => 'form-control inline-edit text-info'], true) !!}
												</div>
											</div>
											<div class="row">
												<div class="col">
													{!! Form::vLabel('RT/RW', 'collateral['.$v['id'].']['.$jenis.'][alamat]', $v['dokumen_survei']['collateral'][$jenis]['alamat']['rt'].' / '.$v['dokumen_survei']['collateral'][$jenis]['alamat']['rw'], ['class' => 'form-control inline-edit text-info'], true) !!}
												</div>
											</div>
											<div class="row">
												<div class="col">
													{!! Form::vLabel('DESA/DUSUN', 'collateral['.$v['id'].']['.$jenis.'][alamat]', $v['dokumen_survei']['collateral'][$jenis]['alamat']['kelurahan'], ['class' => 'form-control inline-edit text-info'], true) !!}
												</div>
											</div>
											<div class="row">
												<div class="col">
													{!! Form::vLabel('KECAMATAN', 'collateral['.$v['id'].']['.$jenis.'][alamat]', $v['dokumen_survei']['collateral'][$jenis]['alamat']['kecamatan'], ['class' => 'form-control inline-edit text-info'], true) !!}
												</div>
											</div>
											<div class="row">
												<div class="col">
													{!! Form::vLabel('KOTA/KAB', 'collateral['.$v['id'].']['.$jenis.'][alamat]', $v['dokumen_survei']['collateral'][$jenis]['alamat']['kota'], ['class' => 'form-control inline-edit text-info'], true) !!}
												</div>
											</div>
											<h6 class="text-secondary"><strong><u>Informasi Jaminan</u></strong></h6>
											<div class="row">
												<div class="col">
													{!! Form::vLabel('Tipe', 'collateral['.$v['id'].']['.$jenis.'][tipe]', str_replace('_',' ',$v['dokumen_survei']['collateral'][$jenis]['tipe']), ['class' => 'form-control inline-edit text-info'], true) !!}
												</div>
											</div>
											<div class="row">
												<div class="col">
													{!! Form::vLabel('Nomor Sertifikat', 'collateral['.$v['id'].']['.$jenis.'][nomor_sertifikat]', $v['dokumen_survei']['collateral'][$jenis]['nomor_sertifikat'], ['class' => 'form-control inline-edit text-info'], true) !!}
												</div>
											</div>
											@if($jenis=='shgb')
											<div class="row">
												<div class="col">
													{!! Form::vLabel('Berlaku Hingga', 'collateral['.$v['id'].']['.$jenis.'][masa_berlaku_sertifikat]', $v['dokumen_survei']['collateral'][$jenis]['masa_berlaku_sertifikat'], ['class' => 'form-control inline-edit text-info'], true) !!}
												</div>
											</div>
											@endif
											<div class="row">
												<div class="col">
													{!! Form::vText('Atas Nama', 'collateral['.$v['id'].']['.$jenis.'][atas_nama_sertifikat]', $v['dokumen_survei']['collateral'][$jenis]['atas_nama_sertifikat'], ['class' => 'form-control inline-edit text-info', 'placeholder' => 'Tukimin'], true) !!}
												</div>
											</div>

											<div class="row">
												<div class="col">
													{!! Form::vLabel('Luas Tanah', 'collateral['.$v['id'].']['.$jenis.'][luas_tanah]', $v['dokumen_survei']['collateral'][$jenis]['luas_tanah'], ['class' => 'form-control inline-edit text-info'], true) !!}
												</div>
											</div>
											<div class="row">
												<div class="col">
													{!! Form::vText('Panjang Tanah', 'collateral['.$v['id'].']['.$jenis.'][panjang_tanah]', $v['dokumen_survei']['collateral'][$jenis]['panjang_tanah'], ['class' => 'form-control inline-edit text-info', 'placeholder' => '12'], true) !!}
												</div>
											</div>
											<div class="row">
												<div class="col">
													{!! Form::vText('Lebar Tanah', 'collateral['.$v['id'].']['.$jenis.'][lebar_tanah]', $v['dokumen_survei']['collateral'][$jenis]['lebar_tanah'], ['class' => 'form-control inline-edit text-info', 'placeholder' => '6'], true) !!}
												</div>
											</div>
											@if($v['dokumen_survei']['collateral'][$jenis]['tipe']=='tanah_dan_bangunan')
											<div class="row">
												<div class="col">
													{!! Form::vLabel('Luas Bangunan', 'collateral['.$v['id'].']['.$jenis.'][luas_bangunan]', $v['dokumen_survei']['collateral'][$jenis]['luas_bangunan'], ['class' => 'form-control inline-edit text-info'], true) !!}
												</div>
											</div>
											<div class="row">
												<div class="col">
													{!! Form::vText('Panjang Bangunan', 'collateral['.$v['id'].']['.$jenis.'][panjang_bangunan]', $v['dokumen_survei']['collateral'][$jenis]['panjang_bangunan'], ['class' => 'form-control inline-edit text-info', 'placeholder' => '12'], true) !!}
												</div>
											</div>
											<div class="row">
												<div class="col">
													{!! Form::vText('Lebar Bangunan', 'collateral['.$v['id'].']['.$jenis.'][lebar_bangunan]', $v['dokumen_survei']['collateral'][$jenis]['lebar_bangunan'], ['class' => 'form-control inline-edit text-info', 'placeholder' => '6'], true) !!}
												</div>
											</div>
											<div class="row">
												<div class="col">
													{!! Form::vSelect('Fungsi Bangunan', 'collateral['.$v['id'].']['.$jenis.'][fungsi_bangunan]', ['ruko' => 'Ruko', 'rukan' => 'Rukan', 'rumah' => 'Rumah'], $v['dokumen_survei']['collateral'][$jenis]['fungsi_bangunan'], ['class' => 'form-control text-info inline-edit'], true) !!}
												</div>
											</div>
											<div class="row">
												<div class="col">
													{!! Form::vSelect('Bentuk Bangunan', 'collateral['.$v['id'].']['.$jenis.'][bentuk_bangunan]', ['tingkat' => 'Tingkat', 'tidak_tingkat' => 'Tidak Tingkat'], $v['dokumen_survei']['collateral'][$jenis]['bentuk_bangunan'], ['class' => 'form-control text-info inline-edit'], true) !!}
												</div>
											</div>
											<div class="row">
												<div class="col">
													{!! Form::vSelect('Konstruksi Bangunan', 'collateral['.$v['id'].']['.$jenis.'][konstruksi_bangunan]', ['permanen' => 'Permanen', 'semi_permanen' => 'Semi Permanen'], $v['dokumen_survei']['collateral'][$jenis]['konstruksi_bangunan'], ['class' => 'form-control text-info inline-edit'], true) !!}
												</div>
											</div>
											<div class="row">
												<div class="col">
													{!! Form::vSelect('Lantai Bangunan', 'collateral['.$v['id'].']['.$jenis.'][lantai_bangunan]', ['keramik' => 'Keramik', 'tegel_biasa' => 'Tegel Biasa'], $v['dokumen_survei']['collateral'][$jenis]['lantai_bangunan'], ['class' => 'form-control text-info inline-edit'], true) !!}
												</div>
											</div>
											<div class="row">
												<div class="col">
													{!! Form::vSelect('Dinding', 'collateral['.$v['id'].']['.$jenis.'][dinding]', ['tembok' => 'Tembok', 'semi_tembok' => 'Semi Tembok'], $v['dokumen_survei']['collateral'][$jenis]['dinding'], ['class' => 'form-control text-info inline-edit'], true) !!}
												</div>
											</div>
											<div class="row">
												<div class="col">
													{!! Form::vText('Listrik', 'collateral['.$v['id'].']['.$jenis.'][listrik]', $v['dokumen_survei']['collateral'][$jenis]['listrik'], ['class' => 'form-control inline-edit text-info', 'placeholder' => '900 Watt'], true) !!}
												</div>
											</div>
											@endif
											<div class="row">
												<div class="col">
													{!! Form::vSelect('Sumber Air', 'collateral['.$v['id'].']['.$jenis.'][air]', ['pdam' => 'PDAM', 'sumur' => 'Sumur'], $v['dokumen_survei']['collateral'][$jenis]['air'], ['class' => 'form-control text-info inline-edit'], true) !!}
												</div>
											</div>
											<div class="row">
												<div class="col">
													{!! Form::vSelect('Akses Jalan', 'collateral['.$v['id'].']['.$jenis.'][jalan]', ['tanah' => 'Tanah', 'batu' => 'Batu', 'aspal' => 'Aspal'], $v['dokumen_survei']['collateral'][$jenis]['jalan'], ['class' => 'form-control text-info inline-edit'], true) !!}
												</div>
											</div>
											<div class="row">
												<div class="col">
													{!! Form::vSelect('Letak Lokasi Thdp Jalan', 'collateral['.$v['id'].']['.$jenis.'][letak_lokasi_terhadap_jalan]', ['sama' => 'Sama', 'lebih_rendah' => 'Lebih Rendah', 'lebih_tinggi' => 'Lebih Tinggi'], $v['dokumen_survei']['collateral'][$jenis]['letak_lokasi_terhadap_jalan'], ['class' => 'form-control text-info inline-edit'], true) !!}
												</div>
											</div>
											<div class="row">
												<div class="col">
													{!! Form::vSelect('Lingkungan', 'collateral['.$v['id'].']['.$jenis.'][lingkungan]', ['perumahan' => 'Perumahan', 'kampung' => 'Kampung', 'pertokoan' => 'Pertokoan', 'pasar' => 'Pasar', 'perkantoran' => 'Perkantoran', 'industri' => 'Industri'], $v['dokumen_survei']['collateral'][$jenis]['lingkungan'], ['class' => 'form-control text-info inline-edit'], true) !!}
												</div>
											</div>

											<div class="row">
												<div class="col">
													{!! Form::vSelect('AJB', 'collateral['.$v['id'].']['.$jenis.'][ajb]', ['ada' => 'Ada', 'tidak_ada' => 'Tidak Ada'], $v['dokumen_survei']['collateral'][$jenis]['ajb'], ['class' => 'form-control text-info inline-edit'], true) !!}
												</div>
											</div>

											<div class="row">
												<div class="col">
													{!! Form::vSelect('PBB Terakhir', 'collateral['.$v['id'].']['.$jenis.'][pbb_terakhir]', ['ada' => 'Ada', 'tidak_ada' => 'Tidak Ada'], $v['dokumen_survei']['collateral'][$jenis]['pbb_terakhir'], ['class' => 'form-control text-info inline-edit'], true) !!}
												</div>
											</div>

											<div class="row">
												<div class="col">
													{!! Form::vSelect('IMB', 'collateral['.$v['id'].']['.$jenis.'][imb]', ['ada' => 'Ada', 'tidak_ada' => 'Tidak Ada'], $v['dokumen_survei']['collateral'][$jenis]['imb'], ['class' => 'form-control text-info inline-edit'], true) !!}
												</div>
											</div>

											<div class="row">
												<div class="col">
													{!! Form::vSelect('Asuransi', 'collateral['.$v['id'].']['.$jenis.'][asuransi]', ['ada' => 'Ada', 'tidak_ada' => 'Tidak Ada'], $v['dokumen_survei']['collateral'][$jenis]['asuransi'], ['class' => 'form-control text-info inline-edit'], true) !!}
												</div>
											</div>

											<div class="row">
												<div class="col">
													{!! Form::vText('Nilai Tanah', 'collateral['.$v['id'].']['.$jenis.'][nilai_tanah]', $v['dokumen_survei']['collateral'][$jenis]['nilai_tanah'], ['class' => 'colsertifikatnilait form-control inline-edit text-info mask-money', 'placeholder' => 'Rp 70.000.000'], true) !!}
												</div>
											</div>
											<div class="row">
												<div class="col">
													{!! Form::vText('NJOP Tanah', 'collateral['.$v['id'].']['.$jenis.'][njop_tanah]', $v['dokumen_survei']['collateral'][$jenis]['njop_tanah'], ['class' => 'form-control inline-edit text-info mask-money', 'placeholder' => 'Rp 70.000.000'], true) !!}
												</div>
											</div>

											@if($v['dokumen_survei']['collateral'][$jenis]['tipe']=='tanah_dan_bangunan')
											<div class="row">
												<div class="col">
													{!! Form::vText('Nilai Bangunan', 'collateral['.$v['id'].']['.$jenis.'][nilai_bangunan]', $v['dokumen_survei']['collateral'][$jenis]['nilai_bangunan'], ['class' => 'colsertifikatnilaib form-control inline-edit text-info mask-money', 'placeholder' => 'Rp 70.000.000'], true) !!}
												</div>
											</div>
											<div class="row">
												<div class="col">
													{!! Form::vText('NJOP Bangunan', 'collateral['.$v['id'].']['.$jenis.'][njop_bangunan]', $v['dokumen_survei']['collateral'][$jenis]['njop_bangunan'], ['class' => 'form-control inline-edit text-info mask-money', 'placeholder' => 'Rp 70.000.000'], true) !!}
												</div>
											</div>
											@endif

											<!-- <div class="row">
												<div class="col">
													{!! Form::vText('NJOP', 'collateral['.$v['id'].']['.$jenis.'][njop]', $v['dokumen_survei']['collateral'][$jenis]['njop'], ['class' => 'form-control inline-edit text-info mask-money', 'placeholder' => 'Rp 140.000.000'], true) !!}
												</div>
											</div> -->
											
											<div class="row">
												<div class="col">
													{!! Form::vText('Persentasi Taksasi', 'collateral['.$v['id'].']['.$jenis.'][persentasi_taksasi]', $v['dokumen_survei']['collateral'][$jenis]['persentasi_taksasi'], ['class' => 'colsertifikatperctax form-control inline-edit text-info', 'placeholder' => '60'], true) !!}
												</div>
											</div>

											<div class="row">
												<div class="col">
													{!! Form::vLabel('Harga Taksasi', 'collateral['.$v['id'].']['.$jenis.'][harga_taksasi]', $v['dokumen_survei']['collateral'][$jenis]['harga_taksasi'], ['class' => 'colsertifikatnilaitax form-control inline-edit text-info mask-money', 'placeholder' => 'Rp 8.000.000'], true) !!}
												</div>
											</div>

											<div class="row">
												<div class="col">
													{!! Form::vTextarea('Catatan', 'collateral['.$v['id'].']['.$jenis.'][catatan]', $v['dokumen_survei']['collateral'][$jenis]['catatan'], ['class' => 'form-control inline-edit text-info', 'placeholder' => 'Ada 2 AC', 'rows' => 5], true) !!}
												</div>
											</div>
											
											{!! Form::bsSubmit('Simpan', ['class' => 'btn btn-primary float-right mr-3']) !!}
											{!! Form::close() !!}
										</div>
									@endforeach
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="clearfix">&nbsp;</div>
	</div>

	@include('pengajuan.ajax.modal_analisa')
	@include('pengajuan.survei.modal_passcode_entry')
@endpush

@push('submenu')
	@include('templates.submenu.submenu')
@endpush

@push('js')
	<script>

		///CLONE FORM HUTANG///
		var regex = /^(.+?)(\d+)$/i;
		var cloneIndexHutang = $(".clonedHutang").length;

		function cloneHutang(){
			cloneIndexHutang++;

			$(this).parents(".clonedHutang").clone()
				.appendTo("#formHutang")
				.attr("id", "clonedHutang" +  cloneIndexHutang)
				.find("*")
				.each(function() {
					var id = this.id || "";
					var match = id.match(regex) || [];
					if (match.length == 3) {
						this.id = match[1] + (cloneIndexHutang);
					}
				})
				.on('click', 'a.cloneHutang', cloneHutang)
				.on('click', 'a.removeHutang', removeHutang);

			$("#clonedHutang"+cloneIndexHutang).find('.klembagakeuangan').attr('name', 'Hutang['+cloneIndexHutang+'][lembaga_keuangan]');
			$("#clonedHutang"+cloneIndexHutang).find('.kjumlahpinjaman').attr('name', 'Hutang['+cloneIndexHutang+'][jumlah_pinjaman]');
			$("#clonedHutang"+cloneIndexHutang).find('.kjumlahangsuran').attr('name', 'Hutang['+cloneIndexHutang+'][jumlah_angsuran]');
			$("#clonedHutang"+cloneIndexHutang).find('.kjangkawaktu').attr('name', 'Hutang['+cloneIndexHutang+'][jangka_waktu]');
		}

		function removeHutang(){
			$(this).parents(".clonedHutang").remove();
		}
		$("a.cloneHutang").on("click", cloneHutang);

		$("a.removeHutang").on("click", removeHutang);
		///END OF CLONE FORM HUTANG///

		///CAPITAL, FORM DIMUNCULKAN / HIDE BERDASARKAN KEPEMILIKAN///
		$("select.caprumahstatus").on("change", checkKepemilikan);

		function checkKepemilikan(){
			var form = $(this).closest('form');
			if($(this).val()=='sewa'){
				form.find('#capisewa').show();
			}
			else{
				form.find('#capisewa').hide();
			}

			if($(this).val()=='angsuran'){
				form.find('#capiangs').show();
			}
			else{
				form.find('#capiangs').hide();
			}
		}
		///END OF CAPITAL, FORM DIMUNCULKAN / HIDE BERDASARKAN KEPEMILIKAN///

		var global_perc = $("input.colbpkbpercbank").val();
		var s_id 		= $("input.colbpkbpercbank").attr('id');
		
		///COLLATERAL, BPKB CHECK PERSENTASI BANK UNTUK PASSCODE///
		$("input.colbpkbpercbank").on("change", checBPKBButuhPasscode);
		function checBPKBButuhPasscode(){
			var perc 	= $(this).val();
			var s_id 	= $(this).attr('id').replace('colbpkbpercbank', '');
			if(perc > 50){
				$('#modal_passcode_entry').modal('toggle');
			}
			else{
				global_perc = $(this).val();
			}
		}

			//SET PERSENTASI BANK SEBELUM PERUBAHAN
			//dibutuhkan jika passcode tidak diisi
			$("input.colbpkbpercbank").on("focus", setBPKBPersentasiBank);

			function setBPKBPersentasiBank(){
				global_perc = $(this).val();
				s_id = $(this).attr('id').replace('colbpkbpercbank', '');
			}

			//PENGENDALI EVENT PASSCODE
			$(".modal-close").on("click", revertDataPasscode);
			$("#passcode_batal").on("click", revertDataPasscode);
			$("#passcode_batal").on("click", hitungBPKBHargaBank);

			$("#passcode_simpan").on("click", setPercBank);
			$("#passcode_simpan").on("click", hitungBPKBHargaBank);
			$("#passcode_simpan").on("click", parsingDataPasscode);

			function parsingDataPasscode(){
				$('#passcode'+s_id).val($('#passcode_oke').val());
			}

			function revertDataPasscode(){
				$('input#colbpkbpercbank'+s_id).val(global_perc);
				$('#passcode'+s_id).val('');
			}
			
			function setPercBank(){
				global_perc = $('#colbpkbpercbank'+s_id).val();
			}
		///END OF COLLATERAL, BPKB CHECK PERSENTASI BANK UNTUK PASSCODE///

		///COLLATERAL, HITUNG HARGA BANK BPKB///
		$("input.colbpkbpercbank").on("change", hitungBPKBHargaBank);
		function hitungBPKBHargaBank(){
			//CHANGE
			var nilaik 	= $('#colbpkbnilaik'+s_id).val().replace('Rp', '');
			nilaitax 	= nilaik.replace(/[\.]+/g, '') * 1;
			nilaitax 	= nilaitax * (global_perc / 100); 

			$('#colbpkbnilaibank'+s_id).text(nilaitax);
			$('#colbpkbnilaibank'+s_id).digits();
			$('#colbpkbnilaibank'+s_id).prepend('Rp ');			
		}


		///END COLLATERAL, HITUNG HARGA BANK BPKB///

		///COLLATERAL, HITUNG HARGA TAKSASI BPKB///
		$("input.colbpkbperctax").on("change", hitungBPKBHargaTaksasi);
		function hitungBPKBHargaTaksasi(){
			var id 		= $(this).attr('id').replace('colbpkbperctax', '');
			var nilaik 	= $('#colbpkbnilaik'+id).val().replace('Rp', '');
			nilaitax 	= nilaik.replace(/[\.]+/g, '') * 1;
			nilaitax 	= nilaitax * ($(this).val() / 100); 

			$(this).closest('form').find('#colnilaitaxbpkb'+id).text(nilaitax);
			$(this).closest('form').find('#colnilaitaxbpkb'+id).digits();
			$(this).closest('form').find('#colnilaitaxbpkb'+id).prepend('Rp ');
		}
		///END OF COLLATERAL, HITUNG HARGA TAKSASI BPKB///


		///COLLATERAL, HITUNG HARGA TAKSASI SERTIFIKAT///
		$("input.colsertifikatperctax").on("change", hitungSertifikatHargaTaksasi);
		function hitungSertifikatHargaTaksasi(){
			var nilait 	= $(this).closest('form').find('.colsertifikatnilait').val();
			var nilaib 	= $(this).closest('form').find('.colsertifikatnilaib').val();

			if(nilait){
				nilait 	= nilait.replace('Rp', '');
				nilait 	= (nilait.replace(/[\.]+/g, '') * 1);
			}else{
				nilait 	= 0;
			}

			if(nilaib){
				nilaib 	= nilaib.replace('Rp', '');
				nilaib 	= (nilaib.replace(/[\.]+/g, '') * 1);
			}else{
				nilaib 	= 0;
			}

			nilaitax 	= nilait + nilaib;
			nilaitax 	= nilaitax * ($(this).val() / 100); 

			$(this).closest('form').find('.colsertifikatnilaitax').text(nilaitax);
			$(this).closest('form').find('.colsertifikatnilaitax').digits();
			$(this).closest('form').find('.colsertifikatnilaitax').prepend('Rp ');
		}
		///END OF COLLATERAL, HITUNG HARGA TAKSASI SERTIFIKAT///

		//FUNGSI GLOBAL
		$.fn.digits = function(){ 
		    return this.each(function(){ 
		        $(this).text( $(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.") ); 
		    })
		}
		//END OF FUNGSI GLOBAL

		//PERUBAHAN NILAI KENDARAAN, HITUNG ULANG PERSENTASI BANK
		$("input.colbpkbnilaik").on("change", triggerBPKBPerubahanHargaKendaraan);

		function triggerBPKBPerubahanHargaKendaraan(){
			s_id = $(this).attr('id').replace('colbpkbnilaik', '');
			$("#colbpkbpercbank"+s_id).trigger('change');
			$("#colbpkbperctax"+s_id).trigger('change');
		}
		//END OF PERUBAHAN NILAI KENDARAAN, HITUNG ULANG PERSENTASI BANK


		//PERUBAHAN STATUS PERNIKAHAN
		$(".catstatuspernikahan").on("change", hitungTanggunganKeluarga);
		
		function hitungTanggunganKeluarga(){
			status_p = $(this).val().replace('K-', '');
			if(status_p.toLowerCase()=='tk'){
				tanggungan 	= 1500000;
			}else if(status_p.toLowerCase()=='k'){
				tanggungan 	= 3000000;
			}else{
				tanggungan 	= 3000000 + (status_p * 1250000);
			}

			$(this).closest('form').find('.cattanggungankeluarga').text(tanggungan);
			$(this).closest('form').find('.cattanggungankeluarga').digits();
			$(this).closest('form').find('.cattanggungankeluarga').prepend('Rp ');
		}

		//CEK STATUS KEPEMILIKAN USAHA
		$(".capusahastatus").on("change", cekStatusKepemilikanUsaha);

		function cekStatusKepemilikanUsaha(){
			if($(this).val()=='kerjasama_bagi_hasil'){
				$(this).closest('form').find('.rowcapusahabagihasil').show();
			}else{
				$(this).closest('form').find('.rowcapusahabagihasil').hide();
			}
		}
	</script>
@endpush
