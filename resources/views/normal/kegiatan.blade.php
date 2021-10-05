@extends('template.welcome')
@section('title')
Kegiatan
@endsection
@section('subtitle')
<li class="breadcrumb-item"><a href="url('kegiatan')">Kegiatan</a></li>
<li class="breadcrumb-item active">{{ $Kegiatan->kg_judul }}</li>
@endsection
@section('content')
<div class="container">
  <div class="row">
    <div class="content-title">
      <div class="brand-logo grey-text text-darken-4 content-text">{{ $Kegiatan->kg_judul }}</div>
    </div>
  </div>

  <!-- DATA KEGIATAN -->
  <div class="row">
    <div class="col s12">
      <h6><i>{{ $Kegiatan->kg_lokasi }}, {{ $Kegiatan->kg_tanggal }}</i></h6>
    </div>
    <div class="col s12">
      <p>{{ $Kegiatan->kg_desc }}</p>
    </div>
  </div>
  <div class="row">
    @foreach($Kegiatan->kg_foto as $foto)
    <div class="col s12 m4">
      <img class="materialboxed foto-kegiatan" src="{{ $foto }}">
    </div>
    @endforeach
  </div>

  <!-- /DATA KEGIATAN -->
  </div>
@endsection