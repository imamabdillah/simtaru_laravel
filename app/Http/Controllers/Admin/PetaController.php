<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReferensiOpd;
use App\Models\Layer;
use App\Models\GrupLayer;
use App\Models\JenisPeta;
use App\Models\Peta;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PetaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $daftar_opd = ReferensiOpd::select('id_opd', 'nama_opd')->groupBy('id_opd', 'nama_opd')->get();
        $layers = Layer::all();
        $grup_layers = GrupLayer::all();
        $jenis_peta = JenisPeta::all();
        $petas = Peta::all();
    
        return view('admin.peta.index', compact('daftar_opd', 'layers', 'grup_layers', 'jenis_peta', 'petas'));
    }
    public function getLayers(Request $request)
    {
        if ($request->ajax()) {
            $layers = Layer::select('id_layer', 'nama_layer', 'id_opd', 'sumber', 'status', 'is_perbaikan')->get();
            
            return DataTables::of($layers)
                ->addIndexColumn()
                ->editColumn('sumber', function ($layer) {
                    return match($layer->sumber) {
                        2 => 'API',
                        3 => 'File JSON',
                        default => 'Database',
                    };
                })
                ->editColumn('status', function ($layer) {
                    return $layer->status == 2 ? 'Sembunyikan' : 'Tampilkan';
                })
                ->addColumn('data_perbaikan', function ($layer) {
                    return '<input type="checkbox" class="switch_perbaikan" '.($layer->is_perbaikan ? 'checked' : '').' data-id="'.$layer->id_layer.'">';
                })
                ->addColumn('aksi', function ($layer) {
                    return '<div class="btn-group btn-group-sm">
                                <button data-id="'.$layer->id_layer.'" class="btn btn-default btn_download"><i class="fa fa-download"></i></button>
                                <button data-id="'.$layer->id_layer.'" class="btn btn-primary btn_data"><i class="fa fa-database"></i></button>
                                <button data-id="'.$layer->id_layer.'" class="btn btn-success btn_kelola"><i class="fa fa-edit"></i></button>
                                <button data-id="'.$layer->id_layer.'" class="btn btn-warning btn_group"><i class="fa fa-clone"></i></button>
                            </div>
                            <button data-id="'.$layer->id_layer.'" class="btn btn-danger btn-sm btn_clear"><i class="fa fa-times-rectangle"></i></button>
                            <button data-id="'.$layer->id_layer.'" class="btn btn-danger btn-sm btn_hapus"><i class="fa fa-trash"></i></button>';
                })
                ->rawColumns(['data_perbaikan', 'aksi'])
                ->make(true);
        }
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
            'nama_grup_layer' => 'required|unique:grup_layers'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        $grup = GrupLayer::create($request->all());
        
        return response()->json([
            'status' => 'success',
            'data' => GrupLayer::all()
        ]);
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

    public function hapusGrupLayer(Request $request)
    {
        GrupLayer::destroy($request->id_grup_layer);
        return response()->json(['status' => 'success']);
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

    public function editJenisPeta(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_jenis_peta' => 'required|exists:tabel_jenis_peta,id',
            'nama_jenis_peta' => 'required|unique:jenis_petas'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        $jenis = JenisPeta::find($request->id_jenis_peta);
        $jenis->update($request->all());

        return redirect()->route('admin.peta')->with('success', 'Jenis Peta berhasil ditambahkan!');
    }

    public function hapusJenisPeta(Request $request)
    {
        JenisPeta::destroy($request->id_jenis_peta);
        return response()->json(['status' => 'success']);
    }

    // CRUD Layer
    public function simpanLayer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_layer' => 'required',
            'opd_id' => 'required|exists:opds,id',
            'file_geojson' => 'required|file|mimes:geojson,json'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // Handle file upload
        if ($request->hasFile('file_geojson')) {
            $path = $request->file('file_geojson')->store('geojson');
        }

        Layer::create([
            'nama_layer' => $request->nama_layer,
            'opd_id' => $request->opd_id,
            'file_path' => $path,
            // ... tambahkan field lainnya
        ]);

        return response()->json(['status' => 'success']);
    }

    public function hapusSemuaDataLayer(Request $request)
    {
        $layer = Layer::findOrFail($request->id);
        // Hapus file terkait
        Storage::delete($layer->file_path);
        $layer->delete();
        
        return response()->json(['status' => 'success']);
    }

    public function switchNotif(Request $request)
    {
        $layer = Layer::findOrFail($request->id);
        $layer->update([
            'notif_status' => $request->value
        ]);
        
        return response()->json(['status' => 'success']);
    }
}
