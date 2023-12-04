<div class="row">
	<div class="col-12">
		<div class="page-title-box">
			<div class="page-title-right">
				<ol class="breadcrumb m-0">
					<li class="breadcrumb-item"><a href="javascript: void(0);">Produk List</a></li>
					<li class="breadcrumb-item active">Dashboard</li>
				</ol>
			</div>
			<h4 class="page-title">Produk List</h4>
		</div>
	</div>
</div>   
<div class="row">
	<div class="col-12">
		<div class="card-box">
			<div class="row">
				<div class="col-12">
					<div class="table-responsive">
						<table id="basic-datatable" class="table table-stripped">
							<thead class="table-light" style="background-color: #dfe6e9">
								<tr>
									<th width="1%">#</th>
									<th width="5%">Foto</th>
									<th width="10%">Produk</th>
									<th width="10%">Harga</th>
									<th width="10%">Stock</th>
									<th width="10%">Sisa Stock</th>
									<th width="10%">Stock Sendang Dipinjam</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$wxc = mysqli_query($conn,"SELECT * FROM master_produk ORDER BY nama ASC");
								while ($data = mysqli_fetch_array($wxc)) {

									$total_stock_res = mysqli_query($conn,"SELECT SUM(qty) as stock FROM master_detail_transaksi WHERE id_produk='".$data['id']."' AND status='PROSES'");
									$total_stock = mysqli_fetch_array($total_stock_res);
									$stock =  $data['stock'];
									$stock_akhir = number_format($stock-$total_stock['stock']);
									?>
									<tr>
										<td><?php echo $data['id']; ?></td>
										<td><img class="rounded-circle border" src="<?php echo $base_url; ?>upload/<?php echo $data['gambar']; ?>" alt="Generic placeholder image" width="100" height="100"></td>
										<td style="font-weight: bold;"><?php echo $data['nama']; ?></td>
										<td>Rp. <?php echo number_format($data['harga']); ?></td>
										<td><?php echo $data['stock']; ?></td>
										<td>
											<?php echo $stock_akhir; ?>
										</td>
										<td><?php echo $total_stock['stock']; ?></td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>