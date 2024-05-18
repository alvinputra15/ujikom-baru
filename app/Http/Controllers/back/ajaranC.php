<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Ajaran;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ajaranC extends Controller
{
    public function index(){
        $ajarans = Ajaran::get();
        return view('ajaran.index',[
            'ajarans' => $ajarans
        ]);
    }

    public function create(){
        return view('ajaran.create');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'kode_ajaran' => 'required',
            'tahun_ajaran' => 'required',
        ]);
       if ($validator->fails()) return redirect()->back()->widhInput()->widhErrors($validator);

       $data['kode_ajaran']    = $request->kode_ajaran;
       $data['tahun_ajaran']   = $request->tahun_ajaran;

       Ajaran::create($data);

       return redirect()->route('ajaran.index');
    }

    public function edit(Request $request , $id){
            $data = Ajaran::find($id);

            return view('ajaran.update' ,compact('data'));
    }

    public function update(Request $request , $id){
        $data = Ajaran::find($id);

        $validator = Validator::make($request->all(),[
            'kode_ajaran' => 'required',
            'tahun_ajaran' => 'required',
        ]);

        if ($validator->fails()){
            return redirect()->back()->widhInput()->widhErrors($validator);
        }


       $data['kode_ajaran']    = $request->kode_ajaran;
       $data['tahun_ajaran']   = $request->tahun_ajaran;

       $data->save();


       return redirect()->route('ajaran.index');
}

    public function delete(Request $request , $id){
        $data = Ajaran::find($id);
        if($data){
            $data->delete();
        }

    return redirect()->route('ajaran.index');

    }


}
