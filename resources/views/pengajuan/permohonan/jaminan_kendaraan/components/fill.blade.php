@isset($title)
	<p class="text-secondary mb-4"><strong><u>Kendaraan</u></strong></p>
@endisset

<a href="#" class="btn btn-primary btn-sm btn-link mb-1" data-toggle="modal" data-target="#jaminan-kendaraan"><i class="fa fa-plus"></i> Jaminan Kendaraan</a>

<table class="table table-sm table-responsive">
	<thead class="thead-default">
		<tr>
			<th>#</th>
			<th>Jenis</th>
			<th>Merk</th>
			<th>Tipe</th>
			<th class="text-center">Tahun</th>
			<th class="text-center">No. BPKB</th>
			<th>Atas Nama</th>
			<th class="text-center">Nilai Jaminan</th>
			<th class="text-center">Tahun Perolehan</th>
			<th></th>
		</tr>
	</thead>
	<tbody id="content-kendaraan">
		{{-- @if (isset($permohonan[''])) --}}
		{{-- @isset ($permohonan['jaminan']) --}}
			
		{{-- @endisset --}}

		{{-- @empty ($permohonan['jaminan']) --}}
			<tr id="content-kendaraan-default">
				<td colspan="10" class="text-center">Belum ada jaminan kendaraan</td>
			</tr>
			<tr id="clone-kendaraan" style="display: none;">
				<td class="nomor text-capitalize"></td>
				<td class="jenis text-capitalize"></td>
				<td class="merk text-capitalize"></td>
				<td class="tipe text-capitalize"></td>
				<td class="tahun text-uppercase text-center"></td>
				<td class="nomor_bpkb text-capitalize text-center"></td>
				<td class="atas_nama text-capitalize"></td>
				<td class="nilai_jaminan text-capitalize text-right"></td>
				<td class="tahun_perolehan text-center"></td>
				<td class="action"></td>

				{!! Form::hidden('jenis', null, ['disabled' => true]) !!}
				{!! Form::hidden('merk', null, ['disabled' => true]) !!}
				{!! Form::hidden('tipe', null, ['disabled' => true]) !!}
				{!! Form::hidden('tahun', null, ['disabled' => true]) !!}
				{!! Form::hidden('nomor_bpkb', null, ['disabled' => true]) !!}
				{!! Form::hidden('atas_nama', null, ['disabled' => true]) !!}
				{!! Form::hidden('nilai_jaminan', null, ['disabled' => true]) !!}
				{!! Form::hidden('tahun_perolehan', null, ['disabled' => true]) !!}
			</tr>
		{{-- @endempty --}}
	</tbody>
</table>
<div class="clearfix">&nbsp;</div>