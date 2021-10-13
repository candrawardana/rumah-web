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
  @if(\Auth::user() && \Auth::user()->jenis == 'Administrator')
  <!-- FORM TAMBAH KEGIATAN -->
  <div class="row">
    <div class="col s12">
      <ul class="collapsible">
        <li>
          <div class="collapsible-header green-text">
            <i class="material-icons">add</i> <strong>Tambah Daftar Kegiatan</strong>
          </div>
          <div class="collapsible-body">
            <form action="{{ url('tambah-kegiatan') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <!-- input -->
              <!-- tanggal -->
              <div class="input-field">
                <input name="kg_tanggal" id="kg_tanggal" type="text" class="datepicker">
                <label for="kg_tanggal">Tanggal Kegiatan</label>
              </div>
              <!-- judul -->
              <div class="input-field">
                <input name="kg_judul" id="kg_judul" type="text" class="validate">
                <label for="kg_judul">Judul Kegiatan</label>
              </div>
              <!-- lokasi -->
              <div class="input-field">
                <input name="kg_lokasi" id="kg_lokasi" type="text" class="validate">
                <label for="kg_lokasi">Lokasi Kegiatan</label>
              </div>
              <!-- deskripsi -->
              <div class="input-field">
                <textarea name="kg_desc" id="kg_desc" class="materialize-textarea"></textarea>
                <label for="kg_desc">Deskripsi Kegiatan</label>
              </div>
              <!-- foto -->
              <div class="input-field">
                <div class = "file-field input-field">
                  <div class = "btn green">
                    <span>Browse</span>
                    <input type = "file"  name="kg_foto[]" multiple />
                  </div>
                  <div class = "file-path-wrapper">
                    <input class = "file-path validate" type = "text"
                    placeholder = "Pilih Foto Kegiatan" />
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
          @if(\Auth::user() && \Auth::user()->jenis == 'Administrator')
          <span>
              <a class="tooltipped red-text" data-position="bottom" data-tooltip="Hapus &#34;{{ $k->kg_judul }}&#34;" onClick="javascript: return confirm('Yakin ingin menghapus?');" href="{{ url('hapus-kegiatan/'.$k->kg_id) }}">
               <i class="material-icons red-text right">delete</i> 
            </a>
          </span>
          @endif
        </div>
      </div>
    </div>
    @endforeach
    </div>
    {!! $Kegiatan->links('template.paginator') !!}
  </div>
<!-- /FORM TAMBAH SANTRI -->
@endsection