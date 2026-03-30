<?php
include('config/config.php');
$id = $_GET['eventid'];
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Photo Gallery | ICMR-NIIRNCD</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- <link rel="manifest" href="site.webmanifest"> -->
	<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
	<!-- Place favicon.ico in the root directory -->


	<!-- CSS here -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
   <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
   <link rel="stylesheet" href="assets/css/slicknav.css">
   <link rel="stylesheet" href="assets/css/animate.min.css">
   <link rel="stylesheet" href="assets/css/magnific-popup.css">
   <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
   <link rel="stylesheet" href="assets/css/themify-icons.css">
   <link rel="stylesheet" href="assets/css/slick.css">
   <link rel="stylesheet" href="assets/css/nice-select.css">
   <link rel="stylesheet" href="assets/css/style.css">
   <link rel="stylesheet" href="assets/css/responsive.css">
	<link rel="stylesheet" href="stylenav.css">

</head>

<body>

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

	<!-- slider Area Start-->
	<div class="slider-area ">
		<!-- Mobile Menu -->
		<div class="single-slider slider-height2 d-flex align-items-center" data-background="assets/img/hero/contact_hero.jpg">
			<div class="container">
				<div class="row">
					<div class="col-xl-12">
						<div class="hero-cap text-center">
						<?php

$sql = "SELECT * from photo_gallery where id = $id";
$query = $dbh->prepare($sql);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);

if ($query->rowCount() > 0) {
	foreach ($results as $result) {
?>
							<h2><?php echo htmlentities($result->title); ?>&nbsp;<?php echo htmlentities($result->year); ?> </h2>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- slider Area End-->




	<!-- Start Align Area -->
	<div class="whole-wrap">
		<div class="container box_1170">


			<div class="section-top-border">

						<div class="card">
							<div class="card-header">
							</div>
							<div class="card-body">
								<div class="row gallery-item">

									<?php
									$sql1 = "SELECT * from gallery where img_id = $result->id";
									$query1 = $dbh->prepare($sql1);
									$query1->execute();
									$resultspg = $query1->fetchAll(PDO::FETCH_OBJ);
									$cnt = 1;
									if ($query1->rowCount() > 0) {
										foreach ($resultspg as $resultpg) {

									?>
											<div class="col-md-4">
												<a href="content/<?php echo htmlentities($result->title); ?>/<?php echo htmlentities($resultpg->imgs); ?>" class="img-pop-up">
													<div class="single-gallery-image" style="background: url(content/<?php echo htmlentities($result->title); ?>/<?php echo htmlentities($resultpg->imgs); ?>);"></div>
												</a>
											</div>
									<?php }
									} ?>

								</div>
							</div>
						</div>

				<?php }
				} ?>
			</div>


		</div>
	</div>
	<!-- End Align Area -->



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
        <script src="./assets/js/plugins.js"></script>
        <script src="./assets/js/main.js"></script>
		<script src="./assets/js/active.js"></script>


</body>

</html>
