<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BerandaController;

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/beranda', [BerandaController::class, 'index'])->name('admin.beranda');
    Route::get('/beranda/data-per-layer', [BerandaController::class, 'dataPerLayer']);
    Route::get('/beranda/layer-per-opd', [BerandaController::class, 'layerPerOpd']);
    Route::get('/beranda/data-per-opd', [BerandaController::class, 'dataPerOpd']);
    Route::get('/beranda/layer-per-grup-layer', [BerandaController::class, 'layerPerGrupLayer']);
    Route::get('/beranda/data-per-grup-layer', [BerandaController::class, 'dataPerGrupLayer']);
    Route::get('/beranda/layer-per-jenis-peta', [BerandaController::class, 'layerPerJenisPeta']);
    Route::get('/beranda/data-per-jenis-peta', [BerandaController::class, 'dataPerJenisPeta']);
    Route::get('/beranda/data-per-status', [BerandaController::class, 'dataPerStatus']);
    Route::get('/beranda/data-per-halaman-detail', [BerandaController::class, 'dataPerHalamanDetail']);
});
