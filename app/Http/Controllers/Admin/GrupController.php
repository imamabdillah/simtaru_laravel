<?php

namespace App\Http\Controllers\Admin;

use App\Models\Layer;
use App\Models\GrupAtribut;
use App\Models\AtributLayer;
use Illuminate\Http\Request;
use App\Models\GrupAtributItem;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class GrupController extends Controller
{
    public function grupAtribut($id_layer)
    {
        $layer = Layer::findOrFail($id_layer);
        $groups = GrupAtribut::where('id_layer', $id_layer)->get();

        return view('admin.peta.grup_atribut', compact('layer', 'groups'));
    }

    public function getGroup(Request $request)
    {
        $id_layer = $request->input('id_layer');

        $groups = GrupAtribut::where('id_layer', $id_layer)->get();
        $group_order = Layer::where('id_layer', $id_layer)->first();
        $group_order_data = $group_order ? json_decode($group_order->pos_grup_atribut, true) : [];

        return response()->json([
            'status' => 'success',
            'groups' => $groups,
            'group_order' => $group_order_data
        ]);
    }

    public function getGroupItems(Request $request)
    {
        $id = $request->input('id');

        if (!$id) {
            return response()->json([
                'status' => 'error',
                'message' => 'ID Grup Atribut tidak ditemukan.'
            ], 400);
        }

        Log::info("Menerima request dengan ID: " . $id);

        $data = GrupAtributItem::where('id_grup_atribut', $id)
            ->with(['grupAtribut', 'atributLayer'])
            ->get();

        Log::info("Data yang ditemukan:", $data->toArray());

        if ($data->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tidak ada data atribut untuk grup ini.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function add_group(Request $request)
    {
        $request->validate([
            'id_layer'    => 'required|exists:tabel_layer,id_layer',
            'judul_grup'  => 'required|string|max:255',
        ]);

        $group = new GrupAtribut();
        $group->id_layer = $request->id_layer;
        $group->judul_grup_atribut = $request->judul_grup;
        $group->sub_judul_grup_atribut = $request->sub_judul_grup;
        $group->tipe_grup_atribut = $request->tipe_grup;
        $group->ukuran_grup_atribut = $request->ukuran_grup;
        $group->id_user = Auth::id();
        $group->created_at = now();
        $group->updated_at = now();

        if ($group->save()) {
            return response()->json([
                'status' => 'success',
                'data' => [
                    'id' => $group->id,
                    'judul' => $request->judul_grup ?: 'Judul ' . $group->id
                ]
            ]);
        }

        return response()->json(['status' => 'error', 'message' => 'Gagal menambah Grup']);
    }

    public function edit_group(Request $request)
    {
        $group = GrupAtribut::find($request->id_group);
        if (!$group) {
            return response()->json(['status' => 'error', 'message' => 'Grup tidak ditemukan']);
        }

        $group->judul_grup_atribut = $request->judul_grup;
        $group->sub_judul_grup_atribut = $request->sub_judul_grup;
        $group->tipe_grup_atribut = $request->tipe_grup;
        $group->ukuran_grup_atribut = $request->ukuran_grup;
        $group->id_user = Auth::id();
        $group->updated_at = now();
        $group->save();

        return response()->json([
            'status' => 'success',
            'data' => [
                'id' => $group->id,
                'judul' => $request->judul_grup ?: 'Judul ' . $group->id
            ]
        ]);
    }

    public function delete_group(Request $request)
    {
        $group = GrupAtribut::find($request->id_group);
        if (!$group) {
            return response()->json(['status' => 'error', 'message' => 'Grup tidak ditemukan']);
        }

        $group->delete();
        return response()->json(['status' => 'success']);
    }

    public function getGroupById(Request $request)
    {
        $group = GrupAtribut::find($request->id_group);
        if ($group) {
            return response()->json(["status" => "success", "data" => $group]);
        }
        return response()->json(["status" => "error", "message" => "Grup tidak ditemukan"]);
    }

    public function getLayerAttribute(Request $request)
    {
        $id_layer = $request->input('id_layer');

        $attributes = AtributLayer::where('id_layer', $id_layer)->get();

        return response()->json([
            'attribute' => $attributes,
            'group' => []
        ]);
    }
}
