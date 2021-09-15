@extends('template.header')
@section('css')
    <link rel="stylesheet" href="{{ url('Assets/css/main.css?v2') }}">
@endsection
@section('body')
    <nav class="navbar navbar-expand-lg navbar-light custom-navbar">
        <a class="navbar-brand" href="{{ url('/') }}">OPA PE DATAKE</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item 
            @hasSection('title')
            @else 
            active
            @endif">
              <a class="nav-link" href="{{ url('/') }}">Beranda</a>
            </li>
            <li class="nav-item
            @hasSection('bantuan')
            active
            @endif">
              <a class="nav-link" href="{{ url('bantuan') }}">Bantuan</a>
            </li>
          </ul>
          
          <ul class="navbar-nav">
            <li class="nav-item">
                <a class="main-button" href="{{ url('login') }}">Masuk</a>
            </li>
          </ul>
        </div>
      </nav>

      <div class="hero">
        @yield('content')
      </div>
@endsection