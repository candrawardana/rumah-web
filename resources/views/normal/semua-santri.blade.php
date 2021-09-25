@extends('template.welcome')
@section('title')
Santri
@endsection
@section('content')
<!-- SANTRI_CONTENT -->
<div class="container">
  <div class="row">
    <div class="content-title">
      <a href="#" class="brand-logo grey-text text-darken-4 content-text">Data Santri</a>
          </div>
  </div>

  <div class="row">
  <nav>
    <div class="nav-wrapper">
    <form>
      <div class="input-field green">
        <input id="search" type="search" name="q" value="{{ $q }}" placeholder="Cari Nama Santri">
        <label class="label-icon" for="search"><i class="material-icons">search</i></label>
      </div>
    </form>
    </div>
    </nav>
  </div>
  <div class="row">
    
    <table class="responsive-table" id="tableSantri">
      <thead>
        <tr>
          <th>No. Induk</th>
          <th>Nama Santri</th>
          <th>Nama Ayah</th>
          <th>Tabungan</th>
          <th>Pilihan</th>
        </tr>
      </thead>
      <tbody>
        @foreach($Santri as $s)
        <tr>
          <td>{{ $s->s_nis }}</td>
          <td>{{ $s->s_nama }}</td>
          <td>{{ $s->ayah }}</td>
          <td><span class="left">Rp. </span><span class="right" style="padding-right: 20px">{{ $s->tabungan }}</span></td>
          <td>
            <a class="tooltipped green-text" data-position="bottom" data-tooltip="Profil {{ $s->s_nama }}" 
                              href="{{ url('santri/'.$s->s_nis) }}"><i class="material-icons">person</i></a>
            <a class="tooltipped green-text" data-position="bottom" data-tooltip="Daftar Kesalahan {{ $s->s_nama }}" 
              href="{{ url('santri/'.$s->s_nis.'/kesalahan') }}"><i class="material-icons">error</i></a>
            <a class="tooltipped green-text" data-position="bottom" data-tooltip="Hafalan Baru {{ $s->s_nama }}" 
            href="{{ url('santri/'.$s->s_nis.'/hafalan-baru') }}"><i class="material-icons">fiber_new</i></a>

            <a class="tooltipped green-text" data-position="bottom" data-tooltip="Riwayat Muroja'ah {{ $s->s_nama }}" 
              href="{{ url('santri/'.$s->s_nis.'/hafalan') }}"><i class="material-icons">book</i></a>
                          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {!! $Santri->links('template.paginator') !!}
  </div>
</div>
@endsection