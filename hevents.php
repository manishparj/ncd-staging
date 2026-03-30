<?php
include('config/config.php');
// $name = $_GET['pgview'];
$name = "event";

?>
<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>ICMR-NIIRNCD </title>
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
            <style>
            /* Root variables for easy theming */
            :root {
                --primary: #003679;
                --primary-light: #0052a3;
                --text-dark: #1f2937;
                --muted: #6b7280;
                --bg-light: #f9fafb;
            }

            /* Card */
            .card {
                border-radius: 20px;
                box-shadow: 0 15px 35px rgba(0,0,0,0.08);
                background: #fff;
            }

            /* Responsive Table Wrapper */
            .table-responsive {
                border-radius: 16px;
                overflow: hidden;
                width: 100%;
            }

            /* Table Base */
            .table {
                width: 100%;
                border-collapse: separate;
                border-spacing: 0 10px;
                font-family: 'Poppins', Arial, sans-serif;
                table-layout: auto;
            }

            /* Table Header */
            .table thead th {
                background: linear-gradient(135deg, var(--primary), var(--primary-light));
                color: #fff !important;
                padding: 14px 16px;
                font-size: 14px;
                font-weight: 600;
                border: none;
                white-space: nowrap;
            }

            /* Table Rows */
            .table tbody tr {
                background: #fff;
                border-radius: 14px;
                box-shadow: 0 4px 15px rgba(0,0,0,0.05);
                transition: all 0.25s ease-in-out;
            }

            /* Hover Animation */
            .table tbody tr:hover {
                transform: scale(1.01);
                box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            }

            /* Table Cells */
            .table td {
                padding: 14px 16px;
                font-size: 14px;
                color: var(--text-dark);
                border: none;
                word-break: break-word;
            }

            /* Rounded Corners */
            .table tr td:first-child {
                border-radius: 12px 0 0 12px;
            }
            .table tr td:last-child {
                border-radius: 0 12px 12px 0;
            }

            /* Document Link */
            .table a {
                text-decoration: none;
                color: var(--primary);
                font-weight: 600;
                display: inline-flex;
                align-items: center;
                gap: 6px;
                padding: 6px 12px;
                border-radius: 24px;
                background: rgba(0,54,121,0.08);
                transition: all 0.25s ease;
                max-width: 100%;
                word-break: break-word;
            }

            /* Link Hover */
            .table a:hover {
                background: linear-gradient(135deg, var(--primary), var(--primary-light));
                color: #fff;
                transform: translateX(4px);
            }

            /* Remove forced nowrap */
            .text-nowrap {
                white-space: normal !important;
            }

            /* Icons */
            .table i {
                font-size: 14px;
                flex-shrink: 0;
            }

        /* Mobile: Turn rows into cards */
        @media (max-width: 992px) {
            .table thead {
                display: none;
            }

            .table tbody tr {
                display: block;
                padding: 10px 12px;
                margin-bottom: 16px;
                border-radius: 16px;
            }

            .table tbody td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 10px 0;
                font-size: 13px;
                gap: 10px;
            }

            .table tbody td::before {
                content: attr(data-label);
                font-weight: 600;
                font-size: 12px;
                color: var(--muted);
                text-transform: uppercase;
                flex: 1;
            }

            .table tbody td > * {
                flex: 2;
                text-align: right;
            }
        }

        @media (max-width: 992px) {
            .table {
                min-width: 100%;   /* stop forced wide table */
            }

            .table thead th,
            .table td {
                font-size: 13px;
                padding: 10px;
            }
        }

        /* Extra small mobile */
        @media (max-width: 576px) {
            .table thead th,
            .table td {
                font-size: 12px;
                padding: 8px;
            }
        }

        </style>

    </head>

    <body>

        <!-- Preloader Start -->
        <div id="preloader-active">
            <!-- <div class="preloader d-flex align-items-center justify-content-center">
                <div class="preloader-inner position-relative">
                    <div class="preloader-circle"></div>
                    <div class="preloader-img pere-text">
                        <img src="assets/img/logo/loaderlogo.jpg" alt="">
                    </div>
                </div>
            </div> -->
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
                                <h2><?php echo htmlentities($name); ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- slider Area End-->

        <div class="container mt-5" style="margin-bottom: 10%;">

        <div class="card shadow mb-4">
					<div class="card-body" style="background-color:#fff;color:black;border:0ch;margin:2px;font-size:small;">
						<div class="table-responsive">
							<table id="dataTable" class="table table-bordered table-hover" width="100%" cellspacing="0">

								<thead>
									<tr>
										<th style="background-color:#fff;color:black;">क्र सँ  </th>
										<th style="background-color:#fff;color:black;">शीर्षक</th>
										<th style="background-color:#fff;color:black;">दस्तावेज </th>
									</tr>
								</thead>

								<tbody>

									<?php
									$sql = "SELECT * from info_hi where type = '".$name."' ORDER BY id DESC";
									$query = $dbh->prepare($sql);
									$query->execute();
									$results = $query->fetchAll(PDO::FETCH_OBJ);
									$cnt = 1;
									if ($query->rowCount() > 0) {
										foreach ($results as $result) {				?>
											<tr>
                                                 <td data-label="Sr. No."><?php echo htmlentities($cnt); ?>.</td>
                                                <td data-label="Title">
                                                    <?php echo htmlentities($result->title); ?>
                                                </td>
												<td data-label="Document" class="text-nowrap">

												<?php
												$sql9 = "SELECT * from doc_hi where doc_id = $result->id";
												$query9 = $dbh->prepare($sql9);
												$query9->execute();
												$results9 = $query9->fetchAll(PDO::FETCH_OBJ);
												if ($query9->rowCount() > 0) {
                                                    foreach ($results9 as $result19) {
                                                ?>
                                                        <div style="margin-bottom:6px;">
                                                            <a href="admin/hi_doc/<?php echo htmlentities($result19->doc_main); ?>" 
                                                            target="_blank" class="doc-link">
                                                            View Document <i class="fa fa-download"></i>
                                                            </a>
                                                        </div>
                                                <?php 
                                                    }
                                                } else {
                                                    echo '<span class="text-muted">No document</span>';
                                                }
                                                 ?>

											</tr>
									<?php $cnt = $cnt + 1;
										}
									} ?>


								</tbody>
							</table>
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

    </body>
</html>
