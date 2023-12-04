<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Status Pengiriman</a></li>
                    <li class="breadcrumb-item active">Pengiriman</li>
                </ol>
            </div>
        </div>
    </div>
</div>    
<?php 
if (isset($_REQUEST['simpan'])) {
    $status = $_REQUEST['status'];
    $nm_pengirim = $_REQUEST['nm_pengirim'];
    $catatan = $_REQUEST['catatan'];

    $sql = "INSERT INTO master_tracking_pengiriman (status,catatan,tanggal, kode_transaksi,nm_pengirim) VALUES ('".$status."','".$catatan."','".date('Y-m-d H:i:s')."','".$_REQUEST['id']."','".$nm_pengirim."')";
    if (mysqli_query($conn,$sql)) {
        echo "<div class='alert alert-success'>Berhasil disimpan</div>";
    }else{
        echo "<div class='alert alert-danger'>Gagal disimpan</div>";
    }
}

if (isset($_REQUEST['hapus'])) {
    $id_hapus = $_REQUEST['id_hapus'];

    $sql = "DELETE FROM master_tracking_pengiriman WHERE id='".$id_hapus."'";
    if (mysqli_query($conn,$sql)) {
        echo "<div class='alert alert-success'>Berhasil dihapus</div>";
    }else{
        echo "<div class='alert alert-danger'>Gagal dihapus</div>";
    }
}
?>
<div class="row">

    <div class="col-lg-7">
        <!-- Portlet card -->
        <div class="card">
            <div class="card-body">
                <?php if(in_array($_SESSION['level'], array('1'))) : ?>
                    <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#myModal">Tambah Status Pengiriman</button>
                    <br>
                    <br>
                <?php else : ?>
                    <button type="button" class="btn btn-danger waves-effect waves-light" data-toggle="modal" data-target="#myModal">Konfirmasi barang</button>
                    <br>
                    <br>
                <?php endif; ?>

                <h4># Tracking pengiriman</h4>
                <table class="table table-bordered">
                    <tr style="background-color: grey; color: white">
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Nama Pengirim</th>
                        <th>Catatan</th>
                        <?php if(in_array($_SESSION['level'], array('1'))) : ?>
                            <th>Aksi</th>
                        <?php endif; ?>
                    </tr>
                    <?php 
                    $showPengiriman = mysqli_query($conn,"SELECT * FROM master_tracking_pengiriman WHERE kode_transaksi='".$_REQUEST['id']."' ORDER BY tanggal DESC");
                    $total = mysqli_num_rows($showPengiriman);
                    if($total<=0){
                        echo  "<tr><td colspan='3'><div class='alert alert-danger'>Belum ada data</div></td></tr>";
                    }
                    while ($data = mysqli_fetch_array($showPengiriman)) {
                        ?>
                        <tr>
                            <td><?php echo $data['tanggal']; ?></td>
                            <td><?php echo $data['status']; ?></td>
                            <td><?php echo $data['nm_pengirim']; ?></td>
                            <td><?php echo $data['catatan']; ?></td>
                            <?php if(in_array($_SESSION['level'], array('1'))) : ?>
                                <td>
                                    <form action="" method="POST">
                                        <input type="hidden" name="id_hapus" value="<?php echo $data['id']; ?>">
                                        <button class="btn btn-danger btn-xs" type="submit" name="hapus" onclick="return confirm('Apakah anda ingin membatalkan data ini ?')">Batalkan</button>
                                    </form>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>

</div>


<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Status Pengiriman</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <label>Pilih Status</label>
                    <select class="form-control" name="status">
                        <?php if(in_array($_SESSION['level'], array('1'))) : ?>
                            <option value="">Pilih status</option>
                            <option value="dikirim">Proses Dikirim</option>
                            <option value="terlambat">Pengiriman diundur</option>
                            <?php else : ?>
                                <option value="Barang sudah diterima">Barang Diterima</option>
                            <?php endif; ?>
                        </select>
                         <?php if(in_array($_SESSION['level'], array('1'))) : ?>
                        <label>Nama Pengirim</label>
                        <input type="text" name="nm_pengirim" class="form-control" required="">
                        <?php else : ?>
                        <input type="hidden" name="nm_pengirim" value="-" class="form-control">
                        <?php endif; ?>

                        <label>Catatan</label>
                        <input type="text" name="catatan" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" name="simpan" class="btn btn-primary waves-effect waves-light">Simpan</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
