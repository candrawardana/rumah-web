<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Pembelian;
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
    public function webPembayaran(Request $request, $cetak=""){
      $q="";
      $Pembayaran = Pembayaran::orderBy("pembayaran_anggota.tanggal","desc");
      $Pembayaran = $Pembayaran->leftJoin("users","pembayaran_anggota.user_id","=","users.id");
      $Pembayaran = $Pembayaran->select("users.name","pembayaran_anggota.*");
      $pengguna = "";
      if($request->q!="" && $request->q!=null){
        $q=$request->q;
      }
      if(Auth::user()->jenis!="Administrator"){
        $q = $Auth::user()->username;
      }
      $pengguna = "";
      if($q!=""){
        $Pembayaran = $Pembayaran->where("users.username",$q);
        $User = User::where("username",$q)->first();
        if($User)
          $pengguna = $User->name;
      }
      if($cetak=="cetak"){
        $Pembayaran = $Pembayaran->get();
        return view("admin.cetak-pembayaran",compact("Pembayaran","q","pengguna"));
      }
      $Pembayaran = $Pembayaran->paginate(50);
      $Pembayaran->appends(['q' => $q]);
      return view("admin.pembayaran",compact("Pembayaran","q","pengguna"));
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
        tambah_dana($nilai_awal+$request->nilai,"k.".$Pembayaran->user_id);
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
        tambah_dana(-$Pembayaran->nilai,"k.".$Pembayaran->user_id);
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
        tambah_dana($request->nilai,"k.".$Pembayaran->user_id);
      }
      return redirect()->back()->with("success","Berhasil menambahkan pembayaran");
    }


    public function pembelian($q,$view){
      if(Auth::user()->jenis!="Administrator"){
        $q=Auth::user()->username;
      }
      $Pembelian = Pembelian::orderBy("pembelian_koperasi.nama","desc");
      $Pembelian = $Pembelian->leftJoin("users","pembelian_koperasi.user_id","=","users.id");
      $Pembelian = $Pembelian->select("users.name","pembelian_koperasi.*");
      $pengguna = "";
      if($q!=""){
        $Pembelian = $Pembelian->where("users.username",$q);
        $User = User::where("username",$q)->first();
        if($User)
          $pengguna = $User->name;
      }
      $Pembelian = $Pembelian->get();
      $total=[];
      foreach($Pembelian as $p){
        $p->hitung = hitung_pembelian_koperasi($p);
      }
      return view($view,compact("Pembelian","total","q","pengguna"));
    }
    public function webPembelian(Request $request, $cetak=""){
      $q="";
      if($request->has('q')){
        $q=$request->q;
      }
      if($cetak=="cetak")
        return $this->pembelian($q,"admin.cetak-pembelian");
      return $this->pembelian($q,"admin.pembelian");
    }
    public function editPembelian($id){
      if(Auth::user()->jenis!="Administrator"){
        return view("errors.404");
      }
      $Pembelian = Pembelian::where("pembelian_koperasi.id",$id);
      $Pembelian = $Pembelian->leftJoin("users","pembelian_koperasi.user_id","=","users.id");
      $Pembelian = $Pembelian->select("users.name","pembelian_koperasi.*");
      $Pembelian = $Pembelian->first();
      if(!$Pembelian)
        return view("errors.404");
      $tanggal = strtotime($Pembelian->tanggal);
      $tanggal = date('d-m-Y',$tanggal);
      $Pembelian->tanggal=$tanggal;
      return view("admin.edit-pembelian",compact("Pembelian"));
    }
    public function editPembelianProses(Request $request,$id){
      if(Auth::user()->jenis!="Administrator"){
        return view("errors.404");
      }
      $Pembelian=Pembelian::find($id);
      if(!$Pembelian)
        return redirect("/pembelian")->with("error","Gagal Menyimpan");
      if($request->terjual>$Pembelian->jumlah){
        return redirect()->back()->with("error","Jumlah terjual melebihi stok");
      }
      $selisih = ($request->terjual-$Pembelian->terjual)*$Pembelian->jual;
      if($request->dana=="1" && lihat_dana("k.".$Pembelian->user_id)<(-$selisih)){
        return redirect()->back()->with("error","Dana dia tidak mencukupi");
      }
      $tanggal = strtotime($request->tanggal);
      $tanggal = date('Y-m-d',$tanggal);
      $Pembelian->tanggal = $tanggal;
      $Pembelian->faktur = $request->faktur;
      $Pembelian->kode = $request->kode;
      $Pembelian->nama = $request->nama;
      $Pembelian->terjual = $request->terjual;
      $Pembelian->save();
      if($request->dana=="1"){
        tambah_dana($selisih,"k.".$Pembelian->user_id);
      }
      return redirect("/pembelian")->with("success","Berhasil mengubah data");
    }
    public function hapusPembelian($id){
      if(Auth::user()->jenis!="Administrator"){
        return view("errors.404");
      }
      $Pembelian = Pembelian::where("pembelian_koperasi.id",$id);
      $Pembelian = $Pembelian->leftJoin("users","pembelian_koperasi.user_id","=","users.id");
      $Pembelian = $Pembelian->select("users.name","pembelian_koperasi.*");
      $Pembelian = $Pembelian->first();
      if(!$Pembelian)
        return view("errors.404");
      $tanggal = strtotime($Pembelian->tanggal);
      $tanggal = date('d-m-Y',$tanggal);
      $Pembelian->tanggal=$tanggal;
      return view("admin.hapus-pembelian",compact("Pembelian"));
    }
    public function hapusPembelianProses(Request $request,$id){
      if(Auth::user()->jenis!="Administrator"){
        return view("errors.404");
      }
      $Pembelian=Pembelian::find($id);
      if(!$Pembelian)
        return redirect("/pembelian")->with("error","Gagal Menyimpan");
      $selisih = ($Pembelian->terjual*$Pembelian->jual)-($Pembelian->modal*$Pembelian->jumlah);
      if($request->dana=="1" && lihat_dana("k.".$Pembelian->user_id)<$selisih){
        return redirect()->back()->with("error","Dana dia tidak mencukupi");
      }
      if($Pembelian->delete() && $request->dana=="1"){
        tambah_dana(-$selisih,"k.".$Pembelian->user_id);
      }
      return redirect("/pembelian")->with("success","Berhasil menghapus data");
    }
    public function tambahPembelian(Request $request){
      if(Auth::user()->jenis!="Administrator"){
        return view("errors.404");
      }
      $User = User::where("username",$request->username)->first();
      if(!$User)
        return redirect()->back()->with("error","Akun tidak ditemukan");

      if($request->terjual>$request->jumlah){
        return redirect()->back()->with("error","Jumlah terjual melebihi stok");
      }
      if($request->jual<=$request->modal){
        return redirect()->back()->with("error","Koperasi ini tidak ada untungnya");
      }
      if($request->modal == 0 || $request->jumlah == 0){
        return redirect()->back()->with("error","Jumlah yang dijual tidak masuk akal");
      }

      $Pembelian = new Pembelian();
      $Pembelian->user_id = $User->id;
      $tanggal = strtotime($request->tanggal);
      $tanggal = date('Y-m-d',$tanggal);
      $Pembelian->tanggal = $tanggal;
      $Pembelian->faktur = $request->faktur;
      $Pembelian->kode = $request->kode;
      $Pembelian->nama = $request->nama;
      $Pembelian->modal = $request->modal;
      $Pembelian->jumlah = $request->jumlah;
      $Pembelian->jual = $request->jual;
      $Pembelian->terjual = $request->terjual;
      $harga = ($request->jual*$request->terjual)-($request->jumlah*$request->modal);
      if($request->dana=="1" && lihat_dana("k.".$User->id)<(-$harga)){
        return redirect()->back()->with("error","Dana ".$User->name." tidak mencukupi");
      }
      $Pembelian->save();
      if(!$Pembelian)
        return redirect()->back()->with("error","Gagal Menyimpan");
      if($request->dana=="1"){
        tambah_dana($harga,"k.".$Pembelian->user_id);
      }
      return redirect()->back()->with("success","Berhasil menambahkan pembelian dengan biaya Rp. ".$harga);
    }


    public function bagiHasil(Request $request, $cetak=""){
      $q="";
      if($request->has('q')){
        $q=$request->q;
      }
      if($cetak=="cetak")
        return $this->pembelian($q,"admin.cetak-bagi-hasil");
      return $this->pembelian($q,"admin.bagi-hasil");
    }
}
