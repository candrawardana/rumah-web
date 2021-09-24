<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Kegiatan;

class DashboardController extends Controller
{
    public function welcome()
    {
        $Kegiatan = Kegiatan::orderBy("kg_tanggal","desc")->limit(3)->get();
        foreach($Kegiatan as $b){
            $b->kg_foto = gambar_second("/foto/kegiatan/".explode("|",$b->kg_foto)[0]);
            $b->kg_desc = substr($b->kg_desc, 0,150)."...lihat selengkapnya";
        }
        return view('welcome',compact("Kegiatan"));
    }
    public function policy()
    {
        return view('normal.policy');
    }

    public function home()
    {
        return view('admin.home');
    }
}
