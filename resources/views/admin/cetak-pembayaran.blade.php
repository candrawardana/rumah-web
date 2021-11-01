@extends('template.cetak')
@section('content')
			<h5 style="margin-bottom: 30px;"><center>
				<span style="font-size: 24px;"><strong>Laporan Pembayaran Anggota</strong></span><br>
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
						<th>JENIS</th>
						<th>TANGGAL</th>
						<th colspan="2">NILAI</th>
					</tr>
				</thead>
				<tbody>
					@php
						$no = 1;
					@endphp
					@foreach($Pembayaran as $p)
					<tr>
						<td>{{ $no }}</td>
						@if($pengguna=="")
						<td>{{ $p->name }}</td>
						@endif
						<td>{{ $p->jenis }}</td>
						<td>{{ $p->tanggal }}</td>
						<td width="20">Rp.</td>
						<td>{{ nomor($p->nilai) }}</td>
					</tr>
					@php
						$no = $no + 1;
					@endphp
					@endforeach
				</tbody>
			</table>
@endsection