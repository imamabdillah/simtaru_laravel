<?php

namespace App\Http\Controllers\admin;

use App\Models\Peta;
use App\Models\Layer;
use App\Models\GrupLayer;
use App\Models\JenisPeta;
use App\Models\Collection;
use Illuminate\Support\Str;
use App\Models\AtributLayer;
use App\Models\ReferensiOpd;
use Illuminate\Http\Request;
use App\Models\ReferensiIcon;
use App\Models\ValueAttribut;
use App\Models\ReferensiKoordinat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;


class PetaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $daftar_opd = ReferensiOpd::select('id_opd', 'nama_opd')->groupBy('id_opd', 'nama_opd')->get();
        $layers = Layer::with('opd')->get(); // Ambil data dengan relasi nama_opd
        $grup_layers = GrupLayer::all();
        $jenis_peta = JenisPeta::all();
        $petas = Peta::all();

        return view('admin.peta.index', compact('daftar_opd', 'layers', 'grup_layers', 'jenis_peta', 'petas'));
    }

    public function daftarLayer(Request $request)
    {
        $layers = Layer::all(); // Ambil semua data layer
        return view('nama_view', compact('layers'));
    }

    // Grup Layer
    public function getGrupLayer()
    {
        $data = GrupLayer::all();
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function simpanGrupLayer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_grup_layer' => 'required|unique:tabel_grup_layer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        $grup = GrupLayer::create($request->all());


        return redirect()->back()->with('success', 'Grup Layer berhasil diperbarui.');
    }

    public function editGrupLayer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_grup_layer' => 'required|exists:grup_layers,id',
            'nama_grup_layer' => 'required|unique:grup_layers'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        $grup = GrupLayer::find($request->id_grup_layer);
        $grup->update($request->all());

        return response()->json(['status' => 'success']);
    }
    public function updateGrupLayer(Request $request, $id)
    {
        $grup_layer = GrupLayer::findOrFail($id);
        $grup_layer->update([
            'nama_grup_layer' => $request->nama_grup_layer
        ]);

        return redirect()->back()->with('success', 'Grup Layer berhasil diperbarui.');
    }


    public function hapusGrupLayer($id)
    {
        $grup_layer = GrupLayer::findOrFail($id);
        $grup_layer->delete();

        return redirect()->back()->with('success', 'Grup Layer berhasil dihapus.');
    }


    // Jenis Peta
    public function getJenisPeta()
    {
        $data = JenisPeta::all();
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function simpanJenisPeta(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_jenis_peta' => 'required|unique:tabel_jenis_peta'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        $jenis = JenisPeta::create($request->all());

        return redirect()->route('admin.peta')->with('success', 'Jenis Peta berhasil ditambahkan!');
    }


    public function updateJenisPeta(Request $request, $id)
    {
        $request->validate([
            'nama_jenis_peta' => 'required|string|max:255',
        ]);

        $jenisPeta = JenisPeta::findOrFail($id);
        $jenisPeta->update([
            'nama_jenis_peta' => $request->nama_jenis_peta
        ]);

        return redirect()->route('admin.peta')->with('success', 'Jenis Peta berhasil diperbarui!');
    }

    public function hapusJenisPeta($id)
    {
        $jenisPeta = JenisPeta::findOrFail($id);
        $jenisPeta->delete();

        return redirect()->route('admin.peta')->with('success', 'Jenis Peta berhasil dihapus!');
    }


    // CRUD Layer
    public function simpanLayer(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_layer' => 'required|string|max:255',
            'grup_layer' => 'required|exists:tabel_grup_layer,id_grup_layer',
            'jenis_peta' => 'required|exists:tabel_jenis_peta,id_jenis_peta',
            'opd' => 'required|exists:tabel_referensi_opd,id_opd',
            'sumber' => 'required|in:1,2', // 1 = Database, 2 = API
            'link_api' => 'nullable|required_if:sumber,2|url',
            'deskripsi_layer' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // Simpan data layer
        Layer::create([
            'nama_layer' => $request->nama_layer,
            'id_grup_layer' => $request->grup_layer,
            'id_jenis_peta' => $request->jenis_peta,
            'id_opd' => $request->opd,
            'sumber' => $request->sumber,
            'link_api' => $request->sumber == 2 ? $request->link_api : null,
            'deskripsi_layer' => $request->deskripsi_layer,
            'ditambah_oleh' => Auth::user()->id_user, // Tambahkan ini
            'diubah_oleh' => Auth::user()->id_user, // Tambahkan ini
        ]);

        return redirect()->route('admin.peta')->with('success', 'Jenis Peta berhasil ditambahkan!');
    }

    public function editLayer($id)
    {
        $layer = Layer::findOrFail($id);
        $daftar_grup_layer = GrupLayer::all();
        $daftar_jenis_peta = JenisPeta::all();
        $daftar_opd = ReferensiOPD::all();
        $atributs = AtributLayer::where('id_layer', $id)->whereNull('is_delete')->get();

        return view('admin.peta.kelola', compact('layer', 'daftar_grup_layer', 'daftar_jenis_peta', 'daftar_opd', 'atributs'));

    }

    public function updateLayer(Request $request, $id)
    {
        $request->validate([
            'nama_layer' => 'nullable|string|max:255',
            'grup_layer' => 'nullable|exists:tabel_grup_layer,id_grup_layer',
            'jenis_peta' => 'nullable|exists:tabel_jenis_peta,id_jenis_peta',
            'nama_opd' => 'nullable|exists:tabel_referensi_opd,id_opd',
            'status' => 'nullable|integer',
            'deskripsi_layer' => 'nullable|string',
        ]);

        $layer = Layer::findOrFail($id);
        $layer->update([
            'nama_layer' => $request->nama_layer,
            'id_grup_layer' => $request->grup_layer,
            'id_jenis_peta' => $request->jenis_peta,
            'id_opd' => $request->nama_opd,
            'status' => $request->status,
            'deskripsi_layer' => $request->deskripsi_layer,
        ]);


        return redirect()->route('admin.peta')->with('success', 'Layer berhasil diperbarui.');
    }


    public function hapusSemuaDataLayer($id)
    {
        try {
            Log::info("Memulai penghapusan data terkait Layer ID: " . $id);

            if (!is_numeric($id)) {
                Log::error("ID Layer tidak valid: " . $id);
                return response()->json(['error' => 'ID Layer tidak valid'], 400);
            }

            DB::transaction(function () use ($id) {
                // Hapus dari tabel_collection berdasarkan id_layer
                $deletedCollection = DB::table('tabel_collection')->where('id_layer', $id)->delete();
                Log::info("Jumlah data di tabel_collection yang dihapus: " . $deletedCollection);

                // Hapus dari tabel_value_attribut berdasarkan id_atribut yang ada di tabel_atribut_layer
                $deletedAttributes = DB::table('tabel_value_attribut')
                    ->whereIn('id_atribut', function ($query) use ($id) {
                        $query->select('id_atribut')
                            ->from('tabel_atribut_layer')
                            ->where('id_layer', $id);
                    })->delete();
                Log::info("Jumlah data di tabel_value_attribut yang dihapus: " . $deletedAttributes);
            });

            Log::info("Berhasil menghapus data terkait Layer ID: " . $id);
            return response()->json(['success' => true, 'message' => 'Data terkait berhasil dihapus'], 200);
        } catch (\Exception $e) {
            Log::error("Gagal menghapus data terkait Layer ID: $id. Error: " . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan saat menghapus data'], 500);
        }
    }


    public function hapusLayer($id)
    {
        try {
            $layer = Layer::findOrFail($id);
            $layer->delete();

            return response()->json(['success' => true, 'message' => 'Layer berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus layer']);
        }
    }



    public function switchNotif(Request $request)
    {
        $layer = Layer::findOrFail($request->id);
        $layer->update([
            'notif_status' => $request->value
        ]);

        return response()->json(['status' => 'success']);
    }

    public function updatePerbaikan(Request $request)
    {
        $layer = Layer::find($request->id);

        if ($layer) {
            $layer->is_perbaikan = $request->status; // Simpan status dari request
            $layer->save();

            return response()->json(['success' => true, 'message' => 'Status diperbarui!']);
        }

        return response()->json(['success' => false, 'message' => 'Layer tidak ditemukan!']);
    }

    public function storeAtribut(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'atribut_id_layer' => 'required|integer',
                'atribut_nama_atribut' => 'required|array', // Pastikan ini array
                'atribut_nama_atribut.*' => 'required|string', // Setiap elemen array harus string
                'atribut_tipe_atribut' => 'required|array', // Pastikan ini array
                'atribut_tipe_atribut.*' => 'required|integer', // Setiap elemen array harus integer
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }

            // Simpan data layer
            foreach ($request->atribut_nama_atribut as $key => $nama_atribut) {
                AtributLayer::create([
                    'nama_atribut' => $nama_atribut,
                    'id_layer' => $request->atribut_id_layer,
                    'slug' => strtolower(str_replace(' ', '_', $nama_atribut)),
                    'tipe_data' => $request->atribut_tipe_atribut[$key], // Mengambil tipe atribut sesuai indeks
                    'added' => now(),
                    'edited' => now(),
                    'add_by' => Auth::user()->id_user, // Tambahkan ini
                ]);
            }

            if ($request->ajax()) {
                return response()->json([
                    'success' => 'Atribut berhasil ditambahkan!',
                    'redirect' => url('admin/peta/layer/edit/' . $request->atribut_id_layer)
                ]);
            } else {
                return redirect()->back()->with('success', 'Atribut berhasil ditambahkan!');
            }

        } catch (\Throwable $th) {
            throw $th;
        }

    }

    public function getAtribut($id)
    {
        $atribut = AtributLayer::findOrFail($id);
        return view('admin.peta.edit_atribut', compact('atribut'));
    }


    public function deleteAtribut($id)
    {
        try {
            $atribut = AtributLayer::findOrFail($id);
            $atribut->delete();

            return response()->json(['success' => true, 'message' => 'Layer berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus layer']);
        }
    }

    public function hapusAtribut($id)
    {
        $atribut = AtributLayer::findOrFail($id);
        $atribut->delete();

        return redirect()->back()->with('success', 'Atribut berhasil dihapus!');
    }


    public function updateAtributLayer(Request $request, $id)
    {
        $request->validate([
            'ubah_atribut_nama' => 'required|string|max:255',
            'ubah_tipe_atribut' => 'required',
        ]);

        $atributLayer = AtributLayer::findOrFail($id);
        $atributLayer->update([
            'nama_atribut' => $request->ubah_atribut_nama,
            'tipe_data' => $request->ubah_tipe_atribut,
        ]);

        return redirect()->to($request->previous_url)->with('success', 'Atribut layer berhasil diperbarui!');
    }

    public function kelolaDataLayer($id_layer)
    {
        $layer = Layer::with('opd')->findOrFail($id_layer);
        $atribut = AtributLayer::where('id_layer', $id_layer)->get();

        // Mengambil data nilai atribut dengan join berdasarkan id_atribut
        $data_peta = ValueAttribut::whereHas('collection', function ($query) use ($id_layer) {
            $query->where('id_layer', $id_layer);
        })
        ->with(['atribut', 'collection'])
        ->get()
        ->groupBy('id_collection');

        return view('admin.peta.kelola_data_layer', compact('layer', 'atribut', 'data_peta'));
        
    }

    public function getTipeLayer($id_collection){
        $collection = Collection::findOrFail($id_collection);
        if ($collection) {
            return response()->json([
                'tipe_layer' => $collection->tipe_layer,
                'success' => true
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'Data tidak ditemukan'
        ]);
    }

    public function addDataLayer(Request $request)
    {
        $request->validate([
            'id_layer'   => 'required|exists:tabel_layer,id_layer',
            'tipe_layer' => 'required|in:point,line,polygon', // Pastikan tipe layer valid
        ]);

        $tipe_layer = $request->tipe_layer;
        $id = $request->id_layer;

        if ($tipe_layer == 'point') {
            return redirect()->route('admin.peta.add_data_layer_point', $id);
        } elseif ($tipe_layer == 'line') {
            return redirect()->route('admin.peta.add_data_layer_line', $id);
        } elseif ($tipe_layer == 'polygon') {
            return redirect()->route('admin.peta.add_data_layer_polygon', $id);
        }

        return back()->with('error', 'Tipe layer tidak valid.');
    }


    public function addDataLayerPoint(Request $request, $id)
    {
        $id_layer = $request->segment(4);
        $tipe_layer = ucfirst($request->segment(5));
        $layer = Layer::findOrFail($id);
        $atribut = AtributLayer::where('id_layer', $id)->get();
        $koordinat = ReferensiKoordinat::all();
        $data_icon = ReferensiIcon::all();
        
        return view('admin.peta.tambah_data_point', compact('layer', 'data_icon', 'koordinat', 'atribut', 'tipe_layer', 'id_layer'));
    }

    public function addDataLayerLine(Request $request, $id)
    {
        $id_layer = $request->segment(4);
        $tipe_layer = ucfirst($request->segment(5));
        $layer = Layer::findOrFail($id);
        $atribut = AtributLayer::where('id_layer', $id)->get();
        $koordinat = ReferensiKoordinat::all();
        $data_icon = ReferensiIcon::all();

        return view('admin.peta.tambah_data_line', compact('layer', 'data_icon', 'koordinat', 'atribut', 'tipe_layer', 'id_layer'));
    }

    public function addDataLayerPolygon(Request $request, $id)
    {
        $id_layer = $request->segment(4);
        $tipe_layer = ucfirst($request->segment(5));
        $layer = Layer::findOrFail($id);
        $atribut = AtributLayer::where('id_layer', $id)->get();
        $koordinat = ReferensiKoordinat::all();
        // kemungkinan nanti butuh data dari tabel collection

        return view('admin.peta.tambah_data_polygon', compact('layer', 'koordinat', 'atribut', 'tipe_layer', 'id_layer'));
    }

    public function getKoordinat(Request $request)
    {
        $query = ReferensiKoordinat::query();

        // Jika ada parameter pencarian (search), lakukan filter berdasarkan nama atau atribut lain
        if ($request->has('search')) {
            $query->where('nama_koordinat', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan tipe jika dikirimkan
        if ($request->has('type')) {
            $query->where('tipe_koordinat', $request->type);
        }

        // Ambil data
        $data = $query->limit(10)->get();

        // Format data sesuai kebutuhan Select2
        $formatted_data = $data->map(function ($item) {
            return [
                'id' => $item->id_koordinat,
                'text' => $item->nama_koordinat,
                'data' => [
                    'tipe_koordinat' => $item->tipe_koordinat,
                    'koordinat' => $item->koordinat
                ]
            ];
        });

        return response()->json($formatted_data);
    }

    public function editDataPetaGeojson($id)
    {
        $collection = DB::table('tabel_collection')->where('id_collection', $id)->first();
    
        if (!$collection) {
            return response()->json([
                'type' => 'FeatureCollection',
                'features' => []
            ], 200);
        }
    
        $geojson = [
            'type' => 'FeatureCollection',
            'features' => [
                [
                    'type' => 'Feature',
                    'properties' => new \stdClass(), // Objek kosong untuk properti
                    'geometry' => [
                        'type' => $collection->tipe_layer,
                        'coordinates' => json_decode($collection->koordinat)
                    ]
                ]
            ]
        ];
    
        return response()->json($geojson, 200);
    }
    

    public function storePetaPoint(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_layer' => 'required|integer',
            'tipe_layer' => 'required|in:Point,LineString,Polygon',
            'name' => 'required|string|max:255',
            'coordinates' => 'required|string',
            'stroke' => 'nullable|string|max:15',
            'stroke_opacity' => 'nullable|numeric|min:0|max:1',
            'stroke_width' => 'nullable|integer|min:0',
            'stroke_dash' => 'nullable|string|max:255',
            'fill' => 'nullable|string|max:15',
            'fill_opacity' => 'nullable|numeric|min:0|max:1',
            'icon_name' => 'nullable|string|max:255',
            'page_detail' => 'nullable|boolean',
        ]);

        // Simpan data ke database
        $data = Collection::create([
            'id_layer' => $request->id_layer,
            'tipe_layer' => $request->tipe_layer,
            'stroke' => $request->stroke,
            'stroke_opacity' => $request->stroke_opacity,
            'stroke_width' => $request->stroke_width,
            'stroke_dash' => $request->stroke_dash,
            'fill' => $request->fill,
            'fill_opacity' => $request->fill_opacity,
            'icon_name' => $request->icon_name,
            'page_detail' => $request->page_detail ? 1 : 0,
            'koordinat' => $request->coordinates,
            'name' => $request->name,
            'group' => $request->group,
            'add_by' => Auth::id(),
        ]);

        // Simpan data atribut
        $atributs = AtributLayer::where('id_layer', $request->id_layer)->get();
        foreach ($atributs as $atribut) {
            ValueAttribut::create([
                'id_atribut' => $atribut->id_atribut,
                'id_collection' => $data->id_collection,
                'data_value' => $request->input($atribut->slug),
                'created' => now(),
                'edited' => now(),
                'add_by' => Auth::id(),
            ]);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil disimpan!',
            'data' => $data
        ]);
    }

    public function storePetaLine(Request $request)
    {
        try {
        $request->validate([
            'id_layer' => 'required|integer',
            'tipe_layer' => 'required|in:Point,LineString,Polygon',
            'name' => 'required|string|max:255',
            'coordinates' => 'required|string',
            'stroke' => 'nullable|string|max:15',
            'stroke_opacity' => 'nullable|numeric|min:0|max:1',
            'stroke_width' => 'nullable|integer|min:0',
            'stroke_dash' => 'nullable|string|max:255',
            'fill' => 'nullable|string|max:15',
            'fill_opacity' => 'nullable|numeric|min:0|max:1',
            'icon_name' => 'nullable|string|max:255',
            'page_detail' => 'nullable|boolean',
        ]);

        // Simpan data ke database
        $data = Collection::create([
            'id_layer' => $request->id_layer,
            'tipe_layer' => $request->tipe_layer,
            'stroke' => $request->stroke,
            'stroke_opacity' => $request->stroke_opacity,
            'stroke_width' => $request->stroke_width,
            'stroke_dash' => $request->stroke_dash,
            'fill' => $request->fill,
            'fill_opacity' => $request->fill_opacity,
            'icon_name' => $request->icon_name,
            'page_detail' => $request->page_detail ? 1 : 0,
            'koordinat' => $request->coordinates,
            'name' => $request->name,
            'group' => $request->group,
            'add_by' => Auth::id(),
        ]);

        // Simpan data atribut
        $atributs = AtributLayer::where('id_layer', $request->id_layer)->get();
        foreach ($atributs as $atribut) {
            ValueAttribut::create([
                'id_atribut' => $atribut->id_atribut,
                'id_collection' => $data->id_collection,
                'data_value' => $request->input($atribut->slug),
                'created' => now(),
                'edited' => now(),
                'add_by' => Auth::id(),
            ]);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil disimpan!',
            'data' => $data
        ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function storePetaPolygon(Request $request)
    {
        try {
        $request->validate([
            'id_layer' => 'required|integer',
            'tipe_layer' => 'required|in:Point,LineString,Polygon',
            'name' => 'required|string|max:255',
            'coordinates' => 'required|string',
            'stroke' => 'nullable|string|max:15',
            'stroke_opacity' => 'nullable|numeric|min:0|max:1',
            'stroke_width' => 'nullable|integer|min:0',
            'stroke_dash' => 'nullable|string|max:255',
            'fill' => 'nullable|string|max:15',
            'fill_opacity' => 'nullable|numeric|min:0|max:1',
            'icon_name' => 'nullable|string|max:255',
            'page_detail' => 'nullable|boolean',
        ]);

        // Simpan data ke database
        $data = Collection::create([
            'id_layer' => $request->id_layer,
            'tipe_layer' => $request->tipe_layer,
            'stroke' => $request->stroke,
            'stroke_opacity' => $request->stroke_opacity,
            'stroke_width' => $request->stroke_width,
            'stroke_dash' => $request->stroke_dash,
            'fill' => $request->fill,
            'fill_opacity' => $request->fill_opacity,
            'icon_name' => $request->icon_name,
            'page_detail' => $request->page_detail ? 1 : 0,
            'koordinat' => $request->coordinates,
            'name' => $request->name,
            'group' => $request->group,
            'add_by' => Auth::id(),
        ]);

        // Simpan data atribut
        $atributs = AtributLayer::where('id_layer', $request->id_layer)->get();
        foreach ($atributs as $atribut) {
            ValueAttribut::create([
                'id_atribut' => $atribut->id_atribut,
                'id_collection' => $data->id_collection,
                'data_value' => $request->input($atribut->slug),
                'created' => now(),
                'edited' => now(),
                'add_by' => Auth::id(),
            ]);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil disimpan!',
            'data' => $data
        ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function editDataLayer($id_collection)
    {
        // Ambil data collection dan pastikan ada relasi ke layer
        $collection = Collection::with('layer')->findOrFail($id_collection);
    
        // Ambil id_layer dan tipe_layer dari hasil query
        $tipe_layer = $collection->tipe_layer; 
    
        // Redirect berdasarkan tipe layer
        if ($tipe_layer == 'Point') {
            return redirect()->route('admin.peta.edit_data_layer_point', $id_collection);
        } elseif ($tipe_layer == 'LineString') {
            return redirect()->route('admin.peta.edit_data_layer_line', $id_collection);
        } elseif ($tipe_layer == 'Polygon') {
            return redirect()->route('admin.peta.edit_data_layer_polygon', $id_collection);
        } else {
            return back()->with('error', 'Tipe layer tidak valid.');
        }
    
    }
    

    public function editDataLayerPoint($id_collection)
    {
        // Ambil data collection beserta layer & atribut
        $collection = Collection::with(['layer'])->findOrFail($id_collection);
        $id_layer = $collection->id_layer;
        $layer = $collection->layer;
        $tipe_layer = $collection->tipe_layer;
        $atribut = AtributLayer::where('id_layer', $id_layer)->get();
        $koordinat = ReferensiKoordinat::all();
        $data_icon = ReferensiIcon::all();
    
        return view('admin.peta.edit_data_point', compact('collection', 'layer', 'data_icon', 'koordinat', 'atribut', 'id_layer', 'tipe_layer'));
    }
    
    public function editDataLayerLine($id_collection)
    {
        $collection = Collection::with(['layer'])->findOrFail($id_collection);
        $id_layer = $collection->id_layer;
        $layer = $collection->layer;
        $tipe_layer = $collection->tipe_layer;
        $atribut = AtributLayer::where('id_layer', $id_layer)->get();
        $koordinat = ReferensiKoordinat::all();
        $data_icon = ReferensiIcon::all();
    
        return view('admin.peta.edit_data_line', compact('collection', 'tipe_layer', 'layer', 'data_icon', 'koordinat', 'atribut', 'id_layer'));
    }
    
    public function editDataLayerPolygon($id_collection)
    {
        $collection = Collection::with(['layer'])->findOrFail($id_collection);
        $id_layer = $collection->id_layer;
        $layer = $collection->layer;
        $tipe_layer = $collection->tipe_layer;
        $atribut = AtributLayer::where('id_layer', $id_layer)->get();
        $koordinat = ReferensiKoordinat::all();
    
        return view('admin.peta.edit_data_polygon', compact('collection', 'tipe_layer' , 'layer', 'koordinat', 'atribut', 'id_layer'));
    }

    public function editDataLayer2($id_collection)
    {
        // Ambil data collection beserta layer & atribut
        // $collection = Collection::with(['layer'])->findOrFail($id_collection);
        $collection = Collection::findOrFail($id_collection);
        $id_layer = $collection->id_layer;
        $layer = $collection->layer;
        $tipe_layer = $collection->tipe_layer;
        $atribut = AtributLayer::where('id_layer', $id_layer)->get();
        $koordinat = ReferensiKoordinat::all();
        $data_icon = ReferensiIcon::all(); // Untuk point & line
        
        
        // Tentukan view berdasarkan tipe layer
        $view = match ($tipe_layer) {
            'Point'   => 'admin.peta.edit_data_point',
            'LineString'    => 'admin.peta.edit_data_line',
            'Polygon' => 'admin.peta.edit_data_polygon',
            default   => null
        };
    
        // Jika tipe layer tidak valid, kembali dengan error
        if (!$view) {
            return back()->with('error', 'Tipe layer tidak valid.');
        }
    
        // Tentukan data tambahan berdasarkan tipe layer
        $data = compact('collection', 'layer', 'koordinat', 'atribut', 'id_layer');
        if (in_array($tipe_layer, ['point', 'line'])) {
            $data['data_icon'] = $data_icon;
        }
    
        return view($view, $data);
    }

    public function editDataLayer3($id_layer, $tipe_layer, $id_collection)
    {
        // Ambil data collection berdasarkan id_collection
        $collection = Collection::findOrFail($id_collection);
        $id_layer = $collection->id_layer;
        $layer = $collection->layer;
        $tipe_layer = $collection->tipe_layer;
        $atribut = AtributLayer::where('id_layer', $id_layer)->get();
        $koordinat = ReferensiKoordinat::all();
        $data_icon = ReferensiIcon::all(); // Untuk point & line
        $nilai_atribut = ValueAttribut::where('id_collection', $id_collection)
            ->pluck('data_value', 'id_atribut');
    
        // Tentukan view berdasarkan tipe layer
        $view = match ($tipe_layer) {
            'Point'   => 'admin.peta.edit_data_point',
            'LineString'    => 'admin.peta.edit_data_line',
            'Polygon' => 'admin.peta.edit_data_polygon',
            default   => null
        };
    
        // Jika tipe layer tidak valid, kembali dengan error
        if (!$view) {
            return back()->with('error', 'Tipe layer tidak valid.');
        }
    
        // Tentukan data tambahan berdasarkan tipe layer
        $data = compact('collection', 'koordinat', 'atribut', 'id_layer', 'tipe_layer', 'layer', 'nilai_atribut');
        if (in_array($tipe_layer, ['Point', 'LineString'])) {
            $data['data_icon'] = $data_icon;
        }
    
        return view($view, $data);
    }
    
    
    public function updateDataLayerPoint(Request $request, $id_collection)
    {
        try {
            //code...
            // Validasi input
            $request->validate([
                'id_layer' => 'required|integer',
                'tipe_layer' => 'required|in:Point,LineString,Polygon',
                'name' => 'required|string|max:255',
                'coordinates' => 'required|string',
                'stroke' => 'nullable|string|max:15',
                'stroke_opacity' => 'nullable|numeric|min:0|max:1',
                'stroke_width' => 'nullable|integer|min:0',
                'stroke_dash' => 'nullable|string|max:255',
                'fill' => 'nullable|string|max:15',
                'fill_opacity' => 'nullable|numeric|min:0|max:1',
                'icon_name' => 'nullable|string|max:255',
                'page_detail' => 'nullable|boolean',
            ]);
        
            // Cari data berdasarkan id_collection
            $data = Collection::find($id_collection);
            
            if (!$data) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data tidak ditemukan!'
                ], 404);
            }
        
            // Update data di database
            $data->update([
                'id_layer' => $request->id_layer,
                'tipe_layer' => $request->tipe_layer,
                'stroke' => $request->stroke,
                'stroke_opacity' => $request->stroke_opacity,
                'stroke_width' => $request->stroke_width,
                'stroke_dash' => $request->stroke_dash,
                'fill' => $request->fill,
                'fill_opacity' => $request->fill_opacity,
                'icon_name' => $request->icon_name,
                'page_detail' => $request->page_detail ? 1 : 0,
                'koordinat' => $request->coordinates,
                'name' => $request->name,
                'group' => $request->group,
                'edited' => now(),
            ]);
        
            // Update data atribut
            $atributs = AtributLayer::where('id_layer', $request->id_layer)->get();
            foreach ($atributs as $atribut) {
                ValueAttribut::updateOrCreate(
                    [
                        'id_atribut' => $atribut->id_atribut,
                        'id_collection' => $data->id_collection,
                    ],
                    [
                        'data_value' => $request->input($atribut->slug),
                        'edited' => now(),
                        'add_by' => Auth::id(),
                    ]
                );
            }
        
            // return response()->json([
            //     'status' => 'success',
            //     'message' => 'Data berhasil diperbarui!',
            //     'data' => $data
            // ]);
            return redirect()->route('admin.peta')->with('success', 'Layer berhasil diperbarui.');
            } catch (\Throwable $th) {
                throw $th;
            }
    }
    

}
