<!DOCTYPE html>
<html>
<head>
  <link rel="icon" href="{{ url('Assets/images/icon.png') }}?d=2" type="image/png">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css"  media="screen,projection"/>
  <link href="{{ url('Assets/css/style.css') }}" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>{{ judul_situs() }}</title>
  <script src="https://cdn.jsdelivr.net/npm/autonumeric@4.1.0"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
</head>
<body>
  <div class="container">
    <table border=0 align="center">
    <tr>
      <td style="text-align: right;">
        <img src="{{ url('Assets/images/icon.png') }}?d=2" width="120px">
      </td>
      <td style="text-align: center; padding: 0px; vertical-align: middle;">
        <p style="text-transform: uppercase;font-size: 20px;">{{ penempatan("NAMA_YAYASAN") }}
          <br />{{ judul_situs() }}</p>
          <p>{{ penempatan("ALAMAT_YAYASAN") }}
            <br />Telp: <u>{{ penempatan("HP_YAYASAN") }}</u> - Email: <u>{{ penempatan("EMAIL_YAYASAN") }}</u>
          </p>
        </td>
      </tr>
    </table>
  @yield("content")
  </div>
<div style="margin-top: 100px;"></div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  
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

<header></header>
<main></main>
<footer class="page-footer green">
  <div class="container">
    <div class="row"></div>
  </div>
<div class="footer-copyright center">
  <div class="container">
    &copy; {{ date('Y') }} {{ judul_situs() }} | <a href="{{ url('policy') }}">Ketentuan Penggunaan.</a>
  </div>
</div>
</footer>
</body>
</html>