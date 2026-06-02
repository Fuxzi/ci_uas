<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->cek_login();
        $this->load->model(['Produk_model', 'Pelanggan_model', 'Order_model']);
    }

    public function index() {
        $data['title']          = 'Dashboard';
        $data['total_produk']   = $this->Produk_model->count_all();
        $data['total_pelanggan']= $this->Pelanggan_model->count_all();
        $data['total_order']    = $this->Order_model->count_all();
        $data['order_terbaru']  = $this->Order_model->get_recent(5);

        $this->load->view('layouts/header', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('layouts/footer');
    }
}
