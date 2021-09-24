@extends('template.welcome')
@section('title')
Pengumuman
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
@section("script")
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
@endsection