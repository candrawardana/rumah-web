@extends('template.welcome')
@section('title')
Edit Santri
@endsection
@section('subtitle')
<li class="breadcrumb-item"><a href="{{ url('santri') }}">Santri</a></li>
<li class="breadcrumb-item"><a href="{{ url('santri/'.$Santri->s_nis) }}">{{ $Santri->s_nama }}</a></li>
<li class="breadcrumb-item active">Edit Santri</li>
@endsection
@section('content')
<!-- SANTRI_CONTENT -->

<div class="row">
  <div class="col s12">
    <form name="frmtambahsantri" action="{{ url('tambah-santri') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <input type=hidden name=ubah value=1>
      <!-- Accordion -->
      <ul class="collapsible">
        <li class="active">
          <div class="collapsible-header green-text"><i class="material-icons">person</i> <strong>Data Santri</strong></div>
          <!-- Input Data Santri -->
          <div class="collapsible-body">
            <!-- no induk -->
            <div class="row">
              <div class="col s12 m5">
                <div class="col s12">
                  <img class="materialboxed" width="100%" src="{{ $Santri->s_foto }}">
                </div>
                <!-- foto -->
                <div class="input-field col s12">
                  <div class = "file-field input-field">
                    <div class = "btn green">
                      <span>Pilih Foto</span>
                      <input type = "file"  name="s_foto" />
                    </div>
                    <div class = "file-path-wrapper">
                      <input class = "file-path validate" type = "text"
                      placeholder = "Ganti Foto Santri" />
                    </div>
                  </div>
                  <!-- foto lama -->
                  <input type="hidden" name="oldfoto" value="{{ $Santri->s_foto }}">
                </div>
              </div>
              <div class="col s12 m7">
                <div class="input-field inline col m6 s12">
                  <input name="s_nis" id="s_nis" type="text" value="{{ $Santri->s_nis }}" class="validate" readonly>
                  <label for="s_nis">Nomor Induk Santri</label>
                </div>
                <div class="input-field inline col m6 s12">
                  <input name="s_reg" id="s_reg" type="text" value="{{ $Santri->s_reg }}" class="datepicker">
                  <label for="s_reg">Tanggal Registrasi</label>
                </div>
                <!-- nama -->
                <div class="input-field col s12">
                  <input name="s_nama" id="s_nama" type="text" value="{{ $Santri->s_nama }}" class="validate">
                  <label for="s_nama">Nama Lengkap</label>
                </div>
                <!-- password -->
                <div class="input-field inline col m6 s12">
                  <input name="s_password" id="s_password" type="password" class="validate">
                  <label for="s_password">Password Baru</label>
                </div>
                <!-- panggilan -->
                <div class="input-field inline col m6 s12">
                  <input name="s_panggilan" id="s_panggilan" type="text" value="{{ $Santri->s_panggilan }}" class="validate">
                  <label for="s_panggilan">Nama Panggilan</label>
                </div>
                <!-- tempat lahir -->
                <div class="input-field inline col m6 s12">
                  <input name="s_tmplahir" id="s_tmplahir" value="{{ $Santri->s_tmplahir }}" type="text" class="validate">
                  <label for="s_tmplahir">Tempat Lahir</label>
                </div>
                <!-- tanggal lahir -->
                <div class="input-field inline col m6 s12">
                  <input name="s_tgllahir" id="s_tgllahir" value="{{ $Santri->s_tgllahir }}" type="text" class="datepicker">
                  <label for="s_tgllahir">Tanggal Lahir</label>
                </div>
                <!-- saudara -->
                <div class="input-field inline col s12 m6">
                  <input name="s_anakke" id="s_anakke" type="number" value="{{ $Santri->s_anakke }}" class="validate" min="0">
                  <label for="s_anakke">Anak ke</label>
                </div>
                <div class="input-field inline col s12 m6">
                  <input name="s_jlhsaudara" id="s_jlhsaudara" type="number" value="{{ $Santri->s_jlhsaudara }}" class="validate" min="0">
                  <label for="s_jlhsaudara">Jumlah Saudara</label>
                </div>
              </div>
              <div class="col s12">
                <!-- alamat lengkap -->
                <div class="input-field col s12">
                  <textarea name="s_alamat" id="s_alamat" class="materialize-textarea">{{ $Santri->s_alamat }}</textarea>
                  <label for="s_alamat">Alamat Lengkap</label>
                </div>
                <!-- asal sekolah -->
                <div class="input-field col s12">
                  <input type="text" name="s_aslskolah" id="s_aslskolah" value="{{ $Santri->s_aslskolah }}" class="validate">
                  <label for="s_aslskolah">Asal Sekolah</label>
                </div>
                <!-- prestasi -->
                <div class="input-field col s12">
                  <input type="text" name="s_prestasi" id="s_prestasi" value="{{ $Santri->s_prestasi }}" class="validate">
                  <label for="s_prestasi">Prestasi yang Pernah Diraih</label>
                </div>
                <!-- hobi -->
                <div class="input-field col s12">
                  <input type="text" name="s_hobi" id="s_hobi" value="{{ $Santri->s_hobi }}" class="validate">
                  <label for="s_hobi">Hobi</label>
                </div>
                <!-- cita-cita -->
                <div class="input-field col s12">
                  <input type="text" name="s_cita" id="s_cita" value="{{ $Santri->s_cita }}" class="validate">
                  <label for="s_cita">Cita-cita</label>
                </div>
              </div>
            </div>
            <!-- /Input Data Santri -->
          </li>
          <li>
            <div class="collapsible-header green-text"><i class="material-icons">people</i> <strong>Data Ayah</strong></div>
            <!-- Input Data Ayah -->
            <div class="collapsible-body">
              <div class="row">
                <!-- nama ayah -->
                <div class="input-field col s12">
                  <input type="text" name="a_nama" id="a_nama" value="{{ $Ayah->i_nama }}" class="validate">
                  <label for="a_nama">Nama Ayah</label>
                </div>
                <!-- tempat lahir ayah -->
                <div class="input-field inline col s12 m6">
                  <input type="text" name="a_tmplahir" id="a_tmplahir" value="{{ $Ayah->i_tmplahir }}" class="validate">
                  <label for="a_tmplahir">Tempat Lahir Ayah</label>
                </div>
                <!-- tgl lahir ayah -->
                <div class="input-field inline col m6 s12">
                  <input name="a_tgllahir" id="a_tgllahir" type="text" value="{{ $Ayah->i_tgllahir }}" class="datepicker validate">
                  <label for="a_tgllahir">Tanggal Lahir Ayah</label>
                </div>
                <!-- pendidikan terakhir ayah -->
                <div class="input-field inline col s12 m6">
                  <select name="a_pendidikan" id="a_pendidikan">
                    <?php
                    if ($Ayah->i_pendidikan == 'Sekolah Dasar'){
                      echo '<option value="Sekolah Dasar" selected>Sekolah Dasar</option>';
                      echo '<option value="Sekolah Menengah Pertama">Sekolah Menengah Pertama</option>';
                      echo '<option value="Sekolah Menengah Atas">Sekolah Menengah Atas</option>';
                      echo '<option value="Sarjana">Sarjana</option>';
                      echo '<option value="Magister">Magister</option>';
                      echo '<option value="Doktoral">Doktoral</option>';
                    } else if ($Ayah->i_pendidikan == 'Sekolah Menengah Pertama'){
                      echo '<option value="Sekolah Dasar">Sekolah Dasar</option>';
                      echo '<option value="Sekolah Menengah Pertama" selected>Sekolah Menengah Pertama</option>';
                      echo '<option value="Sekolah Menengah Atas">Sekolah Menengah Atas</option>';
                      echo '<option value="Sarjana">Sarjana</option>';
                      echo '<option value="Magister">Magister</option>';
                      echo '<option value="Doktoral">Doktoral</option>';
                    } else if ($Ayah->i_pendidikan == 'Sekolah Menengah Atas'){
                      echo '<option value="Sekolah Dasar">Sekolah Dasar</option>';
                      echo '<option value="Sekolah Menengah Pertama">Sekolah Menengah Pertama</option>';
                      echo '<option value="Sekolah Menengah Atas" selected>Sekolah Menengah Atas</option>';
                      echo '<option value="Sarjana">Sarjana</option>';
                      echo '<option value="Magister">Magister</option>';
                      echo '<option value="Doktoral">Doktoral</option>';
                    } else if ($Ayah->i_pendidikan == 'Sarjana'){
                      echo '<option value="Sekolah Dasar">Sekolah Dasar</option>';
                      echo '<option value="Sekolah Menengah Pertama">Sekolah Menengah Pertama</option>';
                      echo '<option value="Sekolah Menengah Atas">Sekolah Menengah Atas</option>';
                      echo '<option value="Sarjana" selected>Sarjana</option>';
                      echo '<option value="Magister">Magister</option>';
                      echo '<option value="Doktoral">Doktoral</option>';
                    } else if ($Ayah->i_pendidikan == 'Magister'){
                      echo '<option value="Sekolah Dasar">Sekolah Dasar</option>';
                      echo '<option value="Sekolah Menengah Pertama">Sekolah Menengah Pertama</option>';
                      echo '<option value="Sekolah Menengah Atas">Sekolah Menengah Atas</option>';
                      echo '<option value="Sarjana">Sarjana</option>';
                      echo '<option value="Magister" selected>Magister</option>';
                      echo '<option value="Doktoral">Doktoral</option>';
                    } else {
                      echo '<option value="Sekolah Dasar">Sekolah Dasar</option>';
                      echo '<option value="Sekolah Menengah Pertama">Sekolah Menengah Pertama</option>';
                      echo '<option value="Sekolah Menengah Atas">Sekolah Menengah Atas</option>';
                      echo '<option value="Sarjana">Sarjana</option>';
                      echo '<option value="Magister">Magister</option>';
                      echo '<option value="Doktoral" selected>Doktoral</option>';
                    }
                    ?>
                  </select>
                  <label for="a_pendidikan">Pendidikan Terakhir Ayah</label>
                </div>
                <!-- pekerjaan ayah -->
                <div class="input-field inline col s12 m6">
                  <input type="text" name="a_pekerjaan" id="a_pekerjaan" value="{{ $Ayah->i_pekerjaan }}" class="validate">
                  <label for="a_pekerjaan">Pekerjaan Ayah</label>
                </div>
                <!-- alamat ayah -->
                <div class="input-field col s12">
                  <textarea name="a_alamat" id="a_alamat" class="materialize-textarea">{{ $Ayah->i_alamat }}</textarea>
                  <label for="a_alamat">Alamat Ayah</label>
                </div>
                <!-- telp ayah -->
                <div class="input-field inline col s12 m6">
                  <input name="a_telp" id="a_telp" value="{{ $Ayah->i_telp }}" type="tel" class="validate">
                  <label for="a_telp">No. Telepon (HP)</label>
                </div>
                <!-- wa ayah -->
                <div class="input-field inline col s12 m6">
                  <input name="a_wa" id="a_wa" value="{{ $Ayah->i_wa }}" type="tel" class="validate">
                  <label for="a_wa">No. Whatsapp</label>
                </div>
              </div>
            </div>
            <!-- /Input Data Ayah -->
          </li>
          <li>
            <div class="collapsible-header green-text"><i class="material-icons">people_outline</i> <strong>Data Ibu</strong></div>
            <!-- Data Ibu -->
            <div class="collapsible-body">
              <div class="row">
                <!-- nama ibu -->
                <div class="input-field col s12">
                  <input type="text" name="i_nama" id="i_nama" value="{{ $Ibu->i_nama }}" class="validate">
                  <label for="i_nama">Nama Ibu</label>
                </div>
                <!-- tempat lahir ibu -->
                <div class="input-field inline col s12 m6">
                  <input type="text" name="i_tmplahir" id="i_tmplahir" value="{{ $Ibu->i_tmplahir }}" class="validate">
                  <label for="i_tmplahir">Tempat Lahir Ibu</label>
                </div>
                <!-- tgl lahir ibu -->
                <div class="input-field inline col s12 m6">
                  <input type="text" name="i_tgllahir" id="i_tgllahir" value="{{ $Ibu->i_tgllahir }}" class="datepicker validate">
                  <label for="i_tgllahir">Tanggal Lahir Ibu</label>
                </div>
                <!-- pendidikan terakhir ibu -->
                <div class="input-field inline col s12 m6">
                  <select name="i_pendidikan" id="i_pendidikan">
                    <?php
                    if ($Ibu->i_pendidikan == 'Sekolah Dasar'){
                      echo '<option value="Sekolah Dasar" selected>Sekolah Dasar</option>';
                      echo '<option value="Sekolah Menengah Pertama">Sekolah Menengah Pertama</option>';
                      echo '<option value="Sekolah Menengah Atas">Sekolah Menengah Atas</option>';
                      echo '<option value="Sarjana">Sarjana</option>';
                      echo '<option value="Magister">Magister</option>';
                      echo '<option value="Doktoral">Doktoral</option>';
                    } else if ($Ibu->i_pendidikan == 'Sekolah Menengah Pertama'){
                      echo '<option value="Sekolah Dasar">Sekolah Dasar</option>';
                      echo '<option value="Sekolah Menengah Pertama" selected>Sekolah Menengah Pertama</option>';
                      echo '<option value="Sekolah Menengah Atas">Sekolah Menengah Atas</option>';
                      echo '<option value="Sarjana">Sarjana</option>';
                      echo '<option value="Magister">Magister</option>';
                      echo '<option value="Doktoral">Doktoral</option>';
                    } else if ($Ibu->i_pendidikan == 'Sekolah Menengah Atas'){
                      echo '<option value="Sekolah Dasar">Sekolah Dasar</option>';
                      echo '<option value="Sekolah Menengah Pertama">Sekolah Menengah Pertama</option>';
                      echo '<option value="Sekolah Menengah Atas" selected>Sekolah Menengah Atas</option>';
                      echo '<option value="Sarjana">Sarjana</option>';
                      echo '<option value="Magister">Magister</option>';
                      echo '<option value="Doktoral">Doktoral</option>';
                    } else if ($Ibu->i_pendidikan == 'Sarjana'){
                      echo '<option value="Sekolah Dasar">Sekolah Dasar</option>';
                      echo '<option value="Sekolah Menengah Pertama">Sekolah Menengah Pertama</option>';
                      echo '<option value="Sekolah Menengah Atas">Sekolah Menengah Atas</option>';
                      echo '<option value="Sarjana" selected>Sarjana</option>';
                      echo '<option value="Magister">Magister</option>';
                      echo '<option value="Doktoral">Doktoral</option>';
                    } else if ($Ibu->i_pendidikan == 'Magister'){
                      echo '<option value="Sekolah Dasar">Sekolah Dasar</option>';
                      echo '<option value="Sekolah Menengah Pertama">Sekolah Menengah Pertama</option>';
                      echo '<option value="Sekolah Menengah Atas">Sekolah Menengah Atas</option>';
                      echo '<option value="Sarjana">Sarjana</option>';
                      echo '<option value="Magister" selected>Magister</option>';
                      echo '<option value="Doktoral">Doktoral</option>';
                    } else {
                      echo '<option value="Sekolah Dasar">Sekolah Dasar</option>';
                      echo '<option value="Sekolah Menengah Pertama">Sekolah Menengah Pertama</option>';
                      echo '<option value="Sekolah Menengah Atas">Sekolah Menengah Atas</option>';
                      echo '<option value="Sarjana">Sarjana</option>';
                      echo '<option value="Magister">Magister</option>';
                      echo '<option value="Doktoral" selected>Doktoral</option>';
                    }
                    ?>
                  </select>
                  <label for="i_pendidikan">Pendidikan Terakhir Ibu</label>
                </div>
                <!-- pekerjaan ibu -->
                <div class="input-field inline col s12 m6">
                  <input type="text" name="i_pekerjaan" id="i_pekerjaan" value="{{ $Ibu->i_pekerjaan }}" class="validate">
                  <label for="i_pekerjaan">Pekerjaan Ibu</label>
                </div>
                <!-- telp ibu -->
                <div class="input-field inline col s12 m6">
                  <input name="i_telp" id="i_telp" value="{{ $Ibu->i_telp }}" type="tel" class="validate">
                  <label for="i_telp">No. Telepon (HP)</label>
                </div>
                <!-- wa ibu -->
                <div class="input-field inline col s12 m6">
                  <input name="i_wa" id="i_wa" value="{{ $Ibu->i_wa }}" type="tel" class="validate">
                  <label for="i_wa">No. Whatsapp</label>
                </div>

              </div>
            </div>
            <!-- /Data Ibu -->
          </li>
        </ul>
        <!-- /Accordion -->
        <button class="btn green waves-effect waves-light right" type="submit" name="submit">Ubah
          <i class="material-icons right">send</i>
        </button>
      </form>

    </div>
  </div>

@endsection