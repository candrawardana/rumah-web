<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BeritaController extends Controller
{
    //
    public function apiberita(Request $request){
    $berita = [
      "id"=>"1234",
      "thumbnail"=>"assets/ph1.png",
      "tanggal"=>"8 Desember 2020",
      "tempat"=>"Medan",
      "pembuat"=>[
        "id"=>"1234",
        "name"=>"Ustadz Chandra",
        "level"=>"Akademik",
        "photo"=>"assets/ph2.png",
      ],
      "title"=>"Warga Palestina Iringi Pemakaman Pria yang Ditembak Tentara Israel",
      "content"=>"Sejumlah warga membawa jenazah Raed Jadallah (39) yang tewas ditembak tentara Israel di wilayah Tepi Barat. Melansir Reuters, Rabu (1/9/2021), Kementerian Kesehatan Palestina menyebut penembakan itu terjadi di dekat desa Beit Ur Al-Tahta, sebelah barat kota Ramallah, Tepi Barat, pada Selasa (31/8) malam waktu setempat."
    ];
    return response()->json(['result' => 'success', 'title' => 'Kamu telah berhasil login','data'=>$berita]);
    }
}
