<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_crud extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('M_login');
        $this->load->model('M_barang');
        $this->load->model('M_penjualan');
        $this->load->model('M_prediksi');
    }

    public function list_login()
    {
        $data['page'] = "crud/list_login";
        $data['data'] = $this->M_login->getAll();

        $this->load->view('template/index', $data);
    }

    public function add_login()
    {
        $data['page'] = "crud/add_login";

        $this->load->view('template/index', $data);
    }

    public function view_login($id)
    {
        $data['page'] = "crud/view_login";
        $data['data'] = $this->M_login->getById($id);

        $this->load->view('template/index', $data);
    }

    public function edit_login($id)
    {
        $data['page'] = "crud/edit_login";
        $data['data'] = $this->M_login->getById($id);

        $this->load->view('template/index', $data);
    }

    public function save_login()
    {
        $checkUsername  = $this->M_login->checkUsernameExist();
        if ($checkUsername) {
            $status     = 204;
            echo json_encode(array(
                'status' => $status,
            ));
            return;
        } else {
            $result         = $this->M_login->save();
            $status         = $result;

            echo json_encode(array(
                'status' => $status,
            ));
            return;
        }
    }

    public function update_login($id)
    {
        $result     = $this->M_login->update($id);
        $status     = $result;

        echo json_encode(array(
            'status' => $status,
        ));
        return;
    }

    public function delete_login($id)
    {
        $result     = $this->M_login->delete($id);
        $status     = $result;

        echo json_encode(array(
            'status' => $status,
        ));
        return;
    }

    public function list_barang()
    {
        $data['page'] = "crud/list_barang";
        $data['data'] = $this->M_barang->getAll();

        $this->load->view('template/index', $data);
    }

    public function add_barang()
    {
        $data['page'] = "crud/add_barang";

        $this->load->view('template/index', $data);
    }

    public function view_barang($id)
    {
        $data['page'] = "crud/view_barang";
        $data['data'] = $this->M_barang->getById($id);

        $this->load->view('template/index', $data);
    }

    public function edit_barang($id)
    {
        $data['page'] = "crud/edit_barang";
        $data['data'] = $this->M_barang->getById($id);

        $this->load->view('template/index', $data);
    }

    public function save_barang()
    {
        $result     = $this->M_barang->save();
        $status     = $result;

        echo json_encode(array(
            'status' => $status,
        ));
        return;
    }

    public function update_barang($id)
    {
        $result     = $this->M_barang->update($id);
        $status     = $result;

        echo json_encode(array(
            'status' => $status,
        ));
        return;
    }

    public function delete_barang($id)
    {
        $result     = $this->M_barang->delete($id);
        $status     = $result;

        echo json_encode(array(
            'status' => $status,
        ));
        return;
    }

    public function list_penjualan()
    {
        $data['page'] = "crud/list_penjualan";
        $data['data'] = $this->M_penjualan->getAll();

        $this->load->view('template/index', $data);
    }

    public function add_penjualan()
    {
        $data['page'] = "crud/add_penjualan";
        $data['data_barang'] = $this->M_barang->getAll();

        $this->load->view('template/index', $data);
    }

    public function view_penjualan($id)
    {
        $data['page'] = "crud/view_penjualan";
        $data['data'] = $this->M_penjualan->getById($id);
        $data['data_barang'] = $this->M_barang->getAll();

        $this->load->view('template/index', $data);
    }

    public function edit_penjualan($id)
    {
        $data['page'] = "crud/edit_penjualan";
        $data['data'] = $this->M_penjualan->getById($id);
        $data['data_barang'] = $this->M_barang->getAll();

        $this->load->view('template/index', $data);
    }

    public function save_penjualan()
    {
        $result     = $this->M_penjualan->save();
        $status     = $result;

        echo json_encode(array(
            'status' => $status,
        ));
        return;
    }

    public function update_penjualan($id)
    {
        $result     = $this->M_penjualan->update($id);
        $status     = $result;

        echo json_encode(array(
            'status' => $status,
        ));
        return;
    }

    public function delete_penjualan($id)
    {
        $result     = $this->M_penjualan->delete($id);
        $status     = $result;

        echo json_encode(array(
            'status' => $status,
        ));
        return;
    }

    public function list_prediksi()
    {
        $data['page'] = "crud/list_prediksi";
        $data['data'] = $this->M_prediksi->getAll();

        $this->load->view('template/index', $data);
    }

    public function hasil_prediksi($idPrediksi)
    {
        $data['page'] = "crud/hasil_prediksi";
        $hasil_prediksi =  $this->M_prediksi->getById($idPrediksi);
        $data['data'] = $this->M_prediksi->getPrediksiAll($hasil_prediksi->idBarang, $hasil_prediksi->bulan, $hasil_prediksi->tahun);
        $data['hasil_prediksi'] = $hasil_prediksi;

        $this->load->view('template/index', $data);
    }

    public function add_prediksi()
    {
        $data['page'] = "crud/add_prediksi";
        $data['data_barang'] = $this->M_barang->getAll();

        $this->load->view('template/index', $data);
    }

    public function save_prediksi()
    {
        $idBarang   = $this->input->post('idBarang');
        $bulan      = $this->input->post('bulan');
        $tahun      = $this->input->post('tahun');

        $getData    = $this->M_penjualan->getPenjualan($idBarang, $bulan, $tahun);
        $jumlahData = count($getData);
        $perkalian = 1;
        if ($jumlahData % 2 == 0) {
            $perkalian = 2;
        }

        $jumlah_x = 0;
        $jumlah_y = 0;
        $jumlah_xx = 0;
        $jumlah_xy = 0;
        $nilai_a = 0;
        $nilai_b = 0;
        $jumlah_mse = 0;
        $jumlah_mad = 0;

        if ($jumlahData != 0) {
            $x = ((($jumlahData / 2) - 0.5) * -$perkalian);
            $lastX = ((($jumlahData / 2) - 0.5) * $perkalian) +  $perkalian;
            foreach ($getData as $data) {
                $jumlah_x += $x;
                $jumlah_y += $data->qty;
                $jumlah_xx += ($x * $x);
                $jumlah_xy += ($x * $data->qty);
                $x++;
                if ($perkalian == 2) {
                    $x++;
                }
            }
            $nilai_a = $jumlah_y / $jumlahData;
            $nilai_b = $jumlah_xx == 0 ? 0 : $jumlah_xy / $jumlah_xx;
            $hasil = $nilai_a + ($nilai_b * $lastX);

            $getDataPrediksi = $this->M_prediksi->getPrediksiAll($idBarang, $bulan, $tahun);
            $jumlahDataPrediksi = count($getDataPrediksi);
            if ($jumlahDataPrediksi != 0) {
                $se = 0;
                $ad = 0;
                foreach ($getDataPrediksi as $dataPrediksi) {
                    $se += abs(pow($dataPrediksi->jumlah - $dataPrediksi->hasil, 2));
                    $ad += abs($dataPrediksi->jumlah - $dataPrediksi->hasil);
                }
                $jumlah_mse = $se / $jumlahDataPrediksi;
                $jumlah_mad = $ad / $jumlahDataPrediksi;
            }

            $cekData = $this->M_prediksi->getPrediksiId($idBarang, $bulan, $tahun);

            if ($cekData) {
                $result     = $this->M_prediksi->update($cekData->idPrediksi, $jumlah_x, $jumlah_y, $jumlah_xx, $jumlah_xy, $nilai_a, $nilai_b, $hasil, $jumlah_mse, $jumlah_mad);
                $status     = $result;

                echo json_encode(array(
                    'status' => $status,
                    'idPrediksi' => $cekData->idPrediksi,
                ));
                return;
            } else {
                $result     = $this->M_prediksi->save($jumlah_x, $jumlah_y, $jumlah_xx, $jumlah_xy, $nilai_a, $nilai_b, $hasil, $jumlah_mse, $jumlah_mad);
                $status     = $result;

                echo json_encode(array(
                    'status' => $status,
                    'idPrediksi' => $result,
                ));
                return;
            }
        } else {
            echo json_encode(array(
                'status' => false,
                'text' => 'Data Penjualan Tidak Ditemukan',
            ));
            return;
        }
    }
}
