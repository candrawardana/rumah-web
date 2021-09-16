<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    public function home()
    {
        return view('admin.home');
    }
}
