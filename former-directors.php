<?php
include('config/config.php'); // $dbh is already defined here

// Fetch directors ordered by service_from (oldest first)
try {
    $stmt = $dbh->query("SELECT * FROM directors ORDER BY service_from ASC");
    $directors = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    $directors = [];
    error_log("Error fetching directors: " . $e->getMessage());
}
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>ICMR-NIIRNCD - Former Directors</title>
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
    <link rel="stylesheet" href="./former.css">
    <link rel="stylesheet" href="./config/footer.css">
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
                                <h2>Former Directors</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- slider Area End-->

        <section class="timeline-section">
            <div class="timeline-container">
                <?php if(empty($directors)): ?>
                    <div class="empty-state">
                        <i class="fas fa-user-tie"></i>
                        <h3>No Directors Found</h3>
                        <p>Director information will be added soon.</p>
                    </div>
                <?php else: ?>
                    <?php foreach($directors as $index => $director): ?>
                        <div class="timeline-item">
                            <?php if($index % 2 == 0): ?>
                                <!-- Left side -->
                                <div class="timeline-left">
                                    <div class="timeline-card">
                                        <div class="card-photo">
                                            <?php 
                                                // Correct paths since PHP file is outside 'admin' folder
                                                $photoFile = __DIR__ . '/admin/uploads/' . basename(str_replace('\\', '/', $director['photo'])); // server path
                                                $photoPath = 'admin/uploads/' . basename(str_replace('\\', '/', $director['photo'])); // browser URL
                                            ?>
                                            <?php if($director['photo'] && file_exists($photoFile)): ?>
                                                <img src="<?= htmlspecialchars($photoPath) ?>" alt="<?= htmlspecialchars($director['name']); ?>">
                                            <?php else: ?>
                                                <div class="no-photo">
                                                    <i class="fas fa-user-circle"></i>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="card-content">
                                            <div class="director-name">
                                                <?php echo htmlspecialchars($director['name']); ?>
                                                <?php if(!$director['service_to']): ?>
                                                    <span class="current-badge">Current Director</span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="service-period-container">
                                                <div class="service-period">
                                                    <i class="fas fa-calendar-alt"></i>
                                                </div>
                                                <div class="service-dates">
                                                    <strong>From:</strong> <?php echo date('d-m-Y', strtotime($director['service_from'])); ?>
                                                    &nbsp;&nbsp;
                                                    <strong>To:</strong> <?php echo $director['service_to'] ? date('d-m-Y', strtotime($director['service_to'])) : 'Present'; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="timeline-right"></div>
                            <?php else: ?>
                                <!-- Right side -->
                                <div class="timeline-left"></div>
                                <div class="timeline-right">
                                    <div class="timeline-card">
                                         <div class="card-photo">
                                            <?php 
                                                // Correct paths since PHP file is outside 'admin' folder
                                                $photoFile = __DIR__ . '/admin/uploads/' . basename(str_replace('\\', '/', $director['photo'])); // server path
                                                $photoPath = 'admin/uploads/' . basename(str_replace('\\', '/', $director['photo'])); // browser URL
                                            ?>
                                            <?php if($director['photo'] && file_exists($photoFile)): ?>
                                                <img src="<?= htmlspecialchars($photoPath) ?>" alt="<?= htmlspecialchars($director['name']); ?>">
                                            <?php else: ?>
                                                <div class="no-photo">
                                                    <i class="fas fa-user-circle"></i>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="card-content">
                                            <div class="director-name">
                                                <?php echo htmlspecialchars($director['name']); ?>
                                                <?php if(!$director['service_to']): ?>
                                                    <span class="current-badge">Current Director</span>
                                                <?php endif; ?>
                                            </div>
                                           <div class="service-period-container">
                                                <div class="service-period">
                                                    <i class="fas fa-calendar-alt"></i>
                                                </div>
                                                <div class="service-dates">
                                                    <strong>From:</strong> <?php echo date('d-m-Y', strtotime($director['service_from'])); ?>
                                                    &nbsp;&nbsp;
                                                    <strong>To:</strong> <?php echo $director['service_to'] ? date('d-m-Y', strtotime($director['service_to'])) : 'Present'; ?>
                                                </div>
</div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="timeline-dot"></div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </section>

    </main>

        <?php include('./config/footer.php'); ?>

    <!-- JS here -->
    <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/jquery.slicknav.min.js"></script>
    <script src="./assets/js/owl.carousel.min.js"></script>
    <script src="./assets/js/slick.min.js"></script>
    <script src="./assets/js/wow.min.js"></script>
    <script src="./assets/js/animated.headline.js"></script>
    <script src="./assets/js/jquery.magnific-popup.js"></script>
    <script src="./assets/js/jquery.scrollUp.min.js"></script>
    <script src="./assets/js/jquery.nice-select.min.js"></script>
    <script src="./assets/js/jquery.sticky.js"></script>
    <script src="./assets/js/contact.js"></script>
    <script src="./assets/js/jquery.form.js"></script>
    <script src="./assets/js/jquery.validate.min.js"></script>
    <script src="./assets/js/mail-script.js"></script>
    <script src="./assets/js/jquery.ajaxchimp.min.js"></script>
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
                $(".director-name").css("fontSize", "1.6rem");
                $(".service-dates").css("fontSize", "1rem");
            });

            $('#btn2').click(function() {
                $("#bg").css("fontSize", "16px");
                $(".card-text").css("fontSize", "16px");
                $(".director-name").css("fontSize", "1.4rem");
                $(".service-dates").css("fontSize", "0.9rem");
            });

            $('#btn3').click(function() {
                $("#bg").css("fontSize", "13px");
                $(".card-text").css("fontSize", "13px");
                $(".director-name").css("fontSize", "1.2rem");
                $(".service-dates").css("fontSize", "0.8rem");
            });
            
            // Add smooth scroll animation
            $('a[href*="#"]').on('click', function(e) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: $($(this).attr('href')).offset().top
                }, 500, 'linear');
            });
        });
    </script>
</body>

</html>