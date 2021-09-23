<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Auth;
use App\Models\WaliOrangTua;
use App\Models\Santri;
use App\Models\Hafalan;
use App\Models\HafalanBaru;
use App\Models\Kesalahan;

class SantriController extends Controller
{
    public function apiSantri(Request $request){
        $WaliOrangTua = WaliOrangTua::orderBy("nis_santri","asc")
//            ->where("user_id",Auth::id()
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
      if(!$Santri){
        return response()->json(['result' => 'error', 'title' => 'Santri tidak ditemukan']);
      }
      $Santri->foto = gambar_second($Santri->s_foto);
      return response()->json(['result' => 'success', 'title' => 'Santri berhasil ditemukan','data'=>$Santri]);
    }
    public function apiHafalanSantri($id,Request $request){
      $Santri = Santri::where("s_nis",$id)->select("s_nis","s_nama","s_foto")->first();
      if(!$Santri){
        return response()->json(['result' => 'error', 'title' => 'Santri tidak ditemukan']);
      }
      $Santri->foto = gambar_second($Santri->s_foto);
      $Hafalan = Hafalan::where("s_nis",$id)->orderBy("h_id","desc")->get();
      return response()->json(['result' => 'success', 'title' => 'Santri berhasil ditemukan','santri'=>$Santri, 'data'=>$Hafalan]);
    }
    public function apiHafalanBaruSantri($id,Request $request){
      $Santri = Santri::where("s_nis",$id)->select("s_nis","s_nama","s_foto")->first();
      if(!$Santri){
        return response()->json(['result' => 'error', 'title' => 'Santri tidak ditemukan']);
      }
      $Santri->foto = gambar_second($Santri->s_foto);
      $HafalanBaru = HafalanBaru::where("s_nis",$id)->orderBy("hb_id","desc")->get();
      return response()->json(['result' => 'success', 'title' => 'Santri berhasil ditemukan','santri'=>$Santri, 'data'=>$HafalanBaru]);
    }
    public function apiKesalahanSantri($id,Request $request){
      $Santri = Santri::where("s_nis",$id)->select("s_nis","s_nama","s_foto")->first();
      if(!$Santri){
        return response()->json(['result' => 'error', 'title' => 'Santri tidak ditemukan']);
      }
      $Santri->foto = gambar_second($Santri->s_foto);
      $Kesalahan = Kesalahan::where("s_nis",$id)->orderBy("id","desc")->get();
      return response()->json(['result' => 'success', 'title' => 'Santri berhasil ditemukan','santri'=>$Santri, 'data'=>$Kesalahan]);
    }
}
