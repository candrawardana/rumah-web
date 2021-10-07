<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengumuman;
use Auth;
use Redirect;
class PengumumanController extends Controller
{
    //
    public function apiPengumuman(Request $request){
      $Pengumuman = Pengumuman::orderBy("tanggal","desc")->get();
      return response()->json(['result' => 'success', 'title' => 'Pengumuman berhasil ditemukan','data'=>$Pengumuman]);
    }
    public function webPengumuman(Request $request,$id=""){
      $Pengumuman = Pengumuman::orderBy("tanggal","desc");
      if($id!="")
        $Pengumuman = $Pengumuman->where("pg_id",$id);
      $Pengumuman = $Pengumuman->get();
      return view("normal.pengumuman",compact("Pengumuman"));
    }
    public function tambahPengumuman(Request $request){
      if(Auth::user()->jenis=="Administrator"){
        $Pengumuman = Pengumuman::find($request->pg_id);
        if(!$Pengumuman){
          $Pengumuman = new Pengumuman();
        }
        $Pengumuman->pg_tanggal = $request->pg_tanggal;
        $Pengumuman->pg_judul = $request->pg_judul;
        $Pengumuman->pg_desc = $request->pg_desc;
        $time = strtotime($request->pg_tanggal);
        $Pengumuman->tanggal = date('Y-m-d',$time);
        $Pengumuman->save();
        return Redirect::back()->with("success","Berhasil menambahkan pengumuman");
      }
      return view("errors.404");
    }
    public function hapusPengumuman($id){
      if(Auth::user()->jenis=="Administrator"){
        Pengumuman::where("pg_id",$id)->delete();
        return Redirect::back()->with("success","Berhasil menghapus pengumuman");
      }
      return view("errors.404");
    }
}
