@extends('template.welcome')
@section('content')

<ul class="sidenav" id="drawernav">
  <li class="kop-logo">
        <div class="user-view center">
            <a href="{{ url('/') }}">
        <center><img class="circle" src="{{ url('Assets/images/icon.jpeg') }}" style="width:200px; height:auto;"></center>
        <span class="green-text name">{{ penempatan("NAMA_YAYASAN") }}</span>
        <span class="green-text name">{{ judul_situs() }}</span>
      </a>
        </div>
    </li>
  <li>
    <div class="divider"></div>
  </li>
            <li><a href="{{ url('login') }}"><i class="material-icons left">lock</i>Login</a></li>
    </ul>
  <!-- large slider -->
<div class="slider">
    <ul class="slides">
      <li>
        <img src="{{ url('Assets/images/slide/1.jpg') }}"> <!-- random image -->
        <div class="caption capl center-align">
          <h3>Selamat datang</h3>
          <h5 class="light grey-text text-lighten-3">Website resmi {{ judul_situs() }}</h5>
        </div>
      </li>
      <li>
        <img src="{{ url('Assets/images/slide/2.jpg') }}"> <!-- random image -->
        <div class="caption capl left-align">
          <h3>Para Santri</h3>
          <h5 class="light grey-text text-lighten-3">{{ judul_situs() }}.</h5>
        </div>
      </li>
      <li>
        <img src="{{ url('Assets/images/slide/3.jpg') }}"> <!-- random image -->
        <div class="caption capl left-align">
          <h3>Keseharian Santri</h3>
          <h5 class="light grey-text text-lighten-3">{{ penempatan("MOTO_KESEHARIAN") }}</h5>
        </div>
      </li>
    </ul>
  </div>

  <div class="section no-pad-bot" id="index-banner" data-aos="zoom-in">
  <div class="container">
    <h1 class="header center green-text sec-one-header">{{ judul_situs() }}</h1>
    <div class="row center">
      <h5 class="header col s12 light">{{ penempatan("QUOTES_DEPAN") }}</h5>
    </div>
    <div class="row center">
      <a target="_blank" href="{{ penempatan('LINK_APK') }}""><img alt='Temukan di Google Play' src='https://play.google.com/intl/en_us/badges/images/generic/id_badge_web_generic.png' width="300px"/></a>
    </div>
    <br><br><br>
  </div>
</div>
  <div class="section-one container">
    <div class="hr-theme-slash-2">
  <div class="hr-line"></div>
  <h4 class="header center green-text sec-one-header" style="margin-top: 30px;">
    Kegiatan Santri
  </h4>
  <div class="hr-line"></div>
</div>

<!-- KEGIATAN -->

<div class="row">
    @foreach($Kegiatan as $k)
        <div class="col s12 m4">
            <div class="card" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="2000">
                <div class="card-image waves-effect waves-block waves-light"  style="height:200px">
                    <a href="{{ url('kegiatan/'.$k->kg_id) }}"><img class="img-kegiatan" src="{{ $k->kg_foto }}"></a>
                </div>
                <div class="card-content" style="height:150px">
                    <span class="card-title"><a href="{{ url('kegiatan/'.$k->kg_id) }}">{{ $k->kg_judul }}</a></span>
                    <p class="truncate">{{ $k->kg_desc }}</p>
                </div>
                <div class="card-action"  style="height:55px">
                    <small><i>{{ $k->kg_lokasi }}, {{ $k->kg_tanggal }}</i></small>
                </div>
            </div>
        </div>
    @endforeach
</div>
  </div>
  <div class="section-two">
    <div class="parallax-container">
  <div class="parallax"><img src="{{ url('Assets/images/round.jpg') }}"></div>
</div>
  </div>
  <div class="section-three">
    <div class="container">
    <div class="section">
      <div class="row">
        <div class="col s12">
          <div class="icon-block">
            <div data-aos="zoom-in" data-aos-duration="2000">
            <h2 class="center green-text"><i class="material-icons">local_library</i></h2>
            <h5 class="center">Visi Darul Adib</h5>
            </div>
            <div data-aos="fade-left" data-aos-duration="2000">
            <p class="light center">Terwujudnya generasi Qur'ani yang unggul dalam prestasi serta berakhlakul karimah dan bisa mengamalkan nilai-nilai Alqur'an.</p>
            </div>
          </div>
        </div>

        <div class="col s12">
          <div class="icon-block">
            <div data-aos="zoom-in" data-aos-duration="2000">
            <h2 class="center green-text"><i class="material-icons">flag</i></h2>
            <h5 class="center">Misi Darul Adib</h5>
            </div>
            <div data-aos="fade-right" data-aos-duration="2000">
            <p class="light center">Mengajarkan Al Qur'an sesuai tahapannya, menanamkan akhlakul karimah sesuai Al Qur'an dan Sunnah, mendidik dan mengajarkan ilmu pengetahuan secara komprehensif, serta mengembangkan potensi santri melalui program ekstrakurikuler.</p>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>
  </div>
  <div class="section-four">
    <div class="container ">
  <div class="hr-theme-slash-2">
    <div class="hr-line"></div>
    <h4 class="header center green-text sec-one-header" style="margin-top: 30px;">
      Galeri Foto
    </h4>
    <div class="hr-line"></div>
  </div>

  <div class="row card">
    @foreach($Gallery as $g)
    <div class="col s12 m6 l4">
      <img src="{{ $g }}" class="materialbox materialboxed responsive-img card">
    </div>
    @endforeach
  </div>

</div>
  </div>
@endsection
@section("script")
<script type="text/javascript">
    AOS.init();
    $(document).ready(function(){
      $('.slider').slider({ height: 500, interval: 4000 });
      $('.slider.sml').slider({ interval: 4000, height: 180 });
      $('.slider.med').slider({ interval: 4000, height: 250 });
      $('.parallax').parallax();
      $('.materialbox').materialbox();
      $('.sidenav').sidenav();
    });
</script>
@endsection