<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Validator;
use Hash;
use Session;
use Redirect;
use App\Models\User;
class PenggunaController extends Controller
{

    public function profil($id="")
    {
//        $User = User::where("id",$id)->whereNotIn("jenis",["ayah_santri","ibu_santri"])->first();
        $User=User::find($id);
        if(!$User){
            $User = Auth::user();
            if(!$User)
                return response()->json(["result"=>"error","title"=>"Gagal mendapatkan data"]);
        }
        $User->foto = pp_check($User->id);
        return ["result"=>"success","title"=>"Berhasil mendapatkan data","data"=>$User];
    }
    public function webprofil($id=""){
        $proses=@$this->profil($id);
        if($proses["result"]=="error")
            return view("errors.404");
        $User=$proses["data"];
        return view("admin.profil",compact("User"));
    }
    public function edit($id=""){
        $proses=@$this->profil($id);
        if($proses["result"]=="error")
            return view("errors.404");
        $User=$proses["data"];
        return view("admin.edit-pengguna",compact("User"));
    }
	public function user(Request $request, $jenis="")
    {
      if(Auth::user()->jenis!="Administrator"){
        return view("errors.404");
      }
    	$Pengguna = User::orderBy("name","asc");
        $jenis_array = ["biasa","donator"];
        if($jenis=="wali")
            $jenis_array = ["ayah_santri","ibu_santri"];
        else if($jenis=="Administrator")
            $jenis_array = ["Administrator","Staff"];
        else{
            $jenis_array = [$jenis];
        }
        if($jenis!=""){
            $Pengguna = $Pengguna->whereIn("jenis",$jenis_array);
        }
    	$q=null;
    	if ($request->has("q")) {
    		$q=$request->q;
	    	$Pengguna = $Pengguna->where("name","like","%".$q."%");
    	}
    	$Pengguna = $Pengguna->paginate(25)->appends(['q' => $q]);
        return view('admin.pengguna',compact("Pengguna","q","jenis","jenis_array"));
    }
    public function save(Request $request)
    {
      if(Auth::user()->jenis!="Administrator"){
        return view("errors.404");
      }
        $rules = [
            'name'                  => 'required|min:3|max:50',
            'password'              => 'required',
            'username'				=> 'required',
            'jenis'                 => 'required'
        ];
  
        $messages = [
            'name.required'         => 'Nama Lengkap wajib diisi',
            'name.min'              => 'Nama lengkap minimal 3 karakter',
            'name.max'              => 'Nama lengkap maksimal 35 karakter',
            'password.required'     => 'Password wajib diisi',
            'tipe.required'         => 'Tipe wajib diisi',
        ];
  
        $validator = Validator::make($request->all(), $rules, $messages);
  
        if($validator->fails()){
            Session::flash('errors', 'Gagal, coba isi dengan benar');
            return Redirect::back();
        }
  		$id=0;
  		if($request->has("id")){
  			if($request->id!="")
  				$id=$request->id;
  		}
  		$user = User::find($id);
  		if(!$user){
	        $user = new User;
  		}
        $user->name = ucwords(strtolower($request->name));
        $user->username = $request->username;
        if($request->email!="")
            $user->email = strtolower($request->email);
        $user->jenis = $request->jenis;
        $user->password = Hash::make($request->password);
        $user->alamat = $request->alamat;
        $user->ktp = $request->ktp;
        $user->rekening = $request->rekening;
        $user->pendidikan = $request->pendidikan;
        $user->hp = $request->hp;
        $user->wa = $request->wa;
        $user->pekerjaan = $request->pekerjaan;
        $user->lahir = $request->lahir;
        $user->label_id = $request->label_id;
        $simpan = $user->save();
  
        if($simpan){
            if($request->hasFile('pp')){
                if(Storage::exists("pp/".$user->id."/")){
                    Storage::deleteDirectory("pp/".$user->id."/");
                }
                $path = Storage::putFileAs(
                    "pp/".$user->id."/",
                    $request->file('pp'),
                    $request->file('pp')->getClientOriginalName()
                );
                Session::flash('success', 'Berhasil mengupload foto!');
            }
            Session::flash('success', 'Membuat user baru berhasil!');
            return Redirect::back();
        } else {
            Session::flash('errors', ['' => 'Membuat user baru gagal! Silahkan ulangi lagi']);
            return Redirect::back();
        }
    }
    public function delete($id)
    {
      if(Auth::user()->jenis!="Administrator"){
        return view("errors.404");
      }

  			$user = User::find($id);
            if(Storage::exists("pp/".$user->id."/")){
                Storage::deleteDirectory("pp/".$user->id."/");
            }
  			if($user){
  	            Session::flash('success', 'Berhasil menghapus user!');
  	  			$user->delete();
  			}
        return Redirect::back();
    }
    public function ppupload(Request $request){
        if($request->hasFile('pp')){
            if(Storage::exists("pp/".Auth::id()."/")){
                Storage::deleteDirectory("pp/".Auth::id()."/");
            }
            $path = Storage::putFileAs(
                "pp/".Auth::id()."/",
                $request->file('pp'),
                $request->file('pp')->getClientOriginalName()
            );
            Session::flash('success', 'Berhasil mengupload foto!');
        }
        return Redirect::back();
    }
    public function pphapus(){
        if(Storage::exists("pp/".Auth::id()."/")){
            Storage::deleteDirectory("pp/".Auth::id()."/");
            Session::flash('success', 'Berhasil menghapus foto!');
        }
        return Redirect::back();
    }
    public function lihat($id,$file="-"){
        if(Storage::exists("pp/".$id."/".$file)){
            if(request()->has('download'))
                return Storage::download("pp/".$id."/".$file);
            return Storage::get("pp/".$id."/".$file);
        }
        else return "Gagal membuka file, kemungkinan file tidak ada atau error";
    }
}
