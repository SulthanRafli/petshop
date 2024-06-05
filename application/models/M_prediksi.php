<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_prediksi extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function getAll()
    {
        $this->db->select('prediksi.*, barang.nama AS barang');
        $this->db->from('prediksi');
        $this->db->join('barang', 'prediksi.idBarang = barang.idBarang', 'left');
        $this->db->where('prediksi.visible', 1);
        $this->db->order_by('prediksi.tahun', 'ASC');
        $this->db->order_by('prediksi.bulan', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    function getPrediksiAll($idBarang, $bulan, $tahun)
    {
        $this->db->select('prediksi.*, barang.nama AS barang, penjualan.qty AS jumlah');
        $this->db->from('prediksi');
        $this->db->join('barang', 'prediksi.idBarang = barang.idBarang', 'left');
        $this->db->join('penjualan', 'prediksi.idBarang = penjualan.idBarang AND prediksi.bulan = penjualan.bulan AND prediksi.tahun = penjualan.tahun', 'left');
        $this->db->where('prediksi.visible', 1);
        $this->db->where('prediksi.idBarang', $idBarang);
        $this->db->group_start();
        $this->db->where('prediksi.tahun <', $tahun);
        $this->db->or_group_start();
        $this->db->where('prediksi.tahun', $tahun);
        $this->db->where('prediksi.bulan <', $bulan);
        $this->db->group_end();
        $this->db->group_end();
        $this->db->order_by('prediksi.tahun', 'ASC');
        $this->db->order_by('prediksi.bulan', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }


    function getPrediksiId($idBarang, $bulan, $tahun)
    {
        $this->db->select('*');
        $this->db->from('prediksi');
        $this->db->where('visible', 1);
        $this->db->where('idBarang', $idBarang);
        $this->db->where('bulan', $bulan);
        $this->db->where('tahun', $tahun);
        $query = $this->db->get();
        return $query->row();
    }

    function getById($id)
    {
        $this->db->select('*');
        $this->db->from('prediksi');
        $this->db->where('visible', 1);
        $this->db->where('idPrediksi', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function save($jumlah_x, $jumlah_y, $jumlah_xx, $jumlah_xy, $nilai_a, $nilai_b, $hasil, $jumlah_mse, $jumlah_mad)
    {
        $this->db->trans_begin();

        $data['idBarang'] = $this->input->post('idBarang');
        $data['bulan'] = $this->input->post('bulan');
        $data['tahun'] = $this->input->post('tahun');
        $data['jumlahX'] = $jumlah_x;
        $data['jumlahY'] = $jumlah_y;
        $data['jumlahXX'] = $jumlah_xx;
        $data['jumlahXY'] = $jumlah_xy;
        $data['nilaiA'] = $nilai_a;
        $data['nilaiB'] = $nilai_b;
        $data['hasil'] = $hasil;
        $data['mse']   = $jumlah_mse;
        $data['mad']   = $jumlah_mad;

        $this->db->insert('prediksi', $data);
        $insert_id = $this->db->insert_id();

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return $insert_id;
        }
    }

    function update($id, $jumlah_x, $jumlah_y, $jumlah_xx, $jumlah_xy, $nilai_a, $nilai_b, $hasil, $jumlah_mse, $jumlah_mad)
    {
        $this->db->trans_begin();

        $data['idBarang'] = $this->input->post('idBarang');
        $data['bulan'] = $this->input->post('bulan');
        $data['tahun'] = $this->input->post('tahun');
        $data['jumlahX'] = $jumlah_x;
        $data['jumlahY'] = $jumlah_y;
        $data['jumlahXX'] = $jumlah_xx;
        $data['jumlahXY'] = $jumlah_xy;
        $data['nilaiA'] = $nilai_a;
        $data['nilaiB'] = $nilai_b;
        $data['hasil'] = $hasil;
        $data['mse']   = $jumlah_mse;
        $data['mad']   = $jumlah_mad;

        $this->db->where('idPrediksi', $id);
        $this->db->update('prediksi', $data);

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

        $this->db->where('idPrediksi', $id);
        $this->db->update('prediksi', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }
}
