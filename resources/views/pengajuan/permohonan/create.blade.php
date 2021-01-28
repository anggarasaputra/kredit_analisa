@push('css')
	<style>
		.nav-tabs .nav-link.active {
			border-radius: 0 !important;
			border-top: 0 !important;
			border-left: 0 !important;
			border-right: 0 !important;
			border-bottom: 1px solid #eee;
		}
		.nav-tabs .nav-link:hover, .nav-tabs .nav-link:hover .active{
			border: 0 !important;
		}
	</style>
@endpush

@push('main')
	<div class="container bg-white bg-shadow">

		<div class="row">
			<div class="col p-5">
				<h4 class='mb-4 text-style text-uppercase text-secondary'>
					Permohonan Kredit Baru
				</h4>
				<nav class="nav nav-tabs mb-5 border" role="tablist" style="background-color: #fafafa;">
					<a href="#kredit" class="nav-item nav-link active w-25" data-toggle="tab" role="tab" aria-controls="kredit" aria-expanded="true"><h6 class="mb-0">1 &nbsp;kredit</h6></a>
					<a href="#nasabah" class="nav-item nav-link  w-25" data-toggle="tab" role="tab" aria-controls="nasabah" aria-expanded="true"><h6 class="mb-0">2 &nbsp;nasabah</h6></a>
					<a href="#keluarga" class="nav-item nav-link  w-25" data-toggle="tab" role="tab" aria-controls="kerabat-keluarga" aria-expanded="true"><h6 class="mb-0">3 &nbsp;kerabat/keluarga</h6></a>
					<a href="#jaminan" class="nav-item nav-link  w-25" data-toggle="tab" role="tab" aria-controls="jaminan" aria-expanded="true"><h6 class="mb-0">4 &nbsp;jaminan</h6></a>
				</nav>

				{!! Form::open(['url' => route('pengajuan.permohonan.store', ['kantor_aktif_id' => $kantor_aktif_id]), 'files' => true]) !!}
					<div class="tab-content">
						<!-- data kredit -->
						<div class="tab-pane fade show active" id="kredit" role="tabpanel">
							<h5 class="text-gray mb-4 pl-3">Data Kredit</h5>
							<div class="row">
								<div class="col">
									@include ('pengajuan.permohonan.kredit.form')
								</div>
							</div>
							<div class="clearfix">&nbsp;</div>
							<div class="clearfix">&nbsp;</div>
							<a href="#nasabah" class="btn btn-primary float-right mr-3" data-toggle="tab" role="tab" aria-controls="nasabah" aria-expanded="true">Selanjutnya</a>
						</div>

						<!-- data nasabah -->
						<div class="tab-pane fade" id="nasabah" role="tabpanel">
							<h5 class="text-gray mb-4 pl-3">Data Nasabah</h5>
							@include ('pengajuan.permohonan.nasabah.form')

							<div class="clearfix">&nbsp;</div>
							<div class="clearfix">&nbsp;</div>
							<a href="#kredit" class="btn btn-primary btn-outline float-left ml-3" data-toggle="tab" role="tab" aria-controls="kredit" aria-expanded="true">Sebelumnya</a>
							<a href="#keluarga" class="btn btn-primary float-right mr-3" data-toggle="tab" role="tab" aria-controls="keluarga" aria-expanded="true">Selanjutnya</a>
						</div>

						<!-- data keluarga -->
						 <div class="tab-pane fade" id="keluarga" role="tabpanel">
							<h5 class="text-gray mb-4 pl-3">Data Kerabat/Keluarga</h5>
							<div class="row ml-0 mr-0">
								<div class="col">
									<!-- table keluarga -->
									@include ('pengajuan.permohonan.keluarga.components.table')
								</div>
							</div>

							<div class="clearfix">&nbsp;</div>
							<div class="clearfix">&nbsp;</div>
							<a href="#nasabah" class="btn btn-primary btn-outline float-left ml-3" data-toggle="tab" role="tab" aria-controls="nasabah" aria-expanded="true">Sebelumnya</a>
							<a href="#jaminan" class="btn btn-primary float-right mr-3" data-toggle="tab" role="tab" aria-controls="jaminan" aria-expanded="true">Selanjutnya</a>
						</div>	

						<div class="tab-pane fade" id="jaminan" role="tabpanel">
							<h5 class="text-gray mb-4 pl-3">Data Jaminan</h5>
							<div class="row ml-0 mr-0">
								<div class="col">
									<!-- table jaminan kendaraan -->
									@include ('pengajuan.permohonan.jaminan_kendaraan.components.fill', ['title' => true])
									<div class="clearfix">&nbsp;</div>
									<!-- table jaminan tanah bangunan -->
									@include ('pengajuan.permohonan.jaminan_tanah_bangunan.components.fill', ['title' => true])
								</div>
							</div>
							
							<div class="clearfix">&nbsp;</div>
							<div class="clearfix">&nbsp;</div>
							<a href="#keluarga" class="btn btn-primary float-left ml-4" data-toggle="tab" role="tab" aria-controls="keluarga" aria-expanded="true">Sebelumnya</a>
							{!! Form::bsSubmit('Ajukan Permohonan', ['class' => 'btn btn-primary float-right mr-3']) !!}
						</div>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
	
<!--///////////////////////
	/// MODAL 		///////
 	/////////////////////// -->
 	<!-- keluarga -->
 	@component ('bootstrap.modal', ['id' => 'keluarga'])
 		@slot ('title')
 			Kerabat/Keluarga
 		@endslot

 		@slot ('body')
 			@include ('pengajuan.permohonan.keluarga.components.form')
 		@endslot

 		@slot ('footer')
 			<a href="#" data-dismiss="modal" class="btn btn-default">Batal</a>
 			<a href="#" class="btn btn-primary add" data-modal="add" data-dismiss="modal" data-id="keluarga">Tambahkan</a>
 		@endslot
 	@endcomponent

 	<!-- jaminan kendaraan -->
	@component ('bootstrap.modal', ['id' => 'jaminan-kendaraan'])
		@slot ('title')
			Jaminan Kendaraan
		@endslot

		@slot ('body')
			@include ('pengajuan.permohonan.jaminan_kendaraan.components.form')	
		@endslot

		@slot ('footer')
			<a href="#" data-dismiss="modal" class="btn btn-default">Batal</a>
			<a href="#" class="btn btn-primary add" data-modal="add" data-dismiss="modal" data-id="jaminan-kendaraan">Tambahkan</a>
		@endslot
	@endcomponent

	<!-- jaminan tanah & bangunan -->
	@component ('bootstrap.modal', ['id' => 'jaminan-tanah-bangunan'])
		@slot ('title')
			Jaminan Tanah &amp; Bangunan
		@endslot

		@slot ('body')
			@include ('pengajuan.permohonan.jaminan_tanah_bangunan.components.form')	
		@endslot

		@slot ('footer')
			<a href="#" data-dismiss="modal" class="btn btn-default">Batal</a>
			<a href="#" class="btn btn-primary add" data-modal="add" data-dismiss="modal" data-id="jaminan-tanah-bangunan">Tambahkan</a>
		@endslot
	@endcomponent

@endpush

@push('submenu')
	@include('templates.submenu.submenu')
@endpush

@push ('js')
	<script>
		inputKendaraan = ['jenis', 'merk', 'tipe', 'tahun', 'nomor_bpkb', 'nilai_jaminan', 'tahun_perolehan', 'atas_nama'];
		inputTanahBangunan = ['jenis_sertifikat', 'tipe', 'nomor_sertifikat', 'luas_tanah', 'luas_bangunan', 'atas_nama', 'nilai_jaminan', 'jenis', 'tahun_perolehan', 'alamat[alamat]', 'alamat[rt]', 'alamat[rw]', 'alamat[kota]', 'alamat[kecamatan]', 'alamat[kelurahan]'];
		inputKeluarga = ['hubungan', 'nik', 'nama', 'telepon'];

		templateKendaraan = $(document.getElementById('clone-kendaraan'));
		templateTanahBangunan = $(document.getElementById('clone-tanah-bangunan'));
		templateKeluarga = $(document.getElementById('clone-keluarga'));
		
		function setTemplateClone() {

		}

		function getData () {

		}

		$('.add').on('click', function (e) {
			e.preventDefault();
			dataInput = $(this).attr('data-input');
			dataId = $(this).attr('data-id');

			if (dataId == 'jaminan-kendaraan') {
				elClone = templateKendaraan.clone();
				countClone = $('#content-kendaraan').find('tr.clone-kendaraan')
								.length;

				// remove attribute 'id' in template clone
				// and add class clone kendaraan
				elClone.attr('id', elClone.attr('id') + '-' + countClone)
					.addClass('clone-kendaraan');

				// set variable data array to array 
				// dari kendaraan
				dataArray = inputKendaraan;
			} else if (dataId == 'keluarga') {
				elClone = templateKeluarga.clone();
				countClone = $('#content-keluarga').find('tr.clone-keluarga')
								.length;
				// remove attribute 'id' in template clone
				// and add class clone keluarga
				elClone.removeAttr('id')
					.addClass('clone-keluarga');
				// set variable data array 
				// dari array list keluarga
				dataArray = inputKeluarga;
			} else {
				elClone = templateTanahBangunan.clone();
				countClone = $('#content-tanah-bangunan').find('tr.clone-tanah-bangunan')
								.length;
				// remove attribute 'id' in template clone
				// and add class clone tanah & bangunan
				elClone.removeAttr('id')
					.addClass('clone-tanah-bangunan');
				// set variable data array 
				// dari array list tanah & bangunan
				dataArray = inputTanahBangunan;
			}

			// for untuk ambil data dari form modal
			// dan memparsing ke table & form hidden
			for (x=0; x < dataArray.length; x++) {
				dataForm = $(document.getElementById(dataId)).find('[name="' + dataArray[x] + '"]').val();
				inputName = elClone.find('[name*="' + dataArray[x] +'"]').attr('name');

				if (dataId  == 'jaminan-kendaraan') {
					prefixInput = 'bpkb';
				} else {
					prefixInput = $(document.getElementById(dataId)).find('[name="jenis_sertifikat"]').val();
				}

				if (typeof (dataForm) !== 'undefined') {
					// set input hidden
					elClone.find('[name="' + dataArray[x] + '"]')
						.val(dataForm)
						.removeAttr('disabled');

					// set display table
					switch (dataArray[x]) {
						// khusus luas tanah
						case 'luas_tanah': 
							// setting value td
							elClone.find('td.luas_tanah')
								.html(dataForm.replace('_', ' ') + ' M<sup>2</sup>');
							// setting name field hidden
							elClone.find('[name="' + dataArray[x] + '"]')
								.attr('name', 'jaminan[' + (countClone + 1) + '][dokumen_jaminan][' + prefixInput + '][' + inputName + ']')
							break;
						// khusus luas bangunan
						case 'luas_bangunan':
							// setting value td
							elClone.find('td.luas_tanah')
								.append(' / ' + dataForm.replace('_', ' ') + ' M<sup>2</sup>');
							// setting name field hidden
							elClone.find('[name="' + dataArray[x] + '"]')
								.attr('name', 'jaminan[' + (countClone + 1) + '][dokumen_jaminan][' + prefixInput + '][' + inputName + ']')
							break;
						case 'nilai_jaminan': case 'tahun_perolehan':
							// setting value td
							elClone.find('td.' + dataArray[x])
								.html(dataForm.replace('_', ' '));
							// setting name field hidden
							elClone.find('[name="' + dataArray[x] + '"]')
								.attr('name', 'jaminan[' + (countClone + 1) + '][' + inputName + ']')
							break;
						case 'jenis_sertifikat': 
							// setting value td
							elClone.find('td.' + dataArray[x])
								.html(dataForm.replace('_', ' '));
							// setting name field hidden
							elClone.find('[name="' + dataArray[x] + '"]')
								.attr('name', 'jaminan[' + (countClone + 1) + '][jenis]');
							break;
						default:
							if (dataId == 'keluarga') {
								// setting value td
								elClone.find('td.' + dataArray[x])
									.html(dataForm.replace('_', ' '));
								// setting name field hidden
								elClone.find('[name="' + dataArray[x] + '"]')
									.attr('name', 'nasabah[keluarga][' + (countClone + 1) + '][' + inputName + ']')
								break;
							} else {
								// setting value td
								elClone.find('td.' + dataArray[x])
									.html(dataForm.replace('_', ' '));
								// setting name field hidden
								elClone.find('[name="' + dataArray[x] + '"]')
									.attr('name', 'jaminan[' + (countClone + 1) + '][dokumen_jaminan][' + prefixInput + '][' + inputName + ']')
								break;
							}
					}
				}
			}

			if (dataId != 'keluarga') {
				elClone.append('<input type="hidden" name="jaminan['+ (countClone + 1) +'][jenis]" value="'+ prefixInput +'">');	
			}

			// tambah button delete & 
			// tambah nomor iterasi disetiap rownya
			if ((typeof (countClone) !== 'undefined')) {
				elClone.find('td.nomor')
					.html(countClone + 1);
				elClone.find('td.action')
					.html('<a href="#" class="btn btn-link text-danger btn-sm delete" data-id="' + elClone.attr('id') + '"><i class="fa fa-trash"></i></a>');

				$('.btn.delete').on('click', function(e) {
					e.preventDefault();
					deleteClone($(this));
				});
			}

			elClone.show();

			if (dataId == 'keluarga') {
				$('#content-keluarga-default').hide();
				$('#content-keluarga').append(elClone);
			} else if (dataId == 'jaminan-kendaraan') {
				$('#content-kendaraan-default').hide();
				$('#content-kendaraan').append(elClone);
			} else {
				$('#content-tanah-bangunan-default').hide();
				$('#content-tanah-bangunan').append(elClone);
			}
		});

		$('.modal').on('hide.bs.modal', function(e) {
			$(this).find('input').val('');
			$(this).find('select').val('');
		});

		function deleteClone (element) {
			elementId = element.attr('data-id');
			$(document.getElementById(elementId)).remove();
		} 
	</script>
@endpush