                <!-- start page title -->
                <div class="row">
                	<div class="col-12">
                		<h4 class="page-title"><br></h4>
                	</div>
                </div>
            </div>     
            <!-- end page title --> 
            <div class="row justify-content-center">
            	<div class="col-md-8 col-lg-6 col-xl-5">
            		<div class="card">

            			<div class="card-body p-4">

            				<div class="text-center w-75 m-auto">
            					<span style="font-weight: bold; font-size: 20px">Surya Outdor Camping</span>
            					<p class="text-muted mb-4 mt-3">Enter your email address and password to access admin panel.</p>
            				</div>
            				<?php 
            				if (isset($_POST['login'])) {
            					$username  = $_POST['username'];
            					$password  = md5($_POST['password']);
            					$query = mysqli_query($conn,"SELECT * FROM `master_user` WHERE username = '$username' AND password = '$password'");
            					$cek = mysqli_num_rows($query);
            					$data = mysqli_fetch_array($query);
            					if ($cek > 0) {
            						$_SESSION['level'] = $data['level'];
            						$_SESSION['username'] = $data['username'];
            						$_SESSION['nama']   = $data['nama'];
            						$_SESSION['admin_id']= $data['admin_id'];?>
            						<script>
            							window.location = "./"
            						</script>
            					<?php }else{
            						$username  = $_POST['username'];
            						$password  = md5($_POST['password']);
            						$query = mysqli_query($conn,"SELECT * FROM `master_pelanggan` WHERE username = '$username' AND password = '$password'");
            						$cek = mysqli_num_rows($query);
            						$data = mysqli_fetch_array($query);
            						if ($cek > 0) {
            							$_SESSION['level'] = 2;
            							$_SESSION['username'] = $data['username'];
                                                      $_SESSION['id_pelanggan'] = $data['id'];
            							$_SESSION['nama']   = $data['nama'];
                                                      $_SESSION['user_detail']   = $data;
                                                      ?>
            							<?php if($_SESSION['level']=='admin') : ?>
            								<script>
            									window.location = "./"
            								</script>
            								<?php else: ?>
            									<script>
            										window.location = "./"
            									</script>
            								<?php endif; 
            							}else{
            								echo '
            								<div class="alert alert-danger alert-dismissible" role="alert">
            								<div class="alert-message">
            								<strong>Perhatian !! username Atau password Salah, Silahkan cek kembali</strong>
            								</div>
            								</div>

            								<meta http-equiv="refresh" content="1">

            								';
            							}
            						}
            					}
            					?>  
            					<form action="" method="POST">

            						<div class="form-group mb-3">
            							<label for="emailaddress">Username</label>
            							<input class="form-control" type="username" name="username"  required="" placeholder="Input username">
            						</div>

            						<div class="form-group mb-3">
            							<label for="password">Password</label>
            							<input class="form-control" type="password" name="password" required="" placeholder="Input password">
            						</div>
            						<div class="form-group mb-0 text-center">
            							<button class="btn btn-primary btn-block" name="login" type="submit"> Log In </button>
            						</div>

            					</form>



            					<div class="row mt-3">
            						<div class="col-12 text-center">
            							<p class="text-muted">Belum punya akun ? <a href="register" class="text-primary font-weight-medium ml-1">Daftar</a></p>
            						</div> <!-- end col -->
            					</div>
            				</div>
            			</div>
