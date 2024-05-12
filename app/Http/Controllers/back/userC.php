<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class userC extends Controller
{
    public function index(){
        $user = User::get();
        return view('user.index', compact('user'));
    }

}
