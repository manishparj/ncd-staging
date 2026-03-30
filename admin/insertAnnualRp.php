<?php
session_start();
error_reporting(1);
include('inc/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {

	if(isset($_POST['submit']))
{


	$file = $_FILES['uplmdoc']['name'];
	$file_loc = $_FILES['uplmdoc']['tmp_name'];
	$folder="../annualreport/en/";
			//$folder="niirncd/en_doc/";
	$new_file_name = strtolower($file);
	$final_file=str_replace(' ','-',$new_file_name);

	$file1 = $_FILES['uplmdoc1']['name'];
	$file_loc1 = $_FILES['uplmdoc1']['tmp_name'];
	$folder1="../annualreport/hi/";
			//$folder="niirncd/en_doc/";
	$new_file_name1 = strtolower($file1);
	$final_file1=str_replace(' ','-',$new_file_name1);



	$year = $_POST['info_type'];

	if (preg_match("/^\d{4}$/", $year)) {
       
		$title = "Anuual Report";


		if(move_uploaded_file($file_loc,$folder.$final_file) )
		{
			$doc_main=$final_file;
		}
		if(move_uploaded_file($file_loc1,$folder1.$final_file1) )
{
  $doc_main1=$final_file1;
}



$sqlnoti="insert into annualrp (year,report_en,report_hi) values (NULLIF('$year', ''),:docq,:docw)";
$querynoti = $dbh->prepare($sqlnoti);
$querynoti->bindParam(':docq', $doc_main, PDO::PARAM_STR);
$querynoti->bindParam(':docw', $doc_main1, PDO::PARAM_STR);
$querynoti->execute();
$lastInsertId = $dbh->lastInsertId();

  
if($lastInsertId)
{
echo "<script type='text/javascript'>alert('Record inserted successfully!');</script>";
//$_SESSION['alogin']=$u_id;
//header('location:dashboard.php');
}
else
{
$error="(*)fields are mandatory. Please try again";
}
    } else {
        // The input is not a valid year
       
		echo "<script type='text/javascript'>alert('Invalid year input. Please enter a valid year (four digits)!');</script>";
    }
	

}


// if(isset($_POST['submit']))
// {


// 	$file = $_FILES['uplmdoc']['name'];
// 	$file_loc = $_FILES['uplmdoc']['tmp_name'];
// 	$folder="../annualreport/en/";
// 			//$folder="niirncd/en_doc/";
// 	$new_file_name = strtolower($file);
// 	$final_file=str_replace(' ','-',$new_file_name);

// 	$file1 = $_FILES['uplmdoc1']['name'];
// 	$file_loc1 = $_FILES['uplmdoc1']['tmp_name'];
// 	$folder1="../annualreport/hi/";
// 			//$folder="niirncd/en_doc/";
// 	$new_file_name1 = strtolower($file1);
// 	$final_file1=str_replace(' ','-',$new_file_name1);

// 	$year = $_POST['info_type'];
// 	$title = "Anuual Report";


// 				if(move_uploaded_file($file_loc,$folder.$final_file) )
// 				{
// 					$doc_main=$final_file;
// 				}
// 				if(move_uploaded_file($file_loc1,$folder1.$final_file1) )
// 	  {
// 		  $doc_main1=$final_file1;
// 	  }



//   	$sqlnoti="insert into annualrp (year,report_en,report_hi) values (NULLIF('$year', ''),:docq,:docw)";
//   	$querynoti = $dbh->prepare($sqlnoti);
// 	$querynoti->bindParam(':docq', $doc_main, PDO::PARAM_STR);
// 	$querynoti->bindParam(':docw', $doc_main1, PDO::PARAM_STR);
//   	$querynoti->execute();
//   	$lastInsertId = $dbh->lastInsertId();


//   if($lastInsertId)
//   {
//   echo "<script type='text/javascript'>alert('Record inserted successfully!');</script>";
//   //$_SESSION['alogin']=$u_id;
//   //header('location:dashboard.php');
//   }
//   else
//   {
//   $error="(*)fields are mandatory. Please try again";
//   }

// }

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
														<div class="form-group col-md-2">
																<label class="control-label">insert year:</label>
														</div>
														<div class="form-group col-md-2">
															<!-- <select id="id_info_type" name="info_type" class="form-control">
																<option selected>Select type</option>
																<option value="2022">2022</option>
																<option value="2021">2021</option>
																<option value="2020">2020</option>
																<option value="2019">2019</option>
																<option value="2018">2018</option>
																<option value="2017">2017</option>
																<option value="2016">2016</option>
																<option value="2015">2015</option>



															</select> -->
															<input type="year" name="info_type" class="form-control" />
														</div>
														<div class="form-group col-md-4">
														</div>
													</div>



													<!-- div aa -->
													<div id="aa" style="display:block;">


														<div class="form-row">
															<div class="form-group col-md-6">
																<label class="control-label">upload annual report - English:<span style="color:red">*</span></label>
																<input type="file" id="uplmdoc" name="uplmdoc" class="form-control" accept="application/pdf" required>
															</div>
															<div class="form-group col-md-6">
																<label class="control-label">upload annual report- Hindi:<span style="color:red">*</span></label>
																<input type="file" id="uplmdoc1" name="uplmdoc1" class="form-control" accept="application/pdf" required>
															</div>


														</div>


													</div>



													<div id="dd" style="display:block;">
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
document.getElementById("uplmdoc").addEventListener("change", validateFileExtension);
document.getElementById("uplmdoc1").addEventListener("change", validateFileExtension);

function validateFileExtension(event) {
    const input = event.target;
    const fileName = input.value;
    const validExtensions = [".pdf"];

    if (!validExtensions.some(ext => fileName.endsWith(ext))) {
        alert("Only PDF files are allowed.");
        input.value = ""; // Clear the file input
    }
}
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
