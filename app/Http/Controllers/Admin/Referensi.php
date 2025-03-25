<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Referensi extends CI_Controller {
    private $base = 'admin';
    function __construct(){
        parent::__construct();		
        $this->load->library('upload');
        $this->load->model('ReferensiModel', 'referensi');
        if ( ! $this->session->userdata('logged_in')){ 
            redirect('login');
        }
        if($this->session->userdata('role') != 1){
            redirect('login');
        }
    }
    
    public function index()
    {
        $this->opd();
    }

    public function opd()
    {
        $data = [
            'isi' => "$this->base/referensi/opd",
            'extra_js' => $this->load->view("$this->base/referensi/opd_js", '', true),
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);   
    }

    public function form_opd()
    {
        $data = '';
        $id = $this->input->post('id_opd');
        if($id == ""){
            $data = array(
                'nama_opd' => $this->input->post('nama_opd'),
                'add_by' => $this->session->userdata('id'),
            );
            $data = $this->referensi->tambah($data,'tabel_referensi_opd');
        }else{
            $where = array('id_opd' => $id);
            $data_opd = [
                'nama_opd' => $this->input->post('nama_opd'),
                'edit_by' => $this->session->userdata('id'),
            ];
            $data = $this->referensi->ubah($data_opd, 'tabel_referensi_opd', $where);        
        }
        echo json_encode($data);
    }

    public function get_opd()
    {
        $id = $this->input->get('id');
        $data = $this->referensi->get_opd($id);
        echo json_encode($data);
    }

    public function daftar_opd()
    {
        $data=$this->referensi->daftar_opd();
        echo json_encode($data);
    }

    public function hapus_opd()
    {
        $id = $this->input->post('id');
        $data = $this->referensi->hapus_opd($id);
        echo json_encode($data);
    }

    // Referensi RPR
    public function rpr()
    {
        $data = [
            'isi' => "$this->base/referensi/rpr",
            'extra_js' => $this->load->view("$this->base/referensi/rpr_js", '', true),
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);
        
    }

    public function form_rpr()
    {
        $data = '';
        $id = $this->input->post('id_rpr');
        if($id == ""){
            $data = array(
                'nama_rpr' => $this->input->post('nama_rpr'),
                'add_by' => $this->session->userdata('id'),
            );
            $data = $this->referensi->tambah($data,'tabel_referensi_rpr');
        }else{
            $where = array('id_rpr' => $id);
            $data_rpr = [
                'nama_rpr' => $this->input->post('nama_rpr'),
                'edit_by' => $this->session->userdata('id'),
            ];
            $data = $this->referensi->ubah($data_rpr, 'tabel_referensi_rpr', $where);        
        }
        echo json_encode($data);
    }

    public function get_rpr()
    {
        $id = $this->input->get('id');
        $data = $this->referensi->get_rpr($id);
        echo json_encode($data);
    }

    public function daftar_rpr()
    {
        $data=$this->referensi->daftar_rpr();
        echo json_encode($data);
    }

    public function hapus_rpr()
    {
        $id = $this->input->post('id');
        $data = $this->referensi->hapus_rpr($id);
        echo json_encode($data);
    }

    // Referensi Status Tanah
    public function st()
    {
        $data = [
            'isi' => "$this->base/referensi/st",
            'extra_js' => $this->load->view("$this->base/referensi/st_js", '', true),
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);
        
    }

    public function form_st()
    {
        $data = '';
        $id = $this->input->post('id_st');
        if($id == ""){
            $data = array(
                'nama_st' => $this->input->post('nama_st'),
                'add_by' => $this->session->userdata('id'),
            );
            $data = $this->referensi->tambah($data,'tabel_referensi_st');
        }else{
            $where = array('id_st' => $id);
            $data_st = [
                'nama_st' => $this->input->post('nama_st'),
                'edit_by' => $this->session->userdata('id'),
            ];
            $data = $this->referensi->ubah($data_st, 'tabel_referensi_st', $where);        
        }
        echo json_encode($data);
    }

    public function get_st()
    {
        $id = $this->input->get('id');
        $data = $this->referensi->get_st($id);
        echo json_encode($data);
    }

    public function daftar_st()
    {
        $data=$this->referensi->daftar_st();
        echo json_encode($data);
    }

    public function hapus_st()
    {
        $id = $this->input->post('id');
        $data = $this->referensi->hapus_st($id);
        echo json_encode($data);
    }



    // Referensi Rencana Pola Ruang
    public function rencana_pola_ruang()
    {
        $data = [
            'isi' => "$this->base/referensi/rencana_pola_ruang",
            'extra_js' => $this->load->view("$this->base/referensi/rencana_pola_ruang_js", '', true),
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);
        
    }

    public function form_rencana_pola_ruang()
    {
        $data = '';
        $id = $this->input->post('id');
        if($id == ""){
            $data = array(
                'nama_rencana_pola_ruang' => $this->input->post('nama_rencana_pola_ruang'),
                'add_by' => $this->session->userdata('id'),
            );
            $data = $this->referensi->tambah($data,'tabel_referensi_rencana_pola_ruang');
        }else{
            $where = array('id' => $id);
            $data_st = [
                'nama_rencana_pola_ruang' => $this->input->post('nama_rencana_pola_ruang'),
                'edit_by' => $this->session->userdata('id'),
            ];
            $data = $this->referensi->ubah($data_st, 'tabel_referensi_rencana_pola_ruang', $where);        
        }
        echo json_encode($data);
    }

    public function get_rencana_pola_ruang()
    {
        $id = $this->input->get('id');
        $data = $this->referensi->get_rencana_pola_ruang($id);
        echo json_encode($data);
    }

    public function daftar_rencana_pola_ruang()
    {
        $data=$this->referensi->daftar_rencana_pola_ruang();
        echo json_encode($data);
    }

    public function hapus_rencana_pola_ruang()
    {
        $id = $this->input->post('id');
        $data = $this->referensi->hapus_rencana_pola_ruang($id);
        echo json_encode($data);
    }

    // Referensi Map Marker Icon

    public function icon()
    {
        $data = [
            'isi' => "$this->base/referensi/icon",
            'extra_js' => $this->load->view("$this->base/referensi/icon_js", '', true),
            'data_opd' => $this->db->get('tabel_referensi_opd')->result_array()
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);   
    }

    public function form_icon()
    {
        $conf = array(
            'upload_path'   => 'assets/uploads/marker_icon',
            'file_name' => $this->input->post('nama_icon'),
            'allowed_types' => 'png'
        );
        $this->upload->initialize($conf);
        $data = '';
        $id = $this->input->post('id_icon');
        if($id == ""){
            $data = array(
                'nama_icon' => $this->input->post('nama_icon'),
                'id_opd' => $this->input->post('id_opd'),
                'add_by' => $this->session->userdata('id'),
            );
            if(!$this->upload->do_upload('file_icon'))
            {
                $res['status'] = 'error';
                $res['message'] = $this->upload->display_errors();
            }
            else
            {
                $res['status'] = 'success';
                $res['data'] = $this->referensi->tambah($data,'tabel_referensi_icon');
            }
            
        }else{
            $where = array('id_icon' => $id);
            $data_icon = [
                'nama_icon' => $this->input->post('nama_icon'),
                'id_opd' => $this->input->post('id_opd'),
                'edit_by' => $this->session->userdata('id'),
            ];
            if($_FILES['file_icon']['name'] != '')
            {
                if(unlink($conf['upload_path'].'/'.$this->input->post('nama_icon').'.png'))
                {
                    if(!$this->upload->do_upload('file_icon'))
                    {
                        
                        $res['status'] = 'error';
                        $res['message'] = $this->upload->display_errors();
                    }
                    else
                    {
                        $res['status'] = 'success';
                        $res['data'] = $this->referensi->ubah($data_icon, 'tabel_referensi_icon', $where); 
                    }
                }
                else
                {
                    $res['status'] = 'error';
                    $res['message'] = 'gagal hapus file lama.';
                }
                
            }
            else
            {
                if(file_exists('assets/uploads/marker_icon/'.$this->input->post('nama_icon').'.png'))
                {
                    $old_name = $this->db->where('id_icon',$id)->get('tabel_referensi_icon')->row_array()['nama_icon'];
                    if(count($old_name) > 0 && $this->input->post('nama_icon') == $old_name)
                    {
                        $res['status'] = 'success';
                    }
                    else
                    {
                        $res['status'] = 'error';
                        $res['message'] = 'gagal rename file, nama file baru sudah dipakai.';
                    }
                    
                }
                else
                {
                    $old_name = $this->db->where('id_icon',$id)->get('tabel_referensi_icon')->row_array()['nama_icon'];
                    if(count($old_name) > 0)
                    {
                        rename('assets/uploads/marker_icon/'.$old_name.'.png', 'assets/uploads/marker_icon/'.$this->input->post('nama_icon').'.png');
                        $res['status'] = 'success';
                        $res['data'] = $this->referensi->ubah($data_icon, 'tabel_referensi_icon', $where); 
                    }
                    else
                    {
                        $res['status'] = 'error';
                        $res['message'] = 'Gagal mengambil data lama'; 
                    }
                    
                }
                
            }

            
                   
        }
        echo json_encode($res);
    }

    public function get_icon()
    {
        $id = $this->input->get('id');
        $data = $this->referensi->get_icon($id);
        echo json_encode($data);
    }

    public function daftar_icon()
    {
        $data=$this->referensi->daftar_icon();
        echo json_encode($data);
    }

    public function hapus_icon()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        if(unlink('assets/uploads/marker_icon/'.$name.'.png'))
        {
            $data = $this->referensi->hapus_icon($id);
        }
        echo json_encode($data);
    }
    
    public function cek_nama_icon()
    {
        $name = $this->input->post('name');
        $cek = $this->db->query('select * from tabel_referensi_icon where nama_icon like "'.$name.'" ')->result_array();
        if(count($cek) > 0)
        {
            $res['status'] = 'error';
        }
        else
        {
            $res['status'] = 'success';
        }

        echo json_encode($res);
    }


    // Referensi Koordinat
    public function koordinat()
    {
        $data = [
            'isi' => "$this->base/referensi/koordinat",
            'extra_js' => $this->load->view("$this->base/referensi/koordinat_js", '', true),
            'data_opd' => $this->db->get('tabel_referensi_opd')->result_array()
        ];
        $this->load->view('layouts/wrapper', $data, FALSE);   
    }

    public function form_koordinat()
    {
        $id = $this->input->post('id_koordinat');
        if($id=="")
        {
            $a = [];
            $a['nama_koordinat'] = @$this->input->post('nama_koordinat');
            $a['ket_koordinat'] = @$this->input->post('ket_koordinat');
            $a['tipe_koordinat'] = @$this->input->post('tipe_koordinat');
            $a['id_opd'] = @$this->input->post('id_opd');
            $a['koordinat'] = @$this->input->post('koordinat');
            $a['add_by'] = @$this->session->userdata('id');

            $this->db->insert('tabel_referensi_koordinat',$a);
            $res['status'] = 'success';
        }
        else
        {
            $a = [];
            $a['nama_koordinat'] = @$this->input->post('nama_koordinat');
            $a['ket_koordinat'] = @$this->input->post('ket_koordinat');
            $a['tipe_koordinat'] = @$this->input->post('tipe_koordinat');
            $a['id_opd'] = @$this->input->post('id_opd');
            $a['koordinat'] = @$this->input->post('koordinat');
            $a['edit_by'] = @$this->session->userdata('id');

            $this->db->where('id_koordinat',$id)->update('tabel_referensi_koordinat',$a);
            $res['status'] = 'success';
        }
        echo json_encode($res);
    }

    public function daftar_koordinat()
    {
        $data = $this->referensi->daftar_koordinat($_POST);
        echo json_encode($data);
    }

    public function get_koordinat()
    {
        $id = $this->input->get('id');
        $data = $this->referensi->get_koordinat($id);
        echo json_encode($data);
    }

    public function hapus_koordinat()
    {
        $id = $this->input->post('id');
        $data = $this->referensi->hapus_koordinat($id);
        echo json_encode($data);
    }


}

/* End of file Referensi.php */


?>