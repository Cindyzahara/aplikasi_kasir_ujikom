<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\DetailPenjualanController;

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

// Route::get('/', function () {
//     return view('layout.main');
// });

//ROUTE LOGIN,REGISTRASI DAN LOGOUT
Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('/auth', [LoginController::class, 'auth'])->name('auth');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/registrasi', [LoginController::class, 'registrasi'])->name('registrasi'); // ROUTE REGISTRASI
Route::post('registrasi/auth', [LoginController::class, 'auth_regis'])->name('auth_regis'); // ROUTE PROSES REGISTRASI

Route::group(['middleware' => ['auth','CekRole:administrator,petugas']], function () {
    // ROUTE DASHBOARD
    route::Resource('/dashboard', DashboardController::class)->middleware('auth');

    // ROUTE PELANGGAN
    route::Resource('/pelanggan', PelangganController::class)->middleware(['auth','CekRole:administrator']);
    route::get('/export_pdf_pelanggan', [PelangganController::class, 'export_pdf'])->name('export_pdf_pelanggan');

    // ROUTE PRODUK 
    route::Resource('/produk', ProdukController::class);
    route::get('/export_excel_produk', [ProdukController::class, 'export_excel'])->name('export_excel_produk');
    route::get('/export_pdf_produk', [ProdukController::class, 'export_pdf'])->name('export_pdf_produk');
    route::post('/import_excel_produk', [ProdukController::class, 'import_excel'])->name('import_excel_produk');

    // ROUTE PENJUALAN
    route::Resource('/penjualan', PenjualanController::class);
    route::get('/export_pdf_penjualan', [PenjualanController::class, 'export_pdf'])->name('export_pdf_penjualan');
    route::get('/export_excel_penjualan', [PenjualanController::class, 'export_excel'])->name('export_excel_penjualan');

    // ROUTE DETAIL PENJUALAN
    route::Resource('/detail_penjualan', DetailPenjualanController::class);
    route::get('/export_excel_detpenjualan', [DetailPenjualanController::class, 'export_excel'])->name('export_excel_detpenjualan');
    route::get('/export_pdf_detpenjualan', [DetailPenjualanController::class, 'export_pdf'])->name('export_pdf_detpenjualan');
});

// ROUTE PENGGUNA
Route::group(['middleware' => ['auth','CekRole:administrator']], function () {
    route::Resource('/data_pengguna', PenggunaController::class);
    route::get('/export_excel_pengguna', [PenggunaController::class, 'export_excel'])->name('export_excel_pengguna');
    route::get('/export_pdf_pengguna', [PenggunaController::class, 'export_pdf'])->name('export_pdf_pengguna');
});


