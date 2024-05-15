<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiC extends Controller
{
    public function index(){
        return view('login.index');
    }


}

