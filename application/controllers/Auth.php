<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function index() {
        redirect('login');
    }

    public function login() {
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }
        $this->load->view('auth/login');
    }

    public function proses_login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->User_model->get_by_username($username);

        if ($user && password_verify($password, $user->password)) {
            $this->session->set_userdata([
                'logged_in' => TRUE,
                'user_id'   => $user->id,
                'nama'      => $user->nama,
                'username'  => $user->username,
                'role'      => $user->role,
                'user'      => $user,
            ]);
            redirect('dashboard');
        } else {
            $this->session->set_flashdata('error', 'Username atau password salah!');
            redirect('login');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }
}
