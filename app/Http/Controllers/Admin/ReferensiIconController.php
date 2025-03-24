<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReferensiIcon;
use App\Models\ReferensiOpd;
use Yajra\DataTables\Facades\DataTables;

class ReferensiIconController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $icons = ReferensiIcon::all();
        $data_opd = ReferensiOpd::all();
        return view('admin.referensi.icon', compact('icons', 'data_opd'));
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = ReferensiIcon::select('id_icon', 'nama_icon');  // Ambil hanya kolom yang dibutuhkan
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('icon', function ($row) {
                    return '<img style="width:25px;height:25px" src="'.asset('assets/uploads/marker_icon/'.$row->nama_icon.'.png').'">';
                })
                ->addColumn('aksi', function ($row) {
                    return '<button class="btn btn-sm btn-warning item_edit" data-id-icon="'.$row->id_icon.'">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger item_hapus" data-id-icon="'.$row->id_icon.'" data-name="'.$row->nama_icon.'">
                                <i class="fa fa-trash"></i>
                            </button>';
                })
                ->rawColumns(['icon', 'aksi'])
                ->make(true);
        }
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
