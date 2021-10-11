@extends('template.welcome')
@section('title')
Tambah Santri
@endsection
@section('subtitle')
<li class="breadcrumb-item"><a href="{{ url('santri') }}">Santri</a></li>
<li class="breadcrumb-item active">Tambah Santri</li>
@endsection
@section('content')
<!-- SANTRI_CONTENT -->
<div class="row">
  <div class="col s12">
    <form name="frmtambahsantri" action="{{ url('tambah-santri') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <!-- Accordion -->
      <ul class="collapsible">
        <li class="active">
          <div class="collapsible-header green-text"><i class="material-icons">person</i> <strong>Data Santri</strong></div>
          <!-- Input Data Santri -->
          <div class="collapsible-body">
          <input type="hidden" name="length" value="10">
            <div class="row">
              <!-- tanggal registrasi -->
              <div class="input-field col inline s12 m6">
                <input name="s_reg" id="s_reg" type="text" class="datepicker">
                <label for="s_reg">Tanggal Registrasi</label>
              </div>
              <!-- no induk -->
              <div class="input-field col inline s12 m6">
                <input name="s_nis" id="s_nis" type="text" class="validate">
                <label for="s_nis">Nomor Induk Santri</label>
              </div>
              <!-- nama -->
              <div class="input-field col s12">
                <input name="s_nama" id="s_nama" type="text" class="validate">
                <label for="s_nama">Nama Lengkap</label>
              </div>
              <!-- password -->
              <div class="input-field col s12 m4 inline">
                <input name="s_password" id="s_password" type="password" class="validate">
                <label for="s_password">Password</label>
              </div>
              <div class="input-field col s12 m2 inline">
                <a class="btn green waves-effect waves-light right" style="margin-bottom: -8;" onClick="generate();">Generate</a>
              </div>
              <!-- panggilan -->
              <div class="input-field col s12 m6 inline">
                <input name="s_panggilan" id="s_panggilan" type="text" class="validate">
                <label for="s_panggilan">Nama Panggilan</label>
              </div>
              <!-- tempat lahir -->
              <div class="input-field inline col m6 s12">
                <input name="s_tmplahir" id="s_tmplahir" type="text" class="validate">
                <label for="s_tmplahir">Tempat Lahir</label>
              </div>
              <!-- tanggal lahir -->
              <div class="input-field inline col m6 s12">
                <input name="s_tgllahir" id="s_tgllahir" type="text" class="datepicker">
                <label for="s_tgllahir">Tanggal Lahir</label>
              </div>
              <!-- alamat lengkap -->
              <div class="input-field col s12">
                <textarea name="s_alamat" id="s_alamat" class="materialize-textarea"></textarea>
                <label for="s_alamat">Alamat Lengkap</label>
              </div>
              <!-- saudara -->
              <div class="input-field inline col s12 m6">
                <input name="s_anakke" id="s_anakke" type="number" class="validate" min="0">
                <label for="s_anakke">Anak ke</label>
              </div>
              <div class="input-field inline col s12 m6">
                <input name="s_jlhsaudara" id="s_jlhsaudara" type="number" class="validate" min="0">
                <label for="s_jlhsaudara">Jumlah Saudara</label>
              </div>
              <!-- asal sekolah -->
              <div class="input-field col s12">
                <input type="text" name="s_aslskolah" id="s_aslskolah" class="validate">
                <label for="s_aslskolah">Asal Sekolah</label>
              </div>
              <!-- prestasi -->
              <div class="input-field col s12">
                <input type="text" name="s_prestasi" id="s_prestasi" class="validate">
                <label for="s_prestasi">Prestasi yang Pernah Diraih</label>
              </div>
              <!-- hobi -->
              <div class="input-field col s12">
                <input type="text" name="s_hobi" id="s_hobi" class="validate">
                <label for="s_hobi">Hobi</label>
              </div>
              <!-- cita-cita -->
              <div class="input-field col s12">
                <input type="text" name="s_cita" id="s_cita" class="validate">
                <label for="s_cita">Cita-cita</label>
              </div>
              <!-- foto -->
              <div class="input-field col s12">
                <div class = "file-field input-field">
                  <div class = "btn green">
                    <span>Browse</span>
                    <input type = "file"  name="s_foto"/>
                  </div>

                  <div class = "file-path-wrapper">
                    <input class = "file-path validate" type = "text"
                    placeholder = "Pilih Foto Santri" />
                  </div>
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
                  <input type="text" name="a_nama" id="a_nama" class="validate">
                  <label for="a_nama">Nama Ayah</label>
                </div>
                <!-- tempat lahir ayah -->
                <div class="input-field inline col s12 m6">
                  <input type="text" name="a_tmplahir" id="a_tmplahir" class="validate">
                  <label for="a_tmplahir">Tempat Lahir Ayah</label>
                </div>
                <!-- tgl lahir ayah -->
                <div class="input-field inline col m6 s12">
                  <input name="a_tgllahir" id="a_tgllahir" type="text" class="datepicker validate">
                  <label for="a_tgllahir">Tanggal Lahir Ayah</label>
                </div>
                <!-- pendidikan terakhir ayah -->
                <div class="input-field inline col s12 m6">
                  <select name="a_pendidikan" id="a_pendidikan">
                    <option value="Sekolah Dasar">Sekolah Dasar</option>
                    <option value="Sekolah Menengah Pertama">Sekolah Menengah Pertama</option>
                    <option value="Sekolah Menengah Atas" selected>Sekolah Menengah Atas</option>
                    <option value="Sarjana">Sarjana</option>
                    <option value="Magister">Magister</option>
                    <option value="Doktoral">Doktoral</option>
                  </select>
                  <label for="a_pendidikan">Pendidikan Terakhir Ayah</label>
                </div>
                <!-- pekerjaan ayah -->
                <div class="input-field inline col s12 m6">
                  <input type="text" name="a_pekerjaan" id="a_pekerjaan" class="validate">
                  <label for="a_pekerjaan">Pekerjaan Ayah</label>
                </div>
                <!-- alamat ayah -->
                <div class="input-field col s12">
                  <textarea name="a_alamat" id="a_alamat" class="materialize-textarea"></textarea>
                  <label for="a_alamat">Alamat Ayah</label>
                </div>
                <!-- telp ayah -->
                <div class="input-field inline col s12 m6">
                  <input name="a_telp" id="a_telp" type="tel" class="validate">
                  <label for="a_telp">No. Telepon (HP)</label>
                </div>
                <!-- wa ayah -->
                <div class="input-field inline col s12 m6">
                  <input name="a_wa" id="a_wa" type="tel" class="validate">
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
                  <input type="text" name="i_nama" id="i_nama" class="validate">
                  <label for="i_nama">Nama Ibu</label>
                </div>
                <!-- tempat lahir ibu -->
                <div class="input-field inline col s12 m6">
                  <input type="text" name="i_tmplahir" id="i_tmplahir" class="validate">
                  <label for="i_tmplahir">Tempat Lahir Ibu</label>
                </div>
                <!-- tgl lahir ibu -->
                <div class="input-field inline col s12 m6">
                  <input type="text" name="i_tgllahir" id="i_tgllahir" class="datepicker validate">
                  <label for="i_tgllahir">Tanggal Lahir Ibu</label>
                </div>
                <!-- pendidikan terakhir ibu -->
                <div class="input-field inline col s12 m6">
                  <select name="i_pendidikan" id="i_pendidikan">
                    <option value="Sekolah Dasar">Sekolah Dasar</option>
                    <option value="Sekolah Menengah Pertama">Sekolah Menengah Pertama</option>
                    <option value="Sekolah Menengah Atas" selected>Sekolah Menengah Atas</option>
                    <option value="Sarjana">Sarjana</option>
                    <option value="Magister">Magister</option>
                    <option value="Doktoral">Doktoral</option>
                  </select>
                  <label for="i_pendidikan">Pendidikan Terakhir Ibu</label>
                </div>
                <!-- pekerjaan ibu -->
                <div class="input-field inline col s12 m6">
                  <input type="text" name="i_pekerjaan" id="i_pekerjaan" class="validate">
                  <label for="i_pekerjaan">Pekerjaan Ibu</label>
                </div>
                <!-- telp ibu -->
                <div class="input-field inline col s12 m6">
                  <input name="i_telp" id="i_telp" type="tel" class="validate">
                  <label for="i_telp">No. Telepon (HP)</label>
                </div>
                <!-- wa ibu -->
                <div class="input-field inline col s12 m6">
                  <input name="i_wa" id="i_wa" type="tel" class="validate">
                  <label for="i_wa">No. Whatsapp</label>
                </div>

              </div>
            </div>
            <!-- /Data Ibu -->
          </li>
        </ul>
        <!-- /Accordion -->
        <button class="btn green waves-effect waves-light right" type="submit" name="submit">Simpan
          <i class="material-icons right">send</i>
        </button>
      </form>

    </div>
  </div>
  <script type="text/javascript">
    function randomPassword(length) {
      var chars = "abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNOP1234567890";
      var pass = "";
      for (var x = 0; x < length; x++) {
        var i = Math.floor(Math.random() * chars.length);
        pass += chars.charAt(i);
      }
      return pass;
    }

    function generate() {
      frmtambahsantri.s_password.value = randomPassword(frmtambahsantri.length.value);
      frmtambahsantri.s_password.focus();
    }
  </script>
@endsection