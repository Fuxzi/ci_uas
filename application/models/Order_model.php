<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model {

    protected $table        = 'sales_order';
    protected $table_detail = 'sales_order_detail';

    public function get_all() {
        return $this->db
            ->select('sales_order.*, pelanggan.nama AS nama_pelanggan, users.nama AS nama_sales')
            ->join('pelanggan', 'pelanggan.id = sales_order.id_pelanggan')
            ->join('users', 'users.id = sales_order.id_sales')
            ->order_by('sales_order.id', 'DESC')
            ->get($this->table)->result();
    }

    public function get_by_sales($id_sales) {
        return $this->db
            ->select('sales_order.*, pelanggan.nama AS nama_pelanggan, users.nama AS nama_sales')
            ->join('pelanggan', 'pelanggan.id = sales_order.id_pelanggan')
            ->join('users', 'users.id = sales_order.id_sales')
            ->where('sales_order.id_sales', $id_sales)
            ->order_by('sales_order.id', 'DESC')
            ->get($this->table)->result();
    }

    public function get_with_detail($id) {
        return $this->db
            ->select('sales_order.*, pelanggan.nama AS nama_pelanggan, pelanggan.alamat, pelanggan.no_telepon, users.nama AS nama_sales')
            ->join('pelanggan', 'pelanggan.id = sales_order.id_pelanggan')
            ->join('users', 'users.id = sales_order.id_sales')
            ->where('sales_order.id', $id)
            ->get($this->table)->row();
    }

    public function get_detail($id_order) {
        return $this->db
            ->select('sales_order_detail.*, produk.nama_produk, produk.kode_produk')
            ->join('produk', 'produk.id = sales_order_detail.id_produk')
            ->where('id_order', $id_order)
            ->get($this->table_detail)->result();
    }

    public function get_recent($limit = 5) {
        return $this->db
            ->select('sales_order.*, pelanggan.nama AS nama_pelanggan, users.nama AS nama_sales')
            ->join('pelanggan', 'pelanggan.id = sales_order.id_pelanggan')
            ->join('users', 'users.id = sales_order.id_sales')
            ->order_by('sales_order.id', 'DESC')
            ->limit($limit)
            ->get($this->table)->result();
    }

    public function insert($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function insert_detail($data) {
        $this->db->insert($this->table_detail, $data);
    }

    public function update($id, $data) {
        $this->db->where('id', $id)->update($this->table, $data);
    }

    public function count_all() {
        return $this->db->count_all($this->table);
    }
}
