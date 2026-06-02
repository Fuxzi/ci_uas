<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_model extends CI_Model {

    protected $table = 'produk';

    public function get_all() {
        return $this->db->order_by('id', 'ASC')->get($this->table)->result();
    }

    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function insert($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        $this->db->where('id', $id)->update($this->table, $data);
    }

    public function delete($id) {
        $this->db->delete($this->table, ['id' => $id]);
    }

    public function count_all() {
        return $this->db->count_all($this->table);
    }
}
