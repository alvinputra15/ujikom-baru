<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Metode;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class metodeC extends Controller
{
    public function index(){
        $metode = Metode::get();
        return view('metode.index',[
            'metode' => $metode
        ]);
    }

    public function create(){
        return view('metode.create');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'kode_metode' => 'required',
            'metode_pembayaran' => 'required',
        ]);
       if ($validator->fails()) return redirect()->back()->widhInput()->widhErrors($validator);

       $data['kode_metode']    = $request->kode_metode;
       $data['metode_pembayaran']   = $request->metode_pembayaran;

       Metode::create($data);

       return redirect()->route('metode.index');
    }

    public function edit(Request $request , $kode_metode){
            $metode = Metode::find($kode_metode);

            return view('metode.update' ,compact('metode'));
    }

    public function update(Request $request , $kode_metode){
        $data = Metode::find($kode_metode);

        $validator = Validator::make($request->all(),[
            'kode_metode' => 'required',
            'metode_pembayaran' => 'required',
        ]);

        if ($validator->fails()){
            return redirect()->back()->widhInput()->widhErrors($validator);
        }


       $data['kode_metode']    = $request->kode_metode;
       $data['metode_pembayaran']   = $request->metode_pembayaran;

       $data->save();


       return redirect()->route('metode.index');
}

    public function delete(Request $request , $kode_metode){
        $data = Metode::find($kode_metode);
        if($data){
            $data->delete();
        }

    return redirect()->route('metode.index');

    }

}
