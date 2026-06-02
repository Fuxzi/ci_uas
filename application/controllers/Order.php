<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->cek_login();
        $this->load->model(['Order_model', 'Pelanggan_model', 'Produk_model']);
    }

    public function index() {
        $data['title'] = 'Sales Order';

        // Sales hanya lihat order miliknya
        if ($this->role === 'sales') {
            $data['orders'] = $this->Order_model->get_by_sales($this->session->userdata('user_id'));
        } else {
            $data['orders'] = $this->Order_model->get_all();
        }

        $this->load->view('layouts/header', $data);
        $this->load->view('order/index', $data);
        $this->load->view('layouts/footer');
    }

    public function buat() {
        $this->cek_role(['admin', 'sales']);
        $data['title']     = 'Buat Order Baru';
        $data['pelanggan'] = $this->Pelanggan_model->get_all();
        $data['produk']    = $this->Produk_model->get_all();
        $this->load->view('layouts/header', $data);
        $this->load->view('order/form', $data);
        $this->load->view('layouts/footer');
    }

    public function simpan() {
        $this->cek_role(['admin', 'sales']);

        $id_pelanggan = $this->input->post('id_pelanggan');
        $id_produk    = $this->input->post('id_produk');
        $jumlah       = $this->input->post('jumlah');
        $catatan      = $this->input->post('catatan');

        if (empty($id_produk)) {
            $this->session->set_flashdata('error', 'Minimal 1 produk harus dipilih!');
            redirect('order/buat');
            return;
        }

        // Generate nomor order
        $no_order = 'SO-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));

        // Hitung total
        $total = 0;
        $items = [];
        foreach ($id_produk as $k => $pid) {
            $produk = $this->Produk_model->get_by_id($pid);
            $qty    = (int)$jumlah[$k];
            $subtot = $produk->harga * $qty;
            $total += $subtot;
            $items[] = [
                'id_produk'    => $pid,
                'jumlah'       => $qty,
                'harga_satuan' => $produk->harga,
                'subtotal'     => $subtot,
            ];
        }

        // Simpan header order
        $id_order = $this->Order_model->insert([
            'no_order'     => $no_order,
            'id_pelanggan' => $id_pelanggan,
            'id_sales'     => $this->session->userdata('user_id'),
            'tanggal'      => date('Y-m-d'),
            'total_harga'  => $total,
            'status'       => 'draft',
            'catatan'      => $catatan,
        ]);

        // Simpan detail
        foreach ($items as $item) {
            $item['id_order'] = $id_order;
            $this->Order_model->insert_detail($item);
        }

        $this->session->set_flashdata('success', "Order $no_order berhasil dibuat!");
        redirect('order');
    }

    public function detail($id) {
        $data['title']  = 'Detail Order';
        $data['order']  = $this->Order_model->get_with_detail($id);
        $data['detail'] = $this->Order_model->get_detail($id);
        if (!$data['order']) show_404();
        $this->load->view('layouts/header', $data);
        $this->load->view('order/detail', $data);
        $this->load->view('layouts/footer');
    }

    public function ubah_status($id) {
        $this->cek_role(['admin', 'manager']);
        $status = $this->input->post('status');
        $this->Order_model->update($id, ['status' => $status]);
        $this->session->set_flashdata('success', 'Status order berhasil diubah!');
        redirect('order/detail/' . $id);
    }
}
