		<!-- Tenders page edit-model code -->
		<?php
		include('inc/config.php');

		$famID = $_GET['famID'];
		// $famAddr=$_GET['famAddr'];


		$sql9 = "SELECT * from emp_details where emp_id = $famID";
		$query9 = $dbh->prepare($sql9);
		$query9->execute();
		$results9 = $query9->fetchAll(PDO::FETCH_OBJ);
		if ($query9->rowCount() > 0) {
			foreach ($results9 as $result20) {
		?>
				<!-- Default Card Example -->
				<div class="modal-body card mb-12">
					<div class="card-header">
						Update-content <span class="close">&times;</span>
					</div>

					<div class="card-body">
						<form method="post" class="form-horizontal" enctype="multipart/form-data">
							<div class="form-row">
								<div class="form-group col-md-2">
									<img src="img/our_team/<?php echo htmlentities($result20->emp_type) . "/" . htmlentities($result20->emp_image); ?>" style="width:100px;border:1" />
								</div>
								<div class="form-group col-md-4">
									<label>Upload new profile image-<span style="color:red">*</span></label>
									<input type="file" name="emp_image" class="form-control" accept="image/jpeg,image/gif,image/png" >
								</div>
							</div>

							<div class="form-row">
								<div class="form-group col-md-4">
									<label>Name-<span style="color:red">*</span></label>
									<input type="text" name="emp_name" class="form-control" value="<?php echo htmlentities($result20->emp_name); ?>" readonly>
								</div>
								<div class="form-group col-md-4">
									<label>Designation-<span style="color:red">*</span></label>
									<input type="text" name="emp_desig" class="form-control" value="<?php echo htmlentities($result20->emp_desig); ?>" readonly>

														</div>
								<div class="form-group col-md-4">
									<label>Status-<span style="color:red">*</span></label>
									<input type="text" name="status" class="form-control" value="<?php echo htmlentities($result20->emp_status); ?>" readonly>

								</div>
							</div>

							<div class="form-row">
								<div class="form-group col-md-4">
									<label>Name-hi<span style="color:red">*</span></label>
									<input type="text" name="emp_name_hi" class="form-control" value="<?php echo htmlentities($result20->emp_name_hi); ?>" readonly>
								</div>
								<div class="form-group col-md-4">
									<label>Designation-hi<span style="color:red">*</span></label>
									<input type="text" name="emp_desig_hi" class="form-control" value="<?php echo htmlentities($result20->emp_desig); ?>" readonly>
								</div>

							</div>

							<div class="form-row">
								<div class="form-group col-md-4">
									<label>Tel No.-<span style="color:red">*</span></label>
									<input type="tel" name="emp_tel" class="form-control" value="<?php echo htmlentities($result20->emp_contact); ?>">
								</div>

								<div class="form-group col-md-4">
									<label>Email-<span style="color:red">*</span></label>
									<input type="email" name="emp_email" class="form-control" value="<?php echo htmlentities($result20->emp_email); ?>" readonly>
								</div>

								<div class="form-group col-md-4">
									<!-- <label>Seniority Rank no.-<span style="color:red">*</span></label> -->
									<input type="hidden" name="emp_sr_rank" class="form-control" value="<?php echo htmlentities($result20->emp_seniority); ?>">
								</div>

							</div>


							<hr class="sidebar-divider">

							<div class="form-row">
								<div class="form-group col-md-2">
									<label class="control-label">Research intrest:</br><small>(only for Scientific posts)</small><span style="color:red">*</span></label>
								</div>
								<div class="form-group col-md-10">
									<textarea id="research_interest" name="research_interest" rows="3" cols="70" placeholder="type/paste here.." style="padding:10px;" readonly><?php echo htmlentities($result20->research_interest); ?></textarea>
								</div>

							</div>

							<div class="form-row">
								<div class="form-group col-md-2">
									<label class="control-label">Google Scholar Link:</br><small>(only for Scientific posts)</small><span style="color:red">*</span></label>
								</div>
								<div class="form-group col-md-10">
									<textarea id="googlescholar" name="googlescholar" rows="3" cols="70" placeholder="type/paste here.." style="padding:10px;"><?php echo htmlentities($result20->googlescholar); ?></textarea>
								</div>

							</div>



							<input type="hidden" id="edid" name="edid" class="form-control" value="<?php echo htmlentities($result20->emp_id); ?>">
							<input type="hidden" id="typ" name="typ" class="form-control" value="<?php echo htmlentities($result20->emp_type); ?>">
							<input type="hidden" id="img" name="img" class="form-control" value="<?php echo htmlentities($result20->emp_image); ?>">

					<?php }
			} ?>

					<div class="form-row">
						<div class="col-md-4">
						</div>
						<div class="col-md-4">
							<button class="btn btn-primary" name="submit" type="submit" onclick="return confirm('Do you want to Update');">update</button>
						</div>
						<div class="col-md-4">
						</div>

					</div>
						</form>
					</div>
				</div>
