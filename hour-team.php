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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
	<style>
		.team-section {
			padding: 40px 0;
		}
		.team-item {
				display: flex;
				align-items: center;
				gap: 6px; /* space between icon and text */
				margin-bottom: 4px;
			}
			.team-details .icon {
				width: 18px; /* keeps icons aligned vertically */
				text-align: center;
			}

		.section-title {
			font-size: 28px;
			font-weight: 700;
			margin: 40px 0 20px;
			color: #003679;
			border-left: 5px solid #003679;
			padding-left: 10px;
		}

		.team-grid {
			display: grid;
			grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
			gap: 25px;
		}

		.team-card {
			background: #ffffff;
			border-radius: 14px;
			padding: 20px;
			text-align: center;
			box-shadow: 0 4px 15px rgba(0,0,0,0.1);
			transition: 0.3s;
		}

		.team-card:hover {
			transform: translateY(-8px);
			box-shadow: 0 8px 22px rgba(0,0,0,0.15);
		}

		.team-card img {
			width: 160px;
			height: 160px;
			border-radius: 5%;
			object-fit: cover;
			margin-bottom: 15px;
			border: 2px solid #003679;
		}

		.card-title {
			font-size: 20px;
			font-weight: 700;
			color: #003679;
		}

		.team-details {
			font-size: 14px;
			color: #333;
			line-height: 1.6;
		}

		.icon {
			color: #003679;
			margin-right: 6px;
			font-size: 15px;
		}
		.view-profile-btn {
			position: relative;
			top:-10px;
			right:-10px;
			display: inline-flex;
			align-items: center;
			gap: 8px;
			background: #003679;
			color: #fff !important;
			padding: 8px 16px;
			border-radius: 15px;
			font-size: 14px;
			font-weight: 600;
			text-decoration: none;
			transition: all 0.3s ease-in-out;
			box-shadow: 0 4px 12px rgba(0,0,0,0.15);
		}

		.view-profile-btn i {
			font-size: 15px;
		}

		.view-profile-btn:hover {
			background: #001e49;
			color: #fff !important;
			transform: translateY(-3px);
			box-shadow: 0 6px 18px rgba(0,0,0,0.20);
		}
		
	</style>

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

    <?php include('config/header.php'); ?>


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
			<div class="container team-section">
					<!-- ========== DIRECTOR ========== -->
				<h2 class="section-title">I. निदेशक</h2>
					<div class="team-grid">
						<?php
							$name = 'director';
							$sql = "SELECT * FROM emp_details WHERE emp_type=:type ORDER BY emp_seniority ASC";
							$query = $dbh->prepare($sql);
							$query->bindParam(':type',$name,PDO::PARAM_STR);
							$query->execute();
							$results = $query->fetchAll(PDO::FETCH_OBJ);

							foreach ($results as $r):
						?>
						<div class="team-card" style="position: relative;">

							<!-- TOP-RIGHT VIEW PROFILE BUTTON -->
							<a href="about-director.php" 
							class="genric-btn success btn-sm view-profile-btn" 
							style="position:absolute; top:10px; right:10px; background-color:#003679; z-index:10; text-decoration:none;">
								<i class="fa-solid fa-circle-info"></i>Profile</a>
							

							<img src="admin/img/our_team/<?= $name ?>/<?= htmlentities($r->emp_image) ?>" style="object-fit: contain;">

							<div class="card-title"><?= htmlentities($r->emp_name_hi) ?></div>

							<div class="team-details">

								<div class="team-row">
									<i class="fa fa-id-badge icon"></i>
									<span><?= strtoupper($r->emp_desig_hi) ?></span>
								</div>

								<?php if(!empty($r->research_interest)): ?>
								<div class="team-row">
									<i class="fa fa-flask icon"></i>
									<span><?= htmlentities($r->research_interest) ?></span>
								</div>
								<?php endif; ?>

								<?php if(!empty($r->emp_contact)): ?>
								<div class="team-row">
									<i class="fa fa-phone icon"></i>
									<span><?= htmlentities($r->emp_contact) ?></span>
								</div>
								<?php endif; ?>

								<?php if(!empty($r->emp_email)): ?>
								<div class="team-row">
									<i class="fa fa-envelope icon"></i>
									<span><?= htmlentities($r->emp_email) ?></span>
								</div>
								<?php endif; ?>

							</div>


						</div>
						<?php endforeach; ?>
					</div>
				<!-- ========== SCIENTISTS ========== -->
				<h2 class="section-title">II. वैज्ञानिक</h2>
					<div class="team-grid">
						<?php
							$name = 'scientist';
							$sql = "SELECT * FROM emp_details WHERE emp_type=:type AND emp_status='Regular' ORDER BY emp_seniority ASC";
							$query = $dbh->prepare($sql);
							$query->bindParam(':type',$name,PDO::PARAM_STR);
							$query->execute();
							$results = $query->fetchAll(PDO::FETCH_OBJ);
							foreach ($results as $r):
						?>
						<div class="team-card" style="position: relative;">

							<!-- Top Right View Profile Button -->
							<form method="post" action="<?php echo htmlspecialchars('sci-info.php'); ?>" style="position:absolute; top:10px; right:10px; z-index:10;">
								<input type="hidden" name="emp_id" value="<?= htmlentities($r->emp_id) ?>">
								<input type="hidden" name="name" value="<?= htmlentities($name) ?>">
								<button type="submit" class="view-profile-btn" style="padding:3px; font-size:10px; cursor: pointer;">
								<i class="fa-solid fa-circle-info"></i>Profile
								</button>
							</form>

							<img src="admin/img/our_team/<?= $name ?>/<?= htmlentities($r->emp_image) ?>">

							<div class="card-title"><?= htmlentities($r->emp_name_hi) ?></div>

							<div class="team-details">

								<div class="team-item">
									<i class="fa fa-id-badge icon"></i>
									<?= htmlentities($r->emp_desig_hi) ?>
								</div>

								<!-- <?php if (!empty($r->research_interest)): ?>
								<div class="team-item">
									<i class="fa fa-flask icon"></i>
									<?= htmlentities($r->research_interest) ?>
								</div>
								<?php endif; ?> -->

								<?php if (!empty($r->emp_email)): ?>
								<div class="team-item">
									<i class="fa fa-envelope icon"></i>
									<?= htmlentities($r->emp_email) ?>
								</div>
								<?php endif; ?>

								<?php if (!empty($r->emp_contact)): ?>
								<div class="team-item">
									<i class="fa fa-phone icon"></i>
									<?= htmlentities($r->emp_contact) ?>
								</div>
								<?php endif; ?>

							</div>
						</div>
						<?php endforeach; ?>
					</div>
				<!-- ========== TECHNICAL STAFF ========== -->
				<h2 class="section-title">III. तकनीकी स्टाफ़ </h2>
				<div class="team-grid">
					<?php
						$name = 'technical';
						$sql = "SELECT * FROM emp_details WHERE emp_type=:type AND emp_status='Regular' ORDER BY emp_seniority ASC";
						$query = $dbh->prepare($sql);
						$query->bindParam(':type',$name,PDO::PARAM_STR);
						$query->execute();
						$results = $query->fetchAll(PDO::FETCH_OBJ);

						foreach ($results as $r):
					?>
					<div class="team-card">
						<img src="admin/img/our_team/<?= $name ?>/<?= htmlentities($r->emp_image) ?>">

						<div class="card-title"><?= htmlentities($r->emp_name_hi) ?></div>
						<div class="team-details">

							<div class="team-item">
								<i class="fa fa-id-badge icon"></i>
								<?= htmlentities($r->emp_desig_hi) ?>
							</div>

							<!-- Institute name if needed -->
							<!-- <div class="team-item">
								<i class="fa fa-building icon"></i>
								<?= htmlentities($r->instt_name) ?>
							</div> -->

							<?php if (!empty($r->emp_email)): ?>
							<div class="team-item">
								<i class="fa fa-envelope icon"></i>
								<?= htmlentities($r->emp_email) ?>
							</div>
							<?php endif; ?>

						</div>
					</div>
					<?php endforeach; ?>
				</div>
				<!-- ========== MINISTERIAL STAFF ========== -->
				<h2 class="section-title">IV. प्रशासनिक एवं लेखा स्टाफ़</h2>
				<div class="team-grid">
					<?php
						$name = 'ministerial';
						$sql = "SELECT * FROM emp_details WHERE emp_type=:type AND emp_status='Regular' ORDER BY emp_seniority ASC";
						$query = $dbh->prepare($sql);
						$query->bindParam(':type',$name,PDO::PARAM_STR);
						$query->execute();
						$results = $query->fetchAll(PDO::FETCH_OBJ);

						foreach ($results as $r):
					?>
					<div class="team-card">
						<img src="admin/img/our_team/<?= $name ?>/<?= htmlentities($r->emp_image) ?>">

						<div class="card-title"><?= htmlentities($r->emp_name_hi) ?></div>

						<div class="team-details">

							<div class="team-item">
								<i class="fa fa-id-badge icon"></i>
								<?= htmlentities($r->emp_desig_hi) ?>
							</div>

							<!-- Institute name if needed -->
							<!-- <div class="team-item">
								<i class="fa fa-building icon"></i>
								<?= htmlentities($r->instt_name) ?>
							</div> -->

							<?php if (!empty($r->emp_email)): ?>
							<div class="team-item">
								<i class="fa fa-envelope icon"></i>
								<?= htmlentities($r->emp_email) ?>
							</div>
							<?php endif; ?>

							<?php if (!empty($r->emp_contact)): ?>
							<div class="team-item">
								<i class="fa fa-phone icon"></i>
								<?= htmlentities($r->emp_contact) ?>
							</div>
							<?php endif; ?>

						</div>
					</div>
					<?php endforeach; ?>
				</div>
				<!-- ========== SUPPORTING STAFF ========== -->
				<h2 class="section-title">v. सहायक स्टाफ़</h2>
				<div class="team-grid">
					<?php
						$name = 'supportive';
						$sql = "SELECT * FROM emp_details WHERE emp_type=:type AND emp_status='Regular' ORDER BY emp_seniority ASC";
						$query = $dbh->prepare($sql);
						$query->bindParam(':type',$name,PDO::PARAM_STR);
						$query->execute();
						$results = $query->fetchAll(PDO::FETCH_OBJ);

						foreach ($results as $r):
					?>
					<div class="team-card">
						<img src="admin/img/our_team/<?= $name ?>/<?= htmlentities($r->emp_image) ?>">

						<div class="card-title"><?= htmlentities($r->emp_name_hi) ?></div>

						<div class="team-details">
							<i class="fa fa-id-badge icon"></i> <?= htmlentities($r->emp_desig_hi) ?><br>

							<!-- <?= htmlentities($r->instt_name) ?><br> -->

							<?php if(!empty($r->emp_email)): ?>
								<i class="fa fa-envelope icon"></i> <?= htmlentities($r->emp_email) ?>
							<?php endif; ?>
						</div>

					</div>
					<?php endforeach; ?>
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
