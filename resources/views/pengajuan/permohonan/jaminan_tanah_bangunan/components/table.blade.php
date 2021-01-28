@if(count($jaminan_tanah_bangunan))
<p class="text-secondary text-capitalize mb-1">tanah &amp; bangunan</p>
<table class="table table-sm table-bordered">
	<thead class="thead-default">
		<tr>
			<th style="border:1px #aaa solid;vertical-align:middle;" class="text-center" rowspan="2">#</th>
			<th style="border:1px #aaa solid" class="text-center" colspan="4">Sertifikat</th>
			<th style="border:1px #aaa solid;vertical-align:middle;" class="text-center" rowspan="2">Tahun Perolehan</th>
			<th style="border:1px #aaa solid;vertical-align:middle;" class="text-center" rowspan="2">Harga Jaminan (*)</th>
		</tr>
		<tr>
			<th style="border:1px #aaa solid">Jenis [Masa Berlaku]</th>
			<th style="border:1px #aaa solid">Nomor</th>
			<th style="border:1px #aaa solid">Tipe</th>
			<th style="border:1px #aaa solid">Luas</th>
		</tr>
	</thead>
	<tbody>
		@forelse($jaminan_tanah_bangunan as $kj => $vj)
		<tr>
			<td style="border:1px #aaa solid" class="text-center">{{$kj+1}}</td>
			<td style="border:1px #aaa solid">{{strtoupper($vj['jenis'])}} </td>
			<td style="border:1px #aaa solid">
				{{$vj['dokumen_jaminan'][$vj['jenis']]['nomor_sertifikat']}}
				@if(isset($vj['dokumen_jaminan'][$vj['jenis']]['masa_berlaku_sertifikat']))
					[{{$vj['dokumen_jaminan'][$vj['jenis']]['masa_berlaku_sertifikat']}}]
				@endif
			</td>
			<td style="border:1px #aaa solid">{{str_replace('_', ' ', $vj['dokumen_jaminan'][$vj['jenis']]['tipe'])}}</td>
			<td style="border:1px #aaa solid">
				Luas Tanah : {{$vj['dokumen_jaminan'][$vj['jenis']]['luas_tanah']}}M<sup>2</sup>
				<br/>
				@if(isset($vj['dokumen_jaminan'][$vj['jenis']]['luas_bangunan']))
					Luas Bangunan : {{$vj['dokumen_jaminan'][$vj['jenis']]['luas_bangunan']}}M<sup>2</sup>
				@endif
			</td>
			<td style="border:1px #aaa solid" class="text-right">{{$vj['tahun_perolehan']}}</td>
			<td style="border:1px #aaa solid" class="text-right">{{$vj['nilai_jaminan']}}</td>
		</tr>
		@empty
			<tr>
				<td style="border:1px #aaa solid" colspan="7" class="text-center"><i class="text-secondary">tidak ada data</i></td>
			</tr>
		@endforelse
		@if(isset($allow_add) && $allow_add)
		<tr>
			<td style="border:1px #aaa solid" colspan="7" class="text-right">
				<a href="#" class="btn btn-primary btn-sm btn-link mb-1" data-toggle="modal" data-target="#jaminan-tanah-bangunan"><i class="fa fa-plus"></i> Jaminan Tanah &amp; Bangunan</a>
			</td>
		</tr>
		@else
		<tr>
			<td style="border:1px #aaa solid" colspan="7" class="text-right">
				<small>
					<i class="text-secondary">* menurut nasabah</i>
				</small>
			</td>
		</tr>
		@endif
	</tbody>
</table>
<div class="clearfix">&nbsp;</div>
@elseif(isset($allow_add) && $allow_add)
	<a href="#" class="btn btn-primary btn-sm btn-link mb-1" data-toggle="modal" data-target="#jaminan-tanah-bangunan"><i class="fa fa-plus"></i> Jaminan Tanah &amp; Bangunan</a>
	<div class="clearfix">&nbsp;</div>
@endif
