
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Keranjang</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
            <h4 class="page-title">Keranjang Sewa</h4>
        </div>
    </div>
</div>    

<div class="row">
    <?php 
    $transactionCode = generateUniqueTransactionCode();
    if(!empty($_SESSION['id_pelanggan'])) :

        if (isset($_REQUEST['hapus'])) {
            $sql = "DELETE FROM master_keranjang_belanja WHERE id='".$_REQUEST['id']."'";
            $exc = mysqli_query($conn,$sql);    
        }
        ?>

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div>
                                <div class="table-responsive">
                                    <table class="table table-centered mb-0 table-nowrap">
                                        <thead class="table-light"  style="background-color: grey; color: white">
                                            <tr>
                                                <th style="width: 80px;">Foto</th>
                                                <th>Produk</th>
                                                <th>Harga/Hari</th>
                                                <th>Qty</th>
                                                <th>Total Harga Barang</th>
                                                <th>Durasi Sewa</th>
                                                <th nowrap="">
                                                    Total <br>
                                                    (Total Harga Barang * Durasi Sewa)
                                                </th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tr style="background-color: #dfe6e9">
                                            <th>1</th>
                                            <th>2</th>
                                            <th>3</th>
                                            <th>4</th>
                                            <th>5 = 3*4</th>
                                            <th>6</th>
                                            <th>7=5*6</th>
                                            <th>8</th>
                                        </tr>
                                        <tbody>
                                            <?php 
                                            $id_pelanggan = $_SESSION['id_pelanggan'];
                                            $no = 1;
                                            $total_harga=0;
                                            $total_barang =0;
                                            $cart_sql = mysqli_query($conn,"
                                                SELECT a.*, b.*, a.id as id_keranjang,
                                                DATEDIFF(a.tgl_selesai, tgl_pinjam) AS total_hari
                                                FROM master_keranjang_belanja as a
                                                LEFT JOIN master_produk as b ON a.id_produk = b.id
                                                WHERE a.id_pelanggan='".$id_pelanggan."'
                                                ORDER BY a.date_created ASC");
                                            $total = mysqli_num_rows($cart_sql);
                                            if($total<=0) : 
                                                echo '<tr><td colspan="8" style="text-align:center"><a href="./" class="btn btn-danger">Kembali belanja</a></td></tr>';
                                            else : 
                                            while ($data = mysqli_fetch_array($cart_sql)) {
                                                ?>
                                                <tr>
                                                    <td style="vertical-align: top">
                                                        <img src="<?php echo $base_url; ?>upload/<?php echo $data['gambar']; ?>" alt="product-img" title="product-img" class="avatar-lg">
                                                    </td>
                                                    <td style="vertical-align: top"><?php echo $data['nama']; ?></td>
                                                    <td style="vertical-align: top"><?php echo "Rp. ".number_format($data['harga']); ?></td>
                                                    <td width="1%" nowrap="" style="vertical-align: top">
                                                      <div style="width: 120px;" class="product-cart-touchspin">
                                                        <input data-toggle="touchspin" id="qty_val<?php echo $data['id_keranjang']; ?>" onchange="updateISianQty('<?php echo $data['id_keranjang']; ?>','<?php echo $data['total_hari']; ?>')" type="text" value="<?php echo $data['qty']; ?>" >
                                                    </div>
                                                </td>
                                                <td nowrap="" id="harga_barang<?php echo $data['id_keranjang']; ?>" style="vertical-align: top">
                                                    Rp. <?php echo number_format($data['total']); ?>
                                                </td>
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
                                                    <td id="total<?php echo $data['id_keranjang']; ?>" style="vertical-align: top">Rp. <?php echo number_format($data['total']*$data['total_hari']); ?></td>
                                                    <td style="vertical-align: top">
                                                        <form action="" method="POST">
                                                            <input type="hidden" value="<?php echo $data['id_keranjang']; ?>" name="id">
                                                            <button onclick="return confirm('Apakah anda ingin menghapus data ini ?')" class="btn btn-danger btn-sm btn-rounded" name="hapus"><i class="mdi mdi-trash-can"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <?php 
                                                $total_barang+=1;
                                                $total_harga +=($data['total']*$data['total_hari']);
                                            } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="6" style="font-weight: bold;">Total</td>
                                                <td style="font-weight: bold" id="total">Rp. <?php echo number_format($total_harga); ?></td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div> 
                                <div class="alert alert-info">
                                    Untuk menyewa siapkan : <br>
                                    1. KTP/SIM/KITAS atau Kartu tanda pengenal dan
                                    Serahkan ke kurir yang mengantar barang.
                                </div>
                                <form action="act_save_order" method="POST">
                                <div class="mt-3">
                                    <label for="example-textarea" class="form-label">Nama</label>
                                    <input type="text" name="nama" class="form-control" value="<?php echo $_SESSION['user_detail']['nama']; ?>">
                                </div>
                                <div class="mt-3">
                                    <label for="example-textarea" class="form-label">Hp/Wa</label>
                                    <input type="text" name="hp" class="form-control" value="<?php echo $_SESSION['user_detail']['hp']; ?>">
                                </div>
                                <div class="mt-3">
                                    <label for="example-textarea" class="form-label">Alamat</label>
                                    <textarea class="form-control" id="example-textarea" rows="3" name="alamat" placeholder="Tulis catatan dibawah ini"><?php echo $_SESSION['user_detail']['alamat']; ?></textarea>
                                </div>
                                 <div class="mt-3">
                                    <label for="example-textarea" class="form-label">Pengiriman</label>
                                    <select class="form-control" name="pengiriman" id="pengiriman" onchange="updateHarga('<?php echo $total_harga; ?>')" required="">
                                        <option value="">Pengiriman</option>
                                        <option value="dikirim">Dikirim dan Dijemput (Area Mojokerto) Rp. 50.000</option>
                                        <option value="ambil_sendiri">Ambil sendiri</option>
                                    </select>
                                </div>
                                <div class="mt-3">
                                    <label for="example-textarea" class="form-label">Pembayaran</label>
                                    <select class="form-control" required="" name="pembayaran">
                                        <option value="">Pembayaran</option>
                                        <option value="cash">Cash</option>
                                        <option value="transfer">Transfer</option>
                                        <option value="payment">Payment</option>
                                    </select>
                                </div>
                                <!-- Add note input-->
                                <div class="mt-3">
                                    <label for="example-textarea" class="form-label">Tambah Catatan </label>
                                    <textarea class="form-control" rows="3" name="catatan" placeholder="Tulis catatan dibawah ini" required=""></textarea>
                                </div>

                                 <div class="mt-3">
                                    <input type="hidden" id="rp_pengiriman" name="biaya_kirim">
                                    <input type="hidden" id="grand_total" value="<?php echo $total_harga; ?>" name="grand_total">
                                    <input type="hidden" value="<?php echo $total_harga; ?>" name="total_transaksi">
                                    <input type="hidden" value="<?php echo $total_barang; ?>" name="total_barang">
                                    <input type="hidden"  value="<?php echo generateUniqueTransactionCode(); ?>" name="kode_transaksi">
                                    <label for="example-textarea" class="form-label"># Ringkasan Sewa</label>
                                    <table class="table" style="width: 50%">
                                        <tr>
                                            <td>Total Harga Sewa</td>
                                            <td style="text-align: left;">: Rp. <?php echo number_format($total_harga); ?></td>
                                        </tr>
                                         <tr>
                                            <td>Biaya Pengiriman</td>
                                            <td style="text-align: left;">: <label id="rp_pengiriman2">Rp. -</label></td>
                                        </tr>
                                        <tr>
                                            <td>Gran Total</td>
                                            <td style="font-weight: bold; text-align: left;">: <label id="grand_total2">Rp. <?php echo number_format($total_harga); ?></label></td>
                                        </tr>

                                    </table>
                                </div>


                                <!-- action buttons-->
                                <div class="row mt-4">
                                    <div class="col-sm-6">
                                        <a href="./" class="btn text-muted d-none d-sm-inline-block btn-link fw-semibold">
                                            <i class="mdi mdi-arrow-left"></i> Kembali pilih produk </a>
                                        </div> <!-- end col -->
                                        <div class="col-sm-6">
                                            <div class="text-sm-end">
                                                <button type="submit" class="btn btn-danger" name="simpan"><i class="mdi mdi-cart-plus me-1"></i> Sewa Sekarang </button>
                                            </div>
                                        </div> <!-- end col -->
                                    </div> <!-- end row-->
                                    </form>

                                <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <?php else : ?>
            <div class="col-lg-12">
                <div class="mt-5 mb-5">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">

                                <div class="text-center">

                                    <img src="assets/images/animat-rocket-color.gif" alt="" height="160">

                                    <h3 class="mt-4">Hy Guyss Sorry Yaaa.... !!!</h3>
                                    <p class="text-muted">Untuk mengakses keranjang belanja anda harus login terlebih dahulu.</p>

                                    <a class="btn btn-primary mt-3" href="<?php echo $base_url; ?>/login"><i class="mdi mdi-login mr-1"></i> Login</a>
                                </div> <!-- end /.text-center-->

                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
                    </div>
                    <!-- end container -->
                </div>
                <!-- end page -->
            </div>
            <?php endif; ?>
        </div>
        <script src="<?php echo $base_url; ?>assets/js/jquery-1.11.0.min.js"></script>
        <script type="text/javascript">
            function updateISianQty(id, durasi){
                var nilai = $("#qty_val"+id).val();
                $.ajax({
                    url: '<?php echo $base_url; ?>pages/act_update_qty.php',
                    type: 'POST',
                    dataType: 'json',
                    data : {id:id, qty:nilai, durasi:durasi},
                    success : function(data) {
                        var totale = 0;
                        $.each(data.data, function(i, item) {
                            $("#total"+item.id).html("Rp. "+item.total)
                            $("#harga_barang"+item.id).html("Rp. "+item.harga_barang);
                            totale+=item.sum_total;
                        });
                        $("#total").html("Rp. "+totale.toLocaleString());
                        $("#grand_total2").html("Rp. "+totale.toLocaleString());
                        $("#grand_total").val(totale);
                    }
                });
            }
            function updateHarga(total_harga){
                var pengiriman = $("#pengiriman").val();
                if(pengiriman=='dikirim'){
                     var grand_totale = (parseInt(total_harga)+50000);
                     $("#grand_total2").html("Rp. "+grand_totale.toLocaleString());
                     $("#grand_total").val(grand_totale);
                     $("#rp_pengiriman").val(50000);
                     $("#rp_pengiriman2").html('Rp. 50,000');
                }else{
                    $("#grand_total2").html("Rp. "+total_harga.toLocaleString());
                    $("#grand_total").val(total_harga);
                     $("#rp_pengiriman").val(0);
                     $("#rp_pengiriman2").html(0);
                }
                // console.log(pengiriman);
            }
        </script>