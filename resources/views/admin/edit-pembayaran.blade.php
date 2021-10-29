@extends('template.welcome')
@section('title')
Edit Pembayaran {{ $Pembayaran->name }}
@endsection
@section('subtitle')
              <li class="breadcrumb-item"><a href="{{ url('pembayaran') }}">Pembayaran Anggota</a></li>
              <li class="breadcrumb-item active">Edit Pembayaran {{ $Pembayaran->name }}</li>
@endsection
@section('content')
<div class="row" style="margin-top: 40px">
	<!-- TAMBAH USER -->
	<form method="POST" enctype="multipart/form-data">
		@csrf
		<!-- NILAI -->
		<div class="input-field">
			<input name="nilai" id="nilai" type="number" class="validate" value="{{ $Pembayaran->nilai }}">
			<label for="nilai">Jumlah Nilai</label>
		</div>
		<!-- TANGGAL -->
		<div class="input-field">
			<input name="tanggal" id="tanggal" type="text" class="datepicker" value="{{ $Pembayaran->tanggal }}">
			<label for="tanggal">Tanggal Pembayaran</label>
		</div>
		<!-- JENIS -->
		<div class="input-field">
			<select name="jenis" id="jenis">
				<option value="Wajib">Wajib</option>
				<option value="Pokok">Pokok</option>
				<option value="Sukarela">Sukarela</option>
			</select>
			<label for="jenis">Jenis (sebelumnya berjenis {{ $Pembayaran->jenis }})</label>
		</div>
		<!-- DANA -->
		<div class="input-field">
			<select name="dana" id="dana">
				<option value="1" selected>Ya</option>
				<option value="0">Tidak</option>
			</select>
			<label for="dana">Perbarui Dana</label>
		</div>
		<div align="right">
			<button class="btn green waves-effect waves-light" type="submit" name="submit">Simpan	<i class="material-icons right">send</i>
			</button>
		</div>
	</form>
	<!-- /TAMBAH USER -->
</div>
@endsection