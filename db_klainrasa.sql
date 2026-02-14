-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2026 at 01:50 AM
-- Server version: 10.4.32-MariaDB-log
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_klainrasa`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin123'),
(2, 'admin', 'admin123'),
(3, 'admin', 'admin123'),
(4, 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `nama_produk` varchar(100) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `gambar` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `nama_produk`, `harga`, `deskripsi`, `gambar`) VALUES
(1, 'Hot Americano', 25000, 'Kopi hitam murni dari biji pilihan.', 'produk3.png'),
(2, 'Cookies n Cream', 30000, 'Minuman manis dengan taburan biskuit.', 'produk1.png'),
(3, 'Es Kopi Aren Premium', 22000, 'Kesegaran Kopi Espresso Murni dengan Manis Gula Aren Alami', 'produk5.png'),
(4, 'Blue Ocean', 18000, 'Kesegaran Air Kelapa Berkarbonasi dengan Nata de Coco', 'produk9.PNG'),
(5, 'Strawberry Milkshake', 15000, 'Sensasi Susu Murni dan Jus Buah Strawberry yang menyatu', 'produk6.PNG'),
(6, 'Chicken Black Pepper', 32000, 'Ayam dengan bumbu Lada hitam yang menggugah selera', 'produk7.png'),
(7, 'Millenial Burger', 21000, 'Burger Kekinian dengan rasa khas Nusantara', 'produk8.png'),
(8, 'Mie Kuah Spesial', 16000, 'Perpaduan Mie dengan Kuah kaldu ayam ', 'produk10.png');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status_peran` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `email`, `password`, `status_peran`) VALUES
(9, 'Rina', 'rina@email.com', 'rina', NULL),
(11, '', '', '$2y$10$N3XeV3VDUhzvz3PZ.tf1iucFhAcCcjKl1NWP7jyBDUwLOduDXNjWS', NULL),
(17, 'reza', 'reza@email.com', 'reza2025', NULL),
(18, 'Sunah', 'sunah@email.com', 'sunah88', NULL),
(19, 'yudi', 'yudi@gmail.com', 'yudiklainrasa', NULL),
(20, 'jono', 'jono@gmail.com', 'jono121212', NULL),
(21, 'edson', 'edson@gmail.com', 'gigih123', NULL),
(22, 'Sonny', 'sonny@gmail.com', 'sonny123', NULL),
(23, 'yussi', 'yuss@gmail.com', 'yuss890', NULL),
(24, 'Neymar', 'ney@gmail.com', 'neyney', NULL),
(25, 'reza', 'reza@gmail.com', 'reza123', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `statistik`
--

CREATE TABLE `statistik` (
  `id` int(11) NOT NULL,
  `hits` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `statistik`
--

INSERT INTO `statistik` (`id`, `hits`) VALUES
(1, 317);

-- --------------------------------------------------------

--
-- Table structure for table `testimoni`
--

CREATE TABLE `testimoni` (
  `id` int(11) NOT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `isi_ulasan` text DEFAULT NULL,
  `tanggal_posting` datetime DEFAULT current_timestamp(),
  `status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ulasan`
--

CREATE TABLE `ulasan` (
  `id` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(100) DEFAULT NULL,
  `isi_ulasan` text NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','approved') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ulasan`
--

INSERT INTO `ulasan` (`id`, `id_pelanggan`, `nama_pelanggan`, `isi_ulasan`, `tanggal`, `status`) VALUES
(2, 18, 'Sunah', '\"Nggak lengkap rasanya kalau ke Klainrasa tapi nggak pesan Butter Croissant-nya. Lapisan luarnya sangat flaky dan renyah, tapi bagian dalamnya tetap lembut dan terasa sekali butter-nya. Pas banget dipadukan dengan Cappuccino hangat yang punya foam tebal dan lembut. Tempatnya juga sangat nyaman untuk hangout.\"', '2025-12-23 17:29:25', 'approved'),
(3, 17, 'reza', '\"Buat yang suka sensasi rasa unik, kalian wajib coba Sea Salt Caramel Cold Brew. Ada perpaduan rasa pahit kopi yang diinfus dingin dengan sentuhan asin-manis dari karamelnya. Segar banget diminum siang-siang saat cuaca panas. Pelayanannya juga cepat dan barista-nya sangat ramah dalam menjelaskan menu.\"', '2025-12-23 17:31:24', 'approved'),
(7, 19, 'yudi', 'kopinya enak', '2025-12-24 00:31:25', 'approved'),
(10, 0, 'jono', '\"Jujur, Gula Aren Latte di sini salah satu yang terbaik yang pernah saya coba. Perpaduan espresso dan gula arennya sangat seimbang—tidak terlalu manis sampai menutupi rasa kopinya. Teksturnya sangat creamy tapi tetap terasa ringan di mulut. Cocok sekali jadi teman kerja di sore hari. Sangat direkomendasikan!\"', '2025-12-29 17:00:00', 'approved'),
(11, 0, 'Sonny', 'Chicken Black Pepper-nya enak banget sumpah, ladanya berasa nendang, dan ayamnya lembut banget. Apalagi bummbunya meresap sampai ke dalam. pokoknya harus coba deh', '2025-12-29 17:00:00', 'approved'),
(12, 0, 'yussi', 'Millenial Burgernya kena banget, sesuai sama lidah orang indo, sausnya balance. pokoknya recommended banget', '2025-12-29 17:00:00', 'approved'),
(13, 0, 'Neymar', 'Mie Kuah spesialnya enak.', '2025-12-30 17:00:00', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `statistik`
--
ALTER TABLE `statistik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimoni`
--
ALTER TABLE `testimoni`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `testimoni`
--
ALTER TABLE `testimoni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `testimoni`
--
ALTER TABLE `testimoni`
  ADD CONSTRAINT `testimoni_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
