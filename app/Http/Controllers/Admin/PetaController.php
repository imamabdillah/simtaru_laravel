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

    public function daftar_layer_peta(Request $request)
    {
        if ($request->ajax()) {
            $query = Peta::select(
                    'petas.id_layer', 
                    'petas.nama_layer', 
                    'referensi_opds.nama_opd',
                    'petas.sumber', 
                    'petas.status', 
                    'petas.is_perbaikan'
                )
                ->leftJoin('referensi_opds', 'petas.id_opd', '=', 'referensi_opds.id_opd');
    
            // Filter berdasarkan input user (mirip dengan `_get_datatables_query`)
            if ($request->has('filter_nama') && !empty($request->filter_nama)) {
                $query->where('petas.nama_layer', 'like', '%' . $request->filter_nama . '%');
            }
    
            if ($request->has('filter_opd') && !empty($request->filter_opd)) {
                $query->where('petas.id_opd', $request->filter_opd);
            }
    
            if ($request->has('filter_sumber') && !empty($request->filter_sumber)) {
                $query->where('petas.sumber', $request->filter_sumber);
            }
    
            if ($request->has('filter_status') && !empty($request->filter_status)) {
                $query->where('petas.status', $request->filter_status);
            }
    
            // Jika user bukan admin (role != 1), filter berdasarkan OPD-nya
            if (Auth::user()->role != 1) {
                $query->where('petas.id_opd', Auth::user()->id_opd);
            }
    
            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('sumber', function ($row) {
                    return match ($row->sumber) {
                        2 => 'API',
                        3 => 'File JSON',
                        default => 'Database',
                    };
                })
                ->editColumn('status', function ($row) {
                    return $row->status == 2 ? 'Sembunyikan' : 'Tampilkan';
                })
                ->addColumn('is_perbaikan', function ($row) {
                    $checked = $row->is_perbaikan ? 'checked' : '';
                    return '<div class="col-6">
                                <label class="css-control css-control-primary css-switch">
                                    <input type="checkbox" class="css-control-input switch_perbaikan" ' . $checked . ' data="' . $row->id_layer . '">
                                    <span class="css-control-indicator"></span>
                                </label>
                            </div>';
                })
                ->addColumn('actions', function ($row) {
                    return '<div class="btn-group btn-group-sm" role="group" aria-label="btnGroup1">
                                <button data="' . $row->id_layer . '" type="button" data-name="' . str_replace(['.', ' '], '_', $row->nama_layer) . '" class="btn btn-default btn_download" title="Download File GeoJSON ' . $row->nama_layer . '"><i class="fa fa-download"></i></button>
                                <button data="' . $row->id_layer . '" type="button" class="btn btn-primary btn_data" title="Kelola Data ' . $row->nama_layer . '"><i class="fa fa-database"></i></button>
                                <button data="' . $row->id_layer . '" type="button" class="btn btn-success btn_kelola" title="Kelola Layer ' . $row->nama_layer . '"><i class="fa fa-edit"></i></button>
                                <button data="' . $row->id_layer . '" type="button" class="btn btn-warning btn_group" title="Grup Atribut ' . $row->nama_layer . '"><i class="fa fa-clone"></i></button>
                            </div>
                            <button data="' . $row->id_layer . '" type="button" class="btn btn-danger btn-sm btn_clear" title="Hapus Semua Data ' . $row->nama_layer . '"><i class="fa fa-times-rectangle"></i></button>
                            <button data="' . $row->id_layer . '" type="button" class="btn btn-danger btn-sm btn_hapus" title="Hapus Layer ' . $row->nama_layer . '"><i class="fa fa-trash"></i></button>';
                })
                ->rawColumns(['is_perbaikan', 'actions'])
                ->make(true);
        }
    
        return view('admin.peta.index');
    }
    
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
