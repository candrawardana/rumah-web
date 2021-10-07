@extends('template.welcome')
@section('title')
Pengumuman
@endsection
@section('subtitle')
<li class="breadcrumb-item active">Pengumuman</li>
@endsection
@section('content')
<div class="container">
  <div class="row">
    <div class="content-title">
      <a href="#" class="brand-logo grey-text text-darken-4 content-text">Daftar Pengumuman</a>
    </div>
    @if(\Auth::user() && \Auth::user()->jenis == 'Administrator')
    <div class="col s12">
      <ul class="collapsible">
        <li id="form-edit-li">
          <div class="collapsible-header green-text">
            <i class="material-icons">add</i> <strong id="form-edit-title">Tambah Pengumuman</strong>
          </div>
          <div class="collapsible-body" id="form-edit">
            <!-- FORM PENGUMUMAN -->
            <form action="{{ url('tambah-pengumuman') }}" method="POST">
              @csrf
              <input name="pg_id" id="pg_id" type="hidden">
              <div class="input-field">
                <input name="pg_tanggal" id="pg_tanggal" type="text" class="datepicker">
                <label for="pg_tanggal">Tanggal</label>
              </div>
              <div class="input-field">
                <input name="pg_judul" id="pg_judul" type="text" class="validate">
                <label for="pg_judul">Judul Pengumuman</label>
              </div>
              <div class="input-field">
                <textarea name="pg_desc" id="pg_desc" class="materialize-textarea"></textarea>
                <label for="pg_desc">Keterangan Pengumuman</label>
              </div>
              <div align="right">
                <a class="btn red waves-effect waves-light" id="batalkan" onclick="batal()" style="display: none;">Batalkan
                  <i class="material-icons right">close</i>
                </a>
                <button class="btn green waves-effect waves-light" type="submit" name="submit">Simpan
                  <i class="material-icons right">send</i>
                </button>
              </div>
            </form>
            <!-- /FORM PENGUMUMAN -->
          </div>
        </li>
      </ul>
    </div>
    @endif
  </div>
      @foreach($Pengumuman as $p)
  <div class="row">
    <div class="col s12">
      <div class="card">
        <div class="card-content">
          <span class="card-title"><strong id="pg_judul_{{ $p->pg_id }}">{{ $p->pg_judul }}</strong></span>
          <p id="pg_desc_{{ $p->pg_id }}">{{ $p->pg_desc }}</p>
        </div>
        <div class="card-action">
          @if(\Auth::user() && \Auth::user()->jenis == 'Administrator')
          <span>
            <a onclick='edit("{{ $p->pg_id }}")'>Edit</a>
            <a onClick="javascript: return confirm('Yakin ingin menghapus?');" href="{{ url('hapus-pengumuman/'.$p->pg_id) }}">Hapus</a>
          </span>
          @endif
          <div align="right"><i id="pg_tanggal_{{ $p->pg_id }}">{{ $p->pg_tanggal }}</i></div>
        </div>
      </div>
    </div>
  </div>
  @endforeach
</div>
@endsection
@section("script")
@if(\Auth::user() && \Auth::user()->jenis == 'Administrator')
<script type="text/javascript">
  function edit(id){
    $('#pg_id').val(id);
    $('#pg_judul').val( $('#pg_judul_' + id).html() );
    $('#pg_tanggal').val( $('#pg_tanggal_' + id).html() );
    $('#pg_desc').html( $('#pg_desc_' + id).html() );
    $('#form-edit').css('display','block');
    $('#form-edit-li').addClass("active");
    $('#batalkan').css('display','');
    $('#form-edit-title').html("Edit Pengumuman");
  }
  function batal(){
    $('#pg_id').val("");
    $('#pg_judul').val("");
    $('#pg_tanggal').val("");
    $('#pg_desc').html("");
    $('#form-edit').css('display','');
    $('#form-edit-li').removeClass("active");
    $('#batalkan').css('display','none');
    $('#form-edit-title').html("Tambah Pengumuman");
  }
</script>
@endif
@endsection