@extends('template.welcome')
@section('title')
Laporan Uang Syariah
@endsection
@section('subtitle')
<li class="breadcrumb-item active">Laporan Uang Syariah</li>
@endsection
@section('content')
  <div class="row">
    <div class="col s12">
      <h5>Laporan Berdasarkan Bulan Pembayaran</h5>
    </div>
    <form method="POST" target="_blank">
      @csrf
      <!-- pilih laporan -->
      <div class="input-field inline col m4 s6">
        <select name="l_pilihan" id="l_pilihan">
          <option value="01">Januari</option>
          <option value="02">Februari</option>
          <option value="03">Maret</option>
          <option value="04">April</option>
          <option value="05">Mei</option>
          <option value="06">Juni</option>
          <option value="07">Juli</option>
          <option value="08">Agustus</option>
          <option value="09">September</option>
          <option value="10">Oktober</option>
          <option value="11">November</option>
          <option value="12">Desember</option>
        </select>
        <label for="l_pilihan">Pilih Bulan</label>
      </div>
      <div class="input-field inline col m4 s6">
        <input name="tahun1" id="tahun1" type="text" value="{{ date('Y') }}">
        <label for="tahun1">Pilih Tahun</label>
      </div>
      <!-- /pilih laporan -->
      <div class="input-field inline col m4 s12">
        <button class="btn green waves-effect waves-light" type="submit" name="submit1">Tampilkan
          <i class="material-icons right">send</i>
        </button>
      </div>
    </form>
  </div>

  <div class="row">
    <div class="col s12">
      <h5>Laporan Berdasarkan Bulan yang Dibayar</h5>
    </div>
    <form method="POST" target="_blank">
      @csrf
      <!-- pilih laporan -->
      <div class="input-field inline col m8 s12">
        <select name="l_pilihan2" id="l_pilihan2">
          <option value="Januari">Januari</option>
          <option value="Februari">Februari</option>
          <option value="Maret">Maret</option>
          <option value="April">April</option>
          <option value="Mei">Mei</option>
          <option value="Juni">Juni</option>
          <option value="Juli">Juli</option>
          <option value="Agustus">Agustus</option>
          <option value="September">September</option>
          <option value="Oktober">Oktober</option>
          <option value="November">November</option>
          <option value="Desember">Desember</option>
        </select>
        <label for="l_pilihan2">Pilih Bulan</label>
      </div>
      <!-- /pilih laporan -->
      <div class="input-field inline col m4 s12">
        <button class="btn green waves-effect waves-light" type="submit" name="submit2">Tampilkan
          <i class="material-icons right">send</i>
        </button>
      </div>
    </form>
  </div>

  <div class="row">
    <div class="col s12">
      <h5>Laporan Berdasarkan Rentang Tanggal</h5>
    </div>
    <form method="POST" target="_blank">
      @csrf
      <div class="input-field inline col m4 s6">
        <input name="l_start" id="l_start" type="text" class="datepicker">
        <label for="l_start">Mulai Tanggal</label>
      </div>
      <div class="input-field inline col m4 s6">
        <input name="l_end" id="l_end" type="text" class="datepicker">
        <label for="l_end">Sampai Tanggal</label>
      </div>
      <div class="input-field inline col m4 s12">
        <button class="btn green waves-effect waves-light" type="submit" name="submit3">Tampilkan
          <i class="material-icons right">send</i>
        </button>
      </div>
    </form>
  </div>

  <div class="row">
    <div class="col s12">
      <h5>Laporan Berdasarkan Tahun</h5>
    </div>
    <form method="POST" target="_blank">
      @csrf
      <div class="input-field inline col m8 s12">
        <input type="text" name="l_tahun" id="l_tahun" value="{{ date('Y') }}">
        <label for="l_tahun">Input Tahun</label>
      </div>
      <div class="input-field inline col m4 s12">
        <button class="btn green waves-effect waves-light" type="submit" name="submit4">Tampilkan
          <i class="material-icons right">send</i>
        </button>
      </div>
    </form>
  </div>
@endsection