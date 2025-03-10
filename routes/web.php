<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BerandaController;
use App\Http\Controllers\admin\PetaController;

Route::name('auth.')->group(base_path('routes/public/auth.php'));

// Public
Route::name('public.')->group(base_path('routes/public/index.php'));
// Route::name('admin.')->group(base_path('routes/admin.php'));

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/beranda', [BerandaController::class, 'index'])->name('admin.dashboard');
    Route::get('/beranda/data-per-layer', [BerandaController::class, 'dataPerLayer']);
    Route::get('/beranda/layer-per-opd', [BerandaController::class, 'layerPerOpd']);
    Route::get('/beranda/data-per-opd', [BerandaController::class, 'dataPerOpd']);
    Route::get('/beranda/layer-per-grup-layer', [BerandaController::class, 'layerPerGrupLayer']);
    Route::get('/beranda/data-per-grup-layer', [BerandaController::class, 'dataPerGrupLayer']);
    Route::get('/beranda/layer-per-jenis-peta', [BerandaController::class, 'layerPerJenisPeta']);
    Route::get('/beranda/data-per-jenis-peta', [BerandaController::class, 'dataPerJenisPeta']);
    Route::get('/beranda/data-per-status', [BerandaController::class, 'dataPerStatus']);
    Route::get('/beranda/data-per-halaman-detail', [BerandaController::class, 'dataPerHalamanDetail']);

    // route manajemen peta
    Route::prefix('/peta')->group(function() {
        Route::get('/', [PetaController::class, 'index'])->name('admin.peta');
    
        // Layer Management
        Route::get('/daftar_layer', [PetaController::class, 'daftarLayer'])->name('admin.peta.daftar_layer_peta');
        Route::get('/get_layer', [PetaController::class, 'getLayers'])->name('layer_peta.getLayers');
        Route::post('/simpan_layer', [PetaController::class, 'simpanLayer'])->name('admin.peta.simpan_layer');
        Route::post('/switch_notif', [PetaController::class, 'switchNotif'])->name('admin.peta.switch_notif');
        Route::post('/update-layer-perbaikan', [PetaController::class, 'updatePerbaikan'])->name('layer.updatePerbaikan');
        Route::delete('/hapus_layer/{id}', [PetaController::class, 'hapusLayer'])->name('admin.peta.hapus_layer');
        Route::get('/edit_layer/{id}', [PetaController::class, 'editLayer'])->name('admin.peta.edit_layer');
        Route::post('/update_layer/{id}', [PetaController::class, 'updateLayer'])->name('admin.peta.update_layer');
        


    
        // Grup Layer Management
        Route::get('/get_grup_layer', [PetaController::class, 'getGrupLayer'])->name('admin.peta.get_grup_layer');
        Route::post('/simpan_grup_layer', [PetaController::class, 'simpanGrupLayer'])->name('admin.peta.simpan_grup_layer');
        Route::put('/update_grup_layer/{id}', [PetaController::class, 'updateGrupLayer'])->name('admin.peta.update_grup_layer');
        Route::delete('/hapus_grup_layer/{id}', [PetaController::class, 'hapusGrupLayer'])->name('admin.peta.hapus_grup_layer');

    
        // Jenis Peta Management
        Route::get('/get_jenis_peta', [PetaController::class, 'getJenisPeta'])->name('admin.peta.get_jenis_peta');
        Route::post('/simpan_jenis_peta', [PetaController::class, 'simpanJenisPeta'])->name('admin.peta.simpan_jenis_peta');
        Route::put('/update-jenis-peta/{id}', [PetaController::class, 'updateJenisPeta'])->name('admin.peta.update_jenis_peta');
        Route::delete('/hapus_jenis_peta/{id}', [PetaController::class, 'hapusJenisPeta'])->name('admin.peta.hapus_jenis_peta');


        // Atribut Data Layer Management
    Route::post('/atribut/tambah', [PetaController::class, 'storeAtribut'])->name('admin.peta.store_atribut');
    Route::post('/atribut/update', [PetaController::class, 'updateAtribut'])->name('admin.peta.update_atribut');
    // Route::delete('/atribut/delete/{id}', [PetaController::class, 'deleteAtribut'])->name('admin.peta.delete_atribut');    
    Route::delete('/atribut/hapus_atribut_layer/{id}', [PetaController::class, 'hapusAtribut'])->name('admin.peta.hapus_atribut_layer');
    Route::get('/edit_layer/{id}/atribut', [PetaController::class, 'getAtribut'])
    ->name('admin.peta.get_atribut');


        
    });
});
