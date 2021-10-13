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
  @if(\Auth::user() && \Auth::user()->jenis == 'Administrator')
  <!-- FORM TAMBAH KEGIATAN -->
  <div class="row">
    <div class="col s12">
      <ul class="collapsible">
        <li>
          <div class="collapsible-header green-text">
            <i class="material-icons">add</i> <strong>Tambah Berita</strong>
          </div>
          <div class="collapsible-body">
            <form action="{{ url('tambah-berita') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <!-- input -->
              <!-- tanggal -->
              <div class="input-field">
                <input name="tanggal" id="tanggal" type="text" class="datepicker">
                <label for="tanggal">Tanggal Berita</label>
              </div>
              <!-- judul -->
              <div class="input-field">
                <input name="title" id="title" type="text" class="validate">
                <label for="title">Judul Berita</label>
              </div>
              <!-- lokasi -->
              <div class="input-field">
                <input name="tempat" id="tempat" type="text" class="validate">
                <label for="tempat">Lokasi Berita</label>
              </div>
              <!-- deskripsi -->
              <div class="input-field">
                <textarea name="content" id="content" class="materialize-textarea"></textarea>
                <label for="content">Deskripsi Berita</label>
              </div>
              <!-- foto -->
              <div class="input-field">
                <div class = "file-field input-field">
                  <div class = "btn green">
                    <span>Browse</span>
                    <input type = "file"  name="thumbnail" />
                  </div>
                  <div class = "file-path-wrapper">
                    <input class = "file-path validate" type = "text"
                    placeholder = "Pilih Foto Berita" />
                  </div>
                </div>
              </div>
              <!-- /input -->
              <div align="right">
                <button class="btn green waves-effect waves-light" type="submit" name="submit">Proses <i class="material-icons right">send</i>
                </button>
              </div>
            </form>
          </div>
        </li>
      </ul>
    </div>
  </div>
  <!-- /FORM TAMBAH KEGIATAN -->
  @endif
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
           @if(\Auth::user() && \Auth::user()->jenis == 'Administrator')
          <span>
              <a class="tooltipped red-text" data-position="bottom" data-tooltip="Hapus &#34;{{ $k->title }}&#34;" onClick="javascript: return confirm('Yakin ingin menghapus?');" href="{{ url('hapus-berita/'.$k->id) }}">
               <i class="material-icons red-text right">delete</i> 
            </a>
          </span>
          @endif
        </div>
      </div>
    </div>
    @endforeach
    </div>
    {!! $Berita->links('template.paginator') !!}
  </div>
<!-- /FORM TAMBAH SANTRI -->
@endsection