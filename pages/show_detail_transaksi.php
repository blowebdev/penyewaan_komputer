<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Detail Transaksi</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
            <h4 class="page-title">Detail Transaksi</h4>
        </div>
    </div>
</div>   
<?php 
$detail_transaksi = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM master_transaksi WHERE kode_transaksi='".$_REQUEST['id']."'"));
// var_dump($detail_transaksi);
?>
<a href="<?php echo $base_url; ?>pages/cetak_struk.php?kode_transaksi=<?php echo $_REQUEST['id']; ?>" class="btn btn-danger">Cetak struk</a>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
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
                                                WHERE a.kode_transaksi='".$_REQUEST['id']."'
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
                                <div class="alert alert-danger">
                                    <label style="font-weight: bold;">Informasi !</label>
                                    <?php if($detail_transaksi['pembayaran']=='transfer') : ?>
                                    <br>
                                    Transaksi hanya dapat dilakukan menggunakan rekening Bank BCA. Kami tidak menerima pembayaran tunai atau metode pembayaran lainnya. Harap pastikan Anda memiliki rekening Bank BCA yang valid untuk melanjutkan transaksi.
                                    <a href="<?php echo $base_url; ?>konfirmasi_pembayaran/<?php echo $detail_transaksi['kode_transaksi']; ?>" class="btn btn-danger">Upload Struk pembayaran</a>
                                    <?php elseif ($detail_transaksi['pembayaran']=='payment') : ?>
                                     <!-- <br> -->
                                      <a href="<?php echo $base_url; ?>konfirmasi_pembayaran/<?php echo $detail_transaksi['kode_transaksi']; ?>" class="btn btn-danger">Upload Struk pembayaran</a><br>
                                    Bayar secara instant dibawah ini...<br>

                                    <a href="<?php echo $_SESSION['link']; ?>" target="_blank" class="btn btn-success">Bayar Sekarang</a>
                                    <?php else : ?>
                                        Anda tidak perlu upload struk pembayaran, karena metode yang anda gunakan adalah cash
                                <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- end card -->

            <div class="row mb-3">
                <div class="col-lg-4">
                    <div>
                        <h4 class="font-15 mb-2">Detail Pengiriman</h4>

                        <div class="card p-2 mb-lg-0">

                            <table class="table table-borderless table-sm mb-0">

                                <tbody>
                                    <tr>
                                        <th colspan="2"><h5 class="font-15 m-0"> <?php echo $detail_transaksi['nama']; ?></h5></th>
                                    </tr>
                                    <tr>
                                        <th scope="row">Alamat</th>
                                        <td>: <?php echo $detail_transaksi['alamat']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Hp </th>
                                        <td>: <?php echo $detail_transaksi['hp']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Wa </th>
                                        <td>: <?php echo $detail_transaksi['hp']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div>
                        <h4 class="font-15 mb-2">Informasi Rekening</h4>

                        <div class="card p-2 mb-lg-0">
                            <table class="table table-borderless table-sm mb-0">

                                <tbody>
                                    <tr>
                                        <th scope="row">Nama </th>
                                        <td>: Nama User</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Bank </th>
                                        <td>: BCA</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Nomor Rekening </th>
                                        <td>: 0100019283</td>
                                    </tr>
                                     <tr>
                                        <th scope="row">Nomor Rekening </th>
                                        <td>: 0100019283</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div>
                        <h4 class="font-15 mb-2">Delivery Info</h4>

                        <div class="card p-2 mb-lg-0">
                            <div class="text-center">
                                <div class="my-2">
                                    <i class="mdi mdi-truck-fast h1 text-muted"></i>
                                </div>
                                <h5><b>UPS Delivery</b></h5>
                                <div class="mt-2 pt-1">
                                    <p class="mb-1"><span class="fw-semibold">Order ID :</span> xxxx048</p>
                                    <p class="mb-0"><span class="fw-semibold">Payment Mode :</span> COD</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>