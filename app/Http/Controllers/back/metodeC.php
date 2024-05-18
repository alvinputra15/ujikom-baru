<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class metodeC extends Controller
{
    public function index(){
        $pembayarans = Pembayaran::get();
        return view('pembayaran.index',[
            'pembayarans' => $pembayarans
        ]);
    }
}
