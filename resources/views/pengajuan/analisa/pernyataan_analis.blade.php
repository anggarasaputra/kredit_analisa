<div class="clearfix">&nbsp;</div>

<div class="row">
	<div class="col-sm-12 text-center">
		<h5>PERNYATAAN ANALIS</h5>
	</div>
</div> 

<div style="font-size:11px;">
	<div class="row">
		<div class="col-sm-12">
			<div class="row text-justify">
				<div class="col-sm-12 text-left">
					<p>Dari hasil wawancara dan survey lapangan, analisa yang dapat direkomendasikan tentang nasabah tersebut mempunyai :</p>
				</div>
			</div>
			<div class="row text-justify">
				<div class="col-sm-6 text-left">
					Character
				</div>
				<div class="col-sm-6 text-left">
					{{ucwords(str_replace('_',' ', $permohonan['analisa']['character']))}}
				</div>
			</div>
			<div class="row text-justify">
				<div class="col-sm-6 text-left">
					Capacity
				</div>
				<div class="col-sm-6 text-left">
					{{ucwords(str_replace('_',' ', $permohonan['analisa']['capacity']))}}
				</div>
			</div>
			<div class="row text-justify">
				<div class="col-sm-6 text-left">
					Collateral
				</div>
				<div class="col-sm-6 text-left">
					{{ucwords(str_replace('_',' ', $permohonan['analisa']['collateral']))}}
				</div>
			</div>
			<div class="row text-justify">
				<div class="col-sm-6 text-left">
					Capital
				</div>
				<div class="col-sm-6 text-left">
					{{ucwords(str_replace('_',' ', $permohonan['analisa']['capital']))}}
				</div>
			</div>
			<div class="row text-justify">
				<div class="col-sm-6 text-left">
					Condition
				</div>
				<div class="col-sm-6 text-left">
					{{ucwords(str_replace('_',' ', $permohonan['analisa']['condition']))}}</p>
				</div>
			</div>
		</div>
		<div class="col-sm-12">
			<div class="row text-justify">
				<div class="col-sm-12 text-left">
					<p>Plafon Kredit yang direkomendasikan :</p>
				</div>
			</div>

			<div class="row text-justify">
				<div class="col-sm-6 text-left">
					Jenis Pinjaman
				</div>
				<div class="col-sm-6 text-right">
					{{strtoupper($permohonan['analisa']['jenis_pinjaman'])}}
				</div>
			</div>
			<div class="row text-justify">
				<div class="col-sm-6 text-left">
					Suku Bunga
				</div>
				<div class="col-sm-6 text-right">
					{{$permohonan['analisa']['suku_bunga']}} %
				</div>
			</div>

			<div class="row text-justify">
				<div class="col-sm-6 text-left">
					Jangka Waktu
				</div>
				<div class="col-sm-6 text-right">
					{{$permohonan['analisa']['jangka_waktu']}} bulan
				</div>
			</div>
			<div class="row text-justify">
				<div class="col-sm-6 text-left">
					Max. Plafon Kredit
				</div>
				<div class="col-sm-6 text-left">
					{{$permohonan['analisa']['limit_angsuran']}} x {{$permohonan['analisa']['limit_jangka_waktu']}} bulan
				</div>
			</div>
			<div class="row text-justify">
				<div class="col-sm-6 text-left">
				</div>
				<div class="col-sm-6 text-right">
					{{$terbilang->formatMoneyTo($terbilang->formatmoneyfrom($permohonan['analisa']['limit_angsuran']) * $permohonan['analisa']['limit_jangka_waktu'])}} 
				</div>
			</div>
			<div class="row text-justify">
				<div class="col-sm-6 text-left">
					Kredit yang diusulkan
				</div>
				<div class="col-sm-6 text-right">
					{{$permohonan['analisa']['kredit_diusulkan']}}
				</div>
			</div>
			<div class="row text-justify">
				<div class="col-sm-12 text-left">
					<p>Pengembalian Angsuran Kredit Perbulan :</p>
				</div>
			</div>
			<div class="row text-justify">
				<div class="col-sm-6 text-left">
					Angsuran Pokok
				</div>
				<div class="col-sm-6 text-right">
					{{$permohonan['analisa']['angsuran_pokok']}}
				</div>
			</div>
			<div class="row text-justify">
				<div class="col-sm-6 text-left">
					Angsuran Bunga
				</div>
				<div class="col-sm-6 text-right">
					{{$permohonan['analisa']['angsuran_bunga']}}
				</div>
			</div>
			<div class="row text-justify">
				<div class="col-sm-6 text-left">
					Total Angsuran
				</div>
				<div class="col-sm-6 text-right">
					{{$terbilang->formatMoneyTo($terbilang->formatmoneyfrom($permohonan['analisa']['angsuran_pokok']) + $terbilang->formatmoneyfrom($permohonan['analisa']['angsuran_bunga']))}} 
				</div>
			</div>
		</div>
	</div>
	<div class="clearfix">&nbsp;</div>
	<div class="clearfix">&nbsp;</div>
	<div class="row">
		<div class="col-sm-6 text-center">
			{{$pimpinan['kantor']['alamat']['kota']}}, {{Carbon\Carbon::now()->format('d/m/Y')}}
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6 text-center">
			Analis Kredit
			<br/>
			<br/>
			<br/>
			{{$permohonan['analisa']['analis']['nama']}}
		</div>
		<div class="col-sm-6 text-center">
			Pimpinan
			<br/>
			<br/>
			<br/>
			{{$pimpinan['orang']['nama']}}
		</div>
	</div>
</div>