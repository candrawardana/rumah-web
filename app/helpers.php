<?php
use App\Models\User;
use App\Models\Ayah;
use App\Models\Ibu;
use App\Models\Nodin;
use App\Models\Notifikasi;

if(!function_exists('judul_situs')){
    function judul_situs($singkat = 0){
        if($singkat==1){
            return "RT Darul Adib";
        }
        return "Rumah Tahfiz Darul Adib";
    }
}

if(!function_exists('tanggal_indonesia')){
    function tanggal_indonesia($tanggal){
        $tanggal_pecah=explode("-",$tanggal);
        $bulan=$tanggal_pecah[1]??"01";
        $hari=$tanggal_pecah[0]??"01";
        $tahun=$tanggal_pecah[2]??"2001";
        $b="Desember";
        if($bulan=="01"||$bulan=="1")
            $b="Januari";
        if($bulan=="02"||$bulan=="2")
            $b="Februari";
        if($bulan=="03"||$bulan=="3")
            $b="Maret";
        if($bulan=="04"||$bulan=="4")
            $b="April";
        if($bulan=="05"||$bulan=="5")
            $b="Mei";
        if($bulan=="06"||$bulan=="6")
            $b="Juni";
        if($bulan=="07"||$bulan=="7")
            $b="Juli";
        if($bulan=="08"||$bulan=="8")
            $b="Agustus";
        if($bulan=="09"||$bulan=="9")
            $b="September";
        if($bulan=="10")
            $b="Oktober";
        if($bulan=="11")
            $b="November";
        return $hari." ".$b." ".$tahun;
    }
}

if(!function_exists('bulan_huruf')){
    function bulan_huruf($bulan){
        $b="Desember";
        if($bulan=="01"||$bulan=="1")
            $b="Januari";
        if($bulan=="02"||$bulan=="2")
            $b="Februari";
        if($bulan=="03"||$bulan=="3")
            $b="Maret";
        if($bulan=="04"||$bulan=="4")
            $b="April";
        if($bulan=="05"||$bulan=="5")
            $b="Mei";
        if($bulan=="06"||$bulan=="6")
            $b="Juni";
        if($bulan=="07"||$bulan=="7")
            $b="Juli";
        if($bulan=="08"||$bulan=="8")
            $b="Agustus";
        if($bulan=="09"||$bulan=="9")
            $b="September";
        if($bulan=="10")
            $b="Oktober";
        if($bulan=="11")
            $b="November";
        return $b;
    }
}

if(!function_exists('jumlah_user')){
	function jumlah_user(){
		return User::count();
	}
}

if ( !function_exists('mysql_escape'))
{
    function mysql_escape($inp)
    { 
        if(is_array($inp)) return array_map(__METHOD__, $inp);

        if(!empty($inp) && is_string($inp)) { 
            return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp); 
        } 

        return $inp; 
    }
}

if (!function_exists('pp_check')){
    function pp_check($id){
        $data=Storage::allFiles("pp/".$id);
        $pp=url('Assets/images/user-default.png');
        if(count($data)>0){
            $file = $data[0];
            $time = Storage::lastModified($file);
            $pp=url($file)."?t=".$time;
        }
        return $pp;
    }
}

if (!function_exists('detail_pembuat')){
    function detail_pembuat($id){
        $name = "Akun Tidak Ditemukan";
        $level = "tidak diketahui";
        $photo = pp_check($id);
        $User=User::find($id);
        if($User){
            $name = $User->name;
            $level = $User->level;
        }
        return compact("id","name","level","photo");
    }
}

if (!function_exists('gambar_thumbnail')){
    function gambar_thumbnail($fitur,$id,$file){
        $pp=url('Assets/images/background.png');
        if($file==null || $file == "")
            return $pp;
        if(Storage::exists($fitur."/".$id."/".$file)){
            $pp = url($fitur."/".$id."/".$file);
        }
        return $pp;
    }
}

if (!function_exists('gambar_second')){
    function gambar_second($link){
        return url($link);
        // return ENV("APP_URL_SECOND","http://localhost").str_replace(" ","%20",$link);
    }
}

if (!function_exists('penempatan')){
    function penempatan($link){
        return ENV($link,"-");
    }
}

if (!function_exists('nomor')){
    function nomor($nomor){
        return number_format(
            $nomor,
            0, // number of decimal places
            ',', // character to use as decimal point
            '.' // character to use as thousands separator
        );
    }
}

if (!function_exists('notifikasi')){
    function notifikasi(){
        $Notifikasi=new stdClass();
        $list=Notifikasi::where("user_id",Auth::id())->where("dilihat",0)->orderBy("created_at","desc")->limit(5)->get();
        foreach($list as $l){
            $l->notifikasi_related=notifikasi_related($l);
        }
        $Notifikasi->list=$list;
        $Notifikasi->count=Notifikasi::where("user_id",Auth::id())->where("dilihat",0)->orderBy("created_at","desc")->count();
        return $Notifikasi;
    }
}

if (!function_exists('semua_ustadz')){
    function semua_ustadz(){
        $User = User::where("jenis","Ustadz")->orderBy("name","desc")->select("id","name")->get();
        return $User;
    }
}

if (!function_exists('notifikasi_related')){
    function notifikasi_related(Notifikasi $Notifikasi){
        $icon = "fas fa-envelope";
        $link = url($Notifikasi->jenis."/".$Notifikasi->related_id);
        if($Notifikasi->jenis=="url"){
            $icon = "fas fa-external-link";
            $link = $Notifikasi->related_id;
        }
        if($Notifikasi->jenis=="santri"){
            $icon = "fas fa-user";
        }
        if($Notifikasi->jenis=="pengumuman"){
            $icon = "fas fa-clock";
        }
        if($Notifikasi->jenis=="kegiatan"){
            $icon = "fas fa-leaf";
        }
        if($Notifikasi->jenis=="berita"){
            $icon = "fas fa-globe";
        }
        if($Notifikasi->jenis=="tabungan"){
            $icon = "fas fa-cut";
        }

        return compact("icon","link");
    }
}

if (!function_exists('ayah_santri')){
    function ayah_santri($id){
        $Ayah=new stdClass();
        $User = User::join("wali_orang_tua as w","users.id","w.user_id")
            ->where("w.nis_santri",$id)
            ->where("users.jenis","ayah_santri")
            ->select("users.*")->first();
        if(!$User)
                return Ayah::where("s_nis",$id)->first();
        $lahir = explode(", ",$User->lahir);
        $Ayah->a_id = $User->label_id;
        $Ayah->s_nis = $id;
        $Ayah->a_nama = $User->name;
        $Ayah->a_tmplahir = $lahir[0];
        $Ayah->a_tgllahir = end($lahir);
        $Ayah->a_pendidikan = $User->pendidikan;
        $Ayah->a_pekerjaan = $User->pekerjaan;
        $Ayah->a_alamat = $User->alamat;
        $Ayah->a_telp = $User->hp;
        $Ayah->a_wa = $User->wa;
        return $Ayah;
    }
}

if (!function_exists('ibu_santri')){
    function ibu_santri($id){
        $Ibu=new stdClass();
        $User = User::join("wali_orang_tua as w","users.id","w.user_id")
            ->where("w.nis_santri",$id)
            ->where("users.jenis","ibu_santri")
            ->select("users.*")->first();
        if(!$User)
                return Ibu::where("s_nis",$id)->first();
        $lahir = explode(", ",$User->lahir);
        $Ibu->i_id = $User->label_id;
        $Ibu->s_nis = $id;
        $Ibu->i_nama = $User->name;
        $Ibu->i_tmplahir = $lahir[0];
        $Ibu->i_tgllahir = end($lahir);
        $Ibu->i_pendidikan = $User->pendidikan;
        $Ibu->i_pekerjaan = $User->pekerjaan;
        $Ibu->i_telp = $User->hp;
        $Ibu->i_wa = $User->wa;
        return $Ibu;
    }
}
?>