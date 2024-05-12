<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Http\Requests\user\userCreateRequest;
use App\Http\Requests\user\UserUpdateRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class userC extends Controller
{
    public function index(){
        $user = User::get();
        return view('user.index', compact('user'));
    }
    public function create(Request $request){
        return view('user.create');
    }

    public function store(userCreateRequest $request) {
        $data = $request->validated();

        DB::beginTransaction();
        try {
            if ($request->hasFile('foto')) {
                // Simpan foto baru
                $foto = $request->file('foto');
                $fotoName = time() . '_' . $foto->getClientOriginalName();
                $foto->storeAs('fotoProfile', $fotoName, 'public');
                $data['foto'] = $fotoName;
            }

            $data['password'] = bcrypt($data['password']);
            User::create($data);

            DB::commit();

            return redirect(route('user.index'))->with('success', ' User has been created');
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

    public function edit($id){
        $levels = User::distinct('level')->pluck('level');
        return view('user.update', [
            'user'    => User::find($id),
            'levels' => $levels
        ]);
    }

    public function update(UserUpdateRequest $request, $id){
        $data = $request->validated();

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
            $user = User::find($id);
            $user->update($data);


            DB::commit();

            return redirect(route('user.index'))->with('success', ' User has been update');
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


    public function siswa(){
        $user = User::where('level', 'user')->get();
        return view('siswa.index', [
            'user'  => $user
        ]);
    }

    public function petugas(){
        $user = User::whereIn('level', ['admin', 'petugas'])->get();
        return view ('petugas.index', [
            'user'  => $user
        ]);
    }

    public function profile($id){
        return view('profile.index', [
            'user'  => User::find($id)
        ]);
    }

    public function updateProfile(UserUpdateRequest $request, $id){
        $data = $request->validated();

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
            $user = User::find($id);
            $user->update($data);


            DB::commit();

            return redirect()->back()->with('success', ' User has been update');
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
