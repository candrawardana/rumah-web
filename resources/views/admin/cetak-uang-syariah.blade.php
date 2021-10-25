@extends('template.cetak')
@section('content')
		<hr style="margin-bottom: 20px;">
			<h5 style="margin-bottom: 30px;"><center>
				<span style="font-size: 24px;"><strong>Laporan Pembayaran Uang Syari'ah</strong></span><br>
				<span style="font-size: 20px;">{{ $jenis }}</span>
			</center></h5>
			<table>
				<thead>
					<tr>
						<th style="text-align: left;">No.</th>
						<th style="text-align: left;">Tanggal</th>
						<th style="text-align: left;">NIS</th>
						<th style="text-align: left;">Nama Santri</th>
						<th style="text-align: left;">Bulan</th>
						<th colspan="2" style="text-align: left;">Nominal</th>
						<th style="text-align: left;">Keterangan</th>
					</tr>
				</thead>
				<tbody>
					@php
						$no = 1;
						$ket_ln = 0;
						$ket_tg = 0;
					@endphp
					@foreach($UangSyariah as $u)
					<tr>
						<td style="font-size: 14px;">{{ $no }}</td>
						<td style="font-size: 14px;">{{ $u->u_tanggal }}</td>
						<td style="font-size: 14px;">{{ $u->s_nis }}</td>
						<td style="font-size: 14px;">{{ $u->s_nama }}</td>
						<td style="font-size: 14px;">{{ $u->u_bulan }}</td>
						<td style="font-size: 14px;" width="1%">Rp.</td>
						<td style="font-size: 14px;text-align: right; padding-right: 10px;"
						>{{ nomor($u->u_nominal) }}</td>
						<td style="font-size: 14px;">{{ $u->u_keterangan }}</td>
					</tr>
					@php
						$no = $no + 1;
						if ($u->u_keterangan == 'Lunas') {
							$ket_ln = $u->u_nominal + $ket_ln;
						} else {
							$ket_tg = $u->u_nominal + $ket_tg;
						}
					@endphp
					@endforeach
					<tr>
						<th colspan="5" style="text-align: left;">Total Pemasukan</th>
						<th width="1%">Rp.</th>
						<th style="text-align: right; padding-right: 10px;">{{ nomor($ket_ln,0,'','.') }}</th>
						<th></th>
					</tr>
					<tr>
						<th colspan="5" style="text-align: left;">Total Tunggakan</th>
						<th width="1%">Rp.</th>
						<th style="text-align: right; padding-right: 10px;">{{ nomor($ket_tg,0,'','.') }}</th>
						<th></th>
					</tr>
				</tbody>
			</table>
@endsection