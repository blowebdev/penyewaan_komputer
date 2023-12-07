<?php
include 'config/koneksi.php';
error_reporting(0);
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from coderthemes.com/minton/layouts/horizontal/multicolor/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 07 Apr 2020 07:48:33 GMT -->
<head>
	<meta charset="utf-8" />
	<title>Penyewaan Alat Komputer</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
	<meta content="Coderthemes" name="author" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<!-- App favicon -->
	<link rel="shortcut icon" href="<?php echo $base_url; ?>assets/images/favicon.ico">

	<!-- third party css -->
	<link href="<?php echo $base_url; ?>assets/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $base_url; ?>assets/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $base_url; ?>assets/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $base_url; ?>assets/libs/datatables/select.bootstrap4.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $base_url; ?>assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $base_url; ?>assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css" />
	<!-- third party css end -->

	<!-- Plugins css-->
	<link href="<?php echo $base_url; ?>assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $base_url; ?>assets/libs/clockpicker/bootstrap-clockpicker.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $base_url; ?>assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $base_url; ?>assets/libs/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

	<!-- App css -->
	<link href="<?php echo $base_url; ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $base_url; ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $base_url; ?>assets/css/app.min.css" rel="stylesheet" type="text/css" />
	<script src="<?php echo $base_url; ?>chart/canvasjs.min.js"></script>

	<style type="text/css">
		.tasklist li.task-low{border-left-color:#1abc9c}.tasklist li.task-high{border-left-color:#f1556c}.tasklist .checkbox{margin-left:20px;margin-top:5px}.task-placeholder{border:1px dashed #dee2e6!important;background-color:#f1f5f7!important;padding:20px}.product-box{position:relative}.product-box .product-img{position:relative;overflow:hidden}.product-box .product-action{position:absolute;left:0;bottom:0;width:100%;transform:translateY(52px);transition:all .4s}.product-box:hover .product-action{transform:translateY(0)}.product-detail-carousel .product-nav-img{display:block;background-color:#f1f5f7}.product-detail-carousel .product-carousel-indicators{position:relative}.product-detail-carousel .product-carousel-indicators li{width:auto;height:auto;min-width:80px;margin:0 7px;padding:4px;border:1px solid #dee2e6;border-radius:4px}.product-thumb{padding:3px;margin-top:3px}.product-thumb.active{background-color:#6c757d!important}.track-order-list ul li{position:relative;border-left:2px solid #dee2e6;padding:0 0 14px 21px}.track-order-list ul li:first-child{padding-top:0}.track-order-list ul li:last-child{padding-bottom:0}.track-order-list ul li:before{content:"";position:absolute;left:-7px;top:0;height:12px;width:12px;background-color:#3bafda;border-radius:50%;border:3px solid #fff}.track-order-list ul li.completed{border-color:#3bafda}.track-order-list ul li .active-dot.dot{top:-9px;left:-16px;border-color:#3bafda}
		.table-light {
			--bs-table-bg: #f1f5f7;
			--bs-table-striped-bg: #343a40;
			--bs-table-striped-color: #fff;
			--bs-table-active-bg: #dee2e5;
			--bs-table-active-color: #343a40;
			--bs-table-hover-bg: #e3e7e9;
			--bs-table-hover-color: #343a40;
			color: #343a40;
			border-color: #dee2e5;
		}
		table tbody tr td{
			vertical-align: top;
		}
	</style>

</head>

<body>

	<!-- Navigation Bar-->
	<header id="topnav">

		<!-- Topbar Start -->
		<div class="navbar-custom">
			<div class="container-fluid">
				<ul class="list-unstyled topnav-menu float-right mb-0">

					<li class="dropdown notification-list">
						<!-- Mobile menu toggle-->
						<a class="navbar-toggle nav-link">
							<div class="lines">
								<span></span>
								<span></span>
								<span></span>
							</div>
						</a>
						<!-- End mobile menu toggle-->
					</li>
					<?php if(!in_array($_SESSION['level'], array('1'))): ?>
						<li class="dropdown notification-list">
							<a class="nav-link dropdown-toggle  waves-effect waves-light" href="<?php echo $base_url; ?>cart" role="button" aria-haspopup="false" aria-expanded="false">
								<i class="fe-shopping-cart noti-icon"></i>
								<span class="badge badge-danger rounded-circle noti-icon-badge" id="qty">0</span>
							</a>
						</li>
						<li class="dropdown notification-list">

								<?php 
									$sqlee =" SELECT v.*, SUM(v.qty) as total FROM (
                                   SELECT 
                                      a.create_at, 
                                      a.kode_transaksi, 
                                      b.nama,  
                                      a.id as id_detail, 
                                      a.qty,  
                                      DATEDIFF(a.tgl_selesai, a.tgl_pinjam) AS total_hari,
                                   IF(NOW() > a.tgl_selesai, 'Perlu dikembalikan', 'Proses') AS status, 
                                   a.status as status_up,
                                   DATEDIFF(NOW(),a.tgl_selesai) AS sisa_hari,
                                   a.id_pelanggan
                                   FROM `master_detail_transaksi` as a 
                                   LEFT JOIN master_produk as b ON a.id_produk = b.id
                                   ) as v WHERE v.status='Perlu dikembalikan'  AND v.status_up<>'SUDAH' AND v.sisa_hari<>'' 
                                   AND v.id_pelanggan='".$_SESSION['id_pelanggan']."'
                                    GROUP BY  v.id_detail";
                                    // echo $sqlee;
									$total_isine_pesanan = mysqli_num_rows(mysqli_query($conn,$sqlee));
								?>
								<a class="nav-link dropdown-toggle  waves-effect waves-light" href="<?php echo $base_url; ?>item_harus_dikembalikan" role="button" aria-haspopup="false" aria-expanded="false">
									<i class="fe-bell noti-icon"></i>
									<span class="badge badge-danger rounded-circle noti-icon-badge"><?php echo $total_isine_pesanan; ?></span>
								</a>
							</li>
					<?php else : ?>
						<?php if(in_array($_SESSION['level'], array('1'))): 
							$total_isine_pesanan = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM master_transaksi WHERE status='PROSES'"));
						?>
							<li class="dropdown notification-list">
								<a class="nav-link dropdown-toggle  waves-effect waves-light" href="<?php echo $base_url; ?>transaksi" role="button" aria-haspopup="false" aria-expanded="false">
									<i class="fe-bell noti-icon"></i>
									<span class="badge badge-danger rounded-circle noti-icon-badge"><?php echo $total_isine_pesanan; ?></span>
								</a>
							</li>
						<?php endif; ?>
					<?php endif; ?>
					<?php if(!empty($_SESSION['username'])) : ?>
						<li class="dropdown notification-list">
							<a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
								<img src="<?php echo $base_url; ?>assets/images/users/avatar-1.jpg" alt="user-image" class="rounded-circle">
								<span class="pro-user-name ml-1">
									<?php echo strtoupper($_SESSION['username']); ?><i class="mdi mdi-chevron-down"></i> 
								</span>
							</a>
							<div class="dropdown-menu dropdown-menu-right profile-dropdown ">
								<!-- item-->
								<div class="dropdown-header noti-title">
									<h6 class="text-overflow m-0">Welcome !</h6>
								</div>

								<!-- item-->
								<a href="javascript:void(0);" class="dropdown-item notify-item">
									<i class="remixicon-account-circle-line"></i>
									<span>My Account</span>
								</a>
								<div class="dropdown-divider"></div>

								<!-- item-->
								<a href="<?php echo $base_url; ?>logout" class="dropdown-item notify-item">
									<i class="remixicon-logout-box-line"></i>
									<span>Logout</span>
								</a>

							</div>
						</li>            
						<?php else : ?>
							<!-- <li class="dropdown notification-list">
								<a class="nav-link dropdown-toggle  waves-effect waves-light" href="<?php echo $base_url; ?>login" role="button" aria-haspopup="false" aria-expanded="false">
									<i class="fe-lock noti-icon"></i> Login
								</a>
							</li> -->
						<?php endif; ?>

					</ul>

					<!-- LOGO -->
					<div class="logo-box">
						<a href="./" class="logo text-center">
							<span class="logo-lg">
								<!-- <img src="<?php echo $base_url; ?>assets/images/logo.png" alt="" height="60"> -->
								<span class="logo-lg-text-light">Sewa Komputer</span></span>
							</span>
							<span class="logo-sm">
								<span class="logo-sm-text-dark">X</span>
								<!-- <img src="<?php echo $base_url; ?>assets/images/logo.png" alt="" height="60"> -->
							</span>
						</a>
					</div>


					<div class="clearfix"></div>
				</div>
			</div>
			<!-- end Topbar -->

			<div class="topbar-menu">
				<div class="container-fluid">
					<div id="navigation">
						<!-- Navigation Menu-->
						<ul class="navigation-menu">

							<li class="has-submenu">
								<a href="<?php echo $base_url; ?>home"><i class="fa fa-home"></i>Home </a>
							</li>
							<?php if(empty($_SESSION['level'])) : ?>
								<li class="has-submenu">
									<a href="<?php echo $base_url; ?>produk"><i class="fe-maximize"></i> Produk </a>
								</li>
								<li class="has-submenu">
									<a href="<?php echo $base_url; ?>pencarian_tanggal"><i class="fe-shopping-bag"></i> Sewa </a>
								</li>
								<li class="has-submenu">
									<a href="<?php echo $base_url; ?>faq"><i class="fe-command"></i>FAQ </a>
								</li>
							<?php endif; ?>
							<?php if(in_array($_SESSION['level'], array('1'))) : ?>
								<li class="has-submenu">
									<a href="#"><i class="fa fa-database"></i> Master <div class="arrow-down"></div></a>
									<ul class="submenu">
										<li>
											<a href="<?php echo $base_url; ?>produk_list">Produk</a>
											<a href="<?php echo $base_url; ?>customer">Customer</a>
										</li>
									</ul>
								</li>
								<li class="has-submenu">
									<a href="#"><i class="fa fa-shopping-cart"></i> Transaksi <div class="arrow-down"></div></a>
									<ul class="submenu">
										<li>
											<a href="<?php echo $base_url; ?>transaksi">List Transaksi</a>
											<a href="<?php echo $base_url; ?>item_harus_dikembalikan">Barang Dikembalikan</a>
											
										</li>
									</ul>
								</li>
								<!-- <li class="has-submenu">
									<a href="#"><i class="fa fa-calculator"></i> Review <div class="arrow-down"></div></a>
									<ul class="submenu">
										<li>
											<a href="<?php echo $base_url; ?>pertanyaan">Pertanyaan</a>
											<a href="<?php echo $base_url; ?>hasil_review">Hasil Review</a>
										</li>
									</ul>
								</li> -->
								<li class="has-submenu">
									<a href="#"><i class="fa fa-list"></i> Laporan<div class="arrow-down"></div></a>
									<ul class="submenu">
										<li>
											<a href="<?php echo $base_url; ?>laporan_pendapatan">Informasi Pendapatan</a>
											<a href="<?php echo $base_url; ?>laporan_stock">Informasi Stock</a>
											<a href="<?php echo $base_url; ?>laporan_jenis">Informasi Jenis</a>
											<a href="<?php echo $base_url; ?>laporan_pengiriman_total">Informasi Pengiriman / Pengembalian barang / Denda</a>
											<!-- <a href="<?php echo $base_url; ?>item_harus_dikembalikan/item_harus_kembali">Barang yang harus di kembalikan</a>
											<a href="<?php echo $base_url; ?>item_harus_dikembalikan/item_sudah_kembali">Barang yang sudah dikembalikan</a> -->
											<a href="<?php echo $base_url; ?>laporan">Penyewaan</a>
										</li>
									</ul>
								</li>
								<li class="has-submenu">
									<a href="<?php echo $base_url; ?>logout"><i class="fe-log-out"></i>Logout </a>
								</li>
							<?php endif ?>
							<?php if(in_array($_SESSION['level'], array('2'))) : ?>
								<li class="has-submenu">
									<a href="#"><i class="fe-archive"></i>Transaksi <div class="arrow-down"></div></a>
									<ul class="submenu">
										<li>
											<a href="<?php echo $base_url; ?>transaksi">Transaksi</a>
											<a href="<?php echo $base_url; ?>item_harus_dikembalikan">Barang Dikembalikan</a>
											<a href="<?php echo $base_url; ?>konfirmasi_pembayaran">Konfirmasi Pembayaran</a>
										</li>
									</ul>
								</li>
								<!-- <li class="has-submenu">
									<a href="#"><i class="fe-shopping-bag"></i>Laporan <div class="arrow-down"></div></a>
									<ul class="submenu">
										<li>
											<a href="<?php echo $base_url; ?>laporan">Laporan</a>
										</li>
									</ul>
								</li> -->
								<li class="has-submenu">
									<a href="#"><i class="fa fa-list"></i> Laporan<div class="arrow-down"></div></a>
									<ul class="submenu">
										<li>
											<a href="<?php echo $base_url; ?>laporan_pendapatan">Informasi Pendapatan</a>
											<a href="<?php echo $base_url; ?>laporan_stock">Informasi Stock</a>
											<a href="<?php echo $base_url; ?>laporan_jenis">Informasi Jenis</a>
											<a href="<?php echo $base_url; ?>laporan_pengiriman_total">Informasi Pengiriman / Pengembalian barang / Denda</a>
											<!-- <a href="<?php echo $base_url; ?>item_harus_dikembalikan/item_harus_kembali">Barang yang harus di kembalikan</a>
											<a href="<?php echo $base_url; ?>item_harus_dikembalikan/item_sudah_kembali">Barang yang sudah dikembalikan</a> -->
											<a href="<?php echo $base_url; ?>laporan">Penyewaan</a>
										</li>
									</ul>
								</li>
								<li class="has-submenu">
									<a href="<?php echo $base_url; ?>logout"><i class="fe-log-out"></i>Logout </a>
								</li>
							<?php endif; ?>
							
						</ul>

						<!-- End navigation menu -->

						<div class="clearfix"></div>
					</div>
					<!-- end #navigation -->
				</div>
				<!-- end container -->
			</div>
			<!-- end navbar-custom -->

		</header>
		<!-- End Navigation Bar-->

		<!-- ============================================================== -->
		<!-- Start Page Content here -->
		<!-- ============================================================== -->

		<div class="wrapper">
			<div class="container-fluid">

				<?php 

				if (file_exists("pages/".$_GET['page'].".php")) {
					if($_GET['page']!="home"){
						include"pages/".$_GET['page'].".php";
					}else{
						include"pages/home.php";
					}
				}else{
					include"pages/home.php";
				} 
				?>


			</div>
			<!-- end wrapper -->

			<!-- ============================================================== -->
			<!-- End Page content -->
			<!-- ============================================================== -->

			<!-- Footer Start -->
			<!-- <footer class="footer">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-6">
							2023 &copy; Surya Outdoor
						</div>

					</div>
				</div>
			</footer> -->
			<!-- end Footer -->

			<!-- Right bar overlay-->
			<div class="rightbar-overlay"></div>


			<!-- Vendor js -->
			<script src="<?php echo $base_url; ?>assets/js/vendor.min.js"></script>
			<!-- third party js -->
			<script src="<?php echo $base_url; ?>assets/libs/datatables/jquery.dataTables.min.js"></script>
			<script src="<?php echo $base_url; ?>assets/libs/datatables/dataTables.bootstrap4.js"></script>
			<script src="<?php echo $base_url; ?>assets/libs/datatables/dataTables.responsive.min.js"></script>
			<script src="<?php echo $base_url; ?>assets/libs/datatables/responsive.bootstrap4.min.js"></script>
			<script src="<?php echo $base_url; ?>assets/libs/datatables/dataTables.buttons.min.js"></script>
			<script src="<?php echo $base_url; ?>assets/libs/datatables/buttons.bootstrap4.min.js"></script>
			<script src="<?php echo $base_url; ?>assets/libs/datatables/buttons.html5.min.js"></script>
			<script src="<?php echo $base_url; ?>assets/libs/datatables/buttons.flash.min.js"></script>
			<script src="<?php echo $base_url; ?>assets/libs/datatables/buttons.print.min.js"></script>
			<script src="<?php echo $base_url; ?>assets/libs/datatables/dataTables.keyTable.min.js"></script>
			<script src="<?php echo $base_url; ?>assets/libs/datatables/dataTables.select.min.js"></script>
			<script src="<?php echo $base_url; ?>assets/libs/pdfmake/pdfmake.min.js"></script>
			<script src="<?php echo $base_url; ?>assets/libs/pdfmake/vfs_fonts.js"></script>
			<script src="<?php echo $base_url; ?>assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
			<script src="<?php echo $base_url; ?>assets/libs/apexcharts/apexcharts.min.js"></script>
			<!-- third party js ends -->

			<!-- Plugins js-->
			<script src="<?php echo $base_url; ?>assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js"></script>
			<script src="<?php echo $base_url; ?>assets/libs/clockpicker/bootstrap-clockpicker.min.js"></script>
			<script src="<?php echo $base_url; ?>assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
			<script src="<?php echo $base_url; ?>assets/libs/moment/moment.min.js"></script>
			<script src="<?php echo $base_url; ?>assets/libs/bootstrap-daterangepicker/daterangepicker.js"></script>

			<!-- Init js-->
			<script src="<?php echo $base_url; ?>assets/js/pages/form-pickers.init.js"></script>

			<script src="<?php echo $base_url; ?>assets/libs/sweetalert2/sweetalert2.min.js"></script>

			<!-- Sweet alert init js-->
			<script src="<?php echo $base_url; ?>assets/js/pages/sweet-alerts.init.js"></script>

			  <script src="<?php echo $base_url; ?>assets/libs/custombox/custombox.min.js"></script>

			<!-- Datatables init -->
			<script src="<?php echo $base_url; ?>assets/js/pages/datatables.init.js"></script>
			<!-- App js -->
			<script src="<?php echo $base_url; ?>assets/js/app.min.js"></script>

			<script type="text/javascript">
				updateQty();
				$('.tanggal_pesan').daterangepicker({
					timePicker: true,
					timePickerIncrement: 15,
					locale: {
						format: 'YYYY-MM-DD HH:mm',
						separator: ' - ',
						applyLabel: 'Pilih',
						cancelLabel: 'Batal',
						fromLabel: 'Dari',
						toLabel: 'Hingga',
						customRangeLabel: 'Rentang Tanggal',
						daysOfWeek: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
						monthNames: [
						'Januari',
						'Februari',
						'Maret',
						'April',
						'Mei',
						'Juni',
						'Juli',
						'Agustus',
						'September',
						'Oktober',
						'November',
						'Desember',
						],
						firstDay: 1,
					},
					minDate: moment().startOf('day'), 
					startDate: moment().startOf('hour').add(7, 'hours'), 
				}, function(start, end) {
					var totalDays = moment.duration(end.diff(start)).asDays() + 1;
					const dateRange = $('.tanggal_pesan').val().split(' - ');
					cekTanggal(dateRange[0],dateRange[1]);
				});


				$('.tanggal_pinjam').daterangepicker({
					singleDatePicker: true,
					timePickerIncrement: 15,
					timePicker: true,
					showDropdowns: true,
					locale: {
						format: 'YYYY-MM-DD H:mm',
						separator: ' - ',
						applyLabel: 'Pilih',
						cancelLabel: 'Batal',
						fromLabel: 'Dari',
						toLabel: 'Hingga',
						customRangeLabel: 'Rentang Tanggal',
						daysOfWeek: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
						monthNames: [
						'Januari',
						'Februari',
						'Maret',
						'April',
						'Mei',
						'Juni',
						'Juli',
						'Agustus',
						'September',
						'Oktober',
						'November',
						'Desember',
						],
						firstDay: 1,
					},
					minDate: moment().startOf('day'), 
					startDate: moment().startOf('hour').add(1, 'hours'), 
				});

				$('.tanggal_selesai').daterangepicker({
					timePicker: true,
					timePickerIncrement: 11,
					singleDatePicker: true,
					showDropdowns: true,
					locale: {
						format: 'YYYY-MM-DD H:mm',
						separator: ' - ',
						applyLabel: 'Pilih',
						cancelLabel: 'Batal',
						fromLabel: 'Dari',
						toLabel: 'Hingga',
						customRangeLabel: 'Rentang Tanggal',
						daysOfWeek: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
						monthNames: [
						'Januari',
						'Februari',
						'Maret',
						'April',
						'Mei',
						'Juni',
						'Juli',
						'Agustus',
						'September',
						'Oktober',
						'November',
						'Desember',
						],
						firstDay: 1,
					},
					minDate: moment().startOf('day'), 
					startDate: moment().startOf('hour').add(24, 'hours'), 
				});

				function cekTanggal(startDate, endDate){
					$.ajax({
						url: '<?php echo $base_url ?>pages/act_cek_tanggal.php',
						type: 'POST',
						dataType: 'html',
						data: {mulai: startDate, selesai:endDate},
						success : function(data){
							console.log(data);
						}
					});
				}

				function updateQty(){
					$("#qty").html('...');
					$.ajax({
						url: '<?php echo $base_url; ?>pages/act_show_qty.php',
						type: 'POST',
						dataType: 'json',
						data: {id:'<?php echo $_SESSION['id_pelanggan']; ?>'},
						success : function(data){
                // console.log(data.qty);
                $("#qty").html(data.qty);
            }
        });
				}

				var defaultOptions = {
				};
				$('[data-toggle="touchspin"]').each(function (idx, obj) {
					var objOptions = $.extend({}, defaultOptions, $(obj).data());
					$(obj).TouchSpin(objOptions);
				});

			</script>

		</body>

		<!-- Mirrored from coderthemes.com/minton/layouts/horizontal/multicolor/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 07 Apr 2020 07:48:34 GMT -->

		<!-- file:///G:/TOOL%20%20WEB/Template%20Admin/PendaftaranSkripsi/dd/coderthemes.com/minton/layouts/horizontal/multicolor/charts-apex.html -->
		</html>