<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class dashboardC extends Controller
{
    public function admin(){
        return view('dashboard.index');
    }
    public function petugas(){
        return view('dashboard.index');
    }
    public function user(){
        return view('dashboard.index');
    }

}
