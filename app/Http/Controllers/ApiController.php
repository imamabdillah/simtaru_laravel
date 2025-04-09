<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\API;
use App\Models\Layer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    //
    public function getData($token, $format = 'd')
    {
        // Untuk mengizinkan akses dari luar (CORS)
        header('Access-Control-Allow-Origin: *');
    
        $api = API::where('token', $token)->first();
    
        if ($api) {
            $layerIds = json_decode($api->akses_layer, true);
    
            $data = Layer::whereIn('id_layer', $layerIds)->get();
    
            if ($format === 'json') {
                return response()->json($data);
            } else {
                echo "<pre>";
                print_r($data->toArray());
            }
        } else {
            return response('Token tidak ditemukan.', 404);
        }
    }

    public function index()
    {
        return redirect('/');
    }

    public function get($token = null, $mode = 'd')
    {
        if (!$token) return redirect('/');

        if ($mode === 'd') {
            $api = DB::table('tabel_api')->where('token', $token)->first();
            if (!$api) {
                return view('front.api.index_error', ['message' => 'Token tidak valid, tidak dapat mengakses API']);
            }

            $aksesLayer = json_decode($api->akses_layer, true) ?? [];
            $layers = [];

            if (count($aksesLayer)) {
                $layers = DB::table('tabel_layer')
                    ->where('status', 1)
                    ->whereIn('id_layer', $aksesLayer)
                    ->get();
            }

            return view('front.api.index', [
                'extra_js' => view('front.api.index_js')->render(),
                'token' => $token,
                'akses_layer' => $layers
            ]);
        } elseif ($mode === 'w') {
            $api = DB::table('tabel_api_widget')->where('api_token', $token)->first();
            if (!$api) {
                return view('front.api.index_error', ['message' => 'Token tidak valid, tidak dapat mengakses API']);
            }

            $layers = DB::table('tabel_api_widget_layer as t1')
                ->join('tabel_layer as t2', 't2.id_layer', '=', 't1.id_layer')
                ->join('tabel_jenis_peta as t3', 't3.id_jenis_peta', '=', 't2.id_jenis_peta')
                ->join('tabel_grup_layer as t4', 't4.id_grup_layer', '=', 't2.id_grup_layer')
                ->join('tabel_referensi_opd as t5', 't5.id_opd', '=', 't2.id_opd')
                ->select(
                    't2.id_layer',
                    't2.nama_layer',
                    't4.nama_grup_layer as grup_layer',
                    't3.nama_jenis_peta as jenis_peta',
                    't5.nama_opd as opd',
                    DB::raw("CONCAT('" . url('/api/geojson/' . $token) . "/', t2.id_layer, '/w') AS geojson_url")
                )
                ->where('t1.id_api_widget', $api->id_api_widget)
                ->where('t2.status', 1)
                ->get();

            return response()->json($layers);
        }

        return redirect('/');
    }
    public function geojson($token, $id_layer, $nama_layer)
    {
        // Cek token di tabel_api
        $api = API::where('token', $token)->first();
        if (!$api) {
            return response()->json(['message' => 'Token tidak valid atau tidak aktif'], 401);
        }
    
        // Ambil layer berdasarkan ID
        $layer = Layer::where('id_layer', $id_layer)->first();
        if (!$layer) {
            return response()->json(['message' => 'Layer tidak ditemukan'], 404);
        }
    
        // (Opsional) Validasi nama layer di URL dengan nama layer asli
        $expected_name = strtolower(str_replace(' ', '_', $layer->nama_layer));
        if ($expected_name !== $nama_layer) {
            return response()->json(['message' => 'Nama layer tidak cocok'], 400);
        }
    
        // Cek apakah layer ini termasuk dalam akses yang diberikan ke token ini
        if ($api->akses_layer) {
            $akses = json_decode($api->akses_layer, true);
            if (!in_array($id_layer, $akses)) {
                return response()->json(['message' => 'Layer tidak termasuk dalam akses token ini'], 403);
            }
        }
    
        // Ambil data GeoJSON dari DB atau storage
        $data = json_decode($layer->geojson); // atau sesuaikan kalau kamu simpan file
    
        return response()->json($data);
    }

    private function getGeojson($id)
    {
        $layer = DB::table('tabel_layer')->where('id_layer', $id)->first();

        if ($layer->sumber == 1) {
            return $this->sumberDatabase($id);
        } elseif ($layer->sumber == 2) {
            return $this->sumberApi($layer->link_api);
        }
    }

    private function sumberDatabase($id)
    {
        $alias = DB::select("
            SELECT t3.* FROM tabel_layer t1
            INNER JOIN tabel_grup_atribut t2 ON t2.id_layer = t1.id_layer
            INNER JOIN tabel_grup_atribut_item t3 ON t3.id_grup_atribut = t2.id_grup_atribut
            WHERE t1.id_layer = ?
        ", [$id]);

        $data = DB::select("
            SELECT * FROM tabel_layer t1
            INNER JOIN tabel_grup_atribut t2 ON t2.id_layer = t1.id_layer
            WHERE t1.id_layer = ?
        ", [$id]);

        // Proses mirip seperti yang di CodeIgniter
        // (Silakan lanjutkan dari sini untuk menyusun `xconfig`, `xdata`, `xalias`, dan `features`
        // dengan pola yang sama — bisa juga pakai Collection/Resource Laravel untuk hasil yang rapi)

        // Kode pemrosesan geojson selanjutnya mirip, saya bisa bantu buatkan detailnya juga kalau kamu butuh.

        return response()->json([
            'type' => 'FeatureCollection',
            'xconfig' => [],
            'xdata' => [],
            'xalias' => [],
            'features' => []
        ]);
    }

    private function sumberApi($link)
    {
        if (!$link) {
            return response()->json(['message' => 'no link']);
        }

        $response = Http::get($link);
        return response($response->body(), $response->status());
    }

    public function extendLayers()
    {
        return response()->json([
            'sipd' => [
                'id' => 1,
                'jenis_peta' => 'SIPD',
                'prefix' => 'sipd',
                'url' => url('/api/layer_api/sipd/'),
                'default_param' => '0',
            ],
            'infrastruktur_kota' => [
                'id' => 2,
                'jenis_peta' => 'Infrastruktur Kota',
                'prefix' => 'infrastruktur_kota',
                'url' => url('/api/layer_api/infrastruktur_kota/'),
                'default_param' => '0',
            ]
        ]);
    }

    public function layerApi($prefix, $id)
    {
        $urls = [
            'sipd' => 'http://solodata.surakarta.go.id/pertanyaan/intipmenu/',
            'infrastruktur_kota' => 'https://appt.demoo.id/surakarta/sippd/api/menu_intip/',
        ];

        if (!isset($urls[$prefix])) {
            return response()->json(['message' => 'no link']);
        }

        $url = $urls[$prefix] . $id;
        $response = Http::get($url);
        return response($response->body(), $response->status());
    }

    public function menuApi($id)
    {
        $res['jenis_peta'] = 'SIPD';
        $res['prefix'] = 'sipd';

        if ($id == 0) {
            $res['data'] = [
                ['id' => 1, 'name' => 'Wajib', 'children' => 10, 'level' => 1, 'layer' => false],
                ['id' => 2, 'name' => 'Pilihan', 'children' => 3, 'level' => 1, 'layer' => false],
                ['id' => 3, 'name' => 'Umum', 'children' => 6, 'level' => 1, 'layer' => false],
            ];
        } elseif ($id == 1) {
            $res['data'] = [
                ['id' => 11, 'name' => 'Kesehatan', 'children' => 14, 'level' => 2, 'layer' => false],
                ['id' => 12, 'name' => 'Pendidikan', 'children' => 17, 'level' => 2, 'layer' => false],
                ['id' => 13, 'name' => 'Kependudukan', 'children' => 13, 'level' => 2, 'layer' => false],
            ];
        } elseif ($id == 11) {
            $res['data'] = [
                ['id' => 21, 'name' => 'Child Kesehatan', 'children' => 24, 'level' => 3, 'layer' => false],
                ['id' => 22, 'name' => 'Child Pendidikan', 'children' => 27, 'level' => 3, 'layer' => false],
                ['id' => 23, 'name' => 'child Kependudukan', 'children' => 23, 'level' => 3, 'layer' => false],
            ];
        } elseif ($id == 21) {
            $res['data'] = [
                ['id' => 31, 'name' => 'Grand Child Kesehatan', 'children' => 34, 'level' => 4, 'layer' => true],
                ['id' => 32, 'name' => 'Grand Child Pendidikan', 'children' => 37, 'level' => 4, 'layer' => true],
                ['id' => 33, 'name' => 'Grand child Kependudukan', 'children' => 33, 'level' => 4, 'layer' => true],
            ];
        } else {
            $res['data'] = [];
        }

        return response()->json($res);
    }

    public function example($id)
    {
        return response('contoh: ' . $id);
    }

    private function checkAccessToken($access_token)
    {
        $access = DB::table('tabel_api_widget')->where('access_token', $access_token)->first();
        $res = [];

        if ($access) {
            $urlApp = $access->url_app;
            $referer = request()->headers->get('referer');
            $pattern = '/^' . preg_quote($urlApp, '/') . '/';
            $res['status'] = preg_match($pattern, $referer) > 0;
            $res['data'] = $access;
        } else {
            $res['status'] = false;
            $res['data'] = null;
        }

        return $res;
    }

    public function listLayer()
    {
        $data = DB::table('tabel_layer')->where('status', 1)->get();
        return response()->json($data);
    }

    public function listKoordinat(Request $request)
    {
        $data = DB::table('tabel_collection')->where('id_layer', $request->id_layer)->get();
        return response()->json($data);
    }

    public function getKoordinat(Request $request)
    {
        $row = DB::table('tabel_collection')->where('id_collection', $request->id_collection)->first();

        $geojson = [
            'type' => 'FeatureCollection',
            'features' => [
                [
                    'type' => 'Feature',
                    'properties' => [
                        'name' => $row->name ?? null,
                    ],
                    'geometry' => [
                        'type' => $row->tipe_layer ?? null,
                        'coordinates' => json_decode($row->koordinat ?? '[]'),
                    ]
                ]
            ]
        ];

        return response()->json($geojson);
    }
}
