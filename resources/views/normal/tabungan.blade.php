@extends('template.welcome')
@section('title')
Tabungan Santri
@endsection
@section('subtitle')
<li class="breadcrumb-item"><a href="{{ url('santri') }}">Santri</a></li>
<li class="breadcrumb-item"><a href="{{ url('santri/'.$Santri->s_nis) }}">{{ $Santri->s_nama }}</a></li>
<li class="breadcrumb-item active">Tabungan</li>
@endsection
@section('content')
<div class="container">
	<div class="row">
		<div class="content-title">
			<a href="#" class="brand-logo grey-text text-darken-4 content-text">Riwayat Tabungan {{ $Santri->s_nama }}</a>
		</div>
	</div>
	<div class="row">
		<div class="col s12">
			<ul class="collapsible">
				<li>
					<div class="collapsible-header green-text">
						<i class="material-icons">add</i> <strong>Edit Tabungan</strong>
					</div>
					<div class="collapsible-body">
						<!-- FORM HAFALAN -->
						<form action="{{ url('tambah-tabungan') }}" method="POST">
							@csrf
							<input type="hidden" name="s_nis" value="{{ $Santri->s_nis }}">
							<div class="input-field">
								<input name="t_tanggal" id="t_tanggal" type="text" class="datepicker">
								<label for="t_tanggal">Tanggal</label>
							</div>
							<div class="input-field">
								<select name="t_keterangan" id="t_keterangan" class="validate" onchange="selAlasan()">
									<option value="Tabungan" selected>Tabungan</option>
									<option value="Penarikan">Penarikan</option>
								</select>
								<label for="t_keterangan">Keterangan</label>
							</div>
							<div class="input-field" style="display: none;" id="alasan">
								<input name="t_penarikan" id="t_penarikan" type="text" class="validate">
								<label for="t_penarikan">Alasan</label>
							</div>
							<div class="input-field">
								<input name="t_nominal" id="t_nominal" type="text" class="validate" value="0" min="0">
								<label for="t_nominal">Nominal</label>
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
			{!! view('konten.tabungan',compact('Tabungan'))->render() !!}
		</div>
	</div>
</div>
@endsection
@section('script')
<script type="text/javascript">
	function selAlasan() {
		var x = document.getElementById("t_keterangan").value;
		if (x == 'Penarikan'){
			document.getElementById("alasan").style.display = 'inline';
		} else {
			document.getElementById("alasan").style.display = 'none';
		}
	}
</script>
@endsection