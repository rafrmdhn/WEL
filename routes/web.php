<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\DashboardController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

Route::resource('cabang', CabangController::class);
Route::resource('jabatan', JabatanController::class);
Route::resource('pegawai', PegawaiController::class);

Route::get('/upload', [UploadController::class, 'index'])->name('upload.form');
Route::post('/upload', [UploadController::class, 'store'])->name('upload.store');

