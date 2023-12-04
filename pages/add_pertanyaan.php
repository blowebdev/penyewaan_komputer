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
					<li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
					<li class="breadcrumb-item active">Pertanyaan</li>
				</ol>
			</div>
			<h4 class="page-title">Pertanyaan</h4>
		</div>
	</div>
</div>   

<?php 
if (isset($_POST['simpan'])) {
	$pertanyaan = $_POST['pertanyaan'];
	$bobot = $_POST['bobot'];

	if(!empty($_REQUEST['id'])){
		$sql = "UPDATE master_pertanyaan_review SET pertanyaan='".$pertanyaan."', bobot='".$bobot."' WHERE id='".$_REQUEST['id']."'";
	}else{
		$sql = "INSERT INTO master_pertanyaan_review (pertanyaan,bobot) VALUES ('".$pertanyaan."','".$bobot."')";
	}
	// echo  $sql;
	$exc = mysqli_query($conn,$sql);
	if ($exc) {
		echo '
		<div class="alert alert-success alert-dismissible" role="alert">
		<div class="alert-message">
		<strong>Perhatian !! Data berhasil disimpan</strong>
		</div>
		</div>

		<meta http-equiv="refresh" content="1">

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

if (!empty($_REQUEST['id'])) {
	$datane = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM master_pertanyaan_review WHERE id='".$_REQUEST['id']."'"));
}
?>
<div class="row">
	<div class="col-12">
		<div class="card-box">
			<div class="row">
				<div class="col-12">
					<form class="form-horizontal" enctype="multipart/form-data" role="form" action="" method="POST">
						<div class="form-group row">
							<label class="col-sm-2 col-form-label" for="example-textarea">Pertanyaan</label>
							<div class="col-sm-10">
								<textarea class="form-control" name="pertanyaan" placeholder="Pertanyaan" rows="5" required=""><?php echo $datane['pertanyaan']; ?></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label" for="simpleinput">Bobot</label>
							<div class="col-sm-10">
								<input type="text" name="bobot" class="form-control" value="<?php echo $datane['bobot']; ?>" placeholder="Bobot" required="">
							</div>
						</div>

						
						<div class="form-group row">
							<label class="col-sm-2 col-form-label" for="example-fileinput"></label>
							<div class="col-sm-10">
								<a href="<?php echo $base_url; ?>pertanyaan" type="reset" class="btn btn-danger">Kembali</a>
								<button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>