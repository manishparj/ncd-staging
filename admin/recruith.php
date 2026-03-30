<?php
session_start();
error_reporting(0);
include('inc/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {
			$name = 'recruitment';
		if (isset($_GET['del']) && isset($name)) {
 
		$id = $_GET['del'];
		$did = $_GET['dcid'];

		$sql = "delete from info_hi WHERE id=:id";
		$query = $dbh->prepare($sql);
		$query->bindParam(':id', $id, PDO::PARAM_STR);
		$query->execute();

		$sql = "delete from doc_hi WHERE id=:id";
		$query = $dbh->prepare($sql);
		$query->bindParam(':id', $did, PDO::PARAM_STR);
		$query->execute();
		$msg = "Information deleted successfully";
	}

	if (isset($_POST['submit'])) {

		$edid = $_POST['edid'];
		$title = $_POST['title'];
		$typ = $_POST['typ'];
		$upldate = $_POST['upldate'];
		$pdf_file = $_POST['pdf_file'];
		$status = $_POST['status'];
		$lastdt = $_POST['lastdt'];
		$categery = $_POST['category'];
		$doc_apform = $_POST['apform'];
		$doc_shform = $_POST['uplshdoc'];
		$doc_apform = $_POST['apform'];
		// doc name
		$nma = $_POST['az'];
		$nmb = $_POST['bz'];
		$nmc = $_POST['cz'];
		$nmd = $_POST['dz'];
		$nme = $_POST['ez'];
		$nmf = $_POST['fz'];
		$nmg = $_POST['gz'];
		$nmh = $_POST['hz'];
		$nmi = $_POST['iz'];
		$nmj = $_POST['jz'];

		//echo '<script type="text/javascript">alert("'.$nma.'")</script>';


		$sql1 = "UPDATE info_hi SET title=(:var1), type=(:var2), upl_date=(:var3), status=(:var4), last_dt=(:var5), category=(:var6) WHERE id=$edid";
		$query1 = $dbh->prepare($sql1);
		$query1->bindParam(':var1', $title, PDO::PARAM_STR);
		$query1->bindParam(':var2', $typ, PDO::PARAM_STR);
		$query1->bindParam(':var3', $upldate, PDO::PARAM_STR);
		$query1->bindParam(':var4', $status, PDO::PARAM_STR);
		$query1->bindParam(':var5', $lastdt, PDO::PARAM_STR);
		$query1->bindParam(':var6', $categery, PDO::PARAM_STR);
		$query1->execute();

		// main-pdf
		if (!empty($_FILES['uplmdoc']['name'])) //new image uploaded
		{
			$file = $_FILES['uplmdoc']['name'];
			$file_loc = $_FILES['uplmdoc']['tmp_name'];
			$folder = "hi_doc/";
			$new_file_name = strtolower($file);
			$final_file = str_replace(' ', '-', $new_file_name);
			if (move_uploaded_file($file_loc, $folder . $final_file)) {
				$doc_main = $final_file;
			}
			//process your file and data
			$sql3 = "UPDATE doc_hi SET doc_id=$edid,doc_main=(:doc_file) where doc_id=$edid";
			$query3 = $dbh->prepare($sql3);
			$query3->bindParam(':doc_file', $doc_main, PDO::PARAM_STR);
			$query3->execute();
		}

		// pdf1
		if (!empty($_FILES['uplaz']['name'])) //new image uploaded
		{
			$file1 = $_FILES['uplaz']['name'];
			$file_loc1 = $_FILES['uplaz']['tmp_name'];
			$folder = "hi_doc/";
			$new_file_name1 = strtolower($file1);
			$final_file1 = str_replace(' ', '-', $new_file_name1);
			if (move_uploaded_file($file_loc1, $folder . $final_file1)) {
				$doc_a = $final_file1;
			}
			//process your file and data
			$sql31 = "UPDATE doc_hi SET doc_id=$edid,doc_nm_a=NULLIF('$nma', ''),doc_a=NULLIF('$doc_a', '') where doc_id=$edid";
			$query31 = $dbh->prepare($sql31);
			$query31->execute();
		}

		// pdf2
		if (!empty($_FILES['uplbz']['name'])) //new image uploaded
		{
			$file2 = $_FILES['uplbz']['name'];
			$file_loc2 = $_FILES['uplbz']['tmp_name'];
			$folder = "hi_doc/";
			$new_file_name2 = strtolower($file2);
			$final_file2 = str_replace(' ', '-', $new_file_name2);
			if (move_uploaded_file($file_loc2, $folder . $final_file2)) {
				$doc_b = $final_file2;
			}
			//process your file and data
			$sql32 = "UPDATE doc_hi SET doc_id=$edid,doc_nm_b=NULLIF('$nmb', ''),doc_b=NULLIF('$doc_b', '') where doc_id=$edid";
			$query32 = $dbh->prepare($sql32);
			$query32->execute();
		}

		// pdf3
		if (!empty($_FILES['uplcz']['name'])) //new image uploaded
		{
			$file3 = $_FILES['uplcz']['name'];
			$file_loc3 = $_FILES['uplcz']['tmp_name'];
			$folder = "hi_doc/";
			$new_file_name3 = strtolower($file3);
			$final_file3 = str_replace(' ', '-', $new_file_name3);
			if (move_uploaded_file($file_loc3, $folder . $final_file3)) {
				$doc_c = $final_file3;
			}
			//process your file and data
			$sql33 = "UPDATE doc_hi SET doc_id=$edid,doc_nm_c=NULLIF('$nmc', ''),doc_c=NULLIF('$doc_c', '') where doc_id=$edid";
			$query33 = $dbh->prepare($sql33);
			$query33->execute();
		}

		// pdf4
		if (!empty($_FILES['upldz']['name'])) //new image uploaded
		{
			$file4 = $_FILES['upldz']['name'];
			$file_loc4 = $_FILES['upldz']['tmp_name'];
			$folder = "hi_doc/";
			$new_file_name4 = strtolower($file4);
			$final_file4 = str_replace(' ', '-', $new_file_name4);
			if (move_uploaded_file($file_loc4, $folder . $final_file4)) {
				$doc_d = $final_file4;
			}
			//process your file and data
			$sql34 = "UPDATE doc_hi SET doc_id=$edid,doc_nm_d=NULLIF('$nmd', ''),doc_d=NULLIF('$doc_d', '') where doc_id=$edid";
			$query34 = $dbh->prepare($sql34);
			$query34->execute();
		}

		// pdf5
		if (!empty($_FILES['uplez']['name'])) //new image uploaded
		{
			$file5 = $_FILES['uplez']['name'];
			$file_loc5 = $_FILES['uplez']['tmp_name'];
			$folder = "hi_doc/";
			$new_file_name5 = strtolower($file5);
			$final_file5 = str_replace(' ', '-', $new_file_name5);
			if (move_uploaded_file($file_loc5, $folder . $final_file5)) {
				$doc_e = $final_file5;
			}
			//process your file and data
			$sql35 = "UPDATE doc_hi SET doc_id=$edid,doc_nm_e=NULLIF('$nme', ''),doc_e=NULLIF('$doc_e', '') where doc_id=$edid";
			$query35 = $dbh->prepare($sql35);
			$query35->execute();
		}

		// pdf6
		if (!empty($_FILES['uplfz']['name'])) //new image uploaded
		{
			$file6 = $_FILES['uplfz']['name'];
			$file_loc6 = $_FILES['uplfz']['tmp_name'];
			$folder = "hi_doc/";
			$new_file_name6 = strtolower($file6);
			$final_file6 = str_replace(' ', '-', $new_file_name6);
			if (move_uploaded_file($file_loc6, $folder . $final_file6)) {
				$doc_f = $final_file6;
			}
			//process your file and data
			$sql36 = "UPDATE doc_hi SET doc_id=$edid,doc_nm_f=NULLIF('$nmf', ''),doc_f=NULLIF('$doc_f', '') where doc_id=$edid";
			$query36 = $dbh->prepare($sql36);
			$query36->execute();
		}

		// pdf7
		if (!empty($_FILES['uplgz']['name'])) //new image uploaded
		{
			$file7 = $_FILES['uplgz']['name'];
			$file_loc7 = $_FILES['uplgz']['tmp_name'];
			$folder = "hi_doc/";
			$new_file_name7 = strtolower($file7);
			$final_file7 = str_replace(' ', '-', $new_file_name7);
			if (move_uploaded_file($file_loc7, $folder . $final_file7)) {
				$doc_g = $final_file7;
			}
			//process your file and data
			$sql37 = "UPDATE doc_hi SET doc_id=$edid,doc_nm_g=NULLIF('$nmg', ''),doc_g=NULLIF('$doc_g', '') where doc_id=$edid";
			$query37 = $dbh->prepare($sql37);
			$query37->execute();
		}

		// pdf8
		if (!empty($_FILES['uplhz']['name'])) //new image uploaded
		{
			$file8 = $_FILES['uplhz']['name'];
			$file_loc8 = $_FILES['uplhz']['tmp_name'];
			$folder = "hi_doc/";
			$new_file_name8 = strtolower($file8);
			$final_file8 = str_replace(' ', '-', $new_file_name8);
			if (move_uploaded_file($file_loc8, $folder . $final_file8)) {
				$doc_h = $final_file8;
			}
			//process your file and data
			$sql38 = "UPDATE doc_hi SET doc_id=$edid,doc_nm_h=NULLIF('$nmh', ''),doc_h=NULLIF('$doc_h', '') where doc_id=$edid";
			$query38 = $dbh->prepare($sql38);
			$query38->execute();
		}

		$msg = "Information Updated Successfully";
	}

?>

	<!doctype html>
	<html lang="en" class="no-js">

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="theme-color" content="#3e454c">

		<title>Admin-panel</title>

		<!-- Font awesome -->
		<!-- Custom fonts for this template-->
		<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

		<!-- Custom styles for this template-->
		<link href="css/sb-admin-2.min.css" rel="stylesheet">
		<link rel="stylesheet" href="vendor/datatables/dataTables.bootstrap4.css">

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
					<div class="container-fluid">
						<div class="d-sm-flex align-items-center justify-content-between mb-4">
							<h1 class="h3 mb-0 text-gray-800"><?php echo $name; ?>-table</h1>

							<a href="inserth.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-down fa-sm text-white-50"></i> Insert new <?php echo $name; ?></a>
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
												<th>Title of Advt</th>
												<th>Advt upload Date</th>
												<th>Advt type</th>
												<th>Advt status</th>
												<th>Advt last date</th>
												<th>View document</th>


												<th >Action</th>
											</tr>
										</thead>

										<tbody>

											<?php

											$sql = "SELECT * from info_hi where type = (:type) ORDER BY id DESC";
											$query = $dbh->prepare($sql);
											$query->bindParam(':type', $name, PDO::PARAM_STR);
											$query->execute();
											$results = $query->fetchAll(PDO::FETCH_OBJ);
											$cnt = 1;
											if ($query->rowCount() > 0) {
												foreach ($results as $result) {				?>
													<tr>
														<td><?php echo htmlentities($cnt); ?>.</td>
														<td><?php echo htmlentities($result->title); ?></td>
														<td><?php echo htmlentities($result->upl_date); ?></td>
														<td><?php echo htmlentities($result->category); ?></td>
														<?php 
														$now = date("Y-m-d");
														$date = $result->last_dt;
																																						
														if(strtotime($now) > strtotime($date)){
															$c='<span style="color:#777">Close</span>';
														} else {
															$c='<span style="background-color:#013F8A;color:#fff">&nbsp;Open&nbsp;</span>';

														}?>
														<td><?php echo $c;?></td>
														<td><?php echo htmlentities($result->last_dt); ?></td>

														<?php
														$sql9 = "SELECT * from doc_hi where doc_id = $result->id";
														$query9 = $dbh->prepare($sql9);
														$query9->execute();
														$results9 = $query9->fetchAll(PDO::FETCH_OBJ);
														if ($query9->rowCount() > 0) {
															foreach ($results9 as $result19) {

																$str[0] = $result19->doc_nm_a;
																$str[1] = $result19->doc_nm_b;
																$str[2] = $result19->doc_nm_c;
																$str[3] = $result19->doc_nm_d;
																$str[4] = $result19->doc_nm_e;
																$str[5] = $result19->doc_nm_f;
																$str[6] = $result19->doc_nm_g;
																$str[7] = $result19->doc_nm_h;
																$str[8] = $result19->doc_nm_i;
																$str[9] = $result19->doc_nm_j;
																$strOutput = array_filter($str);


																$document[0] = $result19->doc_a;
																$document[1] = $result19->doc_b;
																$document[2] = $result19->doc_c;
																$document[3] = $result19->doc_d;
																$document[4] = $result19->doc_e;
																$document[5] = $result19->doc_f;
																$document[6] = $result19->doc_g;
																$document[7] = $result19->doc_h;
																$document[8] = $result19->doc_i;
																$document[9] = $result19->doc_j;
																$subjectOutput = array_filter($document);
														?>
																<td class="text-nowrap"><i class="fa fa-angle-right" aria-hidden="true" style="color:blue"></i>&nbsp;<a href="hi_doc/<?php echo htmlentities($result19->doc_main); ?>" target="_blank">Advt <i class="fa fa-download" aria-hidden="true"></i></a><br>
																	<i class="fa fa-angle-right" aria-hidden="true" style="color:blue"></i>&nbsp;<a href="other_doc/<?php echo htmlentities($result19->doc_apform); ?>" target="_blank">Application form <i class="fa fa-download" aria-hidden="true"></i></a><br>
																	<?php
																	$length = count($strOutput);

																	for ($i = 0; $i < $length; $i++) {
																		echo '<i class="fa fa-angle-right" aria-hidden="true" style="color:blue"></i>&nbsp;<a href="hi_doc/' . $subjectOutput[$i] . '">' . $strOutput[$i] . '&nbsp;<i class="fa fa-download" aria-hidden="true" ></i></a><br>';
																		// echo '<script type="text/javascript">alert("'.$strOutput[$i].'")</script>';
																	}
																	?>
															<?php }
														} ?>
																<td class="text-nowrap">
																	<a class="modalLink" href="#myModal" data-toggle="modal" data-target="#myModal" data-id="<?php echo htmlentities($result19->doc_id); ?>" data-name="<?php echo htmlentities($result->type); ?>" data-addr="<?php echo htmlentities($result19->doc_main); ?>">
																		&nbsp; <i class="fa fa-edit"></i></a>&nbsp;&nbsp;
																	</a>
																	<a href="recruith.php?del=<?php echo $result->id; ?>&dcid=<?php echo htmlentities($result19->doc_id); ?>&name=<?php echo htmlentities($name); ?>" onclick="return confirm('Do you want to Delete');"><i class="fa fa-trash" style="color:red"></i></a>&nbsp;&nbsp;
																</td>
													</tr>
											<?php $cnt = $cnt + 1;
												}
											} ?>

										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div id="myModal" class="modal">
							<!-- Modal content -->
							<div class="modal-content">

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

		<!-- Bootstrap core JavaScript-->
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

		<!-- Core plugin JavaScript-->
		<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

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
					url: "edit1h.php?famID=" + famID + "&famAddr=" + famAddr,
					cache: false,
					success: function(result) {
						$(".modal-content").html(result);
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