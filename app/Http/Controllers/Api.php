<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('memory_limit', '-1');

class Api extends CI_Controller
{



    function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        // header('Access-Control-Allow- Methods: POST, GET, PUT, DELETE, OPTIONS'); 
        // header('Access-Control-Allow-Headers: X-Requested-With, content-type, X-Token, x-token');
        parent::__construct();
    }

    public function index()
    {
        redirect(base_url());
    }

    public function get($token = false, $mode = 'd')
    {
        // api mode
        // d = default
        // w = widget

        if ($token && $mode == 'd') {
            $api = $this->db->where('token', $token)->get('tabel_api')->row_array();
            if ($api === null) {
                $data['message'] = 'Token tidak valid, tidak dapat mengakses API';
                $this->load->view("front/api/index_error", $data);
            } else {
                $akses_layer = json_decode($api['akses_layer']);
                $layer = [];
                if (count($akses_layer) > 0) {
                    $in = '';
                    foreach ($akses_layer as $v) {
                        $in .= $v . ',';
                    }
                    $in = substr($in, 0, -1);

                    $q = "select * from tabel_layer where status = 1 and id_layer in ({$in})";
                    $layer = $this->db->query($q)->result_array();
                }

                $data = [
                    'extra_js' => $this->load->view("front/api/index_js", '', true),
                    'token' => $token,
                    'akses_layer' => $layer
                ];

                $this->load->view("front/api/index", $data);
            }
        } else if ($token && $mode == 'w') {
            $api = $this->db->where('api_token', $token)->get('tabel_api_widget')->row_array();
            if ($api === null) {
                $data['message'] = 'Token tidak valid, tidak dapat mengakses API';
                $this->load->view("front/api/index_error", $data);
            } else {
                $s = "
                    t2.id_layer,
                    t2.nama_layer,
                    t4.nama_grup_layer AS grup_layer,
                    t3.nama_jenis_peta AS jenis_peta,
                    t5.nama_opd AS opd,
                    CONCAT('" . base_url() . "api/geojson/" . $token . "/',t2.id_layer,'/w') AS geojson_url 
                ";
                $w = [];
                $w['t1.id_api_widget'] = $api['id_api_widget'];
                $w['t2.status'] = 1;

                $layers = $this->db
                    ->select($s)
                    ->from('tabel_api_widget_layer t1')
                    ->join('tabel_layer t2', 't2.id_layer = t1.id_layer', 'inner')
                    ->join('tabel_jenis_peta t3', 't3.id_jenis_peta = t2.id_jenis_peta', 'inner')
                    ->join('tabel_grup_layer t4', 't4.id_grup_layer = t2.id_grup_layer', 'inner')
                    ->join('tabel_referensi_opd t5', 't5.id_opd = t2.id_opd', 'inner')
                    ->where($w)
                    ->get()
                    ->result_array();
                echo json_encode($layers);
            }
        } else {
            redirect(base_url());
        }
    }

    public function geojson($token = false, $id = false, $mode = 'd')
    {
        if ($token && $id && $mode == 'd') {
            $api = $this->db->where('token', $token)->get('tabel_api')->row_array();
            if ($api === null) {
                $data['message'] = 'Token tidak valid, tidak dapat mengakses API';
                $this->load->view("front/api/index_error", $data);
            } else {
                $akses_layer = json_decode($api['akses_layer']);
                if (in_array($id, $akses_layer)) {
                    $this->get_geojson($id);
                } else {
                    $data['message'] = 'Anda tidak memiliki hak akses API';
                    $this->load->view("front/api/index_error", $data);
                }
            }
        } else if ($token && $id && $mode == 'w') {
            $api = $this->db->where('api_token', $token)->get('tabel_api_widget')->row_array();
            if ($api === null) {
                $data['message'] = 'Token tidak valid, tidak dapat mengakses API';
                $this->load->view("front/api/index_error", $data);
            } else {
                $akses_layer = [];
                $layers = $this->db
                    ->select('id_layer')
                    ->from('tabel_api_widget_layer t1')
                    ->where('id_api_widget', $api['id_api_widget'])
                    ->get()
                    ->result_array();
                foreach ($layers as $v) {
                    array_push($akses_layer, $v['id_layer']);
                }
                if (in_array($id, $akses_layer)) {
                    $this->get_geojson($id);
                } else {
                    $data['message'] = 'Anda tidak memiliki hak akses API';
                    $this->load->view("front/api/index_error", $data);
                }
            }
        } else {
            redirect(base_url());
        }
    }

    private function get_geojson($id)
    {
        $layer = $this->db->where('id_layer', $id)->get('tabel_layer')->row_array();
        switch ($layer['sumber']) {
            case '1':
                $this->sumber_database($id);
                break;
            case '2':
                $this->sumber_api($id, $layer['link_api']);
                break;
            default:
                break;
        }
    }

    // private function sumber_database($id){
    //         $q = "
    //         SELECT
    //         t1.id_layer,
    //         t1.id_opd,
    //         t1.nama_layer,
    //         t2.id_atribut,
    //         t2.nama_atribut,
    //         t3.id_data,
    //         t3.id_collection,
    //         t3.data_value,
    //         t4.tipe_layer,
    //         t4.koordinat,
    //         t4.stroke,
    //         t4.stroke_opacity,
    //         t4.stroke_width,
    //         t4.fill,
    //         t4.fill_opacity,
    //         t4.icon_name,
    //         t4.`name`,
    //         t4.`group`,
    //         t4.page_detail
    //         FROM tabel_layer t1
    //         INNER JOIN tabel_atribut_layer t2 ON t2.id_layer = t1.id_layer
    //         INNER JOIN tabel_value_attribut t3 ON t3.id_atribut = t2.id_atribut
    //         INNER JOIN tabel_collection t4 ON t4.id_collection = t3.id_collection
    //         WHERE 1 = 1
    //         AND t1.status = 1
    //         AND t1.id_layer = {$this->db->escape($id)}
    //     ";
    //     $r = $this->db->query($q)->result_array();
    //     $features = array();

    //     if(count($r) > 0){
    //         foreach($r as $k=>$v){
    //             $features[$v['id_collection']]['id_layer'] = $v['id_layer'];
    //             $features[$v['id_collection']]['id_opd'] = $v['id_opd'];
    //             $features[$v['id_collection']]['id_collection'] = $v['id_collection'];
    //             $features[$v['id_collection']]['nama_layer'] = $v['nama_layer'];
    //             $features[$v['id_collection']][$v['nama_atribut']] = $v['data_value'];
    //             $features[$v['id_collection']]['tipe_layer'] = $v['tipe_layer'];
    //             $features[$v['id_collection']]['koordinat'] = $v['koordinat'];
    //             $features[$v['id_collection']]['stroke'] = $v['stroke'];
    //             $features[$v['id_collection']]['stroke_opacity'] = $v['stroke_opacity'];
    //             $features[$v['id_collection']]['stroke_width'] = $v['stroke_width'];
    //             $features[$v['id_collection']]['fill'] = $v['fill'];
    //             $features[$v['id_collection']]['fill_opacity'] = $v['fill_opacity'];
    //             $features[$v['id_collection']]['icon_name'] = $v['icon_name'];
    //             $features[$v['id_collection']]['name'] = $v['name'];
    //             $features[$v['id_collection']]['group'] = $v['group'];
    //             $features[$v['id_collection']]['page_detail'] = $v['page_detail'];
    //         }
    //     }

    //     $geojson = array(
    //         "type" => "FeatureCollection",
    //         "features" => array()
    //     );

    //     $feature = array();

    //     foreach($features as $key => $val)
    //     {
    //         $property = array();
    //         $geometry = array();

    //         foreach($val as $k => $v)
    //         {
    //             if($k != 'koordinat' && $k != 'tipe_layer')
    //             {
    //                 $property[$k] = $v;
    //             }
    //             else
    //             {
    //                 if($k == 'tipe_layer')
    //                 {
    //                     $geometry['type'] = $v;
    //                 }
    //                 else
    //                 {
    //                     $c = json_decode($v);
    //                     $geometry['coordinates'] = $c;
    //                 }
    //             }
    //         } 

    //         $feature[] = array(
    //             'type' => 'Feature',
    //             'properties' => $property,
    //             'geometry' => $geometry
    //         );
    //     }

    //     $geojson['features'] = $feature;

    //     $this->output
    //         ->set_status_header(200)
    //         ->set_content_type('application/json', 'utf-8')
    //         ->set_output(json_encode($geojson))
    //         ->_display();
    // 		exit;

    // }

    private function sumber_database($id)
    {
        $qalias = "SELECT
            t3.*
            FROM tabel_layer t1 
            INNER JOIN tabel_grup_atribut t2 ON t2.id_layer = t1.id_layer
            INNER JOIN tabel_grup_atribut_item t3 ON t3.id_grup_atribut = t2.id_grup_atribut
            WHERE 1 = 1
            AND t1.id_layer = {$this->db->escape($id)}";

        $qdata = "SELECT
        *
        FROM tabel_layer t1 
        INNER JOIN tabel_grup_atribut t2 ON t2.id_layer = t1.id_layer
        WHERE 1 = 1
        AND t1.id_layer = {$this->db->escape($id)}";

        $get_alias = $this->db->query($qalias)->result_array();
        $get_data = $this->db->query($qdata)->result_array();

        $xconfig = [];
        $xdata = [];
        $xalias = [];

        $xconfig['sumber'] = 'database';
        $xconfig['autoopen_infografis'] = true;

        if (count($get_data) > 0) {
            $group_order = json_decode($get_data[0]['pos_grup_atribut'], true);
            $group_order = $group_order['group_sort'];
            $set_order = [];

            foreach ($get_data as $v) {
                $x = [];
                $x['judul_grup'] = $v['judul_grup_atribut'];
                $x['sub_judul_grup'] = $v['sub_judul_grup_atribut'];
                $x['tipe_grup'] = $v['tipe_grup_atribut'];
                $x['ukuran_grup'] = $v['ukuran_grup_atribut'];
                $x['item_grup'] = $v['pos_grup_atribut_item'] == null ? ['item_sort' => []] : json_decode($v['pos_grup_atribut_item'], true);

                $set_order[$v['id_grup_atribut']] = $x;
            }

            foreach ($group_order as $v) {
                $xdata[] = $set_order[$v];
            }
        }

        foreach ($get_alias as $v) {
            $xalias[$v['id_atribut']] = $v;
        }

        // echo '<pre>';
        // // print_r($xdata);
        // echo json_encode($xalias, JSON_PRETTY_PRINT);
        // echo '</pre>';

        // // exit;

        $q = "
            SELECT
            t1.id_layer,
            t1.id_opd,
            t1.nama_layer,
            t2.id_atribut,
            t2.nama_atribut,
            t3.id_data,
            t3.id_collection,
            t3.data_value,
            t4.tipe_layer,
            t4.koordinat,
            t4.stroke,
            t4.stroke_opacity,
            t4.stroke_width,
            t4.fill,
            t4.fill_opacity,
            t4.icon_name,
            t4.`name`,
            t4.`group`,
            t4.page_detail
            FROM tabel_layer t1
            INNER JOIN tabel_atribut_layer t2 ON t2.id_layer = t1.id_layer
            INNER JOIN tabel_value_attribut t3 ON t3.id_atribut = t2.id_atribut
            INNER JOIN tabel_collection t4 ON t4.id_collection = t3.id_collection
            WHERE 1 = 1
            AND t1.id_layer = {$this->db->escape($id)}
        ";
        $r = $this->db->query($q)->result_array();
        $features = array();

        if (count($r) > 0) {
            foreach ($r as $k => $v) {
                $features[$v['id_collection']]['id_layer'] = $v['id_layer'];
                $features[$v['id_collection']]['id_opd'] = $v['id_opd'];
                $features[$v['id_collection']]['id_collection'] = $v['id_collection'];
                $features[$v['id_collection']]['nama_layer'] = $v['nama_layer'];
                $features[$v['id_collection']][$v['nama_atribut']] = $v['data_value'];
                $features[$v['id_collection']]['tipe_layer'] = $v['tipe_layer'];
                $features[$v['id_collection']]['koordinat'] = $v['koordinat'];
                $features[$v['id_collection']]['stroke'] = $v['stroke'];
                $features[$v['id_collection']]['stroke_opacity'] = $v['stroke_opacity'];
                $features[$v['id_collection']]['stroke_width'] = $v['stroke_width'];
                $features[$v['id_collection']]['fill'] = $v['fill'];
                $features[$v['id_collection']]['fill_opacity'] = $v['fill_opacity'];
                $features[$v['id_collection']]['icon_name'] = $v['icon_name'];
                $features[$v['id_collection']]['name'] = $v['name'];
                $features[$v['id_collection']]['group'] = $v['group'];
                $features[$v['id_collection']]['page_detail'] = $v['page_detail'];
            }
        }

        $geojson = array(
            "type" => "FeatureCollection",
            "xconfig" => $xconfig,
            "xdata" => $xdata,
            "xalias" => $xalias,
            "features" => array()
        );

        $feature = array();

        foreach ($features as $key => $val) {
            $property = array();
            $geometry = array();

            foreach ($val as $k => $v) {
                if ($k != 'koordinat' && $k != 'tipe_layer') {
                    $property[$k] = $v;
                } else {
                    if ($k == 'tipe_layer') {
                        $geometry['type'] = $v;
                    } else {
                        $c = json_decode($v);
                        $geometry['coordinates'] = $c;
                    }
                }
            }

            $feature[] = array(
                'type' => 'Feature',
                'properties' => $property,
                'geometry' => $geometry
            );
        }

        $geojson['features'] = $feature;



        // echo '<pre>';
        // print_r($geojson);
        // echo '</pre>';
        // print_r($query2);
        // echo '<pre>';
        // echo json_encode($geojson, JSON_PRETTY_PRINT);
        // echo '</pre>';

        // echo json_encode($geojson);

        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($geojson))
            ->_display();
        exit;
    }

    private function sumber_api($id, $link)
    {
        if ($link != null) {
            $url = $link;
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
            $res = curl_exec($curl);
            curl_close($curl);
        } else {
            $res = 'no link';
        }

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output($res)
            ->_display();
        exit;
    }

    public function extend_layers()
    {
        $url = [];
        $url['sipd'] = [
            'id' => 1,
            'jenis_peta' => 'SIPD',
            'prefix' => 'sipd',
            'url' => base_url() . 'api/layer_api/sipd/',
            // 'url' => base_url() . 'api/menuapi/',
            'default_param' => '0'
        ];

        $url['infrastruktur_kota'] = [
            'id' => 2,
            'jenis_peta' => 'Infrastruktur Kota',
            'prefix' => 'infrastruktur_kota',
            'url' => base_url() . 'api/layer_api/infrastruktur_kota/',
            'default_param' => '0'
        ];

        echo json_encode($url);
    }

    public function layer_api($prefix, $id)
    {
        $url = [];
        $url['sipd'] = 'http://solodata.surakarta.go.id/pertanyaan/intipmenu/';
        $url['infrastruktur_kota'] = 'https://appt.demoo.id/surakarta/sippd/api/menu_intip/';

        if ($url[$prefix] != null) {
            $url = $url[$prefix] . $id;
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
            $res = curl_exec($curl);
            curl_close($curl);
        } else {
            $res = 'no link';
        }

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output($res)
            ->_display();
        exit;
    }

    public function menuapi($id)
    {
        if ($id == 0) {
            $res['jenis_peta'] = 'SIPD';
            $res['prefix'] = 'sipd';
            $res['data'] = [
                [
                    'id' => 1,
                    'name' => 'Wajib',
                    'children' => 10,
                    'level' => 1,
                    'layer' => false
                ],
                [
                    'id' => 2,
                    'name' => 'Pilihan',
                    'children' => 3,
                    'level' => 1,
                    'layer' => false

                ],
                [
                    'id' => 3,
                    'name' => 'Umum',
                    'children' => 6,
                    'level' => 1,
                    'layer' => false
                ]
            ];
        } elseif ($id == 1) {
            $res['jenis_peta'] = 'SIPD';
            $res['prefix'] = 'sipd';
            $res['data'] = [
                [
                    'id' => 11,
                    'name' => 'Kesehatan',
                    'children' => 14,
                    'level' => 2,
                    'layer' => false
                ],
                [
                    'id' => 12,
                    'name' => 'Pendidikan',
                    'children' => 17,
                    'level' => 2,
                    'layer' => false

                ],
                [
                    'id' => 13,
                    'name' => 'Kependudukan',
                    'children' => 13,
                    'level' => 2,
                    'layer' => false
                ]
            ];
        } elseif ($id == 11) {
            $res['jenis_peta'] = 'SIPD';
            $res['prefix'] = 'sipd';
            $res['data'] = [
                [
                    'id' => 21,
                    'name' => 'Child Kesehatan',
                    'children' => 24,
                    'level' => 3,
                    'layer' => false
                ],
                [
                    'id' => 22,
                    'name' => 'Child Pendidikan',
                    'children' => 27,
                    'level' => 3,
                    'layer' => false

                ],
                [
                    'id' => 23,
                    'name' => 'child Kependudukan',
                    'children' => 23,
                    'level' => 3,
                    'layer' => false
                ]
            ];
        } elseif ($id == 21) {
            $res['jenis_peta'] = 'SIPD';
            $res['prefix'] = 'sipd';
            $res['data'] = [
                [
                    'id' => 31,
                    'name' => 'Grand Child Kesehatan',
                    'children' => 34,
                    'level' => 4,
                    'layer' => true
                ],
                [
                    'id' => 32,
                    'name' => 'Grand Child Pendidikan',
                    'children' => 37,
                    'level' => 4,
                    'layer' => true

                ],
                [
                    'id' => 33,
                    'name' => 'Grand child Kependudukan',
                    'children' => 33,
                    'level' => 4,
                    'layer' => true
                ]
            ];
        }
        // else{
        //     $res['jenis_peta'] = 'SIPD';
        //     $res['prefix'] = 'sipd';
        //     $res['data'] = [
        //         [
        //             'id' => 1,
        //             'name' => 'Kesehatan',
        //             'children' => 4,
        //             'level' => 2
        //         ],
        //         [
        //             'id' => 2,
        //             'name' => 'Pendidikan',
        //             'children' => 7,
        //             'level' => 2

        //         ],
        //         [
        //             'id' => 3,
        //             'name' => 'Kependudukan',
        //             'children' => 3,
        //             'level' => 2
        //         ]
        //     ]; 
        // }

        echo json_encode($res);
    }

    public function example($id)
    {
        echo 'contoh: ' . $id;
    }

    // API Widget Start

    private function check_access_token($access_token)
    {
        $res = [];
        $access = $this->db->where('access_token', $access_token)->get('tabel_api_widget')->row_array();
        function checking_request($access)
        {
            //checking request
            $url_app = $access['url_app'];
            $pattern = '/^' . preg_quote($url_app, '/') . '/';
            $url = $_SERVER['HTTP_REFERER'];
            preg_match($pattern, $url, $match);
            return count($match) > 0 ? true : false;
        }

        if (count($access) > 0) {
            $res['status'] = checking_request($access);
            $res['data'] = $access;
        } else {
            $res['status'] = false;
            $res['data'] = $access;
        }

        return $res;
    }

    // API Widget End

    public function list_layer()
    {
        $raw = $this->db->where('status', 1)->get('tabel_layer')->result_array();
        echo json_encode($raw);
    }

    public function list_koordinat()
    {
        $id = $this->input->post('id_layer');
        $raw = $this->db->where('id_layer', $id)->get('tabel_collection')->result_array();
        echo json_encode($raw);
    }

    public function get_koordinat()
    {
        $id = $this->input->post('id_collection');
        $raw = $this->db->where('id_collection', $id)->get('tabel_collection')->row_array();
        $geojson = [
            'type' => 'FeatureCollection',
            'features' => [
                [
                    'type' => 'Feature',
                    'properties' => [
                        'name' => $raw['name']
                    ],
                    'geometry' => [
                        'type' => $raw['tipe_layer'],
                        'coordinates' => json_decode($raw['koordinat']),
                    ]
                ]
            ]
        ];
        echo json_encode($geojson);
    }
}

/* End of file Peta.php */
