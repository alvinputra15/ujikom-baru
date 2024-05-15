<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class siswac extends Controller
{
    public function index(){
        $siswa = Siswa::get();
        return view('siswa.index', compact('siswa'));
    }
    public function create(Request $request){
        return view('siswa.create');
    }

    public function store( $request) {
        $data = $request->validated([
            'nama'  => 'required',
            'nis'  => 'required',
            'alamat'  => 'required',
            'email'  => 'required',
            'telepon'  => 'nullable',
            'foto_profile'  => 'nullable',
            'level'  => 'required',
            'password'              => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8'
        ]);
        DB::beginTransaction();
        try {
            if ($request->hasFile('foto_profile')) {
                $checkingFile = $request->file('foto_profile');
                $filename = $checkingFile->getClientOriginalName();
                $path = $checkingFile->storeAs('public/back/foto-profile',$filename);
                $data['foto_profile'] = $filename;
            }
            

            $data['password'] = bcrypt($data['password']);
            Siswa::create($data);

            DB::commit();
                return redirect(route('siswa.index'))->with('success', 'Action has been completed');
        } catch (Exception $e) {
            info($e->getMessage());
            DB::rollBack();

            return response()->json([
                "code"    => 412,
                "status"  => "Error",
                "message" =>  $e->getLine() . ' ' . $e->getMessage()
            ]);

        }
    }

    public function edit($id_siswa){
        return view('siswa.update', [
            'siswa'    => Siswa::find($id_siswa),
        ]);
    }

    public function update(Request $request, $id_siswa){
        $data = $request->validated([
            'nama'  => 'nullable',
            'nis'  => 'nullable',
            'alamat'  => 'nullable',
            'email'  => 'nullable',
            'telepon'  => 'nullable',
            'foto_profile'  => 'nullable',
            'level'  => 'nullable',
            'password'              => 'nullable|min:8|confirmed',
            'password_confirmation' => 'nullable|min:8|required_with:password'
        ]);

        DB::beginTransaction();
        try {
            if ($request->hasFile('foto_profile')) {
                $checkingFile = $request->file('foto_profile');
                $this->managementFile($checkingFile);
            }

        if($request->filled('password')) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
            unset($data['password_confirmation']);
        }
            $siswa = Siswa::find($id_siswa);
            $siswa->update($data);


            DB::commit();
                return redirect(route('siswa.index'))->with('success', 'Action has been completed');
        } catch (Exception $e) {
            info($e->getMessage());
            DB::rollBack();

            return response()->json([
                "code"    => 412,
                "status"  => "Error",
                "message" =>  $e->getLine() . ' ' . $e->getMessage()
            ]);

        }
    }
}
