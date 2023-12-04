<?php
if (@$_SESSION['level']=='1') {
	include 'dashboard.php';
}else{
	if(in_array($_SESSION['level'], array('2'))){
		// include 'produk.php';
		include 'pencarian_tanggal.php';
	}else{
		include 'start_home.php';
	}
}
?>