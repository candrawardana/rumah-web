<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\WaliOrangTua;
use App\Models\Santri;
use App\Models\Ayah;
use App\Models\Ibu;
use App\Models\Hafalan;
use App\Models\HafalanBaru;
use App\Models\Kesalahan;
use App\Models\Tabungan;
use App\Models\UangSyariah;
use App\Models\Pengumuman;
use App\Models\Kegiatan;
use App\Models\Pegawai;
use App\Models\User;
use Hash;
use Storage;

class MigrasiDataController extends Controller
{
    //
    public function tabungan(Request $request){
        if(Auth::user()->jenis=="Administrator"){
            $p = 1;
            if($request->has("page")){
                $p=$request->page;
            }
            $Tabungan = Tabungan::orderBy("id","asc")->paginate(2000);
            $count = 0;
            foreach($Tabungan as $d){
                $time = strtotime($d->t_tanggal);
                $d->tanggal = date('Y-m-d',$time);
                $d->save();
                $count++;
            }
            $p++;
            if($count==0)
                return "selesai";
            return "<a href='".url("migrasi/tabungan?page=".$p)."'>Lanjut ke ".$p."</a>";
        }
    }
    public function hafalan(Request $request){
        if(Auth::user()->jenis=="Administrator"){
            $p = 1;
            if($request->has("page")){
                $p=$request->page;
            }
            $Hafalan = Hafalan::orderBy("h_id","asc")->paginate(2000);
            $count = 0;
            foreach($Hafalan as $d){
                $time = strtotime($d->h_tanggal);
                $d->tanggal = date('Y-m-d',$time);
                $d->save();
                $count++;
            }
            $p++;
            if($count==0)
                return "selesai";
            return "<a href='".url("migrasi/hafalan?page=".$p)."'>Lanjut ke ".$p."</a>";
        }
    }
    public function hafalanBaru(Request $request){
        if(Auth::user()->jenis=="Administrator"){
            $p = 1;
            if($request->has("page")){
                $p=$request->page;
            }
            $HafalanBaru = HafalanBaru::orderBy("hb_id","asc")->paginate(2000);
            $count = 0;
            foreach($HafalanBaru as $d){
                $time = strtotime($d->hb_tanggal);
                $d->tanggal = date('Y-m-d',$time);
                $d->save();
                $count++;
            }
            $p++;
            if($count==0)
                return "selesai";
            return "<a href='".url("migrasi/hafalan-baru?page=".$p)."'>Lanjut ke ".$p."</a>";
        }
    }
    public function kesalahan(Request $request){
        if(Auth::user()->jenis=="Administrator"){
            $p = 1;
            if($request->has("page")){
                $p=$request->page;
            }
            $Kesalahan = Kesalahan::orderBy("id","asc")->paginate(2000);
            $count = 0;
            foreach($Kesalahan as $d){
                $time = strtotime($d->k_tanggal);
                $d->tanggal = date('Y-m-d',$time);
                $d->save();
                $count++;
            }
            $p++;
            if($count==0)
                return "selesai";
            return "<a href='".url("migrasi/kesalahan?page=".$p)."'>Lanjut ke ".$p."</a>";
        }
    }
    public function uangSyariah(Request $request){
        if(Auth::user()->jenis=="Administrator"){
            $p = 1;
            if($request->has("page")){
                $p=$request->page;
            }
            $UangSyariah = UangSyariah::orderBy("id","asc")->paginate(2000);
            $count = 0;
            foreach($UangSyariah as $d){
                $time = strtotime($d->u_tanggal);
                $d->tanggal = date('Y-m-d',$time);
                $d->save();
                $count++;
            }
            $p++;
            if($count==0)
                return "selesai";
            return "<a href='".url("migrasi/uang-syariah?page=".$p)."'>Lanjut ke ".$p."</a>";
        }
    }
    public function pengumuman(Request $request){
        if(Auth::user()->jenis=="Administrator"){
            $p = 1;
            if($request->has("page")){
                $p=$request->page;
            }
            $Pengumuman = Pengumuman::orderBy("pg_id","asc")->paginate(2000);
            $count = 0;
            foreach($Pengumuman as $d){
                $time = strtotime($d->pg_tanggal);
                $d->tanggal = date('Y-m-d',$time);
                $d->save();
                $count++;
            }
            $p++;
            if($count==0)
                return "selesai";
            return "<a href='".url("migrasi/pengumuman?page=".$p)."'>Lanjut ke ".$p."</a>";
        }
    }
    public function kegiatan(Request $request){
        if(Auth::user()->jenis=="Administrator"){
            $p = 1;
            if($request->has("page")){
                $p=$request->page;
            }
            $Kegiatan = Kegiatan::orderBy("kg_id","asc")->paginate(2000);
            $count = 0;
            foreach($Kegiatan as $d){
                $time = strtotime($d->kg_tanggal);
                $d->tanggal = date('Y-m-d',$time);
                $d->save();
                $count++;
            }
            $p++;
            if($count==0)
                return "selesai";
            return "<a href='".url("migrasi/kegiatan?page=".$p)."'>Lanjut ke ".$p."</a>";
        }
    }
    public function pegawai(Request $request){
        if(Auth::user()->jenis=="Administrator"){
            $p = 1;
            if($request->has("page")){
                $p=$request->page;
            }
            $Pegawaix = Pegawai::orderBy("p_induk","asc")->paginate(10);
            $count = 0;
            foreach($Pegawaix as $Pegawai){
                $User = User::where("username",$Pegawai->p_username)->first();
                if(!$User){
                    $User = new User();
                    $User->name = $Pegawai->p_nama;
                    $User->username = $Pegawai->p_username;
                    $User->email = $Pegawai->p_email;
                    $User->label_id = $Pegawai->p_induk;
                    $User->password = Hash::make($Pegawai->p_password);
                    $User->jenis = $Pegawai->p_level;
                    $User->pekerjaan = $Pegawai->p_jabatan;
                    $User->hp = $Pegawai->p_telp;
                    $User->alamat = $Pegawai->p_alamat;
                    $User->save();
                    $host = gambar_second($Pegawai->p_foto);
                    $ch = curl_init($host);
                    curl_setopt($ch, CURLOPT_HEADER, 0);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
                    $result = curl_exec($ch);
                    curl_close($ch);
                    Storage::makeDirectory("pp/".$User->id);
                    $fp = fopen(Storage::path("pp/".$User->id."/convert.jpg",$result),'x');
                    fwrite($fp, $result);
                    fclose($fp);

                }
                $count++;
            }
            $p++;
            if($count==0)
                return "selesai";
            return "<a href='".url("migrasi/pegawai?page=".$p)."'>Lanjut ke ".$p."</a>";
        }
    }
    public function ayah(Request $request){
        if(Auth::user()->jenis=="Administrator"){
            $p = 1;
            if($request->has("page")){
                $p=$request->page;
            }
            $Ayahx = Ayah::orderBy("a_id","asc")->paginate(200);
            $count = 0;
            foreach($Ayahx as $Ayah){
                $User = User::where("username",$Ayah->a_id)->first();
                if(!$User){
                    $Santri=Santri::where("s_nis",$Ayah->s_nis)->first();
                    $User = new User();
                    $User->name = $Ayah->a_nama;
                    $User->username = $Ayah->a_id;
                    $User->label_id = $Ayah->a_id;
                    if($Santri)
                        $User->password = Hash::make($Santri->s_password);
                    else{
                        $User->password = Hash::make($Ayah->a_id);
                    }
                    $User->jenis = "ayah_santri";
                    $User->pekerjaan = $Ayah->a_pekerjaan;
                    $User->pendidikan = $Ayah->a_pendidikan;
                    $User->hp = $Ayah->a_telp;
                    $User->wa = $Ayah->a_wa;
                    $User->alamat = $Ayah->a_alamat;
                    $User->lahir = $Ayah->a_tmplahir.", ".$Ayah->a_tgllahir;
                    $User->save();
                    $WaliOrangTua = WaliOrangTua::where("nis_santri",$Ayah->s_nis)
                        ->where("user_id",$User->id)
                        ->first();
                    if(!$WaliOrangTua){
                        $WaliOrangTua = new WaliOrangTua();
                        $WaliOrangTua->nis_santri = $Ayah->s_nis;
                        $WaliOrangTua->user_id = $User->id;
                        $WaliOrangTua->save();
                    }          
                }
                $count++;
            }
            $p++;
            if($count==0)
                return "selesai";
            return "<a href='".url("migrasi/ayah?page=".$p)."'>Lanjut ke ".$p."</a>";
        }
    }
    public function ibu(Request $request){
        if(Auth::user()->jenis=="Administrator"){
            $p = 1;
            if($request->has("page")){
                $p=$request->page;
            }
            $Ibux = Ibu::orderBy("i_id","asc")->paginate(200);
            $count = 0;
            foreach($Ibux as $Ibu){
                $User = User::where("username",$Ibu->a_id)->first();
                if(!$User){
                    $Santri=Santri::where("s_nis",$Ibu->s_nis)->first();
                    $User = new User();
                    $User->name = $Ibu->i_nama;
                    $User->username = $Ibu->i_id;
                    $User->label_id = $Ibu->i_id;
                    if($Santri)
                        $User->password = Hash::make($Santri->s_password);
                    else{
                        $User->password = Hash::make($ibu->i_id);
                    }
                    $User->jenis = "ibu_santri";
                    $User->pekerjaan = $Ibu->i_pekerjaan;
                    $User->pendidikan = $Ibu->i_pendidikan;
                    $User->hp = $Ibu->i_telp;
                    $User->wa = $Ibu->i_wa;
                    if($Santri)
                        $User->alamat = $Santri->s_alamat;
                    $User->lahir = $Ibu->i_tmplahir.", ".$Ibu->i_tgllahir;
                    $User->save();
                    $WaliOrangTua = WaliOrangTua::where("nis_santri",$Ibu->s_nis)
                        ->where("user_id",$User->id)
                        ->first();
                    if(!$WaliOrangTua){
                        $WaliOrangTua = new WaliOrangTua();
                        $WaliOrangTua->nis_santri = $Ibu->s_nis;
                        $WaliOrangTua->user_id = $User->id;
                        $WaliOrangTua->save();
                    }          
                }
                $count++;
            }
            $p++;
            if($count==0)
                return "selesai";
            return "<a href='".url("migrasi/ibu?page=".$p)."'>Lanjut ke ".$p."</a>";
        }
    }
    public function userKosong(Request $request){
        if(Auth::user()->jenis=="Administrator"){
            User::where("name","")->delete();
            return "selesai";
        }
    }

}
