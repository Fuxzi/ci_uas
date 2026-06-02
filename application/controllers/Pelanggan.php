<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->cek_role(['admin']);
        $this->load->model('Pelanggan_model');
    }

    public function index() {
        $data['title']     = 'Data Pelanggan';
        $data['pelanggan'] = $this->Pelanggan_model->get_all();
        $this->load->view('layouts/header', $data);
        $this->load->view('pelanggan/index', $data);
        $this->load->view('layouts/footer');
    }

    public function tambah() {
        $data['title'] = 'Tambah Pelanggan';
        $this->load->view('layouts/header', $data);
        $this->load->view('pelanggan/form', $data);
        $this->load->view('layouts/footer');
    }

    public function simpan() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('no_telepon', 'No Telepon', 'required');

        if ($this->form_validation->run() === FALSE) {
            $data['title'] = 'Tambah Pelanggan';
            $this->load->view('layouts/header', $data);
            $this->load->view('pelanggan/form', $data);
            $this->load->view('layouts/footer');
        } else {
            $this->Pelanggan_model->insert([
                'nama'        => $this->input->post('nama'),
                'alamat'      => $this->input->post('alamat'),
                'no_telepon'  => $this->input->post('no_telepon'),
            ]);
            $this->session->set_flashdata('success', 'Pelanggan berhasil ditambahkan!');
            redirect('pelanggan');
        }
    }

    public function edit($id) {
        $data['title']     = 'Edit Pelanggan';
        $data['pelanggan'] = $this->Pelanggan_model->get_by_id($id);
        if (!$data['pelanggan']) show_404();
        $this->load->view('layouts/header', $data);
        $this->load->view('pelanggan/form', $data);
        $this->load->view('layouts/footer');
    }

    public function update($id) {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('no_telepon', 'No Telepon', 'required');

        if ($this->form_validation->run() === FALSE) {
            $data['title']     = 'Edit Pelanggan';
            $data['pelanggan'] = $this->Pelanggan_model->get_by_id($id);
            $this->load->view('layouts/header', $data);
            $this->load->view('pelanggan/form', $data);
            $this->load->view('layouts/footer');
        } else {
            $this->Pelanggan_model->update($id, [
                'nama'       => $this->input->post('nama'),
                'alamat'     => $this->input->post('alamat'),
                'no_telepon' => $this->input->post('no_telepon'),
            ]);
            $this->session->set_flashdata('success', 'Pelanggan berhasil diperbarui!');
            redirect('pelanggan');
        }
    }

    public function hapus($id) {
        $this->Pelanggan_model->delete($id);
        $this->session->set_flashdata('success', 'Pelanggan berhasil dihapus!');
        redirect('pelanggan');
    }
}
