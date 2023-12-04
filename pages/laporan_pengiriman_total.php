<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                    <li class="breadcrumb-item active">Laporan Pengiriman Total</li>
                </ol>
            </div>
        </div>
    </div>
</div>


<?php if(in_array($_SESSION['level'], array('1'))) :?>
    <div class="row">
      <div class="col-6">
        <div class="card-box">
          <label># Filter Tanggal</label>

          <form action="" method="POST">
            <div class="form-group row">
              <label class="col-sm-6 col-form-label" for="example-date">Tanggal Awal</label>
              <div class="col-sm-10">
                <input class="form-control" type="date" value="<?php echo $_REQUEST['tgl_awal']; ?>" name="tgl_awal" id="example-date">
            </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label" for="example-date">Tanggal Akhir</label>
          <div class="col-sm-10">
            <input class="form-control" type="date" value="<?php echo $_REQUEST['tgl_akhir']; ?>"  name="tgl_akhir" id="example-date">
        </div>
    </div>
    <div class="form-group row">
      <div class="col-sm-10">
        <button class="btn btn-danger" type="submit" name="filter_tanggal">Cari</button>
    </div>
</div>

</form>
</div>
</div>
</div>
<?php endif; ?>

<div class="row">
    <div class="col-12">
        <div class="card-box">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <?php if(!empty($_REQUEST['tgl_akhir'])) : ?>
                            Tanggal awal <?php echo $_REQUEST['tgl_awal']; ?> s/d <?php echo $_REQUEST['tgl_akhir']; ?>
                        <?php endif; ?>
                        <table id="basic-datatable" class="table table-stripped">
                            <thead class="table-light" style="background-color: #dfe6e9">
                                <tr>
                                    <th width="10%">Total Pendapatan + Ongkir</th>
                                    <th width="10%">Total barang dipinjam</th>
                                    <th width="10%">Total Barang belum kembali</th>
                                    <th width="10%">Total barang sudah kembali</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <?php 
                                        if (isset($_REQUEST['filter_tanggal'])) {
                                          $filtere_tanggal = "WHERE create_at>='".$_REQUEST['tgl_awal']."' AND create_at<='".$_REQUEST['tgl_akhir']."'";
                                          }else{
                                              $filtere_tanggal = "";
                                          }

                                      $keuntungan = mysqli_fetch_array(mysqli_query($conn,"SELECT SUM(grand_total) as total FROM master_transaksi
                                        ".$filtere_tanggal."
                                        ")); ?>
                                        <?php $ongkir = mysqli_fetch_array(mysqli_query($conn,"SELECT SUM(biaya_kirim) as total FROM master_transaksi ".$filtere_tanggal."")); ?>

                                        <a href="<?php echo $base_url; ?>transaksi">Rp. <?php echo number_format(($keuntungan['total']+$ongkir['total'])); ?></a>
                                    </td>
                                    <td>
                                        <?php $dipinjam = mysqli_fetch_array(mysqli_query($conn,"SELECT SUM(qty) as total FROM master_detail_transaksi ".$filtere_tanggal."")); ?>
                                        <a href="<?php echo $base_url; ?>item_harus_dikembalikan/total_barang_dipinjam"><?php echo number_format($dipinjam['total']); ?> Item</a></td>
                                    </td>
                                    <td>
                                     <?php $harus_kembali = mysqli_fetch_array(mysqli_query($conn,"
                                         SELECT SUM(v.qty) as total FROM (
                                         SELECT  a.id as id_detail, a.qty,  DATEDIFF(a.tgl_selesai, a.tgl_pinjam) AS total_hari,
                                         IF(NOW() > a.tgl_selesai, 'Perlu dikembalikan', 'Proses') AS status, a.status as status_up,
                                         DATEDIFF(NOW(),a.tgl_selesai) AS sisa_hari
                                         FROM `master_detail_transaksi` as a 
                                         LEFT JOIN master_produk as b ON a.id_produk = b.id
                                         ".$filtere_tanggal."
                                         ) as v WHERE v.status='Perlu dikembalikan'  AND v.status_up<>'SUDAH'
                                         ")); ?>
                                         <a href="<?php echo $base_url; ?>item_harus_dikembalikan/item_harus_kembali"><?php echo number_format($harus_kembali['total']); ?> Item </a>
                                     </td>
                                     <td>
                                       <?php $sudah_kembali = mysqli_fetch_array(mysqli_query($conn,"
                                           SELECT SUM(v.qty) as total FROM (
                                           SELECT  a.id as id_detail, a.qty,  DATEDIFF(a.tgl_selesai, a.tgl_pinjam) AS total_hari,
                                           IF(NOW() > a.tgl_selesai, 'Perlu dikembalikan', 'Proses') AS status, a.status as status_up,
                                           DATEDIFF(NOW(),a.tgl_selesai) AS sisa_hari
                                           FROM `master_detail_transaksi` as a 
                                           ".$filtere_tanggal."
                                           LEFT JOIN master_produk as b ON a.id_produk = b.id
                                           ) as v WHERE v.status_up='SUDAH'
                                           ")); ?>

                                           <a href="<?php echo $base_url; ?>item_harus_dikembalikan/item_sudah_kembali"><?php echo number_format($sudah_kembali['total']); ?> Item </a>
                                       </td>
                                   </tr>
                               </tbody>
                           </table>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>