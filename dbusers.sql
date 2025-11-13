-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2025 at 04:59 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbusers`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaction`
--

CREATE TABLE `detail_transaction` (
  `detail_id` int(11) NOT NULL,
  `id_transaction` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `kuantitas` int(11) NOT NULL,
  `harga_satuan` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) GENERATED ALWAYS AS (`kuantitas` * `harga_satuan`) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `stok` int(11) NOT NULL,
  `expired_date` date NOT NULL,
  `supplier_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `nama`, `kategori`, `harga`, `stok`, `expired_date`, `supplier_id`) VALUES
(1, 'Teh Botol', 'Minuman', 10000.00, 5, '2026-12-31', NULL),
(2, 'Indomie Goreng', 'Makanan Ringan', 3000.00, 50, '2026-12-31', NULL),
(4, 'Champ Stick Nugget', 'Frozen Food', 25000.00, 30, '2025-06-26', NULL),
(5, 'Charm Body Fit Extra Maxi ', 'Peralatan Rumah', 15000.00, 10, '2025-11-29', NULL),
(6, 'Glad 2 Glow Brightening Moisturaizer', 'Skincare', 45000.00, 25, '2028-06-17', NULL),
(7, 'Glad 2 Glow Clay Stick Mask', 'Skincare', 30000.00, 12, '2025-11-28', NULL),
(8, 'Ultramilk Full Cream 250 ml', 'Minuman', 7000.00, 70, '2026-11-13', NULL),
(11, 'rogoyisasi', 'minuman', 100000.00, 999999, '2025-11-29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `nama_supplier` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `nama_supplier`, `email`, `telepon`, `alamat`, `created_at`, `updated_at`) VALUES
(3, 'Syahda Ishmatuka Hijrin', NULL, '+6285649853856', 'Sukabumi, Jawa Barat', '2025-11-12 17:33:59', '2025-11-12 17:33:59'),
(4, 'Resi Ajhari', NULL, '+12389', 'Sukabumi, Jawa Barat', '2025-11-13 07:45:32', '2025-11-13 07:45:44');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id_transaction` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `date_time` datetime DEFAULT current_timestamp(),
  `total` decimal(10,2) NOT NULL,
  `status` enum('Pending','Selesai','Dibatalkan') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `foto`, `email`, `password`, `role`) VALUES
(1, 'Jahid Ganteng', '1763039612_Screenshot 2023-09-30 151022.png', 'jahid@gmail.com', '$2y$10$5Q7szZXrHy1tkC40h6J/9OdKRz95twQcZ6kknnV5t8xctFDFbd78i', 'user'),
(2, 'mughni', NULL, 'mughni@gmail.com', 'admin123', 'admin'),
(3, 'admin', NULL, 'admin@gmail.com', '$2y$10$C0sjg1FQdqTphslE2U9UCeGgOtU7wZ3ohE67LzAVTtYXx3oCufY7K', 'admin'),
(4, 'admin', NULL, 'admin@gmail.com', 'admin123', 'admin'),
(5, 'imal', NULL, 'imal@gmail.com', '$2y$10$0x3npXkdme1gJMVjzQxf/OK8lRzPLHDaa4nEhjmhFRcYlCyWrKtOy', 'user'),
(6, 'nana', '1763020342_Screenshot 2025-02-28 033910.png', 'nana@gmail.com', '$2y$10$IKZNpSCYI7D/5fue4XMX0.NR8YzhvglCcPr8ql2iQuvEzIhnFwXJK', 'user'),
(7, 'nunu', NULL, 'nunu@gmail.com', 'admin123', 'admin'),
(8, 'dina', NULL, 'dina@gmail.com', 'admin123', 'admin'),
(9, 'resi', NULL, 'resi@gmail.com', '$2y$10$r1lhzfSZ1xX72E6voTZMxuDR1XyANZEx0.P3TKXfyorobtRTOuBke', 'user'),
(10, 'Kania', '1763024112_Screenshot (1).png', 'kakan@gmail.com', '$2y$10$hjcRSBhzWoKte5YNEbB3K.rmq1rexiBkQ26s5DMfNNMIL7btFJ8jS', 'user'),
(11, 'Kania', NULL, 'kakan@gmail.com', 'admin123', 'admin'),
(12, 'ugoi', NULL, 'ugoi@gmail.com', 'admin123', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_transaction`
--
ALTER TABLE `detail_transaction`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `id_transaction` (`id_transaction`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_products_supplier` (`supplier_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id_transaction`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_transaction`
--
ALTER TABLE `detail_transaction`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id_transaction` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_transaction`
--
ALTER TABLE `detail_transaction`
  ADD CONSTRAINT `detail_transaction_ibfk_1` FOREIGN KEY (`id_transaction`) REFERENCES `transaction` (`id_transaction`),
  ADD CONSTRAINT `detail_transaction_ibfk_2` FOREIGN KEY (`id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_supplier` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
