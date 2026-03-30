		<?php
		include('inc/config.php');
		$famID = $_GET['famID'];
		// $famAddr=$_GET['famAddr'];
		$sql9 = "SELECT * from emp_profile where emp_id = $famID";
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
									<label class="control-label">brief_intro:</label>
								</div>
								<div class="form-group col-md-10">
									<textarea id="brief_intro" name="brief_intro" rows="8" cols="80" placeholder="type/paste here.." style="padding:10px;"><?php echo htmlentities($result20->brief_intro); ?></textarea>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-2">
									<label class="control-label">academic:</label>
								</div>
								<div class="form-group col-md-10">
									<textarea id="academic" name="academic" rows="8" cols="80" placeholder="type/paste here.." style="padding:10px;"><?php echo htmlentities($result20->academic); ?></textarea>
								</div>
							</div>

							<div class="form-row">
								<div class="form-group col-md-2">
									<label class="control-label">publication:</label>
								</div>
								<div class="form-group col-md-10">
									<textarea id="publication" name="publication" rows="8" cols="80" placeholder="type/paste here.." style="padding:10px;"><?php echo htmlentities($result20->publication); ?></textarea>
								</div>
							</div>

							<div class="form-row">
								<div class="form-group col-md-2">
									<label class="control-label">complete_project:</label>
								</div>
								<div class="form-group col-md-10">
									<textarea id="comp_project" name="comp_project" rows="8" cols="80" placeholder="type/paste here.." style="padding:10px;"><?php echo htmlentities($result20->comp_project); ?></textarea>
								</div>
							</div>

							<div class="form-row">
								<div class="form-group col-md-2">
									<label class="control-label">ongoing_project:</label>
								</div>
								<div class="form-group col-md-10">
									<textarea id="ong_project" name="ong_project" rows="8" cols="80" placeholder="type/paste here.." style="padding:10px;"><?php echo htmlentities($result20->ong_project); ?></textarea>
								</div>
							</div>


							<input type="hidden" id="edid" name="edid" class="form-control" value="<?php echo htmlentities($result20->emp_id); ?>">
							<input type="hidden" id="typ" name="typ" class="form-control" value="<?php echo htmlentities($result20->emp_type); ?>">
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