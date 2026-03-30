<?php
include('config/config.php');
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>DG ICMR | ICMR-NIIRNCD </title>
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
/* ===== Styling ===== */

.directory-card {
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 20px 45px rgba(0,0,0,0.06);
    margin-bottom: 40px;
    overflow: hidden;
}
table {
    width: 100%;
    border-collapse: collapse;
}
caption {
    padding: 18px 22px;
    font-size: clamp(18px, 2.4vw, 22px);
    font-weight: 700;
    color: #003679;
    background: linear-gradient(135deg, #eef4ff, #ffffff);
    text-align: left;
}
thead th {
    background: #003679;
    color: #fff;
    padding: 12px 14px;
    text-align: left;
    font-size: 14px;
}
tbody td {
    padding: 12px 14px;
    font-size: 14px;
    border-bottom: 1px solid #eef2f7;
}
tbody tr:nth-child(even) { background: #f9fbff; }

/* Responsive */
@media (max-width: 768px) {
    thead { display: none; }
    table, tbody, tr, td { display: block; width: 100%; }
    tbody tr {
        background: #fff;
        margin-bottom: 16px;
        padding: 12px 14px;
        border-radius: 16px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.05);
    }
    td {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
        font-size: 13px;
    }
    td::before {
        content: attr(data-label);
        font-weight: 600;
        color: #6b7280;
        font-size: 12px;
        text-transform: uppercase;
    }
}
caption {
    caption-side: top;   /* forces caption above <thead> */
    padding: 18px 22px;
    font-size: clamp(18px, 2.4vw, 22px);
    font-weight: 700;
    color: #003679;
    text-align: left;
    background: linear-gradient(135deg, #eef4ff, #ffffff);
    border-bottom: 2px solid #003679;
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

<!-- Hero -->
<div class="slider-area">
    <div class="single-slider slider-height2 d-flex align-items-center" style="background-image:url(assets/img/hero/services_hero.jpg);">
        <div class="container text-center">
            <h2 class="text-white">ICMR NIIRNCD Directory</h2>
        </div>
    </div>
</div>

<div class="section-full bg-white">
    <div class="container mt-5">
        
        <?php
        $directory = [

            "Director" => [
                ["Prof (Dr.) Pankaj Bhardwaj", "Director", "director-niirncd@icmr.gov.in"]
            ],

            "Scientists" => [
                ["Dr. Praveen Kumar Anand", "Scientist F", "pk.anand@dmrcjodhpur.nic.in"],
                ["Dr. Suresh Yadav", "Scientist C", "yadavs.es@gov.in"],
                ["Dr. Ramesh Kumar Huda", "Scientist C", "rameshk.h@icmr.gov.in"],
                ["Dr. Ramesh Kumar Sangwan", "Scientist C", "sangwan.rk@icmr.gov.in"],
                ["Dr. Mukti Khetan", "Scientist C", "mukti.khetan@icmr.gov.in"],
                ["Dr. Janesh Kumar Gautam", "Scientist C", "janesh.k@icmr.gov.in"],
                ["Dr. Rina Kumawat", "Scientist C", "drrina.2804@icmr.gov.in"]
            ],

            "Technical Staff" => [
                ["Dr. Anil Purohit", "Senior Technical Officer - III", "purohit.ak@dmrcjodhpur.nic.in"],
                ["Dr. Chet Ram Meena", "Technical Officer-C", "chetram.m@icmr.gov.in"],
                ["Sh. Rang Lal Meena", "Technical Officer-C", "rlmeena@nie.gov.in"],
                ["Sh. Pankaj Kumar", "Technical Officer-B", "pankaj.k@dmrcjodhpur.nic.in"],
                ["Dr. Rajnish Gupta", "Technical Officer-A", "rajnish.gup@icmr.gov.in"],
                ["Sh. Kanhaiya Lal Sharma", "Medical Social Woker", "kanhaiya69.niirncd@icmr.gov.in"],
                ["Sh. Manish Prajapati", "Technical Assistant (CS/IT)", "manishpr.92@icmr.gov.in"],
                ["Ms. Shakshi Dahiya", "Technical Assistant", "shakshi.d@icmr.gov.in"],
                ["Sh. Trilok Kumar", "Senior Technician (II)", "trilok.k@dmrcjodhpur.nic.in"],
                ["Sh. Bhanwar Manohar Singh", "Technician-II", "bhawar.ms@icmr.gov.in"],
                ["Smt. Komal Jangid", "Technician-I", "komal.j@icmr.gov.in"],
                ["Sh. Mayur Sankhala", "Technician-I", "mayursankhala.96@icmr.gov.in"],
                ["Sh. Sunil Kumar Saini", "Technician-I", "s.k.saini@icmr.gov.in"],
                ["Sh. Utkarsh Trivedi", "Technician-I", "utkarsh.t11@icmr.gov.in"],
                ["Sh. Chetan Singh Gohil", "Technician-I", "chetans.gohil@icmr.gov.in"],
                ["Sh. Ajay Bijarniya", "Technician-I", "ajay.bijarniya98@icmr.gov.in"],
            ],

            "Ministerial Staff" => [
                ["Sh. Dinesh Soni", "Senior Administrative Officer", "dinesh.soni.nimr@gov.in"],
                ["Dr. Kanchan Bala", "Jr. Translation Officer", "kanchan.b@dmrcjodhpur.nic.in"],
                ["Sh. Haresh V. Jadhav", "Section Officer", "jadhavhnirrh@icmr.gov.in"],
                ["Sh. Manohar Singh Seervi", "Assistant", "ms.seervi@dmrcjodhpur.nic.in"],
                ["Sh. Mukesh Panwar", "Assistant", "panwar.mukesh@icmr.gov.in"],
                ["Sh. Pankaj Sharma", "Personal Assistant", "sharma.pj@icmr.gov.in"],
                ["Sh. Narendra Kumar", "Upper Division Clerk", "narendra.k@icmr.gov.in"],
                ["Sh. Rahul Singh Sankhla", "Upper Division Clerk", "sankhla.rs@icmr.gov.in"],
                ["Sh. Surendra Kumar", "Lower Division Clerk", "surendra.k2002@icmr.gov.in"],
                ["Sh. Ramesh Choudhary", "Lower Division Clerk", "ramesh.choudhary03@icmr.gov.in"]
            ],

            "Supporting Staff" => [
                ["Sh. Manohar Singh", "Driver-T", "manohar.singh@dmrcjodhpur.nic.in"],
                ["Sh. Pardeep Singh Jodha", "Driver-T", "jodha.ps@icmr.gov.in"],
                ["Sh. Manmohan Meena", "Laboratory Assistant-T", "manmohan.m@icmr.gov.in"],
                ["Sh. Khushal Sankhala", "Laboratory Attendant-1", "khushal.2001@icmr.gov.in"],
                ["Sh. Bajrang Sharma", "Laboratory Attendant-1", "bajrang.2000@icmr.gov.in"],
                ["Sh. Krishna Sen", "Laboratory Attendant-1", "krishna.sen@icmr.gov.in"],
                ["Sh. Manoj Kumar", "Laboratory Attendant-1", "manojbpt.1999@icmr.gov.in"],
                ["Sh. Rahul Ranjan", "Laboratory Attendant-1", "ranjan.r@icmr.gov.in"],
                ["Sh. Ram Lal", "Multi Tasking Staff (G)", "ram.lal@dmrcjodhpur.nic.in"],
                ["Sh. Ladhu Ram", "Multi Tasking Staff (G)", "ladhu.ram@dmrcjodhpur.nic.in"],
                ["Smt. Sua Devi", "Multi Tasking Staff (G)", "sua.devi@icmr.gov.in"],
                ["Sh. Raj Kumar", "Multi Tasking Staff (T)", "rajdmrc.k@icmr.gov.in"]
        ],

        ];

        foreach ($directory as $section => $rows) { ?>
            <div class="directory-card">
                <table>
                    <caption><?= $section ?></caption>
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Name</th>
                            <th>Designation</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($rows as $row) { ?>
                            <tr>
                                <td data-label="Sr. No."><?= $i ?></td>
                                <td data-label="Name"><?= $row[0] ?></td>
                                <td data-label="Designation"><?= $row[1] ?></td>
                                <td data-label="Email"><?= $row[2] ?></td>
                            </tr>
                        <?php $i++; } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>

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
