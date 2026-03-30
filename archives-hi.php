<?php
include('config/config.php');
?>
<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Career | ICMR-NIIRNCD </title>
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
            <div class="single-slider slider-height2 d-flex align-items-center" style="background-image:url(assets/img/hero/services_hero.jpg);">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap text-center">
                                <h2>रिक्तियां</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- slider Area End-->

        <div class="container mt-5">
<!-- <h3 class="text-center">रिक्तियां</h3> -->
        <div class="card shadow mb-4">
					<div class="card-body" style="background-color:#fff;color:black;border:0ch;margin:2px;font-size:small;">
						<div class="table-responsive">
							<table id="dataTable" class="table table-bordered table-hover" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th style="background-color:#fff;color:black;">क्र.सं.</th>
										<th style="background-color:#fff;color:black;">रिक्ति का नाम</th>
										<th style="background-color:#fff;color:black;">अपलोड की तिथि</th>
										<th style="background-color:#fff;color:black;">श्रेणी</th>
										<th style="background-color:#fff;color:black;">स्थिति</th>
										<th style="background-color:#fff;color:black;">अंतिम तिथि/साक्षात्कार तिथि</th>
										<th style="background-color:#fff;color:black;">दस्तावेज़</th>


									</tr>
								</thead>

								<tbody>

									<?php
									$name = 'recruitment';
									$status = 'Archives';
									$sql = "SELECT * from info_hi where type = (:type) and status = (:status) ORDER BY id DESC";
									$query = $dbh->prepare($sql);
									$query->bindParam(':type', $name, PDO::PARAM_STR);
									$query->bindParam(':status', $status, PDO::PARAM_STR);
									$query->execute();
									$results = $query->fetchAll(PDO::FETCH_OBJ);
									$cnt = 1;
									if ($query->rowCount() > 0) {
										foreach ($results as $result) {				?>
											<tr>
												<td><?php echo htmlentities($cnt); ?>.</td>
												<td style="text-align: justify;"><?php echo htmlentities($result->title); ?></td>
                        <?php $newDateString = date_format(date_create_from_format('Y-m-d', $result->upl_date), 'd/m/Y'); ?>

                        <td><?php echo htmlentities($newDateString); ?></td>
												<td><?php echo htmlentities($result->category); ?></td>
												<?php
												$now = date("Y-m-d");
												$date = $result->last_dt;

												if (strtotime($now) > strtotime($date)) {
													$c = '<span style="color:#777">Close</span>';
												} else {
													$c = '<span style="background-color:#013F8A;color:#fff">&nbsp;Open&nbsp;</span>';
												} ?>
												<td><?php echo $c; ?></td>
                        <?php $newDateString1 = date_format(date_create_from_format('Y-m-d', $result->last_dt), 'd/m/Y'); ?>

                        <td><?php echo htmlentities($newDateString1); ?></td>

												<?php
												$sql9 = "SELECT * from doc_hi where doc_id = $result->id";
												$query9 = $dbh->prepare($sql9);
												$query9->execute();
												$results9 = $query9->fetchAll(PDO::FETCH_OBJ);
												if ($query9->rowCount() > 0) {
													foreach ($results9 as $result19) {

														$str[0] = $result19->doc_nm_a;
														$str[1] = $result19->doc_nm_b;
														$str[2] = $result19->doc_nm_c;
														$str[3] = $result19->doc_nm_d;
														$str[4] = $result19->doc_nm_e;
														$str[5] = $result19->doc_nm_f;
														$str[6] = $result19->doc_nm_g;
														$str[7] = $result19->doc_nm_h;
														$str[8] = $result19->doc_nm_i;
														$str[9] = $result19->doc_nm_j;
														$strOutput = array_filter($str);


														$document[0] = $result19->doc_a;
														$document[1] = $result19->doc_b;
														$document[2] = $result19->doc_c;
														$document[3] = $result19->doc_d;
														$document[4] = $result19->doc_e;
														$document[5] = $result19->doc_f;
														$document[6] = $result19->doc_g;
														$document[7] = $result19->doc_h;
														$document[8] = $result19->doc_i;
														$document[9] = $result19->doc_j;
														$subjectOutput = array_filter($document);
												?>
														<td class="text-nowrap"><i class="fa fa-angle-right" aria-hidden="true" style="color:blue"></i>&nbsp;<a href="admin/hi_doc/<?php echo htmlentities($result19->doc_main); ?>" target="_blank">Advertisement <i class="fa fa-download" aria-hidden="true"></i></a><br>
															<i class="fa fa-angle-right" aria-hidden="true" style="color:blue"></i>&nbsp;<a href="admin/other_doc/<?php echo htmlentities($result19->doc_apform); ?>" target="_blank">Application form <i class="fa fa-download" aria-hidden="true"></i></a><br>
															<?php
															$length = count($strOutput);

															for ($i = 0; $i < $length; $i++) {
																echo '<i class="fa fa-angle-right" aria-hidden="true" style="color:blue"></i>&nbsp;<a href="admin/hi_doc/' . $subjectOutput[$i] . '" target="_blank">' . $strOutput[$i] . '&nbsp;<i class="fa fa-download" aria-hidden="true" ></i></a><br>';
																// echo '<script type="text/javascript">alert("'.$strOutput[$i].'")</script>';
															}
															?>

													<?php }
												} ?>
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
				$("#dataTable").css("fontSize", "18px");
				$("#bg").css("fontSize", "18px");

			});
			$('#btn2').click(function() {
				$("#dataTable").css("fontSize", "16px");
				$("#bg").css("fontSize", "16px");

			});
			$('#btn3').click(function() {
				$("#dataTable").css("fontSize", "13px");
				$("#bg").css("fontSize", "13px");

			});


		});
	</script>

    </body>
</html>
