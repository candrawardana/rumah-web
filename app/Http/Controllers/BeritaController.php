<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use Storage;
use Auth;
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
    public function tambahBerita(Request $request){
      if(Auth::user()->jenis!="Administrator"){
        return view("errors.404");
      }
      $Berita = new Berita();
      $Berita->title= $request->title;
      $Berita->tempat = $request->tempat;
      $Berita->content = $request->content;
      $Berita->user_id = Auth::user()->id;
      $Berita->thumbnail = "";
      $time = strtotime($request->tanggal);
      $Berita->tanggal = date('Y-m-d',$time);
      $Berita->save();
      if(!$Berita)
        return redirect()->back()->with("error","Gagal");
      if($request->hasfile('thumbnail'))
         {
            $request->file('thumbnail');
            Storage::putFileAs(
              "berita/".$Berita->id,
              $request->file('thumbnail'),
              $request->file('thumbnail')->getClientOriginalName()
            );
            $Berita->thumbnail = $request->file('thumbnail')->getClientOriginalName();
            $Berita->save();
        }
      return redirect()->back()->with("success","Berhasil menambahkan berita");
    }
    public function hapusBerita($id){
      if(Auth::user()->jenis!="Administrator"){
        return view("errors.404");
      }
      $Berita = Berita::where("id",$id)->first();
      if(!$Berita)
        return view("errors.404");
      if(Storage::exists("berita/".$id)){
          Storage::deleteDirectory("berita/".$id);
      }
      $Berita->delete();
      return redirect()->back()->with("success","Berhasil menghapus berita");
    }
    public function thumbnail($id,$thumbnail){
        if(Storage::exists("berita/".$id."/".$thumbnail)){
            if(request()->has('download'))
                return Storage::download("berita/".$id."/".$thumbnail);
            return Storage::get("berita/".$id."/".$thumbnail);
        }
        else return "Gagal membuka file, kemungkinan file tidak ada atau error";
    }
}
