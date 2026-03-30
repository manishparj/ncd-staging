<?php
session_start();
error_reporting(0);
include('inc/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:Index.php');
} else {
    $name = $_GET['name'];

    if (isset($_GET['del']) && isset($_GET['name'])) {
        $id = $_GET['del'];
        $did = $_GET['dcid'];

        $sql = "delete from info_en WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();

        $sql = "delete from doc_en WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $did, PDO::PARAM_STR);
        $query->execute();


        $msg = "Data Deleted successfully";
    }


    if (isset($_POST['submit'])) {

        $edid = $_POST['edid'];
        $title = $_POST['title'];
        $typ = $_POST['typ'];
        $upldate = $_POST['upldate'];
        $pdf_file = $_['pdf_file'];
        $status = $_POST['status'];
        $lastdt = $_POST['lastdt'];
        $doc_apform = "";

        $sql1 = "UPDATE info_en SET title=(:var1), type=(:var2), upl_date=(:var3), status=NULLIF('$status', ''), last_dt=NULLIF('$lastdt', ''),category=NULLIF('$category', '') WHERE id=$edid";
        $query1 = $dbh->prepare($sql1);
        $query1->bindParam(':var1', $title, PDO::PARAM_STR);
        $query1->bindParam(':var2', $typ, PDO::PARAM_STR);
        $query1->bindParam(':var3', $upldate, PDO::PARAM_STR);
        $query1->execute();

        if (!empty($_FILES['uplmdoc']['name'])) //new image uploaded
        {
            $file = $_FILES['uplmdoc']['name'];
            $file_loc = $_FILES['uplmdoc']['tmp_name'];
            $folder = "en_doc/";
            $new_file_name = strtolower($file);
            $final_file = str_replace(' ', '-', $new_file_name);

            if (move_uploaded_file($file_loc, $folder . $final_file)) {
                $doc_main = $final_file;
            }
            //process your image and data
            $sql3 = "UPDATE doc_en SET doc_id=$edid,doc_main=(:doc_file),doc_apform=NULLIF('$doc_apform', '') where doc_id=$edid";
            $query3 = $dbh->prepare($sql3);
            $query3->bindParam(':doc_file', $doc_main, PDO::PARAM_STR);
            $query3->execute();
        }

        $notitype = 'Updated';
        $reciver = 'Admin';
        $sender = $typ;

        $sqlnotif = "insert into notification (notiuser,notireciver,notitype) values (:notiuser,:notireciver,:notitype)";
        $querynotif = $dbh->prepare($sqlnotif);
        $querynotif->bindParam(':notiuser', $sender, PDO::PARAM_STR);
        $querynotif->bindParam(':notireciver', $reciver, PDO::PARAM_STR);
        $querynotif->bindParam(':notitype', $notitype, PDO::PARAM_STR);
        $querynotif->execute();
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
                            <h1 class="h3 mb-0 text-gray-800"><?php echo $name; ?>-table</h1>

                            <a href="insert.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-down fa-sm text-white-50"></i> Insert new <?php echo $name; ?></a>
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
                                                <th class="text-nowrap">Upload date</th>
                                                <th>Title</th>
                                                <th>View</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Upload date</th>
                                                <th>Title</th>
                                                <th>View</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>

                                            <?php

                                            $sql = "SELECT * from info_en where type = (:type) ORDER BY id DESC";
                                            $query = $dbh->prepare($sql);
                                            $query->bindParam(':type', $name, PDO::PARAM_STR);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt = 1;
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $result) {                ?>
                                                    <tr>
                                                        <td><?php echo htmlentities($cnt); ?>.</td>
                                                        <td><?php echo htmlentities($result->upl_date); ?></td>
                                                        <td><?php echo htmlentities($result->title); ?></td>
                                                        <?php
                                                        $sql9 = "SELECT * from doc_en where doc_id = $result->id";
                                                        $query9 = $dbh->prepare($sql9);
                                                        $query9->execute();
                                                        $results9 = $query9->fetchAll(PDO::FETCH_OBJ);
                                                        if ($query9->rowCount() > 0) {
                                                            foreach ($results9 as $result19) {                ?>
                                                                <td><a href="en_doc/<?php echo htmlentities($result19->doc_main); ?>" target="_blank"><i class="fa fa-download" aria-hidden="true"></i></a></td>
                                                        <?php } 
                                                        } ?>
                                                        <td class="text-nowrap">
                                                            <a class="modalLink" href="#myModal" data-toggle="modal" data-target="#myModal" data-id="<?php echo htmlentities($result19->doc_id); ?>" data-name="<?php echo htmlentities($result->type); ?>" data-addr="<?php echo htmlentities($result19->doc_main); ?>">
                                                                &nbsp; <i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                                            </a>
                                                            <!-- <a id="myBtn" onclick="return confirm('Do you want to Edit');">&nbsp; <i class="fa fa-pencil"></i></a>&nbsp;&nbsp; -->
                                                            <a href="view.php?del=<?php echo $result->id; ?>&dcid=<?php echo htmlentities($result19->doc_id); ?>&name=<?php echo htmlentities($name); ?>" onclick="return confirm('Do you want to Delete');"><i class="fa fa-trash" style="color:red"></i></a>&nbsp;&nbsp;
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
                    <div class="modal" id="myModal" >
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


        <script>
            $('.modalLink').click(function() {
                var famID = $(this).attr('data-id');
                var famAddr = $(this).attr('data-addr');
                // var famPhone=$(this).attr('data-phone');
                var type = $(this).attr('data-name');
                alert("Do you want to edit?");
                $.ajax({
                    url: "edit0.php?famID=" + famID + "&famAddr=" + famAddr,
                    cache: false,
                    success: function(result) {
                        $(".modal-content").html(result);
                        if (type == 'tenders') {
                            $('#t').show();
                        }
                        $(".close").click(function() {
                            $('.modal').modal('hide');
                        });
                    }
                });
            });
        </script>
    </body>

    </html>
<?php } ?>