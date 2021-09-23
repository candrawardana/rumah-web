<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengumuman;
class PengumumanController extends Controller
{
    //
    public function apiPengumuman(Request $request){
      $Pengumuman = Pengumuman::orderBy("pg_tanggal","desc")->get();
      return response()->json(['result' => 'success', 'title' => 'Pengumuman berhasil ditemukan','data'=>$Pengumuman]);
    }
}
