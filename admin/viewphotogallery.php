<?php
session_start();
error_reporting(0);
include('inc/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:Index.php');
} else {
    $name = $_GET['name'];


    if (isset($_GET['del'])) {
      $id = $_GET['del'];

      $sql = "delete d1, d2 from gallery d1 LEFT JOIN photo_gallery d2 ON d1.img_id=d2.id where d1.img_id=$id";
      $query = $dbh->prepare($sql);
      $query->execute();

      $msg = "Select images deleted successfully";
  }


    if (isset($_POST['submit'])) {

        $edid = $_POST['edid'];
        $type = $_POST['typ'];
        $emp_name = $_POST['emp_name'];
        $emp_desig = $_POST['emp_desig'];
        $emp_status = $_POST['status'];
        $emp_tel = $_POST['emp_tel'];
        $emp_email = $_POST['emp_email'];
        $emp_sr_rank = $_POST['emp_sr_rank'];
        $research_interest = $_POST['research_interest'];

        if (!empty($_FILES['emp_image']['name'])) //new image uploaded
        {
            $file = $_FILES['emp_image']['name'];
            $file_loc = $_FILES['emp_image']['tmp_name'];
            $folder = "img/our_team/" . $type . "/";
            $new_file_name = strtolower($file);
            $final_file = str_replace(' ', '-', $new_file_name);

            if (move_uploaded_file($file_loc, $folder . $final_file)) {
                $doc_main = $final_file;
            }


            $sql2 = "UPDATE emp_details SET emp_image=(:var0) WHERE emp_id=$edid";
            $query2 = $dbh->prepare($sql2);
            $query2->bindParam(':var0', $doc_main, PDO::PARAM_STR);
            $query2->execute();
        }

        $sql1 = "UPDATE emp_details SET emp_name=(:var1), emp_desig=(:var2), emp_contact=NULLIF('$emp_tel', ''), emp_email=NULLIF('$emp_email',''), research_interest=NULLIF('$research_interest',''), emp_status=NULLIF('$emp_status', ''), emp_seniority=NULLIF('$emp_sr_rank', '') WHERE emp_id=$edid";
        $query1 = $dbh->prepare($sql1);
        $query1->bindParam(':var1', $emp_name, PDO::PARAM_STR);
        $query1->bindParam(':var2', $emp_desig, PDO::PARAM_STR);
        $query1->execute();

        $msg = "Information Updated Successfully";
    }

    if (isset($_POST['submit1'])) {

        $edid = $_POST['edid'];
        $dir_pro = $_POST['director_profile'];
        $dir_msg = $_POST['director_message'];



        $sql2 = "UPDATE director_profile SET director_profile=NULLIF('$dir_pro', ''), director_message=NULLIF('$dir_msg','') WHERE id=$edid";
        $query2 = $dbh->prepare($sql2);
        $query2->execute();

        $msg = "Information Updated Successfully";
    }

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
        <link rel="stylesheet" href="vendor/datatables/dataTables.bootstrap4.css">
        <link href="css/sb-admin-2.min.css" rel="stylesheet">

        <style>
            .errorWrap {
                padding: 10px;
                margin: 0 0 20px 0;
                background: #dd3d36;
                color: #fff;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
                box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            }

            .succWrap {
                padding: 10px;
                margin: 0 0 20px 0;
                background: #5cb85c;
                color: #fff;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
                box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            }
        </style>
        <style>
            /* The Modal (background) */
            .modal {
                display: none;
                /* Hidden by default */
                position: fixed;
                /* Stay in place */
                z-index: 1;
                /* Sit on top */
                padding-top: 150px;
                /* Location of the box */
                padding-left: 150px;
                /* Location of the box */
                left: 0;
                top: 0;
                width: 100%;
                /* Full width */
                height: 100%;
                /* Full height */
                overflow: auto;
                /* Enable scroll if needed */
                background-color: rgb(0, 0, 0);
                /* Fallback color */
                background-color: rgba(0, 0, 0, 0.4);
                /* Black w/ opacity */
            }

            /* Modal Content */
            .modal-content {
                background-color: #fefefe;
                margin: auto;
                padding: 20px;
                border: 1px solid #888;
                width: 80%;
            }

            /* The Close Button */
            .close {
                color: #aaaaaa;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }

            .close:hover,
            .close:focus {
                color: #000;
                text-decoration: none;
                cursor: pointer;
            }
        </style>

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
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">

                            <h1 class="h3 mb-0 text-gray-800"><?php echo $ty . ' Pictures'; ?>-table</h1>

                            <a href="insertPhotoGallery.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-down fa-sm text-white-50"></i> Insert new Pictures</a>
                        </div>

                        <!-- Page Heading -->
                        <p class="mb-4"></p>

                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <?php if ($error) { ?><div class="errorWrap" id="msgshow"><?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap" id="msgshow"><?php echo htmlentities($msg); ?> </div><?php } ?>
                                    <table id="dataTable" class="table table-bordered table-hover" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Cover Img</th>
                                                <th>Title</th>
                                                <th>uploaded date</th>
                                                <th>view gallery</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Cover Img</th>
                                                <th>Title</th>
                                                <th>uploaded date</th>
                                                <th>view gallery</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>


                                            <?php

                                            $sql = "SELECT * from photo_gallery ORDER BY upload_date DESC";
                                            $query = $dbh->prepare($sql);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt = 1;
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $result) {
                                            ?>
                                                    <tr>
                                                        <td><?php echo htmlentities($cnt); ?>.</td>
                                                        <td><img src="../content/events/<?php echo htmlentities($result->cover);?>" style="width:50px;" /></td>
                                                        <td><?php echo htmlentities($result->title); ?></td>
                                                        <td><?php echo htmlentities($result->upload_date); ?></td>
                                                        <td><?php //echo "view gallery" ?></td>


                                                        <td class="text-nowrap">

                                                            <a href="viewohotogallery.php?del=<?php echo $result->id; ?>" onclick="return confirm('Do you want to Delete');"><i class="fa fa-trash" style="color:red"></i></a>&nbsp;&nbsp;
                                                        </td>
                                                    </tr>
                                                    <input type="hidden" id="typ" name="typ" class="form-control" value="<?php echo htmlentities($result->type); ?>">
                                            <?php $cnt = $cnt + 1;
                                                }
                                            } ?>


                                        </tbody>
                                    </table>
                                </div>

                            </div>

                        </div>


                    </div>
                    <div class="modal" id="myModal">
                        <!-- <div class="modal-dialog"> -->
                        <!-- Modal content -->
                        <div class="modal-content">
                            <!-- </div> -->
                        </div>
                    </div>
                    <div class="modal" id="myModal1">
                        <!-- <div class="modal-dialog"> -->
                        <!-- Modal content -->
                        <div class="modal-content">
                            <!-- </div> -->
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

        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <script src="vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Core plugin JavaScript-->

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>
        <script src="js/demo/datatables-demo.js"></script>



        <script type="text/javascript">
            $(document).ready(function() {
                setTimeout(function() {
                    $('.succWrap').slideUp("slow");
                }, 3000);
            });
        </script>
        <script>
            /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
            var dropdown = document.getElementsByClassName('dropdown');
            var i;

            for (i = 0; i < dropdown.length; i++) {
                dropdown[i].addEventListener("click", function() {
                    this.classList.toggle("active");
                    var dropdownContent = this.nextElementSibling;
                    if (dropdownContent.style.display === "block") {
                        dropdownContent.style.display = "none";
                    } else {
                        dropdownContent.style.display = "block";
                    }
                });
            }
        </script>


    </body>

    </html>
<?php } ?>
