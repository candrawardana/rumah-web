@if($UangSyariah->count()>0)
	<table class="responsive-table">
		<thead>
			<tr>
				<th>Tgl. Bayar</th>
				<th>Bulan</th>
				<th>Nominal</th>
				<th>Keterangan</th>
				@if(Auth::user()->jenis == 'Administrator')
				<th></th>
				@endif
			</tr>
		</thead>
		<tbody>
			@foreach($UangSyariah as $h)
				<tr>
					<td>{{ $h->u_tanggal }}</td>
					<td>{{ $h->u_bulan }}</td>
					<td>{{ nomor($h->u_nominal) }}</td>
					<td>{{ $h->u_keterangan }}</td>
					@if(Auth::user()->jenis == 'Administrator')
					<td><a class="tooltipped red-text" data-position="bottom" data-tooltip="Hapus Data Bulan {{ $h->u_bulan }}" onClick="javascript: return confirm('Yakin ingin menghapus?');" 
						href="{{ url('hapus-uang-syariah/'.$h->id) }}"><i class="material-icons">delete</i></a></td>
					@endif
				</tr>
			@endforeach
			</tbody>
		</table>
@else
<p>Belum ada pembayaran uang syariah.</p>
@endif