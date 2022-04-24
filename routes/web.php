<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

use App\Models\Pelanggan;
use GuzzleHttp\Middleware;

// to backend
use App\Http\Controllers\Backend\MainController;
use App\Http\Controllers\Backend\PerumahanController;
use App\Http\Controllers\Backend\PelangganController;
use App\Http\Controllers\Backend\PembayaranController;
use App\Http\Controllers\Backend\InvoiceController;

// to Owne
use App\Http\Controllers\owner\PelController;


// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

Route::get('/', [AuthController::class, 'formLogin'])->name('login');
Route::get('login', [AuthController::class, 'formLogin'])->name('login');
Route::post('login', [AuthController::class, 'prosesLogin'])->name('prosesLogin');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::group([ 'prefix' => 'admin' ,'middleware' => 'isAdmin'], function() {
    Route::get('/', [MainController::class, 'getAdminPage'])->name('admin');

    // Pelanggan
    Route::resource('data-pelanggan', PelangganController::class);

    // pelanggan ditolak
    Route::get('data-pelanggan/verifikasi/ditolak', [PelangganController::class, 'VerDitolak'])->name('data-pelanggan.verifikasi-ditolak');
    Route::get('data-pelanggan/verifikasi/ditolak/{id}/edit', [PelangganController::class, 'editPelangganDitolak'])->name('data-pelanggan.edit');
    Route::post('data-pelanggan/verifikasi/ditolak/update', [PelangganController::class, 'updatePelangganDitolak'])->name('updatePelangganDitolak');
    Route::delete('data-pelanggan/verifikasi/ditolak/{id}/delete', [PelangganController::class, 'deletePelangganDitolak'])->name('deletePelangganDitolak');
    // end

    // pelanggan diterima
    Route::get('data-pelanggan/verifikasi/diterima', [PelangganController::class, 'pelangganVerfify'])->name('data-pelanggan.verify');
    Route::get('data-pelanggan/verifikasi/diterima/{id}/edit', [PelangganController::class, 'editPelangganVerify'])->name('data-pelanggan.edit');
    Route::post('data-pelanggan/verifikasi/diterima/update', [PelangganController::class, 'updatePelangganVerify'])->name('data-pelanggan.update');
    Route::post('data-pelanggan/verifikasi/diterima/delete/{id}', [PelangganController::class, 'deletePelangganVerify'])->name('data-pelanggan.putus');
    // end 

    Route::get('data-pelanggan/status/terputus', [PelangganController::class, 'getPelTerputus'])->name('data-pelanggan.terputus');
    Route::get('data-pelanggan/putus-permanen', [PelangganController::class, 'getPelPutus'])->name('data-pelanggan.putus-permanen');

    Route::post('data-pelanggan/filter', [PelangganController::class, 'perumahanPelanggan'])->name('perumahanPelanggan');
    Route::get('data-pelanggan/perumahan', [PelangganController::class, 'getPerumahan'])->name('getPerumahan');
    Route::post('data-pelanggan/import', [PelangganController::class, 'fileImport'])->name('importExcel');

    Route::resource('data-perumahan', PerumahanController::class);


    Route::resource('konfirmasi-pembayaran', PembayaranController::class);
    Route::post('konfirmasi-pembayaran/proses', [PembayaranController::class, 'prosesPembayaran'])->name('konfirmasi-pembayaran.proses');
    Route::get('konfirmasi-pembayaran/{id}/edit', [PembayaranController::class, 'edit'])->name('edit');
    Route::delete('konfirmasi-pembayaran/cancel', [PembayaranController::class, 'cancelKonfirmasi'])->name('cancelKonfirmasi');
    Route::post('konfirmasi-pembayaran/filter', [PembayaranController::class, 'filterBulan'])->name('filterBulan');
    Route::post('konfirmasi-pembayaran/search', [PembayaranController::class, 'showPelanggan'])->name('konfirmasi-pembayaran.search');

    Route::get('cek-pembayaran', [PembayaranController::class, 'cekPembayaran'])->name('cekPembayaran');

    Route::get('invoice', [InvoiceController::class, 'index'])->name('invoice.index');
    Route::get('invoice/print-all', [InvoiceController::class, 'printAll'])->name('printAll');
});

Route::group(['prefix' => 'owner', 'middleware' => 'isOwner'], function() {
    Route::get('/', [MainController::class, 'getOwnerPage'])->name('owner');

    Route::get('data-pelanggan', [PelController::class, 'getPelangganNew'])->name('getPelangganNew');
    Route::get('pelanggan/{id}/verifikasi', [PelController::class, 'verifikasiPelanggan'])->name('verifikasiPelanggan');
    Route::post('pelanggan/verifikasi/store/{id}', [PelController::class, 'verifikasiProses'])->name('pelanggan.verifikasiProses');
    Route::post('pelanggan/input/koreksi', [PelController::class, 'koreksiProses'])->name('pelanggan.koreksiProses');
    Route::get('pelanggan/verifikasi', [PelController::class, 'getPelangganVerify'])->name('getPelangganVerify');
    Route::get('pelanggan/ditolak', [PelController::class, 'getPelangganNotVerify'])->name('getPelangganNotVerify');
    Route::get('pelanggan/terputus', [PelController::class, 'getPelangganTerputus'])->name('getPelangganTerputus');
    Route::post('pelanggan/terputus/{id}/delete', [PelController::class, 'deletePelanggan'])->name('deletePelanggan');
    
});

