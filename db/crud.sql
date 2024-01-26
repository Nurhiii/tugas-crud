-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Jan 2024 pada 16.55
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crud-php`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `id_akun` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`id_akun`, `nama`, `username`, `email`, `password`, `level`) VALUES
(1, 'Admin', 'admin', 'admin@gmail.com', '$2y$10$znInT9cEg10hep.O.1pBY.re/OYqqMTAxuJ1RBsnZOqLhfjCO43VC', '1'),
(2, 'Operator Barang', 'opmbarang', 'opmbarang@gmail.com', '$2y$10$EkUKRHbIEazXpxWiJ0pUrOUcNPgjny61lU.2AUzTNC5uEIvntLglG', '2'),
(11, 'Nurhidayatillah', '123456', 'nurhidayatillah@gmail.com', '$2y$10$7QrQeItrcJS/Ut2C4U7FP.TiA5uG8orOMyA25CdKFwMPYnQ0R4bJy', '3'),
(12, 'Arif Fahrudin, S.Kom.,M.TI', 'Dosen', 'dosen@gmail.com', '$2y$10$OGSCi/4zlntPnhxPaCnW/e/47SiGh.0Aa1DNiJfPTzryGYtBUqNSe', '4');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jumlah` varchar(100) NOT NULL,
  `harga` varchar(50) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `nama`, `jumlah`, `harga`, `tanggal`) VALUES
(25, 'Laptop Asus', '20', '2500000', '2024-01-23 14:16:25'),
(36, 'Kabel LAN', '30', '20000', '2024-01-23 11:46:15'),
(37, 'Komputer', '10', '2500000', '2024-01-23 11:45:49'),
(39, 'Proyektor', '4', '100000', '2024-01-23 14:15:50'),
(40, 'Layar Proyektor', '12', '2500000', '2024-01-23 14:16:08'),
(42, 'Headset', '23', '100000', '2024-01-23 15:37:03'),
(43, 'CPU', '16', '2000000', '2024-01-23 15:37:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL,
  `nim` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `prodi` varchar(50) NOT NULL,
  `jk` varchar(10) NOT NULL,
  `agama` varchar(30) NOT NULL,
  `telepon` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`id_mahasiswa`, `nim`, `nama`, `prodi`, `jk`, `agama`, `telepon`, `alamat`, `email`, `foto`) VALUES
(1, '221134', 'Ridzky  Aditya Pratama', 'Teknik Informatika', 'Laki-laki', 'Islam', '0823767678', '<p><em>Medan, Sumatra Utara</em> <strong>20111</strong></p>\r\n', 'ridzky@gmail.com', '65afa6cb5d766_png'),
(16, '229099', 'Maulana Malik Ibrahim', 'Teknik Nuklir', 'Laki-laki', 'Islam', '08901277711', '<p><em>Bandung, Jawa Timur </em><strong>30112</strong></p>\r\n', 'malik@gmail.com', '65afa47edbef0_png'),
(17, '221709', 'Hendra Zainudin Siregar', 'Akuntansi ', 'Laki-laki', 'Kristen', '083132902833', '<p><em>Manado, Sulawesi Utara</em>&nbsp;<strong>40118</strong></p>\r\n', 'hendra12@gmail.com', '65afa40e61ba4_png'),
(19, '221709', 'Samuel Theofilus Manullang', 'Kedokteran ', 'Laki-laki', 'Kristen', '08971156551', '<p><strong>Semarang, Jawa Tengah</strong>&nbsp;<strong>50111</strong></p>\r\n', 'Samuel@gmail.com', '65afa679813da_png'),
(20, '227433', 'Lin Yu Xuan', 'Sastra Inggris ', 'Perempuan', 'Konghucu', '08217779011', '<p><em>Tangerang Selatan, Jakarta </em><strong>22110</strong></p>\r\n', 'lin@gmail.com', '65afcafbef822_png'),
(21, '221145', 'Fatimah Aulia Rahman', 'Sastra Arab ', 'Perempuan', 'Islam', '08715655233', '<p><em>Palembang, Sumatra Selatan</em> <strong>40112</strong></p>\r\n', 'fatimah3@gmail.com', '65afd94c4b6b8_png'),
(22, '223091', 'Hamzah Agung Pratama', 'Teknik Mesin', 'Laki-laki', 'Islam', '08676634211', '<p><em>Samarinda, Kalimantan Timur</em> <strong>22110</strong></p>\r\n', 'hamzah@gmail.com', '65afddb698da6_png'),
(23, '221709', 'Syinthia Inditama Putri', 'Manajemen ', 'Perempuan', 'Hindu', '0899452221', '<p><em>Banjarmasin, Kalimantan Selatan</em> <strong>70112</strong></p>\r\n', 'syinthia@gmail.com', '65afde10b00ef_png'),
(24, '220970', 'Namira Alisya Zahra', 'Farmasi', 'Perempuan', 'Islam', '08613341112', '<p><em>Pangkal Pinang, Bangka Belitung </em><strong>30117</strong></p>\r\n', 'namira@gmail.com', '65afde63c2a94_png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id` int(11) NOT NULL,
  `isi_pengaduan` text NOT NULL,
  `tanggal_pengaduan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengaduan`
--

INSERT INTO `pengaduan` (`id`, `isi_pengaduan`, `tanggal_pengaduan`) VALUES
(4, 'Pelayanan di upg tidak ramah, mohon diperbaiki. terimakasih', '2024-01-23 15:52:13'),
(5, 'Keamanan di upg masih kurang, banyaknya helm yang hilang saat di simpan di parkiran. Mohon segera di tindak lanjuti', '2024-01-23 15:53:48');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`);

--
-- Indeks untuk tabel `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `akun`
--
ALTER TABLE `akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
