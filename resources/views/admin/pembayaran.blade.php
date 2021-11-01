@extends('template.welcome')
@section('title')
Pembayaran
@if($pengguna!="")
 {{$pengguna}}
@endif
@endsection
@section('subtitle')
@if($pengguna!="")
              <li class="breadcrumb-item"><a href="{{ url('pembayaran') }}">Pembayaran Anggota</a></li>
              <li class="breadcrumb-item active">Semua Pembayaran {{ $pengguna }}</li>
@else
<li class="breadcrumb-item active">
	Pembayaran Anggota
</li>
@endif
@endsection
@section('content')
@if(\Auth::user() && \Auth::user()->jenis == 'Administrator')
<div class="row" style="margin-top: 40px">
	<div class="col s12">
		<ul class="collapsible">
			<li>
				<div class="collapsible-header green-text">
					<i class="material-icons">add</i> <strong>Tambah Pembayaran</strong>
				</div>
				<div class="collapsible-body">
					<!-- TAMBAH USER -->
					<form action="{{ url('tambah-pembayaran') }}" method="POST" enctype="multipart/form-data">
						@csrf
						<!-- USERNAME -->
						<div class="input-field">
							<input name="username" id="username" type="text" class="validate" value="{{ $q }}">
							<label for="username">Username</label>
						</div>
						<!-- NILAI -->
						<div class="input-field">
							<input name="nilai" id="nilai" type="number" class="validate">
							<label for="nilai">Jumlah Nilai</label>
						</div>
						<!-- TANGGAL -->
						<div class="input-field">
							<input name="tanggal" id="tanggal" type="text" class="datepicker">
							<label for="tanggal">Tanggal Pembayaran</label>
						</div>
						<!-- JENIS -->
						<div class="input-field">
							<select name="jenis" id="jenis">
								<option value="Wajib">Wajib</option>
								<option value="Pokok">Pokok</option>
								<option value="Sukarela">Sukarela</option>
							</select>
							<label for="jenis">Jenis</label>
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
			</li>
		</ul>
	</div>
</div>
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
					<th>NIP</th>
					@if($pengguna=="")
					<th>PENGGUNA</th>
					@endif
					<th>JENIS</th>
					<th>TANGGAL</th>
					<th colspan="2">NILAI</th>
					<th>Opsi</th>
				</tr>
			</thead>
			<tbody>
				@php
					$i=1;
				@endphp
				@foreach($Pembayaran as $p)
						<tr>
							<td>{{ $i }}</td>
							@if($pengguna=="")
							<td>{{ $p->name }}</td>
							@endif
							<td>{{ $p->jenis }}</td>
							<td>{{ $p->tanggal }}</td>
							<td width="20">Rp.</td>
							<td>{{ nomor($p->nilai) }}</td>
							<td>
								<a class="tooltipped green-text" data-position="bottom" data-tooltip="Ubah Data {{ $p->name }}" 
									href="{{ url('edit-pembayaran/'.$p->id) }}"><i class="material-icons">edit</i></a>
								<a class="tooltipped red-text" data-position="bottom" data-tooltip="Hapus Data {{ $p->name }}" onClick="javascript: return confirm('Yakin ingin menghapus?');" href="{{ url('hapus-pembayaran/'.$p->id) }}"><i class="material-icons">delete</i></a>
							</td>
						</tr>
				@php
					$i++;
				@endphp
				@endforeach
			</tbody>
		</table>
		{!! $Pembayaran->links('template.paginator') !!}
	</div>
</div>
<div class="row" style="margin-top: 40px">
	<form action="{{ url('pembayaran/cetak') }}" target="_blank">
		<div align="right">
			<input type="hidden" name="q" value="{{ $q }}">
			<button class="btn green waves-effect waves-light" type="submit" name="submit">Cetak	<i class="material-icons right">print</i>
			</button>
		</div>
	</form>
</div>
@endsection