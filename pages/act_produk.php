
<div class="row">
	<!-- <div class="col-lg-3">
		<div class="card">
			<h5 class="card-header">Filter Pencarian</h5>
			<div class="card-body">
				<input type="text" name="txt" class="form-control" placeholder="Pencarian"> <br>
				<a href="#" class="btn btn-primary">Cari</a>
			</div>
		</div>
	</div> -->
	<div class="col-lg-3">
		<div class="card">
			<div class="card-body">
				<H5>Filter Data</H5>
				<form action="" method="POST">
					<label>Urutkan harga</label>
					<select name="order" class="form-control">
						<option value="">Urutkan Harga</option>
						<option value="ORDER BY harga DESC" <?php echo (@$_REQUEST['order']=='ORDER BY harga ASC') ? "selected": ""; ?>>Harga terendah</option>
						<option value="ORDER BY harga ASC" <?php echo (@$_REQUEST['order']=='ORDER BY harga DESC') ? "selected": ""; ?>>Harga tertinggi</option>
					</select>
					<label>Input Pencarian</label>
					<input type="text" name="q" value="<?php echo @$_REQUEST['q']; ?>" placeholder="Input karakter" class="form-control">
					<br>
					<button class="btn btn-sm btn-success btn-block" type="submit" name="cari">Cari</button>
					<a href="<?php echo $base_url; ?>produk" class="btn btn-sm btn-block btn-danger">Reset</a>
				</form>
			</div>
		</div>
	</div>
	<div class="col-lg-9">
		<div class="row">
			<?php 
			error_reporting(0);
			session_start();
			include '../config/koneksi.php';
			if(!empty($_REQUEST['q'])){
				$q = "WHERE nama LIKE '%".$_REQUEST['q']."%'";
			}else{
				$q = "";
			}
			$product = mysqli_query($conn,"SELECT * FROM master_produk ".$q." ".$_REQUEST['sql']);

			while ($dapod = mysqli_fetch_array($product)) {
				$result = mysqli_query($conn,"SELECT SUM(CAST(jawaban AS DOUBLE) /5) as jawaban FROM `master_isian_review` WHERE id_produk = '".$dapod['id']."'");
				$review_bintan = mysqli_fetch_array($result);


				$total_stock_res = mysqli_query($conn,"SELECT SUM(qty) as stock FROM master_detail_transaksi WHERE id_produk='".$dapod['id']."' AND status='PROSES'");
				$total_stock = mysqli_fetch_array($total_stock_res);
				$stock =  $dapod['stock'];
				$stock_akhir = number_format($stock-$total_stock['stock']);
				?>
				<div class="col-md-6 col-xl-3">
					<div class="card product-box">
						<div class="product-img">
							<div class="p-3">
								<img src="<?php echo $base_url."upload/".$dapod['gambar']; ?>" alt="product-pic" class="img-fluid" />
							</div>
							<div class="product-action">
								<div class="d-flex">
									<input type="hidden" id="stock_akhir<?php echo $dapod['id']; ?>" value="<?php echo $stock_akhir; ?>">
									<?php if($stock_akhir<=0) :  ?>
										<button onclick="alert('Maaf stock habis')" class="btn btn-danger d-block w-100 action-btn m-2">Maaf stock Habis</button>
									<?php elseif (empty($_REQUEST['tanggal_selesai'])) : ?>
										<a href="javascript: void(0);"  data-toggle="modal" class="btn btn-danger d-block w-100 action-btn m-2"><i class="ti-shopping-cart"></i> Pilih tanggal dahulu</a>
										<?php else : ?>
											<a href="javascript: void(0);"  data-toggle="modal" data-target=".show_qty<?php echo $dapod['id']; ?>" class="btn btn-primary d-block w-100 action-btn m-2">
												<i class="ti-shopping-cart"></i> Keranjang</a>

											<?php endif; ?>
										</div>
									</div>
								</div>

								<div class="product-info border-top p-3">

									<div>
										<h5 class="font-16 mt-0 mb-1"><a href="<?php echo $base_url; ?>detail/<?php echo $dapod['id']; ?>" class="text-dark"><?php echo $dapod['nama']; ?></a> </h5>
										<p class="text-muted">
											Stock Tersisa : <?php echo $stock_akhir; ?> Item <br>
											<?php for ($i=1; $i <=number_format($review_bintan['jawaban'],2) ; $i++) { 
												echo '<i class="mdi mdi-star text-warning"></i>';
											}?> (<?php echo number_format($review_bintan['jawaban'],2); ?>)
										</p>
										<h4 class="m-0"> <span class="text-muted"> Harga : Rp.<?php echo number_format($dapod['harga']); ?> /Hari</span></h4>
									</div>

								</div> <!-- end product info-->

							</div>
						</div>



							<div class="modal fade show_qty<?php echo $dapod['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title" id="myCenterModalLabel">Masukan Quantity</h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										</div>
										<div class="modal-body">
											<input type="number" class="form-control" placeholder="Masukan quantity" id="qty<?php echo $dapod['id']; ?>">
										</div>
										<div class="modal-footer">
											<button class="btn btn-block btn-danger" onclick="keranjang_belanja('<?php echo $dapod['id']; ?>', '<?php echo $dapod['harga']; ?>')">Simpan</button>
										</div>
									</div>
								</div>
							</div>
					<?php } ?>
				</div>
			</div>
		</div> <!-- end container -->


		<script type="text/javascript">
			function modal_qty(id,harga){
				$(".show_qty").modal('toggle');
			}

			function save_keranjang(id, harga, qty){
				$.ajax({
					url: '<?php echo $base_url; ?>pages/act_keranjang_belanja.php',
					type: 'POST',
					dataType: 'json',
					data: {id:id, harga:harga, qty: qty, tgl_pinjam : '<?php echo $_REQUEST['tanggal_pinjam']; ?>', tgl_selesai: '<?php echo $_REQUEST['tanggal_selesai']; ?>' },
					success : function(data){
						if(data.status=='success'){
							swal({
								title: "Berhasil",
								text: "Data berhasil dimasukan ke keranjang belanja",
								type: "success"
							}).then(function() {
								updateQty();
							});
						}else{
							Swal.fire({
								title: "Maaf !",
								text: "Harus login terlebih dahulu",
								type: "error",
								confirmButtonClass: "btn btn-confirm mt-2"
							})
						}
					}
				});
			}

			function keranjang_belanja(id, harga) {
				<?php  if(!empty($_SESSION['id_pelanggan'])) :?>
					var id = id;
					var harga = harga;
					var qty = parseInt($("#qty"+id).val());
					var stock = parseInt($("#stock_akhir"+id).val());
					if(!qty){
						// alert('Quantity harus diisi');

						Swal.fire({
								title: "Maaf !",
								text: "Quantity wajib diisi",
								type: "error",
								confirmButtonClass: "btn btn-confirm mt-2"
							});
						// break;
					}else if(qty > stock){
						// alert('Quantity melebihi stock');

						Swal.fire({
								title: "Maaf !",
								text: "Quantity melebihi stock",
								type: "error",
								confirmButtonClass: "btn btn-confirm mt-2"
							});
						// break;
					}else{
						// alert('berhasil');
						save_keranjang(id,harga,qty);
					}
					
					<?php else : ?>
						Swal.fire({
							title: "Maaf !",
							text: "Harus login terlebih dahulu",
							type: "error",
							confirmButtonClass: "btn btn-confirm mt-2"
						})

					<?php endif; ?>
				}
			</script>



