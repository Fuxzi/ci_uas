<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model {

    // Ringkasan penjualan
    public function ringkasan($tgl_mulai, $tgl_akhir) {
        // Total penjualan
        $this->db->select('
            COUNT(DISTINCT so.id) as total_order,
            SUM(sod.jumlah) as total_qty,
            SUM(sod.subtotal) as total_penjualan,
            AVG(sod.subtotal) as rata_rata
        ');
        $this->db->from('sales_order so');
        $this->db->join('sales_order_detail sod', 'sod.id_order = so.id');
        $this->db->where('so.tanggal >=', $tgl_mulai);
        $this->db->where('so.tanggal <=', $tgl_akhir);
        $this->db->where('so.status !=', 'dibatalkan');
        $ringkasan = $this->db->get()->row();

        // Total per status
        $this->db->select('
            so.status, 
            COUNT(so.id) as jumlah, 
            SUM(sod.subtotal) as total
        ');
        $this->db->from('sales_order so');
        $this->db->join('sales_order_detail sod', 'sod.id_order = so.id');
        $this->db->where('so.tanggal >=', $tgl_mulai);
        $this->db->where('so.tanggal <=', $tgl_akhir);
        $this->db->group_by('so.status');
        $per_status = $this->db->get()->result();

        return [
            'total_order'     => $ringkasan->total_order ?? 0,
            'total_qty'       => $ringkasan->total_qty ?? 0,
            'total_penjualan' => $ringkasan->total_penjualan ?? 0,
            'rata_rata'       => $ringkasan->rata_rata ?? 0,
            'per_status'      => $per_status
        ];
    }

    // Laporan per Sales
    public function per_sales($tgl_mulai, $tgl_akhir) {
        $this->db->select('
            u.id as sales_id,
            u.nama as sales_name,
            COUNT(DISTINCT so.id) as total_order,
            SUM(sod.jumlah) as total_qty,
            SUM(sod.subtotal) as total_penjualan
        ');
        $this->db->from('sales_order so');
        $this->db->join('users u', 'u.id = so.id_sales');
        $this->db->join('sales_order_detail sod', 'sod.id_order = so.id');
        $this->db->where('so.tanggal >=', $tgl_mulai);
        $this->db->where('so.tanggal <=', $tgl_akhir);
        $this->db->where('so.status !=', 'dibatalkan');
        $this->db->where('u.role', 'sales');
        $this->db->group_by('so.id_sales');
        $this->db->order_by('total_penjualan', 'DESC');
        
        return $this->db->get()->result();
    }

    // Laporan per Produk
    public function per_produk($tgl_mulai, $tgl_akhir) {
        $this->db->select('
            p.kode_produk,
            p.nama_produk,
            p.harga,
            SUM(sod.jumlah) as total_qty,
            COUNT(DISTINCT so.id) as total_order,
            SUM(sod.subtotal) as total_penjualan
        ');
        $this->db->from('sales_order_detail sod');
        $this->db->join('produk p', 'p.id = sod.id_produk');
        $this->db->join('sales_order so', 'so.id = sod.id_order');
        $this->db->where('so.tanggal >=', $tgl_mulai);
        $this->db->where('so.tanggal <=', $tgl_akhir);
        $this->db->where('so.status !=', 'dibatalkan');
        $this->db->group_by('sod.id_produk');
        $this->db->order_by('total_penjualan', 'DESC');
        $this->db->limit(10); // Top 10 produk
        
        return $this->db->get()->result();
    }

    // Laporan per Periode (harian)
    public function per_periode($tgl_mulai, $tgl_akhir) {
        $this->db->select('
            DATE(so.tanggal) as tanggal,
            COUNT(DISTINCT so.id) as total_order,
            SUM(sod.jumlah) as total_qty,
            SUM(sod.subtotal) as total_penjualan
        ');
        $this->db->from('sales_order so');
        $this->db->join('sales_order_detail sod', 'sod.id_order = so.id');
        $this->db->where('so.tanggal >=', $tgl_mulai);
        $this->db->where('so.tanggal <=', $tgl_akhir);
        $this->db->where('so.status !=', 'dibatalkan');
        $this->db->group_by('DATE(so.tanggal)');
        $this->db->order_by('so.tanggal', 'ASC');
        
        return $this->db->get()->result();
    }

    // Detail order per sales (untuk drill-down)
    public function detail_per_sales($sales_id, $tgl_mulai, $tgl_akhir) {
        $this->db->select('
            so.*,
            pl.nama as pelanggan_name,
            COUNT(sod.id) as total_items,
            SUM(sod.subtotal) as total
        ');
        $this->db->from('sales_order so');
        $this->db->join('pelanggan pl', 'pl.id = so.id_pelanggan');
        $this->db->join('sales_order_detail sod', 'sod.id_order = so.id');
        $this->db->where('so.id_sales', $sales_id);
        $this->db->where('so.tanggal >=', $tgl_mulai);
        $this->db->where('so.tanggal <=', $tgl_akhir);
        $this->db->group_by('so.id');
        $this->db->order_by('so.tanggal', 'DESC');
        
        return $this->db->get()->result();
    }
}