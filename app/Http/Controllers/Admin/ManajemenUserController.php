<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReferensiOpd;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ManajemenUserController extends Controller
{
    //
    public function index()
    {
        $data_opd = ReferensiOPD::all();
        $data_user = User::with('detail')->get();
        return view('admin.user.index', compact('data_user', 'data_opd'));
    }

    public function daftar_user()
    {
        $data = User::with(['detail.opd'])->get();
    
        return response()->json($data);
    }


    public function store(Request $request)
    {
        DB::beginTransaction();
    
        try {
            // Proses input ke tabel user_login
            $user = new User();
            $user->user_name = $request->input('tambah_username');
            $user->user_pass = bcrypt($request->input('tambah_password')); 
            $user->save();
    
            // Proses input ke tabel user_detail
            $userDetail = new UserDetail();
            $userDetail->id_user = $user->id_user; // ambil ID dari user yang baru disimpan
            $userDetail->nama = $request->input('tambah_nama');
            $userDetail->role = $request->input('tambah_role');
            // Field tambahan
            $userDetail->ditambahkan_oleh = Auth::user()->id_user;
            $userDetail->diupdate_oleh = Auth::user()->id_user;
            $userDetail->ditambahkan = now(); // Gantikan created_at
            $userDetail->is_active = 1; // default aktif
            $userDetail->is_delete = null;
            $userDetail->save();
    
            DB::commit();
    
            return response()->json(['status' => true, 'message' => 'Data berhasil disimpan']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => 'Gagal menyimpan data', 'error' => $e->getMessage()]);
        }
    }

    public function update(Request $request)
    {
        try {
            $userDetail = UserDetail::findOrFail($request->input('edit_id_user_detail'));
    
            $userDetail->nama = $request->input('edit_nama');
            $userDetail->role = $request->input('edit_role');
            $userDetail->id_opd = $request->input('edit_id_opd');
            $userDetail->diupdate_oleh = Auth::user()->id ?? null;
            $userDetail->diupdate = now(); 
            $userDetail->save();
    
            return response()->json(['status' => true, 'message' => 'Data berhasil diupdate']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Gagal mengupdate data', 'error' => $e->getMessage()]);
        }
    }
}
