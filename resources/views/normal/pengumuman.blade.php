@extends('template.welcome')
@section('title')
Pengumuman
@endsection
@section('subtitle')
<li class="breadcrumb-item active">Pengumuman</li>
@endsection
@section('content')
<div class="container">
  <div class="row">
    <div class="content-title">
      <a href="#" class="brand-logo grey-text text-darken-4 content-text">Daftar Pengumuman</a>
    </div>
  </div>
      @foreach($Pengumuman as $p)
        <div class="row">
      <div class="col s12">
        <div class="card">
          <div class="card-content">
            <span class="card-title"><strong>{{ $p->pg_judul }}</strong></span>
            <p>{{ $p->pg_desc }}</p>
          </div>
          <div class="card-action">
                        <div align="right"><i>{{ $p->pg_tanggal }}</i></div>
                      </div>
        </div>
      </div>
  </div>
  @endforeach
</div>
@endsection