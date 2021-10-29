@extends('template.welcome')
@section('title')
Pembelian Koperasi {{ $Pembelian->name }}
@endsection
@section('subtitle')
              <li class="breadcrumb-item"><a href="{{ url('pembelian') }}">Pembelian Koperasi</a></li>
              <li class="breadcrumb-item active">Hapus Pembelian {{ $Pembelian->name }}</li>
@endsection
@section('content')
<div class="row" style="margin-top: 40px">
	<!-- TAMBAH USER -->
	<form method="POST" enctype="multipart/form-data">
		@csrf
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