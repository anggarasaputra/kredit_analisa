@isset ($title)
	<h6 class="text-secondary"><strong><u>Kerabat/Keluarga </u></strong></h6>
@endisset

<a href="#" class="btn btn-primary btn-sm btn-link" data-toggle="modal" data-target="#keluarga"><i class="fa fa-plus"></i> Kerabat/Keluarga</a>

<table class="table table-sm">
	<thead class="thead-default">
		<tr>
			<th>#</th>
			<th style="width: 15%">Hubungan</th>
			<th>Nama</th>
			<th class="text-center">NIK</th>
			<th>Telepon</th>
			<th></th>
		</tr>
	</thead>
	<tbody id="content-keluarga">
		<tr id="content-keluarga-default">
			<td colspan="6" class="text-center">Belum ada kerabat/keluarga</td>
		</tr>
		<tr id="clone-keluarga" style="display: none;">
			<td class="nomor"></td>
			<td class="hubungan text-capitalize"></td>
			<td class="nama text-capitalize"></td>
			<td class="nik text-capitalize"></td>
			<td class="telepon text-capitalize"></td>
			<td class="action"></td>

			{!! Form::hidden('hubungan', null, ['disabled' => true]) !!}
			{!! Form::hidden('nama', null, ['disabled' => true]) !!}
			{!! Form::hidden('nik', null, ['disabled' => true]) !!}
			{!! Form::hidden('telepon', null, ['disabled' => true]) !!}
		</tr>
	</tbody>
</table>
<div class="clearfix">&nbsp;</div>