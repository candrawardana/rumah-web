<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Kegiatan;
use App\Models\Berita;
use App\Models\Santri;
use App\Models\Pembelian;
use App\Models\User;
use Storage;
use Auth;
use Redirect;

class DashboardController extends Controller
{
    public function policy()
    {
        return view('normal.policy');
    }

    public function notifikasi()
    {
        return view('normal.notifikasi');
    }

    public function home()
    {
        $view = "welcome";
        if(Auth::user()){
            if(Auth::user()->jenis=="Administrator"){
                $view = 'admin.home';
            }
        }
        $Dana = nomor(lihat_dana());
        $Santri = Santri::count();
        $Donator = User::where("jenis","donator")->count();
        $Koperasi = Pembelian::count();
        $Kegiatan = Kegiatan::orderBy("kg_tanggal","desc")->limit(3)->get();
        foreach($Kegiatan as $b){
            $b->kg_foto = gambar_second("/foto/kegiatan/".explode("|",$b->kg_foto)[0]);
            $b->kg_desc = substr($b->kg_desc, 0,150)."...lihat selengkapnya";
        }
        $Berita = Berita::orderBy("tanggal","desc")->limit(3)->get();
        foreach($Berita as $b){
            $b->pembuat = detail_pembuat($b->user_id);
            $b->thumbnail = gambar_thumbnail("berita",$b->id,$b->thumbnail);
            $b->content = substr($b->content, 0,150)."...lihat selengkapnya";
          }
        $Galleryx=collect(Storage::allFiles("gallery/"))
        ->sortBy(function ($file) {
            return Storage::lastModified($file);
        });
        $Gallery=[];
        foreach($Galleryx as $g){
            $time = Storage::lastModified($g);
            array_push($Gallery,url($g)."?t=".$time);
        }
        return view($view,compact("Kegiatan","Gallery","Berita","Dana","Santri","Donator","Koperasi"));
    }
    public function gallery($file){
        if(Storage::exists("gallery/".$file)){
            if(request()->has('download'))
                return Storage::download("gallery/".$file);
            return Storage::get("gallery/".$file);
        }
        else return "Gagal membuka file, kemungkinan file tidak ada atau error";
    }
    public function galleryHapus($nomor){
        if(Auth::user()->jenis!="Administrator"){
            return Redirect::back();
        }
        $Galleryx=collect(Storage::allFiles("gallery/"))
        ->sortBy(function ($file) {
            return Storage::lastModified($file);
        });
        $Gallery=[];
        foreach($Galleryx as $g){
            array_push($Gallery,$g);
        }
        Storage::delete($Gallery[$nomor]);
        return Redirect::back();
    }
    public function galleryTambah(Request $request){
        if(Auth::user()->jenis!="Administrator"){
            return Redirect::back();
        }
        if($request->hasFile('file')){
            if(Storage::exists("gallery/".$request->file('file')->getClientOriginalName())){
                Storage::delete("gallery/".$request->file('file')->getClientOriginalName());
            }
            $path = Storage::putFileAs(
                "gallery/",
                $request->file('file'),
                $request->file('file')->getClientOriginalName()
            );
        }
        return Redirect::back()->with('success', 'Berhasil mengupload foto!');
    }
}
