@extends('template.cetak')
@section('content')
			<h5 style="margin-bottom: 30px;"><center>
				<span style="font-size: 24px;"><strong>Laporan Muroja'ah Harian</strong></span><br>
				<span style="font-size: 20px;">Pada {{ $tanggal }}</span>
			</center></h5>
			<table>
				<thead>
					<tr>
						<th style="text-align: left;">No.</th>
						<th>Tanggal</th>
						<th>NIS</th>
						<th>Nama</th>
						<th>Ustadz</th>
						<th>Juz</th>
						<th>Muqro</th>
						<th>Nilai</th>
						<th>Keterangan</th>
					</tr>
				</thead>
				<tbody>
					@php
						$no = 1;
						$ket_ln = 0;
						$ket_tg = 0;
					@endphp
					@foreach($Hafalan as $h)
					<tr>
						<td>{{ $no }}</td>
						<td>{{ $h->h_tanggal }}</td>
						<td>{{ $h->s_nis }}</td>
						<td>{{ $h->s_nama }}</td>
						<td>{{ $h->h_ustadz }}</td>
						<td>{{ $h->h_juz }}</td>
						<td>{{ $h->h_muqro }}</td>
						<td>{{ $h->h_hasil }}</td>
						<td>{{ $h->h_keterangan }}</td>
					</tr>
					@php
						$no = $no + 1;
					@endphp
					@endforeach
				</tbody>
			</table>
@endsection