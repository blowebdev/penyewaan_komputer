<div class="row">
	<div class="col-12">
		<div class="page-title-box">
			<div class="page-title-right">
				<ol class="breadcrumb m-0">
					<li class="breadcrumb-item"><a href="javascript: void(0);">Review</a></li>
					<li class="breadcrumb-item active">Dashboard</li>
				</ol>
			</div>
			<h4 class="page-title">Review</h4>
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
									<th width="10%" nowrap="">Review</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$wxc = mysqli_query($conn,"SELECT * FROM master_produk ORDER BY nama ASC");
								while ($data = mysqli_fetch_array($wxc)) {
									$result = mysqli_query($conn,"SELECT SUM(CAST(jawaban AS DOUBLE) /5) as jawaban FROM `master_isian_review` WHERE id_produk = '".$data['id']."'");
									$review_bintan = mysqli_fetch_array($result);
									?>
									<tr>
										<td><?php echo $data['id']; ?></td>
										<td><img class="rounded-circle border" src="<?php echo $base_url; ?>upload/<?php echo $data['gambar']; ?>" alt="Generic placeholder image" width="100" height="100"></td>
										<td style="font-weight: bold;"><?php echo $data['nama']; ?></td>
										<td>Rp. <?php echo number_format($data['harga']); ?></td>
										<td nowrap="">
											<?php echo number_format($review_bintan['jawaban'],2); ?> <br>
											<?php for ($i=1; $i <=number_format($review_bintan['jawaban'],2) ; $i++) { 
												echo "⭐";
											}?>
										</td>
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