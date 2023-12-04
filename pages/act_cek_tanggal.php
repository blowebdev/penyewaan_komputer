<?php 
error_reporting(0);
session_start();
include '../config/koneksi.php';

$mulai = $_REQUEST['mulai'];
$selesai = $_REQUEST['selesai'];

$sql = "SELECT * FROM master_keranjang_belanja WHERE tanggal_pinjam>='".$mulai."' AND tanggal_selesai<='".$selesai."'";
$sql_tot = mysqli_query($conn,$sql);
$total_cek = mysqli_fetch_array($sql_tot);

if ($) {
	# code...
}
?>