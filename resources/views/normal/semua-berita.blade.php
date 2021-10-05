@extends('template.welcome')
@section('title')
Berita
@endsection
@section('subtitle')
<li class="breadcrumb-item active">Berita</li>
@endsection
@section('content')
<!-- FORM -->
<div class="container">
  <div class="row">
    <div class="content-title">
      <a href="#" class="brand-logo grey-text text-darken-4 content-text">Daftar Berita</a>
    </div>
  </div>
  <div class="row">
  <nav>
    <div class="nav-wrapper">
    <form>
      <div class="input-field green">
        <input id="search" type="search" name="q" placeholder="Cari Berita" value="{{ $q }}">
        <label class="label-icon" for="search"><i class="material-icons">search</i></label>
      </div>
    </form>
    </div>
    </nav>
  </div>
  <div class="row">
    @foreach($Berita as $k)
      <div class="col s12 m4">
      <div class="card medium">
        <div class="card-image waves-effect waves-block waves-light">
          <a href="{{ url('berita/'.$k->id) }}"><img class="img-kegiatan" src="{{ $k->thumbnail }}"></a>
        </div>
        <div class="card-content">
          <span class="card-title"><a href="{{ url('berita/'.$k->id) }}">{{ $k->title }}</a></span>
          <p>{{ $k->content }}</p>
        </div>
        <div class="card-action">
          <small><i>{{ $k->tempat }}, {{ $k->tanggal }}</i></small>
          <span>
            <a class="tooltipped red-text" data-position="bottom" data-tooltip="Hapus &#34;{{ $k->title }}&#34;" onClick="javascript: return confirm('Yakin ingin menghapus?');" 
              href="{{ url('berita/'.$k->id.'/hapus') }}">
                          </a>
          </span>
          
        </div>
      </div>
    </div>
    @endforeach
    </div>
    {!! $Berita->links('template.paginator') !!}
  </div>
<!-- /FORM TAMBAH SANTRI -->
@endsection