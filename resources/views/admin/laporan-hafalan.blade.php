@extends('template.welcome')
@section('title')
Laporan Muroja'ah Perhari
@endsection
@section('subtitle')
<li class="breadcrumb-item active">Laporan Muroja'ah Perhari</li>
@endsection
@section('content')
	<div class="row">
		<div class="col s12">
			<h5>Laporan Muroja'ah Perhari</h5>
		</div>
		<div class="col s12">
			<form method="post" target="_blank">
				@csrf
				<div class="input-field inline col s8">
					<input name="mtgl" id="mtgl" type="text" class="datepicker">
					<label for="mtgl">Pilih Tanggal</label>
				</div>
				<div class="input-field inline col s4">
					<button class="btn green waves-effect waves-light" type="submit" name="submit1">Tampilkan
						<i class="material-icons right">send</i>
					</button>
				</div>
			</form>
		</div>
	</div>
@endsection