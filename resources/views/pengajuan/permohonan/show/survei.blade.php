<div class="row">
	<div class="col">
		<h5 class="pb-4">Survei</h5>
	</div>
</div>
{{-- isi data survei seperti table dibawah --}}
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
					<td>{{ ($k+1) }}</td>
					<td>{{ $v['surveyor']['nama'] }}</td>
					<td>{{ $v['tanggal'] }}</td>
					<td>
						<a href="#">
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


{{---FORM SURVEI---}}
@foreach($survei as $k => $v)
<div class="row">
	<div class="col">
		<nav class="nav nav-tabs mb-5 border" role="tablist" style="background-color: #fafafa;">
			<a href="#character" class="nav-item nav-link active w-20 text-primary rounded-0" data-toggle="tab" role="tab" aria-controls="character" aria-expanded="true"><h6 class="mb-0">Character</h6></a>
			<a href="#condition" class="nav-item nav-link w-20 text-primary rounded-0" data-toggle="tab" role="tab" aria-controls="condition" aria-expanded="true"><h6 class="mb-0">Condition</h6></a>
			<a href="#capacity" class="nav-item nav-link w-20 text-primary rounded-0" data-toggle="tab" role="tab" aria-controls="capacity" aria-expanded="true"><h6 class="mb-0">Capacity</h6></a>
			<a href="#capital" class="nav-item nav-link w-20 text-primary rounded-0" data-toggle="tab" role="tab" aria-controls="capital" aria-expanded="true"><h6 class="mb-0">Capital</h6></a>
			<a href="#collateral" class="nav-item nav-link w-20 text-primary rounded-0" data-toggle="tab" role="tab" aria-controls="collateral" aria-expanded="true"><h6 class="mb-0">Collateral</h6></a>
		</nav>

		<div class="tab-content">
			<!-- data character -->
			<div class="tab-pane fade show active" id="character" role="tabpanel">
				<h5 class="text-gray mb-4 pl-3">Survei Character</h5>
				@foreach($v['character']['dokumen_survei']['character'] as $k2 => $v2)
					@if(is_array($v2))
						<p class="text-secondary text-capitalize pl-3">{{ str_replace('_', ' ', $k2) }}</p>
						@foreach($v2 as $k3 => $v3)
							@if(is_array($v3))
								@foreach($v3 as $k4 => $v4)
									<div class="row pl-5">
										<div class="col-3">
											<p class="text-secondary text-capitalize">{{ str_replace('_', ' ', $k4) }}</p>
										</div>
										<div class="col">
											<p class="text-capitalize">{{ str_replace('_', ' ', $v4) }}</p>
										</div>
									</div>
								@endforeach
							@else
								<div class="row pl-5">
									<div class="col-3">
										<p class="text-secondary text-capitalize">{{ str_replace('_', ' ', $k3) }}</p>
									</div>
									<div class="col">
										<p class="text-capitalize">{{ str_replace('_', ' ', $v3) }}</p>
									</div>
								</div>
							@endif
						@endforeach
					@else
						<div class="row pl-3">
							<div class="col-3">
								<p class="text-secondary text-capitalize">{{ str_replace('_', ' ', $k2) }}</p>
							</div>
							<div class="col">
								<p class="text-capitalize">{{ str_replace('_', ' ', $v2) }}</p>
							</div>
						</div>
					@endif
				@endforeach
			</div>

			<!-- data condition -->
			<div class="tab-pane fade show" id="condition" role="tabpanel">
				<h5 class="text-gray mb-4 pl-3">Survei Condition</h5>
				@foreach($v['condition']['dokumen_survei']['condition'] as $k2 => $v2)
					@if(is_array($v2))
						<p class="text-secondary text-capitalize pl-3">{{ str_replace('_', ' ', $k2) }}</p>
						@foreach($v2 as $k3 => $v3)
							@if(is_array($v3))
								@foreach($v3 as $k4 => $v4)
									<div class="row pl-5">
										<div class="col-3">
											<p class="text-secondary text-capitalize">{{ str_replace('_', ' ', $k4) }}</p>
										</div>
										<div class="col">
											<p class="text-capitalize">{{ str_replace('_', ' ', $v4) }}</p>
										</div>
									</div>
								@endforeach
							@else
								<div class="row pl-5">
									<div class="col-3">
										<p class="text-secondary text-capitalize">{{ str_replace('_', ' ', $k3) }}</p>
									</div>
									<div class="col">
										<p class="text-capitalize">{{ str_replace('_', ' ', $v3) }}</p>
									</div>
								</div>
							@endif
						@endforeach
					@else
						<div class="row pl-3">
							<div class="col-3">
								<p class="text-secondary text-capitalize">{{ str_replace('_', ' ', $k2) }}</p>
							</div>
							<div class="col">
								<p class="text-capitalize">{{ str_replace('_', ' ', $v2) }}</p>
							</div>
						</div>
					@endif
				@endforeach
			</div>

			<!-- data capacity -->
			<div class="tab-pane fade show" id="capacity" role="tabpanel">
				<h5 class="text-gray mb-4 pl-3">Survei Capacity</h5>
				@foreach($v['capacity']['dokumen_survei']['capacity'] as $k2 => $v2)
					@if(is_array($v2))
						<p class="text-secondary text-capitalize pl-3">{{ str_replace('_', ' ', $k2) }}</p>
						@foreach($v2 as $k3 => $v3)
							@if(is_array($v3))
								@foreach($v3 as $k4 => $v4)
									<div class="row pl-5">
										<div class="col-3">
											<p class="text-secondary text-capitalize">{{ str_replace('_', ' ', $k4) }}</p>
										</div>
										<div class="col">
											<p class="text-capitalize">{{ str_replace('_', ' ', $v4) }}</p>
										</div>
									</div>
								@endforeach
							@else
								<div class="row pl-5">
									<div class="col-3">
										<p class="text-secondary text-capitalize">{{ str_replace('_', ' ', $k3) }}</p>
									</div>
									<div class="col">
										<p class="text-capitalize">{{ str_replace('_', ' ', $v3) }}</p>
									</div>
								</div>
							@endif
						@endforeach
					@else
						<div class="row pl-3">
							<div class="col-3">
								<p class="text-secondary text-capitalize">{{ str_replace('_', ' ', $k2) }}</p>
							</div>
							<div class="col">
								<p class="text-capitalize">{{ str_replace('_', ' ', $v2) }}</p>
							</div>
						</div>
					@endif
				@endforeach
			</div>

			<!-- data capital -->
			<div class="tab-pane fade show" id="capital" role="tabpanel">
				<h5 class="text-gray mb-4 pl-3">Survei Capital</h5>
				@foreach($v['capital']['dokumen_survei']['capital'] as $k2 => $v2)
					@if(is_array($v2))
						<p class="text-secondary text-capitalize pl-3">{{ str_replace('_', ' ', $k2) }}</p>
						@foreach($v2 as $k3 => $v3)
							@if(is_array($v3))
								@foreach($v3 as $k4 => $v4)
									<div class="row pl-5">
										<div class="col-3">
											<p class="text-secondary text-capitalize">{{ str_replace('_', ' ', $k4) }}</p>
										</div>
										<div class="col">
											<p class="text-capitalize">{{ str_replace('_', ' ', $v4) }}</p>
										</div>
									</div>
								@endforeach
							@else
								<div class="row pl-5">
									<div class="col-3">
										<p class="text-secondary text-capitalize">{{ str_replace('_', ' ', $k3) }}</p>
									</div>
									<div class="col">
										<p class="text-capitalize">{{ str_replace('_', ' ', $v3) }}</p>
									</div>
								</div>
							@endif
						@endforeach
					@else
						<div class="row pl-3">
							<div class="col-3">
								<p class="text-secondary text-capitalize">{{ str_replace('_', ' ', $k2) }}</p>
							</div>
							<div class="col">
								<p class="text-capitalize">{{ str_replace('_', ' ', $v2) }}</p>
							</div>
						</div>
					@endif
				@endforeach
			</div>

			<!-- data collateral -->
			<div class="tab-pane fade show" id="collateral" role="tabpanel">
				<h5 class="text-gray mb-4 pl-3">Survei Collateral</h5>
				@foreach($v['collateral']['dokumen_survei']['collateral'] as $k2 => $v2)
					@if(is_array($v2))
						<p class="text-secondary text-capitalize pl-3">{{ str_replace('_', ' ', $k2) }}</p>
						@foreach($v2 as $k3 => $v3)
							@if(is_array($v3))
								@foreach($v3 as $k4 => $v4)
									<div class="row pl-5">
										<div class="col-3">
											<p class="text-secondary text-capitalize">{{ str_replace('_', ' ', $k4) }}</p>
										</div>
										<div class="col">
											<p class="text-capitalize">{{ str_replace('_', ' ', $v4) }}</p>
										</div>
									</div>
								@endforeach
							@else
								<div class="row pl-5">
									<div class="col-3">
										<p class="text-secondary text-capitalize">{{ str_replace('_', ' ', $k3) }}</p>
									</div>
									<div class="col">
										<p class="text-capitalize">{{ str_replace('_', ' ', $v3) }}</p>
									</div>
								</div>
							@endif
						@endforeach
					@endif
				@endforeach
			</div>
		</div>
	</div>
</div>
@endforeach
