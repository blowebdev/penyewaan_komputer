/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 100427
 Source Host           : localhost:3306
 Source Schema         : penyewaan_komputer

 Target Server Type    : MySQL
 Target Server Version : 100427
 File Encoding         : 65001

 Date: 07/12/2023 15:35:56
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for master_detail_transaksi
-- ----------------------------
DROP TABLE IF EXISTS `master_detail_transaksi`;
CREATE TABLE `master_detail_transaksi`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode_transaksi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_produk` int NOT NULL,
  `id_pelanggan` int NOT NULL,
  `harga` int NOT NULL,
  `qty` int NOT NULL,
  `tgl_pinjam` datetime NOT NULL,
  `tgl_selesai` datetime NOT NULL,
  `durasi` int NOT NULL,
  `total_harga` int NOT NULL,
  `total` int NOT NULL,
  `create_at` datetime NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `review` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `denda` int NOT NULL,
  `catatan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 47 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of master_detail_transaksi
-- ----------------------------
INSERT INTO `master_detail_transaksi` VALUES (46, 'TRX7FA10D9C', 3, 5, 100000, 1, '2023-12-04 18:00:00', '2023-12-05 17:00:00', 1, 100000, 100000, '2023-12-04 11:48:46', 'SUDAH', '', 10000, 'Catatan Kerusakan isi disini ya');

-- ----------------------------
-- Table structure for master_isian_review
-- ----------------------------
DROP TABLE IF EXISTS `master_isian_review`;
CREATE TABLE `master_isian_review`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode_transaksi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_produk` int NOT NULL,
  `id_pelanggan` int NOT NULL,
  `id_pertanyaan` int NOT NULL,
  `jawaban` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 42 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of master_isian_review
-- ----------------------------
INSERT INTO `master_isian_review` VALUES (20, 'TRX16987228', 5, 2, 4, 3);
INSERT INTO `master_isian_review` VALUES (21, 'TRX16987228', 3, 2, 1, 4);
INSERT INTO `master_isian_review` VALUES (22, 'TRX16987228', 3, 2, 2, 2);
INSERT INTO `master_isian_review` VALUES (23, 'TRX16987228', 3, 2, 3, 4);
INSERT INTO `master_isian_review` VALUES (24, 'TRX16987228', 3, 2, 4, 4);
INSERT INTO `master_isian_review` VALUES (25, 'TRX16987228', 2, 2, 1, 4);
INSERT INTO `master_isian_review` VALUES (26, 'TRX16987228', 2, 2, 2, 3);
INSERT INTO `master_isian_review` VALUES (27, 'TRX16987228', 2, 2, 3, 3);
INSERT INTO `master_isian_review` VALUES (28, 'TRX16987228', 2, 2, 4, 4);
INSERT INTO `master_isian_review` VALUES (29, 'TRX8D1B99B8', 5, 4, 1, 5);
INSERT INTO `master_isian_review` VALUES (30, 'TRX8D1B99B8', 5, 4, 2, 5);
INSERT INTO `master_isian_review` VALUES (31, 'TRX8D1B99B8', 5, 4, 3, 5);
INSERT INTO `master_isian_review` VALUES (32, 'TRX8D1B99B8', 5, 4, 4, 5);
INSERT INTO `master_isian_review` VALUES (33, 'TRXDFD08452', 1, 5, 1, 3);
INSERT INTO `master_isian_review` VALUES (34, 'TRXDFD08452', 1, 5, 2, 3);
INSERT INTO `master_isian_review` VALUES (35, 'TRXDFD08452', 1, 5, 3, 4);
INSERT INTO `master_isian_review` VALUES (36, 'TRXDFD08452', 1, 5, 4, 1);
INSERT INTO `master_isian_review` VALUES (37, 'TRXDFD08452', 2, 5, 1, 3);
INSERT INTO `master_isian_review` VALUES (38, 'TRXDFD08452', 2, 5, 2, 2);
INSERT INTO `master_isian_review` VALUES (39, 'TRXDFD08452', 2, 5, 3, 3);
INSERT INTO `master_isian_review` VALUES (40, 'TRXDFD08452', 2, 5, 4, 3);
INSERT INTO `master_isian_review` VALUES (41, 'TRX8D1B99B8', 5, 4, 5, 5);

-- ----------------------------
-- Table structure for master_kategori
-- ----------------------------
DROP TABLE IF EXISTS `master_kategori`;
CREATE TABLE `master_kategori`  (
  `id` int NOT NULL,
  `kategori` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of master_kategori
-- ----------------------------
INSERT INTO `master_kategori` VALUES (0, 'laptop');
INSERT INTO `master_kategori` VALUES (2, 'proyektor');
INSERT INTO `master_kategori` VALUES (3, 'screen proyektor');
INSERT INTO `master_kategori` VALUES (4, 'kamera');
INSERT INTO `master_kategori` VALUES (5, 'tripod kamera');

-- ----------------------------
-- Table structure for master_keranjang_belanja
-- ----------------------------
DROP TABLE IF EXISTS `master_keranjang_belanja`;
CREATE TABLE `master_keranjang_belanja`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_produk` int NOT NULL,
  `id_pelanggan` int NOT NULL,
  `harga` int NOT NULL,
  `qty` int NOT NULL,
  `total` int NOT NULL,
  `tgl_pinjam` datetime NOT NULL,
  `tgl_selesai` datetime NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 96 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of master_keranjang_belanja
-- ----------------------------

-- ----------------------------
-- Table structure for master_nilai_rekomendasi_review
-- ----------------------------
DROP TABLE IF EXISTS `master_nilai_rekomendasi_review`;
CREATE TABLE `master_nilai_rekomendasi_review`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_produk` int NOT NULL,
  `nama` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nilai` int NOT NULL,
  `rangking` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 46 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of master_nilai_rekomendasi_review
-- ----------------------------
INSERT INTO `master_nilai_rekomendasi_review` VALUES (40, 5, 'Paket camping ke bromo', 93, 1);
INSERT INTO `master_nilai_rekomendasi_review` VALUES (41, 1, 'Tenda Camping Murah ', 89, 2);
INSERT INTO `master_nilai_rekomendasi_review` VALUES (42, 2, 'Kompor Camping', 78, 3);
INSERT INTO `master_nilai_rekomendasi_review` VALUES (43, 2, 'Kompor Camping', 76, 4);
INSERT INTO `master_nilai_rekomendasi_review` VALUES (44, 5, 'Paket camping ke bromo', 63, 5);
INSERT INTO `master_nilai_rekomendasi_review` VALUES (45, 3, 'Sleeping bag camping', 57, 6);

-- ----------------------------
-- Table structure for master_pelanggan
-- ----------------------------
DROP TABLE IF EXISTS `master_pelanggan`;
CREATE TABLE `master_pelanggan`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `hp` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of master_pelanggan
-- ----------------------------
INSERT INTO `master_pelanggan` VALUES (4, 'Zeaid', '62847758857676', 'email1@gmail.com', 'Alamat Jombang', 'user1', '202cb962ac59075b964b07152d234b70', '');
INSERT INTO `master_pelanggan` VALUES (5, 'Yaqin', '6287866163545', 'email@gmail.com', 'Jombang', 'user2', '202cb962ac59075b964b07152d234b70', '');
INSERT INTO `master_pelanggan` VALUES (6, 'nama', '628488586', 'email@gmail.com', 'kskksjsj', 'yaqin', '202cb962ac59075b964b07152d234b70', '');
INSERT INTO `master_pelanggan` VALUES (7, 'Muhammad Ali', '62599699797', 'email@gmail.com', 'ALAMAT', 'ahmad', '202cb962ac59075b964b07152d234b70', '');

-- ----------------------------
-- Table structure for master_pertanyaan_review
-- ----------------------------
DROP TABLE IF EXISTS `master_pertanyaan_review`;
CREATE TABLE `master_pertanyaan_review`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `pertanyaan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `bobot` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of master_pertanyaan_review
-- ----------------------------
INSERT INTO `master_pertanyaan_review` VALUES (1, 'Bagaimana kualitas produk ini ?', 10);
INSERT INTO `master_pertanyaan_review` VALUES (2, 'Bagaimana kualitas produk ini ?', 10);
INSERT INTO `master_pertanyaan_review` VALUES (3, 'Bagaimana kecepatan pelayanan toko ?', 70);
INSERT INTO `master_pertanyaan_review` VALUES (4, 'Kondisi barang dan harga sewa apakah sesuai ?', 10);
INSERT INTO `master_pertanyaan_review` VALUES (5, 'Apakah lokasi toko sangat nyaman dan aman ?', 10);

-- ----------------------------
-- Table structure for master_produk
-- ----------------------------
DROP TABLE IF EXISTS `master_produk`;
CREATE TABLE `master_produk`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `harga` int NOT NULL,
  `gambar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `stock` int NOT NULL,
  `kategori` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of master_produk
-- ----------------------------
INSERT INTO `master_produk` VALUES (1, 'Komputer Lenovo', 50000, '2023-05-28-banner_depan2.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 10, 'screen proyektor');
INSERT INTO `master_produk` VALUES (2, 'Komputer Toshiba', 75000, '2023-05-28-banner_depan2.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.	', 10, 'proyektor');
INSERT INTO `master_produk` VALUES (3, 'Komputer Toshiba', 100000, '2023-05-28-banner_depan2.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.	  ', 50, 'laptop');
INSERT INTO `master_produk` VALUES (5, 'Proyektor BENQ', 40000, '2023-05-28-banner_depan2.png', 'I have everything working quite well but I cant seem to get the picker to use the default values that I set in the . There are two inputs, a start date and end date. I have a value=\"\" with a date in both which should be the default date for the datepicker. Then the user has the ability to change those dates.', 10, 'laptop');
INSERT INTO `master_produk` VALUES (6, 'Proyektor BENQ 2', 30000, '2023-05-28-banner_depan2.png', 'Deskripsi', 100, 'laptop');

-- ----------------------------
-- Table structure for master_tracking_pengiriman
-- ----------------------------
DROP TABLE IF EXISTS `master_tracking_pengiriman`;
CREATE TABLE `master_tracking_pengiriman`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `status` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `catatan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal` datetime NOT NULL,
  `kode_transaksi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nm_pengirim` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of master_tracking_pengiriman
-- ----------------------------
INSERT INTO `master_tracking_pengiriman` VALUES (4, 'dikirim', 'catatan', '2023-06-25 15:16:51', 'TRX60707BA2', 'yakin');
INSERT INTO `master_tracking_pengiriman` VALUES (6, 'Barang sudah diterima', 'catatan', '2023-06-25 15:19:00', 'TRX60707BA2', '-');
INSERT INTO `master_tracking_pengiriman` VALUES (7, 'dikirim', 'catatan', '2023-07-19 09:52:51', 'TRXA975790D', 'yakin');
INSERT INTO `master_tracking_pengiriman` VALUES (8, 'Barang sudah diterima', 'barang bagus', '2023-07-19 09:53:30', 'TRXA975790D', '-');
INSERT INTO `master_tracking_pengiriman` VALUES (9, 'Barang sudah diterima', 'ok', '2023-12-07 09:35:16', 'TRX7FA10D9C', '-');

-- ----------------------------
-- Table structure for master_transaksi
-- ----------------------------
DROP TABLE IF EXISTS `master_transaksi`;
CREATE TABLE `master_transaksi`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_pelanggan` int NOT NULL,
  `kode_transaksi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `total_barang` int NOT NULL,
  `total_transaksi` int NOT NULL,
  `nama` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `hp` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pengiriman` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `catatan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `biaya_kirim` int NOT NULL,
  `grand_total` int NOT NULL,
  `pembayaran` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `status` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `bank` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `struk` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `token` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 36 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of master_transaksi
-- ----------------------------
INSERT INTO `master_transaksi` VALUES (35, 5, 'TRX7FA10D9C', 1, 100000, 'Muhammad Ali', '6285748496135', '-', 'ambil_sendiri', '-', 0, 100000, 'cash', '2023-12-04 11:48:46', 'PROSES', '', '', '');

-- ----------------------------
-- Table structure for master_user
-- ----------------------------
DROP TABLE IF EXISTS `master_user`;
CREATE TABLE `master_user`  (
  `user_id` int NOT NULL,
  `nama` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `username` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `level` enum('1','2') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of master_user
-- ----------------------------
INSERT INTO `master_user` VALUES (4, 'Toko Penyewaan', 'admin', '21232f297a57a5a743894a0e4a801fc3', '1');
INSERT INTO `master_user` VALUES (5, 'Pemilik', 'pemilik', '202cb962ac59075b964b07152d234b70', '2');

SET FOREIGN_KEY_CHECKS = 1;
