<?php
use App\Models\User;
use App\Models\Nodin;

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
        return ENV("APP_URL_SECOND","http://localhost").$link;
    }
}
?>