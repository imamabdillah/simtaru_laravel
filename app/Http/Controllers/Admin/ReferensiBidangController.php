<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReferensiOpd;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ReferensiBidangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $daftar_opds = ReferensiOpd::all();
        return view('admin.referensi.opd', compact('daftar_opds'));
    }

    public function getData()
    {
        $data = ReferensiOpd::select(['id_opd', 'nama_opd'])->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                return '<button class="btn btn-sm btn-warning item_edit" data-id-opd="'.$row->id_opd.'"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-sm btn-danger item_hapus" data-id-opd="'.$row->id_opd.'"><i class="fa fa-trash"></i></button>';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nama_opd' => 'required'
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors()
                ], 422);
            }
    
            $userId = Auth::user()->id_user;
            $opd = ReferensiOpd::updateOrCreate(
                ['id_opd' => $request->id_opd],
                [
                'nama_opd' => $request->nama_opd,
                'add_by' => $userId,
                'edit_by' => $userId,
                'is_active' => '1'
            ]);
    
            return redirect()->route('admin.referensi.bidang')->with('success', 'Bidang OPD berhasil ditambahkan!')->with('opd', $opd);

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_opd)
    {
        $opd = ReferensiOpd::find($id_opd);
        return response()->json($opd);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_opd)
    {
        try {
            $data = ReferensiOpd::find($id_opd);
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
