@extends('template.welcome')
@section('title')
Santri
@endsection
@section('subtitle')
<li class="breadcrumb-item"><a href="url('santri')">Santri</a></li>
<li class="breadcrumb-item active">{{ $Santri->s_nama }}</li>
@endsection
@section('content')
<!-- SANTRI_CONTENT -->
<div class="container">
  <div class="row">
    <div class="content-title">
      <a href="#" class="brand-logo grey-text text-darken-4 content-text">Profil Santri</a>
    </div>
  </div>
  <div class="row">
    <div class="col s12 grey-text" align="right">
      <span><i>Reg. {{ $Santri->s_reg }}</i></span>
    </div>
  </div>
  <div class="row">
    <div class="col s12 m5" align="center">
      <img class="materialboxed foto-profil z-depth-2" src="{{ $Santri->foto }}">
      <h5 class="center txt-nama"><strong>{{ $Santri->s_nama }}</strong></h5>
      <h6 class="center txt-nama"><strong>{{ $Santri->s_nis }}</strong></h6>
    </div>
    <div class="col s12 m7">
      <table>
        <tbody>
          <tr>
            <td width="30%">Nama Panggilan</td>
            <td>:</td>
            <td>{{ $Santri->s_nis }}</td>
          </tr>
          <tr>
            <td>Tempat, Tgl Lahir</td>
            <td>:</td>
            <td>{{ $Santri->s_tmplahir }}, {{ $Santri->s_tgllahir }}</td>
          </tr>
          <!-- <li>Anak ke- dari  Bersaudara</li> -->
          <tr>
            <td>Asal Sekolah</td>
            <td>:</td>
            <td>{{ $Santri->s_aslskolah }}</td>
          </tr>
          <tr>
            <td>Prestasi</td>
            <td>:</td>
            <td>{{ $Santri->s_prestasi }}</td>
          </tr>
          <tr>
            <td>Hobi</td>
            <td>:</td>
            <td>{{ $Santri->s_hobi }}</td>
          </tr>
          <tr>
            <td>Cita-cita</td>
            <td>:</td>
            <td>{{ $Santri->s_cita }}</td>
          </tr>
          <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{ $Santri->s_alamat }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

<div class="row">
  <div class="col s12">
    <ul class="collapsible">
      <li>
        <div class="collapsible-header green-text">
          <i class="material-icons">fiber_new</i> <strong>Hafalan Baru</strong>
        </div>
        <div class="collapsible-body">
          {!! view('konten.hafalan-baru',compact('HafalanBaru'))->render() !!}
        </div>
      </li>
      <li>
        <div class="collapsible-header green-text">
          <i class="material-icons">book</i> <strong>Muroja'ah Harian</strong>
        </div>
        <div class="collapsible-body">
          {!! view('konten.hafalan',compact('Hafalan'))->render() !!}
        </div>
      </li>
      <li>
        <div class="collapsible-header green-text">
          <i class="material-icons">account_balance_wallet</i> <strong>Tabungan</strong>
        </div>
        <div class="collapsible-body">
          {!! view('konten.tabungan',compact('Tabungan'))->render() !!}
        </div>
      </li>
      <li>
        <div class="collapsible-header green-text">
          <i class="material-icons">payment</i> <strong>Uang Syariah</strong>
        </div>
        <div class="collapsible-body">
          {!! view('konten.uang-syariah',compact('UangSyariah'))->render() !!}
        </div>
      </li>
      <li>
        <div class="collapsible-header green-text">
          <i class="material-icons">error</i> <strong>Kesalahan</strong>
        </div>
        <div class="collapsible-body">
          {!! view('konten.kesalahan',compact('Kesalahan'))->render() !!}
        </div>
      </li>
      <li>
        <div class="collapsible-header green-text">
          <i class="material-icons">supervisor_account</i> <strong>Data Orang Tua</strong>
        </div>
        <div class="collapsible-body">
          {!! view('konten.orang-tua',compact('Ayah','Ibu'))->render() !!}
        </div>
      </li>
    </ul>
  </div>
</div>

</div>
@endsection