<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use Storage;
use Auth;

class KegiatanController extends Controller
{
    public function apiKegiatan(Request $request){
      $q=null;
      $Kegiatan = Kegiatan::orderBy("tanggal","desc");
      if($request->has('q')){
        if($request->q!="" && $request->q!=null){
          $q=$request->q;
          $Kegiatan = $Kegiatan->where("kg_judul","like","%".$q."%")->orWhere("kg_desc","like","%".$q."%");
        }
      }
      $Kegiatan = $Kegiatan->paginate(10);
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
      $Kegiatan = Kegiatan::orderBy("tanggal","desc");
      if($request->has('q')){
        if($request->q!="" && $request->q!=null){
          $q=$request->q;
          $Kegiatan = $Kegiatan->where("kg_judul","like","%".$q."%")->orWhere("kg_desc","like","%".$q."%");
        }
      }
      $Kegiatan = $Kegiatan->paginate(6);
      $Kegiatan->appends(['q' => $q]);
      foreach($Kegiatan as $b){
        $b->kg_foto = gambar_second("/foto/kegiatan/".explode("|",$b->kg_foto)[0]);
        $b->kg_desc = substr($b->kg_desc, 0,150)."...lihat selengkapnya";
      }
      return view("normal.semua-kegiatan",compact("Kegiatan","q"));
    }
    public function webDetailKegiatan($id,Request $request){
      $Kegiatan = Kegiatan::where("kg_id",$id)->first();
      if(!$Kegiatan)
        return view("errors.404");
      $fotox = explode("|",$Kegiatan->kg_foto);
      $foto = [];
      for($i=0;$i<count($fotox);$i++){
        array_push($foto, gambar_second("/foto/kegiatan/".$fotox[$i]));
      }
      $Kegiatan->kg_foto=$foto;
      return view("normal.kegiatan",compact("Kegiatan"));
    }
    public function tambahKegiatan(Request $request){
      if(Auth::user()->jenis!="Administrator"){
        return view("errors.404");
      }
      $Kegiatan = new Kegiatan();
      $Kegiatan->kg_tanggal= $request->kg_tanggal;
      $Kegiatan->kg_judul= $request->kg_judul;
      $Kegiatan->kg_lokasi = $request->kg_lokasi;
      $Kegiatan->kg_desc = $request->kg_desc;
      $Kegiatan->kg_foto = "";
      $time = strtotime($request->kg_tanggal);
      $Kegiatan->tanggal = date('Y-m-d',$time);
      $Kegiatan->save();
      if(!$Kegiatan)
        return redirect()->back()->with("error","Gagal");
      $kg_foto="";
      $i=0;
      if($request->hasfile('kg_foto'))
         {
            foreach($request->file('kg_foto') as $file)
            {
                $nama_file = $Kegiatan->kg_id."_".$i.".".strtolower(substr(strrchr($file->getClientOriginalName(), '.'), 1));
                Storage::putFileAs(
                  "foto/kegiatan/",
                  $file,
                  $nama_file
                );
                if($kg_foto=="")
                  $kg_foto=$nama_file;
                else
                  $kg_foto=$kg_foto."|".$nama_file;
                $i++;
            }
         }
      $Kegiatan->kg_foto = $kg_foto;
      $Kegiatan->save();
      return redirect()->back()->with("success","Berhasil menambahkan kegiatan");
    }
    public function hapusKegiatan($id){
      if(Auth::user()->jenis!="Administrator"){
        return view("errors.404");
      }
      $Kegiatan = Kegiatan::where("kg_id",$id)->first();
      if(!$Kegiatan)
        return view("errors.404");
      $fotox = explode("|",$Kegiatan->kg_foto);
      for($i=0;$i<count($fotox);$i++){
        if(Storage::exists("foto/kegiatan/".$fotox[$i])){
          Storage::delete("foto/kegiatan/".$fotox[$i]);
        }
      }
      $Kegiatan->delete();
      return redirect()->back()->with("success","Berhasil menghapus kegiatan");
    }
}