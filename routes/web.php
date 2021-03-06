<?php

use App\Http\Controllers\EkstrakurikulerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriMapelController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\RaportController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TahunAjaranController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes(['register' => false]);

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/kelas', [KelasController::class, 'index'])->name('kelas');
Route::get('/tahun-ajaran', [TahunAjaranController::class, 'index'])->name('tahun-ajaran');
Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa');
Route::get('/kategori-mapel', [KategoriMapelController::class, 'index'])->name('kategori-mapel');
Route::get('/ekstrakurikuler', [EkstrakurikulerController::class, 'index'])->name('ekstrakurikuler');
Route::get('/mata-pelajaran', [MataPelajaranController::class, 'index'])->name('mata-pelajaran');
Route::get('/nilai-raport', [RaportController::class, 'index'])->name('raport');
