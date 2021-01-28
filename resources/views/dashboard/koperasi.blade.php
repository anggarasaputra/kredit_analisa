@extends('templates.html.layout2')
@push('logo')
	<img class="card-img-top" src="/images/background.jpg">
@endpush

@push('title')
	PILIH KOPERASI
@endpush

@push('body')
<div class="form-row">
	@php
		$all = request()->all();
		unset($all['prev_url']);
	@endphp

	<div class="form-group pull-right">
		<input type="text" class="search form-control" placeholder="Cari Koperasi">
	</div>
	<span class="counter pull-right"></span>
	<table class="table table-hover table-bordered results">
		<thead>
			<tr>
				<th>#</th>
				<th class="col-md-5 col-xs-5">Nama</th>
			</tr>
			<tr class="warning no-result">
				<td colspan="2"><i class="fa fa-warning"></i> No result</td>
			</tr>
	  	</thead>
		<tbody>
		@foreach ($kantor as $k => $x)
			@php
				$all['kantor_aktif_id'] = $x['id'];
			@endphp
			@if (in_array(strtolower($x['jenis']), ['bpr', 'koperasi']))
					<tr>
						<td scope="row">{{$k+1}}</td>
				 		<td>
				 			@if($kantor_aktif['id']==$x['id'])
								{{ $x['nama'] }}
							@else 
						  		<a href="{{$url.'?'.http_build_query($all)}}">
									{{ $x['nama'] }}
								</a>
				 			@endif
						</td>
					</tr>
			@else
				<tr>
					<td scope="row">{{$k+1}}</td>
			 		<td>
				 		@if($kantor_aktif['id']==$x['id'])
							{{ $x['nama'] }}
						@else 
						  	<a href="{{$url.'?'.http_build_query($all)}}">
								{{ $x['nama'] }}
							</a>
						@endif
					</td>
				</tr>
			@endif
		@endforeach
		</tbody>
	</table>
</div>
@endpush

@push('css')
	<style type="text/css">
		.results tr[visible='false'],
		.no-result{
		  display:none;
		}

		.results tr[visible='true']{
		  display:table-row;
		}

		.counter{
		  padding:8px; 
		  color:#ccc;
		}

	</style>
@endpush

@push('js')
	<script type="text/javascript">
		$(document).ready(function() {
		  $(".search").keyup(function () {
			var searchTerm = $(".search").val();
			var listItem = $('.results tbody').children('tr');
			var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
			
		  $.extend($.expr[':'], {'containsi': function(elem, i, match, array){
				return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
			}
		  });
			
		  $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e){
			$(this).attr('visible','false');
		  });

		  $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e){
			$(this).attr('visible','true');
		  });

		  var jobCount = $('.results tbody tr[visible="true"]').length;
			$('.counter').text(jobCount + ' item');

		  if(jobCount == '0') {$('.no-result').show();}
			else {$('.no-result').hide();}
				  });
		});
	</script>
@endpush