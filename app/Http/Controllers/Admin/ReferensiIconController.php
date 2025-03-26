<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReferensiIcon;
use App\Models\ReferensiOpd;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log; // Ensure the Log facade is imported


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
        try {
            // Validasi input
            $validator = Validator::make($request->all(), [
                'nama_icon' => [
                    'required',
                    'regex:/^[a-z0-9_]+$/',
                    Rule::unique('tabel_referensi_icon', 'nama_icon')
                        ->where(function ($query) use ($request) {
                            return $query->where('id_opd', $request->id_opd);
                        })
                        ->ignore($request->id_icon, 'id_icon'), // Abaikan data yang sedang diedit
                ],
                'id_opd' => 'required|exists:tabel_referensi_opd,id_opd',
                'file_icon' => 'file|mimes:png|max:2048', // Hanya file PNG dengan max 2MB
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors()
                ], 422);
            }
    

            $userId = Auth::user()->id_user;
            $iconPath = null;

            // Cek apakah ini update atau insert baru
            $icon = ReferensiIcon::find($request->id_icon);
            $oldFilePath = $icon ? public_path('assets/uploads/marker_icon/' . $icon->nama_icon . '.png') : null;
            $oldNamaIcon = $icon ? $icon->nama_icon : null;
    
            if ($request->hasFile('file_icon')) {
                $file = $request->file('file_icon');
                // Gunakan nama icon sebagai nama file (nama_icon.png)
                $filename = $request->nama_icon . '.png';
                $iconPath = 'assets/uploads/marker_icon/' . $filename;

                // Hapus file lama jika ada (saat update)
                if ($icon && file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
    
                // Simpan file ke direktori
                $file->move(public_path('assets/uploads/marker_icon'), $filename);
            } else {
                // Jika hanya mengganti nama tanpa mengganti file
                if ($icon && $oldNamaIcon !== $request->nama_icon) {
                    $newFilePath = public_path('assets/uploads/marker_icon/' . $request->nama_icon . '.png');
            
                    // Pastikan file lama ada sebelum rename
                    if ($oldFilePath && file_exists($oldFilePath)) {
                        copy($oldFilePath, $newFilePath);
                        unlink($oldFilePath);
                    }
                }
            }
    
            // Cek apakah ini update atau insert baru
            $icon = ReferensiIcon::updateOrCreate(
                ['id_icon' => $request->id_icon],
                [
                    'nama_icon' => $request->nama_icon,
                    'id_opd' => $request->id_opd,
                    'file_icon' => $iconPath,
                    'add_by' => $userId,
                    'edit_by' => $userId,
                    'is_active' => '1'
                ]
            );
    
            // return redirect()->route('admin.referensi.icon')->with('success', 'Ikon berhasil disimpan!')->with('icon', $icon);
            return response()->json([
                'status' => 'success',
                'message' => 'Ikon berhasil disimpan!',
                'icon' => $icon
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_icon)
    {
        $icon = ReferensiIcon::find($id_icon);
        return response()->json($icon);
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
