<?php 
error_reporting(0);
session_start();
include '../config/koneksi.php';

$id_pelanggan = $_SESSION['id_pelanggan'];
$id_produk = $_POST['id'];
$harga = $_POST['harga'];

$cek = mysqli_query($conn,"SELECT DISTINCT id_produk FROM master_keranjang_belanja WHERE id_pelanggan='".$id_pelanggan."'");
$cek_tot = mysqli_num_rows($cek);
$cekhasil = mysqli_fetch_array($cek);
$data['qty'] = $cek_tot;
echo json_encode($data); 
?>