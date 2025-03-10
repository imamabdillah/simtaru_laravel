<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReferensiOpd;
use App\Models\Layer;
use App\Models\GrupLayer;
use App\Models\JenisPeta;
use App\Models\Peta;
use App\Models\AtributLayer;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
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
    
    
    public function hapusSemuaDataLayer(Request $request)
    {
        $layer = Layer::findOrFail($request->id);
        // Hapus file terkait
        Storage::delete($layer->file_path);
        $layer->delete();
        
        return redirect()->route('admin.peta')->with('success', 'Jenis Peta berhasil dihapus!');
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
        $atributs = AtributLayer::where('id_layer', $id)->get();
        return response()->json($atributs);
    }
    
    
    public function updateAtribut(Request $request)
    {
        $atribut = AtributLayer::find($request->id);
        if ($atribut) {
            $atribut->update([
                'nama_atribut' => $request->nama_atribut,
                'tipe_data' => $request->tipe_data,
            ]);
            return response()->json(['success' => true, 'message' => 'Atribut berhasil diperbarui']);
        }
        return response()->json(['success' => false, 'message' => 'Atribut tidak ditemukan']);
    }
    
    
    // public function deleteAtribut(Request $request)
    // {
    //     $atribut = AtributLayer::find($request->id);
    //     if ($atribut) {
    //         $atribut->delete(); // Bisa juga update 'is_delete' jika tidak ingin menghapus permanen
    //         return response()->json(['success' => true, 'message' => 'Atribut berhasil dihapus']);
    //     }
    //     return response()->json(['success' => false, 'message' => 'Atribut tidak ditemukan']);
    // }

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
    
    

}
