@extends('template.welcome')
@section('title')
Pembelian Koperasi {{ $Pembelian->name }}
@endsection
@section('subtitle')
              <li class="breadcrumb-item"><a href="{{ url('pembelian') }}">Pembelian Koperasi</a></li>
              <li class="breadcrumb-item active">Edit Pembelian {{ $Pembelian->name }}</li>
@endsection
@section('content')
<div class="row" style="margin-top: 40px">
					<!-- TAMBAH USER -->
					<form method="POST" enctype="multipart/form-data">
						@csrf
						<!-- NILAI -->
						<div class="input-field">
							<input name="faktur" id="faktur" type="text" class="validate" value="{{ $Pembelian->faktur }}">
							<label for="faktur">Faktur</label>
						</div>
						<!-- NILAI -->
						<div class="input-field">
							<input name="kode" id="kode" type="text" class="validate" value="{{ $Pembelian->kode }}">
							<label for="kode">Kode Barang</label>
						</div>
						<!-- NILAI -->
						<div class="input-field">
							<input name="nama" id="nama" type="text" class="validate" value="{{ $Pembelian->nama }}">
							<label for="nama">Nama Barang</label>
						</div>
						<!-- NILAI -->
						<div class="input-field">
							<input name="terjual" id="terjual" type="number" class="validate" value="{{ $Pembelian->terjual }}">
							<label for="terjual">Barang Terjual</label>
						</div>
						<!-- TANGGAL -->
						<div class="input-field">
							<input name="tanggal" id="tanggal" type="text" class="datepicker" value="{{ $Pembelian->tanggal }}">
							<label for="tanggal">Tanggal Ditambah</label>
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
</div>
@endsection