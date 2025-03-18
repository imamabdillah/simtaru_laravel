<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\GrupController;
use App\Http\Controllers\Admin\PetaController;
use App\Http\Controllers\Admin\BerandaController;

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
        Route::delete('/hapus_semua_data_layer/{id}', [PetaController::class, 'hapusSemuaDataLayer'])->name('admin.peta.hapus_semua_data_layer');
        Route::delete('/hapus_layer/{id}', [PetaController::class, 'hapusLayer'])->name('admin.peta.hapus_layer');
        Route::get('/edit_layer/{id}', [PetaController::class, 'editLayer'])->name('admin.peta.edit_layer');
        Route::post('/update_layer/{id}', [PetaController::class, 'updateLayer'])->name('admin.peta.update_layer');


        // kelola data layer


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
        Route::put('/update-attribut/{id}', [PetaController::class, 'updateAtributLayer'])->name('admin.peta.update_atribut_layer');
        Route::delete('/atribut/hapus_atribut_layer/{id}', [PetaController::class, 'hapusAtribut'])->name('admin.peta.hapus_atribut_layer');
        Route::get('/atribut/edit/{id}', [PetaController::class, 'getAtribut'])->name('admin.peta.get_atribut');


        // Data Layer Management
        Route::get('/kelola/{id_layer}', [PetaController::class, 'kelolaDataLayer'])->name('admin.peta.kelola_data_layer');
        Route::get('/get_tipe_layer/{id_collection}', [PetaController::class, 'getTipeLayer']);
        Route::post('/data_peta/tambah', [PetaController::class, 'addDataLayer'])->name('admin.peta.add_data_layer');
        Route::get('/tambah_data_peta/{id}/point', [PetaController::class, 'addDataLayerPoint'])->name('admin.peta.add_data_layer_point');
        Route::get('/tambah_data_peta/{id}/linestring', [PetaController::class, 'addDataLayerLine'])->name('admin.peta.add_data_layer_line');
        Route::get('/tambah_data_peta/{id}/polygon', [PetaController::class, 'addDataLayerPolygon'])->name('admin.peta.add_data_layer_polygon');
        Route::post('/tambah_data_peta_point', [PetaController::class, 'storePetaPoint'])->name('admin.peta.simpan_data_peta_point');
        Route::post('/tambah_data_peta_stringline', [PetaController::class, 'storePetaLine'])->name('admin.peta.simpan_data_peta_line');
        Route::post('/tambah_data_peta_polygon', [PetaController::class, 'storePetaPolygon'])->name('admin.peta.simpan_data_peta_polygon');
        Route::delete('/hapus_data_peta/{id_collection}', [PetaController::class, 'hapusDataPeta'])->name('admin.peta.hapus_data_peta');


        // GET ROUTES
        Route::get('/ref-koordinat', [GrupController::class, 'refKoordinat'])->name('admin.peta.ref_koordinat');
        Route::get('/download-geojson/{id}/{name}', [GrupController::class, 'downloadGeojson'])->name('admin.peta.download_geojson');

        // POST ROUTES
        Route::post('/get-group', [GrupController::class, 'getGroup'])->name('admin.peta.get_group');
        Route::post('/get-layer-attribute', [GrupController::class, 'getLayerAttribute'])->name('admin.peta.get_layer_attribute');
        Route::post('/add-group', [GrupController::class, 'addGroup'])->name('admin.peta.add_group');
        Route::post('/edit-group', [GrupController::class, 'editGroup'])->name('admin.peta.edit_group');
        Route::post('/delete-group', [GrupController::class, 'deleteGroup'])->name('admin.peta.delete_group');
        Route::post('/get-group-detail', [GrupController::class, 'getGroupDetail'])->name('admin.peta.get_group_detail');
        Route::post('/get-group-items', [GrupController::class, 'getGroupItems'])->name('admin.peta.get_group_items');
        Route::post('/add-group-item', [GrupController::class, 'addGroupItem'])->name('admin.peta.add_group_item');
        Route::post('/delete-group-item', [GrupController::class, 'deleteGroupItem'])->name('admin.peta.delete_group_item');
        Route::post('/rename-group-item', [GrupController::class, 'renameGroupItem'])->name('admin.peta.rename_group_item');
        Route::post('/update-pos-group', [GrupController::class, 'updatePosGroup'])->name('admin.peta.update_pos_group');
        Route::post('/update-pos-group-item', [GrupController::class, 'updatePosGroupItem'])->name('admin.peta.update_pos_group_item');

        // Edit Data Layer Management
        Route::get('/edit_data_peta/{id_layer}/{tipe_layer}/{id_collection}', [PetaController::class, 'editDataLayer3'])
        ->name('admin.peta.edit_data_layer_3');
        Route::get('/edit_data_peta/point/{id}', [PetaController::class, 'editDataLayerPoint'])->name('admin.peta.edit_data_layer_point');
        Route::get('/edit_data_peta/line/{id}', [PetaController::class, 'editDataLayerLine'])->name('admin.peta.edit_data_layer_line');
        Route::get('/edit_data_peta/polygon/{id}', [PetaController::class, 'editDataLayerPolygon'])->name('admin.peta.edit_data_layer_polygon');
        Route::put('/update_data_peta/{id_collection}', [PetaController::class, 'updateDataLayer'])->name('admin.peta.update_data_layer');
        Route::get('/edit_data_peta_geojson/{id}', [PetaController::class, 'editDataPetaGeojson']);
        Route::get('/get_koordinat', [PetaController::class, 'getKoordinat'])->name('admin.peta.ref_koordinat');
        Route::get('/get_detail_page_status/{id_collection}', [PetaController::class, 'getStatusDetailPage']);
        Route::get('/import_template/{id_layer}', [PetaController::class, 'importTemplate']);
        Route::get('/diskripsi/{id_layer}/{id_collection}', [PetaController::class, 'diskripsiDataLayer'])->name('admin.peta.diskripsi_data_layer');
        Route::get('/get_foto', [PetaController::class, 'getFoto'])->name('admin.peta.get_foto');
        Route::post('/upload_foto', [PetaController::class, 'uploadFoto'])->name('admin.peta.upload_foto');
        Route::post('/delete_foto', [PetaController::class, 'deleteFoto'])->name('admin.peta.delete_foto');







    });
});
