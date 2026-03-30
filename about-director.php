<?php
include('config/config.php');
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
                                <h2>Director profile</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- slider Area End-->

        <section class="my-5">
            <div class="container">
                <div class="row">
                    <div class="card-deck col-lg-12 ">

                        <?php
                        $name = 'director';

                        $sql = "SELECT * from emp_details where emp_type = (:type) ORDER BY emp_seniority ASC";
                        $query = $dbh->prepare($sql);
                        $query->bindParam(':type', $name, PDO::PARAM_STR);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                            foreach ($results as $result) { ?>

                                <div class="card col-lg-4 text-center border-0">
                                    <img class="card-img-top" src="./admin/img/our_team/director/about-dir.jpg" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo htmlentities($result->emp_name); ?></h5>
                                        <p class="card-text"><?php echo htmlentities($result->emp_desig); ?></p>
                                        <small class="card-text">ICMR-NIIRNCD, Jodhpur<br>
                                        Email: <?php echo htmlentities($result->emp_email); ?><br>
                                        Tel. <?php echo htmlentities($result->emp_contact); ?></small>


                                    </div>
                                </div>



                                <div class="col-lg-8">
                                    <div class="credit-tabs-content" id="myTab">
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item ">
                                                <a class="nav-link active" id="tab--1" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">Director's Profile</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="tab--2" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false">Director's Message</a>
                                            </li>

                                        </ul>

                                        <?php
                                        $sql9 = "SELECT * from director_profile where id = $result->emp_id";
                                        $query9 = $dbh->prepare($sql9);
                                        $query9->execute();
                                        $results9 = $query9->fetchAll(PDO::FETCH_OBJ);
                                        if ($query9->rowCount() > 0) {
                                            foreach ($results9 as $result20) {
                                        ?>

                                                <div class="tab-content mb-100" id="myTabContent">
                                                    <div class="tab-pane fade in active show" id="tab1" role="tabpanel" aria-labelledby="tab--1">
                                                        <div class="credit-tab-content ">
                                                            <!-- Tab Text -->
                                                            <div class="credit-tab-text">
                                                                <p id="bg1" class="card-text text-justify"><?php echo htmlentities($result20->director_profile); ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab--2">
                                                        <div class="credit-tab-content">
                                                            <!-- Tab Text -->
                                                            <div class="credit-tab-text">
                                                                <p id="bg2" class=" card-text text-justify"><?php echo htmlentities($result20->director_message); ?></p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                        <?php }
                                        } ?>
                                    </div>
                                </div>
                        <?php }
                        } ?>
                    </div>


                </div>
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
