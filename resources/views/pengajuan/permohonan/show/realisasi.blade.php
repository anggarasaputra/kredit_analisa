<div class="row">
	<div class="col">
		<h5 class="pb-4">Realisasi</h5>
	</div>
</div>

@if($permohonan['status_terakhir']['status']!='realisasi' || $permohonan['status_terakhir']['status']!='expired')
	<h5 class="text-gray pl-3">Status</h5>
	<div class="row mb-2 mb-4 pl-3">
		<div class="col" role="tablist">
			<a href="{{route('pengajuan.realisasi.done', ['id' => $permohonan['id'], 'kantor_aktif_id' => $kantor_aktif['id']])}}" class="btn btn-outline-primary data-panel">
				sudah realisasi
			</a>
		</div>
	</div>
@endif
<h5 class="text-gray mb-4 pl-3">Pengikat</h5>
@foreach($putusan['checklists']['pengikat'] as $k2 => $v2)
	@if($v2=='ada')
		<div class="row pl-5">
			<div class="col-4">
				<p class="text-secondary text-capitalize pl-3">{{ str_replace('_', ' ', $k2) }}</p>
			</div>
			<div class="col-8 text-left">
				<p class="text-capitalize">
					<a href="{{route('pengajuan.pengajuan.print', ['id' => $permohonan['id'], 'mode' => $k2, 'kantor_aktif_id' => $kantor_aktif['id']])}}" target="__blank">
						<i class="fa fa-print"></i> print
					</a>
				</p>
			</div>
		</div>
	@endif
@endforeach