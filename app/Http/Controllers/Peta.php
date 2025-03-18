<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('memory_limit', '-1');

class Peta extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        header('Access-Control-Allow-Origin: *');

        $this->db_krk = $this->load->database('db_krk', true);
        $this->kode_tegal = '3376';
        $this->load->model('WilayahKemdagriModel', 'wilayah_model');
    }

    // public function index()
    // {
    //     $data = [
    //         'isi' => "$this->base/peta/index",
    //         'extra_js' => $this->load->view("$this->base/peta/index_js", '', true),
    //         'daftar_opd' => $this->peta->daftar_opd(),
    //     ];
    //     $this->load->view('layouts/wrapper', $data, FALSE);
    // }

    public function index()
    {
        $data['layers'] = array();
        $q = "SELECT * FROM tabel_layer
            WHERE 1=1
            AND status = 1
            AND IF(
		    sumber=1,
            id_layer IN (
                SELECT id_layer FROM tabel_collection GROUP BY id_layer
            ),
            1=1)
            ORDER BY order_by
        ";
        $layers = $this->db->query($q)->result_array();

        if (count($layers) > 0) {
            foreach ($layers as $k => $v) {
                $layer = array();
                $layer['id'] = $v['id_layer'];
                $layer['id_grup_layer'] = $v['id_grup_layer'];
                $layer['id_jenis_peta'] = $v['id_jenis_peta'];
                $layer['id_opd'] = $v['id_opd'];
                $layer['name'] = $v['nama_layer'];
                $layer['slug'] = str_replace(' ', '_', strtolower($v['nama_layer']));
                array_push($data['layers'], $layer);
            }
        }

        $data['grup_layer'] = $this->db->get('tabel_grup_layer')->result_array();
        $data['jenis_peta'] = $this->db->get('tabel_jenis_peta')->result_array();

        $a  = [];

        foreach ($data['jenis_peta'] as $jpk => $jpv) {
            foreach ($data['grup_layer'] as $glk => $glv) {
                foreach ($data['layers'] as $lk => $lv) {
                    if (
                        $lv['id_jenis_peta'] == $jpv['id_jenis_peta'] &&
                        $lv['id_grup_layer'] == $glv['id_grup_layer']
                    ) {
                        $a[$jpv['id_jenis_peta']]['src'] = $jpv;
                        $a[$jpv['id_jenis_peta']]['data'][$glv['id_grup_layer']]['src'] = $glv;
                        $a[$jpv['id_jenis_peta']]['data'][$glv['id_grup_layer']]['data'][] = $lv;
                    }
                }
            }
        }
        $data['list_layer'] = $a;
        $this->load->view("front/peta/index", $data);
    }

    function get_geojson($prefix, $id)
    {
        $layer = $this->db->where('id_layer', $id)->get('tabel_layer')->row_array();
        if ($prefix == 'db') {
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
        } else {
            $this->sumber_api_eksternal($prefix, $id);
        }
    }

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
            t1.is_perbaikan,
            t2.slug,
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
            t4.stroke_dash,
            t4.fill,
            t4.fill_opacity,
            t4.icon_name,
            t4.`name`,
            t4.`group`,
            t4.page_detail,
            case when t5.total_foto is null then 0 else t5.total_foto end as total_foto
            FROM tabel_layer t1
            INNER JOIN tabel_atribut_layer t2 ON t2.id_layer = t1.id_layer
            INNER JOIN tabel_value_attribut t3 ON t3.id_atribut = t2.id_atribut
            INNER JOIN tabel_collection t4 ON t4.id_collection = t3.id_collection
            left join (select id_collection, count(1) as total_foto from tabel_foto_collection group by id_collection) t5 on t5.id_collection=t4.id_collection
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
                $features[$v['id_collection']]['stroke_dash'] = $v['stroke_dash'];
                $features[$v['id_collection']]['fill'] = $v['fill'];
                $features[$v['id_collection']]['fill_opacity'] = $v['fill_opacity'];
                $features[$v['id_collection']]['icon_name'] = $v['icon_name'];
                $features[$v['id_collection']]['name'] = $v['name'];
                $features[$v['id_collection']]['group'] = $v['group'];
                $features[$v['id_collection']]['page_detail'] = $v['page_detail'];
                $features[$v['id_collection']]['total_foto'] = $v['total_foto'];
                $features[$v['id_collection']]['is_perbaikan'] = $v['is_perbaikan'];
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

    private function sumber_api_eksternal($prefix, $id)
    {
        $url = [];
        // $url['sipd'] = base_url() . 'example_api/geojson/'; 
        $url['sipd'] = 'http://solodata.surakarta.go.id/pertanyaan/intipdatanew/';
        $url['infrastruktur_kota'] = 'https://appt.demoo.id/surakarta/sippd/api/infrastruktur_kota/';

        if ($prefix != null && $url[$prefix] != null) {
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

    public function informasi_detail($id = 0)
    {
        if ($id > 0) {
            $data['deskripsi'] = $this->db->where('id_collection', $id)->get('tabel_diskripsi_collection')->row_array();
            $this->load->view("front/peta/informasi_detail", $data);
        } else {
            echo "404";
        }
    }

    public function get_informasi_detail($id = 0)
    {
        if ($id > 0) {

            $q = "
                SELECT
                t1.id_layer,
                t1.id_opd,
                t1.nama_layer,
                t2.slug,
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
                t4.stroke_dash,
                t4.fill,
                t4.fill_opacity,
                t4.icon_name,
                t4.page_detail
                -- t5.deskripsi
                FROM tabel_layer t1
                INNER JOIN tabel_atribut_layer t2 ON t2.id_layer = t1.id_layer
                INNER JOIN tabel_value_attribut t3 ON t3.id_atribut = t2.id_atribut
                INNER JOIN tabel_collection t4 ON t4.id_collection = t3.id_collection
                -- LEFT JOIN tabel_diskripsi_collection t5 ON t4.id_collection = t5.id_collection
                WHERE 1 = 1
                AND t4.id_collection = {$this->db->escape($id)}
            ";
            $r = $this->db->query($q)->result_array();
            //  print_r($r);exit;
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
                    $features[$v['id_collection']]['stroke_dash'] = $v['stroke_dash'];
                    $features[$v['id_collection']]['fill'] = $v['fill'];
                    $features[$v['id_collection']]['fill_opacity'] = $v['fill_opacity'];
                    $features[$v['id_collection']]['icon_name'] = $v['icon_name'];
                    $features[$v['id_collection']]['page_detail'] = $v['page_detail'];
                    $features[$v['id_collection']]['kode_sub_zona'] = json_encode($v);
                    // $features[$v['id_collection']]['deskripsi'] = $v['deskripsi'];
                }
            }

            $geojson = array(
                "type" => "FeatureCollection",
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
            // exit;

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
    }

    public function sanggar()
    {
        $data['layers'] = array();
        $q = "SELECT * FROM tabel_layer
            WHERE 1=1
            AND status = 1
            AND nama_layer IN ('Sanggar','Batas Kecamatan')
            AND id_layer IN (
                SELECT id_layer FROM tabel_collection GROUP BY id_layer
            )
        ";
        $layers = $this->db->query($q)->result_array();

        if (count($layers) > 0) {
            foreach ($layers as $k => $v) {
                $layer = array();
                $layer['id'] = $v['id_layer'];
                $layer['id_grup_layer'] = $v['id_grup_layer'];
                $layer['id_jenis_peta'] = $v['id_jenis_peta'];
                $layer['id_opd'] = $v['id_opd'];
                $layer['name'] = $v['nama_layer'];
                $layer['slug'] = str_replace(' ', '_', strtolower($v['nama_layer']));
                array_push($data['layers'], $layer);
            }
        }

        $data['grup_layer'] = $this->db->get('tabel_grup_layer')->result_array();
        $data['jenis_peta'] = $this->db->get('tabel_jenis_peta')->result_array();

        $a  = [];

        foreach ($data['jenis_peta'] as $jpk => $jpv) {
            foreach ($data['grup_layer'] as $glk => $glv) {
                foreach ($data['layers'] as $lk => $lv) {
                    if (
                        $lv['id_jenis_peta'] == $jpv['id_jenis_peta'] &&
                        $lv['id_grup_layer'] == $glv['id_grup_layer']
                    ) {
                        $a[$jpv['id_jenis_peta']]['src'] = $jpv;
                        $a[$jpv['id_jenis_peta']]['data'][$glv['id_grup_layer']]['src'] = $glv;
                        $a[$jpv['id_jenis_peta']]['data'][$glv['id_grup_layer']]['data'][] = $lv;
                    }
                }
            }
        }
        $data['list_layer'] = $a;
        $this->load->view("front/peta/sanggar", $data);
    }

    public function get_kecamatan()
    {
        $res['data'] = $this->db->get('tabel_kecamatan')->result_array();
        echo json_encode($res);
    }

    public function get_kelurahan()
    {
        $nama_kec = $this->input->post('nama_kec');
        if ($nama_kec != '') {
            $kec = $this->db->like('nama', $nama_kec)->get('tabel_kecamatan')->row_array();
            if ($kec != null) {
                $id_kec = $kec['id_kecamatan'];
                $res['data'] = $this->db->where('id_kecamatan', $id_kec)->get('tabel_kelurahan')->result_array();
            } else {
                $res['data'] = [];
            }
        } else {
            $res['data'] = [];
        }
        echo json_encode($res);
    }

    public function test()
    {
        $this->load->view('front/peta/index2');
    }

    public function geo_covid()
    {
        $url = 'https://covid.intip.surakarta.go.id/api/peta/geo_all';
        $ch = curl_init();

        // set url
        curl_setopt($ch, CURLOPT_URL, $url);

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $output = curl_exec($ch);
        echo $output;
        // close curl resource to free up system resources
        curl_close($ch);
    }

    public function geo_simonela_point($tahun = null)
    {
        if (!$tahun) $tahun = date('Y');

        $url = 'https://egov.phicos.co.id/surakarta/infrastruktur/api/simonela/peta_poin?tahun=' . $tahun;
        $ch = curl_init();

        // set url
        curl_setopt($ch, CURLOPT_URL, $url);

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $output = curl_exec($ch);
        echo $output;
        // close curl resource to free up system resources
        curl_close($ch);
    }

    public function geo_simonela_polygon($tahun = null)
    {
        if (!$tahun) $tahun = date('Y');

        $url = 'https://egov.phicos.co.id/surakarta/infrastruktur/api/simonela/peta_polygon?tahun=' . $tahun;
        $ch = curl_init();

        // set url
        curl_setopt($ch, CURLOPT_URL, $url);

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $output = curl_exec($ch);
        echo $output;
        // close curl resource to free up system resources
        curl_close($ch);
    }

    public function geo_simonela_moitoring($id = null)
    {
        if (!$id) {
            echo json_encode([
                'status' => 'failed',
                'msg' => 'id tidak boleh kosong'
            ]);
        }

        $url = 'https://egov.phicos.co.id/surakarta/infrastruktur/api/simonela/data_monitoring/?id=' . $id;
        $ch = curl_init();

        // set url
        curl_setopt($ch, CURLOPT_URL, $url);

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $output = curl_exec($ch);
        echo $output;
        // close curl resource to free up system resources
        curl_close($ch);
    }

    public function geo_simonela_moitoring_foto($id = null)
    {
        if (!$id) {
            echo json_encode([
                'status' => 'failed',
                'msg' => 'id tidak boleh kosong'
            ]);
        }

        $url = 'https://egov.phicos.co.id/surakarta/infrastruktur/api/simonela/data_foto_monitoring/?id=' . $id;
        $ch = curl_init();

        // set url
        curl_setopt($ch, CURLOPT_URL, $url);

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $output = curl_exec($ch);
        echo $output;
        // close curl resource to free up system resources
        curl_close($ch);
    }

    public function lihat_foto()
    {
        $id = $this->input->post('id');
        $data = $this->db->query("SELECT * FROM tabel_foto_collection where id_collection='$id' ")->result();
        echo json_encode([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function lihat_data_perbaikan()
    {
        echo json_encode([
            'status' => true,
            'html' => $this->load->view('front/peta/lihat_data_perbaikan', [
                'id' => $this->input->post('id')
            ], true)
        ]);
    }

    public function data_perbaikan($id_data = null)
    {
        $this->load->model('PetaModel', 'peta');
        $list = $this->peta->get_datatables_perbaikan($id_data);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;

            $row = array();
            $row[] = $no;
            $row[] = $field->tahun;
            $row[] = $field->paket_pekerjaan . '<br>Anggaran : ' . $field->anggaran;
            $row[] = $field->lokasi;
            $row[] = $field->pelaksana . '<br>No Kontrak : ' . $field->no_kontrak;
            $row[] = '
                    <button data="' . $field->id_perbaikan . '" type="button" class="btn btn-warning btn-sm btn_ubah" title="Ubah Data ' . $field->paket_pekerjaan . '"><i class="fa fa-pencil"></i></button>
                    <button data="' . $field->id_perbaikan . '" type="button" class="btn btn-danger btn-sm btn_hapus" title="Hapus Data ' . $field->paket_pekerjaan . '"><i class="fa fa-trash"></i></button>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->peta->count_all_perbaikan($id_data),
            "recordsFiltered" => $this->peta->count_filtered_perbaikan($id_data),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    // public function aksi_ajukan_krk()
    // {
    //     $keyword = $this->input->post('id');
    //     $lat = $this->input->post('lat');
    //     $lng = $this->input->post('lng');


    //     $data['keyword'] = $keyword; 
    //     echo json_encode(['status' => true,'data' => $keyword,'lat' => $lat,'lng' => $lng]);
    // }

    function page_ajukan_krk()
    {

        $keyword = $this->input->post('keyword', true);
        $lat = $this->input->post('lat', true);
        $lng = $this->input->post('lng', true);
        $kegiatan = $this->input->post('kegiatan', true);

        $q_rdtr = $this->db->where(['nilai_kolom_unik' => $keyword])->get('db_rdtr')->row();
        $q_kbli = $this->db->select('id_kegiatan,kegiatan')->get('db_kbli')->result();

        $array_kbli = [];
        foreach ($q_kbli as $value_kbli) {
            $array_kbli[$value_kbli->id_kegiatan] = $value_kbli->kegiatan;
        }

        $data = [];
        if (@$q_rdtr) {
            $data['kdb'] = json_decode($q_rdtr->kdb);
            $data['klb'] = json_decode($q_rdtr->klb);
            $data['kdh'] = json_decode($q_rdtr->kdh);
            $data['gsb'] = json_decode($q_rdtr->gsb);
            $data['ktb'] = json_decode($q_rdtr->ktb);
            $data['ktgbgn'] = json_decode($q_rdtr->ktgbgn);
            $data['bgnizn'] = json_decode($q_rdtr->bgnizn);
            $data['bgntbt'] = json_decode($q_rdtr->bgntbt);
            $data['bgnbst'] = json_decode($q_rdtr->bgnbst);
            $data['bgntbs'] = json_decode($q_rdtr->bgntbs);
            $data['ketrgn'] = json_decode($q_rdtr->ketrgn);
        }

        $data['keyword'] = $keyword;
        $data['lat'] = $lat;
        $data['lng'] = $lng;
        $data['kegiatan'] = $kegiatan;
        $data['rdtr'] = $q_rdtr;
        $data['kbli'] = $array_kbli;
        $data['dokumen'] = $this->db_krk->get_where('dokumen', ['deleted_at' => NULL])->result();
        $data['ref_foto'] = $this->db_krk->get_where('ref_foto')->result();
        $all_kab = $this->wilayah_model->all_kab('kode_bersih,nama, nama_propinsi');
        $data['all_kab'] = $all_kab;
        $all_tegal = $this->wilayah_model->all_tegal_kota('kode_bersih,nama,id_level_wilayah');
        $data['all_tegal'] = $all_tegal;
        $this->load->view("front/peta/ajukan_krk_test", $data);
    }

    function modal_ajukan_krk()
    {
        $keyword = $this->input->post('id');
        $lat = $this->input->post('lat');
        $lng = $this->input->post('lng');

        $q_kbli = $this->db->select('id_kegiatan,kegiatan')->get('db_kbli')->result();
        $q_rdtr = $this->db->where(['nilai_kolom_unik' => $keyword])->get('db_rdtr')->row();

        $array_kbli = [];
        foreach ($q_kbli as $value_kbli) {
            $array_kbli["{$value_kbli->id_kegiatan}"] = $value_kbli->kegiatan;
        }

        $q_bgnizn = json_decode($q_rdtr->bgnizn);
        $q_bgntbt = json_decode($q_rdtr->bgntbt);
        $q_bgnbst = json_decode($q_rdtr->bgnbst);
        $q_bgntbs = json_decode($q_rdtr->bgntbs);

        $data = [];
        if ($q_bgnizn->data != '-') {
            foreach ($q_bgnizn->data as $key_bgnizn => $value_bgnizn) {
                $data[] = $value_bgnizn . '-' . $array_kbli["{$value_bgnizn}"];
            }
        }
        if ($q_bgntbt->data != '-') {
            foreach ($q_bgntbt->data as $key_bgntbt => $value_bgntbt) {
                $data[] = $value_bgntbt . '-' . $array_kbli["{$value_bgntbt}"];
            }
        }
        if ($q_bgnbst->data != '-') {
            foreach ($q_bgnbst->data as $key_bgnbst => $value_bgnbst) {
                $data[] = $value_bgnbst . '-' . $array_kbli["{$value_bgnbst}"];
            }
        }
        if ($q_bgntbs->data != '-') {
            foreach ($q_bgntbs->data as $key_bgntbs => $value_bgntbs) {
                $data[] = $value_bgntbs . '-' . $array_kbli["{$value_bgntbs}"];
            }
        }

        echo json_encode(['status' => true, 'data' => $data, 'keyword' => $keyword, 'lat' => $lat, 'lng' => $lng]);
    }


    function select_provinsi()
    {
        $q_provinsi = $this->db_krk->where(['id_level_wilayah' => '1'])->get('wilayah_kemdagri')->result();

        echo json_encode(['status' => true, 'data' => $q_provinsi]);
    }

    function select_kabupaten($kode_provinsi = null)
    {
        $q_kabupaten = $this->db_krk->where(['kode_bersih' => $kode_provinsi, 'id_level_wilayah' => '2'])->get('wilayah_kemdagri')->result();

        echo json_encode(['status' => true, 'data' => $q_kabupaten]);
    }

    function select_kecamatan($kode_kecamatan = null)
    {
        $q_kecamatan = $this->db_krk->where(['kode_bersih' => $kode_kecamatan, 'id_level_wilayah' => '3'])->get('wilayah_kemdagri')->result();

        echo json_encode(['status' => true, 'data' => $q_kecamatan]);
    }

    function get_kecamatan_filtered()
    {
        $kode_kab = $this->input->post('kode_kab', true);
        $data = [];
        if ($kode_kab != '') $data = $this->wilayah_model->get_kec_by_kab($kode_kab, 'kode_bersih, nama, id_level_wilayah');
        echo json_encode(['status' => true, 'data' => $data]);
    }

    function lihat_krk()
    {
        $keyword = $this->input->post('id');
        $lat = $this->input->post('lat');
        $lng = $this->input->post('lng');

        $q_rdtr = $this->db->where(['nilai_kolom_unik' => $keyword])->get('db_rdtr')->row();
        $q_kbli = $this->db->select('id_kegiatan,kegiatan')->get('db_kbli')->result();

        $array_kbli = [];
        foreach ($q_kbli as $value_kbli) {
            $array_kbli[$value_kbli->id_kegiatan] = $value_kbli->kegiatan;
        }

        $data = [];
        if (@$q_rdtr) {
            $data['kdb'] = json_decode($q_rdtr->kdb);
            $data['klb'] = json_decode($q_rdtr->klb);
            $data['kdh'] = json_decode($q_rdtr->kdh);
            $data['gsb'] = json_decode($q_rdtr->gsb);
            $data['ktb'] = json_decode($q_rdtr->ktb);
            // $data['ktgbgn'] = json_decode($q_rdtr->ktgbgn);
            // $data['bgnizn'] = json_decode($q_rdtr->bgnizn);
            // $data['bgntbt'] = json_decode($q_rdtr->bgntbt);
            // $data['bgnbst'] = json_decode($q_rdtr->bgnbst);
            // $data['bgntbs'] = json_decode($q_rdtr->bgntbs);
            $data['ketrgn'] = json_decode($q_rdtr->ketrgn);
        }

        // ======
        $q_ktgbgn = json_decode($q_rdtr->ktgbgn);
        $q_bgnizn = json_decode($q_rdtr->bgnizn);
        $q_bgntbt = json_decode($q_rdtr->bgntbt);
        $q_bgnbst = json_decode($q_rdtr->bgnbst);
        $q_bgntbs = json_decode($q_rdtr->bgntbs);

        // $data['ktgbgn'][] = '';
        if ($q_ktgbgn->data != '-') {
            foreach ($q_ktgbgn->data->Ketinggian_Bangunan as $key_ktgbgn => $value_ktgbgn) {
                $data['ktgbgn'][] = $value_ktgbgn;
            }
        }
        
        $data['bgnizn'][] = '';
        if ($q_bgnizn->data != '-') {
            foreach ($q_bgnizn->data as $key_bgnizn => $value_bgnizn) {
                $data['bgnizn'][] = $value_bgnizn . '-' . $array_kbli["{$value_bgnizn}"];
            }
        }

        $data['bgntbt'][] = '';
        if ($q_bgntbt->data != '-') {
            foreach ($q_bgntbt->data as $key_bgntbt => $value_bgntbt) {
                $data['bgntbt'][] = $value_bgntbt . '-' . $array_kbli["{$value_bgntbt}"];
            }
        }

        $data['bgnbst'][] = '';
        if ($q_bgnbst->data != '-') {
            foreach ($q_bgnbst->data as $key_bgnbst => $value_bgnbst) {
                $data['bgnbst'][] = $value_bgnbst . '-' . $array_kbli["{$value_bgnbst}"];
            }
        }
        $data['bgntbs'][] = '';
        if ($q_bgntbs->data != '-') {
            foreach ($q_bgntbs->data as $key_bgntbs => $value_bgntbs) {
                $data['bgntbs'][] = $value_bgntbs . '-' . $array_kbli["{$value_bgntbs}"];
            }
        }

        $data['keyword'] = $keyword;
        $data['lat'] = $lat;
        $data['lng'] = $lng;
        $data['rdtr'] = $q_rdtr;
        $data['kbli'] = $array_kbli;

        echo json_encode(['status' => true, 'data' => $data]);
    }
}
