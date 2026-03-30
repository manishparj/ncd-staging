<?php
include('inc/config.php');
error_reporting(0);
$famID = $_GET['famID'];
$famAddr = $_GET['famAddr'];



$sql9 = "SELECT * from announcement where id = $famID";
$query9 = $dbh->prepare($sql9);
$query9->execute();
$results9 = $query9->fetchAll(PDO::FETCH_OBJ); 
if ($query9->rowCount() > 0) {
	foreach ($results9 as $result19) {
		print_r($result19->messages);
?>

	
			<!-- Default Card Example -->
			<div class="modal-body card mb-12"> 
				<div class="card-header">
					Update-content <span class="close">&times;</span> 
				</div>

				<div class="card-body">
					<form method="post" class="form-horizontal" enctype="multipart/form-data">
						<!-- title  -->
						
					 

						<!-- status & last date-->
						<!-- title  -->
						<div class="form-row">
															<div class="form-group col-md-2">
																<label class="control-label">Title:<span style="color:red">*</span></label>
															</div>
															<div class="form-group col-md-10">
																<textarea id="text1" name="text1" rows="4" cols="100" style="padding:10px;" ><?php echo htmlentities($result19->messages) ?></textarea>
															</div>
														</div>

					

						<input type="hidden" id="edid" name="edid" class="form-control" value="<?php echo htmlentities($result19->id); ?>">
					
							<?php }} ?>
						<div class="form-row">
							<div class="col-md-4">
								<button class="btn btn-primary" name="submit" type="submit" onclick="return confirm('Do you want to Update');">update</button>
							</div>
						</div>
					</form>
				</div>
			</div>
	

		