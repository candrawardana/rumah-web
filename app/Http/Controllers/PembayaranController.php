<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Dana;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class PembayaranController extends Controller
{
    public function apiPembayaran(Request $request){
      $pembayaran = Pembayaran::orderBy("tanggal","desc");
      if(Auth::user()->jenis!="Administrator"){
        $pembayaran = $pembayaran->where("user_id",Auth::user()->id);
      }
      $pembayaran = $pembayaran->paginate(15);
      foreach($pembayaran as $b){
        $b->pembuat = detail_pembuat($b->user_id);
      }
      return response()->json(['result' => 'success', 'title' => 'Pembayaran berhasil ditemukan','data'=>$pembayaran]);
    }
    public function apiDetailPembayaran($id,Request $request){
      $pembayaran = Pembayaran::find($id);
      if(!$pembayaran)
        return response()->json(['result' => 'error', 'title' => 'Pembayaran tidak ditemukan']);
      $pembayaran->pembuat = detail_pembuat($pembayaran->user_id);
      return response()->json(['result' => 'success', 'title' => 'Pembayaran berhasil ditemukan','data'=>$pembayaran]);
    }
    public function webPembayaran(Request $request){
      $q="";
      $Pembayaran = Pembayaran::orderBy("pembayaran_anggota.tanggal","desc");
      $Pembayaran = $Pembayaran->leftJoin("users","pembayaran_anggota.user_id","=","users.id");
      $Pembayaran = $Pembayaran->select("users.name","pembayaran_anggota.*");
      if(Auth::user()->jenis!="Administrator"){
        $Pembayaran = $Pembayaran->where("user_id",Auth::user()->id);
      }
      else{
        if($request->has('q')){
          if($request->q!="" && $request->q!=null){
            $q=$request->q;
            $Pembayaran = $Pembayaran->where("users.name","like","%".$q."%");
          }
        }
      }
      $Pembayaran = $Pembayaran->paginate(50);
      $Pembayaran->appends(['q' => $q]);
      return view("admin.pembayaran",compact("Pembayaran","q"));
    }
    public function editPembayaran($id){
      if(Auth::user()->jenis!="Administrator"){
        return view("errors.404");
      }
      $Pembayaran = Pembayaran::where("pembayaran_anggota.id",$id)->leftJoin("users","pembayaran_anggota.user_id","=","users.id")
                      ->select("users.name","pembayaran_anggota.*")->first();
      if(!$Pembayaran)
        return view("errors.404");
      $tanggal = strtotime($Pembayaran->tanggal);
      $tanggal = date('d-m-Y',$tanggal);
      $Pembayaran->tanggal=$tanggal;
      return view("admin.edit-pembayaran",compact("Pembayaran"));
    }
    public function editPembayaranProses(Request $request,$id){
      if(Auth::user()->jenis!="Administrator"){
        return view("errors.404");
      }
      $Pembayaran=Pembayaran::find($id);
      if(!$Pembayaran)
        return redirect("/pembayaran")->with("error","Gagal Menyimpan");
      $Pembayaran->jenis = $request->jenis;
      $tanggal = strtotime($request->tanggal);
      $tanggal = date('Y-m-d',$tanggal);
      $Pembayaran->tanggal = $tanggal;
      $nilai_awal = $Pembayaran->nilai;
      $Pembayaran->nilai = $request->nilai;
      $Pembayaran->save();
      if($request->dana=="1"){
        tambah_dana($nilai_awal+$request->nilai);
      }
      return redirect("/pembayaran")->with("success","Berhasil mengubah data");
    }
    public function hapusPembayaran($id){
      if(Auth::user()->jenis!="Administrator"){
        return view("errors.404");
      }
      $Pembayaran = Pembayaran::where("pembayaran_anggota.id",$id)->leftJoin("users","pembayaran_anggota.user_id","=","users.id")
                      ->select("users.name","pembayaran_anggota.*")->first();
      if(!$Pembayaran)
        return view("errors.404");
      $tanggal = strtotime($Pembayaran->tanggal);
      $tanggal = date('d-m-Y',$tanggal);
      $Pembayaran->tanggal=$tanggal;
      return view("admin.hapus-pembayaran",compact("Pembayaran"));
    }
    public function hapusPembayaranProses(Request $request,$id){
      if(Auth::user()->jenis!="Administrator"){
        return view("errors.404");
      }
      $Pembayaran=Pembayaran::find($id);
      if(!$Pembayaran)
        return redirect("/pembayaran")->with("error","Gagal Menyimpan");
      if($Pembayaran->delete() && $request->dana=="1"){
        tambah_dana(-$Pembayaran->nilai);
      }
      return redirect("/pembayaran")->with("success","Berhasil menghapus data");
    }
    public function tambahPembayaran(Request $request){
      if(Auth::user()->jenis!="Administrator"){
        return view("errors.404");
      }
      $User = User::where("username",$request->username)->first();
      if(!$User)
        return redirect()->back()->with("error","Akun tidak ditemukan");
      $Pembayaran = new Pembayaran();
      $Pembayaran->user_id = $User->id;
      $Pembayaran->jenis = $request->jenis;
      $tanggal = strtotime($request->tanggal);
      $tanggal = date('Y-m-d',$tanggal);
      $Pembayaran->tanggal = $tanggal;
      $Pembayaran->nilai = $request->nilai;
      $Pembayaran->save();
      if(!$Pembayaran)
        return redirect()->back()->with("error","Gagal Menyimpan");
      if($request->dana=="1"){
        tambah_dana($request->nilai);
      }
      return redirect()->back()->with("success","Berhasil menambahkan pembayaran");
    }
    public function pembelian(Request $request){
      $pembayaran = Pembayaran::orderBy("tanggal","desc");
      if(Auth::user()->jenis!="Administrator"){
        $pembayaran = $pembayaran->where("user_id",Auth::user()->id);
      }
      $pembayaran = $pembayaran->paginate(50);
      foreach($pembayaran as $b){
        $b->pembuat = detail_pembuat($b->user_id);
      }
      return response()->json(['result' => 'success', 'title' => 'Pembayaran berhasil ditemukan','data'=>$pembayaran]);
    }
    public function bagiHasil(Request $request){
      $pembayaran = Pembayaran::orderBy("tanggal","desc");
      if(Auth::user()->jenis!="Administrator"){
        $pembayaran = $pembayaran->where("user_id",Auth::user()->id);
      }
      $pembayaran = $pembayaran->paginate(50);
      foreach($pembayaran as $b){
        $b->pembuat = detail_pembuat($b->user_id);
      }
      return response()->json(['result' => 'success', 'title' => 'Pembayaran berhasil ditemukan','data'=>$pembayaran]);
    }
}
