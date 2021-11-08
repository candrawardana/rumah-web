@extends('template.welcome')
@section('title')
Notifikasi
@endsection
@section('subtitle')
<li class="breadcrumb-item active">Notifikasi</li>
@endsection
@section('content')
@php
$i=0;
@endphp
@foreach(notifikasi(1)->list as $notifikasi)
<div class="
            @if($notifikasi->dilihat==0)
            bg-green
            @endif
">
          <div class="dropdown-divider"></div>
          <a href="{{ $notifikasi->notifikasi_related['link'] }}" target="_blank" class="dropdown-item">
            <i class="{{ $notifikasi->notifikasi_related['icon'] }} mr-2"></i> {{ $notifikasi->judul }}
            <span class="float-right text-muted text-sm">{{ $notifikasi->created_at }}</span>
          </a>
          <a class="tooltipped red-text" data-position="bottom" data-tooltip="Hapus Notifikasi?" onClick="javascript: return confirm('Yakin ingin menghapus?');" 
          href="{{ url('notifikasi?hapus='.$notifikasi->id) }}"><i class="material-icons">delete</i>
            Hapus Notifikasi
          </a>
</div>
@php
$i++;
@endphp
@endforeach
@if($i==0)
Tidak ada notifikasi
@endif
@endsection