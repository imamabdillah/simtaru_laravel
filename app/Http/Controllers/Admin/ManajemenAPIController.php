<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\API;
use App\Models\Layer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ManajemenAPIController extends Controller
{
    public function index()
    {
        $data_layer = Layer::where('status', 1)->get();
        return view('admin.api.index', compact('data_layer'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pemohon' => 'required|string',
            'akses_layer' => 'required|array',
        ]);

        $api = new API();
        $api->nama_pemohon = $request->nama_pemohon;
        $api->akses_layer = json_encode($request->akses_layer);
        $api->id_user = Auth::id();
        $api->id_opd = Auth::user()->id_opd ?? null;
        $api->token = Str::random(16);
        $api->created_at = now();
        $api->save();

        return response()->json(['status' => 'success']);
    }

    public function getList()
    {
        $data = API::all();
        return response()->json(['data' => $data]);
    }

    public function destroy(Request $request)
    {
        $id_api = $request->id_api;
        $api = API::findOrFail($id_api);
        $api->delete();

        return response()->json(['status' => 'success']);
    }

}
