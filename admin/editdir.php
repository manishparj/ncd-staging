		<!-- Tenders page edit-model code -->
		<?php
		include('inc/config.php');
		$famID = $_GET['famID'];
		// $famAddr=$_GET['famAddr'];
		$sql9 = "SELECT * from director_profile where id = $famID";
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
									<label class="control-label">director_profile:</label>
								</div>
								<div class="form-group col-md-10">
									<textarea id="director_profile" name="director_profile" rows="8" cols="80" placeholder="type/paste here.." style="padding:10px;"><?php echo htmlentities($result20->director_profile); ?></textarea>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-2">
									<label class="control-label">director_messgae:</label>
								</div>
								<div class="form-group col-md-10">
									<textarea id="director_message" name="director_message" rows="8" cols="80" placeholder="type/paste here.." style="padding:10px;"><?php echo htmlentities($result20->director_message); ?></textarea>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-2">
									<label class="control-label">director_profile_hi:</label>
								</div>
								<div class="form-group col-md-10">
									<textarea id="director_profile_hi" name="director_profile_hi" rows="8" cols="80" placeholder="type/paste here.." style="padding:10px;"><?php echo htmlentities($result20->director_profile_hi); ?></textarea>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-2">
									<label class="control-label">director_messgae_hi:</label>
								</div>
								<div class="form-group col-md-10">
									<textarea id="director_message_hi" name="director_message_hi" rows="8" cols="80" placeholder="type/paste here.." style="padding:10px;"><?php echo htmlentities($result20->director_message_hi); ?></textarea>
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
							<button class="btn btn-primary" name="submit1" type="submit1" onclick="return confirm('Do you want to Update');">update</button>
						</div>
						<div class="col-md-4">
						</div>

					</div>
						</form>
					</div>
				</div>