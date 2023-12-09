<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="../assets/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
	<link href="../assets/css/app.min.css" rel="stylesheet" type="text/css" />
	<script src="../chart/canvasjs.min.js"></script>
	<script type="text/javascript">
		print();
	</script>
</head>
<body>
<?php 
error_reporting(0);
session_start();
include '../config/koneksi.php';
$kode_transaksi = $_REQUEST['kode_transaksi'];
?>

<?php 
$detail_transaksi = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM master_transaksi WHERE kode_transaksi='".$kode_transaksi."'"));
// var_dump($detail_transaksi);
?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
        	 <div class="card-header border-bottom bg-transparent">
        	 	<span class="logo-lg-text-light" style="font-size: 14px; font-weight: bold;">SEWA KOMPUTER</span>
            </div>
            <div class="card-header border-bottom bg-transparent">
                <h5 class="header-title mb-0">Order #<?php echo $detail_transaksi['kode_transaksi']; ?></h5>
            </div>
            <div class="card-body">
                <div>
                    <div class="row">
                        <div class="col-lg-3 col-sm-6">

                            <div class="d-flex mb-2">
                                <div class="me-2 align-self-center">
                                    <i class="ri-hashtag h2 m-0 text-muted"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="mb-1">Kode Transaksi</p>
                                    <h5 class="mt-0">
                                        #<?php echo $detail_transaksi['kode_transaksi']; ?>
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">

                            <div class="d-flex mb-2">
                                <div class="me-2 align-self-center">
                                    <i class="ri-user-2-line h2 m-0 text-muted"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="mb-1">Nama Penyewa</p>
                                    <h5 class="mt-0">
                                        <?php echo $detail_transaksi['nama']; ?>
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">

                            <div class="d-flex mb-2">
                                <div class="me-2 align-self-center">
                                    <i class="ri-calendar-event-line h2 m-0 text-muted"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="mb-1">Tanggal Pesan</p>
                                    <h5 class="mt-0">
                                        <?php echo hari_tanggal($detail_transaksi['created_at']); ?>
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">

                            <div class="d-flex mb-2">
                                <div class="me-2 align-self-center">
                                    <i class="ri-map-pin-time-line h2 m-0 text-muted"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="mb-1">Tracking ID</p>
                                    <h5 class="mt-0">
                                        #<?php echo $detail_transaksi['kode_transaksi']; ?>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-2">
                    <h4 class="header-title mb-3">Detail item yang disewa</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <div>
                                <div class="table-responsive">
                                    <table class="table table-centered border table-nowrap mb-lg-0">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Product</th>
                                                <th>Quantity</th>
                                                <th>Harga</th>
                                                <th>Durasi Sewa</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $trxsql = mysqli_query($conn,"
                                                SELECT a.*, b.*,  DATEDIFF(a.tgl_selesai, a.tgl_pinjam) AS total_hari FROM `master_detail_transaksi` as a 
                                                LEFT JOIN master_produk as b ON a.id_produk = b.id
                                                WHERE a.kode_transaksi='".$kode_transaksi."'
                                                ");
                                            while ($data = mysqli_fetch_array($trxsql)) {
                                                ?>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="me-3">
                                                                <img src="<?php echo $base_url; ?>upload/<?php echo $data['gambar']; ?>" alt="product-img" height="90">
                                                            </div>
                                                            <div class="flex-1">
                                                                <h5 class="m-0"><?php echo $data['nama']; ?></h5>
                                                                <p class="mb-0">Kode barang : #<?php echo $data['id']; ?></p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><?php echo $data['qty']; ?></td>
                                                    <td>Rp. <?php echo number_format($data['harga']); ?></td>
                                                    <td nowrap="" style="vertical-align: top">
                                                        Mulai : <br>
                                                        <i class="fa fa-calendar"></i>
                                                        <b style="font-weight: bold;"><?php echo hari_tanggal($data['tgl_pinjam']); ?></b><br>
                                                        Selesai : <br> <i class="fa fa-calendar"></i> <b style="font-weight: bold;"><?php echo hari_tanggal($data['tgl_selesai']); ?></b><br>
                                                        Total : <br> 
                                                        <b style="font-weight: bold; vertical-align: top">
                                                            <i class="fa fa-clock"></i>
                                                            <?php  echo $data['total_hari']?></b> Hari
                                                        </td>

                                                         <td>Rp. <?php echo number_format($data['total']); ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div>

                                    <div class="table-responsive">
                                        <table class="table table-centered border mb-0">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th colspan="2">Order summary</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row" width="1%" nowrap="">Sub Total :</th>
                                                    <td>Rp. <?php echo number_format($detail_transaksi['total_transaksi']); ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"  width="1%" nowrap="">Biaya pengiriman :</th>
                                                    <td>Rp. <?php echo number_format($detail_transaksi['biaya_kirim']); ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"  width="1%" nowrap="">Total :</th>
                                                    <td>Rp. <?php echo number_format($detail_transaksi['grand_total']); ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <br>
                                <br>
                               
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- end card -->



</body>
</html>