 <div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Pencarian</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>   
<div>
    <div class="row">
        <div class="col-lg-12">
            <!-- Portlet card -->
            <div class="card">
                <div class="card-body">
                    <?php 
                    error_reporting(0);
                    session_start();
                    $product = mysqli_query($conn,"SELECT * FROM master_produk WHERE id='".$_REQUEST['id']."'");
                    while ($dapod = mysqli_fetch_array($product)) {
                        $result = mysqli_query($conn,"SELECT SUM(CAST(jawaban AS DOUBLE) /5) as jawaban FROM `master_isian_review` WHERE id_produk = '".$dapod['id']."'");
                        $review_bintan = mysqli_fetch_array($result);
                        ?>

                        <div class="card product-box">
                            <div class="product-img">
                                <div class="p-3">
                                    <img src="<?php echo $base_url."upload/".$dapod['gambar']; ?>" alt="product-pic" class="img-fluid"  height="100" width="40%"/>
                                </div>
                            </div>

                            <div class="product-info border-top p-3">
                                <div>
                                    <h5 class="font-16 mt-0 mb-1"><a href="<?php echo $base_url; ?>detail/<?php echo $dapod['id']; ?>" class="text-dark"><?php echo $dapod['nama']; ?></a> </h5>
                                    <p class="text-muted">
                                        <?php for ($i=1; $i <=number_format($review_bintan['jawaban'],2) ; $i++) { 
                                            echo '<i class="mdi mdi-star text-warning"></i>';
                                        }?> (<?php echo number_format($review_bintan['jawaban'],2); ?>)
                                    </p>
                                    
                                    <h4 class="m-0"> <span class="text-muted"> Harga : Rp.<?php echo number_format($dapod['harga']); ?> /Hari</span></h4>
                                </div>
                                <br>
                                <br>
                                <h5 class="font-16 mt-0 mb-1">Deskripsi</h5>
                                <p><?php echo $dapod['deskripsi']; ?></p>

                            </div> <!-- end product info-->

                        </div>

                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>