<?php
include('config/config.php');
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>ICMR | ICMR-NIIRNCD </title>
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
    <link rel="stylesheet" href="assets/css/templete.css">

    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="stylenav.css">
    <link rel="stylesheet" href="assets/datatables/dataTables.bootstrap4.css">

    
<style>
/* Card */
.calendar-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    padding: 20px;
}

/* Header */
.calendar-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

.calendar-header h2 {
    font-size: 22px;
    margin: 0;
    font-weight: 600;
}

.calendar-header button {
    background: #1976d2;
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 6px 14px;
    font-size: 16px;
}

.calendar-header button:disabled {
    background: #b0bec5;
    cursor: not-allowed;
}

/* Calendar */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

th {
    background: #f1f3f6;
    font-size: 13px;
    padding: 10px 0;
    text-transform: uppercase;
    text-align: center !important;
}

td {
    border: 1px solid #e0e0e0;
    height: 60px;
    text-align: center;
    font-size: 15px;
    font-weight: 500;
    position: relative;
    cursor: default;
    border-width: 1px !important;

}

/* Holiday Types */
.gazetted {
    background: #ffe5e5;
    color: #b71c1c;
}

.restricted {
    background: #fff3cd;
    color: #856404;
}

.weekend {
    background: #e3f2fd;
    color: #0d47a1;
}

/* Today */
.today {
    border: 2px solid #1976d2;
    background: darkseagreen !important;
    font-weight: 700;
}

.tooltip {
    visibility: hidden;
    opacity: 0;
    background: rgba(0,0,0,0.85);
    color: #fff;
    padding: 6px 10px;
    border-radius: 6px;
    font-size: 12px;
    position: absolute;
    bottom: 130%;
    left: 50%;
    transform: translateX(-50%);
    white-space: nowrap;
    z-index: 9999;
    transition: opacity 0.2s ease;
    width: 200px;
    text-align: center;
}

td:hover .tooltip {
    visibility: visible;
    opacity: 1;
}
.tooltip::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    transform: translateX(-50%);
    border-width: 6px;
    border-style: solid;
    border-color: rgba(0,0,0,0.85) transparent transparent transparent;
}


/* Legend */
.calendar-legend {
    display: flex;
    justify-content: center;
    gap: 12px;
    margin-top: 15px;
    flex-wrap: wrap;
}

.legend {
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
}

.today-legend {
    border: 2px solid darkseagreen;
}

/* Mobile Responsive */
@media (max-width: 576px) {
    .calendar-header h2 {
        font-size: 18px;
    }

    td {
        height: 45px;
        font-size: 13px;
    }

    th {
        font-size: 11px;
    }
      
}
.calendar-pdf-link {
    display: inline-block;
    background: linear-gradient(135deg, #1976d2, #0d47a1);
    color: #fff;
    padding: 10px 22px;
    border-radius: 30px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    box-shadow: 0 4px 12px rgba(25,118,210,0.3);
    transition: all 0.3s ease;
}

.calendar-pdf-link:hover {
    background: linear-gradient(135deg, #1565c0, #0b3c91);
    transform: translateY(-2px);
    color: #fff;
}

.cal-nav-btn {
    background: linear-gradient(135deg, #1976d2, #0d47a1);
    color: #fff;
    border: none;
    width: 44px;
    height: 44px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    font-weight: bold;
    box-shadow: 0 6px 18px rgba(25,118,210,0.35);
    transition: all 0.25s ease;
}

.cal-nav-btn:hover:not(:disabled) {
    transform: scale(1.12);
    box-shadow: 0 10px 26px rgba(25,118,210,0.5);
}

.cal-nav-btn:active {
    transform: scale(0.95);
}

.cal-nav-btn:disabled {
    background: #cfd8dc;
    box-shadow: none;
    cursor: not-allowed;
}

.cal-nav-btn .arrow {
    line-height: 1;
}

/* Mobile */
@media (max-width: 576px) {
    .cal-nav-btn {
        width: 38px;
        height: 38px;
        font-size: 16px;
    }
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
                                <h2>ICMR NIIRNCD 2026 Calendar</h2>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- slider Area End-->

        <?php
        $year = 2026;

        $holidays = [

            "2026-01-01" => ["type" => "RH", "name" => "New Year’s Day"],
            "2026-01-03" => ["type" => "RH", "name" => "Hazrat Ali’s Birthday"],
            "2026-01-14" => ["type" => "RH", "name" => "Makar Sankranti"],
            "2026-01-14" => ["type" => "RH", "name" => "Magha Bihu / Pongal"],
            "2026-01-23" => ["type" => "RH", "name" => "Sri Panchami / Basant Panchami"],
            "2026-01-26" => ["type" => "GH",  "name" => "Republic Day"],

            "2026-02-01" => ["type" => "RH", "name" => "Guru Ravi Dass Birthday"],
            "2026-02-12" => ["type" => "RH", "name" => "Birthday of Swami Dayananda Saraswati"],
            "2026-02-15" => ["type" => "RH", "name" => "Maha Shivratri"],
            "2026-02-19" => ["type" => "RH", "name" => "Shivaji Jayanti"],

            "2026-03-03" => ["type" => "RH", "name" => "Holika Dahan"],
            "2026-03-03" => ["type" => "RH", "name" => "Dol Yatra"],
            "2026-03-04" => ["type" => "GH",  "name" => "Holi"],
            "2026-03-19" => ["type" => "RH", "name" => "Chaitra Sukladi / Gudi Padava / Ugadi / Cheti Chand"],
            "2026-03-20" => ["type" => "RH", "name" => "Jamat-Ul-Vida"],
            "2026-03-21" => ["type" => "GH",  "name" => "Id-ul-Fitr"],
            "2026-03-31" => ["type" => "GH",  "name" => "Mahavir Jayanti"],

            "2026-04-03" => ["type" => "GH",  "name" => "Good Friday"],
            "2026-04-05" => ["type" => "RH", "name" => "Easter Sunday"],
            "2026-04-14" => ["type" => "RH", "name" => "Vaisakhi / Vishu / Tamil New Year’s Day"],
            "2026-04-15" => ["type" => "RH", "name" => "Bohag Bihu (Assam)"],

            "2026-05-01" => ["type" => "GH",  "name" => "Buddha Purnima"],
            "2026-05-09" => ["type" => "RH", "name" => "Birthday of Guru Rabindranath Tagore"],
            "2026-05-27" => ["type" => "GH",  "name" => "Id-ul-Zuha (Bakrid)"],

            "2026-06-26" => ["type" => "GH",  "name" => "Muharram"],

            "2026-07-16" => ["type" => "RH", "name" => "Rath Yatra"],

            "2026-08-15" => ["type" => "GH",  "name" => "Independence Day"],
            "2026-08-26" => ["type" => "GH",  "name" => "Milad-un-Nabi / Id-e-Milad"],
            "2026-08-28" => ["type" => "RH", "name" => "Raksha Bandhan"],

            "2026-09-04" => ["type" => "GH",  "name" => "Janmashtami (Vaishnava)"],
            "2026-09-14" => ["type" => "GH",  "name" => "Ganesh Chaturthi"],

            "2026-10-02" => ["type" => "GH",  "name" => "Mahatma Gandhi’s Birthday"],
            "2026-10-18" => ["type" => "RH", "name" => "Dussehra (Saptami)"],
            "2026-10-19" => ["type" => "RH", "name" => "Dussehra (Mahaptami)"],
            "2026-10-20" => ["type" => "GH",  "name" => "Dussehra (Vijaya Dashami)"],
            "2026-10-26" => ["type" => "RH", "name" => "Maharishi Valmiki’s Birthday"],
            "2026-10-29" => ["type" => "RH", "name" => "Karaka Chaturthi (Karwa Chouth)"],

            "2026-11-08" => ["type" => "GH",  "name" => "Diwali (Deepavali)"],
            "2026-11-09" => ["type" => "RH", "name" => "Govardhan Puja"],
            "2026-11-11" => ["type" => "RH", "name" => "Bhai Duj"],
            "2026-11-15" => ["type" => "RH", "name" => "Pratihar Shashthi / Chhat Puja"],
            "2026-11-24" => ["type" => "GH",  "name" => "Guru Nanak’s Birthday"],

            "2026-12-23" => ["type" => "RH", "name" => "Hazrat Ali’s Birthday"],
            "2026-12-24" => ["type" => "RH", "name" => "Christmas Eve"],
            "2026-12-25" => ["type" => "GH",  "name" => "Christmas Day"]

        ];
        ?>
          <div class="section-full bg-white">
                <div class="container" style="margin-bottom: 5%;">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-md-10 col-sm-12">

                            <div class="calendar-card">
                                <div class="calendar-header">
                                   <button id="prevBtn" class="cal-nav-btn" onclick="prevMonth()" aria-label="Previous Month">
                                        <span class="arrow">❮</span>
                                    </button>

                                    <h2 id="monthYear"></h2>

                                    <button id="nextBtn" class="cal-nav-btn" onclick="nextMonth()" aria-label="Next Month">
                                        <span class="arrow">❯</span>
                                    </button>

                                </div>

                                <div id="calendar"></div>

                                <div class="calendar-legend">
                                    <span class="legend gazetted">Gazetted</span>
                                    <span class="legend restricted">Restricted</span>
                                    <span class="legend weekend">Weekend</span>
                                    <span class="legend today-legend">Today</span>
                                </div>
                                <p>The above calendar is prepared as per the official calendar. For any clarification, the below office calendar will be final.</p>
                                <div class="text-center mt-4">
                    <a class="calendar-pdf-link"
                    href="./doc/Calender2026.pdf"
                    target="_blank">
                        📄 Show Complete Calendar 2026
                    </a>
                </div>
                 
                            </div>

                        </div>
                    </div>
                </div>
                
            </div>


        </main>

        <script>
        const year = <?= $year ?>;
        const holidays = <?= json_encode($holidays) ?>;
        </script>

        <script src="calendar.js"></script>

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

