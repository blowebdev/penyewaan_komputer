 <?php 
 if (!in_array($_SESSION['level'], array('1','2'))) {
    echo  "<br>Maaf halaman tidak bisa di akses";
    exit;
}

?>
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                    <li class="breadcrumb-item active">Barang Dikembalikan</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<?php  if(!empty($_REQUEST['id2'])) : ?>
<div class="card">
    <div class="card-body">
        <div class="text-center">
            <div class="row">
                <div class="col-md-6 col-xl-3">
                    <div class="py-1">
                        <i class="fe-tag font-24"></i>
                        <h3>
                            <?php 
                            $total_barang_disewa = mysqli_num_rows(mysqli_query($conn,"SELECT DISTINCT kode_transaksi, id_produk FROM master_detail_transaksi"));

                            echo $total_barang_disewa;
                            ?>
                        </h3>
                        <p class="text-uppercase mb-1 font-13 fw-medium">Barang Disewa</p>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="py-1">
                        <i class="fe-archive font-24"></i>
                        <h3 class="text-warning">
                            <?php 
                            $total_proses = mysqli_num_rows(mysqli_query($conn,"
                             SELECT o.* FROM ( SELECT a.id as id_detail, DATEDIFF(a.tgl_selesai, a.tgl_pinjam) AS total_hari, IF(NOW() > a.tgl_selesai, 'Perlu dikembalikan', 'Proses') AS status, a.status as status_up FROM `master_detail_transaksi` as a LEFT JOIN master_produk as b ON a.id_produk = b.id ) AS o WHERE o.status='Proses' AND o.status_up<>'SUDAH';
                             "));

                            echo number_format($total_proses);
                            ?>
                        </h3>
                        <p class="text-uppercase mb-1 font-13 fw-medium">Proses</p>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="py-1">
                        <i class="fe-shield font-24"></i>
                        <h3 class="text-success">
                         <?php 
                         $total_kembali = mysqli_num_rows(mysqli_query($conn,"
                           SELECT o.* FROM (
                           SELECT a.id as id_detail, DATEDIFF(a.tgl_selesai, a.tgl_pinjam) AS total_hari, IF(NOW() > a.tgl_selesai, 'Perlu dikembalikan', 'Proses') AS status, a.status as status_up FROM `master_detail_transaksi` as a LEFT JOIN master_produk as b ON a.id_produk = b.id ) AS o
                           WHERE o.status='Perlu dikembalikan' AND o.status_up<>'SUDAH'
                           "));

                         echo number_format($total_kembali);
                         ?>
                     </h3>
                     <p class="text-uppercase mb-1 font-13 fw-medium">Perlu kembali</p>
                 </div>
             </div>
             <div class="col-md-6 col-xl-3">
                <div class="py-1">
                    <i class="fe-dollar-sign font-24"></i>
                    <h3 class="text-danger">
                        <?php 
                        $tot = mysqli_num_rows(mysqli_query($conn,"
                           SELECT o.* FROM (
                           SELECT a.id as id_detail, DATEDIFF(a.tgl_selesai, a.tgl_pinjam) AS total_hari, IF(NOW() > a.tgl_selesai, 'Perlu dikembalikan', 'Proses') AS status, a.status as status_up FROM `master_detail_transaksi` as a LEFT JOIN master_produk as b ON a.id_produk = b.id ) AS o
                           "));

                        echo number_format($tot);
                        ?>
                    </h3>
                    <p class="text-uppercase mb-1 font-13 fw-medium">Total Transaksi</p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php endif; ?>
<?php 
if (isset($_REQUEST['update_lunas'])) {
    $id = $_REQUEST['id_detail'];
    $update = mysqli_query($conn,"UPDATE master_detail_transaksi SET status='".$_REQUEST['status']."', denda='".$_REQUEST['denda']."' WHERE id='".$id."'");
    if ($update) {
        echo '
        <div class="alert alert-success alert-dismissible" role="alert">
        <div class="alert-message">
        <strong>Perhatian !! Data berhasil diupdate</strong>
        </div>
        </div>

        ';
    }else{
        echo '
        <div class="alert alert-danger alert-dismissible" role="alert">
        <div class="alert-message">
        <strong>Perhatian !! Data gagal diupdate</strong>
        </div>
        </div>


        ';
    }
}

?>

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
                        <table id="basic-datatable" class="table table-stripped">
                            <thead class="table-light" style="background-color: #dfe6e9">
                                <tr>
                                    <th width="10%">#</th>
                                    <th width="10%">Tanggal</th>
                                    <th width="10%">Kode Transaksi</th>
                                    <th width="10%">Barang</th>
                                    <th width="10%">Qty</th>
                                    <th width="10%">Tanggal Sewa</th>
                                    <th width="10%">Tanggal Selesai</th>
                                    <th width="10%">Durasi</th>
                                    <th width="10%">+- Hari</th>
                                    <th width="10%">Denda</th>
                                    <th width="10%">Status Pengiriman</th>
                                    <th width="10%">Status Pengembalian</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no = 1;
                                if(!empty($_REQUEST['id'])){
                                    $q = "WHERE a.kode_transaksi='".$_REQUEST['id']."' ";
                                }else{
                                    if(in_array($_SESSION['level'],array('1'))) {

                                        if (isset($_REQUEST['filter_tanggal'])) {
                                          $filtere_tanggal = "WHERE create_at>='".$_REQUEST['tgl_awal']."' AND create_at<='".$_REQUEST['tgl_akhir']."'";
                                        }else{
                                          $filtere_tanggal = "";
                                        }
                                        $q = "".$filtere_tanggal ;
                                    }else{
                                        if (isset($_REQUEST['filter_tanggal'])) {
                                          $filtere_tanggal = "AND create_at>='".$_REQUEST['tgl_awal']."' AND create_at<='".$_REQUEST['tgl_akhir']."'";
                                        }else{
                                          $filtere_tanggal = "";
                                        }
                                        $q = "WHERE a.id_pelanggan='".$_SESSION['id_pelanggan']."' ".$filtere_tanggal;
                                    }
                                }


                                if (isset($_REQUEST['filter_tanggal'])) {
                                  $tgl = "AND v.create_at>='".$_REQUEST['tgl_awal']."' AND v.create_at<='".$_REQUEST['tgl_akhir']."'";
                                }else{
                                  $tgl="";
                                }

                                if($_REQUEST['id']=='item_harus_kembali'){
                                  $trxsql =mysqli_query($conn,"
                                   SELECT v.*, SUM(v.qty) as total FROM (
                                   SELECT 
                                      a.create_at, 
                                      a.kode_transaksi, 
                                      b.nama,  
                                      a.id as id_detail, 
                                      a.qty,  
                                      DATEDIFF(a.tgl_selesai, a.tgl_pinjam) AS total_hari,
                                   IF(NOW() > a.tgl_selesai, 'Perlu dikembalikan', 'Proses') AS status, 
                                   a.status as status_up,
                                   DATEDIFF(NOW(),a.tgl_selesai) AS sisa_hari
                                   FROM `master_detail_transaksi` as a 
                                   LEFT JOIN master_produk as b ON a.id_produk = b.id
                                   ) as v WHERE v.status='Perlu dikembalikan'  AND v.status_up<>'SUDAH' AND v.sisa_hari<>'' ".$tgl." GROUP BY  v.id_detail");
                                }elseif ($_REQUEST['id']=='item_sudah_kembali') {
                                 $trxsql =mysqli_query($conn,"
                                   SELECT v.*, SUM(v.qty) as total FROM (
                                   SELECT 
                                      a.create_at, 
                                      a.kode_transaksi, 
                                      b.nama,  
                                      a.id as id_detail, 
                                      a.qty,  
                                      DATEDIFF(a.tgl_selesai, a.tgl_pinjam) AS total_hari,
                                   IF(NOW() > a.tgl_selesai, 'Perlu dikembalikan', 'Proses') AS status, 
                                   a.status as status_up,
                                   DATEDIFF(NOW(),a.tgl_selesai) AS sisa_hari
                                   FROM `master_detail_transaksi` as a 
                                   LEFT JOIN master_produk as b ON a.id_produk = b.id
                                   ) as v WHERE v.status_up='SUDAH' AND v.sisa_hari<>'' ".$tgl." GROUP BY v.id_detail");
                                }elseif ($_REQUEST['id']=='total_barang_dipinjam') {
                                   $trxsql =mysqli_query($conn,"
                                   SELECT v.*, SUM(v.qty) as total FROM (
                                   SELECT 
                                      a.create_at, 
                                      a.kode_transaksi, 
                                      b.nama,  
                                      a.id as id_detail, 
                                      a.qty,  
                                      DATEDIFF(a.tgl_selesai, a.tgl_pinjam) AS total_hari,
                                   IF(NOW() > a.tgl_selesai, 'Perlu dikembalikan', 'Proses') AS status, 
                                   a.status as status_up,
                                   DATEDIFF(NOW(),a.tgl_selesai) AS sisa_hari
                                   FROM `master_detail_transaksi` as a 
                                   LEFT JOIN master_produk as b ON a.id_produk = b.id
                                   ) as v ");
                                }else{
                                  $trxsql = mysqli_query($conn,"
                                      SELECT a.*, b.*, a.id as id_detail,  DATEDIFF(a.tgl_selesai, a.tgl_pinjam) AS total_hari,
                                      IF(NOW() > a.tgl_selesai, 'Perlu dikembalikan', 'Proses') AS status, a.status as status_up,
                                      DATEDIFF(NOW(),a.tgl_selesai) AS sisa_hari
                                      FROM `master_detail_transaksi` as a 
                                      LEFT JOIN master_produk as b ON a.id_produk = b.id
                                      ".$q."
                                      ");
                                }
                                $total_qty =0;
                                while ($data = mysqli_fetch_array($trxsql)) {
                                if(!empty($data['kode_transaksi'])) :

                                  $cek_tracking= mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM master_tracking_pengiriman WHERE kode_transaksi='".$data['kode_transaksi']."' ORDER BY tanggal DESC"))
                                ?>
                                    <tr>
                                        <td width="1%"><?php echo $no++; ?></td>
                                        <td><?php echo $data['create_at']; ?></td>
                                        <td>#<?php echo $data['kode_transaksi']; ?></td>
                                        <td><?php echo $data['nama']; ?></td>
                                        <td><?php echo "<b>".$data['qty']."</b>"; ?> Item</td>
                                        <td><?php echo hari_tanggal($data['tgl_pinjam']); ?></td>
                                        <td><?php echo hari_tanggal($data['tgl_selesai']); ?></td>
                                        <td><?php echo $data['total_hari']; ?> Hari</td>
                                        <td><?php echo ($data['sisa_hari']<=1) ? "".$data['sisa_hari'] : "+ ".$data['sisa_hari']; ?> Hari</td>
                                        <td><?php echo ($data['sisa_hari']<=1) ? "" : number_format(5000*$data['sisa_hari']); ?></td>
                                        <td>
                                          <?php echo $cek_tracking['status']; ?>
                                        </td>
                                        <td><?php 
                                        if($data['status_up']=='SUDAH'){
                                           echo '<span class="badge badge-success p-1">SUDAH</span>';
                                       }else if($data['status_up']=='SUDAH CUSTOMER'){
                                           echo '<span class="badge badge-warning p-1">SUDAH DIKEMBALIKAN CUSTOMER</span>';
                                       }
                                       else{
                                           echo ($data['sisa_hari']>=1) ? '<span class="badge badge-danger p-1">Perlu Dikembali</span>': '<span class="badge badge-warning p-1">Proses</span>';
                                       }

                                       ?></td>

                                      
                                   </tr>
                                 <?php endif; ?>
                               <?php 
                                $total_qty+=$data['qty'];
                                } ?>
                               <tfoot>
                                 <tr>
                                   <td colspan="4">Total item dipinjam</td>
                                   <td style="font-weight: bold;"><?php echo $total_qty; ?> Item</td>
                                   <td colspan="7"></td>
                                 </tr>
                               </tfoot>
                           </tbody>
                       </table>
                   </div>
               </div>
           </div>
       </div>
   </div>
</div>