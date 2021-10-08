@extends('template.welcome')
@section('title')
Uang Syariah Santri
@endsection
@section('subtitle')
<li class="breadcrumb-item"><a href="{{ url('santri') }}">Santri</a></li>
<li class="breadcrumb-item"><a href="{{ url('santri/'.$Santri->s_nis) }}">{{ $Santri->s_nama }}</a></li>
<li class="breadcrumb-item active">Uang Syariah</li>
@endsection
@section('content')
<div class="container">
	<div class="row">
		<div class="content-title">
			<a href="#" class="brand-logo grey-text text-darken-4 content-text">Uang Syariah - {{ $Santri->s_nama }}</a>
		</div>
	</div>
	<div class="row">
		<div class="col s12">
			<ul class="collapsible">
				<li>
					<div class="collapsible-header green-text">
						<i class="material-icons">add</i> <strong>Pembayaran Uang Syariah</strong>
					</div>
					<div class="collapsible-body">
						<!-- FORM HAFALAN -->
						<form action="{{ url('tambah-uang-syariah') }}" method="POST">
							@csrf
							<input type="hidden" name="s_nis" value="{{ $Santri->s_nis }}">
							<div class="input-field">
								<input name="u_tanggal" id="u_tanggal" type="text" class="datepicker">
								<label for="u_tanggal">Tanggal Bayar</label>
							</div>
							<div class="input-field">
								<input name="u_nominal" id="u_nominal" type="text" class="validate" value="0" min="0">
								<label for="u_nominal">Nominal</label>
							</div>
							<div class="input-field">
								<select name="u_bulan" id="u_bulan" class="validate">
									<option value="Januari" selected>Januari</option>
									<option value="Februari">Februari</option>
									<option value="Maret">Maret</option>
									<option value="April">April</option>
									<option value="Mei">Mei</option>
									<option value="Juni">Juni</option>
									<option value="Juli">Juli</option>
									<option value="Agustus">Agustus</option>
									<option value="September">September</option>
									<option value="Oktober">Oktober</option>
									<option value="November">November</option>
									<option value="Desember">Desember</option>
								</select>
								<label for="u_bulan">Pembayaran Bulan</label>
							</div>
							<div class="input-field">
								<select name="u_keterangan" id="u_keterangan" class="validate">
									<option value="Lunas" selected>Lunas</option>
									<option value="Menunggak">Menunggak</option>
								</select>
								<label for="u_keterangan">Keterangan</label>
							</div>
							<div align="right">
								<button class="btn green waves-effect waves-light" type="submit" name="submit">Simpan
									<i class="material-icons right">send</i>
								</button>
							</div>
						</form>
						<!-- /FORM HAFALAN -->
					</div>
				</li>
			</ul>
		</div>
		<div class="col s12">
			{!! view('konten.uang-syariah',compact('UangSyariah'))->render() !!}
		</div>
	</div>
</div>
@endsection