@extends('template.welcome')
@section('title')
Hafalan Santri
@endsection
@section('subtitle')
<li class="breadcrumb-item"><a href="{{ url('santri') }}">Santri</a></li>
<li class="breadcrumb-item"><a href="{{ url('santri/'.$Santri->s_nis) }}">{{ $Santri->s_nama }}</a></li>
<li class="breadcrumb-item active">Hafalan</li>
@endsection
@section('content')
<div class="container">
	<div class="row">
		<div class="content-title">
			<a href="#" class="brand-logo grey-text text-darken-4 content-text">Laporan Hafalan Baru {{ $Santri->s_nama }}</a>
		</div>
	</div>
	<div class="row">
		<div class="col s12">
			<ul class="collapsible">
				<li>
					<div class="collapsible-header green-text">
						<i class="material-icons">add</i> <strong>Tambah Hafalan Baru</strong>
					</div>
					<div class="collapsible-body">
						<!-- FORM HAFALAN -->
						<form action="{{ url('tambah-hafalan-baru') }}" method="POST">
							@csrf
							<input type="hidden" name="s_nis" value="{{ $Santri->s_nis }}">
							<div class="input-field">
								<input name="hb_tanggal" id="hb_tanggal" type="text" class="datepicker">
								<label for="hb_tanggal">Tanggal</label>
							</div>
							<div class="input-field">
								<input name="hb_juz" id="hb_juz" type="text" class="validate">
								<label for="hb_juz">Juz</label>
							</div>
							<div class="input-field">
								<input name="hb_surat" id="hb_surat" type="text" class="validate">
								<label for="hb_surat">Surat</label>
							</div>
							<div class="input-field">
								<input name="hb_ayat" id="hb_ayat" type="text" class="validate">
								<label for="hb_ayat">Ayat</label>
							</div>
							<div class="input-field">
								<input name="hb_nilai" id="hb_nilai" type="text" class="validate">
								<label for="hb_nilai">Nilai</label>
							</div>
							@if(Auth::user()->jenis == 'Administrator')
							<div class="input-field">
								<select name="hb_ustadz" id="hb_ustadz">
									<option value="" disabled selected>Pilih Ustadz</option>
									@foreach(semua_ustadz() as $s)
									<option value="{{ $s->name }}">{{ $s->name }}</option>
									@endforeach
								</select>
							</div>
							@else
							<input type="hidden" name="hb_ustadz" value="{{ Auth::user()->name }}">
							@endif
							<div class="input-field">
								<input name="hb_keterangan" id="hb_keterangan" type="text" class="validate">
								<label for="hb_keterangan">Keterangan</label>
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
			{!! view('konten.hafalan-baru',compact('HafalanBaru'))->render() !!}
		</div>
	</div>
</div>
@endsection