@if(count($jaminan_kendaraan))
<p class="text-secondary text-capitalize mb-1">kendaraan</p>
<table class="table table-sm table-bordered" style="">
	<thead class="thead-default">
		<tr>
			<th style="border:1px #aaa solid" class="text-center">#</th>
			<th style="border:1px #aaa solid" class="text-center">Jenis</th>
			<th style="border:1px #aaa solid" class="text-center">No. BPKB</th>
			<th style="border:1px #aaa solid">Merk</th>
			<th style="border:1px #aaa solid">Tipe [Tahun]</th>
			<th style="border:1px #aaa solid" class="text-center">Tahun Perolehan</th>
			<th style="border:1px #aaa solid" class="text-center">Harga Jaminan (*)</th>
		</tr>
	</thead> 
	<tbody>
		@forelse ($jaminan_kendaraan as $kj => $vj)
		<tr>
			<td style="border:1px #aaa solid" class="text-center">{{ ($kj + 1) }}</td>
			<td style="border:1px #aaa solid" class="text-center">{{ ucwords(str_replace('_', ' ', $vj['dokumen_jaminan']['bpkb']['tipe'])) }}</td>
			<td style="border:1px #aaa solid" class="text-center">{{ $vj['dokumen_jaminan']['bpkb']['nomor_bpkb'] }}</td>
			<td style="border:1px #aaa solid">{{ ucwords($vj['dokumen_jaminan']['bpkb']['merk']) }}</td>
			<td style="border:1px #aaa solid">{{ ucwords(str_replace('_', ' ', $vj['dokumen_jaminan']['bpkb']['jenis'])) }} [{{ $vj['dokumen_jaminan']['bpkb']['tahun'] }}]</td>
			<td style="border:1px #aaa solid" class="text-center">{{ $vj['tahun_perolehan'] }}</td>
			<td style="border:1px #aaa solid" class="text-right">{{ $vj['nilai_jaminan'] }}</td>
		</tr>
		@empty
			<tr>
				<td style="border:1px #aaa solid" colspan="7" class="text-center"><i class="text-secondary">tidak ada data</i></td>
			</tr>
		@endforelse
		@if(isset($allow_add) && $allow_add)
		<tr>
			<td style="border:1px #aaa solid" colspan="7" class="text-right">
				<a href="#" class="btn btn-primary btn-sm btn-link mb-1 text-right" data-toggle="modal" data-target="#jaminan-kendaraan"><i class="fa fa-plus"></i> Jaminan Kendaraan</a>
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
	<a href="#" class="btn btn-primary btn-sm btn-link mb-1 text-right" data-toggle="modal" data-target="#jaminan-kendaraan"><i class="fa fa-plus"></i> Jaminan Kendaraan</a>
	<div class="clearfix">&nbsp;</div>
@endif
