<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReferensiKoordinat;
use App\Models\ReferensiOpd;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ReferensiKoordinatController extends Controller
{
    public function index()
    {
        $koordinat = ReferensiKoordinat::all();
        $data_opd = ReferensiOpd::all();
        return view('admin.referensi.koordinat', compact('koordinat', 'data_opd'));
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = ReferensiKoordinat::select('id_koordinat', 'nama_koordinat', 'ket_koordinat', 'tipe_koordinat', 'koordinat', 'id_opd');  // Ambil hanya kolom yang dibutuhkan
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    return '<button class="btn btn-sm btn-warning item_edit" data-id-koordinat="'.$row->id_koordinat.'">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger item_hapus" data-id-koordinat="'.$row->id_koordinat.'" data-name="'.$row->nama_koordinat.'">
                                <i class="fa fa-trash"></i>
                            </button>';
                })
                ->rawColumns(['icon', 'aksi'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nama_koordinat' => 'required|string|max:255',
                'tipe_koordinat' => 'required|in:Point,LineString,Polygon',
                'koordinat' => 'required',
                'ket_koordinat' => 'required|string',
                'id_opd' => 'required|exists:tabel_referensi_opd,id_opd',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors()
                ], 422);
            }
    
            $userId = Auth::user()->id_user;
            $koordinat = ReferensiKoordinat::updateOrCreate(
                ['id_koordinat' => $request->id_koordinat],
                [
                'nama_koordinat' => $request->nama_koordinat,
                'tipe_koordinat' => $request->tipe_koordinat,
                'koordinat' => $request->koordinat,
                'ket_koordinat' => $request->ket_koordinat,
                'id_opd' => $request->id_opd,
                'add_by' => $userId,
                'edit_by' => $userId,
                'is_active' => '1'
            ]);
    
            return redirect()->route('admin.referensi.koordinat')->with('success', 'Koordinat berhasil ditambahkan!')->with('koordinat', $koordinat);

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function edit($id_koordinat)
    {
        $koordinat = ReferensiKoordinat::find($id_koordinat);
        return response()->json($koordinat);
    }

    public function destroy($id_koordinat)
    {
        try {
            $data = ReferensiKoordinat::find($id_koordinat);
            if(!$data) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data tidak ditemukan!'
                ], 404);
            }
            $data->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil dihapus!'
                ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ]);
        }
    }
}
