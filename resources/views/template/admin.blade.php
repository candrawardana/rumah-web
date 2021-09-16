<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title',judul_situs()) || {{ judul_situs() }}</title>

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
  <link rel="stylesheet" href="{{ url('AdminLTE/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ url('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ url('plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ url('plugins/summernote/summernote-bs4.min.css') }}">
  <style type="text/css">
    a{
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
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
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
          <img src="{{ pp_check(Auth::user()->id) }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Beranda
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fas fa-bell"></i>
              <p>
                Notifikasi
                <span class="right badge badge-danger">8</span>
              </p>
            </a>
          </li>
          <li class="nav-header">Koperasi</li>
          <li class="nav-item">
            <a href="pages/kanban.html" class="nav-link">
              <i class="nav-icon fas fa-coins"></i>
              <p>
                Pembayaran Anggota
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/kanban.html" class="nav-link">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Pembelian Koperasi
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/kanban.html" class="nav-link">
              <i class="nav-icon fas fa-coins"></i>
              <p>
                Bagi Hasil
              </p>
            </a>
          </li>
          <li class="nav-header">Pengguna</li>
          <li class="nav-item">
            <a href="pages/kanban.html" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Admin
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/kanban.html" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Tahfidz
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/kanban.html" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Orang Tua / Wali
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/kanban.html" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Semua Pengguna
              </p>
            </a>
          </li>
          <li class="nav-header">Server</li>
          <li class="nav-item">
            <a href="pages/kanban.html" class="nav-link">
              <i class="nav-icon fas fa-clock"></i>
              <p>
                Jadwal
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/kanban.html" class="nav-link">
              <i class="nav-icon fas fa-globe"></i>
              <p>
                Berita
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/kanban.html" class="nav-link">
              <i class="nav-icon fas fa-coins"></i>
              <p>
                Donasi
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
          <div class="col-sm-6">
            <h1 class="m-0">@yield('title',"Beranda")</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
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
      <div class="container-fluid">
        @yield('content')
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; <a href="{{ url('/') }}">judul_situs</a>.</strong>
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
@yield('script')
</body>
</html>
