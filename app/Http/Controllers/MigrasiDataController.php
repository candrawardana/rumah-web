<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\WaliOrangTua;
use App\Models\Santri;
use App\Models\Ayah;
use App\Models\Ibu;
use App\Models\Hafalan;
use App\Models\HafalanBaru;
use App\Models\Kesalahan;
use App\Models\Tabungan;
use App\Models\UangSyariah;
use App\Models\Pengumuman;
use App\Models\Kegiatan;

class MigrasiDataController extends Controller
{
    //
    public function tabungan(Request $request){
        if(Auth::user()->jenis=="Administrator"){
            $p = 1;
            if($request->has("page")){
                $p=$request->page;
            }
            $Tabungan = Tabungan::orderBy("id","asc")->paginate(2000);
            $count = 0;
            foreach($Tabungan as $d){
                $time = strtotime($d->t_tanggal);
                $d->tanggal = date('Y-m-d',$time);
                $d->save();
                $count++;
            }
            $p++;
            if($count==0)
                return "selesai";
            return "<a href='".url("migrasi/tabungan?page=".$p)."'>Lanjut ke ".$p."</a>";
        }
    }
    public function hafalan(Request $request){
        if(Auth::user()->jenis=="Administrator"){
            $p = 1;
            if($request->has("page")){
                $p=$request->page;
            }
            $Hafalan = Hafalan::orderBy("h_id","asc")->paginate(2000);
            $count = 0;
            foreach($Hafalan as $d){
                $time = strtotime($d->h_tanggal);
                $d->tanggal = date('Y-m-d',$time);
                $d->save();
                $count++;
            }
            $p++;
            if($count==0)
                return "selesai";
            return "<a href='".url("migrasi/hafalan?page=".$p)."'>Lanjut ke ".$p."</a>";
        }
    }
    public function hafalanBaru(Request $request){
        if(Auth::user()->jenis=="Administrator"){
            $p = 1;
            if($request->has("page")){
                $p=$request->page;
            }
            $HafalanBaru = HafalanBaru::orderBy("hb_id","asc")->paginate(2000);
            $count = 0;
            foreach($HafalanBaru as $d){
                $time = strtotime($d->hb_tanggal);
                $d->tanggal = date('Y-m-d',$time);
                $d->save();
                $count++;
            }
            $p++;
            if($count==0)
                return "selesai";
            return "<a href='".url("migrasi/hafalan-baru?page=".$p)."'>Lanjut ke ".$p."</a>";
        }
    }
    public function kesalahan(Request $request){
        if(Auth::user()->jenis=="Administrator"){
            $p = 1;
            if($request->has("page")){
                $p=$request->page;
            }
            $Kesalahan = Kesalahan::orderBy("id","asc")->paginate(2000);
            $count = 0;
            foreach($Kesalahan as $d){
                $time = strtotime($d->k_tanggal);
                $d->tanggal = date('Y-m-d',$time);
                $d->save();
                $count++;
            }
            $p++;
            if($count==0)
                return "selesai";
            return "<a href='".url("migrasi/kesalahan?page=".$p)."'>Lanjut ke ".$p."</a>";
        }
    }
    public function uangSyariah(Request $request){
        if(Auth::user()->jenis=="Administrator"){
            $p = 1;
            if($request->has("page")){
                $p=$request->page;
            }
            $UangSyariah = UangSyariah::orderBy("id","asc")->paginate(2000);
            $count = 0;
            foreach($UangSyariah as $d){
                $time = strtotime($d->u_tanggal);
                $d->tanggal = date('Y-m-d',$time);
                $d->save();
                $count++;
            }
            $p++;
            if($count==0)
                return "selesai";
            return "<a href='".url("migrasi/uang-syariah?page=".$p)."'>Lanjut ke ".$p."</a>";
        }
    }
    public function pengumuman(Request $request){
        if(Auth::user()->jenis=="Administrator"){
            $p = 1;
            if($request->has("page")){
                $p=$request->page;
            }
            $Pengumuman = Pengumuman::orderBy("pg_id","asc")->paginate(2000);
            $count = 0;
            foreach($Pengumuman as $d){
                $time = strtotime($d->pg_tanggal);
                $d->tanggal = date('Y-m-d',$time);
                $d->save();
                $count++;
            }
            $p++;
            if($count==0)
                return "selesai";
            return "<a href='".url("migrasi/pengumuman?page=".$p)."'>Lanjut ke ".$p."</a>";
        }
    }
    public function kegiatan(Request $request){
        if(Auth::user()->jenis=="Administrator"){
            $p = 1;
            if($request->has("page")){
                $p=$request->page;
            }
            $Kegiatan = Kegiatan::orderBy("kg_id","asc")->paginate(2000);
            $count = 0;
            foreach($Kegiatan as $d){
                $time = strtotime($d->kg_tanggal);
                $d->tanggal = date('Y-m-d',$time);
                $d->save();
                $count++;
            }
            $p++;
            if($count==0)
                return "selesai";
            return "<a href='".url("migrasi/kegiatan?page=".$p)."'>Lanjut ke ".$p."</a>";
        }
    }
}
