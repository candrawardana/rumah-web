@if(\Auth::user() && \Auth::user()->jenis == 'Administrator')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="{{ url('Assets/images/icon.png') }}?d=2" type="image/png">
  <title>@yield('title',judul_situs()) || {{ judul_situs() }}</title>
  <link href="https://fonts.googleapis.com/css?family=Julius+Sans+One" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!-- Google Font: Source Sans Pro -->
<!--   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
 -->  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ url('plugins/ionicons-2.0.1/css/ionicons.min.css') }}">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ url('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ url('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ url('plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('AdminLTE/css/adminlte.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ url('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ url('plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ url('plugins/summernote/summernote-bs4.min.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link href="{{ url('Assets/css/style.css') }}" rel="stylesheet">
  <style type="text/css">
    .logo-brand { padding-top: 15px; text-align: left; font-family: 'Julius Sans One', sans-serif; }
    .p1 { font-size: 18pt; }
    .p2 { font-size: 24pt; }
    .material-icons {display: inline-flex; vertical-align: top;}
    .kontak { padding-left: 6px; }
    .icon-block { padding: 0 15px; }
    .icon-block .material-icons { font-size: inherit; }
    .sec-one-header { font-family: 'Julius Sans One', sans-serif;}
    .hr-theme-slash-2 { display: flex; }
    .hr-line { width: 80%; position: relative; margin-bottom: 45px; border-bottom: 1px solid; }
    .hr-icon { position: relative; top: 3px; }
    .kop-logo { margin-top: 50px; margin-bottom: 50px; }
    .capl { margin-top: -70px;}
    .caps { margin-top: -30px;}
    .capm { margin-top: -40px; }
    .main-header nav, .main-sidebar nav, .main-header {
      height: initial !important;
      line-height: initial !important;
      background-color: initial;
      width: initial !important;
    }
    .content-title{
      width: 100%;
    }
    .custom-cw .container{
      width: 100% !important;
      margin: 0 !important;
      padding: 0 !important;
      max-width: 100% !important;
    }
    .nav-sidebar .nav-item a{
      height: 35px !important;
    }
    .pagination-cw ul {
      margin: 2em auto;
      padding-left: 0;
      list-style-type: none;
    }

    .pagination-cw .page-number {
      display: inline;
    }

    .pagination-cw .page-number {
      text-decoration: none;
      color: black !important;
    }

    /* Pagination 2 */
    .pagination-2 .page-number {
      padding: 8px 16px;
      background-color: #f3f4f2;
    }

    .pagination-2 .page-number:hover {
      background-color: #d9dcd6;
    }

    .pagination-2 .active {
      border-radius: 4px;
      background-color: #4CAF50;
    }

    .pagination-2 .active:hover {
      background-color: #4CAF50;
    }

    .pagination-2 .active a {
      color: #f3f4f2;
    }
    .pp-kecil {
      width: 25px;
      height: 25px;
      border-radius: 50%;
      object-fit: cover;
      vertical-align: middle;
      object-position: center right;
    }
    a, .hijau{
       color: #00a85a;
    }
  </style>
  @yield('style')
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ url('Assets/images/icon.jpeg') }}" alt="{{ judul_situs() }}" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-dark" style="background: #00a85a;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <span class="badge badge-warning navbar-badge"><small class="far fa-bell"></small> {{ notifikasi()->count }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">{{ notifikasi()->count }} Pemberitahuan</span>
          @foreach(notifikasi()->list as $notifikasi)
          <div class="dropdown-divider"></div>
          <a href="{{ $notifikasi->notifikasi_related['link'] }}" class="dropdown-item">
            <i class="{{ $notifikasi->notifikasi_related['icon'] }} mr-2"></i> {{ $notifikasi->judul }}
            <span class="float-right text-muted text-sm">{{ $notifikasi->created_at }}</span>
          </a>
          @endforeach
          <div class="dropdown-divider"></div>
          <a href="{{ url('notifikasi') }}" class="dropdown-item dropdown-footer">Lihat Semua Pemberitahuan</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('akun') }}" role="button">
          <i class="fa fa-cog"></i>
        </a>
      </li>
      <!-- Logout -->
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('logout') }}" class="nav-link bg-danger"><i class="fa fa-power-off"></i> Logout</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link" style="background: #00a85a;">
      <img src="{{ url('Assets/images/icon.jpeg') }}" alt="{{ judul_situs() }}" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{ judul_situs(1) }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ pp_check(\Auth::user()->id) }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ \Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ url('/') }}" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Beranda
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('notifikasi') }}" class="nav-link">
              <i class="nav-icon fas fa-bell"></i>
              <p>
                Notifikasi
                <span class="right badge badge-danger text-white">{{ notifikasi()->count }}</span>
              </p>
            </a>
          </li>
          <li class="nav-header">Umum</li>
          <li class="nav-item">
            <a href="{{ url('pengumuman') }}" class="nav-link">
              <i class="nav-icon fas fa-clock"></i>
              <p>
                Pengumuman
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('berita') }}" class="nav-link">
              <i class="nav-icon fas fa-globe"></i>
              <p>
                Berita
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('kegiatan') }}" class="nav-link">
              <i class="nav-icon fas fa-leaf"></i>
              <p>
                Kegiatan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('donasi') }}" class="nav-link">
              <i class="nav-icon fas fa-coins"></i>
              <p>
                Donasi
              </p>
            </a>
          </li>
          <li class="nav-header">Koperasi</li>
          <li class="nav-item">
            <a href="{{ url('pembayaran') }}" class="nav-link">
              <i class="nav-icon fas fa-coins"></i>
              <p>
                Pembayaran Anggota
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('pembelian') }}" class="nav-link">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Pembelian Koperasi
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('bagi-hasil') }}" class="nav-link">
              <i class="nav-icon fas fa-coins"></i>
              <p>
                Bagi Hasil
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('potongan-tabungan') }}" class="nav-link">
              <i class="nav-icon fas fa-cut"></i>
              <p>
                Potongan Tabungan
              </p>
            </a>
          </li>
          <li class="nav-header">Pengguna</li>
          <li class="nav-item">
            <a href="{{ url('pengguna/Administrator') }}" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Admin
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('pengguna/Ustadz') }}" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Ustadz
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('pengguna/wali') }}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Orang Tua / Wali
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('santri') }}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Santri
              </p>
            </a>
          </li>
          <li class="nav-header">Laporan</li>
          <li class="nav-item">
            <a href="{{ url('laporan/uang-syariah') }}" class="nav-link">
              <i class="nav-icon fas fa-print"></i>
              <p>
                Uang Syari'ah
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('laporan/tabungan') }}" class="nav-link">
              <i class="nav-icon fas fa-print"></i>
              <p>
                Tabungan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('laporan/hafalan') }}" class="nav-link">
              <i class="nav-icon fas fa-print"></i>
              <p>
                Murojaah
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('laporan/hafalan-baru') }}" class="nav-link">
              <i class="nav-icon fas fa-print"></i>
              <p>
                Hafalan
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col s12 m6">
            <h1 class="m-0 hijau"><b>@yield('title',"Beranda")</b></h1>
          </div><!-- /.col -->
          <div class="col s12 m6">
            <ol class="breadcrumb float-sm-right">
              @yield('subtitle')
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid custom-cw">
        @yield('content')
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; <a href="{{ url('/') }}">{{ judul_situs() }}</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Powered By</b> Bungkus Teknologi
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ url('plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ url('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ url('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ url('plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ url('plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ url('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ url('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ url('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ url('plugins/moment/moment.min.js') }}"></script>
<script src="{{ url('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ url('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ url('plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ url('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('AdminLTE/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ url('AdminLTE/js/demo.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
      //drawer
      var elems = document.querySelectorAll('.sidenav');
      var instances = M.Sidenav.init(elems, {draggable: true});
      //select 
      var kelas = document.querySelectorAll('select');
      var instances = M.FormSelect.init(kelas);
      var selectsantri = document.querySelectorAll('select');
      var instances = M.FormSelect.init(selectsantri, {isMultiple: true});
      //tabs
      var el = document.querySelectorAll('.tabs')
      var instance = M.Tabs.init(el);
      //modal
      var mdl = document.querySelectorAll('.modal');
      var instances = M.Modal.init(mdl);
      //dropdown
      var dr = document.querySelectorAll('.dropdown-trigger');
      var instances = M.Dropdown.init(dr, {coverTrigger: false});
      var dr = document.querySelectorAll('.nav-trigger');
      var instances = M.Dropdown.init(dr, {constrainWidth: false, coverTrigger: false, hover: false});
      // datepicker
      var dp = document.querySelectorAll('.datepicker');
      var instances = M.Datepicker.init(dp,{format:'dd-mm-yyyy', yearRange: 99, minDate:new Date(1900,01,01), maxDate: new Date(), defaultDate: new Date(), setDefaultDate: true});
      // collapsible
      var cl = document.querySelectorAll('.collapsible');
      var instances = M.Collapsible.init(cl);
      // tooltip
      var ttip = document.querySelectorAll('.tooltipped');
      var instances = M.Tooltip.init(ttip);
      //image
      var img = document.querySelectorAll('.materialboxed');
      var instances = M.Materialbox.init(img);
    });
    $(document).ready(function(){
    //$(".dropdown-trigger").dropdown();
    //$(".dropdown-trigger").dropdown();
  });
</script>
@yield("script")
</body>
</html>
@else
<!DOCTYPE html>
<html>
<head>
  <link rel="icon" href="{{ url('Assets/images/icon.png') }}?d=2" type="image/png">
<link href="https://fonts.googleapis.com/css?family=Julius+Sans+One" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link href="{{ url('Assets/css/style.css') }}" rel="stylesheet">
<!-- <link rel="stylesheet" type="text/css" href="../assets/style.css"> -->
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>@yield('title', judul_situs()) || {{ judul_situs() }}</title>
<style media="screen">
  .logo-brand { padding-top: 15px; text-align: left; font-family: 'Julius Sans One', sans-serif; }
  .p1 { font-size: 18pt; }
  .p2 { font-size: 24pt; }
  .material-icons {display: inline-flex; vertical-align: top;}
  .kontak { padding-left: 6px; }
  .icon-block { padding: 0 15px; }
  .icon-block .material-icons { font-size: inherit; }
  .sec-one-header { font-family: 'Julius Sans One', sans-serif;}
  .hr-theme-slash-2 { display: flex; }
  .hr-line { width: 80%; position: relative; margin-bottom: 45px; border-bottom: 1px solid; }
  .hr-icon { position: relative; top: 3px; }
  .kop-logo { margin-top: 50px; margin-bottom: 50px; }
  .capl { margin-top: -70px;}
  .caps { margin-top: -30px;}
  .capm { margin-top: -40px; }
.pagination-cw ul {
  margin: 2em auto;
  padding-left: 0;
  list-style-type: none;
}

.pagination-cw .page-number {
  display: inline;
}

.pagination-cw .page-number {
  text-decoration: none;
  color: black !important;
}

/* Pagination 2 */
.pagination-2 .page-number {
  padding: 8px 16px;
  background-color: #f3f4f2;
}

.pagination-2 .page-number:hover {
  background-color: #d9dcd6;
}

.pagination-2 .active {
  border-radius: 4px;
  background-color: #4CAF50;
}

.pagination-2 .active:hover {
  background-color: #4CAF50;
}

.pagination-2 .active a {
  color: #f3f4f2;
}
.pp-kecil {
  width: 25px;
  height: 25px;
  border-radius: 50%;
  object-fit: cover;
  vertical-align: middle;
  object-position: center right;
}
</style>
</head>
<body>
  <div class="container hide-on-med-and-down">
    <div class="row">
  <div class="col m2" align="right">
    <img src="{{ url('Assets/images/icon.jpeg') }}" alt="{{ judul_situs() }}" width="130px" style="margin-top: 20px;">
  </div>
  <div class="col m6">
    <p class="logo-brand">
      <span class="p1">{{ penempatan("NAMA_YAYASAN") }}</span>
      <br>
      <span class="p2">{{ judul_situs() }}</span>
    </p>
  </div>
  <div class="col m4 valign-wrapper">
    
  </div>
</div>
</div>
  
<nav class="green">
  <div class="nav-wrapper">
    <a href="{{ url('/') }}" class="brand-logo" style="padding-left: 20px">Darul Adib</a>
    <a href="#" data-target="drawernav" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    <ul id="nav-mobile" class="right hide-on-med-and-down">
      <li><a href="{{ url('/') }}"><i class="material-icons left">home</i>Dashboard</a></li>
      @if(\Auth::user())
      <li><a href="{{ url('santri') }}"><i class="material-icons left">person</i>Data Santri</a></li>
      <li><a href="{{ url('pengumuman') }}"><i class="material-icons left">notifications</i>Pengumuman</a></li>
      @endif
      <li><a href="{{ url('berita') }}"><i class="material-icons left">public</i>Berita</a></li>
      <li><a href="{{ url('kegiatan') }}"><i class="material-icons left">group</i>Kegiatan</a></li>
      <li><a href="{{ url('login') }}"><i class="material-icons left">lock</i>Login</a></li>
    </ul>
  </div>
</nav>
@yield("content")
  <footer class="page-footer green">
  <div class="container">
    <div class="row">
      <div class="col m7 s12">
        <h5 class="white-text">{{ judul_situs() }}</h5>
        <p class="grey-text text-lighten-4">{{ penempatan("QUOTES_FOOTER") }}</p>
      </div>
      <div class="col m5 s12">
        <h5 class="white-text">Contact</h5>
        <ul>
          <li>
            <i class="material-icons">location_on</i> <span class="kontak">{{ penempatan("ALAMAT_YAYASAN") }}</span>
          </li>
          <li>
            <i class="material-icons">phone</i> <span class="kontak">{{ penempatan("HP_YAYASAN") }}</span>
          </li>
          <li>
            <i class="material-icons">mail</i> <span class="kontak">{{ penempatan("EMAIL_YAYASAN") }}</span>
          </li>
          
        </ul>
      </div>
    </div>
  </div>
  <div class="footer-copyright">
    <div class="container">
    Copyright &copy; {{ date('Y') }} <a href="index.php" class="white-text">{{ judul_situs() }}</a> <a class="white-text right" href="{{ url('policy') }}">Ketentuan Penggunaan</a>
    </div>
  </div>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
      //drawer
      var elems = document.querySelectorAll('.sidenav');
      var instances = M.Sidenav.init(elems, {draggable: true});
      //select 
      var kelas = document.querySelectorAll('select');
      var instances = M.FormSelect.init(kelas);
      var selectsantri = document.querySelectorAll('select');
      var instances = M.FormSelect.init(selectsantri, {isMultiple: true});
      //tabs
      var el = document.querySelectorAll('.tabs')
      var instance = M.Tabs.init(el);
      //modal
      var mdl = document.querySelectorAll('.modal');
      var instances = M.Modal.init(mdl);
      //dropdown
      var dr = document.querySelectorAll('.dropdown-trigger');
      var instances = M.Dropdown.init(dr, {coverTrigger: false});
      var dr = document.querySelectorAll('.nav-trigger');
      var instances = M.Dropdown.init(dr, {constrainWidth: false, coverTrigger: false, hover: false});
      // datepicker
      var dp = document.querySelectorAll('.datepicker');
      var instances = M.Datepicker.init(dp,{format:'dd-mm-yyyy', yearRange: 99, minDate:new Date(1900,01,01), maxDate: new Date(), defaultDate: new Date(), setDefaultDate: true});
      // collapsible
      var cl = document.querySelectorAll('.collapsible');
      var instances = M.Collapsible.init(cl);
      // tooltip
      var ttip = document.querySelectorAll('.tooltipped');
      var instances = M.Tooltip.init(ttip);
      //image
      var img = document.querySelectorAll('.materialboxed');
      var instances = M.Materialbox.init(img);
    });
    $(document).ready(function(){
    //$(".dropdown-trigger").dropdown();
    //$(".dropdown-trigger").dropdown();
  });
</script>
@yield("script")
</body>
</html>
@endif