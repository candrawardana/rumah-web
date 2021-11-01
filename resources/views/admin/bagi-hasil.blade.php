@extends('template.welcome')
@section('title')
Bagi Hasil
@if($pengguna!="")
 {{$pengguna}}
@endif
@endsection
@section('subtitle')
@if($pengguna!="")
              <li class="breadcrumb-item"><a href="{{ url('bagi-hasil') }}">Bagi Hasil</a></li>
              <li class="breadcrumb-item active">{{ $pengguna }}</li>
@else
<li class="breadcrumb-item active">
	Bagi Hasil
</li>
@endif
@endsection
@section('content')
@if(\Auth::user() && \Auth::user()->jenis == 'Administrator')
<div class="row">
	<nav>
	    <div class="nav-wrapper">
		    <form>
		      <div class="input-field green">
		        <input id="search" type="search" name="q" placeholder="Lihat Koperasi Berdasarkan Username" value="{{ $q }}">
		        <label class="label-icon" for="search"><i class="material-icons">search</i></label>
		      </div>
		    </form>
	    </div>
    </nav>
</div>
@endif
<div class="row">
	<div class="col s12">
		<table class="responsive-table">
			<thead>
				<tr>
					@if($pengguna=="")
					<th>PENGGUNA</th>
					@endif
					<th colspan=2>SELISIH JUAL</th>
					<th colspan=2>ANGGOTA</th>
					<th colspan=2>KOPERASI</th>
					<th colspan=2>PETUGAS</th>
					<th colspan=2>{{ judul_situs(1) }}</th>
				</tr>
			</thead>
			<tbody>
				@php
					$no = 1;
					$selisih_jual=0;
					$anggota=0;
					$koperasi=0;
					$petugas=0;
					$yayasan=0;
				@endphp
				@foreach($Pembelian as $p)
						<tr
						@if($p->hitung["selisih_jual"]<0)
						class="bg-red"
						@endif
						>
							@if($pengguna=="")
							<td>{{ $p->name }}</td>
							@endif
							<td width="20">Rp.</td>
							<td>{{ $p->hitung["selisih_jual"] }}</td>
							<td width="20">Rp.</td>
							<td>{{ $p->hitung["anggota"] }}</td>
							<td width="20">Rp.</td>
							<td>{{ $p->hitung["koperasi"] }}</td>
							<td width="20">Rp.</td>
							<td>{{ $p->hitung["petugas"] }}</td>
							<td width="20">Rp.</td>
							<td>{{ $p->hitung["yayasan"] }}</td>
						</tr>
				@php
					$selisih_jual+=$p->hitung["selisih_jual"];
					$anggota+=$p->hitung["anggota"];
					$koperasi+=$p->hitung["koperasi"];
					$petugas+=$p->hitung["petugas"];
					$yayasan+=$p->hitung["yayasan"];
					$no = $no + 1;
				@endphp
				@endforeach
				<tr>
					<th colspan="11" style="text-align: center; vertical-align: middle;">TOTAL</th>
				</tr>
				<tr
				@if($selisih_jual<=0)
				class="bg-red"
				@else
				class="bg-green"
				@endif
				>
					@if($pengguna=="")
					<td>KESELURUHAN</td>
					@endif
					<td width="20">Rp.</td>
					<td>{{ $selisih_jual }}</td>
					<td width="20">Rp.</td>
					<td>{{ $anggota }}</td>
					<td width="20">Rp.</td>
					<td>{{ $koperasi }}</td>
					<td width="20">Rp.</td>
					<td>{{ $petugas }}</td>
					<td width="20">Rp.</td>
					<td>{{ $yayasan }}</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<div class="row" style="margin-top: 40px">
	<form action="{{ url('bagi-hasil/cetak') }}" target="_blank">
		<div align="right">
			<input type="hidden" name="q" value="{{ $q }}">
			<button class="btn green waves-effect waves-light" type="submit" name="submit">Cetak	<i class="material-icons right">print</i>
			</button>
		</div>
	</form>
</div>
@endsection