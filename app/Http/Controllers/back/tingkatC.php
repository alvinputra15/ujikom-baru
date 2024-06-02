<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Tingkat;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class tingkatC extends Controller
{
    public function index(){
        $tingkats = Tingkat::get();
        return view('tingkat.index',[
            'tingkats' => $tingkats
        ]);
    }


    public function create(){
        return view('tingkat.create');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'kode_tingkat' => 'required',
            'tingkat' => 'required',
        ]);
       if ($validator->fails()) return redirect()->back()->widhInput()->widhErrors($validator);

       $data['kode_tingkat']    = $request->kode_tingkat;
       $data['tingkat']   = $request->tingkat;

       Tingkat::create($data);

       return redirect()->route('tingkat.index');
    }

    public function edit(Request $request , $id){
        $data = Tingkat::find($id);

        return view('tingkat.update' ,compact('data'));
}

public function update(Request $request , $id){
    $data = Tingkat::find($id);

    $validator = Validator::make($request->all(),[
        'kode_tingkat' => 'required',
        'tingkat' => 'required',
    ]);

    if ($validator->fails()){
        return redirect()->back()->widhInput()->widhErrors($validator);
    }


   $data['kode_tingkat']    = $request->kode_tingkat;
   $data['tingkat']   = $request->tingkat;

   $data->save();


   return redirect()->route('tingkat.index');
}

public function delete(Request $request , $id){
    $data = Tingkat::find($id);
    if($data){
        $data->delete();
    }

return redirect()->route('tingkat.index');

}

}
