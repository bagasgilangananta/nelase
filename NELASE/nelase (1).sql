-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Des 2020 pada 22.54
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nelase`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `edukasi`
--

CREATE TABLE `edukasi` (
  `id` int(11) NOT NULL,
  `code` varchar(30) NOT NULL,
  `tanggal_input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ikan`
--

CREATE TABLE `ikan` (
  `id` int(11) NOT NULL,
  `id_penjual` int(6) NOT NULL,
  `jenis_ikan` varchar(30) NOT NULL,
  `berat_ikan` decimal(10,0) NOT NULL,
  `harga_ikan` int(20) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `tanggal_input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ikan`
--

INSERT INTO `ikan` (`id`, `id_penjual`, `jenis_ikan`, `berat_ikan`, `harga_ikan`, `alamat`, `tanggal_input`) VALUES
(1, 2, 'Kerapu', '30', 100000000, 'Jl Kalideres', '2020-12-08 16:35:28'),
(2, 3, 'Kerapu', '30', 20000, 'Jl Kunang', '2020-12-08 16:51:45'),
(3, 3, 'Tongkol', '10', 100000, '123', '2020-12-08 17:09:52'),
(4, 2, 'Piranha', '25', 12000, 'Jl Abdi Praja', '2020-12-10 15:56:42'),
(5, 2, 'Laode', '5', 15000, 'L', '2020-12-10 16:15:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `nohp` varchar(30) NOT NULL,
  `rekening` varchar(30) DEFAULT NULL,
  `norek` varchar(30) DEFAULT NULL,
  `peran` enum('nelayan','konsumen') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id`, `username`, `password`, `email`, `nohp`, `rekening`, `norek`, `peran`) VALUES
(1, 'user', 'user', 'user@email.com', '08214512323123', '', '', 'konsumen'),
(2, 'penjual', 'penjual', 'penjual@user.com', '082141239993', 'GOPAY', '082141239993', 'nelayan'),
(3, 'nelayan', 'nelayan', 'nelayan@nelayan.com', '082141231444123', 'OVO', '082141231444123', 'nelayan'),
(4, 'nelayan1', 'nelayan1', 'penjual2@user.com', '08214123123123', 'BCA', '7135291923', 'nelayan'),
(6, 'zeranel', 'zera', 'zeranel@gmail.com', '1234', NULL, NULL, 'konsumen');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `id_pembeli` int(11) NOT NULL,
  `id_penjual` int(11) NOT NULL,
  `id_ikan` int(11) NOT NULL,
  `jumlah` int(10) NOT NULL,
  `total` int(50) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `tanggal_pembelian` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `id_pembeli`, `id_penjual`, `id_ikan`, `jumlah`, `total`, `alamat`, `tanggal_pembelian`) VALUES
(1, 1, 2, 5, 12, 180000, 'Jakal', '2020-12-10 16:25:31'),
(2, 1, 2, 5, 2, 30000, 'Jalan Kaliurang', '2020-12-10 16:26:10'),
(3, 6, 2, 5, 8, 120000, 'Sepinggan', '2020-12-10 16:40:26'),
(4, 6, 2, 4, 5, 60000, 'Jakal', '2020-12-10 16:40:41'),
(5, 1, 0, 5, 35, 525000, 'Jl Lombok', '2020-12-10 21:48:51');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `edukasi`
--
ALTER TABLE `edukasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ikan`
--
ALTER TABLE `ikan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `edukasi`
--
ALTER TABLE `edukasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `ikan`
--
ALTER TABLE `ikan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
