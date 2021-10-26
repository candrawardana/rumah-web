@extends('template.cetak')
@section('content')
			<h5 style="margin-bottom: 30px;"><center>
				<span style="font-size: 24px;"><strong>Laporan Tabungan Santri</strong></span>
			</center></h5>
			<table>
				<thead>
					<tr>
						<th style="text-align: left;">No.</th>
						<th style="text-align: left;">NIS</th>
						<th style="text-align: left;">Nama Santri</th>
						<th colspan="2" style="text-align: left;">Saldo</th>
					</tr>
				</thead>
				<tbody>
					@php
						$no = 1;
						$ttl = 0;
					@endphp
					@foreach($Santri as $s)
					<tr>
						<td>{{ $no }}</td>
						<td>{{ $s->s_nis }}</td>
						<td>{{ $s->s_nama }}</td>
						<td width="1%">Rp.</td>
						<td style="text-align: right; padding-right: 10px;">{{ nomor($s->tabungan) }}</td>
					</tr>
					@php
						$no = $no + 1;
						$ttl = $ttl+$s->tabungan;
					@endphp
					@endforeach
					<tr>
						<th colspan="3" style="text-align: left;">Total Saldo</th>
						<th width="1%">Rp.</th>
						<th style="text-align: right; padding-right: 10px;">{{ nomor($ttl) }}</th>
						<th></th>
					</tr>
				</tbody>
			</table>
@endsection