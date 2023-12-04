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
					<li class="breadcrumb-item"><a href="javascript: void(0);">Transaksi</a></li>
					<li class="breadcrumb-item active">Dashboard</li>
				</ol>
			</div>
			<h4 class="page-title">Transaksi</h4>
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
          <label class="col-sm-4 col-form-label" for="example-date">Tanggal Awal</label>
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
<?php 
if (isset($_REQUEST['update_lunas'])) {
	$sql = "UPDATE master_transaksi SET status='".$_REQUEST['status']."' WHERE id='".$_REQUEST['id']."'";
	$exc = mysqli_query($conn,$sql);
	if ($exc) {
		echo '
		<div class="alert alert-success alert-dismissible" role="alert">
		<div class="alert-message">
		<strong>Perhatian !! Data berhasil diupdate</strong>
		</div>
		</div>

		<meta http-equiv="refresh" content="1">

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
<div class="row">
	<div class="col-12">
		<div class="card-box">
			<div class="row">
				<div class="col-12">
					<div class="table-responsive">
						<table id="basic-datatable" class="table table-stripped">
							<thead class="table-light" style="background-color: #dfe6e9; font-weight: bold;">
								<tr>
									<th width="5%">Tanggal</th>
									<th width="5%">Kode</th>
									<th width="10%">Nama</th>
									<th width="10%">WA</th>
									<th width="10%">Total Barang</th>
									<th width="30%">Total Harga</th>
									<th width="30%">Biaya Kirim</th>
									<th width="30%">Grand Total</th>
									<th width="30%">Status Pengiriman</th>
									<th width="30%">Status Pembayaran</th>
									<th width="30%">Struk</th>
									<th width="1%" nowrap="">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								if(in_array($_SESSION['level'], array('1'))){
									if (isset($_REQUEST['filter_tanggal'])) {
										$filtere_tanggal = "WHERE created_at>='".$_REQUEST['tgl_awal']."' AND created_at<='".$_REQUEST['tgl_akhir']."'";
									}else{
										$filtere_tanggal = "";
									}
									$filter = "".$filtere_tanggal;
								}else{
									if (isset($_REQUEST['filter_tanggal'])) {
										$filtere_tanggal = "AND created_at>='".$_REQUEST['tgl_awal']."' AND created_at<='".$_REQUEST['tgl_akhir']."'";
									}else{
										$filtere_tanggal = "";
									}
									$filter = "WHERE a.id_pelanggan='".$_SESSION['id_pelanggan']."' ".$filtere_tanggal."";
								}
								$no = 1;
								$total_rp = 0;
								$pengiriman = 0;
								$total_barang = 0;
								$total_harga = 0;
								$wxc = mysqli_query($conn,"SELECT a.*, DATE(created_at) as tanggal_pemesanan FROM master_transaksi as a ".$filter." ORDER BY created_at ASC");
								while ($data = mysqli_fetch_array($wxc)) {

									  $showPengiriman = mysqli_query($conn,"SELECT * FROM master_tracking_pengiriman WHERE kode_transaksi='".$data['kode_transaksi']."' ORDER BY tanggal DESC");
									  $pengiriman = mysqli_fetch_array($showPengiriman);
									?>
									<tr>
										<td nowrap=""><?php echo $data['tanggal_pemesanan']; ?></td>
										<td><a href="show_detail_transaksi/<?php echo $data['kode_transaksi']; ?>">#<?php echo $data['kode_transaksi']; ?></a></td>
										<td style="font-weight: bold;"><?php echo $data['nama']; ?></td>
										<td><?php echo $data['hp']; ?></td>
										<td><?php echo $data['total_barang']; ?></td>
										<td>Rp. <?php echo number_format($data['total_transaksi']); ?></td>
										<td>Rp. <?php echo number_format($data['biaya_kirim']); ?></td>
										<td nowrap="" style="font-weight: bold;">Rp. <?php echo number_format($data['grand_total']); ?></td>
										<td><?php echo $pengiriman['status']; ?></td>
										<td><?php echo status($data['status']); ?></td>
										<td>
											<?php if($data['pembayaran']=='transfer') : ?>
												<?php echo (empty($data['bank'])) ? "<p class='text-danger'>BELUM UPLOAD</p>": "<p class='text-success'>SUDAH</p>"; ?>
												<?php else : ?>
													<p class='text-success'>CASH</p>
												<?php endif;?>
											</td>
											<td nowrap="">
												<?php if(in_array($_SESSION['level'], array('1'))) : ?>
													<div class="btn-group dropdown">
														<a href="javascript: void(0);" class="dropdown-toggle arrow-none btn btn-light btn-sm" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
														<div class="dropdown-menu dropdown-menu-right">
															<form action="" method="POST">
																<input type="hidden" name="id" value="<?php echo $data['id']; ?>">
																<input type="hidden" name="status" value="LUNAS">
																<button class="dropdown-item" type="submit" name="update_lunas"><i class="mdi mdi-check-all mr-2 text-muted font-18 vertical-middle"></i> Lunas</button>
															</form>
															<form action="" method="POST">
																<input type="hidden" name="id" value="<?php echo $data['id']; ?>">
																<input type="hidden" name="status" value="BATAL">
																<button class="dropdown-item" type="submit" name="update_lunas"><i class="fe-rotate-ccw mr-2 text-muted font-18 vertical-middle"></i> Batalkan</button>
															</form>
															<a href="<?php echo $base_url; ?>show_detail_transaksi/<?php echo $data['kode_transaksi']; ?>" class="dropdown-item" type="submit"><i class="fa fa-eye mr-2 text-muted font-18 vertical-middle"></i> Invoice</a>

															<a href="<?php echo $base_url; ?>item_harus_dikembalikan/<?php echo $data['kode_transaksi']; ?>" class="dropdown-item" type="submit"><i class="fe-shopping-bag mr-2 text-muted font-18 vertical-middle"></i> Detail Barang</a>

															<a href="<?php echo $base_url; ?>review/<?php echo $data['kode_transaksi']; ?>/<?php echo $data['id_pelanggan']; ?>" class="dropdown-item" type="submit"><i class="fe-slack mr-2 text-muted font-18 vertical-middle"></i>Review</a>

															<a href="<?php echo $base_url; ?>konfirmasi_pembayaran/<?php echo $data['kode_transaksi']; ?>" class="dropdown-item" type="submit"><i class=" ti-back-right mr-2 text-muted font-18 vertical-middle"></i> Struk Pembayaran</a>

															<a href="<?php echo $base_url; ?>pengiriman/<?php echo $data['kode_transaksi']; ?>" class="dropdown-item" type="submit"><i class="fe-truck mr-2 text-muted font-18 vertical-middle"></i> Pengiriman</a>
															
														</div>
													</div>
													<?php else : ?>
														<?php if($data['status']=='LUNAS') : ?>
															<a href="<?php echo $base_url; ?>review/<?php echo $data['kode_transaksi']; ?>" class="btn btn-warning btn-sm" title="Review"><i class="fa fa-star"></i></a>
															<a href="<?php echo $base_url; ?>show_detail_transaksi/<?php echo $data['kode_transaksi']; ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
															<?php else : ?>
																<a href="<?php echo $base_url; ?>show_detail_transaksi/<?php echo $data['kode_transaksi']; ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
																<?php if($detail_transaksi['pembayaran']=='transfer') : ?>
																	<a href="<?php echo $base_url; ?>konfirmasi_pembayaran/<?php echo $data['kode_transaksi']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-upload"></i></a>
																<?php endif; ?>
															<?php endif ?>
														<?php endif; ?>
														<a href="<?php echo $base_url; ?>pengiriman/<?php echo $data['kode_transaksi']; ?>" class="btn btn-success btn-sm" title="Tracking pengiriman"><i class="fe-truck"></i></a>
													</td>
												</tr>
												<?php 
												$total_rp+=$data['grand_total'];
												$pengiriman+=$data['biaya_kirim'];
												$total_harga+=$data['total_transaksi'];
												$total_barang+=$data['total_barang'];
											} ?>
										</tbody>
										<tfoot class="table-light" style="background-color: #dfe6e9">
											<tr>
												<td colspan="4">Total Transaksi</td>
												<td style="font-weight: bold;"></td>
												<td style="font-weight: bold;" nowrap="">Rp. <?php echo number_format($total_harga); ?></td>
												<td style="font-weight: bold;" nowrap="">Rp. <?php echo number_format($pengiriman); ?></td>
												<td style="font-weight: bold;" nowrap="">Rp. <?php echo number_format($total_rp+$pengiriman); ?></td>
												<td></td>
												<td></td>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>