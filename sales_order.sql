-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2026 at 01:45 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sales_order`
--

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text DEFAULT NULL,
  `no_telepon` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `alamat`, `no_telepon`, `created_at`) VALUES
(1, 'Toko Elektronik Sejahtera', 'Jl. Pahlawan No. 10, Jakarta', '021-5551234', '2026-06-02 11:52:00'),
(2, 'CV Berkah Mandiri', 'Jl. Merdeka No. 25, Bandung', '022-5559876', '2026-06-02 11:52:00'),
(3, 'PT Sumber Rezeki', 'Jl. Sudirman No. 5, Surabaya', '031-5554321', '2026-06-02 11:52:00'),
(4, 'ttest', 'test', '123145125', '2026-06-15 23:20:49');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `kode_produk` varchar(20) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga` decimal(15,2) NOT NULL DEFAULT 0.00,
  `stok` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `kode_produk`, `nama_produk`, `harga`, `stok`, `created_at`) VALUES
(1, 'ELK-001', 'Televisi LED 32 inch', 2500000.00, 50, '2026-06-02 11:52:00'),
(2, 'ELK-002', 'Kulkas 2 Pintu 350L', 4500000.00, 30, '2026-06-02 11:52:00'),
(3, 'ELK-003', 'Mesin Cuci 8kg Front Loading', 3800000.00, 25, '2026-06-02 11:52:00'),
(4, 'ELK-004', 'AC 1 PK Split', 3200000.00, 40, '2026-06-02 11:52:00'),
(5, 'ELK-005', 'Laptop Core i5 8GB', 8500000.00, 15, '2026-06-02 11:52:00');

-- --------------------------------------------------------

--
-- Table structure for table `sales_order`
--

CREATE TABLE `sales_order` (
  `id` int(11) NOT NULL,
  `no_order` varchar(30) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_sales` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `total_harga` decimal(15,2) DEFAULT 0.00,
  `status` enum('draft','dikirim','selesai','dibatalkan') DEFAULT 'draft',
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales_order`
--

INSERT INTO `sales_order` (`id`, `no_order`, `id_pelanggan`, `id_sales`, `tanggal`, `total_harga`, `status`, `catatan`, `created_at`) VALUES
(1, 'SO-20260602-7DED', 2, 1, '2026-06-02', 5000000.00, 'draft', 'test', '2026-06-02 11:55:20'),
(2, 'SO-20260602-18A2', 2, 1, '2026-06-02', 5000000.00, 'selesai', 'test', '2026-06-02 11:55:20'),
(3, 'SO-20260616-0135', 2, 1, '2026-06-16', 5000000.00, 'dikirim', 'test', '2026-06-15 22:50:44'),
(4, 'SO-20260616-8D7F', 4, 2, '2026-06-16', 17000000.00, 'draft', 'test', '2026-06-15 23:21:34');

-- --------------------------------------------------------

--
-- Table structure for table `sales_order_detail`
--

CREATE TABLE `sales_order_detail` (
  `id` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_satuan` decimal(15,2) NOT NULL,
  `subtotal` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales_order_detail`
--

INSERT INTO `sales_order_detail` (`id`, `id_order`, `id_produk`, `jumlah`, `harga_satuan`, `subtotal`) VALUES
(1, 1, 1, 2, 2500000.00, 5000000.00),
(2, 2, 1, 2, 2500000.00, 5000000.00),
(3, 3, 1, 2, 2500000.00, 5000000.00),
(4, 4, 5, 2, 8500000.00, 17000000.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','sales','manager') NOT NULL DEFAULT 'sales',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'Administrator', 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', '2026-06-02 11:52:00'),
(2, 'Budi Sales', 'budi', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'sales', '2026-06-02 11:52:00'),
(3, 'Manager Andi', 'manager', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'manager', '2026-06-02 11:52:00'),
(4, 'Test Sales', 'testsales', 'password', 'sales', '2026-06-15 23:24:30'),
(5, 'Admin Utama', 'admin01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', '2026-06-15 23:29:28'),
(6, 'Sales One', 'sales01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'sales', '2026-06-15 23:29:28'),
(7, 'Manager Satu', 'manager01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'manager', '2026-06-15 23:29:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_produk` (`kode_produk`);

--
-- Indexes for table `sales_order`
--
ALTER TABLE `sales_order`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_order` (`no_order`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_sales` (`id_sales`);

--
-- Indexes for table `sales_order_detail`
--
ALTER TABLE `sales_order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_order` (`id_order`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sales_order`
--
ALTER TABLE `sales_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sales_order_detail`
--
ALTER TABLE `sales_order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sales_order`
--
ALTER TABLE `sales_order`
  ADD CONSTRAINT `sales_order_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id`),
  ADD CONSTRAINT `sales_order_ibfk_2` FOREIGN KEY (`id_sales`) REFERENCES `users` (`id`);

--
-- Constraints for table `sales_order_detail`
--
ALTER TABLE `sales_order_detail`
  ADD CONSTRAINT `sales_order_detail_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `sales_order` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sales_order_detail_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
