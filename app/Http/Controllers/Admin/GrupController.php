<?php

namespace App\Http\Controllers\Admin;

use App\Models\Layer;
use App\Models\GrupAtribut;
use App\Models\AtributLayer;
use Illuminate\Http\Request;
use App\Models\GrupAtributItem;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
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
        $id_layer = $request->id_layer;
        $group = DB::table('tabel_grup_atribut')->where('id_layer', $id_layer)->get()->toArray();
        $group_order = DB::table('tabel_layer')->where('id_layer', $id_layer)->first();
        $res['group'] = $group;
        $res['group_order'] = json_decode($group_order->pos_grup_atribut, true);
        return response()->json($res);
    }

    public function getLayerAttribute(Request $request)
    {
        $id_layer = $request->id_layer;
        $attr = DB::table('tabel_atribut_layer')->where('id_layer', $id_layer)->get()->toArray();
        $res['attribute'] = $attr;
        $res['group'] = [];
        return response()->json($res);
    }

    public function addGroup(Request $request)
    {
        $id_layer = $request->id_layer;

        $a = [];
        $a['id_layer'] = $id_layer;
        $a['judul_grup_atribut'] = $request->judul_grup;
        $a['sub_judul_grup_atribut'] = $request->sub_judul_grup;
        $a['tipe_grup_atribut'] = $request->tipe_grup;
        $a['ukuran_grup_atribut'] = $request->ukuran_grup;
        $a['id_user'] = Auth::id();
        $a['created_at'] = now();
        $a['updated_at'] = now();

        $id = DB::table('tabel_grup_atribut')->insertGetId($a);

        if ($id > 0) {
            $res['status'] = 'success';
            $res['data'] = [
                'id' => $id,
                'judul' => $request->judul_grup == '' ? 'Judul ' . $id : $request->judul_grup
            ];
        } else {
            $res['status'] = 'error';
            $res['message'] = 'Gagal menambah Grup';
        }
        return response()->json($res);
    }

    public function editGroup(Request $request)
    {
        $id = $request->id_group;
        $a = [];
        $a['judul_grup_atribut'] = $request->judul_grup;
        $a['sub_judul_grup_atribut'] = $request->sub_judul_grup;
        $a['tipe_grup_atribut'] = $request->tipe_grup;
        $a['ukuran_grup_atribut'] = $request->ukuran_grup;
        $a['id_user'] = Auth::id();

        $affected = DB::table('tabel_grup_atribut')->where('id_grup_atribut', $id)->update($a);

        if ($affected > 0) {
            $res['status'] = 'success';
            $res['data'] = [
                'id' => $id,
                'judul' => $request->judul_grup == '' ? 'Judul ' . $id : $request->judul_grup
            ];
        } else {
            $res['status'] = 'error';
            $res['message'] = 'Gagal mengubah Grup';
        }
        return response()->json($res);
    }

    public function deleteGroup(Request $request)
    {
        $id = $request->id;
        DB::table('tabel_grup_atribut')->where('id_grup_atribut', $id)->delete();
        $cek = DB::table('tabel_grup_atribut')->where('id_grup_atribut', $id)->count();
        if ($cek > 0) {
            $res['status'] = 'error';
            $res['message'] = 'Grup gagal dihapus';
        } else {
            $res['status'] = 'success';
        }
        return response()->json($res);
    }

    public function getGroupDetail(Request $request)
    {
        $id = $request->id;
        $get = DB::table('tabel_grup_atribut')->where('id_grup_atribut', $id)->first();
        if ($get) {
            $res['status'] = 'success';
            $res['data'] = $get;
        } else {
            $res['status'] = 'error';
            $res['message'] = 'Data tidak ditemukan';
        }
        return response()->json($res);
    }

    public function getGroupItems(Request $request)
    {
        $id = $request->id;

        $item_order = DB::table('tabel_grup_atribut')->where('id_grup_atribut', $id)->first();
        $res['item_order'] = json_decode($item_order->pos_grup_atribut_item, true);

        $get = DB::table('tabel_grup_atribut as t1')
            ->select(
                't1.id_grup_atribut',
                't2.id_atribut',
                't2.id_layer',
                't2.nama_atribut',
                't2.slug',
                't2.tipe_data',
                't3.id_grup_atribut_item',
                't3.nama_atribut_layer',
                't3.alias_atribut_layer'
            )
            ->where('t1.id_grup_atribut', $id)
            ->join('tabel_atribut_layer as t2', 't2.id_layer', '=', 't1.id_layer')
            ->leftJoin('tabel_grup_atribut_item as t3', function($join) {
                $join->on('t3.id_atribut', '=', 't2.id_atribut')
                    ->on('t3.id_grup_atribut', '=', 't1.id_grup_atribut');
            })
            ->get()
            ->toArray();

        if (count($get) > 0) {
            $res['status'] = 'success';
            $res['data'] = $get;
        } else {
            $res['status'] = 'error';
            $res['message'] = 'Data tidak ditemukan';
        }

        return response()->json($res);
    }

public function addGroupItem(Request $request)
{
    try {
        Log::info('addGroupItem started', [
            'id_atribut' => $request->id_atribut,
            'id_grup_atribut' => $request->id_grup_atribut,
            'nama_atribut' => $request->nama_atribut
        ]);

        $a = [];
        $a['id_atribut'] = $request->id_atribut;
        $a['id_grup_atribut'] = $request->id_grup_atribut;
        $a['nama_atribut_layer'] = $request->nama_atribut;
        $a['user_id'] = Auth::id();
        $a['created_at'] = now();
        $a['updated_at'] = now();

        $id_item = DB::table('tabel_grup_atribut_item')->insertGetId($a);

        if ($id_item > 0) {
            $res['status'] = 'success';
            $res['data']['id_item'] = $id_item;
            $res['data']['id_grup_atribut'] = $request->id_grup_atribut;
            $res['data']['nama_atribut'] = $request->nama_atribut;
            Log::info('addGroupItem successful', [
                'id_item' => $id_item,
                'id_grup_atribut' => $request->id_grup_atribut,
                'user_id' => Auth::id()
            ]);
        } else {
            $res['status'] = 'error';
            $res['message'] = 'Gagal menambahkan grup item';
            Log::error('addGroupItem failed to insert record', [
                'id_atribut' => $request->id_atribut,
                'id_grup_atribut' => $request->id_grup_atribut
            ]);
        }

        return response()->json($res);
    } catch (\Exception $e) {
        Log::error('addGroupItem exception', [
            'id_atribut' => $request->id_atribut ?? null,
            'id_grup_atribut' => $request->id_grup_atribut ?? null,
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);

        return response()->json([
            'status' => 'error',
            'message' => 'Terjadi kesalahan sistem'
        ]);
    }
}
    public function deleteGroupItem(Request $request)
    {
        $id = $request->id_item;
        DB::table('tabel_grup_atribut_item')->where('id_grup_atribut_item', $id)->delete();
        $res['status'] = 'success';
        return response()->json($res);
    }

    public function renameGroupItem(Request $request)
    {
        $id = $request->id_item;
        $a['alias_atribut_layer'] = $request->alias;
        $affected = DB::table('tabel_grup_atribut_item')->where('id_grup_atribut_item', $id)->update($a);
        if ($affected > 0) {
            $res['status'] = 'success';
        } else {
            $res['status'] = 'error';
            $res['message'] = 'Alias gagal diubah';
        }
        return response()->json($res);
    }

    public function updatePosGroup(Request $request)
    {
        $id_layer = $request->id_layer;
        parse_str($request->data, $data);

        $a = [];
        $a['pos_grup_atribut'] = json_encode($data);

        DB::table('tabel_layer')->where('id_layer', $id_layer)->update($a);

        $res['status'] = 'success';
        return response()->json($res);
    }

    public function updatePosGroupItem(Request $request)
    {
        $id_group = $request->id_group;
        parse_str($request->data, $data);

        $a = [];
        $a['pos_grup_atribut_item'] = json_encode($data);

        DB::table('tabel_grup_atribut')->where('id_grup_atribut', $id_group)->update($a);

        $res['status'] = 'success';
        return response()->json($res);
    }

    public function refKoordinat(Request $request)
    {
        $tipe = $request->type;
        $search = $request->search;

        $data = [];
        $data['results'] = DB::table('tabel_referensi_koordinat')
            ->select(
                'id_koordinat as id',
                'nama_koordinat as text'
            )
            ->where('tipe_koordinat', $tipe)
            ->whereRaw("(id_opd=0 OR id_opd=?)", [Auth::user()->id_opd])
            ->where('nama_koordinat', 'like', "%$search%")
            ->limit(10)
            ->get()
            ->toArray();

        return response()->json($data);
    }

    public function downloadGeojson($id = null, $name = null)
    {
        $name .= '.geojson';

        $url = url('peta/get-geojson/db/' . $id);
        $data = file_get_contents($url);

        return response($data)
            ->header('Content-Type', 'text/plain')
            ->header('Content-Disposition', "attachment; filename=$name");
    }
}
