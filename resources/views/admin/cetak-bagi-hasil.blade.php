@extends('template.cetak')
@section('content')
			<h5 style="margin-bottom: 30px;"><center>
				<span style="font-size: 24px;"><strong>Laporan Bagi Hasil</strong></span><br>
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
						<td>{{ $no }}</td>
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
						<th colspan="12" style="text-align: center; vertical-align: middle;">TOTAL</th>
					</tr>
					<tr
					@if($selisih_jual<=0)
					class="bg-red"
					@else
					class="bg-green"
					@endif
					>
						<td></td>
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
@endsection