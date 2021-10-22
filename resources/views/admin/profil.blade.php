@extends('template.welcome')
@section('title')
Pengguna
@endsection
@section('subtitle')
<li class="breadcrumb-item"><a href="{{ url('pengguna') }}">Pengguna</a></li>
<li class="breadcrumb-item active">{{ $User->name }}</li>
@endsection
@section('content')

<div class="row">
		<div class="content-title">
			<a href="#" class="brand-logo grey-text text-darken-4 content-text">Profil {{ $User->name }}</a>
		</div>
	</div>
	<div class="row">
		<div class="col s12 m5" align="center">
			<img class="materialboxed foto-profil z-depth-2" src="{{ $User->foto }}"> 
		</div>
		<div class="col s12 m7">
					<table>
						<tbody>
							<tr>
								<td>Nama</td>
								<td>:</td>
								<td>{{ $User->name }}</td>
							</tr>
							<tr>
								<td>Email</td>
								<td>:</td>
								<td>{{ $User->email }}</td>
							</tr>
							<tr>
								<td>No. HP DAN WA</td>
								<td>:</td>
								<td>{{ $User->hp }} (hp) {{ $User->wa }} (wa)</td>
							</tr>
							<tr>
								<td>Alamat</td>
								<td>:</td>
								<td>{{ $User->alamat }}</td>
							</tr>
							<tr>
								<td>Rekening</td>
								<td>:</td>
								<td>{{ $User->rekening }}</td>
							</tr>
							<tr>
								<td>KTP</td>
								<td>:</td>
								<td>{{ $User->ktp }}</td>
							</tr>
							<tr>
								<td>Pekerjaan</td>
								<td>:</td>
								<td>{{ $User->pekerjaan }}</td>
							</tr>
							<tr>
								<td>Pendidikan</td>
								<td>:</td>
								<td>{{ $User->pendidikan }}</td>
							</tr>
							<tr>
								<td>Lahir</td>
								<td>:</td>
								<td>{{ $User->lahir }}</td>
							</tr>
							<tr>
								<td>Jenis</td>
								<td>:</td>
								<td>{{ $User->jenis }}</td>
							</tr>
						</tbody>
					</table>
		</div>
</div>
@endsection