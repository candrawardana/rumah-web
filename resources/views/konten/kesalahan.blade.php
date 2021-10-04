@if($Kesalahan->count()>0)
	<table class="responsive-table">
		<thead>
			<tr>
				<th>Tanggal</th>
				<th>Kesalahan</th>
				<th>Sanksi</th>
				@if(Auth::user()->jenis == 'Administrator')
				<th></th>
				@endif
			</tr>
		</thead>
		<tbody>
			@foreach($Kesalahan as $h)
				<tr>
					<td>{{ $h->k_tanggal }}</td>
					<td>{{ $h->k_kesalahan }}</td>
					<td>{{ $h->k_hukuman }}</td>
					@if(Auth::user()->jenis == 'Administrator')
					<td><a class="tooltipped red-text" data-position="bottom" data-tooltip="Hapus Kesalahan santri?" onClick="javascript: return confirm('Yakin ingin menghapus?');" 
						href="{{ url('hapus-kesalahan/'.$h->h_id) }}"><i class="material-icons">delete</i></a></td>
					@endif
				</tr>
			@endforeach
			</tbody>
		</table>
@else
<p>Belum ada kesalahan yang diperbuat santri.</p>
@endif