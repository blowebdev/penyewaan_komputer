-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Jul 2023 pada 09.57
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penyewaan_alat`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_detail_transaksi`
--

CREATE TABLE `master_detail_transaksi` (
  `id` int(11) NOT NULL,
  `kode_transaksi` text NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `tgl_pinjam` datetime NOT NULL,
  `tgl_selesai` datetime NOT NULL,
  `durasi` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `create_at` datetime NOT NULL,
  `status` varchar(255) NOT NULL,
  `review` text NOT NULL,
  `denda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_detail_transaksi`
--

INSERT INTO `master_detail_transaksi` (`id`, `kode_transaksi`, `id_produk`, `id_pelanggan`, `harga`, `qty`, `tgl_pinjam`, `tgl_selesai`, `durasi`, `total_harga`, `total`, `create_at`, `status`, `review`, `denda`) VALUES
(25, 'TRX5F5E9FCA', 1, 4, 50000, 10, '2023-06-18 00:00:00', '2023-06-19 08:00:00', 1, 100000, 100000, '2023-06-20 03:14:13', 'SUDAH', '', 20000),
(26, 'TRX60707BA2', 2, 4, 75000, 1, '2023-06-25 21:00:00', '2023-06-24 20:00:00', 1, 75000, 75000, '2023-06-25 15:02:22', 'SUDAH', '', 0),
(27, 'TRX8E0F43B3', 5, 4, 40000, 1, '2023-07-17 16:00:00', '2023-07-18 15:00:00', 1, 40000, 40000, '2023-07-17 10:43:54', 'SUDAH CUSTOMER', '', 0),
(28, 'TRX783D09C1', 2, 4, 75000, 1, '2023-07-17 16:00:00', '2023-07-18 15:00:00', 1, 75000, 75000, '2023-07-17 10:53:58', 'PROSES', '', 0),
(29, 'TRX643BCCCD', 3, 4, 100000, 1, '2023-07-17 16:00:00', '2023-07-18 15:00:00', 1, 100000, 100000, '2023-07-17 10:57:10', 'PROSES', '', 0),
(30, 'TRX9D5FCB64', 3, 4, 100000, 1, '2023-07-17 16:00:00', '2023-07-18 15:00:00', 1, 100000, 100000, '2023-07-17 10:59:53', 'PROSES', '', 0),
(31, 'TRX8B4D260B', 3, 4, 100000, 1, '2023-07-17 17:00:00', '2023-07-18 16:00:00', 1, 100000, 100000, '2023-07-17 11:04:56', 'PROSES', '', 0),
(32, 'TRXC230DE0B', 3, 4, 100000, 2, '2023-07-17 17:00:00', '2023-07-18 16:00:00', 1, 200000, 200000, '2023-07-17 11:15:54', 'PROSES', '', 0),
(33, 'TRX63124078', 3, 4, 100000, 1, '2023-07-17 17:00:00', '2023-07-18 16:00:00', 1, 100000, 100000, '2023-07-17 11:16:51', 'PROSES', '', 0),
(34, 'TRX342A3086', 3, 4, 100000, 1, '2023-07-17 17:00:00', '2023-07-18 16:00:00', 1, 100000, 100000, '2023-07-17 11:17:50', 'PROSES', '', 0),
(35, 'TRX6A557A75', 2, 4, 75000, 1, '2023-07-17 17:00:00', '2023-07-18 16:00:00', 1, 75000, 75000, '2023-07-17 11:18:47', 'PROSES', '', 0),
(36, 'TRX8B1E05AC', 2, 4, 75000, 1, '2023-07-19 14:00:00', '2023-07-20 13:00:00', 1, 75000, 75000, '2023-07-19 08:26:13', 'PROSES', '', 0),
(37, 'TRXA975790D', 3, 4, 100000, 1, '2023-07-19 15:00:00', '2023-07-20 14:00:00', 1, 100000, 100000, '2023-07-19 09:49:13', 'PROSES', '', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_isian_review`
--

CREATE TABLE `master_isian_review` (
  `id` int(11) NOT NULL,
  `kode_transaksi` text NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_pertanyaan` int(11) NOT NULL,
  `jawaban` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_isian_review`
--

INSERT INTO `master_isian_review` (`id`, `kode_transaksi`, `id_produk`, `id_pelanggan`, `id_pertanyaan`, `jawaban`) VALUES
(20, 'TRX16987228', 5, 2, 4, 3),
(21, 'TRX16987228', 3, 2, 1, 4),
(22, 'TRX16987228', 3, 2, 2, 2),
(23, 'TRX16987228', 3, 2, 3, 4),
(24, 'TRX16987228', 3, 2, 4, 4),
(25, 'TRX16987228', 2, 2, 1, 4),
(26, 'TRX16987228', 2, 2, 2, 3),
(27, 'TRX16987228', 2, 2, 3, 3),
(28, 'TRX16987228', 2, 2, 4, 4),
(29, 'TRX8D1B99B8', 5, 4, 1, 5),
(30, 'TRX8D1B99B8', 5, 4, 2, 5),
(31, 'TRX8D1B99B8', 5, 4, 3, 5),
(32, 'TRX8D1B99B8', 5, 4, 4, 5),
(33, 'TRXDFD08452', 1, 5, 1, 3),
(34, 'TRXDFD08452', 1, 5, 2, 3),
(35, 'TRXDFD08452', 1, 5, 3, 4),
(36, 'TRXDFD08452', 1, 5, 4, 1),
(37, 'TRXDFD08452', 2, 5, 1, 3),
(38, 'TRXDFD08452', 2, 5, 2, 2),
(39, 'TRXDFD08452', 2, 5, 3, 3),
(40, 'TRXDFD08452', 2, 5, 4, 3),
(41, 'TRX8D1B99B8', 5, 4, 5, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_keranjang_belanja`
--

CREATE TABLE `master_keranjang_belanja` (
  `id` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `harga` int(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `tgl_pinjam` datetime NOT NULL,
  `tgl_selesai` datetime NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_nilai_rekomendasi_review`
--

CREATE TABLE `master_nilai_rekomendasi_review` (
  `id` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama` text NOT NULL,
  `nilai` int(11) NOT NULL,
  `rangking` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_nilai_rekomendasi_review`
--

INSERT INTO `master_nilai_rekomendasi_review` (`id`, `id_produk`, `nama`, `nilai`, `rangking`) VALUES
(40, 5, 'Paket camping ke bromo', 93, 1),
(41, 1, 'Tenda Camping Murah ', 89, 2),
(42, 2, 'Kompor Camping', 78, 3),
(43, 2, 'Kompor Camping', 76, 4),
(44, 5, 'Paket camping ke bromo', 63, 5),
(45, 3, 'Sleeping bag camping', 57, 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_pelanggan`
--

CREATE TABLE `master_pelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `hp` text NOT NULL,
  `email` text NOT NULL,
  `alamat` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_pelanggan`
--

INSERT INTO `master_pelanggan` (`id`, `nama`, `hp`, `email`, `alamat`, `username`, `password`, `status`) VALUES
(4, 'Zeaid', '62847758857676', 'email1@gmail.com', 'Alamat Jombang', 'user1', '202cb962ac59075b964b07152d234b70', ''),
(5, 'Yaqin', '6287866163545', 'email@gmail.com', 'Jombang', 'user2', '202cb962ac59075b964b07152d234b70', ''),
(6, 'nama', '628488586', 'email@gmail.com', 'kskksjsj', 'yaqin', '202cb962ac59075b964b07152d234b70', ''),
(7, 'Muhammad Ali', '62599699797', 'email@gmail.com', 'ALAMAT', 'ahmad', '202cb962ac59075b964b07152d234b70', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_pertanyaan_review`
--

CREATE TABLE `master_pertanyaan_review` (
  `id` int(11) NOT NULL,
  `pertanyaan` text NOT NULL,
  `bobot` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_pertanyaan_review`
--

INSERT INTO `master_pertanyaan_review` (`id`, `pertanyaan`, `bobot`) VALUES
(1, 'Bagaimana kualitas produk ini ?', 10),
(2, 'Bagaimana kualitas produk ini ?', 10),
(3, 'Bagaimana kecepatan pelayanan toko ?', 70),
(4, 'Kondisi barang dan harga sewa apakah sesuai ?', 10),
(5, 'Apakah lokasi toko sangat nyaman dan aman ?', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_produk`
--

CREATE TABLE `master_produk` (
  `id` int(5) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `harga` int(10) NOT NULL,
  `gambar` text NOT NULL,
  `deskripsi` text NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_produk`
--

INSERT INTO `master_produk` (`id`, `nama`, `harga`, `gambar`, `deskripsi`, `stock`) VALUES
(1, 'Tenda Camping Murah ', 50000, '2023-05-22-tenda.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 10),
(2, 'Kompor Camping', 75000, '2023-05-22-kompur.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.	', 10),
(3, 'Sleeping bag camping', 100000, '2023-05-22-e7ffe2326151ed5a522934d4618c9640.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.	  ', 50),
(5, 'Paket camping ke bromo', 40000, '2023-05-23-tenda.jpg', 'I have everything working quite well but I cant seem to get the picker to use the default values that I set in the . There are two inputs, a start date and end date. I have a value=\"\" with a date in both which should be the default date for the datepicker. Then the user has the ability to change those dates.', 10),
(6, 'Paket camping ke jombang', 30000, '2023-05-28-banner_depan2.png', 'Deskripsi', 100);

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_tracking_pengiriman`
--

CREATE TABLE `master_tracking_pengiriman` (
  `id` int(11) NOT NULL,
  `status` text NOT NULL,
  `catatan` text NOT NULL,
  `tanggal` datetime NOT NULL,
  `kode_transaksi` text NOT NULL,
  `nm_pengirim` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_tracking_pengiriman`
--

INSERT INTO `master_tracking_pengiriman` (`id`, `status`, `catatan`, `tanggal`, `kode_transaksi`, `nm_pengirim`) VALUES
(4, 'dikirim', 'catatan', '2023-06-25 15:16:51', 'TRX60707BA2', 'yakin'),
(6, 'Barang sudah diterima', 'catatan', '2023-06-25 15:19:00', 'TRX60707BA2', '-'),
(7, 'dikirim', 'catatan', '2023-07-19 09:52:51', 'TRXA975790D', 'yakin'),
(8, 'Barang sudah diterima', 'barang bagus', '2023-07-19 09:53:30', 'TRXA975790D', '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_transaksi`
--

CREATE TABLE `master_transaksi` (
  `id` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `kode_transaksi` text NOT NULL,
  `total_barang` int(11) NOT NULL,
  `total_transaksi` int(11) NOT NULL,
  `nama` text NOT NULL,
  `hp` text NOT NULL,
  `alamat` text NOT NULL,
  `pengiriman` text NOT NULL,
  `catatan` text NOT NULL,
  `biaya_kirim` int(11) NOT NULL,
  `grand_total` int(11) NOT NULL,
  `pembayaran` text NOT NULL,
  `created_at` datetime NOT NULL,
  `status` text NOT NULL,
  `bank` text NOT NULL,
  `struk` text NOT NULL,
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_transaksi`
--

INSERT INTO `master_transaksi` (`id`, `id_pelanggan`, `kode_transaksi`, `total_barang`, `total_transaksi`, `nama`, `hp`, `alamat`, `pengiriman`, `catatan`, `biaya_kirim`, `grand_total`, `pembayaran`, `created_at`, `status`, `bank`, `struk`, `token`) VALUES
(13, 4, 'TRX5F5E9FCA', 1, 100000, 'Zeaid', '62847758857676', 'Alamat Jombang', 'dikirim', 'Ok', 50000, 150000, 'transfer', '2023-06-20 03:14:12', 'LUNAS', '', '', ''),
(14, 4, 'TRX60707BA2', 1, 75000, 'Zeaid', '62847758857676', 'Alamat Jombang', 'ambil_sendiri', 'Catatan', 0, 75000, 'transfer', '2023-06-25 15:02:21', 'LUNAS', 'BCA', '-kos-kosan-wisma-rosa-544356595.jpg', ''),
(15, 4, 'TRX8E0F43B3', 1, 40000, 'Zeaid', '62847758857676', 'Alamat Jombang', 'dikirim', 'Ok', 50000, 90000, 'cash', '2023-07-17 10:43:54', 'PROSES', '', '', '7110dead-d129-49f9-84de-16e9e23ab830'),
(16, 4, 'TRX783D09C1', 1, 75000, 'Zeaid', '62847758857676', 'Alamat Jombang', 'dikirim', 'Ok', 50000, 125000, 'transfer', '2023-07-17 10:53:58', 'PROSES', '', '', 'f7bd43fe-e14b-4aff-b798-c0527b4807a4'),
(17, 4, 'TRX643BCCCD', 1, 100000, 'Zeaid', '62847758857676', 'Alamat Jombang', 'dikirim', 'Ok', 50000, 150000, 'cash', '2023-07-17 10:57:10', 'PROSES', '', '', '2040bc2f-b9c6-4862-ae8a-c5d8d5b24348'),
(18, 4, 'TRX9D5FCB64', 1, 100000, 'Zeaid', '62847758857676', 'Alamat Jombang', 'ambil_sendiri', 'Ok', 0, 100000, 'cash', '2023-07-17 10:59:52', 'PROSES', '', '', 'c117e31f-c348-4f3c-972e-a7b68598b47d'),
(19, 4, 'TRX8B4D260B', 1, 100000, 'Zeaid', '62847758857676', 'Alamat Jombang', 'ambil_sendiri', 'Ok', 0, 100000, 'transfer', '2023-07-17 11:04:56', 'PROSES', '', '', '821294b8-7578-47a9-a5ce-6b50697203a8'),
(20, 4, 'TRXC230DE0B', 1, 200000, 'Zeaid', '62847758857676', 'Alamat Jombang', 'ambil_sendiri', 'Ok', 0, 200000, 'cash', '2023-07-17 11:15:54', 'PROSES', '', '', ''),
(21, 4, 'TRX63124078', 1, 100000, 'Zeaid', '62847758857676', 'Alamat Jombang', 'dikirim', 'Ok', 50000, 150000, 'cash', '2023-07-17 11:16:51', 'PROSES', '', '', ''),
(22, 4, 'TRX342A3086', 1, 100000, 'Zeaid', '62847758857676', 'Alamat Jombang', 'dikirim', 'Ok', 50000, 150000, 'transfer', '2023-07-17 11:17:50', 'PROSES', '', '', '101ba530-7c62-4ea3-a7fb-f793ebeb796a'),
(23, 4, 'TRX6A557A75', 1, 75000, 'Zeaid', '62847758857676', 'Alamat Jombang', 'dikirim', 'Ok', 50000, 125000, 'transfer', '2023-07-17 11:18:47', 'PROSES', '', '', '3ea04656-8430-49a2-97a6-80abc2e6a5b8'),
(24, 4, 'TRX8B1E05AC', 1, 75000, 'Zeaid', '62847758857676', 'Alamat Jombang', 'dikirim', 'Catatan', 50000, 125000, 'transfer', '2023-07-19 08:26:13', 'PROSES', 'BNI', '-marker-icon.png', '01e88b73-e9e5-4ab9-8161-9967508703c8'),
(25, 4, 'TRXA975790D', 1, 100000, 'Zeaid', '62847758857676', 'Alamat Jombang', 'dikirim', 'Mohon dikonfirmasi', 50000, 150000, 'transfer', '2023-07-19 09:49:12', 'LUNAS', 'BRI', '-marker-shadow.png', 'eabef81e-cd48-4d7d-b6da-fff770902bd0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_user`
--

CREATE TABLE `master_user` (
  `user_id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` enum('1','2') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `master_user`
--

INSERT INTO `master_user` (`user_id`, `nama`, `username`, `password`, `level`) VALUES
(4, 'Toko Penyewaan', 'admin', '21232f297a57a5a743894a0e4a801fc3', '1');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `master_detail_transaksi`
--
ALTER TABLE `master_detail_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `master_isian_review`
--
ALTER TABLE `master_isian_review`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `master_keranjang_belanja`
--
ALTER TABLE `master_keranjang_belanja`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `master_nilai_rekomendasi_review`
--
ALTER TABLE `master_nilai_rekomendasi_review`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `master_pelanggan`
--
ALTER TABLE `master_pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `master_pertanyaan_review`
--
ALTER TABLE `master_pertanyaan_review`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `master_produk`
--
ALTER TABLE `master_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `master_tracking_pengiriman`
--
ALTER TABLE `master_tracking_pengiriman`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `master_transaksi`
--
ALTER TABLE `master_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `master_user`
--
ALTER TABLE `master_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `master_detail_transaksi`
--
ALTER TABLE `master_detail_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `master_isian_review`
--
ALTER TABLE `master_isian_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `master_keranjang_belanja`
--
ALTER TABLE `master_keranjang_belanja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT untuk tabel `master_nilai_rekomendasi_review`
--
ALTER TABLE `master_nilai_rekomendasi_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT untuk tabel `master_pelanggan`
--
ALTER TABLE `master_pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `master_pertanyaan_review`
--
ALTER TABLE `master_pertanyaan_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `master_produk`
--
ALTER TABLE `master_produk`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `master_tracking_pengiriman`
--
ALTER TABLE `master_tracking_pengiriman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `master_transaksi`
--
ALTER TABLE `master_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
