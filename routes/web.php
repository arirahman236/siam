<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\AkadControllerKrs;
use App\Http\Controllers\AkadControllerKhs;
use App\Http\Controllers\AkadControllerRekapNilai;
use App\Http\Controllers\TugasAkhirController;
use App\Http\Controllers\WisudaController;
use App\Http\Controllers\JadwalKuliahController;
use App\Http\Controllers\JadwalUjianController;
use App\Http\Controllers\PresensiController;

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

// login
Route::middleware(['guest'])->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    //Route::get('/', function () {return view('maintenance'); });
    Route::post('/LoginCheck', [LoginController::class, 'LoginCheck'])->name('LoginCheck');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::get('/KHS', [AkadControllerKhs::class, 'viewKhs'])->name('khs');
    Route::post('/detail-khs', [AkadControllerKhs::class, 'viewKhs'])->name('detail-khs');

    //entri KRS
    Route::get('/entri-krs', [AkadControllerKrs::class, 'insertKrs'])->name('entri-krs');
    Route::get('/tambah-mk', [AkadControllerKrs::class, 'insertMkDitawarkan'])->name('tambah-mk');
    Route::post('/ajaxCekKrs', [AkadControllerKrs::class, 'ajaxCekKrs'])->name('ajaxCekKrs');
    Route::get('hapus-mk/{id}', [AkadControllerKrs::class, 'deleteKrs'])->name('delete-krs');
    //lihat KRS
    Route::get('/KRS', [AkadControllerKrs::class, 'KRS'])->name('KRS');
    Route::post('/detail-KRS', [AkadControllerKrs::class, 'viewKrs'])->name('detail-KRS');

    //rekap-nilai
    Route::get('/rekap-nilai', [AkadControllerRekapNilai::class, 'viewTranskrip'])->name('rekap-nilai');
    Route::get('/rekap-nilai/{id}', [AkadControllerRekapNilai::class, 'cetakTranskrip'])->name('cetak-rekap-nilai');

    // Route::get('/tugas-akhir', function () {
    //     return view('pages.akademik.tugas-akhir');
    // });
    Route::get('/tugas-akhir', [TugasAkhirController::class, 'judulSkripsi'])->name('tugas-akhir');
    Route::post('/insert-akhir', [TugasAkhirController::class, 'insertJudulSkripsi'])->name('insert-akhir');
    // Route::get('/wisuda', function () {
    //     return view('pages.akademik.wisuda');
    // });

    Route::get('/wisuda', [WisudaController::class, 'viewUploadWisuda'])->name('wisuda');
    Route::post('/wisuda-upload', [WisudaController::class, 'prosesUploadWisuda'])->name('wisuda-upload');

    Route::get('/keuangan', [KeuanganController::class, 'keuangan'])->name('keuangan');

    Route::get('/message', function () {
        return view('pages.message.message');
    });
    Route::get('/tulis-pesan', function () {
        return view('pages.message.tulis-pesan');
    });
    Route::get('/jadwal-kuliah', [JadwalKuliahController::class, 'viewJadwalKuliah'])->name('jadwal-kuliah');

    Route::get('/jadwal-ujian', [JadwalUjianController::class, 'viewJadwalUjian'])->name('jadwal-ujian');
    Route::get('/jadwal-ujian/{id}', [JadwalUjianController::class, 'viewJadwalUjian'])->name('jadwal-ujian');

    // Route::get('/presensi', function () {
    //     return view('pages.perkuliahan.presensi');
    // });
    Route::get('/presensi', [PresensiController::class, 'viewPresensi'])->name('presensi');
    Route::post('/presensi/detail', [PresensiController::class, 'detailPresensi'])->name('DetailPresensi');



    Route::get('/profile', [BiodataController::class, 'profile'])->name('profile');

    Route::get('/edit-profile', [BiodataController::class, 'editProfil'])->name('edit-profile');
    Route::post('/edit-profile-biodata', [BiodataController::class, 'updateProfil'])->name('update-profile');
    Route::post('/edit-profile-password', [BiodataController::class, 'updatePassword'])->name('update-password');

    Route::post('update-profile', [BiodataController::class, 'update'])->name('update_profile');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
