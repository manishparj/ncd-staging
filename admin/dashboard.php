<?php
session_start();
error_reporting(0);
include('inc/config.php');
// if (strlen($_SESSION['alogin']) == 0) {
//     header('location:index.php');
// } else {

// Check if user is logged in
if (!isset($_SESSION['alogin']) || !isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header("Location: index.php");
    exit();
}

// Optional: Check session timeout (30 minutes)
if (isset($_SESSION['login_time']) && (time() - $_SESSION['login_time'] > 1800)) {
    session_destroy();
    header("Location: index.php?timeout=1");
    exit();
}

// Update last activity time
$_SESSION['login_time'] = time();

$username = $_SESSION['alogin'];
$sql = "SELECT session_token FROM admin WHERE UserName = :username";
$query = $dbh->prepare($sql);
$query->bindParam(':username', $username, PDO::PARAM_STR);
$query->execute();
$result = $query->fetch(PDO::FETCH_OBJ);

// If session token exists in DB but not in session, or mismatch, force logout
if($result && isset($result->session_token) && !empty($result->session_token)) {
    if(!isset($_SESSION['session_token']) || $_SESSION['session_token'] != $result->session_token) {
        session_destroy();
        header('location:index.php?msg=password_changed');
        exit();
    }
}

    if (!isset($_SESSION['alogin'])) {
        header('location: index.php');
    } else { 
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Admin-Dashboard</title>

        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="css/sb-admin-2.min.css" rel="stylesheet">

    </head>

    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <?php include('inc/sidebar.php'); ?>

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <?php include('inc/top.php'); ?>


                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-down fa-sm text-white-50"></i> Quick shortcuts</a>

                            <!-- <h1 class="h3 mb-0 text-gray-800">Dashboard</h1> -->
                        </div>

                        <!-- Content Row -->
                        <div class="row">

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-gray-800 text-uppercase mb-1">
                                                    View</div>
                                                <?php

                                                ?>
                                                <div class="h5 mb-0 font-weight-bold text-primary"><a href="recruit.php?name=<?php echo htmlentities('recruitment');?>">Recruitment</a></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-gray-800 text-uppercase mb-1">
                                                    Insert</div>
                                                <?php

                                                ?>
                                                <div class="h5 mb-0 font-weight-bold text-primary"><a href="insert.php">Recruitment</a></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-gray-800 text-uppercase mb-1">
                                                    View</div>
                                                <?php

                                                ?>
                                                <div class="h5 mb-0 font-weight-bold text-primary"><a href="tender.php?name=<?php echo htmlentities('tenders');?>">Tender</a></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pending Requests Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-warning shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-gray-800 text-uppercase mb-1">
                                                    Update last date</div>
                                                <?php

                                                ?>
                                                <div class="h5 mb-0 font-weight-bold text-primary"><a href="web-update-date.php">Website-change</a></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Content Row -->

                        <div class="row">

                            <!-- Area Chart -->
                            <div class="col-xl-12 col-lg-7">
                                <div class="card shadow mb-4">
                                    <!-- Card Header - Dropdown -->
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Employee-Overview</h6>
                                        <div class="dropdown no-arrow">
                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                                <div class="dropdown-header">Dropdown Header:</div>
                                                <a class="dropdown-item" href="#">Action</a>
                                                <a class="dropdown-item" href="#">Another action</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#">Something else here</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <div class="chart-area">
                                            <!-- <canvas id="myBarChart"></canvas> -->
                                            <!-- chart type bar -->
                                            <?php include('chart2.php'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <?php include('inc/footer.php'); ?>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="vendor/chart.js/Chart.min.js"></script>

        <!-- Page level custom scripts -->
        <!-- <script src="js/demo/chart-area-demo.js"></script>
        <script src="js/demo/chart-pie-demo.js"></script>
        <script src="js/demo/chart-bar-demo.js"></script>
        < -->


    </body>

    </html>
<?php } ?>
