<?php
include('config/config.php');
$id = $_POST['emp_id'];
$name = $_POST['name'];
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Scientist | ICMR-NIIRNCD </title>
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
    /* General Typography */
    .info-line {
    display: grid;
    grid-template-columns: 30px auto; /* Icon column + Text column */
    gap: 10px;
    align-items: center;
    margin: 14px 0;
    font-size: 17px;
    color: #333;
}

.info-line i {
    color: #003679;
    font-size: 20px;
    width: 30px;     /* makes all icons align perfectly */
    text-align: center;
}

/* Make name beautiful */
.profile-details h3 {
    font-size: 28px;
    font-weight: 800;
    color: #003679;
    margin-bottom: 20px;
}

/* Links underlined on hover */
.profile-details a {
    color: #003679;
    font-weight: 600;
    text-decoration: none;
}
.profile-details a:hover {
    text-decoration: underline;
}
    .profile-details h3 {
        font-weight: 700;
        color: #2b2b2b;
        margin-bottom: 20px;
    }

    .card-title {
        font-weight: 700;
    }

    /* Profile Card */
    .profile-card {
        border-radius: 20px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.1);
        overflow: hidden;
        margin-bottom: 30px;
        background: #ffffff;
    }

    .profile-image img {
        border-radius: 15px;
        height: 260px;
        object-fit: cover;
        width: 100%;
    }

    /* Icon + Text Lines */
    .info-line {
        display: flex;
        align-items: center;
        margin: 10px 0;
        font-size: 17px;
        color: #444;
    }

    .info-line i {
        width: 24px;
        font-size: 18px;
        color: #0d6efd; /* original blue color */
    }

    /* Section Titles */
    section h2 {
        font-weight: 700;
        color: #003679; /* same original blue */
        margin-bottom: 10px;
    }

    /* Gradient Line */
    .line {
        height: 3px;
        width: 100%;
        background: linear-gradient(to right, #0d6efd, #00c6ff); /* original blue gradient */
        border-radius: 20px;
        margin-bottom: 25px;
    }

    /* Preformatted Text Areas */
    pre {
        background: #f8f9fa; /* subtle grey background */
        padding: 22px;
        border-radius: 12px;
        white-space: pre-wrap;
        font-size: 15px;
        line-height: 1.6;
        border-left: 4px solid #0d6efd;
    }

    .card-text {
        font-size: 16px;
        line-height: 1.7;
    }
    .profile-card {
    border-radius: 18px;
    background: #ffffff;
    border: 2px solid #00367920; /* soft border with your color */
    box-shadow: 0 6px 25px rgba(0, 0, 0, 0.12);
    transition: 0.3s ease-in-out;
}

.profile-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 54, 121, 0.35);
}

/* IMAGE CARD */
.profile-image img {
    border-radius: 18px;
    height: 260px;
    width: 100%;
    object-fit: cover;
    border: 3px solid #003679;
}

/* NAME */
.profile-details h3 {
    font-size: 28px;
    font-weight: 800;
    color: #003679;
    margin-bottom: 18px;
}

/* INFO LINES */
.info-line {
    display: flex;
    align-items: center;
    margin: 12px 0;
    font-size: 17px;
    color: #333;
}

.info-line i {
    width: 26px;
    color: #003679;
    font-size: 20px;
}

/* GOOGLE LINK */
.profile-details a {
    color: #003679;
    font-weight: 600;
    text-decoration: none;
}

.profile-details a:hover {
    text-decoration: underline;
}

/* BEAUTIFUL SECTION LINE STYLE */
.section-title {
    font-size: 28px;
    font-weight: 800;
    color: #003679;
}

.line {
    height: 4px;
    width: 100%;
    background: linear-gradient(to right, #003679, #005fc7);
    border-radius: 20px;
    margin-bottom: 20px;
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
                                <h2>scientists</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- slider Area End-->

       <section>
    <div class="container mt-5">

        <div class="row mb-4">
    <?php
    $sql = "SELECT * from emp_details where emp_id =$id ";
    $query = $dbh->prepare($sql);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    if ($query->rowCount() > 0) {
        foreach ($results as $result) { ?>
        
        <!-- LEFT: IMAGE TILE -->
        <div class="col-lg-3">
            <div class="profile-card profile-image p-2">
                <img src="admin/img/our_team/<?php echo $name . "/" . htmlentities($result->emp_image); ?>" class="img-fluid" alt="">
            </div>
        </div>

        <!-- RIGHT: DETAILS TILE -->
       <div class="col-lg-9">
    <div class="profile-card p-4 profile-details">
                
        <h3><?php echo htmlentities($result->emp_name); ?></h3>

        <div class="info-line">
            <i class="fa fa-user"></i>
            <span><strong>Designation:</strong> <?= strtoupper($result->emp_desig); ?></span>
        </div>

        <?php if (!empty($result->research_interest)) { ?>
        <div class="info-line">
            <i class="fa fa-flask"></i>
            <span><strong>Research Interest:</strong> <?= htmlentities($result->research_interest); ?></span>
        </div>
        <?php } ?>

        <?php if (!empty($result->googlescholar)) { ?>
        <div class="info-line">
            <i class="fa fa-graduation-cap"></i>
            <span>
                <a href="<?= htmlentities($result->googlescholar); ?>" target="_blank">
                    Google Scholar Profile <i class="fa fa-external-link"></i>
                </a>
            </span>
        </div>
        <?php } ?>

        <?php if (!empty($result->emp_email)) { ?>
        <div class="info-line">
            <i class="fa fa-envelope"></i>
            <span><strong>Email:</strong> <?= htmlentities($result->emp_email); ?></span>
        </div>
        <?php } ?>

        <?php if (!empty($result->emp_contact)) { ?>
        <div class="info-line">
            <i class="fa fa-phone"></i>
            <span><strong>Tel:</strong> <?= htmlentities($result->emp_contact); ?></span>
        </div>
        <?php } ?>

    </div>
</div>



    <?php }} ?>
</div>



        <!-- BRIEF INTRO -->
        <div class="row mt-5">
            <div class="col-lg-12 profile-card p-4">
                <h2><i class="fa fa-user"></i>&nbsp;Brief Introduction</h2>
                <div class="line"></div>

                <?php
                $sql9 = "SELECT * from emp_profile where emp_id = $result->emp_id";
                $query9 = $dbh->prepare($sql9);
                $query9->execute();
                $results9 = $query9->fetchAll(PDO::FETCH_OBJ);

                if ($query9->rowCount() > 0) {
                    foreach ($results9 as $result20) { ?>

                        <p class="card-text"><?= nl2br(htmlentities($result20->brief_intro)); ?></p>
            </div>
        </div>

        <!-- ACADEMIC -->
        <div class="row mt-5">
            <div class="col-lg-12 profile-card p-4">
                <h2><i class="fa fa-graduation-cap"></i>&nbsp;Academic Qualifications & Training</h2>
                <div class="line"></div>
                <pre><?= htmlentities($result20->academic); ?></pre>
            </div>
        </div>


        <!-- PUBLICATIONS -->
        <div class="row mt-5">
            <div class="col-lg-12 profile-card p-4">
                <h2><i class="fa fa-book"></i>&nbsp;Publications</h2>
                <div class="line"></div>
                <pre><?= htmlentities($result20->publication); ?></pre>
            </div>
        </div>

        <!-- COMPLETED PROJECTS -->
        <div class="row mt-5">
            <div class="col-lg-12 profile-card p-4">
                <h2><i class="fa fa-paper-plane"></i>&nbsp;Completed Projects</h2>
                <div class="line"></div>
                <pre><?= htmlentities($result20->comp_project); ?></pre>
            </div>
        </div>

        <!-- ONGOING PROJECTS -->
        <div class="row mt-5">
            <div class="col-lg-12 profile-card p-4">
                <h2><i class="fa fa-spinner"></i>&nbsp;Ongoing Projects</h2>
                <div class="line"></div>
                <pre><?= htmlentities($result20->ong_project); ?></pre>
            </div>
        </div>

        <?php }} ?>
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
