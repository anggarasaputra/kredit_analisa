@isset ($add)
	<div class="row mb-2">
		<div class="col" role="tablist">
			<a href="#" class="btn btn-outline-primary data-panel" data-toggle="panel-toggle" data-target="#form" ><i class="fa fa-plus"></i> Kapital rumah</a>
		</div>
	</div>
@endisset

<table class="table table-sm table-responsive">
	<thead class="thead-default">
		<tr>
			<th>Ke</th>
			<th>Petugas</th>
			<th>Tanggal</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@isset ($survei)
			@foreach($survei as $k => $v)
				<tr>
					<td>{{ $loop->iteration }}</td>
					<td>{{ $v['surveyor']['nama'] }}</td>
					<td>{{ $v['tanggal'] }}</td>
					<td>
						<a href="#" class="data-panel" data-toggle="panel-toggle" data-target="#panel">
							<i class="fa fa-eye"></i>
						</a>
					</td>
				</tr>
			@endforeach
		@endisset

		@empty ($survei)
			<tr>
				<td class="text-center" colspan="4">Belum ada data survei</td>
			</tr>
		@endempty
	</tbody>
</table> 