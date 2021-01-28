<div class="row mt-4">
	<div class="col">
		<h5 class="pb-4">Kerabat/Keluarga</h5>
	</div>
</div>

<table class="table table-sm">
	<thead class="thead-default">
		<tr>
			<th>#</th>
			<th>Hubungan</th>
			<th>Nama</th>
			<th>NIK</th>
			<th>Telepon</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@isset ($permohonan['nasabah']['keluarga'])
			@foreach ($permohonan['nasabah']['keluarga'] as $k => $v)
				<tr>
					<td>{{ $k + 1 }}</td>
					@foreach ($v as $k2 => $v2)
						<td class="text-capitalize">{{ ucwords(str_replace('_', ' ', $v2)) }}</td>
					@endforeach
					<td>
						<a href="#" class="text-primary ml-2 mr-2"><i class="fa fa-edit"></i></a>
						<a href="#" class="text-danger ml-2 mr-2"><i class="fa fa-trash"></i></a>
					</td>
				</tr>
			@endforeach
		@endisset

		@empty ($permohonan['nasabah']['keluarga'])
			<tr>
				<td colspan="6" class="text-center">Belum ada data keluarga disimpan</td>
			</tr>
		@endempty
	</tbody>
</table>