<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Kegiatan;
use Storage;
use Auth;

class DashboardController extends Controller
{
    public function policy()
    {
        return view('normal.policy');
    }

    public function home()
    {
        if(Auth::user()){
            if(Auth::user()->jenis=="Administrator"){
                return view('admin.home');
            }
        }
        $Kegiatan = Kegiatan::orderBy("kg_tanggal","desc")->limit(3)->get();
        foreach($Kegiatan as $b){
            $b->kg_foto = gambar_second("/foto/kegiatan/".explode("|",$b->kg_foto)[0]);
            $b->kg_desc = substr($b->kg_desc, 0,150)."...lihat selengkapnya";
        }
        $Galleryx=Storage::allFiles("gallery/");
        $Gallery=[];
        foreach($Galleryx as $g){
            $time = Storage::lastModified($g);
            array_push($Gallery,url($g)."?t=".$time);
        }
        return view('welcome',compact("Kegiatan","Gallery"));
    }
    public function gallery($file){
        if(Storage::exists("gallery/".$file)){
            if(request()->has('download'))
                return Storage::download("gallery/".$file);
            return Storage::get("gallery/".$file);
        }
        else return "Gagal membuka file, kemungkinan file tidak ada atau error";
    }
}
