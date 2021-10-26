@extends('template.welcome')
@section('title')
Pembayaran
@endsection
@section('subtitle')
              <li class="breadcrumb-item active">Pembayaran</li>
@endsection
@section('content')
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
							<input name="username" id="username" type="text" class="validate">
							<label for="username">Username</label>
						</div>
						<!-- NILAI -->
						<div class="input-field">
							<input name="nilai" id="nilai" type="number" class="validate">
							<label for="nilai">Jumlah Nilai</label>
						</div>
						<!-- JENIS -->
						<div class="input-field">
							<select name="jenis" id="jenis">
								<option value="Wajib">Wajib</option>
								<option value="Simpanan">Simpanan</option>
							</select>
							<label for="jenis">Jenis</label>
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
					<th>Jenis</th>
					<th colspan="2">Nilai</th>
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
							<td>{{ $p->pembuat["name"] }}</td>
							<td>{{ $p->jenis }}</td>
							<td>Rp.</td>
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
@endsection