@if($HafalanBaru->count()>0)
	<table class="responsive-table">
		<thead>
			<tr>
				<th>Tanggal</th>
				<th>Juz</th>
				<th>Surat</th>
				<th>Ayat</th>
				<th>Ustadz</th>
				<th>Nilai</th>
				<th>Keterangan</th>
				@if(Auth::user()->jenis == 'Administrator' || Auth::user()->jenis == 'Ustadz')
				<th></th>
				@endif
			</tr>
		</thead>
		<tbody>
			@foreach($HafalanBaru as $h)
				<tr>
					<td>{{ $h->hb_tanggal }}</td>
					<td>{{ $h->hb_juz }}</td>
					<td>{{ $h->hb_surat  }}</td>
					<td>{{ $h->hb_ayat  }}</td>
					<td>{{ $h->hb_ustadz  }}</td>
					<td>{{ $h->hb_nilai  }}</td>
					<td>{{ $h->hb_keterangan  }}</td>
					@if(Auth::user()->jenis == 'Administrator' || Auth::user()->jenis == 'Ustadz')
					<td><a class="tooltipped red-text" data-position="bottom" data-tooltip="Hapus Data Hafalan." onClick="javascript: return confirm('Yakin ingin menghapus?');" 
						href="{{ url('hapus-hafalan-baru/'.$h->hb_id) }}"><i class="material-icons">delete</i></a></td>
					@endif
				</tr>
			@endforeach
		</tbody>
	</table>
@else
<p>Belum ada data hafalan baru santri</p>
@endif