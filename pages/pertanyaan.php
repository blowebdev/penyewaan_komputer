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
					<li class="breadcrumb-item"><a href="javascript: void(0);">Customer</a></li>
					<li class="breadcrumb-item active">Dashboard</li>
				</ol>
			</div>
			<h4 class="page-title">Customer</h4>
		</div>
	</div>
</div>   

<?php 
if (isset($_REQUEST['hapus'])) {
	$sql = "DELETE FROM master_pertanyaan_review WHERE id='".$_REQUEST['id']."'";
	$exc = mysqli_query($conn,$sql);
	if ($exc) {
		echo '
		<div class="alert alert-success alert-dismissible" role="alert">
		<div class="alert-message">
		<strong>Perhatian !! Data berhasil dihapus</strong>
		</div>
		</div>

		<meta http-equiv="refresh" content="1">

		';
	}else{
		echo '
		<div class="alert alert-danger alert-dismissible" role="alert">
		<div class="alert-message">
		<strong>Perhatian !! Data gagal dihapus</strong>
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
						<a href="add_pertanyaan" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Tambah Pertanyaan</a>
						<br>
						<br>
						<table id="basic-datatable" class="table table-stripped">
							<thead class="table-light" style="background-color: #dfe6e9">
								<tr>
									<th width="1%">#</th>
									<th width="10%">Pertanyaan</th>
									<th width="10%">Bobot (%)</th>
									<th width="1%" nowrap="">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$no = 1;
								$wxc = mysqli_query($conn,"SELECT * FROM master_pertanyaan_review ORDER BY pertanyaan ASC");
								while ($data = mysqli_fetch_array($wxc)) {
									?>
									<tr>
										<td width="1%"><?php echo $no++; ?></td>
										<td style="font-weight: bold;"><?php echo $data['pertanyaan']; ?></td>
										<td style="font-weight: bold;"><?php echo $data['bobot']; ?></td>
										<td nowrap="">
											<form action="" method="POST">
												<a href="<?php echo $base_url; ?>add_pertanyaan/<?php echo $data['id']; ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
												<input type="hidden" name="id" value="<?php echo $data['id']; ?>">
												<button type="submit" name="hapus" onclick="return confirm('Apakah anda ingin menghapus data ini ?');" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
											</form>
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