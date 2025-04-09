<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {

    private $table = 'user_detail';
    private $table_join = 'tabel_referensi_opd'; 
    private $table_join_2 = 'user_login'; 

    public function daftar_user()
    {
        $hasil = $this->db->select('*');
        $hasil = $this->db->from("$this->table a");
        $hasil = $this->db->join("$this->table_join b", 'a.id_opd = b.id_opd', 'left');
        $hasil = $this->db->join("$this->table_join_2 c", 'a.id_user = c.id_user', 'left');
        $hasil = $this->db->get();
        return $hasil->result();
    }

    public function tampil_semua($table){
        $query = $this->db->get($table);
        return $query->result_array();
    }

    public function tampil_sebagian($where, $table) {
        $query = $this->db->get_where($table, $where);
        return $query->result_array();
    }

    public function pencarian($where, $table) {
        $query = $this->db->get_where($table, $where);
        return $query->row_array();
    }

    public function simpan($data, $table){
        $this->db->insert($table, $data);
    }

    public function edit($data, $where, $table){
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function hapus($where, $table){
        $this->db->where($where);
        $this->db->delete($table);
    }

}

/* End of file UserModel.php */


?>