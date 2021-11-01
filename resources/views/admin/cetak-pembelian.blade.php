@extends('template.cetak')
@section('content')
			<h5 style="margin-bottom: 30px;"><center>
				<span style="font-size: 24px;"><strong>Laporan Pembelian Koperasi</strong></span><br>
				<span style="font-size: 20px;">
					@if($pengguna=="")
						Seluruh Koperasi
					@else
						{{ $pengguna }}
					@endif
				</span>
			</center></h5>
			<table>
				<thead>
					<tr>
						<th style="text-align: left;">No.</th>
						@if($pengguna=="")
						<th>PENGGUNA</th>
						@endif
						<th>TANGGAL</th>
						<th>NO. FAKTUR</th>
						<th>KODE BARANG</th>
						<th>NAMA BARANG</th>
						<th colspan="2">HARGA MODAL</th>
						<th>JUMLAH JUAL</th>
						<th colspan="2">HARGA JUAL</th>
						<th>TOTAL JUAL</th>
					</tr>
				</thead>
				<tbody>
					@php
						$no = 1;
					@endphp
					@foreach($Pembelian as $p)
					<tr>
						<td>{{ $no }}</td>
						@if($pengguna=="")
						<td>{{ $p->name }}</td>
						@endif
						<td>{{ $p->tanggal }}</td>
						<td>{{ $p->faktur }}</td>
						<td>{{ $p->kode }}</td>
						<td>{{ $p->nama }}</td>
						<td width="20">Rp.</td>
						<td>{{ nomor($p->modal) }}</td>
						<td>{{ $p->terjual }} dari {{ $p->jumlah }}</td>
						<td width="20">Rp.</td>
						<td>{{ nomor($p->jual) }}</td>
						<td>{{ $p->hitung["total_jual"] }}</td>
					</tr>
					@php
						$no = $no + 1;
					@endphp
					@endforeach
				</tbody>
			</table>
@endsection