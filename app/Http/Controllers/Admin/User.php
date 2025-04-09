<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct(){
		parent::__construct();		
        $this->load->model('UserModel', 'user');
        if ( ! $this->session->userdata('logged_in')){ 
            redirect('login');
        }
        if($this->session->userdata('role') != 1){
            redirect('login');
        }
    }
    
    public function index()
    {
        $data = [
            'data_opd' => $this->db->get('tabel_referensi_opd')->result_array(),
            'isi' => 'admin/user/list'
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);   
    }

    public function daftar_user()
    {
        $data = $this->user->daftar_user();
        echo json_encode($data);
    }

    public function pencarian_user()
    {
        $hasil = $this->db->select('*');
        $hasil = $this->db->from("user_detail");
        $hasil = $this->db->join("user_login", 'user_detail.id_user = user_login.id_user', 'left');
        $hasil = $this->db->where('user_detail.id_user_detail', $this->input->post('id_user_detail'));
        $hasil = $this->db->get()->row_array();

        echo json_encode($hasil);
    }

    public function simpan(){
        //proses input di tabel user login
        $data = array(
                    'user_name' => $this->input->post('tambah_username'),
                    'user_pass' => md5($this->input->post('tambah_password')),
                );
        $proses_input_user_login = $this->db->insert('user_login', $data);

        //proses mencari di terakhir saat input
        $id_user_login_terakhir = $this->db->order_by('id_user', 'desc')->limit(1)->get('user_login')->row_array();

        //proses input di tabel user detail
        $data = array(
                    'id_user' => $id_user_login_terakhir['id_user'],
                    'nama' => $this->input->post('tambah_nama'),
                    'role' => $this->input->post('tambah_role'),
                    'id_opd' => $this->input->post('tambah_id_opd'),
                );
        $proses_input_user_detail = $this->db->insert('user_detail', $data);

        echo json_encode($proses_input_user_detail);
    }

    public function edit(){
        //proses edit di tabel user detail
        $where = array('id_user_detail' => $this->input->post('edit_id_user_detail'));
        $data = array(
                    'nama' => $this->input->post('edit_nama'),
                    'role' => $this->input->post('edit_role'),
                    'id_opd' => $this->input->post('edit_id_opd'),
                );
        $proses_edit_user_detail = $this->user->edit($data, $where, 'user_detail');

        echo json_encode($proses_edit_user_detail);
    }

    public function ganti_password(){
        //proses edit di tabel user login
        $where = array('id_user' => $this->input->post('ganti_id_user'));
        $data = array(
                    'user_name' => $this->input->post('ganti_username'),
                    'user_pass' => md5($this->input->post('ganti_password')),
                );
        $proses_edit_user_login = $this->user->edit($data, $where, 'user_login');

        echo json_encode($proses_edit_user_login);
    }

    public function hapus(){
        // hapus untuk user login
        $where = array('id_user' => $this->input->post('id_user'));
        $proses_hapus_user_login = $this->user->hapus($where, 'user_login');

        // hapus untuk user detail
        $where = array('id_user_detail' => $this->input->post('id_user_detail'));
        $proses_hapus_user_detail = $this->user->hapus($where, 'user_detail');

        echo json_encode($proses_hapus_user_detail);
    }

}

/* End of file User.php */


?>