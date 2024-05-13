<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Http\Requests\transaksi\bayarrequest;
use App\Models\HargaSpp;
use App\Models\Kelas;
use App\Models\Transaksi;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class TransaksiC extends Controller
{
    public function index(){
        $transaksi = Transaksi::with('User')->get();
        return view('transaksi.index',[
            'transaksi' => $transaksi
        ]);
    }

    public function create(){
        $levelUser    = User::where('level', 'user')->get();
        $levelPetugas = User::whereIn('level', ['petugas', 'admin'])->get();
        $kelas        = Kelas::where('status', 1)->get();
        $nominal      = HargaSpp::get()->first();
        return view('transaksi.create', [
            'levelUser'     => $levelUser,
            'levelPetugas'  => $levelPetugas,
            'kelas'  => $kelas,
            'nominal'  => $nominal,
        ]);
    }

    public function store(bayarrequest $request){
        $validatedData = $request->validate([
            'user_id' => 'required', 
            'petugas_id' => 'required', 
            'bulan' => 'required',
            'kelas' => 'required',
            'nominal' => 'required',
            // Add other validation rules as needed
        ]);
    
        DB::beginTransaction();
        try {

            $transaksi = new Transaksi();
            $transaksi->user_id = $request->user_id;
            $transaksi->petugas_id = $request->petugas_id;
            $transaksi->bulan = $request->bulan;
            $transaksi->kelas = $request->kelas;
            $transaksi->nominal = $request->nominal;
            
            $transaksi->save();
            DB::commit();

            return Redirect::route('transaksi.sukses', ['id_transaksi' => $transaksi->id_transaksi])->with('success', 'Transaksi berhasil dibuat');
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

    public function sukses($id_transaksi){
        // Temukan objek transaksi berdasarkan ID yang diberikan
        $transaksi = Transaksi::find($id_transaksi);
    
        // Periksa apakah transaksi ditemukan
        if ($transaksi) {
            // Temukan objek user (siswa) berdasarkan user_id di transaksi
            $user = User::find($transaksi->user_id);
            // Temukan objek petugas berdasarkan petugas_id di transaksi
            $petugas = User::find($transaksi->petugas_id);
    
            // Kirimkan data ke view 'transaksi.sukses'
            return view('transaksi.sukses', [
                'transaksi' => $transaksi,
                'user' => $user,
                'petugas' => $petugas,
            ]);
        } else {
            // Jika transaksi tidak ditemukan, kembalikan response yang sesuai
            return response()->json(['error' => 'Transaksi tidak ditemukan'], 404);
        }
    }

    public function history()
    {
$user = Auth::user(); // Get the currently authenticated user
 
$transaksi = Transaksi::with('user')
                      ->where('user_id', $user->id)
                      ->orderBy('created_at', 'DESC')
                      ->get();
        
            return view('transaksi.history', [
                'transaksi' => $transaksi
            ]);
    }
}
