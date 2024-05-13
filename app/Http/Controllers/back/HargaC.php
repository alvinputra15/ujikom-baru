<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\HargaSpp;
use Illuminate\Http\Request;

class HargaC extends Controller
{
    public function index(){
        $spp = HargaSpp::get()->first();
        return view('spp.index', [
            'spp'   => $spp
        ]);
    }

    public function update(Request $request, $id_spp)
    {
        $data = $request->validate([
            'nominal' => 'nullable|min:3',
        ]);
        $kelas = HargaSpp::find($id_spp);
        $kelas->update($data);



        return redirect(url('spp'))->with('success', ' Setting has been Update');
    }
}
