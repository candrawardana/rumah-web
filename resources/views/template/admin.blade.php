@extends('template.header')
@section('css')
    <link rel="stylesheet" href="{{ url('Assets/css/admin.css') }}">
@endsection
@section('body')
    <style>
        a:hover{
            text-decoration: none;
        }
    </style>
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="content">
                <div class="header-dashboard">
                    <div class="app-title">OPA PE DATAKE</div>

                    <div class="account">
                        <div class="user-wrapper">
                            <div class="user-photo">
                                <img src="{{ pp_check(Auth::id()) }}">
                            </div>
                            <div class="wrap">
                                <div class="user-name">{{ Auth::user()->name }} <i class="fa fa-chevron-down"></i></div>
                                <div class="wrapper-dropdown">
                                    <a href="{{ url('logout') }}">
                                        <div class="drop-menu">
                                            <i class="fas fa-sign-out-alt"> </i>
                                            Log Out
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="body-dashboard">
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="wrapper-menu">
                                <div class="wrapper">
                                    <div class="wrapper-account" align="center">
                                        <div class="account-photo">
                                            <img src="{{ pp_check(Auth::id()) }}" alt="">
                                        </div>
                                        <div class="account-name">{{ Auth::user()->name }}</div>
                                        <div class="account-title">{{ Auth::user()->tipe }}</div>
                                    </div>
                                </div>

                                <a href="{{ url('home') }}">
                                    <div class="menu 
                                    @if(strpos(Request::url(),'home')!==false)
                                    active
                                    @endif
                                    ">Dashboard</div>
                                </a>
                                @if(Auth::user()->tipe == "Super Admin")
                                <a href="{{ url('user') }}">
                                    <div class="menu 
                                    @if(strpos(Request::url(),'user')!==false)
                                    active
                                    @endif
                                    ">User</div>
                                </a>
                                @else
                                <a href="{{ url('nodin') }}">
                                    <div class="menu 
                                    @if(strpos(Request::url(),'nodin')!==false)
                                    active
                                    @endif
                                    ">Nodin</div>
                                </a>
                                @endif
                                <a href="{{ url('rekap') }}">
                                    <div class="menu 
                                    @if(strpos(Request::url(),'rekap')!==false)
                                    active
                                    @endif
                                    ">Rekap Data</div>
                                </a>
                                <label for="ganti-pp2" style="margin:0">
                                <a>
                                    <div class="menu">Ganti Foto Profil</div>
                                </a>
                                </label>
                                <a href="{{ url('hapus-pp') }}">
                                    <div class="menu">Hapus Foto Profil</div>
                                </a>
                                <form style="display: none" id="formgantipp" action="{{ url('ganti-pp') }}" method="post" enctype="multipart/form-data">
                                    <input type="file" accept="image/*" class="form-control-file"
                                    name="pp" id="ganti-pp2" onchange="document.getElementById('formgantipp').submit()">
                                    @csrf
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <div class="wrapper-content-info">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Menu Untuk Mobile -->
    <div class="main-mobile">
        <div class="wrapper-mobile-menu">
            <a href="{{ url('home') }}">
            <div class="mobile-menu" align="center">
                <i class="fas fa-columns"></i>
                <div class="title-menu">Dashboard</div>
            </div>
            </a>
            @if(Auth::user()->tipe == "Super Admin")
            <a href="{{ url('user') }}">
            <div class="mobile-menu" align="center">
                <i class="fas fa-columns"></i>
                <div class="title-menu">User</div>
            </div>
            </a>
            @else
            <a href="{{ url('nodin') }}">
            <div class="mobile-menu" align="center">
                <i class="fas fa-columns"></i>
                <div class="title-menu">Nodin</div>
            </div>
            </a>
            @endif
            <a href="{{ url('rekap') }}">
            <div class="mobile-menu" align="center">
                <i class="fas fa-columns"></i>
                <div class="title-menu">Rekap Data</div>
            </div>
            </a>
        </div>
    </div>
    @yield('modal')
@endsection