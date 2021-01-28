<div class="clearfix">&nbsp;</div>

<div class="row">
	<div class="col-sm-12 text-center">
		<h5>PERMOHONAN KREDIT</h5>
		<p style="padding:10px;margin:0px;">
			{{$permohonan['id']}}
		</p>
	</div>
</div> 
<div class="clearfix">&nbsp;</div>
<div id="accordion" role="tablist" aria-multiselectable="true">
	<div class="card">
		<div class="card-header collapsed" role="tab" id="kredit" data-toggle="collapse" data-parent="#accordion" href="#collapsekredit" aria-expanded="false" aria-controls="collapsekredit" style="cursor: pointer">
			<div class="row">
				<div class="col-sm-8">
					KREDIT
				</div>
				<div class="col-sm-4 text-right">
					<a class="collapsed text-dark" data-toggle="collapse" data-parent="#accordion" href="#collapsekredit" aria-expanded="false" aria-controls="collapsekredit"><i class="fa fa-chevron-down"></i></a>
				</div>
			</div>
	    </div>
		<div id="collapsekredit" class="collapse" role="tabpanel" aria-labelledby="kredit">
			<div class="card-block">
				<div class="row text-justify border border-top-0 border-left-0 border-right-0">
					<div class="col-sm-4 text-left">
						<p class="p-2 pl-4 mb-0">POKOK PINJAMAN</p>
					</div> 
					<div class="col-sm-8 text-left">
						<p class="p-2 pr-4 mb-0">{{ $permohonan['pokok_pinjaman'] }}</p>
					</div> 
				</div> 
				<div class="row text-justify">
					<div class="col-sm-4 text-left">
						<p class="p-2 pl-4 mb-0">KEMAMPUAN ANGSUR</p>
					</div> 
					<div class="col-sm-8 text-left">
						<p class="p-2 pr-4 mb-0">{{ $permohonan['kemampuan_angsur'] }}</p>
					</div> 
				</div> 
			</div>
		</div>
	</div>
	<div class="card">
		<div class="card-header" role="tab" id="nasabah" data-toggle="collapse" data-parent="#accordion" href="#collapsenasabah" aria-expanded="false" aria-controls="collapsenasabah" style="cursor: pointer">
			<div class="row">
				<div class="col-sm-8">
					NASABAH
				</div>
				<div class="col-sm-4 text-right">
					<a class="collapsed text-dark" data-toggle="collapse" data-parent="#accordion" href="#collapsenasabah" aria-expanded="false" aria-controls="collapsenasabah"><i class="fa fa-chevron-down"></i></a>
				</div>
			</div>
	    </div>
		<div id="collapsenasabah" class="collapse" role="tabpanel" aria-labelledby="nasabah">
			<div class="card-block">
				@if(!is_null($permohonan['dokumen_pelengkap']['ktp']))
				<div class="row text-justify border border-top-0 border-left-0 border-right-0">
					<div class="col-sm-12 text-center">
						<img src="{{$permohonan['dokumen_pelengkap']['ktp']}}" class="img-fluid d-block mx-auto" alt="Responsive image" style="max-height:300px;padding:15px;">
					</div>
				</div>
				@endif
				@foreach($permohonan['nasabah'] as $k => $v )
					@if($k!='keluarga' && $k!='alamat' && $k!='is_ektp' && $k!='is_lama')
						<div class="row text-justify border border-top-0 border-left-0 border-right-0">
							<div class="col-sm-4 text-left">
								<p class="p-2 pl-4 mb-0">{{ strtoupper(str_replace('_', ' ', $k)) }}</p>
							</div> 
							<div class="col-sm-8 text-left">
								<p class="p-2 pr-4 mb-0">{{ ucwords(str_replace('_', ' ', $v)) }}</p>
							</div> 
						</div>
					@endif 
				@endforeach
				<div class="row text-justify border border-top-0 border-left-0 border-right-0">
					<div class="col-sm-4 text-left">
						<p class="p-2 pl-4 mb-0">ALAMAT</p>
					</div> 
					<div class="col-sm-8 text-left">
						<p class="p-2 pr-4 mb-0">{{ implode(' ', $permohonan['nasabah']['alamat']) }}</p>
					</div> 
				</div>
			</div>
		</div>
	</div>
	<div class="card">
		<div class="card-header" role="tab" id="keluarga" data-toggle="collapse" data-parent="#accordion" href="#collapsekeluarga" aria-expanded="false" aria-controls="collapsekeluarga" style="cursor: pointer">
			<div class="row">
				<div class="col-sm-8">
					DATA KELUARGA
				</div>
				<div class="col-sm-4 text-right">
					<a class="collapsed text-dark" data-toggle="collapse" data-parent="#accordion" href="#collapsekeluarga" aria-expanded="false" aria-controls="collapsekeluarga"><i class="fa fa-chevron-down"></i></a>
				</div>
			</div>
	    </div>
		<div id="collapsekeluarga" class="collapse" role="tabpanel" aria-labelledby="keluarga">
			<div class="card-block">
				@foreach($permohonan['nasabah']['keluarga'] as $kk => $kv )
					@foreach($kv as $k => $v)
						<div class="row text-justify border border-top-0 border-left-0 border-right-0">
							<div class="col-sm-4 text-left">
								<p class="p-2 pl-4 mb-0">{{ strtoupper(str_replace('_', ' ', $k)) }}</p>
							</div> 
							<div class="col-sm-8 text-left">
								<p class="p-2 pr-4 mb-0">{{ ucwords(str_replace('_', ' ', $v)) }}</p>
							</div> 
						</div>
					@endforeach
				@endforeach
			</div>
		</div>
	</div>
	<div class="card">
		<div class="card-header" role="tab" id="jaminan" data-toggle="collapse" data-parent="#accordion" href="#collapsejaminan" aria-expanded="false" aria-controls="collapsejaminan" style="cursor: pointer">
			<div class="row">
				<div class="col-sm-8">
					JAMINAN
				</div>
				<div class="col-sm-4 text-right">
					<a class="collapsed text-dark" data-toggle="collapse" data-parent="#accordion" href="#collapsejaminan" aria-expanded="false" aria-controls="collapsejaminan"><i class="fa fa-chevron-down"></i></a>
				</div>
			</div>
	    </div>
		<div id="collapsejaminan" class="collapse" role="tabpanel" aria-labelledby="jaminan">
			<div class="card-block">
				@foreach($permohonan['jaminan'] as $k => $v)
					<div class="row text-justify">
						<div class="col-sm-12 text-center">
							<div class="row mt-3">
								<div class="col-sm-12">
									<p class="text-secondary mb-1"><strong>DATA JAMINAN {{strtoupper(str_replace('_', ' ', $v['jenis']))}} {{($k+1)}}</strong></p>
								</div> 
							</div> 
							@foreach($v['dokumen_jaminan'][$v['jenis']] as $k2 => $v2)
								@if ($k2!='alamat')
									<div class="row text-justify border border-top-0 border-left-0 border-right-0">
										<div class="col-sm-4 text-left">
											<p class="p-2 pl-4 mb-0">{{ strtoupper(str_replace('_', ' ', $k2)) }}</p>
										</div> 
										<div class="col-sm-8 text-left" >
											<p class="p-2 pr-4 mb-0">{{ ucwords(str_replace('_', ' ', $v2)) }}</p>
										</div> 
									</div>
								@else
									<div class="row text-justify border border-top-0 border-left-0 border-right-0">
										<div class="col-sm-4 text-left">
											<p class="p-2 pl-4 mb-0">{{strtoupper(str_replace('_', ' ', $k2))}}</p>
										</div> 
										<div class="col-sm-8 text-left">
											@foreach($v2 as $k3 => $v3) 
												<p class="p-2 pr-4 mb-0">{{str_replace('_', ' ', $k3)}} {{str_replace('_', ' ', $v3)}}</p>
											@endforeach
										</div> 
									</div>
								@endif

							@endforeach
						</div> 
					</div> 
				@endforeach
			</div>
		</div>
	</div>
</div>
