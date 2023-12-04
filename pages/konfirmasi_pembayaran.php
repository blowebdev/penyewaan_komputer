 <?php 
 if (!in_array($_SESSION['level'], array('2','1','3'))) {
    echo  "<br>Maaf halaman tidak bisa di akses";
    exit;
}

if (isset($_REQUEST['simpan'])) {
    $kode_transaksi = $_REQUEST['kode_transaksi'];
    $harga = $_REQUEST['harga'];
    $bank = $_REQUEST['bank'];

    $temp_name       = $_FILES['gambar']['tmp_name'];
    $name_file       = $_FILES['gambar']['name'];
    $type_file       = $_FILES['gambar']['type'];
    $size            = $_FILES['gambar']['size'];
    $nama_gambar        = $_REQUEST['nama_gambar'];
    // var_dump($nama_gambar);

    if (empty($temp_name)) {
        $set_gambar = ",struk='".$nama_gambar."'";
    }else{  
        $file_ext=strtolower(end(explode('.',$_FILES['gambar']['name'])));
        $expensions= array("jpeg","jpg","png");

        if (in_array($file_ext,$expensions)=== false) {
            echo "salah";
        }elseif($size >= 3097152){
            echo "upload maksimal 3 mb";
        }else{
            $Move = move_uploaded_file($temp_name, 'struk/'.$date."-".$name_file.'');
            if ($Move) {
                unlink('"struk/'.$file.'"');
                $nm_foto  = $date."-".$name_file;
            }
        }

        $set_gambar = ",struk='".$nm_foto."'";
    }
    $sql = "UPDATE master_transaksi SET bank='".$bank."' ".$set_gambar." WHERE kode_transaksi='".$_REQUEST['kode_transaksi']."'";
    $exc = mysqli_query($conn,$sql);
    if ($exc) {
        echo '
        <div class="alert alert-success alert-dismissible" role="alert">
        <div class="alert-message">
        <strong>Perhatian !! Data berhasil disimpan</strong>
        </div>
        </div>

        <meta http-equiv="refresh" content="1" url="'.$base_url.'transaksi">

        ';
    }else{
        echo '
        <div class="alert alert-danger alert-dismissible" role="alert">
        <div class="alert-message">
        <strong>Perhatian !! Data gagal disimpan</strong>
        </div>
        </div>


        ';
    }
}


$detail = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM master_transaksi WHERE kode_transaksi='".$_REQUEST['id']."'"));
 if(in_array($_SESSION['level'], array('1')) AND empty($detail['struk'])) :
     echo  "<br> <br><a href='".$base_url."transaksi' class='btn btn-danger'>Kembali</a><br><div class='alert alert-danger'>Maaf pelanggan belum upload struk pembayaran</div>";
    exit;
 endif; 
?>
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                    <li class="breadcrumb-item active">Konfirmasi Pembayaran</li>
                </ol>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-12">
        <div class="card-box">
            <div class="row">
                <div class="col-12">
                    <form class="form-horizontal" enctype="multipart/form-data" role="form" action="" method="POST">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="simpleinput">Status</label>
                            <div class="col-sm-10">
                                <?php if(!empty($detail['struk'])) :  ?>
                                    <label class="text-success">Sudah Upload Struk</label>
                                <?php else : ?>
                                    <label class="text-danger">Belum Upload Struk</label>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="simpleinput">Konfirmasi Pembayaran</label>
                            <div class="col-sm-10">
                                <input type="text" name="kode_transaksi" value="<?php echo $detail['kode_transaksi']; ?>" class="form-control" required="" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="example-email">Harga</label>
                            <div class="col-sm-10">
                                <input type="number" name="harga" value="<?php echo $detail['grand_total']; ?>" class="form-control" placeholder="Harga" required="" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="example-email">Rekening</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="bank" readonly required="">
                                    <option value="">Pilih rekening</option>
                                    <option value="BNI" <?php echo ($detail['bank']=='BNI') ? "selected" : ""; ?>>BNI / 8839948575</option>
                                    <option value="BRI" <?php echo ($detail['bank']=='BRI') ? "selected" : ""; ?>>BRI / 9294847575</option>
                                    <option value="BCA" <?php echo ($detail['bank']=='BCA') ? "selected" : ""; ?>>BCA / 0199288384</option>
                                    <option value="DANA" <?php echo ($detail['bank']=='DANA') ? "selected" : ""; ?>>DANA / 081994004961</option>
                                    <option value="LINK_AJA" <?php echo ($detail['bank']=='LINK_AJA') ? "selected" : ""; ?>>LINK_AJA / 081994004961</option>
                                    <option value="QRIS" <?php echo ($detail['bank']=='QRIS') ? "selected" : ""; ?>>QRIS</option>
                                    <option value="GOPAY" <?php echo ($detail['bank']=='GOPAY') ? "selected" : ""; ?>>GOPAY / 08199400496</option>
                                    <option value="OVO" <?php echo ($detail['bank']=='OVO') ? "selected" : ""; ?>>OVO / 08199400496</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="example-email">Upload Struk</label>
                            <div class="col-sm-10">
                                <?php if (!empty($detail['struk'])) :?>
                                    <img src="<?php echo $base_url.'/struk/'.$detail['struk']; ?>"  style="width: 300px; height: 300px"/>
                                    <input type="file" class="form-control" name="gambar" required="">
                                    <input type="hidden" class="form-control" name="nama_gambar" value="<?php echo $detail['gambar']; ?>">
                                    <?php else : ?>
                                        <input type="file" class="form-control" name="gambar" required="">
                                    <?php endif; ?>
                                    <label class="text-danger">Maksimal 5 Mb</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                    <?php if(in_array($_SESSION['level'], array('2'))) : ?>
                                <label class="col-sm-2 col-form-label" for="example-email">Aksi</label>
                                <div class="col-sm-10">
                                        <a href="<?php echo $base_url; ?>transaksi" class="btn btn-danger">Kembali</a>
                                        <button class="btn btn-primary" type="submit" name="simpan">Kirim</button>
                                        <?php else : ?>
                                            
                                    <?php endif; ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>