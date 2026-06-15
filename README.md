# Sales Order System - PT Maju Jaya
## CodeIgniter 3.1.13

---

## Struktur Folder

```
sales_order/
├── application/
│   ├── config/
│   │   ├── config.php         ← base_url & session config
│   │   ├── database.php       ← konfigurasi database
│   │   ├── autoload.php       ← library & helper auto-load
│   │   └── routes.php         ← routing URL
│   ├── core/
│   │   └── MY_Controller.php  ← base controller (auth check)
│   ├── controllers/
│   │   ├── Auth.php           ← login/logout
│   │   ├── Dashboard.php      ← halaman utama
│   │   ├── Produk.php         ← CRUD produk (admin only)
│   │   └── Order.php          ← buat & kelola sales order
│   ├── models/
│   │   ├── User_model.php
│   │   ├── Produk_model.php
│   │   ├── Pelanggan_model.php
│   │   └── Order_model.php
│   └── views/
│       ├── auth/login.php
│       ├── layouts/header.php + footer.php
│       ├── dashboard/index.php
│       ├── products/index.php + form.php
│       └── order/index.php + form.php + detail.php
├── .htaccess
└── sales_order.sql               ← import ini dulu
```

---

## Cara Install

### 1. Download CodeIgniter 3.1.13
https://codeigniter.com/download

### 2. Copy file CI ke folder sales_order
Salin isi CI ke dalam folder `sales_order/` di `htdocs` (XAMPP).

### 3. Copy file dari paket ini
Timpa/copy semua file dari folder `application/` ke dalam CI.

### 4. Import Database
Buka phpMyAdmin → Import → pilih file `sales_order.sql`

### 5. Konfigurasi
Edit `application/config/database.php`:
```php
'username' => 'root',
'password' => '',        // ← sesuaikan password MySQL Anda
'database' => 'sales_order',
```

Edit `application/config/config.php`:
```php
$config['base_url'] = 'http://localhost/sales_order/';
```

### 6. Aktifkan mod_rewrite (XAMPP)
Buka `httpd.conf`, pastikan baris ini tidak dikomentari:
```
LoadModule rewrite_module modules/mod_rewrite.so
```

---

## Akun Login (Password: `password`)

| Username | Role    | Akses |
|----------|---------|-------|
| admin    | Admin   | Semua fitur |
| budi     | Sales   | Lihat & buat order miliknya |
| manager  | Manager | Lihat semua, ubah status |

---

## Fitur yang Sudah Ada

- [x] Login & Logout dengan session
- [x] Role-based access (Admin, Sales, Manager)
- [x] Dashboard dengan statistik
- [x] CRUD Produk (Admin)
- [x] Buat Sales Order (Admin & Sales)
- [x] Daftar & Detail Order
- [x] Ubah Status Order (Admin & Manager)
- [x] CRUD Pelanggan
- [x] Laporan & Export PDF
