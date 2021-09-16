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
if(!function_exists('jelas_kata')){
    function jelas_kata($kata){
        if($kata=="menunggu")
            return "Nodin sedang menunggu diproses Admin KPA";
        if($kata=="diterima_kpa")
            return "Nodin telah diterima Admin KPA, sedang menunggu diproses Admin PPK";
        if($kata=="diterima_ppk")
            return "Nodin telah diterima Admin PPK, sedang menunggu diproses Staff PPK";
        if($kata=="diterima_staff_ppk")
            return "Nodin telah diterima STAFF PPK, sedang menunggu diproses Bendahara";
        if($kata=="diterima_bendahara")
            return "Nodin telah diterima Bendahara, sedang menunggu diproses Kasubagkeuangan";
        if($kata=="kasubagkeuangan_y")
            return "Nodin telah diterima Kasubagkeuangan, sedang menunggu diproses PPSPM";
        if($kata=="diterima_ppspm")
            return "Nodin telah diterima PPSPM, sedang menunggu diproses Bendahara";
        if($kata=="ditolak_kpa")
            return "Nodin telah ditolak Admin KPA";
        if($kata=="ditolak_ppk")
            return "Nodin telah ditolak Admin PPK";
        if($kata=="ditolak_staff_ppk")
            return "Nodin telah ditolak Staff PPK";
        if($kata=="ditolak_bendahara")
            return "Nodin telah ditolak Bendahara";
        if($kata=="kasubagkeuangan_n")
            return "Nodin telah ditolak Kasubagkeuangan";
        if($kata=="ditolak_ppspm")
            return "Nodin telah ditolak PPSPM";
        if($kata=="n_bendahara")
            return "Nodin telah ditolak Bendahara";
        if($kata=="ditangguhkan_kpa")
            return "Nodin telah ditangguhkan Admin KPA, proses penangguhan untuk Admin Bidang";
        if($kata=="ditangguhkan_ppk")
            return "Nodin telah ditangguhkan Admin PPK, proses penangguhan untuk Admin KPA";
        if($kata=="ditangguhkan_staff_ppk")
            return "Nodin telah ditangguhkan Staff PPK, proses penangguhan untuk Admin PPK";
        if($kata=="ditangguhkan_bendahara")
            return "Nodin telah ditangguhkan Bendahara, proses penangguhan untuk Staff PPK";
        if($kata=="kasubagkeuangan_t")
            return "Nodin telah ditangguhkan Kasubagkeuangan, proses penangguhan untuk Bendahara";
        if($kata=="ditangguhkan_ppspm")
            return "Nodin telah ditangguhkan PPSPM, proses penangguhan untuk Kasubagkeuangan";
        if($kata=="t_bendahara")
            return "Nodin telah ditangguhkan Bendahara, proses penangguhan untuk PPSPM";
        return "Nodin telah selesai diproses";
    }
}
if(!function_exists('jelas_kata2')){
    function jelas_kata2($kata){

        $hasil = explode(" ",ucfirst(str_replace("_", " ", str_replace("kasubagkeuangan_", "", $kata))))[0];
        if($hasil=="N")
            $hasil = "Ditolak";
        if($hasil=="T")
            $hasil = "Ditangguhkan";
        if($hasil=="Y")
            $hasil = "Diterima";
        return $hasil;
    }
}
if(!function_exists('nodin_menunggu')){
	function nodin_menunggu(){
		return Nodin::where("status","menunggu")->count();
	}
}
if(!function_exists('nodin_proses')){
	function nodin_proses(){
		return Nodin::whereNotIn("status",["menunggu","selesai"])->count();
	}
}
if(!function_exists('nodin_selesai')){
	function nodin_selesai(){
		return Nodin::where("status","selesai")->count();
	}
}
if(!function_exists('semua_tugas')){
    function semua_tugas(){
        return [
            "menunggu",

            "diterima_kpa",
            "diterima_ppk",
            "diterima_staff_ppk",
            "diterima_bendahara",
            "kasubagkeuangan_y",
            "diterima_ppspm",

            "ditangguhkan_kpa",
            "ditangguhkan_ppk",
            "ditangguhkan_staff_ppk",
            "ditangguhkan_bendahara",
            "ditangguhkan_ppspm",
            "kasubagkeuangan_t",
            "t_bendahara",

            "ditolak_kpa",
            "ditolak_ppk",
            "ditolak_staff_ppk",
            "ditolak_bendahara",
            "ditolak_ppspm",
            "kasubagkeuangan_n",
            "n_bendahara",

            "selesai",
        ];
    }
}
if(!function_exists('boleh_tugas')){
    function boleh_tugas($jenis="tergantung"){
        $role=semua_tugas();
        array_push($role,"hapus");
        $tipe = Auth::user()->tipe;
        if($jenis!="tergantung"){
            $tipe=$jenis;
        }
        if($tipe!="Super Admin"){
            if($tipe=="Admin Bidang"){
                $role=["hapus","menunggu"];
            }
            if($tipe=="Admin KPA"){
                $role=["ditangguhkan_kpa","diterima_kpa","ditolak_kpa"];
            }
            if($tipe=="Admin PPK"){
                $role=["ditangguhkan_ppk","diterima_ppk","ditolak_ppk"];
            }
            if($tipe=="Staff PPK"){
                $role=["ditangguhkan_staff_ppk","diterima_staff_ppk","ditolak_staff_ppk"];
            }
            if($tipe=="Bendahara"){
                $role=["ditangguhkan_bendahara","diterima_bendahara","ditolak_bendahara","n_bendahara","t_bendahara","selesai"];
            }
            if($tipe=="Kasubagkeuangan"){
                $role=["kasubagkeuangan_n","kasubagkeuangan_t","kasubagkeuangan_y"];
            }
            if($tipe=="PPSPM"){
                $role=["ditangguhkan_ppspm","diterima_ppspm","ditolak_ppspm"];
            }
        }
        return $role;
    }
}
if(!function_exists('izin_tugas')){
	function izin_tugas(){
    	$role=semua_tugas();
    	// $tipe = Auth::user()->tipe;
    	// if($tipe!="Super Admin"){
    	// 	if($tipe=="Admin Bidang"){
    	// 		$role=["menunggu","ditangguhkan_kpa"];
    	// 	}
    	// 	if($tipe=="Admin KPA"){
    	// 		$role=["menunggu","ditangguhkan_kpa","diterima_kpa","ditangguhkan_ppk"];
    	// 	}
    	// 	if($tipe=="Admin PPK"){
    	// 		$role=["diterima_kpa","ditangguhkan_ppk","diterima_ppk","ditangguhkan_bendahara"];
    	// 	}
    	// 	if($tipe=="Bendahara"){
    	// 		$role=["diterima_ppk","ditangguhkan_bendahara","diterima_bendahara","ditangguhkan_ppspm"];
    	// 	}
    	// 	if($tipe=="PPSPM"){
    	// 		$role=["diterima_bendahara","ditangguhkan_ppspm","selesai"];
    	// 	}
    	// }
    	return $role;
	}
}
if(!function_exists('edit_tugas')){
    function edit_tugas(){
        $role=semua_tugas();
        $tipe = Auth::user()->tipe;
        if($tipe!="Super Admin"){
            if($tipe=="Admin Bidang"){
             $role=["menunggu","ditangguhkan_kpa"];
            }
            if($tipe=="Admin KPA"){
             $role=["menunggu","ditangguhkan_ppk"];
            }
            if($tipe=="Admin PPK"){
             $role=["diterima_kpa","ditangguhkan_staff_ppk"];
            }
            if($tipe=="Staff PPK"){
                $role=["diterima_ppk","ditangguhkan_bendahara"];
            }
            if($tipe=="Bendahara"){
             $role=["diterima_staff_ppk","diterima_ppspm","kasubagkeuangan_t"];
            }
            if($tipe=="Kasubagkeuangan"){
                $role=["diterima_bendahara","ditangguhkan_ppspm"];
            }
            if($tipe=="PPSPM"){
             $role=["kasubagkeuangan_y","t_bendahara"];
            }
        }
        return $role;
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
?>