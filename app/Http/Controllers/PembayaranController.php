<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Auth;
class PembayaranController extends Controller
{
    public function apiPembayaran(Request $request){
      $pembayaran = Pembayaran::orderBy("tanggal","desc");
      if(Auth::user()->jenis!="superadmin"){
        $pembayaran = $pembayaran->where("user_id",Auth::user()->id);
      }
      $pembayaran = $pembayaran->paginate(50);
      foreach($pembayaran as $b){
        $b->pembuat = detail_pembuat($b->user_id);
      }
      return response()->json(['result' => 'success', 'title' => 'Pembayaran berhasil ditemukan','data'=>$pembayaran]);
    }
    public function apiDetailPembayaran($id,Request $request){
      $pembayaran = Pembayaran::find($id);
      if(!$pembayaran)
        return response()->json(['result' => 'success', 'title' => 'Pembayaran tidak ditemukan']);
      $pembayaran->pembuat = detail_pembuat($pembayaran->user_id);
      return response()->json(['result' => 'success', 'title' => 'Pembayaran berhasil ditemukan','data'=>$pembayaran]);
    }
}
