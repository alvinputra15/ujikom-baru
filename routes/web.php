<?php

use App\Http\Controllers\back\dashboardC;
use App\Http\Controllers\back\loginC;
use App\Http\Controllers\back\userC;
use App\Http\Controllers\SesiC;
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


Route::middleware(['guest'])->group(function(){
Route::get('/login', [loginC::class, 'index'])->name('login');
Route::post('/login', [loginC::class, 'login'])->name('login.index');
});


Route::middleware(['auth'])->group(function(){
    Route::get('/admin/koperasi', [dashboardC::class, 'admin'])->name('admin.index');
    Route::get('/petugas', [dashboardC::class, 'petugas'])->name('petugas.index');
    Route::get('/user', [dashboardC::class, 'user'])->name('user.index');
    Route::get('/logout', [loginC::class, 'logout'])->name('logout');

    //user
    Route::get('/user', [userC::class, 'index'])->name('user.index');
    Route::get('/user/tambah', [userC::class, 'create'])->name('user.tambah');
    Route::get('/user/{id_user}', [userC::class, 'update'])->name('user.update');
    Route::post('/user/store', [login::class, 'store'])->name('user.store');

    //transaksi
    Route::get('/transaksi', [transaksi::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/tambah', [userC::class, 'create'])->name('transaksi.tambah');
    Route::get('/transaksi/{id_user}', [userC::class, 'update'])->name('transaksi.update');
    Route::post('/transaksi/store', [userC::class, 'store'])->name('transaksi.store');
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

