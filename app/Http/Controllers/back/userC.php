<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Http\Requests\user\userCreateRequest;
use App\Http\Requests\user\UserUpdateRequest;
use App\Models\Ajaran;
use App\Models\Kelas;
use App\Models\Tingkat;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class userC extends Controller
{
    public function index(){
        $user = User::get();
        return view('user.index', compact('user'));

        // Initialize the query for Transaksi
        $query = User::with(['Tingkat', 'Kelas', 'Ajaran']);
    }
    public function create(){

        $kelas         = Kelas::where('status', 1)->get();
        $ajaran        = Ajaran::get();
        $tingkat       = Tingkat::get();

        return view('user.create', [

            'kelas'         => $kelas,
            'ajaran'        => $ajaran,
            'tingkat'        => $tingkat,

        ]);


    }

    public function store(userCreateRequest $request) {
        $data = $request->validated();


    $user = Auth::user();
        DB::beginTransaction();
        try {
            if ($request->hasFile('foto_profile')) {
                $checkingFile = $request->file('foto_profile');
                $filename = $checkingFile->getClientOriginalName();
                $path = $checkingFile->storeAs('public/back/foto-profile',$filename);
                $data['foto_profile'] = $filename;
            }

            $data['password'] = bcrypt($data['password']);
            User::create($data);

            DB::commit();

            if ($user->level === 'user') {

                return redirect(route('    user.siswa'))->with('success', 'User has been created');
            } elseif ($user->level === 'admin') {
                return redirect(route('user.petugas'))->with('success', 'Admin action has been completed');
            } elseif ($user->level === 'petugas') {
                return redirect(route('user.petugas'))->with('success', 'Petugas action has been completed');
            } else {
                // Default action if the level does not match any of the above
                return redirect(route('login'))->with('success', 'Action has been completed');
            }
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
                $filename = $checkingFile->getClientOriginalName();
                $path = $checkingFile->storeAs('public/back/foto-profile',$filename);
                $data['foto_profile'] = $filename;
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

            if ($user->level === 'user') {

                return redirect(route('user.siswa'))->with('success', 'User has been updated');
            } elseif ($user->level === 'admin') {
                return redirect(route('user.petugas'))->with('success', 'Admin action has been updated');
            } elseif ($user->level === 'petugas') {
                return redirect(route('user.petugas'))->with('success', 'Petugas action has been updated');
            } else {
                // Default action if the level does not match any of the above
                return redirect(route('login'))->with('success', 'Action has been completed');
            }
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


    // public function siswa(){
    //     $user = User::where('level', 'user')->get();
    //     return view('siswa.index', [
    //         'user'  => $user
    //     ]);
    // }

    public function petugas(){
        $user = User::whereIn('level', ['admin', 'petugas','user'])->get();
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
                $filename = $checkingFile->getClientOriginalName();
                $path = $checkingFile->storeAs('public/back/foto-profile',$filename);
                $data['foto_profile'] = $filename;
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

    public function getUserInfo($id)
    {
        $user = User::find($id);
        if($user){
            return response()->json([
                'nis' => $user->nis,
                'telepon' => $user->telepon,
                'email' => $user->email,
                'alamat' => $user->alamat,
            ]);
        }
        return response()->json(['error' => 'User not found.']);
    }


}
