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
	  public function user(Request $request)
    {
      if(Auth::user()->tipe!="Super Admin"){
        return "";
      }
    	$User = User::orderBy("name","asc");
    	$q=null;
    	if ($request->has("q")) {
    		$q=$request->q;
	    	$User = User::where("name","like","%".$q."%")
	    	->orWhere("email","like","%".$q."%");
    	}
    	$User = $User->paginate(10)->appends(['q' => $q]);
        return view('user',compact("User","q"));
    }
    public function save(Request $request)
    {
        if(Auth::user()->tipe!="Super Admin"){
          return "";
        }
        $rules = [
            'name'                  => 'required|min:3|max:35',
            'email'                 => 'required|email|email',
            'password'              => 'required',
            'tipe'					=> 'required'
        ];
  
        $messages = [
            'name.required'         => 'Nama Lengkap wajib diisi',
            'name.min'              => 'Nama lengkap minimal 3 karakter',
            'name.max'              => 'Nama lengkap maksimal 35 karakter',
            'email.required'        => 'Email wajib diisi',
            'email.email'           => 'Email tidak valid',
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
        $user->email = strtolower($request->email);
        $user->tipe = $request->tipe;
        $user->password = Hash::make($request->password);
        $user->email_verified_at = \Carbon\Carbon::now();
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
    public function delete(Request $request)
    {
      if(Auth::user()->tipe!="Super Admin"){
        return "";
      }

    	if($request->has("id")){
  			$user = User::find($request->id);
            if(Storage::exists("pp/".$user->id."/")){
                Storage::deleteDirectory("pp/".$user->id."/");
            }
  			if($user){
  	            Session::flash('success', 'Berhasil menghapus user!');
  	  			$user->delete();
  			}
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
        if(!Auth::user()){
            return "tidak bisa membuka karena tidak ada akses";
        }
        if(Storage::exists("pp/".$id."/".$file)){
            if(request()->has('download'))
                return Storage::download("pp/".$id."/".$file);
            return Storage::get("pp/".$id."/".$file);
        }
        else return "Gagal membuka file, kemungkinan file tidak ada atau error";
    }
}
