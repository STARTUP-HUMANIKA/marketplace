-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2022 at 06:54 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bumdes`
--

-- --------------------------------------------------------

--
-- Table structure for table `bumdes`
--

CREATE TABLE `bumdes` (
  `id_bumdes` int(11) NOT NULL,
  `nama` varchar(165) NOT NULL,
  `email` varchar(125) NOT NULL,
  `password` varchar(256) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(16) NOT NULL,
  `foto` varchar(256) NOT NULL,
  `tanggal_buat` datetime NOT NULL,
  `tanggal_ubah` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bumdes`
--

INSERT INTO `bumdes` (`id_bumdes`, `nama`, `email`, `password`, `alamat`, `telp`, `foto`, `tanggal_buat`, `tanggal_ubah`) VALUES
(1, 'Bumdes Klungkung', 'Jono@No.Yes', 'AioouuyeiaceaEas', 'Jl. in aja dulu', '08997999', 'tes.png', '2022-01-20 02:31:39', '2022-01-20 02:31:53'),
(2, 'Bumdes Klungkung', 'Jono@No.Yes', 'AioouuyeiaceaEas', 'Jl. in aja dulu', '08997999', 'tes.png', '2022-01-20 07:39:48', '2022-01-20 07:39:49'),
(4, 'Bumdes Patrang', 'patrang@bumdes.id', 'QQAioouuyeiaceaEas', 'Jl. in aja dulu', '08878797999', 'tosa.png', '2022-01-20 10:33:29', '2022-01-20 10:33:31');

-- --------------------------------------------------------

--
-- Table structure for table `chatting`
--

CREATE TABLE `chatting` (
  `id_chatting` int(11) NOT NULL,
  `pesan_dari` int(11) NOT NULL,
  `pesan_ke` int(11) NOT NULL,
  `isi_pesan` text NOT NULL,
  `tanggal_buat` datetime NOT NULL,
  `tanggal_ubah` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `id_detail_pesanan` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` tinyint(4) NOT NULL,
  `harga_jual` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`id_detail_pesanan`, `id_pesanan`, `id_produk`, `jumlah`, `harga_jual`) VALUES
(1, 1, 1, 5, 19000);

-- --------------------------------------------------------

--
-- Table structure for table `foto_produk`
--

CREATE TABLE `foto_produk` (
  `id_foto_produk` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `foto` varchar(256) NOT NULL,
  `tanggal_buat` datetime NOT NULL,
  `tanggal_ubah` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `foto_produk`
--

INSERT INTO `foto_produk` (`id_foto_produk`, `id_produk`, `foto`, `tanggal_buat`, `tanggal_ubah`) VALUES
(1, 1, 'jojo.png', '2022-02-11 06:36:39', '2022-02-11 05:36:53'),
(2, 1, 'rujiks.jpeg', '2022-02-11 06:36:57', '2022-02-11 05:37:10');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(256) NOT NULL,
  `tanggal_buat` datetime NOT NULL,
  `tanggal_ubah` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `tanggal_buat`, `tanggal_ubah`) VALUES
(1, 'Produk', '2022-01-20 13:20:16', '2022-01-20 13:20:16'),
(2, 'Wisata', '2022-01-20 13:20:35', '2022-01-20 13:20:35'),
(3, 'Pemberdayaan', '2022-01-20 13:20:43', '2022-01-20 13:20:43');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(165) NOT NULL,
  `email` varchar(125) NOT NULL,
  `password` varchar(256) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(16) NOT NULL,
  `foto` text NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('pria','wanita') NOT NULL,
  `tanggal_buat` datetime NOT NULL,
  `tanggal_ubah` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `email`, `password`, `alamat`, `telp`, `foto`, `tanggal_lahir`, `jenis_kelamin`, `tanggal_buat`, `tanggal_ubah`) VALUES
(1, 'Tonoy Senior', 'tono@gmail.com', '$2y$10$DyTOHZ7gakfGTTLLRkRbBONMz1AUTXmQaoyfnX.8PdgxoYi6Uasby', 'Jl. Silicon Valley', '082349898', 'spark.png', '2022-02-22', 'pria', '2022-01-20 16:43:45', '2022-02-14 07:17:46');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `kode_pesanan` varchar(16) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `status_pesanan` enum('Keranjang','Belum Bayar','Dikemas','Dikirim','Diterima','Ditolak','Dibatalkan','Pengembalian') NOT NULL,
  `tanggal_pesanan` datetime NOT NULL,
  `alamat_pengiriman` text NOT NULL,
  `harga_ongkir` int(16) NOT NULL,
  `ekspedisi` varchar(125) NOT NULL,
  `total_biaya` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `kode_pesanan`, `id_pelanggan`, `status_pesanan`, `tanggal_pesanan`, `alamat_pengiriman`, `harga_ongkir`, `ekspedisi`, `total_biaya`) VALUES
(1, 'hZzUk5MvlEcNMK9B', 1, 'Dikemas', '2022-01-21 03:25:27', 'Jl. Slamet Riyadi Dwie Sasongko No. 234', 10000, 'J&T', 95000),
(2, 'L6pD2nwA6JhNSi2n', 1, 'Belum Bayar', '2022-01-21 03:35:30', 'Jl. Slamet Riyadi Dwi Sasongko No. 234', 10000, 'J&T', 95000);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_umkm` int(11) NOT NULL,
  `id_sub_kategori` int(11) NOT NULL,
  `nama_produk` varchar(256) NOT NULL,
  `harga_produk` int(16) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggal_buat` datetime NOT NULL,
  `tanggal_ubah` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_umkm`, `id_sub_kategori`, `nama_produk`, `harga_produk`, `deskripsi`, `tanggal_buat`, `tanggal_ubah`) VALUES
(1, 1, 1, 'Rujak Cingur Asoy', 19000, 'Wenak Tenan Cuyyyyy, Gk ada obats', '2022-01-21 02:38:32', '2022-01-21 02:47:17'),
(3, 1, 1, 'Cilok Jawa', 5000, 'Weanak Tenan', '2022-02-12 09:08:58', '2022-02-12 08:10:17'),
(4, 4, 3, 'Dance EXO', 200000, 'Joget Joget Doangs', '2022-02-12 09:08:58', '2022-02-12 08:10:17'),
(5, 2, 2, 'Nanggelan', 46000, 'Parkir, Makanan Ringan', '2022-02-12 09:11:08', '2022-02-12 08:12:58'),
(6, 2, 1, 'Ikan Pari Asap', 37000, 'Siap Santap', '2022-02-12 09:11:08', '2022-02-12 08:12:58');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id_rating` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `catatan` text NOT NULL,
  `tanggal_buat` datetime NOT NULL,
  `tanggal_ubah` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`id_rating`, `id_pelanggan`, `id_produk`, `rating`, `catatan`, `tanggal_buat`, `tanggal_ubah`) VALUES
(1, 1, 1, 5, 'Enak & Pedasnya Nuampoll', '2022-01-21 05:21:23', '2022-01-21 05:21:25'),
(2, 1, 1, 3, 'Enak & Pedasnya Paling Nuampoll', '2022-01-21 05:21:29', '2022-01-21 05:22:18'),
(5, 1, 1, 5, 'Woahhh rasanya kek mau meninggoy', '2022-02-11 06:59:20', '2022-02-11 06:59:21');

-- --------------------------------------------------------

--
-- Table structure for table `sub_kategori`
--

CREATE TABLE `sub_kategori` (
  `id_sub_kategori` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_sub_kategori` varchar(256) NOT NULL,
  `tanggal_buat` datetime NOT NULL,
  `tanggal_ubah` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_kategori`
--

INSERT INTO `sub_kategori` (`id_sub_kategori`, `id_kategori`, `nama_sub_kategori`, `tanggal_buat`, `tanggal_ubah`) VALUES
(1, 1, 'Makanan', '2022-01-20 13:45:40', '2022-01-20 13:45:40'),
(2, 2, 'Wisata', '2022-01-20 13:51:41', '2022-01-20 13:51:42'),
(3, 3, 'Pelatihan', '2022-01-20 13:46:16', '2022-01-20 13:48:07');

-- --------------------------------------------------------

--
-- Table structure for table `umkm`
--

CREATE TABLE `umkm` (
  `id_umkm` int(11) NOT NULL,
  `id_bumdes` int(11) NOT NULL,
  `nama` varchar(165) NOT NULL,
  `username` varchar(125) NOT NULL,
  `password` varchar(256) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(16) NOT NULL,
  `foto` text NOT NULL,
  `tanggal_buat` datetime NOT NULL,
  `tanggal_ubah` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `umkm`
--

INSERT INTO `umkm` (`id_umkm`, `id_bumdes`, `nama`, `username`, `password`, `alamat`, `telp`, `foto`, `tanggal_buat`, `tanggal_ubah`) VALUES
(1, 4, 'Patrang Jaya', 'patrangjaya', '$2y$10$2KqDKr5cHsRbZzfGWjGFve81LI0NdQG9VIMI1o24khgOLAdz4hGoe', 'Jl. Sama Kamu', '0856797999', 'patrangJoyo.png', '2022-01-20 11:57:01', '2022-01-20 12:30:18'),
(2, 4, 'Sumber Jaya', 'youbetter', '$2y$10$M4hMTQeKlPcvN/r924TCi.laE0bt5tPeEkHMQXd45GXZfSo057YRa', 'Jl. Dji Sam Soe No. 234', '082299900065', 'youbetter.png', '2022-01-20 12:26:28', '2022-02-12 08:13:26'),
(4, 2, 'Toko Klontong', 'mamencuy', '$2y$10$YjgZwAxbwiLYwwCSRBD2zOUaUM7HKGpsuD4plYDPeMe9QzC.8Xl26', 'Jl. Dji Sam Soe No. 234', '082299900065', 'youbetter.png', '2022-01-20 12:44:24', '2022-02-12 08:14:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bumdes`
--
ALTER TABLE `bumdes`
  ADD PRIMARY KEY (`id_bumdes`);

--
-- Indexes for table `chatting`
--
ALTER TABLE `chatting`
  ADD PRIMARY KEY (`id_chatting`);

--
-- Indexes for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD PRIMARY KEY (`id_detail_pesanan`),
  ADD KEY `relation_id_pesanan_to_detail_pesanan` (`id_pesanan`),
  ADD KEY `relation_id_produk_id_to_detail_pesanan` (`id_produk`);

--
-- Indexes for table `foto_produk`
--
ALTER TABLE `foto_produk`
  ADD PRIMARY KEY (`id_foto_produk`),
  ADD KEY `relation_foto_produk` (`id_produk`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `realation_id_pelanggan_to_rating` (`id_pelanggan`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `relation_produk` (`id_sub_kategori`),
  ADD KEY `id_umkm` (`id_umkm`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id_rating`),
  ADD KEY `relation_id_produk_to_rating` (`id_produk`),
  ADD KEY `relation_id_pelanggan_to_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `sub_kategori`
--
ALTER TABLE `sub_kategori`
  ADD PRIMARY KEY (`id_sub_kategori`),
  ADD KEY `realation_kategori_to_sub_kategori` (`id_kategori`);

--
-- Indexes for table `umkm`
--
ALTER TABLE `umkm`
  ADD PRIMARY KEY (`id_umkm`),
  ADD KEY `relation_id_bumdes_to_umkm` (`id_bumdes`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bumdes`
--
ALTER TABLE `bumdes`
  MODIFY `id_bumdes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `chatting`
--
ALTER TABLE `chatting`
  MODIFY `id_chatting` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  MODIFY `id_detail_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `foto_produk`
--
ALTER TABLE `foto_produk`
  MODIFY `id_foto_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id_rating` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sub_kategori`
--
ALTER TABLE `sub_kategori`
  MODIFY `id_sub_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `umkm`
--
ALTER TABLE `umkm`
  MODIFY `id_umkm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD CONSTRAINT `relation_id_pesanan_to_detail_pesanan` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`),
  ADD CONSTRAINT `relation_id_produk_id_to_detail_pesanan` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Constraints for table `foto_produk`
--
ALTER TABLE `foto_produk`
  ADD CONSTRAINT `relation_foto_produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `realation_id_pelanggan_to_rating` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`);

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_umkm`) REFERENCES `umkm` (`id_umkm`),
  ADD CONSTRAINT `relation_produk` FOREIGN KEY (`id_sub_kategori`) REFERENCES `sub_kategori` (`id_sub_kategori`);

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `relation_id_pelanggan_to_pelanggan` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`),
  ADD CONSTRAINT `relation_id_produk_to_rating` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Constraints for table `sub_kategori`
--
ALTER TABLE `sub_kategori`
  ADD CONSTRAINT `realation_kategori_to_sub_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);

--
-- Constraints for table `umkm`
--
ALTER TABLE `umkm`
  ADD CONSTRAINT `relation_id_bumdes_to_umkm` FOREIGN KEY (`id_bumdes`) REFERENCES `bumdes` (`id_bumdes`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
