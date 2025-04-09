<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    private $base = 'admin';

    function __construct(){
		parent::__construct();
	}

    public function index()
    {
        $data = [
            'isi' => "$this->base/api/index",
            'extra_js' => $this->load->view("$this->base/api/index_js", '', true),
            'data_layer' => $this->db->where('status',1)->get('tabel_layer')->result_array()
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);
    }

    function generateRandomString($length = 8) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}

    public function tambah_permohonan_api()
    {
        $data = array(
            'nama_pemohon' => $this->input->post('nama_pemohon'),
            'akses_layer' => json_encode($this->input->post('akses_layer')),
            'id_user' => $this->session->userdata('id'),
            'id_opd' => $this->session->userdata('id_opd'),
            'token' => $this->generateRandomString(),
            'created_at' => date("Y-m-d H:i:s")
        );

        $this->db->insert('tabel_api',$data);
        if($this->db->affected_rows() > 0)
        {
            $res['status'] = 'success';
        }
        else
        {
            $res['status'] = 'error';
            $res['message'] = 'Gagal menambah permohonan API.';
        }

        echo json_encode($res);
    }
    
    public function get_permohonan_api()
    {
        $res['data'] = $this->db->get('tabel_api')->result_array();
        echo json_encode($res);
    }

    public function hapus_permohonan_api()
    {
        $this->db->where('id_api',$this->input->post('id_api'))->delete('tabel_api');
        $res['status'] = 'success';
        echo json_encode($res);
    }
}

/* End of file Peta.php */


?>