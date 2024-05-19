<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Http\Requests\transaksi\bayarrequest;
use App\Models\Ajaran;
use App\Models\HargaSpp;
use App\Models\Kelas;
use App\Models\Metode;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class TransaksiC extends Controller
{
    public function index(){
        $transaksi = Transaksi::with(['User', 'Kelas', 'Ajaran', 'Metode'])->get();
        
        return view('transaksi.index',[
            'transaksi' => $transaksi
        ]);
        
    }

    public function create(){
        $levelUser     = User::where('level', 'user')->get();
        $kelas         = Kelas::where('status', 1)->get();
        $ajaran        = Ajaran::get();
        $metode        = Metode::get();
        $nominal       = HargaSpp::get()->first();
        return view('transaksi.create', [
            'levelUser'     => $levelUser,
            'kelas'         => $kelas,
            'ajaran'        => $ajaran,
            'metode'        => $metode,
            'nominal'       => $nominal,
        ]);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'kode_transaksi' => 'required',
            'user_id' => 'required', 
            'ajaran_kode' => 'required', 
            'metode_kode' => 'required', 
            'kelas_id' => 'required',
            'tanggal_transaksi' => 'required', 
            'bulan' => 'required',
            'nominal' => 'required',
        ]);
       if ($validator->fails()) return redirect()->back()->widhInput()->widhErrors($validator);

       $data['kode_transaksi']    = $request->kode_transaksi;
       $data['user_id']           = $request->user_id;
       $data['ajaran_kode']       = $request->ajaran_kode;
       $data['metode_kode']       = $request->metode_kode;
       $data['kelas_id']          = $request->kelas_id;
       $data['tanggal_transaksi'] = $request->tanggal_transaksi;
       $data['bulan']             = $request->bulan;
       $data['nominal']           = $request->nominal;
        DB::beginTransaction();
        try {
            $transaksi = new Transaksi();
            $transaksi->kode_transaksi = $request->kode_transaksi;
            $transaksi->user_id = $request->user_id;
            $transaksi->ajaran_kode = $request->ajaran_kode;
            $transaksi->metode_kode = $request->metode_kode;
            $transaksi->kelas_id = $request->kelas_id;
            $transaksi->tanggal_transaksi = $request->tanggal_transaksi;
            $transaksi->bulan = $request->bulan;
            $transaksi->nominal = $request->nominal;
            
            $transaksi->save();
            DB::commit();

            return Redirect::route('transaksi.sukses', ['kode_transaksi' => $transaksi->kode_transaksi])->with('success', 'Transaksi berhasil dibuat');
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
        if ($transaksi) {
            $user = User::find($transaksi->user_id);
            $kelas = Kelas::find($transaksi->kelas_id);
            $ajaran = Ajaran::find($transaksi->ajaran_kode);
            $metode = Metode::find($transaksi->metode_kode);
            return view('transaksi.sukses', [
                'transaksi' => $transaksi,
                'user'   => $user,
                'kelas'  => $kelas,
                'ajaran' => $ajaran,
                'metode' => $metode,
            ]);
        } else {
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
