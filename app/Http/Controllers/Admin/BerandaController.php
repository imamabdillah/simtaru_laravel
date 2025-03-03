<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BerandaController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth'); // Pastikan user sudah login
    //     $this->middleware(function ($request, $next) {
    //         if (Auth::user()->role != 1) {
    //             return redirect()->route('login')->with('msg', 'Akses ditolak!');
    //         }
    //         return $next($request);
    //     });
    // }

    public function index()
    {
        // Ambil data statistik dashboard
        $chart = [
            'user' => DB::table('user_login')->count(),
            'opd' => DB::table('tabel_referensi_opd')->count(),
            'layer' => DB::table('tabel_layer')->count(),
            'data_layer' => DB::table('tabel_collection')->count(),
        ];

        return view('admin.beranda.index', compact('chart'));
    }

    public function dataPerLayer()
    {
        $query = DB::table('tabel_collection')
            ->join('tabel_layer', 'tabel_layer.id_layer', '=', 'tabel_collection.id_layer')
            ->select('tabel_layer.nama_layer', DB::raw('COUNT(tabel_collection.id_collection) AS total'))
            ->groupBy('tabel_collection.id_layer')
            ->get();

        return response()->json(['data' => $query]);
    }

    public function layerPerOpd()
    {
        $query = DB::table('tabel_layer')
            ->join('tabel_referensi_opd', 'tabel_referensi_opd.id_opd', '=', 'tabel_layer.id_opd')
            ->select('tabel_referensi_opd.nama_opd', DB::raw('COUNT(tabel_layer.id_layer) AS total'))
            ->groupBy('tabel_layer.id_opd')
            ->get();

        return response()->json(['data' => $query]);
    }

    public function dataPerOpd()
    {
        $query = DB::table('tabel_layer')
            ->join('tabel_collection', 'tabel_collection.id_layer', '=', 'tabel_layer.id_layer')
            ->join('tabel_referensi_opd', 'tabel_referensi_opd.id_opd', '=', 'tabel_layer.id_opd')
            ->select('tabel_referensi_opd.nama_opd', DB::raw('COUNT(tabel_layer.id_layer) AS total'))
            ->groupBy('tabel_layer.id_opd')
            ->get();

        return response()->json(['data' => $query]);
    }

    public function layerPerGrupLayer()
    {
        $query = DB::table('tabel_layer')
            ->join('tabel_grup_layer', 'tabel_grup_layer.id_grup_layer', '=', 'tabel_layer.id_grup_layer')
            ->select('tabel_grup_layer.nama_grup_layer', DB::raw('COUNT(tabel_layer.id_layer) AS total'))
            ->groupBy('tabel_layer.id_grup_layer')
            ->get();

        return response()->json(['data' => $query]);
    }

    public function dataPerGrupLayer()
    {
        $query = DB::table('tabel_layer')
            ->join('tabel_grup_layer', 'tabel_grup_layer.id_grup_layer', '=', 'tabel_layer.id_grup_layer')
            ->join('tabel_collection', 'tabel_collection.id_layer', '=', 'tabel_layer.id_layer')
            ->select('tabel_grup_layer.nama_grup_layer', DB::raw('COUNT(tabel_layer.id_layer) AS total'))
            ->groupBy('tabel_layer.id_grup_layer')
            ->get();

        return response()->json(['data' => $query]);
    }

    public function layerPerJenisPeta()
    {
        $query = DB::table('tabel_layer')
            ->join('tabel_jenis_peta', 'tabel_jenis_peta.id_jenis_peta', '=', 'tabel_layer.id_jenis_peta')
            ->select('tabel_jenis_peta.nama_jenis_peta', DB::raw('COUNT(tabel_layer.id_layer) AS total'))
            ->groupBy('tabel_layer.id_jenis_peta')
            ->get();

        return response()->json(['data' => $query]);
    }

    public function dataPerJenisPeta()
    {
        $query = DB::table('tabel_layer')
            ->join('tabel_jenis_peta', 'tabel_jenis_peta.id_jenis_peta', '=', 'tabel_layer.id_jenis_peta')
            ->join('tabel_collection', 'tabel_collection.id_layer', '=', 'tabel_layer.id_layer')
            ->select('tabel_jenis_peta.nama_jenis_peta', DB::raw('COUNT(tabel_layer.id_layer) AS total'))
            ->groupBy('tabel_layer.id_jenis_peta')
            ->get();

        return response()->json(['data' => $query]);
    }

    public function dataPerStatus()
    {
        $query = DB::table('tabel_layer')
            ->join('tabel_collection', 'tabel_collection.id_layer', '=', 'tabel_layer.id_layer')
            ->select(DB::raw("IF(tabel_layer.status = 1, 'Data ditampilkan', 'Data disembunyikan') AS status"), DB::raw('COUNT(tabel_collection.id_layer) AS total'))
            ->groupBy('tabel_layer.status')
            ->get();

        return response()->json(['data' => $query]);
    }

    public function dataPerHalamanDetail()
    {
        $query = DB::table('tabel_collection')
            ->select(DB::raw("IF(page_detail = 1, 'Halaman Detail Aktif', 'Halaman Detail Tidak Aktif') AS halaman_detail"), DB::raw('COUNT(id_collection) AS total'))
            ->groupBy('page_detail')
            ->get();

        return response()->json(['data' => $query]);
    }
}
