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
        	 	<span class="logo-lg-text-light"><img src="data:image/png;base64,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"> Surya <span style="font-size: 11px;">Outdoor</span></span>
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