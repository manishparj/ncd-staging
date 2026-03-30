<?php
include('config/config.php');
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Covid Info | ICMR-NIIRNCD </title>
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
                                <h2>Covid-19 information</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- slider Area End-->

        <div class="container mt-5">
        <div class="card-header text-center">
                    <?php
                    $query = "SELECT * FROM covid_update";
                    $result = mysqli_query($conn, $query);
                    $i = 0;
                    while ($row = mysqli_fetch_array($result)) {
                        $i++;

                        $id = $row['id'];
                        $newDateString = date_format(date_create_from_format('Y-m-d', $row['update_dt']), 'd-m-Y');
                    ?>
                        <h4 class="font-weight-bold"> SARS-CoV-2 (COVID-19) Testing Status</h4>
                        <h5><?php echo htmlentities($newDateString) ?>&nbsp; 09:00 AM IST</h5>
                </div>
            <div class="card-deck border-0 col-lg-12 m-2 ">




                <div class="card col-lg-6 text-center border shadow">
                        <div class="card-body">
                            <h3 class="card-title"><i class="fa fa-users"></i> &nbsp;<b><?php echo $row["sample_all"]?></b></h3>
                            <p class="card-text>">Cumulative Total sample tested at ICMR-NIIRNCD Jodhpur</p>
                    </a>
                </div>
            </div>

            <div class="card col-lg-6 text-center border shadow">
                    <div class="card-body">
                    <h3 class="card-title"><i class="fa fa-users"></i> &nbsp;<b><?php echo $row["sample_day"]?></b></h3>
                            <p class="card-text>">Sample tested in last 24 HRS at ICMR-NIIRNCD Jodhpur</p>
                </a>
            </div>
        </div>
        </div>
    <?php } ?>

    <div style="justify-content: left;padding-top: 30px;">
									<marquee direction="left"><p>for latest update & more information about Covid-19 visit | <a href="www.icmr.org" style="color:blue">ICMR COVID-19 Portal</a> | <a href="#" style="color:blue">Ministry of Health & family welfare COVID-19 Portal</a> </p></marquee>
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
