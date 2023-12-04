<?php 
error_reporting(0);
session_start();
include '../config/koneksi.php';

$id_pelanggan = $_SESSION['id_pelanggan'];
$qty = $_REQUEST['qty'];
$id = $_POST['id'];
$durasi = $_POST['durasi'];
$no = 1;

$cart_sql = mysqli_query($conn,"SELECT a.id, a.qty, a.harga FROM master_keranjang_belanja as a
    LEFT JOIN master_produk as b ON a.id_produk = b.id
    WHERE a.id='".$id."'
    ORDER BY a.date_created ASC");
$dt = mysqli_fetch_array($cart_sql);
$update = mysqli_query($conn,"UPDATE master_keranjang_belanja SET qty='".$qty."', total='".$qty*$dt['harga']."' WHERE id='".$id."'");
if ($update) {
    $d = array();
    $hasile = mysqli_query($conn,"SELECT * FROM master_keranjang_belanja");
    while ($dy = mysqli_fetch_array($hasile)) {
        $d[] = [
            'id' =>$dy['id'],
            'harga' =>$dy['harga'],
            'qty' =>$dy['qty'],
            'harga_barang' =>number_format($dy['total']),
            'total' =>number_format($dy['total']*$durasi),
            'sum_total' =>($dy['total']*$durasi)
        ];
    }
    $data ['status'] = 'berhasil';
    $data ['data'] = $d;
}else{
    $data ['status'] = 'gagal';
}
echo json_encode($data);