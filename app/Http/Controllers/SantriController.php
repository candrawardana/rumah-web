<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Auth;
use App\Models\WaliOrangTua;
use App\Models\Santri;
use App\Models\Ayah;
use App\Models\Ibu;
use App\Models\Hafalan;
use App\Models\HafalanBaru;
use App\Models\Kesalahan;
use App\Models\Tabungan;
use App\Models\UangSyariah;
use App\Models\Dana;
use App\Models\User;
use Session;
use Redirect;
use Storage;
use Hash;
use DB;
class SantriController extends Controller
{
    public function apiSantri(Request $request){
        $WaliOrangTua = WaliOrangTua::orderBy("nis_santri","asc")
            ->where("user_id",Auth::id())
            ->get();
        $SantriID = [];
        foreach($WaliOrangTua as $w){
            $s = Santri::where("s_nis",$w->nis_santri)->select("s_nis")->first();
            if(!$s)
                $w->delete();
            else
                array_push($SantriID,$s->s_nis);
        }
        $Santri = Santri::whereIn("s_nis",$SantriID)->select("s_nis","s_nama","s_foto")->get();
        foreach($Santri as $s){
            $s->foto = gambar_second($s->s_foto);
        }
        return response()->json(['result' => 'success', 'title' => 'Pembayaran berhasil ditemukan','data'=>$Santri]);
    }
    public function apiDetailSantri($id,Request $request){
      $Santri = Santri::where("s_nis",$id)->first();
      $WaliOrangTua = WaliOrangTua::where("nis_santri",$id)
            ->where("user_id",Auth::id())
            ->first();
      if(!$Santri || !$WaliOrangTua){
        return response()->json(['result' => 'error', 'title' => 'Santri tidak ditemukan']);
      }
      $Santri->foto = gambar_second($Santri->s_foto);
      $Ayah = ayah_santri($id);
      $Ibu = ibu_santri($id);
      $Hafalan = Hafalan::where("s_nis",$id)->orderBy("tanggal","desc")->get();
      $HafalanBaru = HafalanBaru::where("s_nis",$id)->orderBy("tanggal","desc")->get();
      $Kesalahan = Kesalahan::where("s_nis",$id)->orderBy("tanggal","desc")->get();
      $Tabungan = Tabungan::where("s_nis",$id)->orderBy("tanggal","desc")->get();
      $UangSyariah = UangSyariah::where("s_nis",$id)->orderBy("tanggal","desc")->get();

      return response()->json(['result' => 'success', 'title' => 'Santri berhasil ditemukan',
        'data'=>$Santri,'Ayah'=>$Ayah,'Ibu'=>$Ibu,
        'Hafalan'=>$Hafalan,
        'HafalanBaru'=>$HafalanBaru,
        'Kesalahan'=>$Kesalahan,
        'Tabungan'=>$Tabungan,
        'UangSyariah'=>$UangSyariah,
      ]);
    }
    public function apiHafalanSantri($id,Request $request){
      $Santri = Santri::where("s_nis",$id)->select("s_nis","s_nama","s_foto")->first();
      $WaliOrangTua = WaliOrangTua::where("nis_santri",$id)
            ->where("user_id",Auth::id())
            ->first();
      if(!$Santri || !$WaliOrangTua){
        return response()->json(['result' => 'error', 'title' => 'Santri tidak ditemukan']);
      }
      $Santri->foto = gambar_second($Santri->s_foto);
      $Hafalan = Hafalan::where("s_nis",$id)->orderBy("tanggal","desc")->get();
      return response()->json(['result' => 'success', 'title' => 'Santri berhasil ditemukan','santri'=>$Santri, 'data'=>$Hafalan]);
    }
    public function apiHafalanBaruSantri($id,Request $request){
      $Santri = Santri::where("s_nis",$id)->select("s_nis","s_nama","s_foto")->first();
      $WaliOrangTua = WaliOrangTua::where("nis_santri",$id)
            ->where("user_id",Auth::id())
            ->first();
      if(!$Santri || !$WaliOrangTua){
        return response()->json(['result' => 'error', 'title' => 'Santri tidak ditemukan']);
      }
      $Santri->foto = gambar_second($Santri->s_foto);
      $HafalanBaru = HafalanBaru::where("s_nis",$id)->orderBy("tanggal","desc")->get();
      return response()->json(['result' => 'success', 'title' => 'Santri berhasil ditemukan','santri'=>$Santri, 'data'=>$HafalanBaru]);
    }
    public function apiKesalahanSantri($id,Request $request){
      $Santri = Santri::where("s_nis",$id)->select("s_nis","s_nama","s_foto")->first();
      $WaliOrangTua = WaliOrangTua::where("nis_santri",$id)
            ->where("user_id",Auth::id())
            ->first();
      if(!$Santri || !$WaliOrangTua){
        return response()->json(['result' => 'error', 'title' => 'Santri tidak ditemukan']);
      }
      $Santri->foto = gambar_second($Santri->s_foto);
      $Kesalahan = Kesalahan::where("s_nis",$id)->orderBy("tanggal","desc")->get();
      return response()->json(['result' => 'success', 'title' => 'Santri berhasil ditemukan','santri'=>$Santri, 'data'=>$Kesalahan]);
    }
    public function webSantri(Request $request){
        $q="";
        $WaliOrangTua = WaliOrangTua::orderBy("nis_santri","asc")
            ->where("user_id",Auth::id())
            ->get();
        $SantriID = [];
        foreach($WaliOrangTua as $w){
            $s = Santri::where("s_nis",$w->nis_santri)->select("s_nis")->first();
            if(!$s)
                $w->delete();
            else
                array_push($SantriID,$s->s_nis);
        }
        $Santri = Santri::select("s_nis","s_nama","s_foto");
        if(Auth::user()->jenis=="Administrator")
          $Santri = DB::table("santri")->select("s_nis","s_password","s_nama","s_foto");
        if(Auth::user()->jenis=="Ustadz" || Auth::user()->jenis=="Administrator"){
            if($request->has('q')){
                if($request->q!="" && $request->q!=null){
                    $q=$request->q;
                    $Santri = $Santri->where("s_nama","like","%".$q."%")->orWhere("s_panggilan","like","%".$q."%")->orWhere("s_nis","like","%".$q."%");
                }
            }
        }
        else{
            $Santri = Santri::whereIn("s_nis",$SantriID);
        }
        $Santri = $Santri->orderBy("s_nama","asc")->paginate(50);
        $Santri->appends(['q' => $q]);
        foreach($Santri as $s){
            $s->foto = gambar_second($s->s_foto);
            $Ayah = ayah_santri($s->s_nis);
            $s->ayah = "-";
            if($Ayah)
                $s->ayah=$Ayah->a_nama;
            $s->tabungan=0;
            $Dana = Dana::where("related_id",$s->s_nis)->where("jenis","tabungan")->first();
            if(!$Dana){
                $Dana = new Dana();
                $Dana->jenis = "tabungan";
                $Dana->related_id = $s->s_nis;
                $Tabungan = Tabungan::where("s_nis",$s->s_nis)->orderBy("tanggal","desc")->first();
                $d = 0;
                if($Tabungan)
                    $d = $Tabungan->t_saldo;
                $Dana->dana=$d;
                $Dana->save();
            }
            $s->tabungan = $Dana->dana;
        }
        return view("normal.semua-santri",compact("Santri","q"));
    }
    public function webDetailSantri($id,Request $request){
      $Santri = DB::table("santri")->where("s_nis",$id)->first();
      $WaliOrangTua = WaliOrangTua::where("nis_santri",$id)
            ->where("user_id",Auth::id())
            ->first();
      $admin = false;
      if(Auth::user()->jenis=="Ustadz" || Auth::user()->jenis=="Administrator"){
        $admin = true;
      }
      if(!$Santri || ($admin == false && !$WaliOrangTua)){
        return redirect(url('santri'));
      }
      $Santri->foto = gambar_second($Santri->s_foto);
      $Ayah = ayah_santri($id);
      $Ibu = ibu_santri($id);
      $Hafalan = Hafalan::where("s_nis",$id)->orderBy("tanggal","desc")->get();
      $HafalanBaru = HafalanBaru::where("s_nis",$id)->orderBy("tanggal","desc")->get();
      $Kesalahan = Kesalahan::where("s_nis",$id)->orderBy("tanggal","desc")->get();
      $Tabungan = Tabungan::where("s_nis",$id)->orderBy("tanggal","desc")->get();
      $UangSyariah = UangSyariah::where("s_nis",$id)->orderBy("tanggal","desc")->get();

        return view("normal.santri",compact("Santri","Hafalan","HafalanBaru","Kesalahan","Tabungan","UangSyariah","Ayah","Ibu"));
    }

    public function editSantri($id){
      if(Auth::user()->jenis=="Administrator"){
        $Santri = Santri::where("s_nis",$id)->first();
        $WaliOrangTua = WaliOrangTua::where("nis_santri",$id)
              ->where("user_id",Auth::id())
              ->first();
        $admin = false;
        if(Auth::user()->jenis=="Ustadz" || Auth::user()->jenis=="Administrator"){
          $admin = true;
        }
        if(!$Santri || ($admin == false && !$WaliOrangTua)){
          return redirect(url('santri'));
        }
        $Santri->foto = gambar_second($Santri->s_foto);
        $Ayah = ayah_santri($id);
        $Ibu = ibu_santri($id);
        return view("normal.edit-santri",compact("Santri","Ayah","Ibu"));
      }
      return view("errors.404");
    }
    public function tambahSantri(){
      if(Auth::user()->jenis=="Administrator"){
        return view("normal.tambah-santri");
      }
      return view("errors.404");
    }

    public function tambahSantriProses(Request $request){
      if(Auth::user()->jenis!="Administrator"){
        return view("errors.404");
      }
      $ubah = false;
      if($request->has("ubah")){
        $ubah=true;
      }
      $Santri = Santri::find($request->s_nis);
      if(!$Santri && $ubah==true)
        return view("errors.404");
      if($Santri && $ubah==false)
        return view("errors.404");
      if(!$Santri)
        $Santri = new Santri();
      $Santri->s_nis=$request->s_nis;
      $Santri->s_password=$request->s_password; 
      $Santri->s_reg=$request->s_reg; 
      $Santri->s_nama=$request->s_nama; 
      $Santri->s_panggilan=$request->s_panggilan; 
      $Santri->s_tmplahir=$request->s_tmplahir;
      $Santri->s_tgllahir=$request->s_tgllahir; 
      $Santri->s_alamat=$request->s_alamat; 
      $Santri->s_anakke=$request->s_anakke; 
      $Santri->s_jlhsaudara=$request->s_jlhsaudara;
      $Santri->s_aslskolah=$request->s_aslskolah;
      $Santri->s_prestasi=$request->s_prestasi;
      $Santri->s_hobi=$request->s_hobi;
      $Santri->s_cita=$request->s_cita;
      $s_foto=null;
      if($request->hasFile('s_foto')){
        $s_foto = $request->s_nis.".".strtolower(substr(strrchr($request->file('s_foto')->getClientOriginalName(), '.'), 1));
        if(Storage::exists("foto/".$s_foto)){
                Storage::delete("foto/".$s_foto);
            }
        Storage::putFileAs(
                "foto/",
                $request->file('s_foto'),
                $s_foto
            );
        $s_foto = "foto/".$s_foto;
      }
      $Santri->s_foto=$s_foto;
      $Santri->save();
      if(!$Santri)
        return view("errors.404");
      $password = Hash::make($request->s_password);
      $a_id = "A" . $request->s_nis;
      $i_id = "I" . $request->s_nis;
      $Ayah = User::where("hp",$request->a_telp)->orWhere("label_id",$a_id)->first();
      if(!$Ayah)
        $Ayah = new User();
      $Ayah->name = $request->a_nama;
      $Ayah->username = $a_id;
      $Ayah->label_id = $a_id;
      $Ayah->password = $password;
      $Ayah->jenis = "ayah_santri";
      $Ayah->pekerjaan = $request->a_pekerjaan;
      $Ayah->pendidikan = $request->a_pendidikan;
      $Ayah->hp = $request->a_telp;
      $Ayah->wa = $request->a_wa;
      $Ayah->alamat = $request->a_alamat;
      $Ayah->lahir = $request->a_tmplahir.", ".$request->a_tgllahir;
      $Ayah->save();
      $Ibu = User::where("hp",$request->i_telp)->orWhere("label_id",$i_id)->first();
      if(!$Ibu)
        $Ibu = new User();
      $Ibu->name = $request->i_nama;
      $Ibu->username = $i_id;
      $Ibu->label_id = $i_id;
      $Ibu->password = $password;
      $Ibu->jenis = "ibu_santri";
      $Ibu->pekerjaan = $request->i_pekerjaan;
      $Ibu->pendidikan = $request->i_pendidikan;
      $Ibu->hp = $request->i_telp;
      $Ibu->wa = $request->i_wa;
      $Ibu->alamat = $request->s_alamat;
      $Ibu->lahir = $request->i_tmplahir.", ".$request->i_tgllahir;
      $Ibu->save();
      if($Ayah){
        $WaliOrangTua = WaliOrangTua::where("nis_santri",$request->s_nis)
            ->where("user_id",$Ayah->id)
            ->first();
        if(!$WaliOrangTua){
            $WaliOrangTua = new WaliOrangTua();
            $WaliOrangTua->nis_santri = $request->s_nis;
            $WaliOrangTua->user_id = $Ayah->id;
            $WaliOrangTua->save();
        }        
      }
      if($Ibu){
        $WaliOrangTua = WaliOrangTua::where("nis_santri",$request->s_nis)
            ->where("user_id",$Ibu->id)
            ->first();
        if(!$WaliOrangTua){
            $WaliOrangTua = new WaliOrangTua();
            $WaliOrangTua->nis_santri = $request->s_nis;
            $WaliOrangTua->user_id = $Ibu->id;
            $WaliOrangTua->save();
        }        
      }
      if($ubah==false)
        return redirect(url('santri'))->with("success","Berhasil menambahkan santri");
      else
        return Redirect::back()->with("success","Berhasil mengubah santri");
    }
    public function hapusSantri($id){
      if(Auth::user()->jenis=="Administrator"){
        return view("errors.konfirmasi");
      }
      return view("errors.404");
    }
    public function hapusSantriProses(Request $request,$id){
      if(penempatan("PASSWORD_ROOT")==$request->password && Auth::user()->jenis=="Administrator"){
        $Santri = Santri::find($id);
        if(Storage::exists("foto/".$Santri->s_foto)){
                Storage::delete("foto/".$Santri->s_foto);
            }
        $Santri->delete();
        $WaliOrangTua = WaliOrangTua::where("nis_santri",$id)->get();

        foreach($WaliOrangTua as $w){
          User::where("id",$w->user_id)->delete();
        }
        WaliOrangTua::where("nis_santri",$id)->delete();
        Kesalahan::where("s_nis",$id)->delete();
        HafalanBaru::where("s_nis",$id)->delete();
        Hafalan::where("s_nis",$id)->delete();
        Tabungan::where("s_nis",$id)->delete();
        UangSyariah::where("s_nis",$id)->delete();
        Dana::where("related_id",$id)->delete();
        return Redirect::to('santri')->with("success","Berhasil menghapus Santri");
      }
      Session::flash('error', 'Pilih dahulu apakah anda ayah atau ibu santri tersebut');
      return Redirect::back()->with("error","Salah Password");
    }
    public function webKesalahanSantri($id,Request $request){
      $Santri = Santri::where("s_nis",$id)->select("s_nis","s_nama","s_foto")->first();
      $admin = false;
      if(Auth::user()->jenis=="Ustadz" || Auth::user()->jenis=="Administrator"){
        $admin = true;
      }
      if(!$Santri || $admin==false){
        return redirect(url('santri'));
      }
      $Santri->foto = gambar_second($Santri->s_foto);
      $Kesalahan = Kesalahan::where("s_nis",$id)->orderBy("tanggal","desc")->get();
      return view("normal.kesalahan",compact("Santri","Kesalahan"));
    }
    public function tambahKesalahan(Request $request){
      if(Auth::user()->jenis=="Ustadz" || Auth::user()->jenis=="Administrator"){
        $Kesalahan = new Kesalahan();
        $Kesalahan->k_tanggal = $request->k_tanggal;
        $Kesalahan->k_kesalahan = $request->k_kesalahan;
        $Kesalahan->k_hukuman = $request->k_hukuman;
        $Kesalahan->s_nis = $request->s_nis;
        $time = strtotime($request->k_tanggal);
        $Kesalahan->tanggal = date('Y-m-d',$time);
        $Kesalahan->save();
        return Redirect::back()->with("success","Berhasil menambahkan kesalahan");
      }
      return view("errors.404");
    }
    public function hapusKesalahan($id){
      if(Auth::user()->jenis=="Administrator"){
        Kesalahan::where("id",$id)->delete();
        return Redirect::back()->with("success","Berhasil menghapus kesalahan");
      }
      return view("errors.404");
    }
    public function webHafalanBaruSantri($id,Request $request){
      $Santri = Santri::where("s_nis",$id)->select("s_nis","s_nama","s_foto")->first();
      $admin = false;
      if(Auth::user()->jenis=="Ustadz" || Auth::user()->jenis=="Administrator"){
        $admin = true;
      }
      if(!$Santri || $admin==false){
        return redirect(url('santri'));
      }
      $Santri->foto = gambar_second($Santri->s_foto);
      $HafalanBaru = HafalanBaru::where("s_nis",$id)->orderBy("tanggal","desc")->get();
      return view("normal.hafalan-baru",compact("Santri","HafalanBaru"));
    }
    public function tambahHafalanBaru(Request $request){
      if(Auth::user()->jenis=="Ustadz" || Auth::user()->jenis=="Administrator"){
        $HafalanBaru = new HafalanBaru();
        $HafalanBaru->hb_tanggal = $request->hb_tanggal;
        $HafalanBaru->hb_juz = $request->hb_juz;
        $HafalanBaru->hb_surat = $request->hb_surat;
        $HafalanBaru->hb_ayat = $request->hb_ayat;
        $HafalanBaru->hb_nilai = $request->hb_nilai;
        $HafalanBaru->hb_ustadz = $request->hb_ustadz;
        $HafalanBaru->hb_keterangan = $request->hb_keterangan;
        $HafalanBaru->s_nis = $request->s_nis;
        $time = strtotime($request->hb_tanggal);
        $HafalanBaru->tanggal = date('Y-m-d',$time);
        $HafalanBaru->save();
        return Redirect::back()->with("success","Berhasil menambahkan kesalahan");
      }
      return view("errors.404");
    }
    public function hapusHafalanBaru($id){
      if(Auth::user()->jenis=="Ustadz" || Auth::user()->jenis=="Administrator"){
        HafalanBaru::find($id)->delete();
        return Redirect::back()->with("success","Berhasil menghapus kesalahan");
      }
      return view("errors.404");
    }
    public function webHafalanSantri($id,Request $request){
      $Santri = Santri::where("s_nis",$id)->select("s_nis","s_nama","s_foto")->first();
      $admin = false;
      if(Auth::user()->jenis=="Ustadz" || Auth::user()->jenis=="Administrator"){
        $admin = true;
      }
      if(!$Santri || $admin==false){
        return redirect(url('santri'));
      }
      $Santri->foto = gambar_second($Santri->s_foto);
      $Hafalan = Hafalan::where("s_nis",$id)->orderBy("tanggal","desc")->get();
      return view("normal.hafalan",compact("Santri","Hafalan"));
    }
    public function tambahHafalan(Request $request){
      if(Auth::user()->jenis=="Ustadz" || Auth::user()->jenis=="Administrator"){
        $Hafalan = new Hafalan();
        $Hafalan->h_tanggal = $request->h_tanggal;
        $Hafalan->h_juz = $request->h_juz;
        $Hafalan->h_muqro = $request->h_muqro;
        $Hafalan->h_hasil = $request->h_hasil;
        $Hafalan->h_ustadz = $request->h_ustadz;
        $Hafalan->h_keterangan = $request->h_keterangan;
        $Hafalan->s_nis = $request->s_nis;
        $time = strtotime($request->h_tanggal);
        $Hafalan->tanggal = date('Y-m-d',$time);
        $Hafalan->save();
        return Redirect::back()->with("success","Berhasil menambahkan kesalahan");
      }
      return view("errors.404");
    }
    public function hapusHafalan($id){
      if(Auth::user()->jenis=="Administrator"){
        Hafalan::find($id)->delete();
        return Redirect::back()->with("success","Berhasil menghapus kesalahan");
      }
      return view("errors.404");
    }
    public function webTabunganSantri($id,Request $request){
      $Santri = Santri::where("s_nis",$id)->select("s_nis","s_nama","s_foto")->first();
      $admin = false;
      if(Auth::user()->jenis=="Administrator"){
        $admin = true;
      }
      if(!$Santri || $admin==false){
        return redirect(url('santri'));
      }
      $Santri->foto = gambar_second($Santri->s_foto);
      $Tabungan = Tabungan::where("s_nis",$id)->orderBy("tanggal","desc")->get();
      return view("normal.tabungan",compact("Santri","Tabungan"));
    }
    public function tambahTabungan(Request $request){
      if(Auth::user()->jenis=="Administrator"){
        $Tabungan = new Tabungan();
        $Tabungan->s_nis = $request->s_nis;
        $Tabungan->t_tanggal = $request->t_tanggal;
        $time = strtotime($request->t_tanggal);
        $Tabungan->tanggal = date('Y-m-d',$time);
        $Dana = Dana::where("related_id",$request->s_nis)->where("jenis","tabungan")->first();
          if(!$Dana){
              $Dana = new Dana();
              $Dana->jenis = "tabungan";
              $Dana->related_id = $request->s_nis;
              $Dana->dana=0;
              $Dana->save();
        }
        $t_saldo = $Dana->dana;
        $t_keterangan = $request->t_keterangan;
        $t_penarikan = $request->t_penarikan;
        $t_kredit = 0;
        $t_debet = 0;
        $t_nominal = $request->t_nominal;
        $t_nominal = str_replace(".","",$t_nominal);
        if($t_penarikan == ''){
          $t_penarikan = '-';
        }
        if ($request->t_keterangan == 'Penarikan') {
          $t_kredit = $t_nominal;
          $t_saldo = $t_saldo - $t_kredit;
          $t_keterangan = $t_penarikan;
        } else {
          $t_debet = $t_nominal;
          $t_saldo = $t_saldo + $t_debet;
        }
        $Tabungan->t_debet = $t_debet;
        $Tabungan->t_kredit = $t_kredit;
        $Tabungan->t_saldo = $t_saldo;
        $Tabungan->t_keterangan = $t_keterangan;
        $Tabungan->save();
        if($Tabungan){
          $Dana->dana = $t_saldo;
          $Dana->save();

        }
        return Redirect::back()->with("success","Berhasil menambahkan kesalahan");
      }
      return view("errors.404");
    }
    public function hapusTabungan($id){
      if(Auth::user()->jenis=="Administrator"){
        return view("errors.konfirmasi");
      }
      return view("errors.404");
    }
    public function hapusTabunganProses(Request $request,$id){
      if(penempatan("PASSWORD_ROOT")==$request->password && Auth::user()->jenis=="Administrator"){
        $Tabungan = Tabungan::find($id);
        $Santri = "";
        if($Tabungan){
          $Santri = $Tabungan->s_nis;
          $Tabungan->delete();
        }
        return Redirect::to('santri/'.$Santri.'/tabungan')->with("success","Berhasil menghapus kesalahan");
      }
      Session::flash('error', 'Pilih dahulu apakah anda ayah atau ibu santri tersebut');
      return Redirect::back()->with("error","Salah Password");
    }
    public function webUangSyariahSantri($id,Request $request){
      $Santri = Santri::where("s_nis",$id)->select("s_nis","s_nama","s_foto")->first();
      $admin = false;
      if(Auth::user()->jenis=="Ustadz" || Auth::user()->jenis=="Administrator"){
        $admin = true;
      }
      if(!$Santri || $admin==false){
        return redirect(url('santri'));
      }
      $Santri->foto = gambar_second($Santri->s_foto);
      $UangSyariah = UangSyariah::where("s_nis",$id)->orderBy("tanggal","desc")->get();
      return view("normal.uang-syariah",compact("Santri","UangSyariah"));
    }
    public function tambahUangSyariah(Request $request){
      if(Auth::user()->jenis=="Ustadz" || Auth::user()->jenis=="Administrator"){
        $UangSyariah = new UangSyariah();
        $UangSyariah->u_tanggal = $request->u_tanggal;
        $UangSyariah->u_bulan = $request->u_bulan;
        $UangSyariah->u_nominal = $request->u_nominal;
        $UangSyariah->u_keterangan = $request->u_keterangan;
        $UangSyariah->s_nis = $request->s_nis;
        $time = strtotime($request->u_tanggal);
        $UangSyariah->tanggal = date('Y-m-d',$time);
        $UangSyariah->save();
        return Redirect::back()->with("success","Berhasil menambahkan kesalahan");
      }
      return view("errors.404");
    }
    public function hapusUangSyariah($id){
      if(Auth::user()->jenis=="Administrator"){
        UangSyariah::find($id)->delete();
        return Redirect::back()->with("success","Berhasil menghapus kesalahan");
      }
      return view("errors.404");
    }
    public function webWaliSantri($id){
      if(Auth::user()->jenis=="Administrator"){
        $ayah_santri = ayah_santri($id);
        $ibu_santri = ibu_santri($id);
        return compact("ayah_santri","ibu_santri");
      }
     return view("errors.404");
    }
    public function foto($file, $file2=""){
        if($file2!="")
          $file2="/".$file2;
        if(Storage::exists("foto/".$file.$file2)){
            if(request()->has('download'))
                return Storage::download("foto/".$file.$file2);
            return Storage::get("foto/".$file.$file2);
        }
        else return "Gagal membuka file, kemungkinan file tidak ada atau error";
    }

    public function potonganTabungan(){
      if(Auth::user()->jenis=="Administrator"){
        return view("admin.potongan-tabungan");
      }
      return view("errors.404");
    }
    public function potonganTabunganProses(Request $request){
      if(Auth::user()->jenis!="Administrator"){
        return view("errors.404");
      }
      $semua_s_nis=$request->santri;
      foreach($semua_s_nis as $s_nis){
        $Tabungan = new Tabungan();
        $Tabungan->s_nis = $s_nis;
        $Tabungan->t_tanggal = $request->t_tanggal;
        $time = strtotime($request->t_tanggal);
        $Tabungan->tanggal = date('Y-m-d',$time);
        $Dana = Dana::where("related_id",$s_nis)->where("jenis","tabungan")->first();
          if(!$Dana){
              $Dana = new Dana();
              $Dana->jenis = "tabungan";
              $Dana->related_id = $s_nis;
              $Dana->dana=0;
              $Dana->save();
        }
        $t_saldo = $Dana->dana;
        $t_penarikan = $request->t_penarikan;
        $t_kredit = 0;
        $t_debet = 0;
        $t_nominal = $request->t_nominal;
        $t_nominal = str_replace(".","",$t_nominal);
        if($t_penarikan == ''){
          $t_penarikan = '-';
        }
        $t_kredit = $t_nominal;
        $t_saldo = $t_saldo - $t_kredit;
        $t_keterangan = $t_penarikan;
        $Tabungan->t_debet = $t_debet;
        $Tabungan->t_kredit = $t_kredit;
        $Tabungan->t_saldo = $t_saldo;
        $Tabungan->t_keterangan = $t_keterangan;
        $Tabungan->save();
        if($Tabungan){
          $Dana->dana = $t_saldo;
          $Dana->save();

        }
      }
      return Redirect::back()->with("success","Berhasil menambahkan potongan tabungan");
    }
}
