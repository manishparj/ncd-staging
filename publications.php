<?php
include('config/config.php');
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Publications | ICMR-NIIRNCD </title>
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
        :root {
    --primary: #003679;
    --primary-light: #0052a3;
    --text-dark: #1f2937;
    --muted: #6b7280;
    --bg-light: #f9fafb;
}

/* Year Tabs */
.year-tabs {
    flex-wrap: wrap;
    gap: 8px;
}
.year-tabs .nav-link {
    border-radius: 50px;
    padding: 8px 18px;
    font-weight: 600;
    background: #f1f3f5;
    color: #333;
    transition: .3s;
}
.year-tabs .nav-link.active {
    background: linear-gradient(135deg, var(--primary), var(--primary-light));
    color: #fff;
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
}

/* Card */
.card {
    border-radius: 20px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.08);
    background: #fff;
}

/* Table Wrapper */
.table-responsive {
    border-radius: 16px;
    overflow-x: hidden !important;  /* prevent horizontal scrollbar */
    width: 100%;
}


/* Table Base */
.table {
    font-size: 14px;
      width: 100% !important; /* force table to fit container */
    border-collapse: separate;
    border-spacing: 0 10px;
    font-family: 'Poppins', Arial, sans-serif;
    table-layout: fixed; /* fix cell width to prevent scroll */
}

/* Table Header */
.table thead th {
    background: linear-gradient(135deg, var(--primary), var(--primary-light));
    color: #fff;
    padding: 14px 16px;
    font-weight: 600;
    border: none;
    white-space: nowrap;
}

/* Table Rows */
.table tbody tr {
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    transition: all .25s ease-in-out;
}
.table tbody tr:hover {
    transform: scale(1.01);
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
}

/* Table Cells */
.table td {
     padding: 12px 16px;
    color: var(--text-dark);
    border: none;
    word-break: break-word;  /* wrap long words/content */
    white-space: normal;      /* allow wrapping */
}
.table tr td:first-child { border-radius: 12px 0 0 12px; }
.table tr td:last-child { border-radius: 0 12px 12px 0; }

/* Links */
.table a {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    border-radius: 24px;
    background: rgba(0,54,121,0.08);
    font-weight: 600;
    color: var(--primary);
    text-decoration: none;
    transition: all .25s ease;
}
.table a:hover {
    background: linear-gradient(135deg, var(--primary), var(--primary-light));
    color: #fff;
    transform: translateX(4px);
}

/* Mobile: Card Layout */
@media (max-width: 992px) {
    .table thead { display: none; }
    .table tbody tr {
        display: block;
        padding: 10px 12px;
        margin-bottom: 16px;
        border-radius: 16px;
    }
    .table tbody td {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        font-size: 13px;
        gap: 10px;
    }
    .table tbody td::before {
        content: attr(data-label);
        font-weight: 600;
        font-size: 12px;
        color: var(--muted);
        text-transform: uppercase;
        flex: 1;
    }
    .table tbody td > * { flex: 2; text-align: right; }
    .table { min-width: 100%; }
}
@media (max-width: 992px) {
    .table-responsive {
        overflow-x: hidden; /* no horizontal scroll */
    }
}


/* Small Mobile */
@media (max-width: 576px) {
    .year-tabs .nav-link { padding: 6px 14px; font-size: 13px; }
    .table td, .table thead th { padding: 8px; font-size: 12px; }
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


    <main>

        <!-- slider Area Start-->
        <div class="slider-area">
            <!-- Mobile Menu -->
            <div class="single-slider slider-height2 d-flex align-items-center" style="background-image:url(assets/img/hero/image.png);">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap text-center">
                                <h2>Publications</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- slider Area End-->

           <div class="container mt-5" style="margin-bottom: 10%;">
                <section class="elements-area section-padding-100-0">
                <div class="container">

                <?php
                $sqlx = "SELECT DISTINCT year FROM publication ORDER BY year DESC";
                $queryx = $dbh->prepare($sqlx);
                $queryx->execute();
                $years = $queryx->fetchAll(PDO::FETCH_OBJ);
                ?>
                <!-- Year Tabs -->
                <ul class="nav nav-pills year-tabs mb-4" role="tablist">
                <?php $active = 'active'; ?>
                <?php foreach ($years as $y) { ?>
                    <li class="nav-item">
                        <button class="nav-link <?php echo $active; ?>"
                                data-toggle="pill"
                                data-target="#year<?php echo $y->year; ?>"
                                type="button">
                            <?php echo htmlentities($y->year); ?>
                        </button>
                    </li>
                <?php $active = ''; } ?>
                </ul>
                <!-- Tab Content -->
                <div class="tab-content">
                <?php $active = 'show active'; ?>
                <?php foreach ($years as $y) { ?>
                    <div class="tab-pane fade <?php echo $active; ?>" id="year<?php echo $y->year; ?>">
                        <div class="card shadow-sm border-0 rounded-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="dataTable-<?php echo $y->year; ?>"
                                        class="table table-bordered table-hover datatable"
                                        width="100%" cellspacing="0">

                                    <thead class="table-light">
                                    <tr>
                                        <th style="width: 5%; text-align: center">Sr. No.</th>
                                        <th>Title</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <?php
                                    $sql = "SELECT * FROM publication WHERE year = :year ORDER BY id ASC";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':year', $y->year, PDO::PARAM_INT);
                                    $query->execute();
                                    $rows = $query->fetchAll(PDO::FETCH_OBJ);

                                    $cnt = 1;
                                    foreach ($rows as $row) {
                                    ?>
                                    <tr>
                                        <td data-label="Sr. No." style="width: 5%; text-align: center"><?php echo htmlentities($cnt); ?>.</td>
                                        <td data-label="Title"><?php echo htmlentities($row->title); ?></td>
                                    </tr>
                                    <?php $cnt++; } ?>
                                    </tbody>

                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php $active = ''; } ?>

                </div>
                </div>
                </section>
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
				$(".table").css("fontSize", "18px");
				$("#bg").css("fontSize", "18px");

			});
			$('#btn2').click(function() {
				$(".table").css("fontSize", "16px");
				$("#bg").css("fontSize", "16px");

			});
			$('#btn3').click(function() {
				$(".table").css("fontSize", "13px");
				$("#bg").css("fontSize", "13px");

			});


		});
	</script>
   <script>
$(document).ready(function() {
    // Initialize all tables with class "datatable"
    $('.datatable').DataTable({
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50],
        ordering: true,
        searching: true,
        responsive: true,
        destroy: true,
        language: {
            search: "🔍 Search:",
            lengthMenu: "Show _MENU_ entries",
            info: "Showing _START_ to _END_ of _TOTAL_ entries",
            paginate: { next: "›", previous: "‹" }
        }
    });

    // Fix column widths when switching tabs
    $('button[data-toggle="pill"]').on('shown.bs.tab', function () {
        $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
    });
});
</script>



</body>

</html>
