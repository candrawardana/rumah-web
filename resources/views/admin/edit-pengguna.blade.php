@extends('template.welcome')
@section('title')
Ubah Pengguna {{ $User->name }}
@endsection
@section('subtitle')
<li class="breadcrumb-item"><a href="{{ url('pengguna') }}">Pengguna</a></li>
<li class="breadcrumb-item"><a href="{{ url('profil/'.$User->id) }}">{{ $User->name }}</a></li>
<li class="breadcrumb-item active">Edit</li>
@endsection
@section('content')
<div class="row" style="margin-top: 40px">
	<div class="col s12">
					<form action="{{ url('tambah-pengguna') }}" method="POST" enctype="multipart/form-data">
						@csrf
						<input name="id" id="id" type="hidden" value="{{ $User->id }}">
						<input name="jenis" id="jenis" type="hidden" value="{{ $User->jenis }}">
						<!-- NOMOR INDUK -->
						<div class="input-field">
							<input name="label_id" id="label_id" type="text" class="validate" 
							value="{{ $User->label_id }}">
							<label for="label_id">Nomor Induk Pegawai</label>
						</div>
						<!-- NAMA PEGAWAI -->
						<div class="input-field">
							<input name="name" id="name" type="text" class="validate"
							value="{{ $User->name }}">
							<label for="name">Nama Lengkap</label>
						</div>
						<!-- USERNAME -->
						<div class="input-field">
							<input name="username" id="username" type="text" class="validate"
							value="{{ $User->username }}">
							<label for="username">Login Username</label>
						</div>
						<!-- PASSWORD -->
						<div class="input-field">
							<input name="password" id="password" type="password" class="validate">
							<label for="password">Login Password</label>
						</div>
						<!-- EMAIL -->
						<div class="input-field">
							<input name="email" id="email" type="email" class="validate"
							value="{{ $User->email }}">
							<label for="email">Email</label>
						</div>
						<!-- KTP -->
						<div class="input-field">
							<input name="ktp" id="ktp" type="text" class="validate"
							value="{{ $User->ktp }}">
							<label for="ktp">KTP</label>
						</div>
						<!-- LAHIR -->
						<div class="input-field">
							<input name="lahir" id="lahir" type="text" class="validate"
							value="{{ $User->lahir }}">
							<label for="lahir">Tempat, Tanggal Lahir</label>
						</div>
						<!-- REKENING -->
						<div class="input-field">
							<input name="rekening" id="rekening" type="text" class="validate"
							value="{{ $User->rekening }}">
							<label for="rekening">Rekening</label>
						</div>
						<!-- PENDIDIKAN -->
						<div class="input-field">
							<input name="pendidikan" id="pendidikan" type="text" class="validate"
							value="{{ $User->pendidikan }}">
							<label for="pendidikan">Pendidikan</label>
						</div>
						<!-- TELP -->
						<div class="input-field">
							<input name="hp" id="hp" type="tel" class="validate"
							value="{{ $User->hp }}">
							<label for="hp">Nomor HP</label>
						</div>
						<div class="input-field">
							<input name="wa" id="wa" type="tel" class="validate"
							value="{{ $User->wa }}">
							<label for="wa">Nomor Whatsapp</label>
						</div>
						<!-- ALAMAT -->
						<div class="input-field">
							<textarea name="alamat" id="alamat" class="materialize-textarea">{{ $User->alamat }}</textarea>
							<label for="alamat">Alamat Lengkap</label>
						</div>
						<!-- JABATAN -->
						@if($User->jenis=="Administrator" || $User->jenis=="Staff" || $User->jenis=="Ustadz")
						<div class="input-field">
							<select name="pekerjaan" id="pekerjaan">
								<option value="Amir" selected>Amir</option>
								<option value="Dewan Guru">Dewan Guru</option>
								<option value="Kepala Sekolah">Kepala Sekolah</option>
								<option value="Wakil Mudir">Wakil Mudir</option>
								<option value="Mudir">Mudir</option>
							</select>
							<label for="pekerjaan">Pekerjaan (awalnya {{ $User->pekerjaan }})</label>
						</div>
						@else
						<div class="input-field">
							<input name="pekerjaan" id="pekerjaan" type="text" class="validate">
							<label for="pekerjaan">Pekerjaan</label>
						</div>
						@endif						
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
</div>
@endsection