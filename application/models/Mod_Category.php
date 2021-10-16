<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_Category extends CI_Model
{

    var $column_order = array('kategoriid', 'kategoriname', 'statuskategori', null);
    var $column_search = array('kategoriid', 'kategoriname', 'statuskategori');
    var $order = array('kategoriid' => 'desc');
    var $table = 'kategori';

    private function _get_dataTables()
    {
        $this->db->from($this->table);
        $i = 0;
        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }
        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } elseif (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    function get_dataTables()
    {
        $this->_get_dataTables();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered()
    {
        $this->_get_dataTables();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_all()
    {
        $this->db->from($this->table);
        // $this->db->where('jenis','Dalam');
        return $this->db->count_all_results();
    }
    public function ambil($table, $data)
    {
        $this->db->where($data);
        return $this->db->get($table);
    }
    public function Simpan($tabel, $data)
    {
        $this->db->insert($tabel, $data);
    }
    public function ubah($tabel, $data, $id)
    {
        $this->db->set($data);
        $this->db->where($id);
        $this->db->update($tabel);
    }
    public function getdata($tabel)
    {
        return $this->db->get($tabel);
    }
}
