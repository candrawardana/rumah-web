@extends('template.welcome')
@section('title')
Pengguna
@endsection
@section('subtitle')
              <li class="breadcrumb-item active">Pengguna</li>
@endsection
@section('content')
@if($jenis!="wali")
<div class="row" style="margin-top: 40px">
	<div class="col s12">
		<ul class="collapsible">
			<li>
				<div class="collapsible-header green-text">
					<i class="material-icons">add</i> <strong>Tambah Pengguna</strong>
				</div>
				<div class="collapsible-body">
					<!-- TAMBAH USER -->
					<form action="{{ url('tambah-pengguna') }}" method="POST" enctype="multipart/form-data">
						@csrf
						<!-- NOMOR INDUK -->
						<div class="input-field">
							<input name="label_id" id="label_id" type="text" class="validate">
							<label for="label_id">Nomor Induk Pegawai</label>
						</div>
						<!-- NAMA PEGAWAI -->
						<div class="input-field">
							<input name="name" id="name" type="text" class="validate">
							<label for="name">Nama Lengkap</label>
						</div>
						<!-- USERNAME -->
						<div class="input-field">
							<input name="username" id="username" type="text" class="validate">
							<label for="username">Login Username</label>
						</div>
						<!-- PASSWORD -->
						<div class="input-field">
							<input name="password" id="password" type="password" class="validate">
							<label for="password">Login Password</label>
						</div>
						<!-- EMAIL -->
						<div class="input-field">
							<input name="email" id="email" type="email" class="validate">
							<label for="email">Email</label>
						</div>
						<!-- KTP -->
						<div class="input-field">
							<input name="ktp" id="ktp" type="text" class="validate">
							<label for="ktp">KTP</label>
						</div>
						<!-- LAHIR -->
						<div class="input-field">
							<input name="lahir" id="lahir" type="text" class="validate">
							<label for="lahir">Tempat, Tanggal Lahir</label>
						</div>
						<!-- REKENING -->
						<div class="input-field">
							<input name="rekening" id="rekening" type="text" class="validate">
							<label for="rekening">Rekening</label>
						</div>
						<!-- PENDIDIKAN -->
						<div class="input-field">
							<input name="pendidikan" id="pendidikan" type="text" class="validate">
							<label for="pendidikan">Pendidikan</label>
						</div>
						<!-- TELP -->
						<div class="input-field">
							<input name="hp" id="hp" type="tel" class="validate">
							<label for="hp">Nomor HP</label>
						</div>
						<div class="input-field">
							<input name="wa" id="wa" type="tel" class="validate">
							<label for="wa">Nomor Whatsapp</label>
						</div>
						<!-- ALAMAT -->
						<div class="input-field">
							<textarea name="alamat" id="alamat" class="materialize-textarea"></textarea>
							<label for="alamat">Alamat Lengkap</label>
						</div>
						<!-- JABATAN -->
						@if($jenis=="Administrator" || $jenis=="Ustadz")
						<div class="input-field">
							<select name="pekerjaan" id="pekerjaan">
								<option value="Amir" selected>Amir</option>
								<option value="Dewan Guru">Dewan Guru</option>
								<option value="Kepala Sekolah">Kepala Sekolah</option>
								<option value="Wakil Mudir">Wakil Mudir</option>
								<option value="Mudir">Mudir</option>
							</select>
							<label for="pekerjaan">Jabatan Pegawai</label>
						</div>
						@else
						<div class="input-field">
							<input name="pekerjaan" id="pekerjaan" type="text" class="validate">
							<label for="pekerjaan">Pekerjaan</label>
						</div>
						@endif						
						<!-- LEVEL -->
						<div class="input-field">
							<select name="jenis" id="jenis">
								@foreach($jenis_array as $j)
								<option value="{{ $j }}">{{ $j }}</option>
								@endforeach
							</select>
							<label for="jenis">Level</label>
						</div>
						<!-- FOTO -->
						<div class="input-field">
							<div class = "file-field input-field">
								<div class = "btn green">
									<span>Browse</span>
									<input type = "file"  name="pp"/>
								</div>

								<div class = "file-path-wrapper">
									<input class = "file-path validate" type = "text"
									placeholder = "Pilih Foto" />
								</div>
							</div>
						</div>
						<div align="right">
							<button class="btn green waves-effect waves-light" type="submit" name="submit">Simpan	<i class="material-icons right">send</i>
							</button>
						</div>
					</form>
					<!-- /TAMBAH USER -->
				</div>
			</li>
		</ul>
	</div>
</div>
@endif
<div class="row">
	<nav>
	    <div class="nav-wrapper">
		    <form>
		      <div class="input-field green">
		        <input id="search" type="search" name="q" placeholder="Cari Pengguna" value="{{ $q }}">
		        <label class="label-icon" for="search"><i class="material-icons">search</i></label>
		      </div>
		    </form>
	    </div>
    </nav>
</div>
<div class="row">
	<div class="col s12">
		<table class="responsive-table">
			<thead>
				<tr>
					<th>NIP</th>
					<th>Nama</th>
					<th>Username</th>
					<th>Email</th>
					<th>Telepon</th>
					<th>Level</th>
					<th>Opsi</th>
				</tr>
			</thead>
			<tbody>
				@php
					$i=1;
				@endphp
				@foreach($Pengguna as $p)
						<tr>
							<td>{{ $i }}</td>
							<td>{{ $p->name }}</td>
							<td>{{ $p->username }}</td>
							<td>{{ $p->email }}</td>
							<td>{{ $p->hp }}</td>
							<td>{{ $p->jenis }}</td>
							<td>
								<a class="tooltipped green-text" data-position="bottom" data-tooltip="Lihat Profil {{ $p->name }}" 
									href="{{ url('profil/'.$p->id) }}"><i class="material-icons">person</i></a>
								<a class="tooltipped green-text" data-position="bottom" data-tooltip="Ubah Data {{ $p->name }}" 
									href="{{ url('edit-pengguna/'.$p->id) }}"><i class="material-icons">edit</i></a>
								@if($jenis!="wali")
								<span class="right">
									<a class="tooltipped red-text" data-position="bottom" data-tooltip="Hapus Data {{ $p->name }}" onClick="javascript: return confirm('Yakin ingin menghapus?');" href="{{ url('hapus-pengguna/'.$p->id) }}"><i class="material-icons">delete</i></a>
								</span>
								@endif
							</td>
						</tr>
				@php
					$i++;
				@endphp
				@endforeach
			</tbody>
		</table>
		{!! $Pengguna->links('template.paginator') !!}
	</div>
</div>
@endsection