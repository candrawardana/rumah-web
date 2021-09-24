<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
class BeritaController extends Controller
{
    //
    public function apiBerita(Request $request){
      $q=null;
      $berita = Berita::orderBy("tanggal","desc");
      if($request->has('q')){
        if($request->q!="" && $request->q!=null){
          $q=$request->q;
          $berita = $berita->where("title","like","%".$q."%")->orWhere("content","like","%".$q."%");
        }
      }
      $berita = $berita->paginate(10);
      $berita->appends(['q' => $q]);
      foreach($berita as $b){
        $b->pembuat = detail_pembuat($b->user_id);
        $b->thumbnail = gambar_thumbnail("berita",$b->id,$b->thumbnail);
        $b->content = substr($b->content, 0,150)."...lihat selengkapnya";
      }
      return response()->json(['result' => 'success', 'title' => 'Berita berhasil ditemukan','data'=>$berita]);
    }
    public function apiDetailBerita($id,Request $request){
      $berita = Berita::find($id);
      if(!$berita)
        return response()->json(['result' => 'error', 'title' => 'Berita tidak ditemukan']);
      $berita->pembuat = detail_pembuat($berita->user_id);
      $berita->thumbnail = gambar_thumbnail("berita",$berita->id,$berita->thumbnail);
      return response()->json(['result' => 'success', 'title' => 'Berita berhasil ditemukan','data'=>$berita]);
    }
    public function webBerita(Request $request){
      $q=null;
      $berita = Berita::orderBy("tanggal","desc");
      if($request->has('q')){
        if($request->q!="" && $request->q!=null){
          $q=$request->q;
          $berita = $berita->where("title","like","%".$q."%")->orWhere("content","like","%".$q."%");
        }
      }
      $berita = $berita->paginate(10);
      $berita->appends(['q' => $q]);
      foreach($berita as $b){
        $b->pembuat = detail_pembuat($b->user_id);
        $b->thumbnail = gambar_thumbnail("berita",$b->id,$b->thumbnail);
        $b->content = substr($b->content, 0,150)."...lihat selengkapnya";
      }
      $Berita = $berita;
      return view("normal.semua-berita",compact("Berita","q"));
    }
    public function webDetailBerita($id,Request $request){
      $berita = Berita::find($id);
      if(!$berita)
        return response()->json(['result' => 'error', 'title' => 'Berita tidak ditemukan']);
      $berita->pembuat = detail_pembuat($berita->user_id);
      $berita->thumbnail = gambar_thumbnail("berita",$berita->id,$berita->thumbnail);
      $Berita = $berita;
      return view("normal.berita",compact("Berita"));
    }
}
