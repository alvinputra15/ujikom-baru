<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelasC extends Controller
{
    public function index(){
        $kelas = Kelas::where('status', 1)->get();
        return view('kelas.index',[
            'kelas' => $kelas
        ]);
    }

    public function create(){
        return view('kelas.create');
    }

    public function store(Request $request){
        $data = $request->validate([
            'kelas' => 'required|min:3',
        ]);
        $data['status'] = 1;
        DB::beginTransaction();
        try {

            Kelas::create($data);

            DB::commit();

            return redirect(route('kelas.index'))->with('success', ' User has been created');
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

    public function edit($id_kelas){
        return view('kelas.update', [
            'kelas' => Kelas::find($id_kelas)
        ]);
    }

    public function update(Request $request, $id_kelas){
        $data = $request->validate([
            'kelas' => 'nullable|min:3',
        ]);
        $data['status'] = 1;
        DB::beginTransaction();
        try {

            $kelas = Kelas::find($id_kelas);
            $kelas->update($data);

            DB::commit();

            return redirect(route('kelas.index'))->with('success', ' User has been updated');
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

    public function delete(Request $request){
        $validated = $request->validate([
            'id_kelas' => 'required',
        ]);

        $name = Kelas::where('id_kelas', $validated['id_kelas'])->first();
        if ($name) {
            $name->status = '0';
            $name->save();
            return redirect(route('kelas.index'))->with('success', ' User has been delete');
        }
        return response()->json(['message' => 'Pinjaman kredit not found'], 404);
    }
}
