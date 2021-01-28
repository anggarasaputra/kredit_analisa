@push('main')
	<div class="container bg-white bg-shadow p-4">
		<div class="row">
			<div class="col">
				<h4 class='mb-4 text-style text-secondary'>
					<span class="text-uppercase">SIMULASI KREDIT [{{strtoupper($mode)}}]</span> 
				</h4>
			</div>
		</div>
		{!! Form::open(['url' => route('simulasi', ['mode' => $mode, 'kantor_aktif_id' => $kantor_aktif_id]), 'method' => 'GET']) !!}
			<div class="row">
				<div class="col-3">
					{!! Form::bsText('Pokok Pinjaman', 'pokok_pinjaman', null, ['class' => 'form-control mask-money', 'placeholder' => 'masukkan pokok pinjaman']) !!}
				</div>
				@if($mode=='pa')
				<div class="col-3">
					{!! Form::bsText('Kemampuan Angsur', 'kemampuan_angsur', null, ['class' => 'form-control mask-money', 'placeholder' => 'masukkan kemampuan angsur']) !!}
				</div>
				@endif
				<div class="col-3">
					{!! Form::bsText('Bunga per Tahun', 'bunga_per_tahun', null, ['class' => 'form-control', 'placeholder' => 'masukkan bunga per tahun']) !!}
				</div>
				<div class="col-3" style="padding-top:23px;">
					{!! Form::bsSubmit('Hitung', ['class' => 'btn btn-primary float-left']) !!}
				</div>
			</div>
			{!! Form::hidden('kantor_aktif_id', $kantor_aktif['id']) !!}

			<!-- <div class="row">
				<div class="col-4">
					{!! Form::bsText('Provisi', 'provisi', null, ['class' => 'form-control', 'placeholder' => 'masukkan provisi']) !!}
				</div>
				<div class="col-4">
					{!! Form::bsText('Administrasi', 'administrasi', null, ['class' => 'form-control', 'placeholder' => 'masukkan administrasi']) !!}
				</div>
				<div class="col-4" style="padding-top:23px;">
					{!! Form::bsText('Legal', 'legal', null, ['class' => 'form-control', 'placeholder' => 'legal']) !!}
				</div>
			</div> -->

		{!!Form::close()!!}
		@if(!empty($rincian))
			<div class="row text-justify">
				<div class="col-4">
					<div class="row text-justify">
						<div class="col-6 text-left">
							Jumlah Pinjaman
						</div> 
						<div class="col-6 text-right">
							{{$rincian['pokok_pinjaman']}}
						</div> 
					</div>

					<div class="row text-justify">
						<div class="col-6 text-left">
							Biaya Provisi
						</div> 
						<div class="col-6 text-right">
							{{$rincian['provisi']}}
						</div> 
					</div>
					<div class="row text-justify">
						<div class="col-6 text-left">
							Biaya Administrasi
						</div> 
						<div class="col-6 text-right">
							{{$rincian['administrasi']}}
						</div> 
					</div>
					<div class="row text-justify">
						<div class="col-6 text-left">
							Biaya Legal
						</div> 
						<div class="col-6 text-right">
							{{$rincian['legal']}}
						</div> 
					</div>
					<div class="row text-justify">
						<div class="col-6 text-left">
							Pinjaman Bersih
						</div> 
						<div class="col-6 text-right">
							{{$rincian['pinjaman_bersih']}}
						</div> 
					</div>
				</div>
				<div class="col-4">
					<div class="row text-justify">
						<div class="col-6 text-left">
							Kemampuan Angsur
						</div> 
						<div class="col-6 text-right">
							{{$rincian['kemampuan_angsur']}}
						</div> 
					</div>
					<div class="row text-justify">
						<div class="col-6 text-left">
							Lama Angsuran
						</div> 
						<div class="col-6 text-right">
							{{$rincian['lama_angsuran']}} Bulan
						</div> 
					</div>
					<div class="row text-justify">
						<div class="col-6 text-left">
							Bunga Per Tahun
						</div> 
						<div class="col-6 text-right">
							{{$rincian['bunga_per_tahun']}} % 
						</div> 
					</div>
					<div class="row text-justify">
						<div class="col-6 text-left">
							Perhitungan Bunga
						</div> 
						<div class="col-6 text-right">
							{{strtoupper($mode)}}
						</div> 
					</div>
				</div>
			</div>
			<div class="clearfix">&nbsp;</div>
			<div class="row text-justify">
				<div class="col-12">
					<table class="table table-responsive table-bordered">
				  		<thead class="thead-default">
				  			<tr>
				  				<th>#</th>
				  				<th>Bulan</th>
				  				<th>Angsuran Bunga</th>
				  				<th>Angsuran Pokok</th>
				  				<th>Total Angsuran</th>
				  				<th>Sisa Pinjaman</th>
				  			</tr>
				  		</thead>
				  		<tbody>
							@foreach($rincian['angsuran'] as $k => $v)
					  			<tr>
						  			<td>{{($k)}}</td>
						  			<td>{{$v['bulan']}}</td>
						  			<td>{{$v['angsuran_bunga']}}</td>
						  			<td>{{$v['angsuran_pokok']}}</td>
						  			<td>{{$v['total_angsuran']}}</td>
						  			<td>{{$v['sisa_pinjaman']}}</td>
						  		</tr>
				  			@endforeach
				  		</tbody>
			  		</table>
		  		</div>
	  		</div>
		@endif
	</div>
@endpush

@push('submenu')
	@include('templates.submenu.submenu')
@endpush