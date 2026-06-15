<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->cek_role(['admin', 'manager']);
        $this->load->model('Laporan_model');    
        $this->load->model('User_model');
    }

    // Halaman utama laporan
    public function index() {
        redirect('laporan/penjualan');
    }

    // Laporan utama (gabungan 3 tab)
    public function penjualan() {
        $tgl_mulai = $this->input->get('tgl_mulai') ?: date('Y-m-01');
        $tgl_akhir = $this->input->get('tgl_akhir') ?: date('Y-m-d');

        $data['title']       = 'Laporan Penjualan';
        $data['tgl_mulai']   = $tgl_mulai;
        $data['tgl_akhir']   = $tgl_akhir;
        $data['ringkasan']   = $this->Laporan_model->ringkasan($tgl_mulai, $tgl_akhir);
        $data['per_sales']   = $this->Laporan_model->per_sales($tgl_mulai, $tgl_akhir);
        $data['per_produk']  = $this->Laporan_model->per_produk($tgl_mulai, $tgl_akhir);
        $data['per_periode'] = $this->Laporan_model->per_periode($tgl_mulai, $tgl_akhir);

        $this->load->view('layouts/header', $data);
        $this->load->view('laporan/index', $data);
        $this->load->view('layouts/footer');
    }

    // Export PDF - semua laporan
    public function export_pdf() {
        $tgl_mulai = $this->input->get('tgl_mulai') ?: date('Y-m-01');
        $tgl_akhir = $this->input->get('tgl_akhir') ?: date('Y-m-d');
        $jenis     = $this->input->get('jenis') ?: 'semua';

        $data['tgl_mulai']   = $tgl_mulai;
        $data['tgl_akhir']   = $tgl_akhir;
        $data['jenis']       = $jenis;
        $data['ringkasan']   = $this->Laporan_model->ringkasan($tgl_mulai, $tgl_akhir);
        $data['per_sales']   = $this->Laporan_model->per_sales($tgl_mulai, $tgl_akhir);
        $data['per_produk']  = $this->Laporan_model->per_produk($tgl_mulai, $tgl_akhir);
        $data['per_periode'] = $this->Laporan_model->per_periode($tgl_mulai, $tgl_akhir);

        // Load view PDF (tanpa layout sidebar)
        $html = $this->load->view('laporan/pdf', $data, TRUE);

        // Gunakan library dompdf via composer, atau fallback HTML print
        // Jika pakai dompdf: require 'vendor/autoload.php';
        // Untuk CI3 tanpa composer, kita kirim sebagai halaman HTML print-ready
        $filename = 'Laporan_Penjualan_' . $tgl_mulai . '_sd_' . $tgl_akhir . '.pdf';

        // Cek apakah dompdf tersedia
        $dompdf_path = APPPATH . '../vendor/dompdf/dompdf/src/Dompdf.php';
        if (file_exists($dompdf_path)) {
            require_once APPPATH . '../vendor/autoload.php';
            $dompdf = new \Dompdf\Dompdf();
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->loadHtml($html);
            $dompdf->render();
            $dompdf->stream($filename, ['Attachment' => true]);
        } else {
            // Fallback: tampilkan halaman HTML yang bisa di-print/Save as PDF
            echo $html;
        }
    }
}