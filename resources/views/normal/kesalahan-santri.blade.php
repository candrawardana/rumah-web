@extends('template.welcome')
@section('title')
Kesalahan Santri
@endsection
@section('content')
<!-- SANTRI_CONTENT -->
<div class="container">
  <div class="row">
    <div class="content-title">
      <a href="#" class="brand-logo grey-text text-darken-4 content-text">Daftar Kesalahan - {{ $Santri->s_nama }}</a>
    </div>
  </div>
  <div class="row">
    <div class="col s12">
      <ul class="collapsible">
        <li>
          <div class="collapsible-header green-text">
            <i class="material-icons">add</i> <strong>Tambah Datfar Kesalahan</strong>
          </div>
          <div class="collapsible-body">
            <!-- FORM KESALAHAN -->
            <form action="{{ url('buat-kesalahan') }}" method="POST">
              @csrf
              <input type="hidden" name="s_nis" value="{{ $Santri->s_nis }}">
              <div class="input-field">
                <input name="k_tanggal" id="k_tanggal" type="text" class="datepicker" value="{{ date('d-m-Y') }}">
                <label for="k_tanggal">Tanggal</label>
              </div>
              <div class="input-field">
                <textarea name="k_kesalahan" id="k_kesalahan" class="materialize-textarea"></textarea>
                <label for="k_kesalahan">Kesalahan</label>
              </div>
              <div class="input-field">
                <textarea name="k_hukuman" id="k_hukuman" class="materialize-textarea"></textarea>
                <label for="k_hukuman">Sanksi</label>
              </div>
              <div align="right">
                <!-- <a href="#" class="modal-close waves-effect waves-green btn-flat">Batal</a> -->
                <button class="btn green waves-effect waves-light" type="submit" name="submit">Proses <i class="material-icons right">send</i>
                </button>
              </div>
            </form>
            <!-- /FORM KESALAHAN -->
          </div>
        </li>
      </ul>
    </div>
  </div>
  <div class="row">
    <div class="divider"></div>
  </div>
  <div class="row">
    {!! view('konten.kesalahan',compact('Kesalahan'))->render() !!}
  </div>
</div>
@endsection