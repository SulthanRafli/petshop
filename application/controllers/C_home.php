<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_home extends CI_Controller
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


    public function index()
    {
        $data['page'] = "dashboard/dashboard";

        $dataLogin = $this->M_login->getAll();
        $dataBarang = $this->M_barang->getAll();
        $dataPenjualan = $this->M_penjualan->getSumPenjualan();
        $chartPenjualan = $this->M_penjualan->getDataPenjualan();

        $transformedData = array();

        foreach ($chartPenjualan as $item) {
            $transformedData[] = array(
                "barang" => $item->barang,
                "data" => array(
                    intval($item->Jan),
                    intval($item->Feb),
                    intval($item->Mar),
                    intval($item->Apr),
                    intval($item->Mei),
                    intval($item->Jun),
                    intval($item->Jul),
                    intval($item->Agu),
                    intval($item->Sep),
                    intval($item->Okt),
                    intval($item->Nov),
                    intval($item->Des)
                )
            );
        }


        $data['jumlahPenjualan'] = $dataPenjualan->jumlah;
        $data['jumlahLogin'] = count($dataLogin);
        $data['jumlahBarang'] = count($dataBarang);
        $data['chartPenjualan'] = json_encode($transformedData);

        $this->load->view('template/index', $data);
    }
}
