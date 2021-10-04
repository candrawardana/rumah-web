@if($Hafalan->count()>0)
	<table class="responsive-table">
		<thead>
			<tr>
				<th>Tanggal</th>
				<th>Juz</th>
				<th>Muqro'</th>
				<th>Ustadz</th>
				<th>Hasil</th>
				<th>Keterangan</th>
				@if(Auth::user()->jenis == 'Administrator' || Auth::user()->jenis == 'Ustadz')
				<th></th>
				@endif
			</tr>
		</thead>
		<tbody>
			@foreach($Hafalan as $h)
				<tr>
					<td>{{ $h->h_tanggal }}</td>
					<td>{{ $h->h_juz }}</td>
					<td>{{ $h->h_muqro }}</td>
					<td>{{ $h->h_ustadz }}</td>
					<td>{{ $h->h_hasil }}</td>
					<td>{{ $h->h_keterangan }}</td>
					@if(Auth::user()->jenis == 'Administrator' || Auth::user()->jenis == 'Ustadz')
					<td><a class="tooltipped red-text" data-position="bottom" data-tooltip="Hapus Data Muroja'ah." onClick="javascript: return confirm('Yakin ingin menghapus?');" 
						href="{{ url('hapus-hafalan/'.$h->h_id) }}"><i class="material-icons">delete</i></a></td>
					@endif
				</tr>
			@endforeach
			</tbody>
		</table>
@else
<p>Belum ada data Muroja\'ah Harian santri</p>
@endif