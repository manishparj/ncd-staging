<?php
include('inc/config.php');
error_reporting(0);
$famID = $_GET['famID'];
$famAddr = $_GET['famAddr'];


$sql9 = "SELECT * from info_en where id = $famID";
$query9 = $dbh->prepare($sql9);
$query9->execute();
$results9 = $query9->fetchAll(PDO::FETCH_OBJ);
if ($query9->rowCount() > 0) {
	foreach ($results9 as $result19) {
?>

	
			<!-- Default Card Example -->
			<div class="modal-body card mb-12"> 
				<div class="card-header">
					Update-content <span class="close">&times;</span> 
				</div>

				<div class="card-body">
					<form method="post" class="form-horizontal" enctype="multipart/form-data">
						<!-- title  -->
						<div class="form-row">
							<div class="form-group col-md-12">
								<label class="col-sm-2 control-label">Title:<span style="color:red">*</span></label>
								<textarea id="title" name="title" rows="4" cols="100" placeholder="type/paste here.." style="padding:10px;"><?php echo htmlentities($result19->title); ?></textarea>
							</div>
						</div>
					    <!-- uploading date & pdf  -->
						<div class="form-row">
							<div class="form-group col-md-6"> 
								<label>upload date</label>
								<input type="date" id="upldate" name="upldate" class="form-control" value="<?php echo htmlentities($result19->upl_date); ?>">
							</div>
							<div class="form-group col-md-3">
								<label>upload main pdf</label>
								<input type="file" id="uplmdoc" name="uplmdoc" class="form-control" accept="application/pdf">
							</div>
							<div class="form-group col-md-3">
								<label>View Previous pdf</label>
								<a href="en_doc/<?php echo htmlentities($famAddr); ?>" target="_blank">
									<p class="form-control"><u> Previous pdf</u>&nbsp;<i class="fa fa-file-pdf-o" aria-hidden="true" style="color:red"></i></p>
								</a>
							</div>
						</div>

						<!-- status & last date-->
						<div class="form-row" id="t" style="display:none;">

							<div class="form-group col-md-6">
								<label>Status<span style="color:red">*</span></label>
								<select id="status" name="status" class="form-control">
									<option value="<?php echo htmlentities($result19->status); ?>"><?php echo htmlentities($result19->status); ?></option>
									<option value="Open">Open</option>
									<option value="Close">Close</option>
								</select>
							</div>

							<div class="form-group col-md-6">
								<label>Last date<span style="color:red">*</span></label>
								<input type="date" id="lastdt" name="lastdt" class="form-control" value="<?php echo htmlentities($result19->last_dt); ?>">
							</div>
						</div>

						<input type="hidden" id="edid" name="edid" class="form-control" value="<?php echo htmlentities($result19->id); ?>">
						<input type="hidden" id="typ" name="typ" class="form-control" value="<?php echo htmlentities($result19->type); ?>">
						<input type="hidden" id="category" name="category" class="form-control" value="<?php echo htmlentities($result19->category); ?>">
						<input type="hidden" id="pdf_file" name="pdf_file" class="form-control" value="<?php echo htmlentities($result->doc_main); ?>">

							<?php }} ?>
						<div class="form-row">
							<div class="col-md-4">
								<button class="btn btn-primary" name="submit" type="submit" onclick="return confirm('Do you want to Update');">update</button>
							</div>
						</div>
					</form>
				</div>
			</div>
	

		