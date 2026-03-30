<?php
include('config/config.php');
?>
<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Employee Corner | ICMR-NIIRNCD </title>
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
/* General */
/* Grid System */
.tile-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
    gap: 25px;
    padding: 20px 10px;
    max-width: 1300px;
    margin: auto;
}

/* Tile Design */
.tile {
    background: rgba(255, 255, 255, 0.75);
    backdrop-filter: blur(10px);
    border-radius: 24px;
    padding: 30px 15px;
    text-align: center;
    box-shadow: 0 15px 30px rgba(0,0,0,0.08);
    transition: all 0.4s ease;
    position: relative;
    overflow: hidden;
}

/* Glowing Border Effect */
.tile::before {
    content: '';
    position: absolute;
    inset: 0;
    border-radius: 24px;
    padding: 2px;
    /* background: linear-gradient(135deg, #6366f1, #22c55e, #06b6d4); */
    background: linear-gradient(135deg, #003679, #0052a3, #0072d6, #0091ff);
    -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
    -webkit-mask-composite: xor;
            mask-composite: exclude;
    opacity: 0;
    transition: opacity 0.4s ease;
}

.tile:hover::before {
    opacity: 1;
}

/* Hover Animation */
.tile:hover {
    transform: translateY(-12px) scale(1.05);
    box-shadow: 0 25px 50px rgba(0,0,0,0.2);
}

/* Icons */
.tile img {
    position: relative;
    z-index: 2;
    width: 72px;
    height: 72px;
    margin-bottom: 15px;

    filter: brightness(0) invert(1); /* Makes SVG white so gradient shows */
    /* background: linear-gradient(135deg, #6366f1, #22c55e, #06b6d4, #a855f7); */
      background: linear-gradient(135deg, #003679, #0052a3, #0072d6, #0091ff);
    background-size: 300% 300%;
    -webkit-background-clip: text;
    background-clip: text;

    animation: gradientIcon 4s ease infinite;
    transition: transform 0.4s ease;
}

.tile:hover img {
    transform: rotate(10deg) scale(1.15);
}

/* Title */
.tile h5 {
    font-size: 17px;
    font-weight: 600;
    color: #1f2937;
    margin-top: 10px;
    letter-spacing: 0.3px;
}

/* Better Tap Effects for Mobile */
.tile:active {
    transform: scale(0.97);
}

/* Slider Hero Fix */
.slider-height2 {
    background-size: cover;
    background-position: center;
}

/* Responsive Breakpoints */
@media (max-width: 1024px) {
    .tile-grid {
        gap: 20px;
    }
}

@media (max-width: 768px) {
    .tile-grid {
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
    }

    .tile img {
        width: 60px;
        height: 60px;
    }

    .tile h5 {
        font-size: 15px;
    }
}

@media (max-width: 480px) {
    .tile-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
    }
}

.tile {
    -webkit-tap-highlight-color: transparent;
}

.tile::after {
     content: "";
    position: absolute;
    width: 85px;
    height: 85px;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    /* background: linear-gradient(135deg, #6366f1, #22c55e, #06b6d4, #a855f7); */
     background: linear-gradient(135deg, #003679, #0052a3, #0072d6, #0091ff);
    background-size: 400% 400%;
    filter: blur(20px);
    opacity: 0.6;
    z-index: 1;
    animation: gradientIcon 6s ease infinite;
}

.tile:active::after {
    opacity: 1;
}

/* Hover motion for icon */
.tile:hover img {
    transform: scale(1.2) rotate(10deg);
}

/* Animated gradient keyframes */
@keyframes gradientIcon {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
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


    <main style="margin-bottom: 6%;">

         <!-- slider Area Start-->
            <div class="slider-area mb-50">
                <!-- Mobile Menu -->
                <div class="single-slider slider-height2 d-flex align-items-center" style="background-image:url(assets/img/hero/services_hero.jpg);">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="hero-cap text-center">
                                    <h2>Employee Corner</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        <!-- slider Area End-->
                <div class="tile-grid">
                <!-- First row: 4 tiles -->
                <a href="https://icmr.eoffice.gov.in" class="tile" target="_blank">
                <img src="admin/vendor/fontawesome-free/svgs/solid/desktop.svg" alt="eOffice">
                <h5>eOffice</h5>
                </a>


                <a href="https://www.niirncd.org/salary_slip" class="tile" target="_blank">
                <img src="admin/vendor/fontawesome-free/svgs/solid/file-invoice-dollar.svg" alt="Salary Slip">
                <h5>eSalary Slip Generation</h5>
                </a>


                <a href="https://www.niirncd.org/esalary" class="tile" target="_blank">
                <img src="admin/vendor/fontawesome-free/svgs/solid/database.svg" alt="eSalary Software">
                <h5>eSalary Software</h5>
                </a>

                <a href="https://email.gov.in/" class="tile" target="_blank">
                <img src="admin/vendor/fontawesome-free/svgs/solid/at.svg" alt="Old Gov email">
                <h5>Old Gov Email</h5>
                </a>

               
                </div>


                <div class="tile-grid">
                <!-- Second row: 3 tiles -->
                  <a href="https://mail.gov.in/" class="tile" target="_blank">
                <img src="admin/vendor/fontawesome-free/svgs/solid/at.svg" alt="New Gov email">
                <h5>New Gov Email</h5>
                </a>
                <a href="./sci-admin/" class="tile">
                <img src="admin/vendor/fontawesome-free/svgs/brands/edge.svg" alt="Scientists Panel">
                <h5>Scientists Panel</h5>
                </a>


                <a href="viewform.php" class="tile">
                <img src="admin/vendor/fontawesome-free/svgs/solid/list.svg" alt="Forms">
                <h5>Forms</h5>
                </a>


                <a href="viewcircular.php" class="tile">
                <img src="admin/vendor/fontawesome-free/svgs/solid/list.svg" alt="Circular">
                <h5>Circular</h5>
                </a>
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
