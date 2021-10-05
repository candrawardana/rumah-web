@extends('template.welcome')
@section('title')
Kegiatan
@endsection
@section('subtitle')
<li class="breadcrumb-item active">Kegiatan</li>
@endsection
@section('content')
<!-- FORM -->
<div class="container">
  <div class="row">
    <div class="content-title">
      <a href="#" class="brand-logo grey-text text-darken-4 content-text">Daftar Kegiatan Santri</a>
    </div>
  </div>
  <div class="row">
  <nav>
    <div class="nav-wrapper">
    <form>
      <div class="input-field green">
        <input id="search" type="search" name="q" placeholder="Cari Kegiatan" value="{{ $q }}">
        <label class="label-icon" for="search"><i class="material-icons">search</i></label>
      </div>
    </form>
    </div>
    </nav>
  </div>
  <div class="row">
    @foreach($Kegiatan as $k)
      <div class="col s12 m4">
      <div class="card medium">
        <div class="card-image waves-effect waves-block waves-light">
          <a href="{{ url('kegiatan/'.$k->kg_id) }}"><img class="img-kegiatan" src="{{ $k->kg_foto }}"></a>
        </div>
        <div class="card-content">
          <span class="card-title"><a href="{{ url('kegiatan/'.$k->kg_id) }}">{{ $k->kg_judul }}</a></span>
          <p>{{ $k->kg_desc }}</p>
        </div>
        <div class="card-action">
          <small><i>{{ $k->kg_lokasi }}, {{ $k->kg_tanggal }}</i></small>
          <span>
            <a class="tooltipped red-text" data-position="bottom" data-tooltip="Hapus &#34;{{ $k->kg_judul }}&#34;" onClick="javascript: return confirm('Yakin ingin menghapus?');" 
              href="{{ url('kegiatan/'.$k->kg_id.'/hapus') }}">
                          </a>
          </span>
          
        </div>
      </div>
    </div>
    @endforeach
    </div>
    {!! $Kegiatan->links('template.paginator') !!}
  </div>
<!-- /FORM TAMBAH SANTRI -->
@endsection