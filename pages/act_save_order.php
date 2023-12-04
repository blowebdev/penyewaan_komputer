<?php 
namespace Midtrans;

include 'midtrans/Midtrans.php';
// Set Your server key
// Set your Merchant Server Key
\Midtrans\Config::$serverKey = 'Mid-server-eJrFXgJM9xb2lq9zIVjahE1C';
// Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
\Midtrans\Config::$isProduction = true;
// Set sanitization on (default)
\Midtrans\Config::$isSanitized = true;
// Set 3DS transaction for credit card to true
\Midtrans\Config::$is3ds = true;

error_reporting(0);
session_start();
include '../config/koneksi.php';

$id_pelanggan = $_SESSION['id_pelanggan'];
$kode_transaksi = $_REQUEST['kode_transaksi'];
$nama = $_REQUEST['nama'];
$hp =  str_replace('+', '', hp($_REQUEST['hp']));
$alamat = $_REQUEST['alamat'];
$pengiriman = $_REQUEST['pengiriman'];
$pembayaran = $_REQUEST['pembayaran'];
$catatan = $_REQUEST['catatan'];
$biaya_kirim = $_REQUEST['biaya_kirim'];
$total_barang = $_REQUEST['total_barang'];
$grand_total = $_REQUEST['grand_total'];
$total_transaksi = $_REQUEST['total_transaksi'];
$enable_payments = array('other_qris','bni_va','bca', 'bri_va');
$customer_details = array(
	'first_name'    => $nama,
	'last_name'     => $nama,
	'email'         => "test@litani.com",
	'phone'         => $hp,
	'billing_address'  => $alamat,
	'shipping_address' => $alamat
);
$params = array(
	'enabled_payments' => $enable_payments,
	'customer_details' => $customer_details,
	'transaction_details' => array(
		'order_id' => $kode_transaksi,
		'gross_amount' => $grand_total,
	)
);
ob_start();
if($_REQUEST['pembayaran']=='payment') :
	$snapToken = \Midtrans\Snap::getSnapToken($params);
	$paymentUrl = 'https://app.midtrans.com/snap/v2/vtweb/'.$snapToken;
	// $_SESSION['params'] = $params;
	$_SESSION['link'] = $paymentUrl;
endif;


$save_sql = "INSERT INTO `master_transaksi`(
`id_pelanggan`,
`kode_transaksi`,
`total_barang`,
`total_transaksi`,
`nama`,
`hp`,
`alamat`,
`pengiriman`,
`catatan`,
`biaya_kirim`,
`grand_total`,
`pembayaran`,
`created_at`,
`status`,`token`) VALUES (
'".$id_pelanggan."',
'".$kode_transaksi."',
'".$total_barang."',
'".$total_transaksi."',
'".$nama."',
'".$hp."',
'".$alamat."',
'".$pengiriman."',
'".$catatan."',
'".$biaya_kirim."',
'".$grand_total."',
'".$pembayaran."',
'".date('Y-m-d H:i:s')."','PROSES','".$snapToken."')";
$simpan = mysqli_query($conn,$save_sql);
if ($simpan) {
	$produk = "";
	$cart_sql = mysqli_query($conn,"
		SELECT a.*, b.*, a.id as id_keranjang,
		DATEDIFF(a.tgl_selesai, tgl_pinjam) AS total_hari
		FROM master_keranjang_belanja as a
		LEFT JOIN master_produk as b ON a.id_produk = b.id
		WHERE a.id_pelanggan='".$id_pelanggan."'
		ORDER BY a.date_created ASC");
	while ($data = mysqli_fetch_array($cart_sql)) {
		mysqli_query($conn,"DELETE FROM master_keranjang_belanja WHERE id_produk='".$data['id_produk']."' AND id_pelanggan='".$id_pelanggan."'");
		$sql = "
		INSERT INTO `master_detail_transaksi`(
		`kode_transaksi`,
		`id_produk`,
		`id_pelanggan`,
		`harga`,
		`qty`,
		`tgl_pinjam`,
		`tgl_selesai`,
		`durasi`,
		`total_harga`,
		`total`,
		`create_at`,
		`status`) VALUES (
		'".$kode_transaksi."',
		'".$data['id_produk']."',
		'".$id_pelanggan."',
		'".$data['harga']."',
		'".$data['qty']."',
		'".$data['tgl_pinjam']."',
		'".$data['tgl_selesai']."',
		'".$data['total_hari']."',
		'".$data['total']."',
		'".$data['total']*$data['total_hari']."',
		'".date('Y-m-d H:i:s')."','PROSES')
		";
		$simpan_detail = mysqli_query($conn,$sql);

		$produk.="".$data['nama']." @".$data['qty']."  ".$data['total']."*\n";
	}

	$isine ="
	Terimakasih atas ordes penyewaan dengan detail dibawah ini \n
	".$produk." \n Ditunggu orderanya kembali \n Happy rental 😀";

	$data = array(
		'chatId'      => $hp.'@c.us',
		'message'    => $isine,
	);
	$options = array(
		'http' => array(
			'method'  => 'POST',
			'content' => json_encode( $data ),
			'header'=>  "Content-Type: application/json\r\n" .
			"Accept: application/json\r\n"
		)
	);
	$url = "https://ru-api.basis-api.com/waInstance1101000819/sendMessage/8c7b8d6b26d891250cb882937249d2aa5cb3c5c15da36079";
	$context  = stream_context_create( $options );
	$result = file_get_contents( $url, false, $context );
	$response = json_decode( $result);

	echo '
	<div class="alert alert-success alert-dismissible" role="alert">
	<div class="alert-message">
	<strong>Redirect........</strong>
	</div>
	</div>
	';

	if($pembayaran=='transfer'){
		// echo "<a href='".$paymentUrl."' class='btn btn-danger' target='_blank'>Bayar sekarang</a>";
		echo '<meta http-equiv="refresh" content="1; url='.$base_url.'invoice/'.$_REQUEST['kode_transaksi'].'">';
	}else{
		echo '<meta http-equiv="refresh" content="1; url='.$base_url.'invoice/'.$_REQUEST['kode_transaksi'].'">';
	}
	// <meta http-equiv="refresh" target="_blank" content="0; url='.$paymentUrl.'">
}else{
	echo "Error...";
}
ob_end_flush();