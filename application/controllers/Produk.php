<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->cek_role(['admin']);
        $this->load->model('Produk_model');
    }

    public function index() {
        $data['title']   = 'Data Produk';
        $data['produk']  = $this->Produk_model->get_all();
        $this->load->view('layouts/header', $data);
        $this->load->view('products/index', $data);
        $this->load->view('layouts/footer');
    }

    public function tambah() {
        $data['title'] = 'Tambah Produk';
        $this->load->view('layouts/header', $data);
        $this->load->view('products/form', $data);
        $this->load->view('layouts/footer');
    }

    public function simpan() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('kode_produk', 'Kode Produk', 'required|is_unique[produk.kode_produk]');
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('stok', 'Stok', 'required|integer');

        if ($this->form_validation->run() === FALSE) {
            $data['title'] = 'Tambah Produk';
            $this->load->view('layouts/header', $data);
            $this->load->view('products/form', $data);
            $this->load->view('layouts/footer');
        } else {
            $this->Produk_model->insert([
                'kode_produk'  => $this->input->post('kode_produk'),
                'nama_produk'  => $this->input->post('nama_produk'),
                'harga'        => $this->input->post('harga'),
                'stok'         => $this->input->post('stok'),
            ]);
            $this->session->set_flashdata('success', 'Produk berhasil ditambahkan!');
            redirect('produk');
        }
    }

    public function edit($id) {
        $data['title']  = 'Edit Produk';
        $data['produk'] = $this->Produk_model->get_by_id($id);
        if (!$data['produk']) show_404();
        $this->load->view('layouts/header', $data);
        $this->load->view('products/form', $data);
        $this->load->view('layouts/footer');
    }

    public function update($id) {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('stok', 'Stok', 'required|integer');

        if ($this->form_validation->run() === FALSE) {
            $data['title']  = 'Edit Produk';
            $data['produk'] = $this->Produk_model->get_by_id($id);
            $this->load->view('layouts/header', $data);
            $this->load->view('products/form', $data);
            $this->load->view('layouts/footer');
        } else {
            $this->Produk_model->update($id, [
                'nama_produk' => $this->input->post('nama_produk'),
                'harga'       => $this->input->post('harga'),
                'stok'        => $this->input->post('stok'),
            ]);
            $this->session->set_flashdata('success', 'Produk berhasil diperbarui!');
            redirect('produk');
        }
    }

    public function hapus($id) {
        $this->Produk_model->delete($id);
        $this->session->set_flashdata('success', 'Produk berhasil dihapus!');
        redirect('produk');
    }
}
