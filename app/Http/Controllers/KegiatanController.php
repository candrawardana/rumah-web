<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;

class KegiatanController extends Controller
{
    public function apiKegiatan(Request $request){
      $q=null;
      $Kegiatan = Kegiatan::orderBy("kg_tanggal","desc");
      if($request->has('q')){
        if($request->q!="" && $request->q!=null){
          $q=$request->q;
          $Kegiatan = $Kegiatan->where("kg_judul","like","%".$q."%")->orWhere("kg_desc","like","%".$q."%");
        }
      }
      $Kegiatan = $Kegiatan->paginate(5);
      $Kegiatan->appends(['q' => $q]);
      foreach($Kegiatan as $b){
        $b->kg_foto = gambar_second("/foto/kegiatan/".explode("|",$b->kg_foto)[0]);
        $b->kg_desc = substr($b->kg_desc, 0,150)."...lihat selengkapnya";
      }
      return response()->json(['result' => 'success', 'title' => 'Kegiatan berhasil ditemukan','data'=>$Kegiatan]);
    }
    public function apiDetailKegiatan($id,Request $request){
      $Kegiatan = Kegiatan::where("kg_id",$id)->first();
      if(!$Kegiatan)
        return response()->json(['result' => 'error', 'title' => 'Kegiatan tidak ditemukan']);
      $fotox = explode("|",$Kegiatan->kg_foto);
      $foto = [];
      for($i=0;$i<count($fotox);$i++){
        array_push($foto, gambar_second("/foto/kegiatan/".$fotox[$i]));
      }
      $Kegiatan->kg_foto=$foto;
      return response()->json(['result' => 'success', 'title' => 'Kegiatan berhasil ditemukan','data'=>$Kegiatan]);
    }
    public function webKegiatan(Request $request){
      $q=null;
      $Kegiatan = Kegiatan::orderBy("kg_tanggal","desc");
      if($request->has('q')){
        if($request->q!="" && $request->q!=null){
          $q=$request->q;
          $Kegiatan = $Kegiatan->where("kg_judul","like","%".$q."%")->orWhere("kg_desc","like","%".$q."%");
        }
      }
      $Kegiatan = $Kegiatan->paginate(5);
      $Kegiatan->appends(['q' => $q]);
      foreach($Kegiatan as $b){
        $b->kg_foto = gambar_second("/foto/kegiatan/".explode("|",$b->kg_foto)[0]);
        $b->kg_desc = substr($b->kg_desc, 0,150)."...lihat selengkapnya";
      }
      return response()->json(['result' => 'success', 'title' => 'Kegiatan berhasil ditemukan','data'=>$Kegiatan]);
    }
    public function webDetailKegiatan($id,Request $request){
      $Kegiatan = Kegiatan::where("kg_id",$id)->first();
      if(!$Kegiatan)
        return response()->json(['result' => 'error', 'title' => 'Kegiatan tidak ditemukan']);
      $fotox = explode("|",$Kegiatan->kg_foto);
      $foto = [];
      for($i=0;$i<count($fotox);$i++){
        array_push($foto, gambar_second("/foto/kegiatan/".$fotox[$i]));
      }
      $Kegiatan->kg_foto=$foto;
      return view("normal.kegiatan",compact("Kegiatan"));
    }
}
