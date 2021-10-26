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
use App\Models\Dana;
use App\Models\UangSyariah;
use App\Models\Pengumuman;
use App\Models\Kegiatan;

class LaporanController extends Controller
{
    public function tabungan(Request $request){
        if(Auth::user()->jenis!="Administrator"){
            return view('errors.404');
        }
        $Santri = Santri::orderBy("s_nis","asc")->select("s_nis","s_nama")->get();
        foreach($Santri as $s){
            $Dana = Dana::where("related_id",$s->s_nis)->where("jenis","tabungan")->first();
            if(!$Dana){
                $Dana = new Dana();
                $Dana->jenis = "tabungan";
                $Dana->related_id = $s->s_nis;
                $Tabungan = Tabungan::where("s_nis",$s->s_nis)->orderBy("tanggal","desc")->first();
                $d = 0;
                if($Tabungan)
                    $d = $Tabungan->t_saldo;
                $Dana->dana=$d;
                $Dana->save();
            }
            $s->tabungan = $Dana->dana;
        }
        return view('admin.cetak-tabungan', compact("Santri"));
    }
    public function hafalan(Request $request){
        if(Auth::user()->jenis!="Administrator"){
            return view('errors.404');
        }
        return view('admin.laporan-hafalan');
    }
    public function hafalanCetak(Request $request){
        if(Auth::user()->jenis!="Administrator"){
            return view('errors.404');
        }
        if(!$request->has("mtgl")){
            return view('errors.404');
        }
        $tanggal = strtotime($request->mtgl);
        $tanggal = date('Y-m-d',$tanggal);
        $Hafalan = Hafalan::where("tanggal",$tanggal)
        ->leftJoin("santri","santri.s_nis","=","hafalan.s_nis")
        ->select("hafalan.*","santri.s_nama")->orderBy("santri.s_nama","asc")->get();
        return view('admin.cetak-hafalan', compact("tanggal","Hafalan"));
    }
    public function hafalanBaru(Request $request){
        if(Auth::user()->jenis!="Administrator"){
            return view('errors.404');
        }
        return view('admin.laporan-hafalan-baru');
    }
    public function hafalanBaruCetak(Request $request){
        if(Auth::user()->jenis!="Administrator"){
            return view('errors.404');
        }
        if(!$request->has("mtgl")){
            return view('errors.404');
        }
        $tanggal = strtotime($request->mtgl);
        $tanggal = date('Y-m-d',$tanggal);
        $HafalanBaru = HafalanBaru::where("tanggal",$tanggal)
        ->leftJoin("santri","santri.s_nis","=","hafalanbaru.s_nis")
        ->select("hafalanbaru.*","santri.s_nama")->orderBy("santri.s_nama","asc")->get();
        return view('admin.cetak-hafalan-baru', compact("tanggal","HafalanBaru"));
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
        $UangSyariah = $UangSyariah->leftJoin("santri","santri.s_nis","=","uangsyariah.s_nis")
        ->select("uangsyariah.*","santri.s_nama")->get();
        return view('admin.cetak-uang-syariah', compact("jenis","UangSyariah"));
    }
}
