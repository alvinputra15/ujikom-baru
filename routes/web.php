<?php

use App\Http\Controllers\back\ajaranC;
use App\Http\Controllers\back\dashboardC;
use App\Http\Controllers\back\HargaC;
use App\Http\Controllers\back\KelasC;
use App\Http\Controllers\back\loginC;
use App\Http\Controllers\back\metodeC;
use App\Http\Controllers\back\SettingC;
use App\Http\Controllers\back\TransaksiC;
use App\Http\Controllers\back\userC;
use App\Http\Controllers\SesiC;
use App\Http\Middleware\UserAkses;
use App\Models\Metode;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('landing.index');
});


Route::get('/login', [loginC::class, 'index'])->name('login');
Route::post('/login', [loginC::class, 'login'])->name('login.index');



Route::middleware(['auth'])->group(function(){
    Route::get('/admin/Spp', [dashboardC::class, 'admin'])->name('admin.index')->middleware('UserAkses:admin');
    Route::get('/petugas/Spp', [dashboardC::class, 'petugas'])->name('petugas.index')->middleware('UserAkses:petugas');
    Route::get('/user/Spp', [dashboardC::class, 'user'])->name('users.index')->middleware('UserAkses:user');
    Route::get('/logout', [loginC::class, 'logout'])->name('logout');


    //setting
    Route::get('/setting', [SettingC::class, 'index'])->name('setting.index');
    Route::post('/setting/update/{id_setting}', [SettingC::class, 'update'])->name('setting.update');

    //spp
    Route::get('/spp', [HargaC::class, 'index'])->name('spp.index');
    Route::post('/spp/update/{id_spp}', [HargaC::class, 'update'])->name('spp.update');

    //user
    Route::get('/user', [userC::class, 'index'])->name('user.index');
    Route::get('/user/petugas', [userC::class, 'petugas'])->name('user.petugas');
    Route::get('/user/siswa', [userC::class, 'siswa'])->name('user.siswa');
    Route::get('/user/tambah', [userC::class, 'create'])->name('user.tambah');
    Route::get('/user/profile{id}', [userC::class, 'profile'])->name('profile');
    Route::get('/user/update/{id}', [userC::class, 'update'])->name('user.update');
    Route::get('/user/edit/{id}', [UserC::class, 'edit'])->name('user.edit');
    Route::post('/user/edit/profile/{id}', [UserC::class, 'updateProfile'])->name('update.profile');
    Route::post('/user/store', [userC::class, 'store'])->name('user.store');
    Route::post('/user/update{id}', [userC::class, 'update'])->name('user.update');

    //kelas
    Route::get('/kelas', [KelasC::class, 'index'])->name('kelas.index');
    Route::get('/kelas/tambah', [KelasC::class, 'create'])->name('kelas.tambah');
    Route::get('/kelas/edit/{id_kelas}', [kelasC::class, 'edit'])->name('kelas.edit');
    Route::post('/kelas/store', [KelasC::class, 'store'])->name('kelas.store');
    Route::post('/kelas/update{id_kelas}', [KelasC::class, 'update'])->name('kelas.update');
    Route::post('/kelas/delete', [KelasC::class, 'delete'])->name('kelas.delete');

    //ajaran
    Route::get('/ajaran', [ajaranC::class, 'index'])->name('ajaran.index');
    Route::get('/ajaran/tambah', [ajaranC::class, 'create'])->name('ajaran.tambah');
    Route::get('/ajaran/edit/{kode_ajaran}', [ajaranC::class, 'edit'])->name('ajaran.edit');
    Route::post('/ajaran/store', [ajaranC::class, 'store'])->name('ajaran.store');
    Route::post('/ajaran/update{kode_ajaran}', [ajaranC::class, 'update'])->name('ajaran.update');
    Route::post('/ajaran/delete/{kode_ajaran}', [ajaranC::class, 'delete'])->name('ajaran.delete');

    //Metode
    Route::get('/metode', [metodeC::class, 'index'])->name('metode.index');
    Route::get('/metode/tambah', [metodeC::class, 'create'])->name('metode.tambah');
    Route::get('/metode/edit/{kode_metode}', [metodeC::class, 'edit'])->name('metode.edit');
    Route::post('/metode/store', [metodeC::class, 'store'])->name('metode.store');
    Route::post('/metode/update{kode_metode}', [metodeC::class, 'update'])->name('metode.update');
    Route::post('/metode/delete/{kode_metode}', [metodeC::class, 'delete'])->name('metode.delete');

    //metode pembayaran
    Route::get('/pembayaran', [metodeC::class, 'index'])->name('pembayaran.index');
    Route::get('/pembayaran/tambah', [metodeC::class, 'create'])->name('pembayaran.tambah');
    Route::get('/pembayaran/edit/{kode_ajaran}', [metodeC::class, 'edit'])->name('pembayaran.edit');
    Route::post('/pembayaran/store', [metodeC::class, 'store'])->name('pembayaran.store');
    Route::post('/pembayaran/update{kode_ajaran}', [metodeC::class, 'update'])->name('pembayaran.update');
    Route::post('/pembayaran/delete/{kode_ajaran}', [metodeC::class, 'delete'])->name('pembayaran.delete');

    //transaksi
    Route::get('/bayar', [TransaksiC::class, 'index'])->name('bayar.spp');
    Route::get('/bayar/history', [TransaksiC::class, 'history'])->name('history.spp')->middleware('auth');

    Route::get('/bayar/tambah', [TransaksiC::class, 'create'])->name('bayar.tambah');
    Route::get('/bayar/update/{kode_transaksi}', [TransaksiC::class, 'update'])->name('bayar.update');
    Route::get('/bayar/sukses/{kode_transaksi}', [TransaksiC::class, 'sukses'])->name('transaksi.sukses');
    Route::post('/bayar/store', [TransaksiC::class, 'store'])->name('bayar.store');
    Route::post('/bayar/update/{kode_transaksi}', [TransaksiC::class, 'update'])->name('bayar.update');
    Route::get('/get-user-info/{id}', [userC::class,'getUserInfo'])->name('get.user.info');

});


Route::get('/pembayaranSpp', function () {
    $user = auth()->user();
    if ($user->level == 'admin') {
        return Redirect::route('admin.index');
    } elseif ($user->level == 'petugas') {
        return Redirect::route('petugas.index');
    } elseif ($user->level == 'user') {
        return Redirect::route('user.index');
    } else {
        return Redirect::route('login');
    }
})->name('redirect.dashboard');

