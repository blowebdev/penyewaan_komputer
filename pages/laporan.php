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
						<button onclick="print()" class="btn btn-danger">Print</button>
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
									<th width="30%">Status Pembayaran</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								if(in_array($_SESSION['level'], array('1'))){
									$filter = "";
								}else{
									$filter = "WHERE a.id_pelanggan='".$_SESSION['id_pelanggan']."'";
								}
								$no = 1;
								$total_rp = 0;
								$pengiriman = 0;
								$total_barang = 0;
								$total_harga = 0;
								$wxc = mysqli_query($conn,"SELECT a.*, DATE(created_at) as tanggal_pemesanan FROM master_transaksi as a ".$filter." ORDER BY created_at ASC");
								while ($data = mysqli_fetch_array($wxc)) {
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
										<td><?php echo status($data['status']); ?></td>
										
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
									<td style="font-weight: bold;" nowrap="">Rp. <?php echo number_format($total_rp); ?></td>
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