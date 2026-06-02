<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    protected $user;
    protected $role;

    public function __construct() {
        parent::__construct();
        $this->user = $this->session->userdata('user');
        $this->role = $this->session->userdata('role');
    }

    // Cek apakah sudah login
    protected function cek_login() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }

    // Cek role yang diizinkan
    protected function cek_role($roles = []) {
        $this->cek_login();
        if (!empty($roles) && !in_array($this->role, $roles)) {
            show_error('Anda tidak memiliki akses ke halaman ini.', 403, 'Akses Ditolak');
        }
    }
}
