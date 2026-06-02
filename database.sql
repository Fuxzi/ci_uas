-- ============================================
-- DATABASE: sales_order
-- PT Maju Jaya - Sales Order System
-- ============================================

CREATE DATABASE IF NOT EXISTS sales_order CHARACTER SET utf8 COLLATE utf8_general_ci;
USE sales_order;

-- Tabel Users (Admin, Sales, Manager)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'sales', 'manager') NOT NULL DEFAULT 'sales',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel Pelanggan
CREATE TABLE pelanggan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    alamat TEXT,
    no_telepon VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel Produk
CREATE TABLE produk (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_produk VARCHAR(20) NOT NULL UNIQUE,
    nama_produk VARCHAR(100) NOT NULL,
    harga DECIMAL(15,2) NOT NULL DEFAULT 0,
    stok INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel Sales Order (Header)
CREATE TABLE sales_order (
    id INT AUTO_INCREMENT PRIMARY KEY,
    no_order VARCHAR(30) NOT NULL UNIQUE,
    id_pelanggan INT NOT NULL,
    id_sales INT NOT NULL,
    tanggal DATE NOT NULL,
    total_harga DECIMAL(15,2) DEFAULT 0,
    status ENUM('draft','dikirim','selesai','dibatalkan') DEFAULT 'draft',
    catatan TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_pelanggan) REFERENCES pelanggan(id),
    FOREIGN KEY (id_sales) REFERENCES users(id)
);

-- Tabel Sales Order Detail (Items)
CREATE TABLE sales_order_detail (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_order INT NOT NULL,
    id_produk INT NOT NULL,
    jumlah INT NOT NULL,
    harga_satuan DECIMAL(15,2) NOT NULL,
    subtotal DECIMAL(15,2) NOT NULL,
    FOREIGN KEY (id_order) REFERENCES sales_order(id) ON DELETE CASCADE,
    FOREIGN KEY (id_produk) REFERENCES produk(id)
);

-- ============================================
-- DATA AWAL (SEED)
-- ============================================

-- Password: admin123 (bcrypt hash)
INSERT INTO users (nama, username, password, role) VALUES
('Administrator', 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin'),
('Budi Sales', 'budi', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'sales'),
('Manager Andi', 'manager', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'manager');

-- Pelanggan
INSERT INTO pelanggan (nama, alamat, no_telepon) VALUES
('Toko Elektronik Sejahtera', 'Jl. Pahlawan No. 10, Jakarta', '021-5551234'),
('CV Berkah Mandiri', 'Jl. Merdeka No. 25, Bandung', '022-5559876'),
('PT Sumber Rezeki', 'Jl. Sudirman No. 5, Surabaya', '031-5554321');

-- Produk
INSERT INTO produk (kode_produk, nama_produk, harga, stok) VALUES
('ELK-001', 'Televisi LED 32 inch', 2500000.00, 50),
('ELK-002', 'Kulkas 2 Pintu 350L', 4500000.00, 30),
('ELK-003', 'Mesin Cuci 8kg Front Loading', 3800000.00, 25),
('ELK-004', 'AC 1 PK Split', 3200000.00, 40),
('ELK-005', 'Laptop Core i5 8GB', 8500000.00, 15);
