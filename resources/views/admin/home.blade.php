@extends('template.welcome')
@section('title')
Masuk
@endsection
@section('subtitle')
              <li class="breadcrumb-item"><a href="#">Beranda</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
@endsection
@section('content')
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col s12 m6 l3">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $Koperasi }}</h3>

                <p>Pembelian Koperasi</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{ url('pembelian') }}" class="small-box-footer">Selengkapnya... <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col s12 m6 l3">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $Dana }}<sup style="font-size: 20px">Rp</sup></h3>

                <p>Seluruh Dana</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{ url('pembayaran') }}" class="small-box-footer">Selengkapnya... <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col s12 m6 l3">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>{{ $Santri }}</h3>

                <p>Santri</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{ url('santri') }}" class="small-box-footer">Selengkapnya... <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col s12 m6 l3">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $Donator }}</h3>

                <p>Donator</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">Selengkapnya... <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
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
                    <div class="card">
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
        <div class="section-one container">
          <div class="hr-theme-slash-2">
            <div class="hr-line"></div>
            <h4 class="header center green-text sec-one-header" style="margin-top: 30px;">
              Berita
            </h4>
            <div class="hr-line"></div>
          </div>

        <!-- Berita -->

          <div class="row">
            @foreach($Berita as $k)
                <div class="col s12 m4">
                    <div class="card">
                        <div class="card-image waves-effect waves-block waves-light"  style="height:200px">
                            <a href="{{ url('berita/'.$k->id) }}"><img class="img-kegiatan" src="{{ $k->thumbnail }}"></a>
                        </div>
                        <div class="card-content" style="height:150px">
                            <span class="card-title"><a href="{{ url('berita/'.$k->id) }}">{{ $k->title }}</a></span>
                            <p class="truncate">{{ $k->content }}</p>
                        </div>
                        <div class="card-action"  style="height:55px">
                            <small><i>{{ $k->tempat }}, {{ $k->tanggal }}</i></small>
                        </div>
                    </div>
                </div>
            @endforeach
          </div>
        </div>
        <div class="hr-theme-slash-2">
          <div class="hr-line"></div>
          <h4 class="header center green-text sec-one-header" style="margin-top: 30px;">
            Galeri Foto
          </h4>
          <div class="hr-line"></div>
        </div>

        <div class="row card">
          <form class="col s12" id="form-gallery-tambah" method="post" enctype="multipart/form-data" action="{{ url('tambah-gallery') }}">
            @csrf
            <label class="btn bg-green" for="gallery-tambah"><i class="fas fa-plus"></i> Tambah Galeri Foto</label>
            <input type="file" id="gallery-tambah" style="display:none" name="file" onchange="document.getElementById('form-gallery-tambah').submit()">
          </form>
          @foreach($Gallery as $k => $g)
          <div class="col s12 m6 l4">
            <img src="{{ $g }}" class="materialbox materialboxed responsive-img card">
            <a class="btn bg-red" href="{{ url('hapus-gallery/'.$k) }}"><i class="fas fa-trash"></i> Hapus Foto</a>
          </div>
          @endforeach
        </div>
        <!-- /.row (main row) -->
@endsection
@section("script")
<script type="text/javascript">

</script>
@endsection