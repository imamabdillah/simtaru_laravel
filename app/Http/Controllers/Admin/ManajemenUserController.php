<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReferensiOpd;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
            $userDetail->id_opd = $request->input('tambah_id_opd');
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
            $userDetail->diupdate_oleh = Auth::user()->id_user ?? null;
            $userDetail->diupdate = now(); 
            $userDetail->save();
    
            return response()->json(['status' => true, 'message' => 'Data berhasil diupdate']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Gagal mengupdate data', 'error' => $e->getMessage()]);
        }
    }

    public function pencarianUser(Request $request)
    {
        try {
            $id = $request->input('id_user_detail');
    
            $userDetail = UserDetail::with('opd')
                ->where('id_user_detail', $id)
                ->firstOrFail();
    
            $response = [
                'id_user_detail' => $userDetail->id_user_detail,
                'id_user' => $userDetail->id_user,
                'nama' => $userDetail->nama,
                'role' => $userDetail->role,
                'id_opd' => $userDetail->id_opd,
            ];
    
            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }
    }

    public function pencarianUserLogin(Request $request)
    {
        try {
            $id = $request->input('id_user');
    
            $user = User::with('detail')->where('id_user', $id)->firstOrFail();
    
            return response()->json([
                'id_user' => $user->id_user,
                'user_name' => $user->user_name,
                'id_user_detail' => $user->detail->id_user_detail ?? null,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }
    }
    

    public function hapus(Request $request)
    {
        try {
            $id_user = $request->input('id_user');
            $id_user_detail = $request->input('id_user_detail');
    
            // Hapus user_login (tabel user)
            User::where('id_user', $id_user)->delete();
    
            // Hapus user_detail
            UserDetail::where('id_user_detail', $id_user_detail)->delete();
    
            return response()->json(['status' => true, 'message' => 'Data berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus data',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function ganti_password(Request $request)
    {
        try {
            $validated = $request->validate([
                'ganti_id_user' => 'required|exists:user_login,id_user',
                'ganti_username' => 'required|string',
                'ganti_password' => 'required|string|min:6',
                'ganti_password_2' => 'required|same:ganti_password',
            ]);
    
            $user = User::findOrFail($request->input('ganti_id_user'));
    
            $user->user_name = $request->input('ganti_username');
            $user->user_pass = Hash::make($request->input('ganti_password'));
            $user->save();
    
            return response()->json([
                'status' => true,
                'message' => 'Password berhasil diubah'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menyimpan data',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
