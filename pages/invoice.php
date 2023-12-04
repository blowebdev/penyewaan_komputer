<?php 
if (!in_array($_SESSION['level'], array('1','2'))) {
	echo  "<br>Maaf halaman tidak bisa di akses";
	exit;
}
include 'show_detail_transaksi.php';
?>