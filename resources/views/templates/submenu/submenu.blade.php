<div class="container-fluid bg-white" style="border-bottom: 2px solid #f5f5f5;">
	<div class="row">
		<div class="col">
			<nav class="nav">
				<a href="{{ route('home', ['kantor_aktif_id' => $kantor_aktif['id']]) }}" class="nav-link">Menu Utama</a>
				<a href="{{route('simulasi', ['mode' => 'pa', 'kantor_aktif_id' => $kantor_aktif['id']])}}" class="nav-link">Simulasi Kredit PA</a>
				<a href="{{route('simulasi', ['mode' => 'pt', 'kantor_aktif_id' => $kantor_aktif['id']])}}" class="nav-link">Simulasi Kredit PT</a>
				<a href="{{route('pengajuan.permohonan.create', ['status' => 'permohonan', 'kantor_aktif_id' => $kantor_aktif['id']])}}" class="nav-link">Permohonan Kredit Baru</a>

				@if(in_array('passcode', $scopes['scopes']))
				<a href="{{route('pengajuan.passcode.index', ['status' => 'survei', 'kantor_aktif_id' => $kantor_aktif['id']])}}" class="nav-link">Generate Passcode</a>
				@endif
			</nav>
		</div>
	</div>
</div>