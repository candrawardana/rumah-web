
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
      @if(Auth::user())
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
