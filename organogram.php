<?php
include('config/config.php');
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Organogram | ICMR-NIIRNCD </title>
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

    <!-- D3 Core -->
<script src="https://d3js.org/d3.v7.min.js"></script>

<!-- Required dependency -->
<script src="https://unpkg.com/d3-flextree@2"></script>

<!-- Org Chart -->
<script src="https://unpkg.com/d3-org-chart@3"></script>

<style>
#chart-container svg path {
    stroke: #000;       /* dark color */
    stroke-width: 2px;  /* thicker lines */
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
                                <h2>Our Organogram</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- slider Area End-->

      <section class="my-5" style="margin-bottom: 7rem !important;">
    <div class="col-lg-12">

      <!-- <img src="assets\img\hero\Organogram.jpg" class="img-fluid" alt="Responsive image"> -->
       <div id="chart-container" style="width:100%; height:1250px;"></div>


    </div>
</section>


    </main>
    <footer>
        <!-- Footer Start-->

        <!-- footer-bottom aera -->
        <?php include('./config/footer.php'); ?>

        <!-- Footer End-->
    </footer>

      <script>
document.addEventListener('DOMContentLoaded', function () {

    const data = [
        { id: 'DG', parentId: null, name: 'Director General ICMR', icon: '👤' },
        { id: 'DIR', parentId: 'DG', name: 'Director ICMR – NIIRNCD', icon: '👔' },

        { id: 'RC', parentId: 'DIR', name: 'Research Centers', icon: '🔬' },
        { id: 'RL', parentId: 'DIR', name: 'Research & Laboratory', icon: '🧪' },
        { id: 'SU', parentId: 'DIR', name: 'Support Units', icon: '🛠️' },

        { id: 'MRHRU', parentId: 'RC', name: 'MRHRU Bhanpur\nKallan Jaipur', icon: '🏥' },

        { id: 'EPI', parentId: 'RL', name: 'Epidemiology Lab', icon: '🧫' },
        { id: 'BIO', parentId: 'RL', name: 'Biochemistry Lab', icon: '🧬' },
        { id: 'VIR', parentId: 'RL', name: 'Virology Lab', icon: '🦠' },
        { id: 'VBL', parentId: 'RL', name: 'Vector Biology Lab', icon: '🐜' },
        { id: 'MIC', parentId: 'RL', name: 'Microbiology Lab', icon: '🧪' },
        { id: 'BTO', parentId: 'RL', name: 'BioTechnology Lab', icon: '🧪' },

        { id: 'ADMIN', parentId: 'SU', name: 'Administration', icon: '🏢' },
        { id: 'ACC', parentId: 'SU', name: 'Accounts & Finance', icon: '💰' },
        { id: 'IT', parentId: 'SU', name: 'IT-Cell', icon: '💻' },
        { id: 'STORE', parentId: 'SU', name: 'Store & Purchase', icon: '📦' },
        { id: 'RAJ', parentId: 'SU', name: 'Rajbhasha Unit', icon: '📝' },
        { id: 'MAIN', parentId: 'SU', name: 'Maintenance Unit', icon: '🔧' }
    ];

    new d3.OrgChart()
        .container('#chart-container')
        .data(data)
        .compact(true)
        .nodeWidth(() => 220)
        .nodeHeight(() => 55)
        .childrenMargin(() => 90)
        .siblingsMargin(() => 130)
        .expandAll()
        .nodeContent(d => {
            let bg = '#003679';
            let color = '#fff';

            if (d.depth <= 1) bg = '#f58220';
            else if (d.depth === 2) {
                bg = '#d9e1ff';
                color = '#000';
            }
            return `
                <div style="
                    background:${bg};
                    color:${color};
                    padding:8px 14px;
                    font-size:14px;
                    border:1px solid #1f3c88;
                    font-weight:600;
                    text-align:center;
                    white-space:pre-line;
                    box-shadow:0 2px 3px rgba(0,0,0,0.2);
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100%;
                    gap: 6px;
                ">
                    <span>${d.data.icon || ''}</span>
                    <span>${d.data.name}</span>
                </div>
            `;
        })
        .render();

});
</script>



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
