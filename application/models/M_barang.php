<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_barang extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function getAll()
    {
        $this->db->select('*');
        $this->db->from('barang');
        $this->db->where('visible', 1);
        $this->db->order_by('idBarang', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    function getById($id)
    {
        $this->db->select('*');
        $this->db->from('barang');
        $this->db->where('visible', 1);
        $this->db->where('idBarang', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function save()
    {
        $this->db->trans_begin();

        $data['nama'] = $this->input->post('nama');
        $data['harga'] = $this->input->post('harga');
        $data['stok'] = $this->input->post('stok');

        $this->db->insert('barang', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    function update($id)
    {
        $this->db->trans_begin();

        $data['nama'] = $this->input->post('nama');
        $data['harga'] = $this->input->post('harga');
        $data['stok'] = $this->input->post('stok');

        $this->db->where('idBarang', $id);
        $this->db->update('barang', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    function delete($id)
    {
        $this->db->trans_begin();

        $data['visible'] = 0;

        $this->db->where('idBarang', $id);
        $this->db->update('barang', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }
}
