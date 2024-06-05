<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_penjualan extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function getAll()
    {
        $this->db->select('penjualan.*, barang.nama AS barang');
        $this->db->from('penjualan');
        $this->db->join('barang', 'penjualan.idBarang = barang.idBarang', 'left');
        $this->db->where('penjualan.visible', 1);
        $this->db->order_by('penjualan.idPenjualan', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    function getSumPenjualan()
    {
        $this->db->select('SUM(qty) AS jumlah');
        $this->db->from('penjualan');
        $this->db->where('visible', 1);
        $query = $this->db->get();
        return $query->row();
    }

    function getDataPenjualan()
    {
        $this->db->select('barang.nama AS barang');
        $this->db->select('SUM(CASE WHEN penjualan.bulan = 1 THEN COALESCE(qty, 0) ELSE 0 END) AS "Jan"');
        $this->db->select('SUM(CASE WHEN penjualan.bulan = 2 THEN COALESCE(qty, 0) ELSE 0 END) AS "Feb"');
        $this->db->select('SUM(CASE WHEN penjualan.bulan = 3 THEN COALESCE(qty, 0) ELSE 0 END) AS "Mar"');
        $this->db->select('SUM(CASE WHEN penjualan.bulan = 4 THEN COALESCE(qty, 0) ELSE 0 END) AS "Apr"');
        $this->db->select('SUM(CASE WHEN penjualan.bulan = 5 THEN COALESCE(qty, 0) ELSE 0 END) AS "Mei"');
        $this->db->select('SUM(CASE WHEN penjualan.bulan = 6 THEN COALESCE(qty, 0) ELSE 0 END) AS "Jun"');
        $this->db->select('SUM(CASE WHEN penjualan.bulan = 7 THEN COALESCE(qty, 0) ELSE 0 END) AS "Jul"');
        $this->db->select('SUM(CASE WHEN penjualan.bulan = 8 THEN COALESCE(qty, 0) ELSE 0 END) AS "Agu"');
        $this->db->select('SUM(CASE WHEN penjualan.bulan = 9 THEN COALESCE(qty, 0) ELSE 0 END) AS "Sep"');
        $this->db->select('SUM(CASE WHEN penjualan.bulan = 10 THEN COALESCE(qty, 0) ELSE 0 END) AS "Okt"');
        $this->db->select('SUM(CASE WHEN penjualan.bulan = 11 THEN COALESCE(qty, 0) ELSE 0 END) AS "Nov"');
        $this->db->select('SUM(CASE WHEN penjualan.bulan = 12 THEN COALESCE(qty, 0) ELSE 0 END) AS "Des"');
        $this->db->from('penjualan');
        $this->db->join('barang', 'penjualan.idBarang = barang.idBarang', 'left');
        $this->db->where('penjualan.tahun', 2020);
        $this->db->group_by('penjualan.idBarang');
        $query = $this->db->get();
        return $query->result();
    }

    function getPenjualan($idBarang, $bulan, $tahun)
    {
        $this->db->select('penjualan.*, barang.nama AS barang');
        $this->db->from('penjualan');
        $this->db->join('barang', 'penjualan.idBarang = barang.idBarang', 'left');
        $this->db->where('penjualan.visible', 1);
        $this->db->where('penjualan.idBarang', $idBarang);
        $this->db->group_start();
        $this->db->where('penjualan.tahun <', $tahun);
        $this->db->or_group_start();
        $this->db->where('penjualan.tahun', $tahun);
        $this->db->where('penjualan.bulan <', $bulan);
        $this->db->group_end();
        $this->db->group_end();
        $this->db->order_by('penjualan.tahun', 'ASC');
        $this->db->order_by('penjualan.bulan', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    function getById($id)
    {
        $this->db->select('*');
        $this->db->from('penjualan');
        $this->db->where('visible', 1);
        $this->db->where('idPenjualan', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function save()
    {
        $this->db->trans_begin();

        $data['idBarang'] = $this->input->post('idBarang');
        $data['bulan'] = $this->input->post('bulan');
        $data['tahun'] = $this->input->post('tahun');
        $data['qty'] = $this->input->post('qty');

        $this->db->insert('penjualan', $data);

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

        $data['idBarang'] = $this->input->post('idBarang');
        $data['bulan'] = $this->input->post('bulan');
        $data['tahun'] = $this->input->post('tahun');
        $data['qty'] = $this->input->post('qty');

        $this->db->where('idPenjualan', $id);
        $this->db->update('penjualan', $data);

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

        $this->db->where('idPenjualan', $id);
        $this->db->update('penjualan', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }
}
