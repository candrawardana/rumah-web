@extends('template.welcome')
@section('title')
Pembelian Koperasi
@endsection
@section('subtitle')
              <li class="breadcrumb-item active">Pembelian Koperasi</li>
@endsection
@section('content')
@if(\Auth::user() && \Auth::user()->jenis == 'Administrator')
<div class="row" style="margin-top: 40px">
	<div class="col s12">
		<ul class="collapsible">
			<li>
				<div class="collapsible-header green-text">
					<i class="material-icons">add</i> <strong>Tambah Pembelian</strong>
				</div>
				<div class="collapsible-body">
					<!-- TAMBAH USER -->
					<form action="{{ url('tambah-pembelian') }}" method="POST" enctype="multipart/form-data">
						@csrf
						<!-- USERNAME -->
						<div class="input-field">
							<input name="username" id="username" type="text" class="validate">
							<label for="username">Username</label>
						</div>
						<!-- NILAI -->
						<div class="input-field">
							<input name="faktur" id="faktur" type="text" class="validate">
							<label for="faktur">Faktur</label>
						</div>
						<!-- NILAI -->
						<div class="input-field">
							<input name="kode" id="kode" type="text" class="validate">
							<label for="kode">Kode Barang</label>
						</div>
						<!-- NILAI -->
						<div class="input-field">
							<input name="nama" id="nama" type="text" class="validate">
							<label for="nama">Nama Barang</label>
						</div>
						<!-- NILAI -->
						<div class="input-field">
							<input name="modal" id="modal" type="number" class="validate">
							<label for="modal">Modal Jual</label>
						</div>
						<!-- NILAI -->
						<div class="input-field">
							<input name="jumlah" id="jumlah" type="number" class="validate">
							<label for="jumlah">Jumlah Barang</label>
						</div>
						<!-- NILAI -->
						<div class="input-field">
							<input name="jual" id="jual" type="number" class="validate">
							<label for="jual">Harga Jual</label>
						</div>
						<!-- NILAI -->
						<div class="input-field">
							<input name="terjual" id="terjual" type="number" class="validate">
							<label for="terjual">Barang Terjual</label>
						</div>
						<!-- TANGGAL -->
						<div class="input-field">
							<input name="tanggal" id="tanggal" type="text" class="datepicker">
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
					@if(\Auth::user() && \Auth::user()->jenis == 'Administrator')
					<th>Pemilik</th>
					@endif
					<th>TANGGAL</th>
					<th>NO. FAKTUR</th>
					<th>KODE BARANG</th>
					<th>NAMA BARANG</th>
					<th colspan="2">HARGA MODAL</th>
					<th>JUMLAH JUAL</th>
					<th colspan="2">HARGA JUAL</th>
					<th>TOTAL JUAL</th>
					<th>Opsi</th>
				</tr>
			</thead>
			<tbody>
				@php
					$i=1;
				@endphp
				@foreach($Pembelian as $p)
						<tr>
							@if(\Auth::user() && \Auth::user()->jenis == 'Administrator')
							<td>{{ $p->name }}</td>
							@endif
							<td>{{ $p->tanggal }}</td>
							<td>{{ $p->faktur }}</td>
							<td>{{ $p->kode }}</td>
							<td>{{ $p->nama }}</td>
							<td>Rp.</td>
							<td>{{ nomor($p->modal) }}</td>
							<td>{{ $p->terjual }} dari {{ $p->jumlah }}</td>
							<td>Rp.</td>
							<td>{{ nomor($p->jual) }}</td>
							<td>{{ $p->hitung["total_jual"] }}</td>
							<td>
								<a class="tooltipped green-text" data-position="bottom" data-tooltip="Ubah Data {{ $p->name }}" 
									href="{{ url('edit-pembelian/'.$p->id) }}"><i class="material-icons">edit</i></a>
								<a class="tooltipped red-text" data-position="bottom" data-tooltip="Hapus Data {{ $p->name }}" onClick="javascript: return confirm('Yakin ingin menghapus?');" href="{{ url('hapus-pembelian/'.$p->id) }}"><i class="material-icons">delete</i></a>
							</td>
						</tr>
				@php
					$i++;
				@endphp
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection