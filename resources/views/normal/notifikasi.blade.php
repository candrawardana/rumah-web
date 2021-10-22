@extends('template.welcome')
@section('title')
Notifikasi
@endsection
@section('subtitle')
<li class="breadcrumb-item active">Notifikasi</li>
@endsection
@section('content')
@foreach(notifikasi(1)->list as $notifikasi)
          <div class="dropdown-divider"></div>
          <a href="{{ $notifikasi->notifikasi_related['link'] }}" class="dropdown-item">
            <i class="{{ $notifikasi->notifikasi_related['icon'] }} mr-2"></i> {{ $notifikasi->judul }}
            <span class="float-right text-muted text-sm">{{ $notifikasi->created_at }}</span>
          </a>
@endforeach
@endsection