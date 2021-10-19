@extends('template.welcome')
@section('title')
Pengguna
@endsection
@section('subtitle')
              <li class="breadcrumb-item active">Pengguna</li>
@endsection
@section('content')
<div class="row" style="margin-top: 40px">
	<div class="col s12">
		<ul class="collapsible">
			<li>
				<div class="collapsible-header green-text">
					<i class="material-icons">add</i> <strong>Tambah Pengguna</strong>
				</div>
				<div class="collapsible-body">
					<!-- TAMBAH USER -->
					<form action="server/tambah-data-user.php" method="POST" enctype="multipart/form-data">
						<!-- NOMOR INDUK -->
						<div class="input-field">
							<input name="p_induk" id="p_induk" type="text" class="validate">
							<label for="p_induk">Nomor Induk Pegawai</label>
						</div>
						<!-- NAMA PEGAWAI -->
						<div class="input-field">
							<input name="p_nama" id="p_nama" type="text" class="validate">
							<label for="p_nama">Nama Pegawai</label>
						</div>
						<!-- USERNAME -->
						<div class="input-field">
							<input name="p_username" id="p_username" type="text" class="validate">
							<label for="p_username">Login Username</label>
						</div>
						<!-- PASSWORD -->
						<div class="input-field">
							<input name="p_password" id="p_password" type="password" class="validate">
							<label for="p_password">Login Password</label>
						</div>
						<!-- EMAIL -->
						<div class="input-field">
							<input name="p_email" id="p_email" type="email" class="validate">
							<label for="p_email">Email</label>
						</div>
						<!-- TELP -->
						<div class="input-field">
							<input name="p_telp" id="p_telp" type="tel" class="validate">
							<label for="p_telp">No. HP/Whatsapp</label>
						</div>
						<!-- ALAMAT -->
						<div class="input-field">
							<textarea name="p_alamat" id="p_alamat" class="materialize-textarea"></textarea>
							<label for="p_alamat">Alamat Lengkap</label>
						</div>
						<!-- JABATAN -->
						<div class="input-field">
							<select name="p_jabatan" id="p_jabatan">
								<option value="Amir" selected>Amir</option>
								<option value="Dewan Guru">Dewan Guru</option>
								<option value="Kepala Sekolah">Kepala Sekolah</option>
								<option value="Wakil Mudir">Wakil Mudir</option>
								<option value="Mudir">Mudir</option>
							</select>
							<label for="p_level">Jabatan Pegawai</label>
						</div>
						<!-- LEVEL -->
						<div class="input-field">
							<select name="p_level" id="p_level">
								<option value="Administrator" selected>Administrator</option>
								<option value="Ustadz">Ustadz</option>
								<option value="Staff">Staff</option>
							</select>
							<label for="p_level">Level Pegawai</label>
						</div>
						<!-- FOTO -->
						<div class="input-field">
							<div class = "file-field input-field">
								<div class = "btn green">
									<span>Browse</span>
									<input type = "file"  name="p_foto"/>
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
								<span class="right">
									<a class="tooltipped red-text" data-position="bottom" data-tooltip="Hapus Data {{ $p->name }}" onClick="javascript: return confirm('Yakin ingin menghapus?');" href="{{ url('hapus-pengguna/'.$p->id) }}"><i class="material-icons">delete</i></a>
								</span>
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