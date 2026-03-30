<?php
include('config/config.php');
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Research | ICMR-NIIRNCD </title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="manifest" href="site.webmanifest">
	<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

	<!-- CSS here -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/owl.carousel.min.css">
	<link rel="stylesheet" href="assets/css/flaticon.css">
	<link rel="stylesheet" href="assets/css/slicknav.css">
	<link rel="stylesheet" href="assets/css/animate.min.css">
	<link rel="stylesheet" href="assets/css/magnific-popup.css">
	<link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
	<link rel="stylesheet" href="assets/css/themify-icons.css">
	<link rel="stylesheet" href="assets/css/slick.css">
	<link rel="stylesheet" href="assets/css/nice-select.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="stylenav.css">
	<link rel="stylesheet" href="assets/datatables/dataTables.bootstrap4.css">


</head>

<body id="bg">

	<!-- Preloader Start -->
	<div id="preloader-active">
		<div class="preloader d-flex align-items-center justify-content-center">
			<div class="preloader-inner position-relative">
				<div class="preloader-circle"></div>
				<div class="preloader-img pere-text">
					<img src="assets/img/logo/loaderlogo.jpg" alt="">
				</div>
			</div>
		</div>
	</div>
	<!-- Preloader Start -->

	<?php include('config/hheader.php'); ?>


	<main>

		<!-- slider Area Start-->
		<div class="slider-area">
			<!-- Mobile Menu -->
			<div class="single-slider slider-height2 d-flex align-items-center" style="background-image:url(assets/img/hero/image.png);">
				<div class="container">
					<div class="row">
						<div class="col-xl-12">
							<div class="hero-cap text-center">
								<h2>अनुसंधान</h2>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- slider Area End-->

		<div class="container mt-5">
			<section class="elements-area section-padding-100-0">
				<div class="row">


					<!-- ##### Accordians ##### -->
					<div class="col-12 col-lg-12">
						<div class="accordion faq-box" id="accordionExample">




							<!--ongoing -->
							<div class="card">
								<div class="card-header" id="headingOne">
									<a class="collapsed" href="javascript:;" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
										<?php echo "Ongoing-projects"; ?>
									</a>
								</div>
								<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">

									<div class="card  mb-2">
										<div class="card-body" style="background-color:#fff;color:black;border:0;margin:2px;font-size:small;">

											<div class="table-responsive">
												<table id="" class="table table-bordered table-hover" width="100%" cellspacing="0">
													<thead>
														<tr>
															<th style="background-color:#fff;color:black;">#</th>
															<th style="background-color:#fff;color:black;">प्रकल्प जानकारी</th>
														</tr>
													</thead>
													<tfoot>
														<tr>
														<tr>
															<th>#</th>
															<th>प्रकल्प जानकारी</th>
														</tr>
														</tr>
													</tfoot>
													<tbody>


														<?php

														$sql = "SELECT * from research where research_type = 1 ORDER BY id ASC";
														$query = $dbh->prepare($sql);
														$query->execute();
														$results = $query->fetchAll(PDO::FETCH_OBJ);
														$cnt = 1;
														if ($query->rowCount() > 0) {
															foreach ($results as $result) {
														?>
																<tr>
																	<td style="width:1%;"><?php echo htmlentities($cnt); ?>.</td>
																	<td>
																		<table>
																			<tbody>
																				<tr>
																					<td>
																					शीर्षक:
																					</td>
																					<td>
																						<?php echo htmlentities($result->research_title); ?>
																					</td>
																				</tr>

																				<tr>
																					<td>
																						प्रकल्प समय सीमा:
																					</td>
																					<td>
																					<?php echo htmlentities($result->duration); ?>

																					</td>
																				</tr>


																				<tr>
																					<td>
																						 PI/Site-PI:
																					</td>
																					<td>
																					<?php echo htmlentities($result->pi); ?>

																					</td>
																				</tr>
																			</tbody>
																		</table>
																	</td>

																</tr>
														<?php $cnt = $cnt + 1;
															}
														} ?>


													</tbody>
												</table>
											</div>



										</div>


									</div>
								</div>
							</div>

						

							<div class="card">
								<div class="card-header" id="headingTwo">
									<a class="collapsed" href="javascript:;" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
										<?php echo "Completed-project"; ?>
									</a>
								</div>
								<div id="collapseTwo" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">

									<div class="card  mb-2">
										<div class="card-body" style="background-color:#fff;color:black;border:0;margin:2px;font-size:small;">

											<div class="table-responsive">
												<table id="dataTable" class="table table-bordered table-hover" width="100%" cellspacing="0">
													<thead>
														<tr>
															<th style="background-color:#fff;color:black;">#</th>
															<th style="background-color:#fff;color:black;">शीर्षक</th>
														</tr>
													</thead>
													<tfoot>
														<tr>
														<tr>
															<th>#</th>
															<th>शीर्षक</th>
														</tr>
														</tr>
													</tfoot>
													<tbody>


														<?php

														$sql = "SELECT * from research where research_type = 2 ORDER BY id DESC";
														$query = $dbh->prepare($sql);
														$query->execute();
														$results = $query->fetchAll(PDO::FETCH_OBJ);
														$cnt = 1;
														if ($query->rowCount() > 0) {
															foreach ($results as $result) {
														?>
																<tr>
																	<td style="width:1%;"><?php echo htmlentities($cnt); ?>.</td>
																	<td><?php echo htmlentities($result->research_title); ?></td>


																</tr>
														<?php $cnt = $cnt + 1;
															}
														} ?>


													</tbody>
												</table>
											</div>



										</div>


									</div>
								</div>
							</div>



						</div>
					</div>


				</div>
			</section>
		</div>



	</main>
	<footer>
		<!-- Footer Start-->

		<!-- footer-bottom aera -->
		<?php include('./config/footer.php'); ?>

		<!-- Footer End-->
	</footer>

	<!-- JS here -->

	<!-- All JS Custom Plugins Link Here here -->
	<script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>

	<!-- Jquery, Popper, Bootstrap -->
	<script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
	<script src="./assets/js/popper.min.js"></script>
	<script src="./assets/js/bootstrap.min.js"></script>
	<!-- Jquery Mobile Menu -->
	<script src="./assets/js/jquery.slicknav.min.js"></script>

	<!-- Jquery Slick , Owl-Carousel Plugins -->
	<script src="./assets/js/owl.carousel.min.js"></script>
	<script src="./assets/js/slick.min.js"></script>

	<!-- One Page, Animated-HeadLin -->
	<script src="./assets/js/wow.min.js"></script>
	<script src="./assets/js/animated.headline.js"></script>
	<script src="./assets/js/jquery.magnific-popup.js"></script>

	<!-- Scrollup, nice-select, sticky -->
	<script src="./assets/js/jquery.scrollUp.min.js"></script>
	<script src="./assets/js/jquery.nice-select.min.js"></script>
	<script src="./assets/js/jquery.sticky.js"></script>

	<!-- contact js -->
	<script src="./assets/js/contact.js"></script>
	<script src="./assets/js/jquery.form.js"></script>
	<script src="./assets/js/jquery.validate.min.js"></script>
	<script src="./assets/js/mail-script.js"></script>
	<script src="./assets/js/jquery.ajaxchimp.min.js"></script>

	<!-- Jquery Plugins, main Jquery -->
	<script src="./assets/js/jquery-2.2.4.min.js"></script>
	<script src="./assets/js/plugins.js"></script>
	<script src="./assets/js/main.js"></script>
	<script src="./assets/js/active.js"></script>

	<script src="./assets/js/datatables-demo.js"></script>
	<script src="./assets/datatables/jquery.dataTables.min.js"></script>
	<script src="./assets/datatables/dataTables.bootstrap4.min.js"></script>
	<script>
		$(document).ready(function() {
			$('#btn1').click(function() {
				$(".table").css("fontSize", "18px");
				$("#bg").css("fontSize", "18px");

			});
			$('#btn2').click(function() {
				$(".table").css("fontSize", "16px");
				$("#bg").css("fontSize", "16px");

			});
			$('#btn3').click(function() {
				$(".table").css("fontSize", "13px");
				$("#bg").css("fontSize", "13px");

			});


		});
	</script>
	<script>
		$(document).ready(function() {
			$('.table').DataTable();
		});
	</script>

</body>

</html>
