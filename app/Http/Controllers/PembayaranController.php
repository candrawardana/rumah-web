<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
class PembayaranController extends Controller
{
    public function apiPembayaran(Request $request){
      $pembayaran = Pembayaran::paginate(10);
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
