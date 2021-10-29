<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
  
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use Session;
use App\Models\User;
use App\Models\WaliOrangTua;
use App\Models\Santri;
use App\Models\Ayah;
use App\Models\Ibu;
use App\Models\Pegawai;
use Ramsey\Uuid\Uuid;
use Str;
use App\Models\MasukSanctum;
use Storage;
  
class AuthController extends Controller
{
    public function showFormLogin()
    {
        if (Auth::check()) { // true sekalian session field di users nanti bisa dipanggil via Auth
            //Login Success
            return redirect()->route('home');
        }
        return view('login');
    }

    public function apiNotifikasi()
    {
        $respon = [
            'result' => 'info',
            'title' => 'orang tua',
            'data' => notifikasi(1)->list
        ];
        return response()->json($respon,200);
    }
  
    public function login(Request $request)
    {
        $rules = [
            'username'                 => 'required',
            'password'              => 'required|string'
        ];
  
        $messages = [
            'username.required'        => 'Username / Email wajib diisi',
            'password.required'     => 'Password wajib diisi',
            'password.string'       => 'Password harus berupa string'
        ];
  
        $validator = Validator::make($request->all(), $rules, $messages);
  
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $data = [
            'username'     => $request->input('username'),
            'password'  => $request->input('password'),
        ];
  
        Auth::attempt($data);
  
        if (Auth::check()) { // true sekalian session field di users nanti bisa dipanggil via Auth
            //Login Success
            return redirect()->route('home');
  
        } else { // false
            $User = User::where("email",$request->input('username'))->first();
            if($User){
                $data = [
                    'username'     => $User->username,
                    'password'  => $request->input('password'),
                ];
                Auth::attempt($data);
                if (Auth::check()) { // true sekalian session field di users nanti bisa dipanggil via Auth
                    //Login Success
                    return redirect()->route('home');
          
                }
            }
        }
        $Santri = Santri::where("s_nis",$request->username)->where("s_password",$request->password)->first();
        $Pegawai = Pegawai::where("p_username",$request->username)->where("p_password",$request->password)->first();
        if($Santri){
            if($request->has("orang_tua")){
                if($request->orang_tua==1){
                    $Ayah = Ayah::where("s_nis",$request->username)->first();
                    if($Ayah){
                        $User = User::where("username",$Ayah->a_id)->first();
                        if(!$User){
                            $User = new User();
                            $User->name = $Ayah->a_nama;
                            $User->username = $Ayah->a_id;
                            $User->label_id = $Ayah->a_id;
                            $User->password = Hash::make($request->password);
                            $User->jenis = "ayah_santri";
                            $User->pekerjaan = $Ayah->a_pekerjaan;
                            $User->pendidikan = $Ayah->a_pendidikan;
                            $User->hp = $Ayah->a_telp;
                            $User->wa = $Ayah->a_wa;
                            $User->alamat = $Ayah->a_alamat;
                            $User->lahir = $Ayah->a_tmplahir.", ".$Ayah->a_tgllahir;
                            $User->save();
                        }
                        $data = [
                            'username'     => $Ayah->a_id,
                            'password'  => $request->input('password'),
                        ];
                        Auth::attempt($data);                  
                    }
                }
                if($request->orang_tua==0){
                    $Ibu = Ibu::where("s_nis",$request->username)->first();
                    if($Ibu){
                        $User = User::where("username",$Ibu->a_id)->first();
                        if(!$User){
                            $User = new User();
                            $User->name = $Ibu->i_nama;
                            $User->username = $Ibu->i_id;
                            $User->label_id = $Ibu->i_id;
                            $User->password = Hash::make($request->password);
                            $User->jenis = "ibu_santri";
                            $User->pekerjaan = $Ibu->i_pekerjaan;
                            $User->pendidikan = $Ibu->i_pendidikan;
                            $User->hp = $Ibu->i_telp;
                            $User->wa = $Ibu->i_wa;
                            $User->alamat = $Santri->s_alamat;
                            $User->lahir = $Ibu->i_tmplahir.", ".$Ibu->i_tgllahir;
                            $User->save();
                        }
                        $data = [
                            'username'     => $Ibu->i_id,
                            'password'  => $request->input('password'),
                        ];
                        Auth::attempt($data);
                    }
                }
                if (Auth::check()) {
                    $WaliOrangTua = WaliOrangTua::where("nis_santri",$Santri->s_nis)
                        ->where("user_id",Auth::id())
                        ->first();
                    if(!$WaliOrangTua){
                        $WaliOrangTua = new WaliOrangTua();
                        $WaliOrangTua->nis_santri = $Santri->s_nis;
                        $WaliOrangTua->user_id = Auth::id();
                        $WaliOrangTua->save();
                    }          
                }
            }
            else{
                //Login Fail
                Session::flash('info', 'Pilih dahulu apakah anda ayah atau ibu santri tersebut');
                Session::flash('info_username', $request->username);
                Session::flash('info_password', $request->password);
                return redirect()->route('login');
            }
        }
        else if($Pegawai){
            $User = User::where("username",$Pegawai->p_username)->first();
            if(!$User){
                $User = new User();
                $User->name = $Pegawai->p_nama;
                $User->username = $Pegawai->p_username;
                $User->email = $Pegawai->p_email;
                $User->label_id = $Pegawai->p_induk;
                $User->password = Hash::make($request->password);
                $User->jenis = $Pegawai->p_level;
                $User->pekerjaan = $Pegawai->p_jabatan;
                $User->hp = $Pegawai->p_telp;
                $User->alamat = $Pegawai->p_alamat;
                $User->save();
                $host = gambar_second($Pegawai->p_foto);
                $ch = curl_init($host);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
                $result = curl_exec($ch);
                curl_close($ch);
                Storage::makeDirectory("pp/".$User->id);
                $fp = fopen(Storage::path("pp/".$User->id."/convert.jpg",$result),'x');
                fwrite($fp, $result);
                fclose($fp);

            }
            Auth::attempt($data);
        }
        if (Auth::check()) {
            return redirect()->route('home');
        }
        //Login Fail
        Session::flash('error', 'Nama Akun, Email atau password salah');
        return redirect()->route('login');
  
    }
  
    public function showFormRegister()
    {
        return view('register');
    }
  
    public function register(Request $request)
    {
        $rules = [
            'name'                  => 'required|min:3|max:35',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|confirmed'
        ];
  
        $messages = [
            'name.required'         => 'Nama Lengkap wajib diisi',
            'name.min'              => 'Nama lengkap minimal 3 karakter',
            'name.max'              => 'Nama lengkap maksimal 35 karakter',
            'email.required'        => 'Email wajib diisi',
            'email.email'           => 'Email tidak valid',
            'email.unique'          => 'Email sudah terdaftar',
            'password.required'     => 'Password wajib diisi',
            'password.confirmed'    => 'Password tidak sama dengan konfirmasi password'
        ];
  
        $validator = Validator::make($request->all(), $rules, $messages);
  
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }
  
        $user = new User;
        $user->name = ucwords(strtolower($request->name));
        $user->email = strtolower($request->email);
        $user->password = Hash::make($request->password);
        $user->email_verified_at = \Carbon\Carbon::now();
        $simpan = $user->save();
  
        if($simpan){
            Session::flash('success', 'Register berhasil! Silahkan login untuk mengakses data');
            return redirect()->route('login');
        } else {
            Session::flash('errors', ['' => 'Register gagal! Silahkan ulangi beberapa saat lagi']);
            return redirect()->route('register');
        }
    }

    public function apilogin(Request $request) {
        $validate = \Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($validate->fails()) {
            $respon = [
                'result' => 'error',
                'title' => 'Gagal masuk, periksa kembali email dan password anda',
            ];
            return response()->json($respon, 401);
        }
        $data = [
            'username'     => $request->input('username'),
            'password'  => $request->input('password'),
        ];
  
        Auth::attempt($data);
  
        if (Auth::check()) {
  
        } else { // false
            $User = User::where("email",$request->input('username'))->first();
            if($User){
                $data = [
                    'username'     => $User->username,
                    'password'  => $request->input('password'),
                ];
                Auth::attempt($data);
            }
            $Santri = Santri::where("s_nis",$request->username)->where("s_password",$request->password)->first();
            if($Santri){
                $ortu = -1;
                if($request->has("orang_tua")){
                    $ortu = $request->orang_tua;
                }
                if($ortu>=0){
                    if($request->orang_tua==1){
                        $Ayah = Ayah::where("s_nis",$request->username)->first();
                        if($Ayah){
                            $User = User::where("username",$Ayah->a_id)->first();
                            if(!$User){
                                $User = new User();
                                $User->name = $Ayah->a_nama;
                                $User->username = $Ayah->a_id;
                                $User->label_id = $Ayah->a_id;
                                $User->password = Hash::make($request->password);
                                $User->jenis = "ayah_santri";
                                $User->pekerjaan = $Ayah->a_pekerjaan;
                                $User->pendidikan = $Ayah->a_pendidikan;
                                $User->hp = $Ayah->a_telp;
                                $User->wa = $Ayah->a_wa;
                                $User->alamat = $Ayah->a_alamat;
                                $User->lahir = $Ayah->a_tmplahir.", ".$Ayah->a_tgllahir;
                                $User->save();
                            }
                            $data = [
                                'username'     => $Ayah->a_id,
                                'password'  => $request->input('password'),
                            ];
                            Auth::attempt($data);                  
                        }
                    }
                    if($request->orang_tua==0){
                        $Ibu = Ibu::where("s_nis",$request->username)->first();
                        if($Ibu){
                            $User = User::where("username",$Ibu->a_id)->first();
                            if(!$User){
                                $User = new User();
                                $User->name = $Ibu->i_nama;
                                $User->username = $Ibu->i_id;
                                $User->label_id = $Ibu->i_id;
                                $User->password = Hash::make($request->password);
                                $User->jenis = "ibu_santri";
                                $User->pekerjaan = $Ibu->i_pekerjaan;
                                $User->pendidikan = $Ibu->i_pendidikan;
                                $User->hp = $Ibu->i_telp;
                                $User->wa = $Ibu->i_wa;
                                $User->alamat = $Santri->s_alamat;
                                $User->lahir = $Ibu->i_tmplahir.", ".$Ibu->i_tgllahir;
                                $User->save();
                            }
                            $data = [
                                'username'     => $Ibu->i_id,
                                'password'  => $request->input('password'),
                            ];
                            Auth::attempt($data);
                        }
                    }
                    if (Auth::check()) {
                        $WaliOrangTua = WaliOrangTua::where("nis_santri",$Santri->s_nis)
                            ->where("user_id",Auth::id())
                            ->first();
                        if(!$WaliOrangTua){
                            $WaliOrangTua = new WaliOrangTua();
                            $WaliOrangTua->nis_santri = $Santri->s_nis;
                            $WaliOrangTua->user_id = Auth::id();
                            $WaliOrangTua->save();
                        }
                    }
                }
                else{
                    //Login Fail
                    $respon = [
                    'result' => 'info',
                    'title' => 'orang tua',
                    ];
                    return response()->json($respon,200);
                }
            }
        }
        if (!Auth::check()) {
            $respon = [
                'result' => 'error',
                'title' => 'Gagal masuk, periksa kembali email dan password anda',
                ];
            return response()->json($respon,401);
        }
        $user = User::find(Auth::id());

        $checktoken = MasukSanctum::where("tokenable_id",$user->id)->first();
        if($checktoken){
            $checktoken->delete();
        }

        $tokenResult = $user->createToken('token-auth')->plainTextToken;
        $respon = [
            'result' => 'success',
            'title' => 'Berhasil Login',
            'token' => $tokenResult,
        ];
        return response()->json($respon, 200);
    }
    public function apilogout(Request $request) {
        $user = $request->user();
        $user->currentAccessToken()->delete();
        $respon = [
            'status' => 'success',
            'msg' => 'Logout successfully',
            'errors' => null,
            'content' => null,
        ];
        return response()->json($respon, 200);
    }

    public function logoutall(Request $request) {
        $user = $request->user();
        $user->tokens()->delete();
        $respon = [
            'status' => 'success',
            'msg' => 'Logout successfully',
            'errors' => null,
            'content' => null,
        ];
        return response()->json($respon, 200);
    }
  
    public function logout()
    {
        Auth::logout(); // menghapus session yang aktif
        return redirect()->route('login');
    }
}