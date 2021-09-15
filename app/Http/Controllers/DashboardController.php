<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nodin;
use DB;

class DashboardController extends Controller
{
    public function home()
    {

        $array_data_graph['nodin_perbulan'] = ['categories' => [], 'data' => []];
        $array_data_graph['nodin_perminggu'] = ['categories' => [], 'data' => []];
        $array_data_graph['nodin_perhari'] = ['categories' => [], 'data' => []];

        for($j=0;$j<12;$j++){
        	$i=9-$j;
        	$newdate = date("Y-m", strtotime("-".$i." months"));
        	$bulan = bulan_huruf(date("m", strtotime("-".$i." months")));
        	$tahun = date("Y", strtotime("-".$i." months"));
        	array_push($array_data_graph['nodin_perbulan']['categories'], $bulan . ' ' . $tahun);
        	$NodinPerbulan = Nodin::whereBetween('tanggal_bidang', [$newdate . '-01', $newdate . '-31'])->count();
        	array_push($array_data_graph['nodin_perbulan']['data'], $NodinPerbulan);
        }

        for($j=0;$j<12;$j++){
        	$i=9-$j;
        	$newdate = date("Y-m-d", strtotime("-".$i." weeks"));
            $olddate = date("Y-m-d", strtotime("-".($i+1)." weeks"));
        	array_push($array_data_graph['nodin_perminggu']['categories'], tanggal_indonesia($newdate));
            $NodinPerminggu = Nodin::whereBetween('tanggal_bidang', [$olddate, $newdate])->count();
        	array_push($array_data_graph['nodin_perminggu']['data'], $NodinPerminggu);
        }

        for($j=0;$j<12;$j++){
            $i=9-$j;
            $newdate = date("Y-m-d", strtotime("-".$i." days"));
            array_push($array_data_graph['nodin_perhari']['categories'], tanggal_indonesia($newdate));
            $NodinPerhari = Nodin::where('tanggal_bidang',  $newdate)->count();
            array_push($array_data_graph['nodin_perhari']['data'], $NodinPerhari);
        }

        return view('home',compact('array_data_graph'));
    }
}
