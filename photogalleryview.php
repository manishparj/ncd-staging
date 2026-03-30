<?php
include('config/config.php');
$id = $_GET['eventid'];
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title> Photo Gallery | ICMR-NIIRNCD </title>
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
	<style>
		/* Premium Album Container */
.premium-gallery {
    animation: fadeUp .6s ease both;
}

/* Album Image Card */
.album-image {
    position: relative;
    width: 100%;
    aspect-ratio: 4 / 3;
    background-size: cover;
    background-position: center;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 12px 28px rgba(0,0,0,0.12);
    transition: all .4s ease;
}

/* Hover zoom */
.album-image:hover {
    transform: translateY(-6px);
    box-shadow: 0 22px 48px rgba(0,0,0,0.25);
}

/* Overlay */
.album-image .overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        to bottom,
        rgba(0,0,0,0.1),
        rgba(0,0,0,0.6)
    );
    opacity: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: opacity .35s ease;
}

.album-image:hover .overlay {
    opacity: 1;
}

/* View Icon */
.view-icon {
    font-size: 30px;
    color: #fff;
    transform: scale(0.8);
    transition: transform .3s ease;
}

.album-image:hover .view-icon {
    transform: scale(1);
}

/* Mobile optimization */
@media (max-width: 576px) {
    .album-image {
        border-radius: 12px;
    }
}

/* Entrance animation */
@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(25px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

		</style>

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

	<?php include('config/header.php'); ?>

	<!-- slider Area Start-->
<div class="slider-area">
    <div class="single-slider slider-height2 d-flex align-items-center"
         data-background="assets/img/hero/contact_hero.jpg">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center">

                        <?php
                        $sql = "SELECT * FROM photo_gallery WHERE id = :id";
                        $query = $dbh->prepare($sql);
                        $query->bindParam(':id', $id, PDO::PARAM_INT);
                        $query->execute();
                        $result = $query->fetch(PDO::FETCH_OBJ);
                        ?>

                        <?php if ($result) { ?>
                            <h2>
                                <?php echo htmlentities(ucwords(str_replace('-', ' ', $result->title))); ?>
                                <?php echo htmlentities($result->year); ?>
                            </h2>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- slider Area End-->

<div class="card shadow-lg border-0 rounded-4">
    <div class="card-body p-4">
        <div class="row g-3 premium-gallery">

            <?php
            $sql1 = "SELECT * FROM gallery WHERE img_id = :img_id";
            $query1 = $dbh->prepare($sql1);
            $query1->bindParam(':img_id', $result->id, PDO::PARAM_INT);
            $query1->execute();
            $resultspg = $query1->fetchAll(PDO::FETCH_OBJ);

            foreach ($resultspg as $resultpg) {
            ?>

                <div class="col-6 col-md-4 col-lg-3">
                    <a href="content/<?php echo htmlentities($result->title); ?>/<?php echo htmlentities($resultpg->imgs); ?>"
                       class="img-pop-up gallery-link">

                        <div class="album-image"
                             style="background-image:url('content/<?php echo htmlentities($result->title); ?>/<?php echo htmlentities($resultpg->imgs); ?>')">

                            <div class="overlay">
                                <span class="view-icon">🔍</span>
                            </div>

                        </div>
                    </a>
                </div>

            <?php } ?>

        </div>
    </div>
</div>

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
