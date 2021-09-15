@extends('template.header')
@section('css')
    <link rel="stylesheet" href="{{ url('Assets/css/main.css') }}">
@endsection
@section('title')
Masuk - OPA PE DATAKE
@endsection
@section('body')
    <div class="login-page">
            <div class="left-content">
                <div class="overlay-page"></div>
                <div class="login" align="center">
                    <div class="main-wrap-logo">
                        <div class="logo-wrapper">
                            <img src="{{ url('Assets/images/icon.jpeg') }}">
                        </div>
                    </div>

                    <div class="title">Rumah Tahfiz Darul Adib</div>

                    <div class="desc">Lorem Ipsum Dolor Sit Amet.</div>
                    @if(session('errors'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Terjadi Kesalahan :
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    @if (Session::has('error'))
                        <div class="alert alert-danger">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    <div class="form-wrapper" style="text-align: start;">
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="email" class="label-form">User/Pengguna</label>
                                <input type="text" class="input-form" name="email" autofocus required placeholder="Nama Akun / Email">
                            </div>

                            <div class="form-group">
                                <label for="password" class="label-form">Password</label>
                                <input type="password" class="input-form" name="password" required placeholder="********">
                            </div>

                            <div class="flex-no-wrap">
                                <div class="form-group form-check" style="font-size: 13px;">
                                    <input type="checkbox" class="form-check-input" id="rememberMe">
                                    <label class="form-check-label" for="rememberMe">Ingat saya</label>
                                </div>

                                <div class="wrap-forgot">
                                    <a href="{{ url('lupa') }}">
                                        <div class="forgot">Lupa Password?</div>
                                    </a>
                                </div>
                            </div>

                            <button type="submit" class="button-submit">Masuk</button>
                        </form>
                    </div>

                    <div class="copyright" id="year"></div>
                </div>
            </div>
    </div>

@endsection
