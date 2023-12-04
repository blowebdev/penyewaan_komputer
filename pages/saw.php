<?php 
if (!in_array($_SESSION['level'], array('1'))) {
echo  "<br>Maaf halaman tidak bisa di akses";
exit;
}
?>
<div class="row">
	<div class="col-12">
		<div class="page-title-box">
			<div class="page-title-right">
				<ol class="breadcrumb m-0">
					<li class="breadcrumb-item"><a href="javascript: void(0);">SAW</a></li>
					<li class="breadcrumb-item active">Perhitungan SAW</li>
				</ol>
			</div>
			<h4 class="page-title">Perhitungan SAW</h4>
		</div>
	</div>
</div>  
<style type="text/css">
	.card-header {
		padding: 1rem 1.5rem;
		margin-bottom: 0;
		background-color: #81ecec !important;
		border-bottom: 0 solid #dee2e6 !important;
	}
</style>
<?php 
$id_pelanggan = str_replace('/', '', $_REQUEST['id2']);
$kode_transaksi = $_REQUEST['id'];
?>

<div class="row">
	<div class="col-12">
		<div class="card-box">
			<div class="row">
				<div class="col-12">
					<form action="" method="POST" style="float: right;">
						<button type="text" type="submit" name="hitung" class="btn btn-primary">Reload Hitung</button>
					</form>
					<table class="table table-bordered">
						<thead style="background-color: grey; color: white">
							<tr>
								<th>Direview Oleh</th>
								<th width="20%">Nama Produk</th>
								<?php 
								$kolom = mysqli_query($conn,"SELECT * FROM master_pertanyaan_review ORDER BY id ASC");
								while ($data = mysqli_fetch_array($kolom)):
									?>
									<th width="12%"><?php echo $data['pertanyaan']; ?></th>
								<?php endwhile; ?>
							</tr>
						</thead>
						<tbody>
							<?php 
							$isiane = mysqli_query($conn,"SELECT DISTINCT a.id_produk, b.nama, a.kode_transaksi, c.nama as pelanggan, a.id_pelanggan FROM master_isian_review as a 
								LEFT JOIN master_produk as b ON a.id_produk = b.id
								LEFT JOIN master_pelanggan as c ON a.id_pelanggan = c.id
								");
								while ($data = mysqli_fetch_array($isiane)) :?>

									<tr>
										<td width="1%" nowrap=""><?php echo $data['pelanggan']; ?></td>
										<td><?php echo $data['nama']; ?></td>
										<?php 
										$kolom = mysqli_query($conn,"SELECT * FROM master_pertanyaan_review ORDER BY id ASC");
										while ($daper = mysqli_fetch_array($kolom)):
											$nilaine = mysqli_fetch_array(mysqli_query($conn,"
												SELECT * FROM master_isian_review as a 
												LEFT JOIN master_produk as b ON a.id_produk = b.id
												WHERE a.id_pelanggan='".$data['id_pelanggan']."' 
												AND id_pertanyaan = '".$daper['id']."'
												AND id_produk = '".$data['id_produk']."'
												AND a.kode_transaksi ='".$data['kode_transaksi']."'
												"));
												?>
												<td><?php echo $nilaine['jawaban']; ?></td>
											<?php endwhile; ?>

										</tr>

									<?php endwhile; ?>
								</tbody>
							</table>

							#Normalisasi 1
							<table class="table table-bordered">
								<thead style="background-color: grey; color: white">
									<tr>
										<th width="1%" nowrap="">Direview Oleh</th>
										<th width="20%">Nama Produk</th>
										<?php 
										$kolom = mysqli_query($conn,"SELECT * FROM master_pertanyaan_review ORDER BY id ASC");
										while ($data = mysqli_fetch_array($kolom)):
											?>
											<th width="12%"><?php echo $data['pertanyaan']; ?></th>
										<?php endwhile; ?>
									</tr>
								</thead>
								<tbody>
									<?php 
									$isiane = mysqli_query($conn,"
										SELECT DISTINCT a.id_produk, b.nama, a.kode_transaksi, c.nama as pelanggan, a.id_pelanggan FROM master_isian_review as a 
										LEFT JOIN master_produk as b ON a.id_produk = b.id
										LEFT JOIN master_pelanggan as c ON a.id_pelanggan = c.id
										");
										while ($data = mysqli_fetch_array($isiane)) :?>

											<tr>
												<td><?php echo $data['pelanggan']; ?></td>
												<td><?php echo $data['nama']; ?></td>
												<?php 
												$kolom = mysqli_query($conn,"SELECT * FROM master_pertanyaan_review ORDER BY id ASC");
												while ($daper = mysqli_fetch_array($kolom)):
													$nilaine = mysqli_fetch_array(mysqli_query($conn,"
														SELECT * FROM master_isian_review as a 
														LEFT JOIN master_produk as b ON a.id_produk = b.id
														WHERE a.id_pelanggan='".$data['id_pelanggan']."' 
														AND id_pertanyaan = '".$daper['id']."'
														AND id_produk = '".$data['id_produk']."'
														AND a.kode_transaksi ='".$data['kode_transaksi']."'
														"));

													$nilai_tertinggi = mysqli_fetch_array(mysqli_query($conn,"
														SELECT MAX(jawaban) as nilai_tertinggi FROM master_isian_review as a 
														LEFT JOIN master_produk as b ON a.id_produk = b.id
														WHERE id_pertanyaan = '".$daper['id']."'
														"));
														?>
														<td><?php echo $nilaine['jawaban']." / ".$nilai_tertinggi['nilai_tertinggi']." =".number_format($nilaine['jawaban']/$nilai_tertinggi['nilai_tertinggi'],2); ?></td>
														<?php 
													endwhile; ?>
												</tr>

											<?php endwhile; ?>
										</tbody>
									</table>

									#Normalisasi 2
									<table class="table table-bordered">
										<thead style="background-color: grey; color: white">
											<tr>
												<th width="1%" nowrap="">Direview Oleh</th>
												<th width="20%">Nama Produk</th>
												<?php 
												$kolom = mysqli_query($conn,"SELECT * FROM master_pertanyaan_review ORDER BY id ASC");
												while ($data = mysqli_fetch_array($kolom)):
													?>
													<th width="12%"><?php echo $data['pertanyaan']; ?></th>
												<?php endwhile; ?>
												<th>Nilai Total</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											$nilai_saw = array();
											$isiane = mysqli_query($conn,"
												SELECT DISTINCT a.id_produk, b.nama, a.kode_transaksi, c.nama as pelanggan, a.id_pelanggan FROM master_isian_review as a 
												LEFT JOIN master_produk as b ON a.id_produk = b.id
												LEFT JOIN master_pelanggan as c ON a.id_pelanggan = c.id
												");
												while ($data = mysqli_fetch_array($isiane)) :?>
													<tr>
														<td><?php echo $data['pelanggan']; ?></td>
														<td><?php echo $data['nama']; ?></td>
														<?php 
														$total = 0;
														$total_all = 0;
														$kolom = mysqli_query($conn,"SELECT * FROM master_pertanyaan_review ORDER BY id ASC");
														while ($daper = mysqli_fetch_array($kolom)):
															$nilaine = mysqli_fetch_array(mysqli_query($conn,"
																SELECT * FROM master_isian_review as a 
																LEFT JOIN master_produk as b ON a.id_produk = b.id
																WHERE a.id_pelanggan='".$data['id_pelanggan']."' 
																AND id_pertanyaan = '".$daper['id']."'
																AND id_produk = '".$data['id_produk']."'
																AND a.kode_transaksi ='".$data['kode_transaksi']."'
																"));

															$nilai_tertinggi = mysqli_fetch_array(mysqli_query($conn,"
																SELECT MAX(jawaban) as nilai_tertinggi FROM master_isian_review as a 
																LEFT JOIN master_produk as b ON a.id_produk = b.id
																WHERE id_pertanyaan = '".$daper['id']."'
																"));
																?>
																<td><?php echo $nilaine['jawaban']." / ".$nilai_tertinggi['nilai_tertinggi']." * ".$daper['bobot']." =".number_format($nilaine['jawaban']/$nilai_tertinggi['nilai_tertinggi']*$daper['bobot']/100,2); ?></td>
																<?php
																$total .=number_format($nilaine['jawaban']/$nilai_tertinggi['nilai_tertinggi']*$daper['bobot']/100,2)."+";
																$total_all+=number_format($nilaine['jawaban']/$nilai_tertinggi['nilai_tertinggi']*$daper['bobot']/100,2);
															endwhile; ?>
															<td><?php echo substr($total, 1, strlen($total) - 2); ?>=<label style="font-weight: bold;"><?php echo $total_all; ?></label> 
															</td>
														</tr>
														<?php 
														$nilai_saw[] = [
															'nilai' => $total_all,
															'id_produk' => $data['id_produk'],
															'pelanggan' => $data['pelanggan'],
															'nama_produk' => $data['nama']
														];
													endwhile; ?>
												</tbody>
											</table>
											Ranking
											<table class="table table-bordered" style="width: 80%">
												<thead style="background-color: grey; color: white">
													<tr>
														<th width="1%" nowrap="">Direview Oleh</th>
														<th width="1%">Nama Produk yang paling direkomendasikan</th>
														<th width="1%">Nilai</th>
														<th width="1%">Rangking</th>
													</tr>
												</thead>
												<tbody>
													<?php 
													if (isset($_REQUEST['hitung'])) {
														mysqli_query($conn,"DELETE FROM `master_nilai_rekomendasi_review`");
													}
													$no = 1;
													$no2 = 1;
													rsort($nilai_saw);
													foreach ($nilai_saw as $key => $d):
														if (isset($_REQUEST['hitung'])) {
															$vf = mysqli_query($conn,"
																INSERT INTO `master_nilai_rekomendasi_review`(
																`id_produk`,
																`nama`,
																`nilai`,
																`rangking`) VALUES (
																'".$d['id_produk']."',
																'".$d['nama_produk']."',
																'".number_format($d['nilai']*100,2)."',
																'".$no2++."')
																");
														}
														?>
														<tr>
															<td><?php echo $d['pelanggan']; ?></td>
															<td><?php echo $d['nama_produk']; ?></td>
															<td><?php echo number_format($d['nilai']*100,2); ?>%</td>
															<td><?php echo $no++; ?></td>
														</tr>
													<?php endforeach; ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>