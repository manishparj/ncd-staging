<?php
include('config/config.php');
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Our Team | ICMR-NIIRNCD </title>
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
    <link rel="stylesheet" href="assets/css/templete.css">

    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="stylenav.css">
    <link rel="stylesheet" href="assets/datatables/dataTables.bootstrap4.css">


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


    <main>

        <!-- slider Area Start-->
        <div class="slider-area">
            <!-- Mobile Menu -->
            <div class="single-slider slider-height2 d-flex align-items-center" style="background-image:url(assets/img/hero/services_hero.jpg);">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap text-center">
                                <h2>हमारी टीम</h2>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- slider Area End-->

        <div class="section-full bg-white">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 m-b15">
							<div class="accordion faq-box" id="accordionExample">

								<!--Director -->
								<div class="card">
									<div class="card-header" id="headingOne">
										<a class="collapsed" href="javascript:;" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
											I. निदेशक
										</a>
									</div>
									<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
										<div class="card-body" style="background-color:#fff;color:black;border:0ch;margin:2px">
											<div class="card shadow mb-4">


												<?php
												$name = 'director';

												$sql = "SELECT * from emp_details where emp_type = (:type) ORDER BY emp_seniority ASC";
												$query = $dbh->prepare($sql);
												$query->bindParam(':type', $name, PDO::PARAM_STR);
												$query->execute();
												$results = $query->fetchAll(PDO::FETCH_OBJ);
												$cnt = 1;
												if ($query->rowCount() > 0) {
													foreach ($results as $result) {                ?>


														<div class="item">
															<div class="client-box style-2">
																<div class="testimonial-pic">
																	<img src="admin/img/our_team/<?php echo $name . "/" . htmlentities($result->emp_image); ?>" />
																</div>
																<div class="testimonial-text clearfix">
																	<div class="testimonial-detail clearfix">
																		<h5 class="testimonial-name m-t0 m-b5"><a href="about-director.php"><u><?php echo htmlentities($result->emp_name_hi); ?></u></a></h5>
																		<span style="color:#000"><?php echo htmlentities($result->emp_desig_hi); ?></span>
																	</div>
																	<p class="card-text" style="margin-top:5px">आई.सी.एम.आर.-राष्ट्रीय असंचारी रोग कार्यान्वयन अनुसंधान संस्थान, जोधपुर-342005<br>
																	अनुसंधान रुचि: <?php echo htmlentities($result->research_interest); ?><br>
																	फोन: <?php echo htmlentities($result->emp_contact); ?><br>
																	ईमेल: <?php echo htmlentities($result->emp_email); ?></p>
																</div>
															</div>
														</div>

												<?php
													}
												} ?>
											</div>
										</div>
									</div>
								</div>
								<!--scientists -->
								<div class="card">
									<div class="card-header" id="headingOne">
										<a class="collapsed" href="javascript:;" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
											II. वैज्ञानिक
										</a>
									</div>
									<div id="collapseTwo" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
										<div class="card-body" style="background-color:#fff;color:black;border:0ch;margin:2px">
											<div class="card shadow mb-4">
												<?php
												$name = 'scientist';

												$sql = "SELECT * from emp_details where emp_type = (:type) AND emp_status = 'Regular' ORDER BY emp_seniority ASC";
												$query = $dbh->prepare($sql);
												$query->bindParam(':type', $name, PDO::PARAM_STR);
												$query->execute();
												$results = $query->fetchAll(PDO::FETCH_OBJ);
												$cnt = 1;
												if ($query->rowCount() > 0) {
													foreach ($results as $result) {                ?>


														<div class="item">
															<div class="client-box style-2">
																<div class="testimonial-pic">
                                  <form method="post" action="<?php echo htmlspecialchars('sci-info.php'); ?>">

                <img src="admin/img/our_team/<?php echo $name . "/" . htmlentities($result->emp_image); ?>" />
                <button type="submit" class="genric-btn success ml-4 mt-2 btn-sm" style="background-color: #003679;height=">View profile »</button>

																</div>
																<div class="testimonial-text">
                                  <input type="hidden" value="<?php echo htmlentities($result->emp_id); ?>" name="emp">
                                  <input type="hidden" value="<?php echo htmlentities($name); ?>" name="name">

																	<p class="card-text"><b><?php echo htmlentities($result->emp_name_hi); ?></b></br>
																		<?php echo htmlentities($result->emp_desig_hi); ?></br>आई.सी.एम.आर.-राष्ट्रीय असंचारी रोग कार्यान्वयन अनुसंधान संस्थान, जोधपुर-342005<br>
																		अनुसंधान रुचि: <?php echo htmlentities($result->research_interest); ?><br>
																	फोन: <?php echo htmlentities($result->emp_contact); ?><br>
																	ईमेल: <?php echo htmlentities($result->emp_email); ?></p>
                                </form>
																</div>
															</div>
														</div>

												<?php
													}
												} ?>
											</div>
										</div>
									</div>
								</div>
								<!--Technical Staff -->
								<div class="card">
									<div class="card-header" id="headingTwo">
										<a class="collapsed" href="javascript:;" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseTwo">
											III. तकनीकी स्टाफ़ </a>
									</div>
									<div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
										<div class="card-body" style="background-color:#fff;color:black;border:0ch;margin:2px">
											<div class="card shadow mb-4">
												<?php
												$name = 'technical';

												$sql = "SELECT * from emp_details where emp_type = (:type) AND emp_status = 'Regular' ORDER BY emp_seniority ASC";
												$query = $dbh->prepare($sql);
												$query->bindParam(':type', $name, PDO::PARAM_STR);
												$query->execute();
												$results = $query->fetchAll(PDO::FETCH_OBJ);
												$cnt = 1;
												if ($query->rowCount() > 0) {
													foreach ($results as $result) {                ?>


														<div class="item">
															<div class="client-box style-2">
																<div class="testimonial-pic">
																	<img src="admin/img/our_team/<?php echo $name . "/" . htmlentities($result->emp_image); ?>" />
																</div>
																<div class="testimonial-text">

																	<p class="card-text"><b><?php echo htmlentities($result->emp_name_hi); ?></b></br>
																		<?php echo htmlentities($result->emp_desig_hi); ?></br>
																		आई.सी.एम.आर.-राष्ट्रीय असंचारी रोग कार्यान्वयन अनुसंधान संस्थान, जोधपुर-342005</br>
																		Email: <?php echo htmlentities($result->emp_email); ?></br>
																</div>
															</div>
														</div>

												<?php
													}
												} ?>


											</div>
										</div>
									</div>
								</div>

								<!--Ministrial Staff -->
								<div class="card">
									<div class="card-header" id="headingFour">
										<a class="collapsed" href="javascript:;" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
											IV. प्रशासनिक एवं लेखा स्टाफ़
										</a>
									</div>
									<div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
										<div class="card-body" style="background-color:#fff;color:black;border:0ch;margin:2px">
											<div class="card shadow mb-4">
												<?php
												$name = 'ministerial';

												$sql = "SELECT * from emp_details where emp_type = (:type) AND emp_status = 'Regular' ORDER BY emp_seniority ASC";
												$query = $dbh->prepare($sql);
												$query->bindParam(':type', $name, PDO::PARAM_STR);
												$query->execute();
												$results = $query->fetchAll(PDO::FETCH_OBJ);
												$cnt = 1;
												if ($query->rowCount() > 0) {
													foreach ($results as $result) {                ?>


														<div class="item">
															<div class="client-box style-2">
																<div class="testimonial-pic">
																	<img src="admin/img/our_team/<?php echo $name . "/" . htmlentities($result->emp_image); ?>" />
																</div>
																<div class="testimonial-text">

																	<p class="card-text"><b><?php echo htmlentities($result->emp_name_hi); ?></b></br>
																		<?php echo htmlentities($result->emp_desig_hi); ?></br>
																		आई.सी.एम.आर.-राष्ट्रीय असंचारी रोग कार्यान्वयन अनुसंधान संस्थान, जोधपुर-342005<br>
																		ईमेल: <?php echo htmlentities($result->emp_email); ?><br>
                                                                        फोन: <?php echo htmlentities($result->emp_contact); ?></p>

																</div>
															</div>
														</div>

												<?php
													}
												} ?>
											</div>

										</div>
									</div>
								</div>

								<!--Supporting Staff -->
								<div class="card">
									<div class="card-header" id="headingFive">
										<a class="collapsed" href="javascript:;" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
											v. सहायक स्टाफ़
										</a>
									</div>
									<div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
										<div class="card-body" style="background-color:#fff;color:black;border:0ch;margin:2px">
											<div class="card shadow mb-4">
												<?php
												$name = 'supportive';

												$sql = "SELECT * from emp_details where emp_type = (:type) AND emp_status = 'Regular' ORDER BY emp_seniority ASC";
												$query = $dbh->prepare($sql);
												$query->bindParam(':type', $name, PDO::PARAM_STR);
												$query->execute();
												$results = $query->fetchAll(PDO::FETCH_OBJ);
												$cnt = 1;
												if ($query->rowCount() > 0) {
													foreach ($results as $result) {                ?>


														<div class="item">
															<div class="client-box style-2">
																<div class="testimonial-pic">
																	<img src="admin/img/our_team/<?php echo $name . "/" . htmlentities($result->emp_image); ?>" />
																</div>
																<div class="testimonial-text">

																	<p class="card-text"><b><?php echo htmlentities($result->emp_name_hi); ?></b></br>
																		<?php echo htmlentities($result->emp_desig); ?></br>
																		आई.सी.एम.आर.-राष्ट्रीय असंचारी रोग कार्यान्वयन अनुसंधान संस्थान, जोधपुर-342005<br>
																		ईमेल: <?php echo htmlentities($result->emp_email); ?><br><br>
																</div>
															</div>
														</div>

												<?php
													}
												} ?>
											</div>

										</div>
									</div>
								</div>

							</div>
						</div>

					</div>
				</div>
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
				$("#bg").css("fontSize", "18px");
                $(".card-text").css("fontSize", "18px");

			});
			$('#btn2').click(function() {
				$("#bg").css("fontSize", "16px");
				$(".card-text").css("fontSize", "16px");


			});
			$('#btn3').click(function() {
				$("#bg").css("fontSize", "13px");
				$(".card-text").css("fontSize", "13px");


			});

		});
	</script>

</body>

</html>
