@if($Tabungan->count()>0)
	<table class="responsive-table">
		<thead>
			<tr>
				<th>Tanggal</th>
				<th>Pemasukan</th>
				<th>Pengeluaran</th>
				<th>Saldo</th>
				<th>Keterangan</th>
			</tr>
		</thead>
		<tbody>
			@foreach($Tabungan as $h)
				<tr>
					<td>{{ $h->t_tanggal }}</td>
					<td>{{ nomor($h->t_debet) }}</td>
					<td>{{ nomor($h->t_kredit) }}</td>
					<td>{{ nomor($h->t_saldo) }}</td>
					<td>{{ $h->t_keterangan }}</td>
				</tr>
			@endforeach
			</tbody>
		</table>
@else
<p>Tabungan santri masih kosong.</p>
@endif