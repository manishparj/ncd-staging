<?php
session_start();
error_reporting(0);
include('inc/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {



if(isset($_POST['submit']))
{
	$title=$_POST['title'];
  $type = in_array($_POST['info_type'], [1, 2, 3]) ? $_POST['info_type'] : false;
  $pi = $_POST['pi'];
  $duration = $_POST['duration'];


  $sqlnoti="insert into research (research_title,research_type,pi,duration) values (NULLIF('$title', ''),NULLIF('$type', ''),NULLIF('$pi',''),NULLIF('$duration',''))";
  $querynoti = $dbh->prepare($sqlnoti);
  $querynoti->execute();
  $lastInsertId = $dbh->lastInsertId();


  if($lastInsertId)
  {
  echo "<script type='text/javascript'>alert('Record inserted successfully!');</script>";

  }
  else
  {
  $error="(*)fields are mandatory. Please try again";
  }

}

?>

	<!doctype html>
	<html lang="en" class="no-js">

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
		<link rel="stylesheet" href="css/bootstrap.min.css">

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

					<div class="container-fluid center">
						<div class="row">
							<div class="col-md-12">
								<h3 class="page-title">Insert new record-</h3>
								<div class="row" style="padding: 40px;">
									<div class="col-md-12">
										<div class="panel panel-default">
											<div class="panel-heading">Info</div>
											<?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>

											<div class="panel-body">
												<form method="post" class="form-horizontal" enctype="multipart/form-data">


													<div class="form-row">
														<div class="form-group col-md-4">
														</div>
														<div class="form-group col-md-4">
														</div>
														<div class="form-group col-md-4">
														</div>
													</div>

													<div class="form-row">
														<div class="form-group col-md-4">
														</div>
														<div class="form-group col-md-4 text-center">
															<select id="id_info_type" name="info_type" class="form-control">
																<option selected>Select type</option>
																<option value="1">ongoing</option>
																<option value="2">complete</option>
																<option value="3">Sanctioned</option>

															</select>
														</div>
														<div class="form-group col-md-4">
														</div>
													</div>



													<!-- div aa -->
													<div id="aa" style="display:none;">

														<!-- title  -->
														<div class="form-row">
															<div class="form-group col-md-2">
																<label class="control-label">Title:<span style="color:red">*</span><span style="color:red">*</span></label>
															</div>
															<div class="form-group col-md-10">
																<textarea id="title" name="title" rows="4" cols="100" placeholder="type/paste here.." style="padding:10px;" required></textarea>
															</div>

														</div>

														<div class="form-row">
													<div class="form-group col-md-6">
														<label>Enter PI/Site-PI name</label>
														<input type="text" name="pi" class="form-control">
													</div>
													<div class="form-group col-md-6">
														<label>Enter Project duratione</label>
														<input type="text" name="duration" class="form-control">

													</div>
												</div>


													</div>



													<div id="dd" style="display:none;">
														<div class="form-row">
															<div class="col-md-2 col-sm-offset-2">
																<button class="btn btn-primary" name="submit" type="submit" onclick="return confirm('Do you want to final submit');">submit</button>
															</div>
														</div>
													</div>

													<input type="hidden" name="editid" class="form-control" value="<?php echo htmlentities($result->id); ?>">

												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>


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

		<!-- Core plugin JavaScript-->
		<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

		<!-- Custom scripts for all pages-->
		<script src="js/sb-admin-2.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				setTimeout(function() {
					$('.succWrap').slideUp("slow");
				}, 3000);
			});
		</script>
		<script>
			$('select[name=info_type]').on('change', function() {
				if (this.value == 1 || this.value == 2 || this.value == 3) {
					$("#aa").show();
					$("#dd").show();

				} else {
					$("#aa").hide();

					$("#dd").hide();

				}
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
