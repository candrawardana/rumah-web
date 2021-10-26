<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Auth;
class PembayaranController extends Controller
{
    public function apiPembayaran(Request $request){
      $pembayaran = Pembayaran::orderBy("tanggal","desc");
      if(Auth::user()->jenis!="Administrator"){
        $pembayaran = $pembayaran->where("user_id",Auth::user()->id);
      }
      $pembayaran = $pembayaran->paginate(15);
      foreach($pembayaran as $b){
        $b->pembuat = detail_pembuat($b->user_id);
      }
      return response()->json(['result' => 'success', 'title' => 'Pembayaran berhasil ditemukan','data'=>$pembayaran]);
    }
    public function apiDetailPembayaran($id,Request $request){
      $pembayaran = Pembayaran::find($id);
      if(!$pembayaran)
        return response()->json(['result' => 'error', 'title' => 'Pembayaran tidak ditemukan']);
      $pembayaran->pembuat = detail_pembuat($pembayaran->user_id);
      return response()->json(['result' => 'success', 'title' => 'Pembayaran berhasil ditemukan','data'=>$pembayaran]);
    }
    public function webPembayaran(Request $request){
      $q="";
      $Pembayaran = Pembayaran::orderBy("tanggal","desc");
      if(Auth::user()->jenis!="Administrator"){
        $Pembayaran = $Pembayaran->where("user_id",Auth::user()->id);
      }
      $Pembayaran = $Pembayaran->paginate(50);
      foreach($Pembayaran as $b){
        $b->pembuat = detail_pembuat($b->user_id);
      }
      return view("admin.pembayaran",compact("Pembayaran","q"));
    }
    public function pembelian(Request $request){
      $pembayaran = Pembayaran::orderBy("tanggal","desc");
      if(Auth::user()->jenis!="Administrator"){
        $pembayaran = $pembayaran->where("user_id",Auth::user()->id);
      }
      $pembayaran = $pembayaran->paginate(50);
      foreach($pembayaran as $b){
        $b->pembuat = detail_pembuat($b->user_id);
      }
      return response()->json(['result' => 'success', 'title' => 'Pembayaran berhasil ditemukan','data'=>$pembayaran]);
    }
    public function bagiHasil(Request $request){
      $pembayaran = Pembayaran::orderBy("tanggal","desc");
      if(Auth::user()->jenis!="Administrator"){
        $pembayaran = $pembayaran->where("user_id",Auth::user()->id);
      }
      $pembayaran = $pembayaran->paginate(50);
      foreach($pembayaran as $b){
        $b->pembuat = detail_pembuat($b->user_id);
      }
      return response()->json(['result' => 'success', 'title' => 'Pembayaran berhasil ditemukan','data'=>$pembayaran]);
    }
}
