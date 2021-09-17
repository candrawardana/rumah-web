<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
class BeritaController extends Controller
{
    //
    public function apiBerita(Request $request){
      $berita = Berita::paginate(10);
      foreach($berita as $b){
        $b->pembuat = detail_pembuat($b->user_id);
        $b->thumbnail = gambar_thumbnail("berita",$b->id,$b->thumbnail);
      }
      return response()->json(['result' => 'success', 'title' => 'Berita berhasil ditemukan','data'=>$berita]);
    }
    public function apiDetailBerita($id,Request $request){
      $berita = Berita::find($id);
      if(!$berita)
        return response()->json(['result' => 'success', 'title' => 'Berita tidak ditemukan']);
      $berita->pembuat = detail_pembuat($berita->user_id);
      $berita->thumbnail = gambar_thumbnail("berita",$berita->id,$berita->thumbnail);
      return response()->json(['result' => 'success', 'title' => 'Berita berhasil ditemukan','data'=>$berita]);
    }
}
