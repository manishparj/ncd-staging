<?php
include('config/config.php');
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Ministers | ICMR-NIIRNCD </title>
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
/* Fade-in Animation */
@keyframes fadeInUp {
    0% { opacity: 0; transform: translateY(20px); }
    100% { opacity: 1; transform: translateY(0); }
}

/* Center Heading */
.page-title {
    text-align: center;
    margin-bottom: 10px;
    font-size: 36px;
    font-weight: 700;
    color: #003366;
    animation: fadeInUp 0.6s ease-in-out;
}

/* Diamond Row */
.diamond-row {
    text-align: center;
    margin-bottom: 35px;
    animation: fadeInUp 0.8s ease-in-out;
}

.diamond-row span {
    color: #004c97;
    letter-spacing: 8px;
    font-size: 20px;
}

/* Card Container */
.leader-card {
    border-radius: 18px;
    background: #ffffff;
    border: 1px solid #d9d9d9;
    box-shadow: 0 6px 18px rgba(0,0,0,0.08);
    transition: all .35s ease;
    padding: 25px 20px;
    text-align: center;
    height: 380px; 
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;

    /* Animation */
    opacity: 0;
    animation: fadeInUp 0.9s ease forwards;
}

/* Hover Animation */
.leader-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 12px 26px rgba(0,0,0,0.15);
}

/* Round Profile Image */
.image-wrapper {
    width: 160px;
    height: 160px;
    border-radius: 10%;
    border: 2px solid #003c7c;
    overflow: hidden;
    margin-bottom: 18px;
    transition: 0.3s ease;
}

/* Slight image zoom on hover */
.leader-card:hover .image-wrapper {
    transform: scale(1.05);
}

.leader-img {
    width: 100%;
    height: 100%;
    /* object-fit: cover; */
}

/* Name & Title */
.leader-name {
    font-size: 19px;
    font-weight: 500;
    color: #003c7c;
    margin-bottom: 8px;
}

.leader-title {
    font-size: 17px;
    color: #444;
    margin-top: 4px;
    line-height: 1.5;
    padding: 0 8px;
}

/* Mobile Responsive Fixes */
@media (max-width: 767px) {
    .leader-card {
        height: auto;
        padding-bottom: 35px;
    }
    .leader-title {
        font-size: 15px;
    }
    .image-wrapper {
        width: 135px;
        height: 135px;
    }
}


</style>


</head>

<body id="bg">

    <?php
        $leaders = [
            [
                'name' => 'Shri Jagat Prakash Nadda',
                'title' => 'Hon’ble Minister of Health & Family Welfare and Chemicals & Fertilizers, Government of India',
                'img' => 'assets/img/team/minister1.jpg'
            ],
            [
                'name' => 'Shri Prataprao Jadhav',
                'title' => 'Hon’ble Minister of State (Independent Charge) of Ministry of Ayush and Minister of State of Ministry of Health & Family Welfare, Government of India',
                'img' => 'assets/img/team/minister2.jpg'
            ],
            [
                'name' => 'Smt. Anupriya Patel',
                'title' => 'Hon’ble Minister of State for Health & Family Welfare and Chemicals and Fertilizers, Government of India',
                'img' => 'assets/img/team/minister3.jpg'
            ],
            [
                'name' => 'Dr. Rajiv Bahl',
                'title' => 'Secretary to Government of India, Department of Health Research and Director General, Indian Council of Medical Research',
                'img' => 'admin/img/our_team/dg-icmr/dg_photo_square.jpg'
            ],
            [
                'name' => 'Prof. (Dr.) Pankaj Bhardwaj',
                'title' => 'Director, ICMR-National Institute for Implementation Research on Non-Communicable Diseases, Jodhpur',
                'img' => 'admin/img/our_team/director/drpankaj.png'
            ],
        ];
        ?>

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
                                <h2>Leadership</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- slider Area End-->

      <section class="my-5" style="margin-bottom: 7rem !important;">
    <div class="container-fluid">

        <div class="diamond-row">
            <span>♦ ♦ ♦ ♦ ♦ ♦ ♦ ♦ ♦ </span>
        </div>

        <section class="border py-5">
            <div class="container-fluid">
                <!-- Section Title -->
                <div class="text-center mb-4">
                    <div class="title-underline"></div>
                </div>

                <div class="row g-4 justify-content-center">

                    <?php foreach ($leaders as $leader): ?>
                    <div class="col-lg-2 col-md-4 col-sm-6 col-12">

                        <div class="leader-card text-center h-100 animate-card">

                            <div class="image-wrapper mb-3">
                                <img src="<?= $leader['img']; ?>" class="leader-img" alt="<?= $leader['name']; ?>">
                            </div>

                            <div class="leader-name">
                                <?= $leader['name']; ?>
                            </div>

                            <div class="leader-title">
                                <?= $leader['title']; ?>
                            </div>

                        </div>

                    </div>
                    <?php endforeach; ?>

                </div>

            </div>
        </section>

    </div>
</section>


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
                $(".card-text").css("fontSize", "18px");
			});

            $('#btn2').click(function() {
				$(".table").css("fontSize", "16px");
                $(".card-text").css("fontSize", "16px");
			});

			$('#btn3').click(function() {
				$(".table").css("fontSize", "13px");
                $(".card-text").css("fontSize", "13px");
			});


		});
	</script

</body>

</html>
