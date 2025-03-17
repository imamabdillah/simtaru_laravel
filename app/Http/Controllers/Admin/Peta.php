<?php

ini_set('memory_limit', '-1');
defined('BASEPATH') or exit('No direct script access allowed');

class Peta extends CI_Controller
{

    private $base = 'admin';

    function __construct()
    {
        parent::__construct();
        $this->load->model('PetaModel', 'peta');
        $this->load->model('CrudModel', 'crud');
        $this->load->library('upload');
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        if ($this->session->userdata('role') != 1) {
            redirect('login');
        }
    }

    public function index()
    {
        $data = [
            'isi' => "$this->base/peta/index",
            'extra_js' => $this->load->view("$this->base/peta/index_js", '', true),
            'daftar_opd' => $this->peta->daftar_opd()
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);
    }

    public function daftar_layer_peta()
    {
        $list = $this->peta->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $sumber = $field->sumber;
            switch ($sumber) {
                case 2:
                    $sumber = 'API';
                    break;
                case 3:
                    $sumber = 'File JSON';
                    break;
                default:
                    $sumber = 'Database';
                    break;
            }
            $status = $field->status;
            switch ($status) {
                case 2:
                    $status = 'Sembunyikan';
                    break;
                default:
                    $status = 'Tampilkan';
                    break;
            }

            $is_perbaikan = @$field->is_perbaikan == '1' ? ' checked' : '';

            $row = array();
            $row[] = $no;
            $row[] = $field->nama_layer;
            $row[] = $field->nama_opd;
            $row[] = $sumber;
            $row[] = $status;
            $row[] = '<div class="col-6">
                        <label class="css-control css-control-primary css-switch">
                            <input type="checkbox" class="css-control-input switch_perbaikan" '.$is_perbaikan.' data="' . $field->id_layer . '">
                            <span class="css-control-indicator"></span>
                        </label>
                    </div>';
            $row[] = '<div class="btn-group btn-group-sm" role="group" aria-label="btnGroup1">
                        <button data="' . $field->id_layer . '" type="button" data-name="' . str_replace(['.', ' '], '_', $field->nama_layer) . '" class="btn btn-default btn_download" title="Download File GeoJSON ' . $field->nama_layer . '"><i class="fa fa-download"></i></button>
                        <button data="' . $field->id_layer . '" type="button" class="btn btn-primary btn_data" title="Kelola Data ' . $field->nama_layer . '"><i class="fa fa-database"></i></button>
                        <button data="' . $field->id_layer . '" type="button" class="btn btn-success btn_kelola" title="Kelola Layer ' . $field->nama_layer . '"><i class="fa fa-edit"></i></button>
                        <button data="' . $field->id_layer . '" type="button" class="btn btn-warning btn_group" title="Grup Atribut ' . $field->nama_layer . '"><i class="fa fa-clone"></i></button>
                    </div>
                    
                    <button data="' . $field->id_layer . '" type="button" class="btn btn-danger btn-sm btn_clear" title="Hapus Semua Data ' . $field->nama_layer . '"><i class="fa fa-times-rectangle"></i></button>
                    <button data="' . $field->id_layer . '" type="button" class="btn btn-danger btn-sm btn_hapus" title="Hapus Layer ' . $field->nama_layer . '"><i class="fa fa-trash"></i></button>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->peta->count_all(),
            "recordsFiltered" => $this->peta->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function daftar_layer_peta2()
    {
        $data = $this->peta->daftar_layer_peta();
        echo json_encode($data);
    }

    public function simpan_layer()
    {
        $data = array(
            'nama_layer' => $this->input->post('nama_layer'),
            'deskripsi_layer' => @$this->input->post('deskripsi_layer') ? $this->input->post('deskripsi_layer') : '',
            'id_opd' => $this->input->post('opd'),
            'id_grup_layer' => $this->input->post('grup_layer'),
            'id_jenis_peta' => $this->input->post('jenis_peta'),
            'sumber' => $this->input->post('sumber'),
            'link_api' => @$this->input->post('link_api') ? $this->input->post('link_api') : null,
            'ditambah_oleh' => $this->session->userdata('id'),
        );
        $data = $this->peta->tambah($data, 'tabel_layer');
    }

    public function kelola()
    {
        $data = [
            'isi' => "$this->base/peta/kelola",
            'extra_js' => $this->load->view("$this->base/peta/kelola_js", '', true),
            'daftar_opd' => $this->peta->daftar_opd(),
            'daftar_grup_layer' => $this->peta->daftar_grup_layer(),
            'daftar_jenis_peta' => $this->peta->daftar_jenis_peta()
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);
    }

    public function grup_atribut()
    {
        $data = [
            'isi' => "$this->base/peta/grup_atribut",
            'extra_js' => $this->load->view("$this->base/peta/grup_atribut_js", '', true),
            'daftar_opd' => $this->peta->daftar_opd(),
            'daftar_grup_layer' => $this->peta->daftar_grup_layer(),
            'daftar_jenis_peta' => $this->peta->daftar_jenis_peta()
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);
    }

    public function get_layer_data()
    {
        $id = $this->input->get('id');
        $data = $this->peta->get_layer_data2($id);
        echo json_encode($data);
    }

    public function ubah_layer()
    {
        $where = array('id_layer' => $this->input->post('id_layer'));
        $data_layer = [
            'nama_layer' => $this->input->post('nama_layer'),
            'deskripsi_layer' => @$this->input->post('deskripsi_layer') ? $this->input->post('deskripsi_layer') : '',
            'id_grup_layer' => $this->input->post('grup_layer'),
            'id_jenis_peta' => $this->input->post('jenis_peta'),
            'id_opd' => $this->input->post('nama_opd'),
            'status' => $this->input->post('status_layer'),
            'link_api' => @$this->input->post('link_api') != '' && @$this->input->post('link_api') != null ? $this->input->post('link_api') : null
        ];
        $data = $this->peta->ubah($data_layer, 'tabel_layer', $where);
        echo json_encode($data);
    }

    public function hapus_layer()
    {

        if ($this->input->post('id') > 0) {
            $where = array('id_layer' => $this->input->post('id'));
            $proses = $this->db->where($where)->delete('tabel_collection');

            $q = "
                DELETE
                FROM tabel_value_attribut
                WHERE 1 = 1
                AND id_atribut IN 
                (
                SELECT
                id_atribut 
                FROM tabel_atribut_layer
                WHERE 1 = 1
                AND id_layer = {$this->input->post('id')}
                )
            ";
            $porses_2 = $this->db->query($q);

            $proses_3 = $this->peta->hapus_layer($this->input->post('id'));
        } else {
            $proses_3 = false;
        }


        echo json_encode($proses_3);
    }

    public function hapus_semua_data_layer()
    {
        if ($this->input->post('id') > 0) {
            $where = array('id_layer' => $this->input->post('id'));
            $proses = $this->db->where($where)->delete('tabel_collection');

            $q = "
                DELETE
                FROM tabel_value_attribut
                WHERE 1 = 1
                AND id_atribut IN 
                (
                SELECT
                id_atribut 
                FROM tabel_atribut_layer
                WHERE 1 = 1
                AND id_layer = {$this->input->post('id')}
                )
            ";
            $porses_2 = $this->db->query($q);
            // $proses_2 = $this->db->where($where)->delete('tabel_value_attribut');
        } else {
            $proses_2 = false;
        }

        echo json_encode($proses_2);
    }

    public function hapus_data_layer()
    {
        $where = array('id_collection' => $this->input->post('id_collection'));
        $proses = $this->db->where($where)->delete('tabel_collection');
        $proses_2 = $this->db->where($where)->delete('tabel_value_attribut');


        echo json_encode($proses_2);
    }

    public function daftar_atribut()
    {
        $id = $this->input->get('id');
        $data = $this->peta->daftar_atribut($id);
        echo json_encode($data);
    }

    public function simpan_atribut()
    {
        $id_layer = $this->input->post('atribut_id_layer');
        $nama = $this->input->post('atribut_nama_atribut');
        $tipe = $this->input->post('atribut_tipe_atribut');
        $json_status = "";
        for ($i = 0; $i < count($nama); $i++) {
            if ($nama[$i] != "" && $tipe[$i] != "") {
                $data_atribut = [
                    'id_layer' => $id_layer,
                    'nama_atribut' => $nama[$i],
                    'slug' => str_replace(' ', '_', $nama[$i]),
                    'tipe_data' => $tipe[$i],
                    'add_by' => $this->session->userdata('id')
                ];
                $this->peta->tambah($data_atribut, 'tabel_atribut_layer');
                $json_status = "saved";
            }
        }
        echo json_encode($json_status);
    }

    public function get_atribut()
    {
        $id = $this->input->get('id');
        $data = $this->peta->get_atribut($id);
        echo json_encode($data);
    }

    public function ubah_atribut()
    {
        $where = array('id_atribut' => $this->input->post('id_atribut'));
        $data_atribut = [
            'nama_atribut' => $this->input->post('nama_atribut'),
            'slug' => str_replace(' ', '_', $this->input->post('nama_atribut')),
            'tipe_data' => $this->input->post('tipe_data'),
            'add_by' => $this->session->userdata('id')
        ];
        $data = $this->peta->ubah($data_atribut, 'tabel_atribut_layer', $where);

        // ubah semua atribut ini di db menu group atribut
        $a = [];
        $a['nama_atribut_layer'] = $this->input->post('nama_atribut');
        $a['user_id'] = $this->session->userdata('id');
        $a['updated_at'] = date('Y-m-d H:i:s');
        $this->peta->ubah($a, 'tabel_grup_atribut_item', $where);

        echo json_encode($data);
    }

    public function hapus_atribut()
    {
        $id = $this->input->post('id');
        $data = $this->peta->hapus_atribut($id);
        echo json_encode($data);
    }

    public function data_peta()
    {
        $id = $this->uri->segment(4);
        $data_js = ['id' => $id];
        $data = [
            'id' => $id,
            'layer' => $this->db->where('id_layer', $id)->get('tabel_layer')->row_array(),
            'isi' => "$this->base/peta/data_peta",
            'extra_js' => $this->load->view("$this->base/peta/data_peta_js", $data_js, true),
            'header' => $this->peta->header_data_peta($id),
            'data_peta' => $this->crud->daftar_where(['id_layer' => $id], 'tabel_layer')->result()
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);
    }

    public function tambah_data_peta()
    {
        $id = $this->uri->segment(4);
        $tipe = $this->uri->segment(5);
        $data = [
            'isi' => "$this->base/peta/tambah_data",
            // 'extra_js' => $this->load->view("$this->base/peta/tambah_data_js_polyline", '', true),
            'data_peta' => $this->crud->daftar_where(['id_layer' => $id], 'tabel_layer')->result(),
            'data_atribut' => $this->crud->daftar_where(['id_layer' => $id], 'tabel_atribut_layer')->result(),
            'data_icon' => $this->db->get('tabel_referensi_icon')->result_array(),
            'data_koordinat' => $this->db->where('tipe_koordinat', $tipe)->where("(id_opd=0 OR id_opd={$this->session->userdata('id_opd')})")->get('tabel_referensi_koordinat')->result_array()
        ];
        if ($tipe == "point") {
            $data['extra_js'] = $this->load->view("$this->base/peta/tambah_data_js_point", '', true);
        } else if ($tipe == "line") {
            $data['extra_js'] = $this->load->view("$this->base/peta/tambah_data_js_polyline", '', true);
        } else {
            $data['extra_js'] = $this->load->view("$this->base/peta/tambah_data_js_polygon", '', true);
        }
        $this->load->view('layouts/wrapper', $data, FALSE);
    }

    public function simpan_data_peta()
    {

        $id_layer = $this->input->post('id_layer');
        // $id_collection = $this->peta->id_collection() + 1;
        $field = $this->crud->daftar_where(['id_layer' => $id_layer], 'tabel_atribut_layer')->result();

        $data_collection = [
            'tipe_layer' => $this->input->post('tipe_layer') == 'Line' ? 'LineString' : $this->input->post('tipe_layer'),
            'koordinat' => $this->input->post('coordinates'),
            'id_layer' => $this->input->post('id_layer'),
            'add_by' => $this->session->userdata('id'),
            'name' => @$this->input->post('name') ? $this->input->post('name') : null,
            'group' => @$this->input->post('group') ? $this->input->post('group') : null,
            'stroke' => @$this->input->post('stroke') ? $this->input->post('stroke') : null,
            'stroke_opacity' => @$this->input->post('stroke_opacity') ? $this->input->post('stroke_opacity') : null,
            'stroke_width' => @$this->input->post('stroke_width') ? $this->input->post('stroke_width') : null,
            'stroke_dash' => @$this->input->post('stroke_dash') ? $this->input->post('stroke_dash') : null,
            'fill' => @$this->input->post('fill') ? $this->input->post('fill') : null,
            'fill_opacity' => @$this->input->post('fill_opacity') ? $this->input->post('fill_opacity') : null,
            'icon_name' => @$this->input->post('icon_name') ? $this->input->post('icon_name') : null,
            'page_detail' => @$this->input->post('page_detail') ? 1 : 0
        ];

        // $this->crud->tambah($data_collection, 'tabel_collection');
        $this->db->insert('tabel_collection', $data_collection);
        $id_collection = $this->db->insert_id();


        foreach ($field as $row) {

            $id_atribut = $this->input->post("id_atribut_" . $row->slug);
            $value = $this->input->post($row->slug);

            $data = array(
                'id_atribut' => $id_atribut,
                'id_collection' => $id_collection,
                'data_value' => $value,
                'add_by' => $this->session->userdata('id'),
            );
            $this->crud->tambah($data, 'tabel_value_attribut');
        }
        echo json_encode($field);
    }

    public function edit_data_peta()
    {
        $id = $this->uri->segment(4);
        $tipe = $this->uri->segment(5);
        $id_collection = $this->uri->segment(6);

        $data_collection = $this->peta->get_collection_data($id_collection);

        $dc = [];
        foreach ($data_collection as $k => $v) {
            foreach ($v as $kk => $vv) {
                if ($kk == 'data_value') {
                    $dc[$data_collection[$k]['slug']] = $vv;
                } else {
                    $dc[$kk] = $vv;
                }
            }
        }

        // echo '<pre>';
        // print_r($dc);
        // echo '</pre>';
        // exit;

        $data = [
            'isi' => "$this->base/peta/edit_data",
            // 'extra_js' => $this->load->view("$this->base/peta/tambah_data_js_polyline", '', true),
            'data_peta' => $this->crud->daftar_where(['id_layer' => $id], 'tabel_layer')->result(),
            'data_atribut' => $this->crud->daftar_where(['id_layer' => $id], 'tabel_atribut_layer')->result(),
            'data_icon' => $this->db->get('tabel_referensi_icon')->result_array(),
            'id_collection' => $id_collection,
            'data_collection' => $dc,
            'data_koordinat' => $this->db->where('tipe_koordinat', $tipe)->where("(id_opd=0 OR id_opd={$this->session->userdata('id_opd')})")->get('tabel_referensi_koordinat')->result_array()
        ];
        if ($tipe == "Point") {
            $data['extra_js'] = $this->load->view("$this->base/peta/edit_data_js_point", '', true);
        } else if ($tipe == "LineString") {
            $data['extra_js'] = $this->load->view("$this->base/peta/edit_data_js_polyline", '', true);
        } else {
            $data['extra_js'] = $this->load->view("$this->base/peta/edit_data_js_polygon", '', true);
        }
        $this->load->view('layouts/wrapper', $data, FALSE);
    }

    public function edit_data_peta_geojson()
    {
        $id_collection = $this->uri->segment(4);
        $query = $this->db->where('id_collection', $id_collection)->get('tabel_collection')->row_array();

        if (is_null($query)) {
            $type = '';
            $coordinates = [];
        } else {
            $type = $query['tipe_layer'];
            $coordinates = $query['koordinat'];
        }

        $geojson['type'] = 'FeatureCollection';
        $geojson['features'] = [];

        $feature['type'] = 'Feature';
        $feature['properties'] = json_decode('{}');
        $feature['geometry']['type'] = $type;
        $feature['geometry']['coordinates'] = json_decode($coordinates);

        $geojson['features'][] = $feature;

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($geojson))
            ->_display();
        exit;
    }

    public function simpan_data_peta_edit()
    {
        $id_layer = $this->input->post('id_layer');
        $id_collection = $this->input->post('id_collection');
        $field = $this->crud->daftar_where(['id_layer' => $id_layer], 'tabel_atribut_layer')->result();

        $where['id_collection'] = $id_collection;
        $data_collection = [
            'koordinat' => $this->input->post('coordinates'),
            'add_by' => $this->session->userdata('id'),
            'name' => @$this->input->post('name') ? $this->input->post('name') : null,
            'group' => @$this->input->post('group') ? $this->input->post('group') : null,
            'stroke' => @$this->input->post('stroke') ? $this->input->post('stroke') : null,
            'stroke_opacity' => @$this->input->post('stroke_opacity') ? $this->input->post('stroke_opacity') : null,
            'stroke_width' => @$this->input->post('stroke_width') ? $this->input->post('stroke_width') : null,
            'stroke_dash' => @$this->input->post('stroke_dash') ? $this->input->post('stroke_dash') : null,
            'fill' => @$this->input->post('fill') ? $this->input->post('fill') : null,
            'fill_opacity' => @$this->input->post('fill_opacity') ? $this->input->post('fill_opacity') : null,
            'icon_name' => @$this->input->post('icon_name') ? $this->input->post('icon_name') : null,
            'page_detail' => @$this->input->post('page_detail') ? 1 : 0
        ];

        $this->peta->ubah($data_collection, 'tabel_collection', $where);

        foreach ($field as $row) {

            $id_atribut = $this->input->post("id_atribut_" . $row->slug);
            $value = $this->input->post($row->slug);
            $where['id_collection'] = $id_collection;
            $where['id_atribut'] = $id_atribut;
            $data = array(
                'data_value' => $value,
                'add_by' => $this->session->userdata('id'),
            );

            //check id attribute value is exist
            $check_attr = $this->db->where($where)->get('tabel_value_attribut')->row_array();

            if (count($check_attr) > 0) {
                // update
                $this->peta->ubah($data, 'tabel_value_attribut', $where);
            } else {
                //insert
                $data['id_collection'] = $id_collection;
                $data['id_atribut'] = $id_atribut;
                $this->crud->tambah($data, 'tabel_value_attribut');
            }
        }
        echo json_encode($field);
    }

    public function play()
    {
        $this->load->view('admin/peta/play');
    }

    public function generate_json()
    {
        $q = "
        SELECT
        l.id_layer,
        v.id_atribut,
        v.id_collection,
        v.data_value,
        a.nama_atribut,
        l.nama_layer,
        c.tipe_layer,
        c.koordinat
        FROM tabel_value_attribut v
        INNER JOIN tabel_atribut_layer a ON a.id_atribut = v.id_atribut
        INNER JOIN tabel_layer l ON l.id_layer = a.id_layer
        INNER JOIN tabel_collection c ON c.id_collection = v.id_collection
        WHERE 1 = 1
        AND l.id_layer = 1";


        $query = $this->db->query($q)->result_array();

        $features = array();
        foreach ($query as $key => $val) {
            $features[$val['id_collection']]['id_layer'] = $val['id_layer'];
            $features[$val['id_collection']]['id_collection'] = $val['id_collection'];
            $features[$val['id_collection']][$val['nama_atribut']] = $val['data_value'];
            $features[$val['id_collection']]['nama_layer'] = $val['nama_layer'];
            $features[$val['id_collection']]['tipe_layer'] = $val['tipe_layer'];
            $features[$val['id_collection']]['koordinat'] = $val['koordinat'];
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
                        $geometry['coordinates'] = $c->coordinates;
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
        echo '<pre>';
        echo json_encode($geojson, JSON_PRETTY_PRINT);
        echo '</pre>';
    }

    public function get_data_layer()
    {
        $q = "
        SELECT
        l.id_layer,
        v.id_atribut,
        v.id_collection,
        v.data_value,
        a.nama_atribut,
        l.nama_layer,
        l.is_perbaikan,
        c.tipe_layer,
        c.koordinat
        FROM tabel_value_attribut v
        INNER JOIN tabel_atribut_layer a ON a.id_atribut = v.id_atribut
        INNER JOIN tabel_layer l ON l.id_layer = a.id_layer
        INNER JOIN tabel_collection c ON c.id_collection = v.id_collection
        WHERE 1 = 1
        AND l.id_layer = " . $this->uri->segment(4);


        $query = $this->db->query($q)->result_array();

        $features = array();
        $respon['data'] = array();
        foreach ($query as $key => $val) {
            $features[$val['id_collection']]['id_layer'] = $val['id_layer'];
            $features[$val['id_collection']]['is_perbaikan'] = $val['is_perbaikan'];
            $features[$val['id_collection']]['id_collection'] = $val['id_collection'];
            $features[$val['id_collection']]['nama_layer'] = $val['nama_layer'];
            $features[$val['id_collection']]['tipe_layer'] = $val['tipe_layer'];
            $features[$val['id_collection']]['koordinat'] = $val['koordinat'];
            $features[$val['id_collection']][$val['nama_atribut']] = $val['data_value'];
        }

        foreach ($features as $key => $val) {
            $respon['data'][] = $val;
        }

        $respon['data_jumlah_attribute'] = $this->db->where('id_layer', $this->uri->segment(4))->get('tabel_atribut_layer')->result_array();

        // echo '<pre>';
        echo json_encode($respon);
        // echo '</pre>';

    }

    public function import_data_peta()
    {
        if ($_FILES['import_geojson']['name'] != '' && $this->input->post('id_layer') > 0) {
            $path = $_FILES['import_geojson']['name'];
            $ext =  pathinfo($path, PATHINFO_EXTENSION);
            if ($ext == 'json') {
                $tmp_name = $this->input->post('id_layer') . '_' . time();
                $conf = array(
                    'upload_path'   => 'assets_front/geojson_tmp',
                    'file_name' => $tmp_name,
                    'max_size' => '134217728',
                    'allowed_types' => '*'
                );
                $this->upload->initialize($conf);
                if (!$this->upload->do_upload('import_geojson')) {
                    $res['status'] = 'error';
                    $res['message'] = $this->upload->display_errors();
                } else {
                    $geojson_tmp = file_get_contents($conf['upload_path'] . '/' . $tmp_name . '.' . $ext);
                    //feature collections
                    $fc = json_decode($geojson_tmp, TRUE);

                    foreach ($fc['features'] as $f) {
                        //insert collection
                        $id_collection = $this->peta->id_collection() + 1;

                        //insert attribute layer
                        $a['id_collection'] = $id_collection;
                        $a['id_layer'] = $this->input->post('id_layer');
                        $a['tipe_layer'] = $f['geometry']['type'];
                        $a['koordinat'] = json_encode($f['geometry']['coordinates']);
                        $a['stroke'] = @$f['properties']['stroke'] ? $f['properties']['stroke'] : null;
                        $a['stroke_opacity'] = @$f['properties']['stroke_opacity'] ? str_replace(',', '.', $f['properties']['stroke_opacity']) : null;
                        $a['stroke_dash'] = @$f['properties']['stroke_dash'] ? str_replace(',', '.', $f['properties']['stroke_dash']) : null; 
                        $a['stroke_width'] = @$f['properties']['stroke_width'] ? $f['properties']['stroke_width'] : null;
                        $a['fill'] = @$f['properties']['fill'] ? $f['properties']['fill'] : null;
                        $a['fill_opacity'] = @$f['properties']['fill_opacity'] ? str_replace(',', '.', $f['properties']['fill_opacity']) : null;
                        $a['icon_name'] = @$f['properties']['icon_name'] ? $f['properties']['icon_name'] : null;
                        $a['name'] = @$f['properties']['name'] ? $f['properties']['name'] : null;
                        $a['group'] = @$f['properties']['group'] ? $f['properties']['group'] : null;
                        $a['created'] = date('Y-m-d H:i:s');
                        $a['edited'] = date('Y-m-d H:i:s');
                        $a['add_by'] = $this->session->userdata('id');

                        $this->db->insert('tabel_collection', $a);
                        if ($this->db->affected_rows() > 0) {
                            //get layer attribute
                            $la = $this->db->where('id_layer', $this->input->post('id_layer'))->get('tabel_atribut_layer')->result_array();

                            foreach ($la as $x) {
                                $b['id_atribut'] = $x['id_atribut'];
                                $b['id_collection'] = $id_collection;
                                $b['data_value'] = @$f['properties'][$x['nama_atribut']];
                                $b['created'] = date('Y-m-d H:i:s');
                                $b['edited'] = date('Y-m-d H:i:s');
                                $b['add_by'] = $this->session->userdata('id');
                                $this->db->insert('tabel_value_attribut', $b);
                            }
                        }
                    }

                    // remove tmp file
                    unlink($conf['upload_path'] . '/' . $tmp_name . '.' . $ext);

                    $res['status'] = 'success';
                }
            } else {
                $res['status'] = 'error';
                $res['message'] = 'Format file import harus berupa .json';
            }
        }

        echo json_encode($res);
    }

    public function import_template()
    {

        //get layer attribute
        $la = $this->db->where('id_layer', $this->input->post('id_layer'))->get('tabel_atribut_layer')->result_array();

        $geo['type'] = 'FeatureCollection';
        $geo['features'] = [];
        $geo['features'][0]['type'] = 'Feature';
        $geo['features'][0]['properties']['name'] = 'Nama Feature';
        $geo['features'][0]['properties']['group'] = null;
        foreach ($la as $x) {
            $geo['features'][0]['properties'][$x['nama_atribut']] = 'isi ' . $x['nama_atribut'];
        }
        $geo['features'][0]['properties']['stroke'] = '#000000';
        $geo['features'][0]['properties']['stroke_opacity'] = 1;
        $geo['features'][0]['properties']['stroke_width'] = 2;
        $geo['features'][0]['properties']['fill'] = '#777777';
        $geo['features'][0]['properties']['fill_opacity'] = 0.2;
        $geo['features'][0]['properties']['icon_name'] = null;

        $geo['features'][0]['geometry']['type'] = 'Polygon';
        $geo['features'][0]['geometry']['coordinates'] = [[
            [110.82824680175781, -7.568517689091984],
            [110.82824680175781, -7.571517689091984],
            [110.83024680175781, -7.571517689091984],
            [110.83024680175781, -7.568517689091984],
            [110.82824680175781, -7.568517689091984]
        ]];

        echo json_encode($geo, JSON_PRETTY_PRINT);
    }


    // Untuk keperluan foto 
    // author Geogeoge
    public function upload_foto()
    {
        // upload site plan
        if ($_FILES['file_upload']) {
            $id_collection = $this->input->post("id_collection");

            // Menconfig folder jika ada atau tidak ada
            $path_foto = "./assets/uploads/foto_collection/" . $id_collection;
            if (!is_dir($path_foto)) {
                mkdir($path_foto, 0777, true);
            }

            // upload config
            $config = array(
                'upload_path'   => $path_foto,
                'allowed_types' => 'gif|jpg|png|jpeg|jfif|pdf'
            );

            // $this->upload->initialize($conf);
            $this->load->library('upload', $config);

            $this->upload->initialize($config);

            if ($this->upload->do_upload('file_upload')) {
                $file = $this->upload->data('file_name');

                $data = array(
                    'id_collection' => $id_collection,
                    'file' => $file,
                );
                $proses = $this->db->insert("tabel_foto_collection", $data);
            } else {
                $proses = array('error' => $this->upload->display_errors());
            }

            echo json_encode($proses);
        } else {
            $proses = '';
        }
    }

    public function ambil_foto()
    {
        $id_collection = $this->input->get('id_collection');
        $data = $this->db->where('id_collection', $id_collection)->get('tabel_foto_collection')->result_array();
        echo json_encode($data);
    }

    public function do_delete()
    {
        $id = $this->input->post("id");
        $id_collection = $this->input->post("id_collection");

        $data = $this->db->where('id', $id)->get('tabel_foto_collection')->row_array();

        $path = "./assets/uploads/foto_collection/" . $id_collection . "/";
        if (is_dir($path)) {
            unlink($path . $data['file']);
        }

        $proses = $this->db->where('id', $id)->delete('tabel_foto_collection');

        echo json_encode($path);
    }

    // Untuk keperluan diskripsi
    public function insert_diskripsi()
    {
        $id_collection = $this->input->post('id_collection');
        $nama = $this->input->post('nama');
        $website = $this->input->post('website');
        $deskripsi = $this->input->post('deskripsi');

        $where = array('id_collection' => $id_collection);


        $data_diskripsi = $this->db->where($where)->get('tabel_diskripsi_collection')->row_array();
        if ($data_diskripsi) {
            $data = array(
                'nama' => $nama,
                'website' => $website,
                'deskripsi' => $deskripsi,
            );
            $proses = $this->db->where($where)->update('tabel_diskripsi_collection', $data);
        } else {
            $data = array(
                'id_collection' => $id_collection,
                'nama' => $nama,
                'website' => $website,
                'deskripsi' => $deskripsi,
            );
            $proses = $this->db->insert("tabel_diskripsi_collection", $data);
        }

        echo json_encode($proses);
    }

    public function ambil_diskripsi()
    {
        $id_collection = $this->input->get('id_collection');
        $data = $this->db->where('id_collection', $id_collection)->get('tabel_diskripsi_collection')->row_array();
        echo json_encode($data);
    }

    public function diskripsi($id, $id_collection)
    {
        $data_js = [
            'id' => $id,
            'id_collection' => $id_collection,
        ];
        $data = [
            'id' => $id,
            'id_collection' => $id_collection,
            'isi' => "$this->base/peta/diskripsi/index",
            'extra_js' => $this->load->view("$this->base/peta/diskripsi/index_js", $data_js, true),
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);
    }

    // Grup Layer

    public function get_grup_layer()
    {
        $res['data'] = $this->db->get('tabel_grup_layer')->result_array();

        echo json_encode($res);
    }

    public function simpan_grup_layer()
    {
        $res = [];
        $a = array(
            'nama_grup_layer' => $this->input->post('nama_grup_layer'),
            'id_user' => $this->session->userdata('id'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        );
        $this->db->insert('tabel_grup_layer', $a);
        if ($this->db->affected_rows() > 0) {
            $res['data'] = $this->db->get('tabel_grup_layer')->result_array();
        }
        echo json_encode($res);
    }

    public function edit_grup_layer()
    {
        $res = [];
        $a = array(
            'nama_grup_layer' => $this->input->post('nama_grup_layer'),
            'id_user' => $this->session->userdata('id'),
            'updated_at' => date('Y-m-d H:i:s')
        );
        $w = array(
            'id_grup_layer' => $this->input->post('id_grup_layer')
        );
        $this->db->where($w)->update('tabel_grup_layer', $a);
        if ($this->db->affected_rows() > 0) {
            $res['status'] = 'success';
        } else {
            $res['status'] = 'error';
        }
        echo json_encode($res);
    }

    public function hapus_grup_layer()
    {
        $res = [];

        if ($this->input->post('id_grup_layer') > 0) {
            // check layers which linked to the group
            $q = "select count(id_layer) total_layer from tabel_layer where id_grup_layer = {$this->input->post('id_grup_layer')}";
            $r = $this->db->query($q)->row_array();

            if ($r['total_layer'] > 0) {
                $res['status'] = 'error';
                $res['message'] = 'Grup layer ini tidak bisa dihapus, karena terdapat ' . $r['total_layer'] . ' layer yang tergabung dalam grup ini. Silahkan hapus layer terlebih dahulu.';
            } else {
                $w = array(
                    'id_grup_layer' => $this->input->post('id_grup_layer')
                );
                $this->db->where($w)->delete('tabel_grup_layer');
                $res['status'] = 'success';
            }
        } else {
            $res['status'] = 'error';
            $res['message'] = 'Gagal menghapus grup layer!';
        }

        echo json_encode($res);
    }

    // Jenis Peta

    public function get_jenis_peta()
    {
        $res['data'] = $this->db->get('tabel_jenis_peta')->result_array();

        echo json_encode($res);
    }

    public function simpan_jenis_peta()
    {
        $res = [];
        $a = array(
            'nama_jenis_peta' => $this->input->post('nama_jenis_peta'),
            'id_user' => $this->session->userdata('id'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        );
        $this->db->insert('tabel_jenis_peta', $a);
        if ($this->db->affected_rows() > 0) {
            $res['data'] = $this->db->get('tabel_jenis_peta')->result_array();
        }
        echo json_encode($res);
    }

    public function edit_jenis_peta()
    {
        $res = [];
        $a = array(
            'nama_jenis_peta' => $this->input->post('nama_jenis_peta'),
            'id_user' => $this->session->userdata('id'),
            'updated_at' => date('Y-m-d H:i:s')
        );
        $w = array(
            'id_jenis_peta' => $this->input->post('id_jenis_peta')
        );
        $this->db->where($w)->update('tabel_jenis_peta', $a);
        if ($this->db->affected_rows() > 0) {
            $res['status'] = 'success';
        } else {
            $res['status'] = 'error';
        }
        echo json_encode($res);
    }

    public function hapus_jenis_peta()
    {
        $res = [];

        if ($this->input->post('id_jenis_peta') > 0) {
            // check layers which linked to the group
            $q = "select count(id_layer) total_layer from tabel_layer where id_jenis_peta = {$this->input->post('id_jenis_peta')}";
            $r = $this->db->query($q)->row_array();

            if ($r['total_layer'] > 0) {
                $res['status'] = 'error';
                $res['message'] = 'Jenis Peta ini tidak bisa dihapus, karena terdapat ' . $r['total_layer'] . ' layer yang tergabung dalam grup ini. Silahkan hapus layer terlebih dahulu.';
            } else {
                $w = array(
                    'id_jenis_peta' => $this->input->post('id_jenis_peta')
                );
                $this->db->where($w)->delete('tabel_jenis_peta');
                $res['status'] = 'success';
            }
        } else {
            $res['status'] = 'error';
            $res['message'] = 'Gagal menghapus jenis peta!';
        }

        echo json_encode($res);
    }

    public function get_koordinat()
    {
        $id = $this->input->get('id');
        $type = $this->input->get('type');

        if ($id > 0) {
            $koordinat = $this->db
                ->where([
                    'id_koordinat' => $id,
                    'tipe_koordinat' => $type
                ])
                ->get('tabel_referensi_koordinat')->row_array();
            $res['status'] = 'success';
            $res['data'] = $koordinat;
        } else {
            $res['status'] = 'error';
            $res['message'] = 'Telah terjadi kesalahan.';
        }
        echo json_encode($res);
    }

    // GROUP ATTRIBUTE

    function get_group()
    {
        $id_layer = $this->input->post('id_layer');
        $group = $this->db->where('id_layer', $id_layer)->get('tabel_grup_atribut')->result_array();
        $group_order = $this->db->where('id_layer', $id_layer)->get('tabel_layer')->row_array();
        $res['group'] = $group;
        $res['group_order'] = json_decode($group_order['pos_grup_atribut'], true);
        echo json_encode($res);
    }

    function get_layer_attribute()
    {
        $id_layer = $this->input->post('id_layer');
        $attr = $this->db->where('id_layer', $id_layer)->get('tabel_atribut_layer')->result_array();
        $res['attribute'] = $attr;
        $res['group'] = [];
        echo json_encode($res);
    }

    function add_group()
    {
        $id_layer = $this->input->post('id_layer');

        $a = [];
        $a['id_layer'] = $id_layer;
        $a['judul_grup_atribut'] = $this->input->post('judul_grup');
        $a['sub_judul_grup_atribut'] = $this->input->post('sub_judul_grup');
        $a['tipe_grup_atribut'] = $this->input->post('tipe_grup');
        $a['ukuran_grup_atribut'] = $this->input->post('ukuran_grup');
        $a['id_user'] = $this->session->userdata('id');
        $a['created_at'] = date('Y-m-d H:i:s');
        $a['updated_at'] = date('Y-m-d H:i:s');

        $this->db->insert('tabel_grup_atribut', $a);

        if ($this->db->insert_id() > 0) {
            $res['status'] = 'success';
            $res['data'] = [
                'id' => $this->db->insert_id(),
                'judul' => $this->input->post('judul_grup') == '' ? 'Judul ' . $this->db->insert_id() : $this->input->post('judul_grup')
            ];
        } else {
            $res['status'] = 'error';
            $res['message'] = 'Gagal menambah Grup';
        }
        echo json_encode($res);
    }

    function edit_group()
    {
        $id = $this->input->post('id_group');
        $a = [];
        $a['judul_grup_atribut'] = $this->input->post('judul_grup');
        $a['sub_judul_grup_atribut'] = $this->input->post('sub_judul_grup');
        $a['tipe_grup_atribut'] = $this->input->post('tipe_grup');
        $a['ukuran_grup_atribut'] = $this->input->post('ukuran_grup');
        $a['id_user'] = $this->session->userdata('id');

        $this->db->where('id_grup_atribut', $id)->update('tabel_grup_atribut', $a);

        if ($this->db->affected_rows() > 0) {
            $res['status'] = 'success';
            $res['data'] = [
                'id' => $id,
                'judul' => $this->input->post('judul_grup') == '' ? 'Judul ' . $this->db->insert_id() : $this->input->post('judul_grup')
            ];
        } else {
            $res['status'] = 'error';
            $res['message'] = 'Gagal mengubah Grup';
        }
        echo json_encode($res);
    }

    function delete_group()
    {
        $id = $this->input->post('id');
        //TODO: hapus grup beserta itemnya
        $this->db->where('id_grup_atribut', $id)->delete('tabel_grup_atribut');
        $cek = $this->db->where('id_grup_atribut', $id)->get('tabel_grup_atribut')->num_rows();
        if ($cek > 0) {
            $res['status'] = 'error';
            $res['message'] = 'Grup gagal dihapus';
        } else {
            $res['status'] = 'success';
        }
        echo json_encode($res);
    }

    function get_group_detail()
    {
        $id = $this->input->post('id');
        $get = $this->db->where('id_grup_atribut', $id)->get('tabel_grup_atribut')->row_array();
        if (count($get) > 0) {
            $res['status'] = 'success';
            $res['data'] = $get;
        } else {
            $res['status'] = 'error';
            $res['message'] = 'Data tidak ditemukan';
        }
        echo json_encode($res);
    }

    function get_group_items()
    {
        $id = $this->input->post('id');

        $item_order = $this->db->where('id_grup_atribut', $id)->get('tabel_grup_atribut')->row_array();
        $res['item_order'] = json_decode($item_order['pos_grup_atribut_item'], true);

        $get = $this->db
            ->select(
                't1.id_grup_atribut,
                t2.id_atribut,
                t2.id_layer,
                t2.nama_atribut,
                t2.slug,
                t2.tipe_data,
                t3.id_grup_atribut_item,
                t3.nama_atribut_layer,
                t3.alias_atribut_layer'
            )
            ->where('t1.id_grup_atribut', $id)
            ->join('tabel_atribut_layer t2', 't2.id_layer = t1.id_layer', 'INNER')
            ->join('tabel_grup_atribut_item t3', 't3.id_atribut = t2.id_atribut AND t3.id_grup_atribut = t1.id_grup_atribut', 'LEFT')
            ->get('tabel_grup_atribut t1')
            ->result_array();

        if (count($get) > 0) {
            $res['status'] = 'success';
            $res['data'] = $get;
        } else {
            $res['status'] = 'error';
            $res['message'] = 'Data tidak ditemukan';
        }

        echo json_encode($res);
    }

    function add_group_item()
    {
        $a = [];
        $a['id_atribut'] = $this->input->post('id_atribut');
        $a['id_grup_atribut'] = $this->input->post('id_grup_atribut');
        $a['nama_atribut_layer'] = $this->input->post('nama_atribut');
        $a['user_id'] = $this->session->userdata('id');
        $a['created_at'] = date('Y-m-d H:i:s');
        $a['updated_at'] = date('Y-m-d H:i:s');

        $this->db->insert('tabel_grup_atribut_item', $a);
        $id_item = $this->db->insert_id();

        if ($this->db->affected_rows() > 0) {
            $res['status'] = 'success';
            $res['data']['id_item'] = $id_item;
            $res['data']['id_grup_atribut'] = $this->input->post('id_grup_atribut');
            $res['data']['nama_atribut'] = $this->input->post('nama_atribut');
        } else {
            $res['status'] = 'error';
            $res['message'] = 'Gagal menambahkan grup item';
        }

        echo json_encode($res);
    }

    function delete_group_item()
    {
        $id = $this->input->post('id_item');
        $this->db->where('id_grup_atribut_item', $id)->delete('tabel_grup_atribut_item');
        $res['status'] = 'success';
        echo json_encode($res);
    }

    function rename_group_item()
    {
        $id = $this->input->post('id_item');
        $a['alias_atribut_layer'] = $this->input->post('alias');
        $this->db->where('id_grup_atribut_item', $id)->update('tabel_grup_atribut_item', $a);
        if ($this->db->affected_rows() > 0) {
            $res['status'] = 'success';
        } else {
            $res['status'] = 'error';
            $res['message'] = 'Alias gagal diubah';
        }
        echo json_encode($res);
    }

    function update_pos_group()
    {
        $id_layer = $this->input->post('id_layer');
        parse_str($this->input->post('data'), $data);

        $a = [];
        $a['pos_grup_atribut'] = json_encode($data);

        $this->db->where('id_layer', $id_layer)->update('tabel_layer', $a);

        $res['status'] = 'success';
        echo json_encode($res);
    }

    function update_pos_group_item()
    {
        $id_group = $this->input->post('id_group');
        parse_str($this->input->post('data'), $data);

        $a = [];
        $a['pos_grup_atribut_item'] = json_encode($data);

        $this->db->where('id_grup_atribut', $id_group)->update('tabel_grup_atribut', $a);

        $res['status'] = 'success';
        echo json_encode($res);
    }

    function ref_koordinat()
    {
        $tipe = $this->input->get('type');
        $search = $this->input->get('search');

        $data = [];
        $data['results'] = $this->db
            ->select('
                id_koordinat as id,
                nama_koordinat as text
            ')
            ->where('tipe_koordinat', $tipe)->where("(id_opd=0 OR id_opd={$this->session->userdata('id_opd')})")->LIKE('nama_koordinat', $search)->limit(10)->get('tabel_referensi_koordinat')->result_array();

        echo json_encode($data);
    }

    public function download_geojson($id = null, $name = null)
    {
        $name .= '.geojson';

        $url = base_url('peta/get_geojson/db/' . $id);
        $data = file_get_contents($url);

        header("Content-Type: text/plain");
        header("Content-Disposition:attachement;filename=$name");
        echo $data;
    }

    // ======================
    // perbaikan
    public function data_perbaikan()
    {
        $id = $this->uri->segment(4);
        $attribut = $this->db->where('id_collection', $id)->get('tabel_collection')->row_array();
        $value_attribut = $this->db->where('id_collection', $id)->limit('1')->get('tabel_value_attribut')->row_array();

        $data_js = ['id' => $id];
        $data = [
            'id' => $id,
            'value_attribut' => $value_attribut,
            'attribut' => $attribut,
            'isi' => "$this->base/peta/data_perbaikan",
            'extra_js' => $this->load->view("$this->base/peta/data_perbaikan_js", $data_js, true),
            'header' => $this->peta->header_data_peta($id),
            'data_peta' => $this->crud->daftar_where(['id_layer' => $id], 'tabel_layer')->result()
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);
    }

    public function daftar_layer_perbaikan($id_data=null)
    {
        $list = $this->peta->get_datatables_perbaikan($id_data);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++; 

            $row = array();
            $row[] = $no;
            $row[] = $field->tahun;
            $row[] = $field->paket_pekerjaan.'<br>Anggaran : '.$field->anggaran; 
            $row[] = $field->lokasi;
            $row[] = $field->pelaksana.'<br>No Kontrak : '.$field->no_kontrak;
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

    function switch_notif()
    {
        $id = $this->input->post('id');
        $value = $this->input->post('value');

        $cek = $this->db->where(['id_layer' => $id])->get('tabel_layer')->row();

        $status = false;
        if (!empty($cek)) {
            $this->db->where(['id_layer' => $cek->id_layer])->update('tabel_layer', ['is_perbaikan' => $value]);
            if ($this->db->affected_rows() > 0) {
                $status = true; 
            }
        }
        echo json_encode(array('status' => $status));
    }

    function detail_perbaikan($id_perbaikan)
    {
        $cek = $this->db->where(['id_perbaikan' => $id_perbaikan])->get('tabel_perbaikan')->row();

        $status = false;
        if (!empty($cek)) {
            $status = true; 
        }
        echo json_encode(array('status' => $status,'data' => $cek));
    }

    function store_perbaikan() {
        // print_r($this->input->post()); exit();
        $id =$this->input->post('id');

        $id_data = $this->input->post('id_data'); 
        $id_perbaikan = $this->input->post('perb$id_perbaikan'); 
        $tahun = $this->input->post('tahun'); 
        $lokasi = $this->input->post('lokasi'); 
        $paket_pekerjaan = $this->input->post('paket_pekerjaan'); 
        $anggaran = $this->input->post('anggaran'); 
        $pelaksana = $this->input->post('pelaksana'); 
        $no_kontrak = $this->input->post('no_kontrak'); 
        $tgl_kontrak = $this->input->post('tgl_kontrak'); 
        $jangka_waktu = $this->input->post('jangka_waktu'); 
        $tgl_mulai = $this->input->post('tgl_mulai'); 
        $tgl_selesai = $this->input->post('tgl_selesai'); 
        $realisasi = $this->input->post('realisasi'); 
    
        $status = ""; $json = array(); $data = array();

        $this->form_validation->set_rules('lokasi', 'lokasi ', 'required'); 
        $this->form_validation->set_rules('tahun', 'tahun ', 'required'); 
        $this->form_validation->set_rules('paket_pekerjaan', 'paket_pekerjaan ', 'required'); 
        $this->form_validation->set_rules('anggaran', 'anggaran ', 'required'); 
        $this->form_validation->set_rules('pelaksana', 'pelaksana ', 'required'); 
        $this->form_validation->set_rules('no_kontrak', 'no_kontrak ', 'required'); 
        $this->form_validation->set_rules('tgl_kontrak', 'tgl_kontrak ', 'required'); 
        $this->form_validation->set_rules('jangka_waktu', 'jangka_waktu ', 'required'); 
        $this->form_validation->set_rules('tgl_mulai', 'tgl_mulai ', 'required'); 
        $this->form_validation->set_rules('tgl_selesai', 'tgl_selesai ', 'required'); 
        $this->form_validation->set_rules('realisasi', 'realisasi ', 'required'); 
        if ($this->form_validation->run() == FALSE) {
            $json = array(
                'status' => false,
                'csrf' => generate_csrf()
            );
            $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($json)); 
        } else{

            if (empty($id_perbaikan)) {
                $data = [ 
                    'id_data' => $id_data, 
                    'lokasi' => $lokasi, 
                    'tahun' => $tahun, 
                    'paket_pekerjaan' => $paket_pekerjaan, 
                    'anggaran' => $anggaran, 
                    'pelaksana' => $pelaksana, 
                    'no_kontrak' => $no_kontrak, 
                    'tgl_kontrak' => $tgl_kontrak, 
                    'jangka_waktu' => $jangka_waktu, 
                    'tgl_mulai' => $tgl_mulai, 
                    'tgl_selesai' => $tgl_selesai, 
                    'realisasi' => $realisasi, 

                    'is_active' => '1', 

                    'created_at' => date("Y-m-d H:i:s"),
                    'created_by' => $this->session->userdata('user_id'),
                ]; 
                $this->db->insert('tabel_perbaikan', $data); 
                // echo json_encode($data);
            } else {
                $data = [
                    'id_data' => $id_data, 
                    'lokasi' => $lokasi, 
                    'tahun' => $tahun, 
                    'paket_pekerjaan' => $paket_pekerjaan, 
                    'anggaran' => $anggaran, 
                    'pelaksana' => $pelaksana, 
                    'no_kontrak' => $no_kontrak, 
                    'tgl_kontrak' => $tgl_kontrak, 
                    'jangka_waktu' => $jangka_waktu, 
                    'tgl_mulai' => $tgl_mulai, 
                    'tgl_selesai' => $tgl_selesai, 
                    'realisasi' => $realisasi, 

                    'updated_at' => date("Y-m-d H:i:s"),
                    'updated_by' => $this->session->userdata('user_id'),
                ];
                // echo json_encode($data);
                $this->db->where('id_perbaikan',$id_perbaikan)->update('tabel_perbaikan', $data); 
            }
            echo json_encode(array('status' => true,'data' => $data,'id_data' => $id_data));
        }
    }

    function hapus_perbaikan($id_perbaikan)
    { 
        $return = "";
        $cek = $this->db->where(['id_perbaikan' => $id_perbaikan])->get('tabel_perbaikan')->row();

        $data = $this->db->where(['id_perbaikan' => $id_perbaikan])->update('tabel_perbaikan',['is_active' => '0','deleted_at' => date('Y-m-d H:i:s'),'deleted_by' => '']); 
        $status = false;  
        if($this->db->affected_rows()>0){
            $status = true;            
        } 
        echo json_encode(array('status' => $status,'id_data' => $cek->id_data));  
    }
}

/* End of file Peta.php */
