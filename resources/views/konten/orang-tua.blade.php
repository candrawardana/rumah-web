@if($Ayah)
<table>
	<tbody>
		<tr>
			<td colspan="3"><strong>Data Ayah</strong></td>
		</tr>
		<tr>
			<td width="30%">Nama</td>
			<td width="1%">:</td>
			<td>{{ $Ayah->a_nama }}</td>
		</tr>
		<tr>
			<td width="30%">Telepon</td>
			<td>:</td>
			<td>{{ $Ayah->a_telp }}</td>
		</tr>
		<tr>
			<td width="30%">Whatsapp</td>
			<td>:</td>
			<td>{{ $Ayah->a_wa }}</td>
		</tr>
		<tr>
			<td width="30%">Tmp. Lahir</td>
			<td>:</td>
			<td>{{ $Ayah->a_tmplahir }}</td>
		</tr>
		<tr>
			<td width="30%">Tgl. Lahir</td>
			<td>:</td>
			<td>{{ $Ayah->a_tgllahir }}</td>
		</tr>
		<tr>
			<td width="30%">Pendidikan</td>
			<td>:</td>
			<td>{{ $Ayah->a_pendidikan }}</td>
		</tr>
		<tr>
			<td width="30%">Pekerjaan</td>
			<td>:</td>
			<td>{{ $Ayah->a_pekerjaan }}</td>
		</tr>
		<tr>
			<td width="30%">Alamat</td>
			<td>:</td>
			<td>{{ $Ayah->a_alamat }}</td>
		</tr>
	</tbody>
</table>
@endif
<!-- Data Ibu -->
@if($Ibu)
<table style="margin-top: 40px">
	<tbody>
		<tr>
			<td colspan="3"><strong>Data Ibu</strong></td>
		</tr>
		<tr>
			<td width="30%">Nama</td>
			<td width="1%">:</td>
			<td>{{ $Ibu->i_nama }}</td>
		</tr>
		<tr>
			<td width="30%">Telepon</td>
			<td>:</td>
			<td>{{ $Ibu->i_telp }}</td>
		</tr>
		<tr>
			<td width="30%">Whatsapp</td>
			<td>:</td>
			<td>{{ $Ibu->i_wa }}</td>
		</tr>
		<tr>
			<td width="30%">Tmp. Lahir</td>
			<td>:</td>
			<td>{{ $Ibu->i_tmplahir }}</td>
		</tr>
		<tr>
			<td width="30%">Tgl. Lahir</td>
			<td>:</td>
			<td>{{ $Ibu->i_tgllahir }}</td>
		</tr>
		<tr>
			<td width="30%">Pendidikan</td>
			<td>:</td>
			<td>{{ $Ibu->i_pendidikan }}</td>
		</tr>
		<tr>
			<td width="30%">Pekerjaan</td>
			<td>:</td>
			<td>{{ $Ibu->i_pekerjaan }}</td>
		</tr>
	</tbody>
</table>
@endif
@if(!$Ayah && !$Ibu)
<p>Tidak ada info orang tua.</p>
@endif