<?php


defined('BASEPATH') or exit('No direct script access allowed');

class ReferensiModel extends CI_Model
{

    public function tambah($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function ubah($data, $table, $where)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    function daftar_opd()
    {
        $hasil = $this->db->query("SELECT * FROM tabel_referensi_opd");
        return $hasil->result();
    }

    public function get_opd($id)
    {
        $hsl = $this->db->query("SELECT * FROM tabel_referensi_opd WHERE id_opd='$id'");
        if ($hsl->num_rows() > 0) {
            foreach ($hsl->result() as $data) {
                $hasil = array(
                    'nama' => $data->nama_opd,
                );
            }
        }
        return $hasil;
    }

    public function hapus_opd($id)
    {
        $hasil = $this->db->query("DELETE FROM tabel_referensi_opd WHERE id_opd='$id'");
        return $hasil;
    }

    // Ref RPR
    function daftar_rpr()
    {
        $hasil = $this->db->query("SELECT * FROM tabel_referensi_rpr");
        return $hasil->result();
    }

    public function get_rpr($id)
    {
        $hsl = $this->db->query("SELECT * FROM tabel_referensi_rpr WHERE id_rpr='$id'");
        if ($hsl->num_rows() > 0) {
            foreach ($hsl->result() as $data) {
                $hasil = array(
                    'nama' => $data->nama_rpr,
                );
            }
        }
        return $hasil;
    }

    public function hapus_rpr($id)
    {
        $hasil = $this->db->query("DELETE FROM tabel_referensi_rpr WHERE id_rpr='$id'");
        return $hasil;
    }

    // Ref Status Tanah
    function daftar_st()
    {
        $hasil = $this->db->query("SELECT * FROM tabel_referensi_st");
        return $hasil->result();
    }

    public function get_st($id)
    {
        $hsl = $this->db->query("SELECT * FROM tabel_referensi_st WHERE id_st='$id'");
        if ($hsl->num_rows() > 0) {
            foreach ($hsl->result() as $data) {
                $hasil = array(
                    'nama' => $data->nama_st,
                );
            }
        }
        return $hasil;
    }

    public function hapus_st($id)
    {
        $hasil = $this->db->query("DELETE FROM tabel_referensi_st WHERE id_st='$id'");
        return $hasil;
    }



    // Ref Rencana Pola Ruang
    public function daftar_rencana_pola_ruang()
    {
        $hasil = $this->db->query("SELECT * FROM tabel_referensi_rencana_pola_ruang");
        return $hasil->result();
    }

    public function get_rencana_pola_ruang($id)
    {
        $hsl = $this->db->query("SELECT * FROM tabel_referensi_rencana_pola_ruang WHERE id='$id'");
        if ($hsl->num_rows() > 0) {
            foreach ($hsl->result() as $data) {
                $hasil = array(
                    'nama_rencana_pola_ruang' => $data->nama_rencana_pola_ruang,
                );
            }
        }
        return $hasil;
    }

    public function hapus_rencana_pola_ruang($id)
    {
        $hasil = $this->db->query("DELETE FROM tabel_referensi_rencana_pola_ruang WHERE id='$id'");
        return $hasil;
    }

    // Referensi Icon
    function daftar_icon()
    {
        if ($this->session->userdata('role') == 1) {
            $hasil = $this->db->query("SELECT * FROM tabel_referensi_icon");
        } else {
            $hasil = $this->db->query("SELECT * FROM tabel_referensi_icon WHERE id_opd = {$this->session->userdata('id_opd')}");
        }

        return $hasil->result();
    }

    public function get_icon($id)
    {
        $hsl = $this->db->query("SELECT * FROM tabel_referensi_icon WHERE id_icon='$id'");
        if ($hsl->num_rows() > 0) {
            foreach ($hsl->result() as $data) {
                $hasil = array(
                    'nama' => $data->nama_icon,
                );
            }
        }
        return $hasil;
    }

    public function hapus_icon($id)
    {
        $hasil = $this->db->query("DELETE FROM tabel_referensi_icon WHERE id_icon='$id'");
        return $hasil;
    }

    // Referensi Koordinat
    // function daftar_koordinat(){
    //     if($this->session->userdata('role') == 1)
    //     {
    //         $hasil = $this->db->query("SELECT * FROM tabel_referensi_koordinat");
    //     }
    //     else
    //     {
    //         $hasil = $this->db->query("SELECT * FROM tabel_referensi_koordinat WHERE id_opd = {$this->session->userdata('id_opd')} OR id_opd = 0");
    //     }

    //     return $hasil->result();
    // }

    public function daftar_koordinat($post)
    {
        $default_order = [
            'id_koordinat',
            'ASC'
        ];

        $config = [];
        $config['draw'] = $_POST['draw'];
        $config['start'] = $_POST['start'];
        $config['length'] = $_POST['length'];
        $config['search'] = $_POST['search'];
        $config['order'] = @$_POST['order'] ? $_POST['order'] : null;
        $config['default_order'] = $default_order;
        $config['orderable'] = [null, 'nama_koordinat', 'ket_koordinat', 'tipe_koordinat', null];
        $config['searchable'] = ['nama_koordinat', 'ket_koordinat', 'tipe_koordinat'];

        $return = $this->query_koordinat($config);
        $data = [];
        $no = $config['start'] + 1;
        foreach ($return['data'] as $v) {
            $x = [];
            $x[] = $no++;
            $x[] = $v['nama_koordinat'];
            $x[] = $v['ket_koordinat'];
            $x[] = $v['tipe_koordinat'];
            $x[] = '<button type="button" class="btn btn-sm btn-warning mb-10 item_edit" data="'.$v['id_koordinat'].'"><i class="fa fa-edit"></i></button> <button type="button" class="btn btn-sm btn-danger mb-10 item_hapus" data="'.$v['id_koordinat'].'" data-name="'.$v['nama_koordinat'].'"><i class="fa fa-trash"></i></button>';
            $data[] = $x;
        }

        $res['draw'] = $config['draw'];
        $res['data'] = $data;
        $res['recordsTotal'] = $return['recordsTotal'];
        $res['recordsFiltered'] = $return['recordsFiltered'];

        return $res;
    }

    private function query_koordinat($config)
    {

        $return = [];

        $q  = " SELECT * FROM tabel_referensi_koordinat ";
        $q .= " WHERE 1=1 ";

        //recordsTotal
        $return['recordsTotal'] = $this->db->query($q)->num_rows();

        $q .= " AND 1=0 ";

        foreach ($config['searchable'] as $v) {
            $q .= " OR {$v} LIKE '%{$config['search']['value']}%' ";
        }

        //recordsFiltered
        $return['recordsFiltered'] = $this->db->query($q)->num_rows();

        if (is_null($config['order'])) {
            $q .= " ORDER BY {$config['default_order'][0]} {$config['default_order'][1]} ";
        } else {
            $q .= "ORDER BY ";

            foreach ($config['order'] as $k => $v) {
                if ($k > 0) {
                    $q .= " , {$config['orderable'][$v['column']]} {$v['dir']} ";
                } else {
                    $q .= " {$config['orderable'][$v['column']]} {$v['dir']} ";
                }
            }
        }

        $q .= " LIMIT {$config['start']}, {$config['length']} ";

        //data
        $return['data'] = $this->db->query($q)->result_array();

        return $return;
    }

    public function get_koordinat($id)
    {
        $hsl = $this->db->query("SELECT * FROM tabel_referensi_koordinat WHERE id_koordinat='$id'")->row_array();
        // if($hsl->num_rows()>0){
        //     foreach ($hsl->result() as $data) {
        //         $hasil=array(
        //             'nama' => $data->nama_koordinat,
        //             'ket' =>$data->ket_koordinat
        //             );
        //     }
        // }
        return $hsl;
    }

    public function hapus_koordinat($id)
    {
        $hasil = $this->db->query("DELETE FROM tabel_referensi_koordinat WHERE id_koordinat='$id'");
        return $hasil;
    }
}

/* End of file ReferensiModel.php */
