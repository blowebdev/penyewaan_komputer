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
                              <span style="font-weight: bold; font-size: 20px">Daftar member <br>Surya Outdor Camping</span>
                              <p class="text-muted mb-4 mt-3">Lengkapi isian dibawah untuk menajutkan penyewaan alat camping.</p>
                        </div>
                        <?php 
                        if (isset($_POST['login'])) {
                              $nama = $_POST['nama'];
                              $alamat = $_POST['alamat'];
                              $hp =  str_replace('+', '', hp($_POST['hp']));
                              $email = $_POST['email'];
                              $username = $_POST['username'];
                              $password = md5($_POST['password']);

                              $url_confirm = "Terimasih sudah mendaftar akun di *Surya Outdoor* Silahkan konfirmasi link dibawah ini untuk aktivasi akun anda \n ".$base_url."confirm.php?email=".md5($email)."&password=".md5($hp);

                              if (!empty($_REQUEST['id'])) {
                                    $hp =  str_replace('+', '', hp($_POST['hp']));
                                    $sql = "UPDATE master_pelanggan SET 
                                    nama ='".$nama."',
                                    hp='".$hp."',
                                    email='".$email."',
                                    alamat='".$alamat."',
                                    username='".$username."',
                                    password='".$password."'
                                    WHERE id='".$_REQUEST['id']."'
                                    ";
                              }else{
                                    $sql = "
                                    INSERT INTO `master_pelanggan`(
                                    `nama`, 
                                    `hp`, 
                                    `email`, 
                                    `alamat`, 
                                    `username`, 
                                    `password`) 
                                    VALUES (
                                    '".$nama."',
                                    '".$hp."',
                                    '".$email."',
                                    '".$alamat."',
                                    '".$username."',
                                    '".$password."')
                                    ";
                              }
                              $exc = mysqli_query($conn,$sql);
                              if ($exc) {

                                    if(!empty($_REQUEST['id'])){
                                          echo '
                                          <div class="alert alert-success alert-dismissible" role="alert">
                                          <div class="alert-message">
                                          <strong>Perhatian !! Data berhasil disimpan</strong>
                                          </div>
                                          </div>
                                          <meta http-equiv="refresh" content="1;">
                                          ';
                                    }else{
                                          $data = array(
                                                'chatId'      => $hp.'@c.us',
                                                'message'    => $url_confirm,
                                          );
                                          $options = array(
                                                'http' => array(
                                                      'method'  => 'POST',
                                                      'content' => json_encode( $data ),
                                                      'header'=>  "Content-Type: application/json\r\n" .
                                                      "Accept: application/json\r\n"
                                                )
                                          );
                                          $url = "https://ru-api.basis-api.com/waInstance1101000819/sendMessage/8c7b8d6b26d891250cb882937249d2aa5cb3c5c15da36079";
                                          $context  = stream_context_create( $options );
                                          $result = file_get_contents( $url, false, $context );
                                          $response = json_decode( $result);

                                          if($exc){
                                                echo '
                                                <div class="alert alert-success alert-dismissible" role="alert">
                                                <div class="alert-message">
                                                <strong>Perhatian !! Data berhasil disimpan</strong>
                                                </div>
                                                </div>
                                                <meta http-equiv="refresh" content="1; url='.$base_url.'done">
                                                ';
                                          }
                                    }


                              }else{
                                    echo '
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                    <div class="alert-message">
                                    <strong>Perhatian !! Data gagal disimpan</strong>
                                    </div>
                                    </div>
                                    ';
                              }


// $data = array(
//       'chatId'      => '@c.us',
//       'message'    => 'Haloo Huda',
// );
// $options = array(
//       'http' => array(
//             'method'  => 'POST',
//             'content' => json_encode( $data ),
//             'header'=>  "Content-Type: application/json\r\n" .
//             "Accept: application/json\r\n"
//       )
// );
// $url = "https://ru-api.basis-api.com/waInstance1101000819/sendMessage/8c7b8d6b26d891250cb882937249d2aa5cb3c5c15da36079";
// $context  = stream_context_create( $options );
// $result = file_get_contents( $url, false, $context );
// $response = json_decode( $result);

// var_dump($response);
                        }

                        if (!empty($_REQUEST['id'])) {
                              $data = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM master_pelanggan WHERE id='".$_REQUEST['id']."'"));
                        }
                        ?>  
                        <form action="" method="POST">
                              <div class="form-group mb-3">
                                    <label for="emailaddress">Nama</label>
                                    <input class="form-control" type="username" name="nama" value="<?php echo $data['nama']; ?>"  required="" placeholder="Input nama">
                              </div>

                              <div class="form-group mb-3">
                                    <label for="emailaddress">Alamat</label>
                                    <textarea class="form-control" rows="5" name="alamat" placeholder="Alamat"><?php echo $data['alamat']; ?></textarea>
                              </div>
                              <div class="form-group mb-3">
                                    <label for="emailaddress">Hp/Whatsapp</label>
                                    <input class="form-control" type="username" name="hp" value="<?php echo $data['hp']; ?>"  required="" placeholder="Input nomor Whatsapp">
                              </div>
                              <div class="form-group mb-3">
                                    <label for="emailaddress">Email</label>
                                    <input class="form-control" type="email" name="email" value="<?php echo $data['email']; ?>"  required="" placeholder="Input email">
                              </div>
                              <div class="form-group mb-3">
                                    <label for="emailaddress">Username</label>
                                    <input class="form-control" type="username" name="username" value="<?php echo $data['username']; ?>"  required="" placeholder="Input username">
                              </div>

                              <div class="form-group mb-3">
                                    <label for="password">Password</label>
                                    <input class="form-control" type="password" name="password" value="<?php echo $data['password']; ?>" required="" placeholder="Input password">
                              </div>
                              <div class="form-group mb-0 text-center">
                                    <button class="btn btn-primary btn-block" name="login" type="submit"> Daftar</button>
                              </div>

                        </form>



                        <div class="row mt-3">
                              <div class="col-12 text-center">
                                    <p class="text-muted">Sudah punya akun ? <a href="login" class="text-primary font-weight-medium ml-1">Login</a></p>
                              </div> <!-- end col -->
                        </div>
                  </div>
            </div>
