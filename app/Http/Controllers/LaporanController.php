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

class LaporanController extends Controller
{
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
        if(Auth::user()->jenis!="Administrator"){
            return view('errors.404');
        }
        return view('admin.laporan-hafalan-baru');
    }
    public function uangSyariah(Request $request){
        if(Auth::user()->jenis!="Administrator"){
            return view('errors.404');
        }
        return view('admin.laporan-uang-syariah');
    }
    public function uangSyariahCetak(Request $request){
        if(Auth::user()->jenis!="Administrator"){
            return view('errors.404');
        }
        $UangSyariah = UangSyariah::orderBy("tanggal","desc");
        $jenis = "-";
        if($request->has("submit1")){
            $jenis = "Pada Bulan ".bulan_huruf($request->l_pilihan) ."Tahun ".$request->tahun1;
            $UangSyariah = $UangSyariah->where("tanggal", "LIKE", $request->tahun1."-".$request->l_pilihan."-%");
        }
        else if($request->has("submit2")){
            $jenis = "Untuk Bulan ".bulan_huruf($request->l_pilihan2);
            $UangSyariah = $UangSyariah->where("u_bulan", "LIKE", $request->l_pilihan2);
        }
        else if($request->has("submit3")){
            $jenis = "Tanggal ".$request->l_start." s/d ".$request->l_end;
            $awal = strtotime($request->l_start);
            $akhir = strtotime($request->l_end);
            $awal = date('Y-m-d',$awal);
            $akhir = date('Y-m-d',$akhir);
            $UangSyariah = $UangSyariah->where("tanggal", ">=", $awal)
                            ->where("tanggal", "<=", $akhir);
        }
        else if($request->has("submit4")){
            $jenis = "Tahun ".$request->l_tahun;
            $UangSyariah = $UangSyariah->where("tanggal", "LIKE", $request->l_tahun."-%");
        }
        else{
            return view('errors.404');
        }
        $UangSyariah = $UangSyariah->get();
        foreach($UangSyariah as $u){
            $u->s_nama = "-";
            $Santri = Santri::find($u->s_nis);
            if($Santri)
                $u->s_nama = $Santri->s_nama;
        }
        return view('admin.cetak-uang-syariah', compact("jenis","UangSyariah"));
    }
}
