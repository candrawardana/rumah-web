@extends('template.welcome')
@section('title')
Muroja'ah Santri
@endsection
@section('subtitle')
<li class="breadcrumb-item"><a href="{{ url('santri') }}">Santri</a></li>
<li class="breadcrumb-item"><a href="{{ url('santri/'.$Santri->s_nis) }}">{{ $Santri->s_nama }}</a></li>
<li class="breadcrumb-item active">Muroja'ah</li>
@endsection
@section('content')
<div class="container">
	<div class="row">
		<div class="content-title">
			<a href="#" class="brand-logo grey-text text-darken-4 content-text">Riwayat Muroja'ah {{ $Santri->s_nama }}</a>
		</div>
	</div>
	<div class="row">
		<div class="col s12">
			<ul class="collapsible">
				<li>
					<div class="collapsible-header green-text">
						<i class="material-icons">add</i> <strong>Edit Muroja'ah Harian</strong>
					</div>
					<div class="collapsible-body">
						<!-- FORM HAFALAN -->
						<form action="{{ url('tambah-hafalan') }}" method="POST">
							@csrf
							<input type="hidden" name="s_nis" value="{{ $Santri->s_nis }}">
							<div class="input-field">
								<input name="h_tanggal" id="h_tanggal" type="text" class="datepicker">
								<label for="h_tanggal">Tanggal</label>
							</div>
							<div class="input-field">
								<input name="h_juz" id="h_juz" type="text" class="validate">
								<label for="h_juz">Juz</label>
							</div>
							<div class="input-field">
								<input name="h_muqro" id="h_muqro" type="text" class="validate">
								<label for="h_muqro">Muqro'</label>
							</div>
							@if(Auth::user()->jenis == 'Administrator')
							<div class="input-field">
								<select name="h_ustadz" id="hb_ustadz">
									<option value="" disabled selected>Pilih Ustadz</option>
									@foreach(semua_ustadz() as $s)
									<option value="{{ $s->name }}">{{ $s->name }}</option>
									@endforeach
								</select>
							</div>
							@else
							<input type="hidden" name="h_ustadz" value="{{ Auth::user()->name }}">
							@endif
							<div class="input-field">
								<input name="h_hasil" id="h_hasil" type="text" class="validate">
								<label for="h_hasil">Hasil</label>
							</div>
							<div class="input-field">
								<input name="h_keterangan" id="h_keterangan" type="text" class="validate">
								<label for="h_keterangan">Keterangan</label>
							</div>
							<div align="right">
								<button class="btn green waves-effect waves-light" type="submit" name="submit">Simpan
									<i class="material-icons right">send</i>
								</button>
							</div>
						</form>
						<!-- /FORM HAFALAN -->
					</div>
				</li>
			</ul>
		</div>
		<div class="col s12">
			{!! view('konten.hafalan',compact('Hafalan'))->render() !!}
		</div>
	</div>
</div>
@endsection