@extends('template.welcome')
@section('title')
Berita
@endsection
@section('subtitle')
<li class="breadcrumb-item"><a href="{{ url('berita') }}">Berita</a></li>
<li class="breadcrumb-item active">{{ $Berita->title }}</li>
@endsection
@section('content')
<div class="container">
  <div class="row">
    <div class="content-title">
      <div class="brand-logo grey-text text-darken-4 content-text">{{ $Berita->title }}</div>
    </div>
  </div>

  <!-- DATA KEGIATAN -->
  <div class="row">
    <div class="col s12">
      <img class="materialboxed foto-kegiatan" src="{{ $Berita->thumbnail }}">
    </div>    
    <div class="col s12">
      <h6><i>{{ $Berita->tempat }}, {{ $Berita->tanggal }}</i></h6>
      <a href="{{ url('profil/'.$Berita->pembuat['id']) }}"><img src="{{ $Berita->pembuat['photo'] }}" class="pp-kecil">
        {{ $Berita->pembuat['name'] }} <b>({{ $Berita->pembuat['level'] }})</b>
      </a>
    </div>
    <div class="col s12">
      <p>{!! nl2br(e($Berita->content)) !!}</p>
    </div>
  </div>

  <!-- /DATA KEGIATAN -->
  </div>
@endsection