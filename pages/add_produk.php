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
					<li class="breadcrumb-item"><a href="javascript: void(0);">Tambah Produk</a></li>
					<li class="breadcrumb-item active">Dashboard</li>
				</ol>
			</div>
			<h4 class="page-title">Tambah Produk</h4>
		</div>
	</div>
</div>    
<?php 
if (isset($_POST['nama'])) {
	$nama = $_POST['nama'];
	$harga = $_POST['harga'];
	$deskripsi = $_POST['deskripsi'];
	$stock = $_POST['stock'];
	$date            = date("Y-m-d");

	$temp_name       = $_FILES['gambar']['tmp_name'];
	$name_file       = $_FILES['gambar']['name'];
	$type_file       = $_FILES['gambar']['type'];
	$size            = $_FILES['gambar']['size'];
	$nama_gambar        = $_REQUEST['nama_gambar'];
	// var_dump($nama_gambar);

	if (empty($temp_name)) {
		$set_gambar = ",gambar='".$nama_gambar."'";
	}else{  
		$file_ext=strtolower(end(explode('.',$_FILES['gambar']['name'])));
		$expensions= array("jpeg","jpg","png");

		if (in_array($file_ext,$expensions)=== false) {
			echo "salah";
		}elseif($size >= 3097152){
			echo "upload maksimal 3 mb";
		}else{
			$Move = move_uploaded_file($temp_name, 'upload/'.$date."-".$name_file.'');
			if ($Move) {
				unlink('"upload/'.$file.'"');
				$nm_foto  = $date."-".$name_file;
			}
		}

		$set_gambar = ",gambar='".$nm_foto."'";
	}

	if(!empty($_REQUEST['id'])){
		$sql = "UPDATE master_produk SET nama='".$nama."', harga='".$harga."', stock='".$stock."', deskripsi='".$deskripsi."' ".$set_gambar." WHERE id='".$_REQUEST['id']."'";
	}else{
		$sql = "INSERT INTO master_produk (nama,harga,deskripsi,gambar,stock) VALUES ('".$nama."','".$harga."','".$deskripsi."','".$nm_foto."','".$stock."')";
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
	$datane = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM master_produk WHERE id='".$_REQUEST['id']."'"));
}
?>
<div class="row">
	<div class="col-12">
		<div class="card-box">
			<div class="row">
				<div class="col-12">
					<form class="form-horizontal" enctype="multipart/form-data" role="form" action="" method="POST">
						<div class="form-group row">
							<label class="col-sm-2 col-form-label" for="simpleinput">Nama Produk</label>
							<div class="col-sm-10">
								<input type="text" name="nama" class="form-control" value="<?php echo $datane['nama']; ?>" placeholder="Nama Produk" required="">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label" for="example-email">Harga</label>
							<div class="col-sm-10">
								<input type="number" name="harga" value="<?php echo $datane['harga']; ?>" class="form-control" placeholder="Harga" required="">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label" for="example-email">Stock</label>
							<div class="col-sm-10">
								<input type="number" name="stock" value="<?php echo $datane['stock']; ?>" class="form-control" placeholder="Stock" required="">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label" for="example-textarea">Deskripsi</label>
							<div class="col-sm-10">
								<textarea class="form-control" name="deskripsi" placeholder="Deskripsi" rows="5" required=""><?php echo $datane['deskripsi']; ?></textarea>
							</div>
						</div>

						<div class="form-group row">
							<label class="col-sm-2 col-form-label" for="example-fileinput">Gambar</label>

							<div class="col-sm-10">
								<?php if (!empty($datane['gambar'])) :?>
									<img src="<?php echo $base_url.'/upload/'.$datane['gambar']; ?>"  style="width: 300px; height: 300px"/>
									<input type="file" class="form-control" name="gambar">
									<input type="hidden" class="form-control" name="nama_gambar" value="<?php echo $datane['gambar']; ?>">
									<?php else : ?>
										<input type="file" class="form-control" name="gambar" required="">
									<?php endif; ?>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="example-fileinput"></label>
								<div class="col-sm-10">
									<a href="<?php echo $base_url; ?>produk_list" type="reset" class="btn btn-danger">Kembali</a>
									<button type="submit" class="btn btn-primary">Simpan</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>