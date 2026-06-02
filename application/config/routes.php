<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Auth
$route['login']  = 'auth/login';
$route['logout'] = 'auth/logout';

// Dashboard
$route['dashboard'] = 'dashboard/index';

// Produk
$route['produk']              = 'produk/index';
$route['produk/tambah']       = 'produk/tambah';
$route['produk/simpan']       = 'produk/simpan';
$route['produk/edit/(:num)']  = 'produk/edit/$1';
$route['produk/update/(:num)']= 'produk/update/$1';
$route['produk/hapus/(:num)'] = 'produk/hapus/$1';

// Pelanggan
$route['pelanggan']                = 'pelanggan/index';
$route['pelanggan/tambah']         = 'pelanggan/tambah';
$route['pelanggan/simpan']         = 'pelanggan/simpan';
$route['pelanggan/edit/(:num)']    = 'pelanggan/edit/$1';
$route['pelanggan/update/(:num)']  = 'pelanggan/update/$1';
$route['pelanggan/hapus/(:num)']   = 'pelanggan/hapus/$1';

// Sales Order
$route['order']                    = 'order/index';
$route['order/buat']               = 'order/buat';
$route['order/simpan']             = 'order/simpan';
$route['order/detail/(:num)']      = 'order/detail/$1';
$route['order/ubah_status/(:num)'] = 'order/ubah_status/$1';
