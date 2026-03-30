<?php
include('config/config.php');
?>
<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Photo Gallery | ICMR-NIIRNCD </title>
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
        <link rel="stylesheet" href="assets/css/responsive.css">

        <link rel="stylesheet" href="assets/datatables/dataTables.bootstrap4.css">
        <style>
            /* Gallery Card */
.gallery-card {
    margin-bottom: 24px;
    animation: fadeUp .6s ease both;
}

/* Card box */
.gallery-box {
    background: #fff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 12px 28px rgba(0,0,0,0.08);
    transition: all .35s ease;
    height: 100%;
}

.gallery-box:hover {
    transform: translateY(-8px) scale(1.01);
    box-shadow: 0 22px 48px rgba(0,0,0,0.18);
}

/* Image container */
.gallery-img {
    position: relative;
    width: 100%;
    aspect-ratio: 4 / 3;
    overflow: hidden;
}

/* Image */
.gallery-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .6s ease;
}

.gallery-box:hover img {
    transform: scale(1.12);
}

/* Date overlay */
.image-date {
    position: absolute;
    bottom: 10px;
    left: 10px;
    background: rgba(13,71,161,0.9);
    color: #fff;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 11px;
    z-index: 2;
}

/* Hover icon overlay */
.view-icon {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.45);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 30px;
    color: #fff;
    opacity: 0;
    transition: opacity .35s ease;
}

.gallery-box:hover .view-icon {
    opacity: 1;
}

/* Title */
.gallery-title {
    background: linear-gradient(135deg, #003669, #0d47a1);
    color: #fff;
    text-align: center;
    padding: 12px 10px;
    font-size: 14px;
    font-weight: 600;
    min-height: 52px;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Remove list styling */
.gallery-grid-4,
#dlab-gallery-listing {
    list-style: none;
    padding: 0;
    margin: 0;
}

/* 🔥 Entrance animation */
@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* 📱 Mobile responsiveness */
@media (max-width: 768px) {
    .gallery-card {
        padding: 6px;
    }

    .gallery-title {
        font-size: 13px;
        min-height: 46px;
    }
}

/* 📱 Extra small devices */
@media (max-width: 576px) {
    .gallery-card {
        flex: 0 0 50%;
        max-width: 50%;
    }

    .gallery-title {
        font-size: 12px;
        padding: 8px;
    }
}

        </style>


    </head>

    <body>

        <!-- Preloader Start -->
        <!-- <div id="preloader-active">
            <div class="preloader d-flex align-items-center justify-content-center">
                <div class="preloader-inner position-relative">
                    <div class="preloader-circle"></div>
                    <div class="preloader-img pere-text">
                        <img src="assets/img/logo/loaderlogo.jpg" alt="">
                    </div>
                </div>
            </div>
        </div> -->
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
                                <h2>Photo gallery</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- slider Area End-->



       <section class="container mt-5">
    <div class="row g-3">

        <?php
        $sql = "SELECT * from photo_gallery ORDER BY upload_date DESC";
        $query = $dbh->prepare($sql);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        foreach ($results as $result) {
        ?>
            <div class="col-12 col-md-4 col-lg-4 gallery-card">
                <a href="photogalleryview.php?eventid=<?php echo htmlentities($result->id) ?>"
                   class="gallery-link">

                    <div class="gallery-box">

                        <div class="gallery-img">
                            <img src="content/events/<?php echo htmlentities($result->cover); ?>" alt="">

                            <span class="image-date">
                                📅 <?php echo date('d M Y', strtotime($result->upload_date)); ?>
                            </span>

                            <div class="view-icon">👁️</div>
                        </div>

                        <div class="gallery-title">
                            <?php echo htmlentities(ucwords(str_replace('-', ' ', $result->title))); ?>
                        </div>

                    </div>
                </a>
            </div>
        <?php } ?>

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
        <script src="./assets/js/imagesloaded/imagesloaded.js"></script><!-- IMAGESLOADED -->
	    <script src="./assets/js/masonry/masonry-3.1.4.js"></script><!-- MASONRY -->
	    <script src="./assets/js/masonry/masonry.filter.js"></script><!-- MASONRY -->

    </body>
</html>
