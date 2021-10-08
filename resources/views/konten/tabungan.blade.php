@if($Tabungan->count()>0)
	<table class="responsive-table">
		<thead>
			<tr>
				<th>Tanggal</th>
				<th>Pemasukan</th>
				<th>Pengeluaran</th>
				<th>Saldo</th>
				<th>Keterangan</th>
				@if(Auth::user()->jenis=="Administrator")
				<th></th>
				@endif
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
					<td><a class="tooltipped red-text" data-position="bottom" data-tooltip="Hapus Data Muroja'ah."
						href="{{ url('hapus-tabungan/'.$h->id) }}"><i class="material-icons">delete</i></a></td>
				</tr>
			@endforeach
			</tbody>
		</table>
@else
<p>Tabungan santri masih kosong.</p>
@endif