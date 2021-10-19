@extends('template.welcome')
@section('title')
Potongan Tabungan
@endsection
@section('subtitle')
              <li class="breadcrumb-item active">Potongan Tabungan</li>
@endsection
@section('content')
<!-- CONTENT POTONGAN -->
<div class="container">
	<div class="row">
		<div class="content-title">
			<a href="#" class="brand-logo grey-text text-darken-4 content-text">Potongan Tabungan Santri</a>
		</div>
	</div>
	<div class="row">
	    <form method="post">
	    	@csrf
	        <div class="input-field">
                <select id="selectsantri" name="santri[]" multiple>
                  <option value="" disabled></option>
                  @foreach($Santri as $s)
                  <option value="{{ $s->s_nis }}">{{ $s->s_nama }}</option>
                  @endforeach
                </select>
                <label for="selectsantri">Pilih Santri</label>
                
            </div>
            <div class="input-field">
				<input name="t_tanggal" id="t_tanggal" type="text" class="datepicker">
				<label for="t_tanggal">Tanggal</label>
			</div>
			<div class="input-field">
				<select name="t_keterangan" id="t_keterangan" class="validate" onchange="selAlasan()">
					<option value="Penarikan" selected>Penarikan</option>
				</select>
				<label for="t_keterangan">Keterangan</label>
			</div>
			<div class="input-field" id="alasan">
				<input name="t_penarikan" id="t_penarikan" type="text" class="validate">
				<label for="t_penarikan">Alasan</label>
			</div>
			<div class="input-field">
				<input name="t_nominal" id="t_nominal" type="text" class="validate" value="0" min="0">
				<label for="t_nominal">Nominal</label>
			</div>
			<div align="right">
				<!-- <a href="#" class="modal-close waves-effect waves-green btn-flat">Batal</a> -->
				<button class="btn green waves-effect waves-light" type="submit" name="submit">Proses <i class="material-icons right">send</i>
				</button>
			</div>
	    </form>
	</div>
	

</div>
@endsection