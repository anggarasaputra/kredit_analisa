<div class="clearfix">&nbsp;</div>

<div class="row">
	<div class="col-sm-12 text-center">
		<h5>SURVEI REPORT</h5>
		<p style="padding:10px;margin:0px;">
			{{$survei['pengajuan_id']}} / {{$survei['id']}}
		</p>
	</div>
</div> 

<div id="accordion" role="tablist" aria-multiselectable="true">
	<div class="card">
		<div class="card-header" role="tab" id="character">
			<div class="row">
				<div class="col-sm-8">
					CHARACTER
				</div>
				<div class="col-sm-4 text-right">
					<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapsecharacter" aria-expanded="false" aria-controls="collapsecharacter" style="color:black"><i class="fa fa-chevron-down"></i></a>
				</div>
			</div>
	    </div>
		<div id="collapsecharacter" class="collapse" role="tabpanel" aria-labelledby="character">
			<div class="card-block" style="border-bottom:1px solid #bbb;padding-bottom:20px;">
				@foreach($survei['character']['dokumen_survei']['character'] as $k => $v )
					@if(is_array($v))
						@foreach($v as $k2 => $v2)
							<div class="row text-justify" style="margin:10px 0px 10px 0px;border-bottom:1px solid #aaa;">
								<div class="col-sm-6 text-left">
									{{strtoupper(str_replace('_', ' ', $k))}} {{strtoupper(str_replace('_', ' ', $k2))}}
								</div> 
								<div class="col-sm-6 text-right">
									{{str_replace('_', ' ', $v2)}}
								</div> 
							</div>
						@endforeach
					@else
						<div class="row text-justify" style="margin:10px 0px @if($k=='catatan') -1px @else 10px @endif 0px;border-bottom:1px solid #aaa;">
							<div class="col-sm-6 text-left">
								{{strtoupper(str_replace('_', ' ', $k))}}
							</div> 
							<div class="col-sm-6 text-right">
								{{str_replace('_', ' ', $v)}}
							</div> 
						</div>
					@endif
				@endforeach
			</div>
		</div>
	</div>

	<div class="card">
		<div class="card-header" role="tab" id="condition">
			<div class="row">
				<div class="col-sm-8">
					CONDITION
				</div>
				<div class="col-sm-4 text-right">
					<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapsecondition" aria-expanded="false" aria-controls="collapsecondition" style="color:black"><i class="fa fa-chevron-down"></i></a>
				</div>
			</div>
	    </div>
		<div id="collapsecondition" class="collapse" role="tabpanel" aria-labelledby="condition">
			<div class="card-block" style="border-bottom:1px solid #bbb;padding-bottom:20px;">
				@foreach($survei['condition']['dokumen_survei']['condition'] as $k => $v )
					@if(is_array($v))
						@foreach($v as $k2 => $v2)
							<div class="row text-justify" style="margin:10px 0px 10px 0px;border-bottom:1px solid #aaa;">
								<div class="col-sm-6 text-left">
									{{strtoupper(str_replace('_', ' ', $k))}} {{strtoupper(str_replace('_', ' ', $k2))}}
								</div> 
								<div class="col-sm-6 text-right">
									{{str_replace('_', ' ', $v2)}}
								</div> 
							</div>
						@endforeach
					@else
						<div class="row text-justify" style="margin:10px 0px @if($k=='catatan') -1px @else 10px @endif 0px;border-bottom:1px solid #aaa;">
							<div class="col-sm-6 text-left">
								{{strtoupper(str_replace('_', ' ', $k))}}
							</div> 
							<div class="col-sm-6 text-right">
								{{str_replace('_', ' ', $v)}}
							</div> 
						</div>
					@endif
				@endforeach
			</div>
		</div>
	</div>

	<div class="card">
		<div class="card-header" role="tab" id="capacity">
			<div class="row">
				<div class="col-sm-8">
					CAPACITY
				</div>
				<div class="col-sm-4 text-right">
					<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapsecapacity" aria-expanded="false" aria-controls="collapsecapacity" style="color:black"><i class="fa fa-chevron-down"></i></a>
				</div>
			</div>
	    </div>
		<div id="collapsecapacity" class="collapse" role="tabpanel" aria-labelledby="capacity">
			<div class="card-block" style="border-bottom:1px solid #bbb;padding-bottom:20px;">
				@foreach($survei['capacity']['dokumen_survei']['capacity'] as $k => $v )
					<div class="row text-justify" style="margin:10px 0px 10px 0px;">
						<div class="col-sm-12 text-left">
							@if(is_array($v))
								<strong>{{strtoupper(str_replace('_', ' ', $k))}}</strong>
								@foreach((array)$v as $k2 => $v2)
									@if(is_array($v2))
										@foreach((array)$v2 as $k3 => $v3)
											<div class="row text-justify" style="margin:10px 0px 10px 0px;border-bottom:1px solid #aaa;">
												<div class="col-sm-4 text-left">
													{{strtoupper(str_replace('_', ' ', $k3))}}
												</div> 
												<div class="col-sm-8 text-right">
													{{str_replace('_', ' ', $v3)}}
												</div> 
											</div>
										@endforeach
									@else
										<div class="row text-justify" style="margin:10px 0px 10px 0px;border-bottom:1px solid #aaa;">
											<div class="col-sm-4 text-left">
												{{strtoupper(str_replace('_', ' ', $k2))}}
											</div> 
											<div class="col-sm-8 text-right">
												{{str_replace('_', ' ', $v2)}}
											</div> 
										</div>
									@endif
								@endforeach
							@else
								<div class="row text-justify" style="margin:0px 0px 0px 0px;border-bottom:1px solid #aaa;">
									<div class="col-sm-6 text-left">
										{{strtoupper(str_replace('_', ' ', $k))}}
									</div> 
									<div class="col-sm-6 text-right">
										{{str_replace('_', ' ', $v)}}
									</div> 
								</div>
							@endif
						</div> 
					</div>
				@endforeach
			</div>
		</div>
	</div>

	<div class="card">
		<div class="card-header" role="tab" id="capital">
			<div class="row">
				<div class="col-sm-8">
					CAPITAL
				</div>
				<div class="col-sm-4 text-right">
					<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapsecapital" aria-expanded="false" aria-controls="collapsecapital" style="color:black"><i class="fa fa-chevron-down"></i></a>
				</div>
			</div>
	    </div>
		<div id="collapsecapital" class="collapse" role="tabpanel" aria-labelledby="capital">
			<div class="card-block" style="border-bottom:1px solid #bbb;padding-bottom:20px;">
				@foreach($survei['capital']['dokumen_survei']['capital'] as $k => $v )
					<div class="row text-justify" style="margin:10px 0px 10px 0px;">
						<div class="col-sm-12 text-left">
							<strong>{{strtoupper(str_replace('_', ' ', $k))}}</strong>
							@foreach((array)$v as $k2 => $v2)
								@if(is_array($v2))
									@foreach((array)$v2 as $k3 => $v3)
										<div class="row text-justify" style="margin:10px 0px 10px 0px;border-bottom:1px solid #aaa;">
											<div class="col-sm-7 text-left">
												{{strtoupper(str_replace('_', ' ', $k3))}}
											</div> 
											<div class="col-sm-5 text-right">
												{{str_replace('_', ' ', $v3)}}
											</div> 
										</div>
									@endforeach
								@else
									<div class="row text-justify" style="margin:10px 0px 10px 0px;border-bottom:1px solid #aaa;">
										<div class="col-sm-7 text-left">
											{{strtoupper(str_replace('_', ' ', $k2))}}
										</div> 
										<div class="col-sm-5 text-right">
											{{str_replace('_', ' ', $v2)}}
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

	<div class="card">
		<div class="card-header" role="tab" id="collateral">
			<div class="row">
				<div class="col-sm-8">
					COLLATERAL
				</div>
				<div class="col-sm-4 text-right">
					<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapsecollateral" aria-expanded="false" aria-controls="collapsecollateral" style="color:black"><i class="fa fa-chevron-down"></i></a>
				</div>
			</div>
	    </div>
		<div id="collapsecollateral" class="collapse" role="tabpanel" aria-labelledby="collateral">
			<div class="card-block" style="border-bottom:1px solid #bbb;padding-bottom:20px;">
				@foreach($survei['collateral'] as $k0 => $v0 )
					@foreach($v0['dokumen_survei']['collateral'] as $k => $v )
						@if(!str_is($k, 'jenis'))
						<div class="row text-justify" style="margin:10px 0px 10px 0px;">
						<div class="col-sm-12 text-left">
							@if(is_array($v))
								<strong>{{strtoupper(str_replace('_', ' ', $k))}}</strong>
								@foreach((array)$v as $k2 => $v2)
									@if(is_array($v2))
										@foreach((array)$v2 as $k3 => $v3)
											<div class="row text-justify" style="margin:10px 0px 10px 0px;border-bottom:1px solid #aaa;">
												<div class="col-sm-6 text-left">
													{{strtoupper(str_replace('_', ' ', $k3))}}
												</div> 
												<div class="col-sm-6 text-right">
													{{str_replace('_', ' ', $v3)}}
												</div> 
											</div>
										@endforeach
									@else
										<div class="row text-justify" style="margin:10px 0px 10px 0px;border-bottom:1px solid #aaa;">
											<div class="col-sm-6 text-left">
												{{strtoupper(str_replace('_', ' ', $k2))}}
											</div> 
											<div class="col-sm-6 text-right">
												{{str_replace('_', ' ', $v2)}}
											</div> 
										</div>
									@endif
								@endforeach
							@else
								<div class="row text-justify" style="margin:10px 0px 10px 0px;border-bottom:1px solid #aaa;">
									<div class="col-sm-6 text-left">
										{{strtoupper(str_replace('_', ' ', $k))}}
									</div> 
									<div class="col-sm-6 text-right">
										{{str_replace('_', ' ', $v)}}
									</div> 
								</div>
							@endif
						</div> 
						</div> 
						<div class="row text-justify" style="margin:10px 0px 10px 0px;">
							@foreach($v0['foto']['arsip_foto'] as $k2 => $v2)
								<div class="col-sm-6 text-left">
									<img src="{{$v2['url']}}"  class="img img-fluid" alt="Foto Jaminan" style="max-width: 100%;padding: 15px 0px">
								</div> 
							@endforeach
						</div> 
						@endif
					@endforeach
				@endforeach
			</div>
		</div>
	</div>
</div>
