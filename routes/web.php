<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChefController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\OwnerController;

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

Route::get('/', [UserController::class, 'home'])->name('home');

Route::get('/detail/{id}', [UserController::class, 'detail'])->name('detail');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/postlogin', [AuthController::class, 'postlogin'])->name('postlogin');

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/keranjang', [UserController::class, 'keranjang'])->name('pelanggan.keranjang');
    Route::post('/keranjang/tambah/{menu}/{meja}', [UserController::class, 'postKeranjang'])->name('pelanggan.postKeranjang');
    Route::delete('/hapus-item/{id}', [UserController::class, 'hapusItem'])->name('pelanggan.hapusItem');
    Route::delete('/hapus-semua', [UserController::class, 'hapusSemua'])->name('pelanggan.hapusSemua');

    Route::get('/bayar/{detailtransaksi}', [UserController::class, 'bayar'])->name('pelanggan.bayar');
    Route::get('/bayar-semua', [UserController::class, 'bayarSemua'])->name('pelanggan.bayarSemua');
    Route::post('/prosesbayar/{detailtransaksi}', [UserController::class, 'prosesbayar'])->name('pelanggan.prosesbayar');
    Route::get('/summary', [UserController::class, 'summary'])->name('pelanggan.summary');
    Route::get('/sukses/{id}', [UserController::class, 'sukses'])->name('pelanggan.sukses');

    Route::get('/mengelola_data_menu', [AdminController::class, 'mengelola_data_menu'])->name('mengelola_data_menu');
    Route::get('/tambah_menu', [AdminController::class, 'tambah_menu'])->name('tambah_menu');
    Route::post('/posttambah_menu', [AdminController::class, 'posttambah_menu'])->name('posttambah_menu');
    Route::get('/edit_menu/{id}', [AdminController::class, 'edit_menu'])->name('edit_menu');
    Route::post('/perbarui_menu/{id}', [AdminController::class, 'perbarui_menu'])->name('perbarui_menu');
    Route::delete('/hapus_menu/{id}', [AdminController::class, 'hapus_menu'])->name('hapus_menu');

    Route::get('/akun', [AdminController::class, 'akun'])->name('akun');
    Route::get('/pengguna/tambah', [AdminController::class, 'penggunatambah'])->name('pengguna.tambah');
    Route::post('/simpan_akun', [AdminController::class, 'simpan_akun'])->name('pengguna.simpan');
    Route::get('/edit_akun/{id}', [AdminController::class, 'ubah_akun'])->name('pengguna.ubah');
    Route::patch('/perbarui_akun/{id}', [AdminController::class, 'update_akun'])->name('pengguna.update');
    Route::delete('/hapus_akun/{id}', [AdminController::class, 'hapus_akun'])->name('pengguna.hapus');

    Route::get('/history_transaksi', [KasirController::class, 'history_transaksi'])->name('history_transaksi');
    Route::get('/kelolameja', [KasirController::class, 'kelolameja'])->name('kelolameja');
    Route::get('/meja/create', [KasirController::class, 'create'])->name('meja.create');
    Route::post('/meja', [KasirController::class, 'store'])->name('meja.store');
    Route::patch('/meja/{id}/toggle', [KasirController::class, 'toggleStatus'])->name('meja.toggleStatus');
    Route::delete('/meja/{id}', [KasirController::class, 'destroy'])->name('meja.destroy');

    Route::get('/list_daftar_pemesanan', [ChefController::class, 'daftar_pesanan'])->name('list_daftar_pemesanan');
    Route::post('/pesanan/{id}/selesai', [ChefController::class, 'selesai'])->name('transaksi.selesai');

    Route::get('/melihat_laporan_penjualan', [OwnerController::class, 'melihat_laporan_penjualan'])->name('melihat_laporan_penjualan');
    Route::delete('/penjualan/{id}', [OwnerController::class, 'destroy'])->name('penjualan.destroy');
    Route::get('/chart/pendapatan', [OwnerController::class, 'pendapatanBulanan'])->name('chart');
});
