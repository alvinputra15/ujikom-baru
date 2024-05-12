<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingC extends Controller
{
    public function index()
    {
        $setting = Setting::get()->first();

        return view('setting.index', [
            'setting' =>$setting
        ]);
    }

    public function edit(string $id_setting)
    {
        return view('setting.update', [
            'setting'    => Setting::find($id_setting)
        ]);
    }

    public function update(Request $request, $id_setting)
    {
        $data = $request->validate([
            'nama_sekolah' => 'nullable|min:3',
            'foto_sekolah' => 'nullable',
            'alamat'       => 'nullable|min:3',
            'telepon'      => 'nullable|min:10',
            'email'      => 'nullable|email',
            'website'      => 'nullable',
            'npsn'         => 'nullable',
        ]);

        if ($request->hasFile('path_logo')) {
            $setting = Setting::find($id_setting);
            if ($setting->logo) {
                Storage::delete('logo/' . $setting->logo);
            }

            $logo = $request->file('path_logo');
            $fotoName = time() . '_' . $logo->getClientOriginalName();
            $logo->storeAs('logo', $fotoName, 'public');
            $data['path_logo'] = $fotoName;
        }
        Setting::find($id_setting)->update($data);


        return redirect(url('setting'))->with('success', ' Setting has been Update');
    }
}
