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
      $Ayah = Ayah::where("s_nis",$id)->first();
      $Ibu = Ibu::where("s_nis",$id)->first();
      $Hafalan = Hafalan::where("s_nis",$id)->orderBy("h_id","desc")->get();
      $HafalanBaru = HafalanBaru::where("s_nis",$id)->orderBy("hb_id","desc")->get();
      $Kesalahan = Kesalahan::where("s_nis",$id)->orderBy("id","desc")->get();
      $Tabungan = Tabungan::where("s_nis",$id)->orderBy("id","desc")->get();
      $UangSyariah = UangSyariah::where("s_nis",$id)->orderBy("id","desc")->get();

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
      $Hafalan = Hafalan::where("s_nis",$id)->orderBy("h_id","desc")->get();
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
      $HafalanBaru = HafalanBaru::where("s_nis",$id)->orderBy("hb_id","desc")->get();
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
      $Kesalahan = Kesalahan::where("s_nis",$id)->orderBy("id","desc")->get();
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
        if(Auth::user()->jenis=="Ustadz" || Auth::user()->jenis=="Administrator"){
        }
        else{
            $Santri = Santri::whereIn("s_nis",$SantriID);
        }
        if($request->has('q')){
            if($request->q!="" && $request->q!=null){
                $q=$request->q;
                $Santri = $Santri->where("s_nama","like","%".$q."%")->orWhere("s_panggilan","like","%".$q."%");
            }
        }
        $Santri = $Santri->paginate(50);
        $Santri->appends(['q' => $q]);
        foreach($Santri as $s){
            $s->foto = gambar_second($s->s_foto);
            $Ayah=Ayah::where("s_nis",$s->s_nis)->first();
            $s->ayah = "-";
            if($Ayah)
                $s->ayah=$Ayah->a_nama;
            $s->tabungan=0;
            $Dana = Dana::where("related_id",$s->s_nis)->where("jenis","tabungan")->first();
            if($Dana)
                $s->tabungan = $Dana->dana;
        }
        return view("normal.semua-santri",compact("Santri","q"));
    }
}
