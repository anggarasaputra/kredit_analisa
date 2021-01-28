<div class="clearfix">&nbsp;</div>

<div class="row text-center">
	<div class="col-sm-12">
		<h5>PUTUSAN KOMITE KREDIT</h5>
	</div> 
</div> 

<div class="clearfix">&nbsp;</div>

<div style="font-size:11px;">
	<div class="row text-justify">
		<div class="col-sm-12 text-left">
			<p>Disetujui untuk diberikan fasilitas pinjaman @if($permohonan['putusan']['is_baru']) baru @else perpanjangan @endif</p>
		</div>
	</div>
	<div class="row text-justify">
		<div class="col-sm-3 text-left">
			<p>Plafon Pinjaman</p>
		</div>
		<div class="col-sm-9 text-left">
			<p>{{$permohonan['putusan']['plafon_pinjaman']}}</p>
		</div>
	</div>
	<div class="row text-justify">
		<div class="col-sm-3 text-left">
			<p>Suku Bunga</p>
		</div>
		<div class="col-sm-9 text-left">
			<p>{{$permohonan['putusan']['suku_bunga']}} %</p>
		</div>
	</div>
	<div class="row text-justify">
		<div class="col-sm-3 text-left">
			<p>Jangka Waktu</p>
		</div>
		<div class="col-sm-9 text-left">
			<p>{{$permohonan['putusan']['jangka_waktu']}}</p>
		</div>
	</div>
	<div class="row text-justify">
		<div class="col-sm-3 text-left">
			<p>Biaya Tambahan</p>
		</div>
		<div class="col-sm-9 text-left">
			<p>{{$permohonan['putusan']['provisi']}} provisi, {{$permohonan['putusan']['administrasi']}} administrasi,
			{{$permohonan['putusan']['legal']}} legal</p>
		</div>
	</div>
	<div class="row text-justify">
		<div class="col-sm-12 text-left">
			Jaminan
		</div>
	</div>
	<ol class="row">
		@foreach($survei['collateral'] as $k => $v)
			<li class="col-sm-6" style="padding:15px;">
				{{strtoupper($v['dokumen_survei']['collateral']['jenis'])}}<br/>
				@foreach($v['dokumen_survei']['collateral'][$v['dokumen_survei']['collateral']['jenis']] as $k2 => $v2)
					@if(in_array($k2, ['nomor_sertifikat', 'atas_nama_sertifikat', 'nilai_tanah', 'nilai_bangunan', 'harga_taksasi', 'nomor_bpkb', 'merk', 'tipe', 'atas', 'atas_nama', 'tahun', 'harga_bank']))
						{{str_replace('_',' ',$k2)}} {{str_replace('_',' ',$v2)}} <br/>
					@endif
				@endforeach
			</li>
		@endforeach
	</ol>
	<div class="row text-justify">
		<div class="col-sm-12 text-left">
			{{strtoupper($permohonan['putusan']['putusan'])}} dengan catatan {{strtoupper($permohonan['putusan']['catatan'])}}
		</div>
	</div>
	<div class="clearfix">&nbsp;</div>
	<div class="row text-center" style="padding:5px;">
		<div class="col-12" style="background-color:#aaa;border:1px solid; padding:5px;">
			KOMITE KREDIT
		</div>
	</div>
	<div class="row text-center" style="padding:5px;">
		<div class="col-sm-3" style="background-color:#aaa;border:1px solid; padding:5px;">
			ANALIS KREDIT
		</div>
		<div class="col-sm-3" style="background-color:#aaa;border:1px solid; border-left:none;padding:5px;">
			KABAG KREDIT
		</div>
		<div class="col-sm-3" style="background-color:#aaa;border:1px solid; border-left:none;padding:5px;">
			PIMPINAN
		</div>
		<div class="col-sm-3" style="background-color:#aaa;border:1px solid; border-left:none;padding:5px;">
			KOMISARIS
		</div>
		<div class="col-sm-3" style="border:1px solid;border-top:none;padding:5px;">
			<div class="clearfix">&nbsp;</div>
			<div class="clearfix">&nbsp;</div>
			<div class="clearfix">&nbsp;</div>
			<div class="clearfix">&nbsp;</div>
		</div>
		<div class="col-sm-3" style="border:1px solid;border-top:none;border-left:none;padding:5px;">
			<div class="clearfix">&nbsp;</div>
			<div class="clearfix">&nbsp;</div>
			<div class="clearfix">&nbsp;</div>
			<div class="clearfix">&nbsp;</div>
		</div>
		<div class="col-sm-3" style="border:1px solid;border-top:none;border-left:none;padding:5px;">
			<div class="clearfix">&nbsp;</div>
			<div class="clearfix">&nbsp;</div>
			<div class="clearfix">&nbsp;</div>
			<div class="clearfix">&nbsp;</div>
		</div>
		<div class="col-sm-3" style="border:1px solid;border-top:none;border-left:none;padding:5px;">
			<div class="clearfix">&nbsp;</div>
			<div class="clearfix">&nbsp;</div>
			<div class="clearfix">&nbsp;</div>
			<div class="clearfix">&nbsp;</div>
		</div>
	</div>
</div>
