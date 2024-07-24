<?php

use App\Http\Controllers\Admin\AdminGajiPekerjaController;
use App\Http\Controllers\Admin\AdminHargaSawitController;
use App\Http\Controllers\Admin\AdminJadwalPanenController;
use App\Http\Controllers\Admin\AdminLevelController;
use App\Http\Controllers\Admin\AdminPekerjaController;
use App\Http\Controllers\Admin\AdminPembelianController;
use App\Http\Controllers\Admin\AdminPeminjamanController;
use App\Http\Controllers\Admin\AdminPenjualanController;
use App\Http\Controllers\Admin\AdminPetaniController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrasiController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Pemilik\PemilikPembelianController;
use App\Http\Controllers\Pemilik\PemilikPenjualanController;
use App\Http\Controllers\Petani\PetaniHargaSawitController;
use App\Http\Controllers\Petani\PetaniJadwalPanenController;
use App\Http\Controllers\Petani\PetaniPembelianController;
use App\Http\Controllers\Petani\PetaniPeminjamanController;
use App\Http\Controllers\Setting\SettingController;
use App\Http\Controllers\Supir\SupirPembelianController;
use App\Http\Controllers\Supir\SupirPeminjamanController;
use App\Http\Controllers\Supir\SupirPenjualanController;
use App\Http\Middleware\CekLevel;
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

//  Login
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login-action', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::get('/reload-captcha', [LoginController::class, 'reloadcaptcha'])->name('reload-captcha');
Route::get('/logout-action', [LoginController::class, 'logout'])->name('login.logout');

// Registrasi
Route::get('/registrasi', [RegistrasiController::class, 'index'])->name('registrasi.index');
Route::post('/registrasi-action', [RegistrasiController::class, 'store'])->name('registrasi.store');

Route::group(['middleware' => ['auth', 'verified']], function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // Petani
    Route::get('/edit-biodata/petani/{id}', [DashboardController::class, 'editbiodatapetani'])->name('edit-biodatapetani.edit');
    Route::post('/update-biodata/petani/{id}', [DashboardController::class, 'updatebiodatapetani'])->name('update-biodatapetani.update');

    // Setting
    Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
    Route::post('/setting/updateprofile', [SettingController::class, 'updateprofile'])->name('setting.updateprofile');
    Route::post('/setting/updateusername', [SettingController::class, 'updateusername'])->name('setting.updateusername');
    Route::post('/setting/updatepassword', [SettingController::class, 'updatepassword'])->name('setting.updatepassword');
    Route::post('/setting/updategambar', [SettingController::class, 'updategambar'])->name('setting.updategambar');
    Route::post('/setting/hapusgambar', [SettingController::class, 'hapusgambar'])->name('setting.hapusgambar');

    // Admin
    Route::group(['middleware' => [CekLevel::class . ':1']], function () {

        // Gaji Pekerja
        Route::post('/data-gajipekerja/store', [AdminGajiPekerjaController::class, 'store'])->name('data-gajipekerja.store');
        Route::post('/data-gajipekerja/update', [AdminGajiPekerjaController::class, 'update'])->name('data-gajipekerja.update');

        // Data Peminjaman
        Route::get('/data-peminjaman', [AdminPeminjamanController::class, 'index'])->name('data-peminjaman.index');
        Route::get('/data-peminjaman/create', [AdminPeminjamanController::class, 'create'])->name('data-peminjaman.create');
        Route::get('/data-peminjaman/edit/{id}', [AdminPeminjamanController::class, 'edit'])->name('data-peminjaman.edit');
        Route::post('/data-peminjaman/store', [AdminPeminjamanController::class, 'store'])->name('data-peminjaman.store');
        Route::post('/data-peminjaman/update/{id}', [AdminPeminjamanController::class, 'update'])->name('data-peminjaman.update');
        Route::post('/data-peminjaman/diterima/{id}', [AdminPeminjamanController::class, 'diterima'])->name('data-peminjaman.diterima');
        Route::post('/data-peminjaman/ditolak/{id}', [AdminPeminjamanController::class, 'ditolak'])->name('data-peminjaman.ditolak');
        Route::post('/data-peminjaman/destroy/{id}', [AdminPeminjamanController::class, 'destroy'])->name('data-peminjaman.destroy');

        // Data Penjualan
        Route::get('/data-penjualan', [AdminPenjualanController::class, 'index'])->name('data-penjualan.index');
        Route::get('/data-penjualan/create', [AdminPenjualanController::class, 'create'])->name('data-penjualan.create');
        Route::get('/data-penjualan/edit/{id}', [AdminPenjualanController::class, 'edit'])->name('data-penjualan.edit');
        Route::post('/data-penjualan/store', [AdminPenjualanController::class, 'store'])->name('data-penjualan.store');
        Route::post('/data-penjualan/update/{id}', [AdminPenjualanController::class, 'update'])->name('data-penjualan.update');
        Route::post('/data-penjualan/destroy/{id}', [AdminPenjualanController::class, 'destroy'])->name('data-penjualan.destroy');

        // Data Pembelian
        Route::get('/data-pembelian', [AdminPembelianController::class, 'index'])->name('data-pembelian.index');
        Route::get('/data-pembelian/create', [AdminPembelianController::class, 'create'])->name('data-pembelian.create');
        Route::get('/data-pembelian/edit/{id}', [AdminPembelianController::class, 'edit'])->name('data-pembelian.edit');
        Route::post('/data-pembelian/store', [AdminPembelianController::class, 'store'])->name('data-pembelian.store');
        Route::post('/data-pembelian/update/{id}', [AdminPembelianController::class, 'update'])->name('data-pembelian.update');
        Route::post('/data-pembelian/destroy/{id}', [AdminPembelianController::class, 'destroy'])->name('data-pembelian.destroy');

        // Data Pekerja
        Route::get('/data-pekerja', [AdminPekerjaController::class, 'index'])->name('data-pekerja.index');
        Route::get('/data-pekerja/create', [AdminPekerjaController::class, 'create'])->name('data-pekerja.create');
        Route::get('/data-pekerja/edit/{id}', [AdminPekerjaController::class, 'edit'])->name('data-pekerja.edit');
        Route::post('/data-pekerja/store', [AdminPekerjaController::class, 'store'])->name('data-pekerja.store');
        Route::post('/data-pekerja/update/{id}', [AdminPekerjaController::class, 'update'])->name('data-pekerja.update');
        Route::post('/data-pekerja/destroy/{id}', [AdminPekerjaController::class, 'destroy'])->name('data-pekerja.destroy');

        // Harga Sawit
        Route::get('/data-hargasawit', [AdminHargaSawitController::class, 'index'])->name('data-hargasawit.index');
        Route::get('/data-hargasawit/create', [AdminHargaSawitController::class, 'create'])->name('data-hargasawit.create');
        Route::get('/data-hargasawit/edit/{id}', [AdminHargaSawitController::class, 'edit'])->name('data-hargasawit.edit');
        Route::post('/data-hargasawit/store', [AdminHargaSawitController::class, 'store'])->name('data-hargasawit.store');
        Route::post('/data-hargasawit/update/{id}', [AdminHargaSawitController::class, 'update'])->name('data-hargasawit.update');
        Route::post('/data-hargasawit/destroy/{id}', [AdminHargaSawitController::class, 'destroy'])->name('data-hargasawit.destroy');

        // Jadwal Panen
        Route::get('/data-jadwalpanen', [AdminJadwalPanenController::class, 'index'])->name('data-jadwalpanen.index');
        Route::get('/data-jadwalpanen/create', [AdminJadwalPanenController::class, 'create'])->name('data-jadwalpanen.create');
        Route::get('/data-jadwalpanen/edit/{id}', [AdminJadwalPanenController::class, 'edit'])->name('data-jadwalpanen.edit');
        Route::get('/data-jadwalpanen/show/{id}', [AdminJadwalPanenController::class, 'show'])->name('data-jadwalpanen.show');
        Route::post('/data-jadwalpanen/store', [AdminJadwalPanenController::class, 'store'])->name('data-jadwalpanen.store');
        Route::post('/data-jadwalpanen/update/{id}', [AdminJadwalPanenController::class, 'update'])->name('data-jadwalpanen.update');
        Route::post('/data-jadwalpanen/destroy/{id}', [AdminJadwalPanenController::class, 'destroy'])->name('data-jadwalpanen.destroy');

        // Petani
        Route::get('/data-petani', [AdminPetaniController::class, 'index'])->name('data-petani.index');
        Route::get('/data-petani/create', [AdminPetaniController::class, 'create'])->name('data-petani.create');
        Route::get('/data-petani/edit/{id}', [AdminPetaniController::class, 'edit'])->name('data-petani.edit');
        Route::post('/data-petani/store', [AdminPetaniController::class, 'store'])->name('data-petani.store');
        Route::post('/data-petani/update/{id}', [AdminPetaniController::class, 'update'])->name('data-petani.update');
        Route::post('/data-petani/destroy/{id}', [AdminPetaniController::class, 'destroy'])->name('data-petani.destroy');

        // Users Registrasi
        Route::get('/data-user', [AdminUserController::class, 'index'])->name('data-user.index');
        Route::get('/data-user/create', [AdminUserController::class, 'create'])->name('data-user.create');
        Route::get('/data-user/edit/{id}', [AdminUserController::class, 'edit'])->name('data-user.edit');
        Route::post('/data-user/store', [AdminUserController::class, 'store'])->name('data-user.store');
        Route::post('/data-user/update/{id}', [AdminUserController::class, 'update'])->name('data-user.update');
        Route::post('/data-user/destroy/{id}', [AdminUserController::class, 'destroy'])->name('data-user.destroy');

        // Level
        Route::get('/data-level', [AdminLevelController::class, 'index'])->name('data-level.index');
        Route::get('/data-level/create', [AdminLevelController::class, 'create'])->name('data-level.create');
        Route::get('/data-level/edit/{id}', [AdminLevelController::class, 'edit'])->name('data-level.edit');
        Route::post('/data-level/store', [AdminLevelController::class, 'store'])->name('data-level.store');
        Route::post('/data-level/update/{id}', [AdminLevelController::class, 'update'])->name('data-level.update');
        Route::post('/data-level/destroy/{id}', [AdminLevelController::class, 'destroy'])->name('data-level.destroy');

    });

    // Petani
    Route::group(['middleware' => [CekLevel::class . ':2']], function () {

        // Data Pembelian
        Route::get('/petani-pembelian', [PetaniPembelianController::class, 'index'])->name('petani-pembelian.index');

        // Data Peminjaman
        Route::get('/petani-peminjaman', [PetaniPeminjamanController::class, 'index'])->name('petani-peminjaman.index');
        Route::get('/petani-peminjaman/create', [PetaniPeminjamanController::class, 'create'])->name('petani-peminjaman.create');
        Route::get('/petani-peminjaman/edit/{id}', [PetaniPeminjamanController::class, 'edit'])->name('petani-peminjaman.edit');
        Route::post('/petani-peminjaman/store', [PetaniPeminjamanController::class, 'store'])->name('petani-peminjaman.store');
        Route::post('/petani-peminjaman/update/{id}', [PetaniPeminjamanController::class, 'update'])->name('petani-peminjaman.update');
        Route::post('/petani-peminjaman/destroy/{id}', [PetaniPeminjamanController::class, 'destroy'])->name('petani-peminjaman.destroy');

        // Harga Sawit
        Route::get('/petani-hargasawit', [PetaniHargaSawitController::class, 'index'])->name('petani-hargasawit.index');
        // Petani
        Route::get('/petani-jadwalpanen', [PetaniJadwalPanenController::class, 'index'])->name('petani-jadwalpanen.index');
        Route::get('/petani-jadwalpanen/create', [PetaniJadwalPanenController::class, 'create'])->name('petani-jadwalpanen.create');
        Route::get('/petani-jadwalpanen/edit/{id}', [PetaniJadwalPanenController::class, 'edit'])->name('petani-jadwalpanen.edit');
        Route::get('/petani-jadwalpanen/show/{id}', [PetaniJadwalPanenController::class, 'show'])->name('petani-jadwalpanen.show');
        Route::post('/petani-jadwalpanen/store', [PetaniJadwalPanenController::class, 'store'])->name('petani-jadwalpanen.store');
        Route::post('/petani-jadwalpanen/update/{id}', [PetaniJadwalPanenController::class, 'update'])->name('petani-jadwalpanen.update');
        Route::post('/petani-jadwalpanen/destroy/{id}', [PetaniJadwalPanenController::class, 'destroy'])->name('petani-jadwalpanen.destroy');
    });

    // Supir
    Route::group(['middleware' => [CekLevel::class . ':3']], function () {

        // Data Peminjaman
        Route::get('/supir-peminjaman', [SupirPeminjamanController::class, 'index'])->name('supir-peminjaman.index');
        Route::get('/supir-peminjaman/create', [SupirPeminjamanController::class, 'create'])->name('supir-peminjaman.create');
        Route::get('/supir-peminjaman/edit/{id}', [SupirPeminjamanController::class, 'edit'])->name('supir-peminjaman.edit');
        Route::post('/supir-peminjaman/store', [SupirPeminjamanController::class, 'store'])->name('supir-peminjaman.store');
        Route::post('/supir-peminjaman/update/{id}', [SupirPeminjamanController::class, 'update'])->name('supir-peminjaman.update');
        Route::post('/supir-peminjaman/destroy/{id}', [SupirPeminjamanController::class, 'destroy'])->name('supir-peminjaman.destroy');

        // Data Penjualan
        Route::get('/supir-penjualan', [SupirPenjualanController::class, 'index'])->name('supir-penjualan.index');
        Route::get('/supir-penjualan/create', [SupirPenjualanController::class, 'create'])->name('supir-penjualan.create');
        Route::get('/supir-penjualan/edit/{id}', [SupirPenjualanController::class, 'edit'])->name('supir-penjualan.edit');
        Route::post('/supir-penjualan/store', [SupirPenjualanController::class, 'store'])->name('supir-penjualan.store');
        Route::post('/supir-penjualan/update/{id}', [SupirPenjualanController::class, 'update'])->name('supir-penjualan.update');
        Route::post('/supir-penjualan/destroy/{id}', [SupirPenjualanController::class, 'destroy'])->name('supir-penjualan.destroy');

        // Data Pembelian
        Route::get('/supir-pembelian', [SupirPembelianController::class, 'index'])->name('supir-pembelian.index');
        Route::get('/supir-pembelian/create', [SupirPembelianController::class, 'create'])->name('supir-pembelian.create');
        Route::get('/supir-pembelian/edit/{id}', [SupirPembelianController::class, 'edit'])->name('supir-pembelian.edit');
        Route::post('/supir-pembelian/store', [SupirPembelianController::class, 'store'])->name('supir-pembelian.store');
        Route::post('/supir-pembelian/update/{id}', [SupirPembelianController::class, 'update'])->name('supir-pembelian.update');
        Route::post('/supir-pembelian/destroy/{id}', [SupirPembelianController::class, 'destroy'])->name('supir-pembelian.destroy');
    });

    // Pemilik Usaha
    Route::group(['middleware' => [CekLevel::class . ':5']], function () {
        Route::get('/pemilik-penjualan', [PemilikPenjualanController::class, 'index'])->name('pemilik-penjualan.index');
        Route::get('/pemilik-pembelian', [PemilikPembelianController::class, 'index'])->name('pemilik-pembelian.index');
    });
});
