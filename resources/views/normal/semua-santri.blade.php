@extends('template.welcome')
@section('title')
Santri
@endsection
@section('subtitle')
<li class="breadcrumb-item active">Santri</li>
@endsection
@section('content')
<!-- SANTRI_CONTENT -->
<div class="container">
  <div class="row">
    <div class="content-title">
      <a href="#" class="brand-logo grey-text text-darken-4 content-text">Data Santri</a>
      @if(Auth::user()->jenis == 'Administrator')
      <span class="right"><a href="{{ url('tambah-santri') }}" class="btn-floating btn-large waves-effect waves-light green"><i class="material-icons">add</i></a></span>
      @endif
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
          @if(Auth::user()->jenis == 'Administrator')
          <th>Password</th>
          @endif
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
          @if(Auth::user()->jenis == 'Administrator')
          <td width="15%">
            <a href="#" class="showPassword"><i class="material-icons ic">visibility</i></a>
            <span class="tampil" style="display: none;">{{ $s->s_password }}</span>
          </td>
          @endif
          <td>{{ $s->ayah }}</td>
          <td><span class="left">Rp. </span><span class="right" style="padding-right: 20px">{{ nomor($s->tabungan) }}</span></td>
          <td>
                <a class="tooltipped green-text" data-position="bottom" data-tooltip="Profil {{ $s->s_nama }}" 
                  href="{{ url('santri/'.$s->s_nis) }}"><i class="material-icons">person</i></a>
                @if(Auth::user()->jenis == 'Administrator' || Auth::user()->jenis == 'Ustadz')
                <a class="tooltipped green-text" data-position="bottom" data-tooltip="Detail Tabungan {{ $s->s_nama }}" 
                  href="{{ url('santri/'.$s->s_nis.'/tabungan') }}"><i class="material-icons">account_balance_wallet</i></a>
                @if(Auth::user()->jenis == 'Administrator')
                <a class="tooltipped green-text" data-position="bottom" data-tooltip="Uang Syariah {{ $s->s_nama }}" 
                  href="{{ url('santri/'.$s->s_nis.'/uang-syariah') }}"><i class="material-icons">payment</i></a>
                <a class="tooltipped green-text" data-position="bottom" data-tooltip="Daftar Kesalahan {{ $s->s_nama }}" 
                  href="{{ url('santri/'.$s->s_nis.'/kesalahan') }}"><i class="material-icons">error</i></a>
                @endif
                <a class="tooltipped green-text" data-position="bottom" data-tooltip="Hafalan Baru {{ $s->s_nama }}" 
                  href="{{ url('santri/'.$s->s_nis.'/hafalan-baru') }}"><i class="material-icons">fiber_new</i></a>
                <a class="tooltipped green-text" data-position="bottom" data-tooltip="Riwayat Muroja'ah {{ $s->s_nama }}" 
                  href="{{ url('santri/'.$s->s_nis.'/hafalan') }}"><i class="material-icons">book</i></a>
                @if(Auth::user()->jenis == 'Administrator')                
                <a class="tooltipped green-text" data-position="bottom" data-tooltip="Ubah Data {{ $s->s_nama }}" 
                  href="{{ url('santri/'.$s->s_nis.'/edit') }}"><i class="material-icons">edit</i></a>

                <a class="tooltipped right red-text" data-position="bottom" data-tooltip="Hapus Data {{ $s->s_nama }}" onClick="javascript: return confirm('Yakin ingin menghapus?');" 
                  href="{{ url('santri/'.$s->s_nis.'/hapus') }}"><i class="material-icons">delete</i></a>
                @endif
                @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {!! $Santri->links('template.paginator') !!}

  </div>
</div>
@endsection
@section("script")
<script type="text/javascript">
  $(function(){
    $('.showPassword').click(function(e){
      e.preventDefault();
      $(this).closest('td').find(".tampil").toggle();
      if ($(this).closest('td').find(".ic").text() == "visibility") {
        $(this).closest('td').find(".ic").text("visibility_off");
      } else {
        $(this).closest('td').find(".ic").text("visibility");
      }
    });
  });
</script>
@endsection