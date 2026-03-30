		<!-- Tenders page edit-model code -->
		<?php
		include('inc/config.php');

		$famID = $_GET['famID'];


		$sql9 = "SELECT * from dgicmr where id = $famID";
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
									<img src="img/our_team/aspaintalchair/<?php echo htmlentities($result20->img); ?>" style="width:100px;border:1" />
								</div>
								<div class="form-group col-md-4">
									<label>Upload new profile image-<span style="color:red">*</span></label>
									<input type="file" name="emp_image" class="form-control" accept="image/jpeg,image/gif,image/png">
								</div>
							</div>

							<div class="form-row">
								<div class="form-group col-md-4">
									<label>Name-en<span style="color:red">*</span></label>
									<input type="text" name="emp_name" class="form-control" value="<?php echo htmlentities($result20->name_en); ?>">
								</div>
								<div class="form-group col-md-4">
									<label>Name-hi<span style="color:red">*</span></label>
									<input type="text" name="emp_name_hi" class="form-control" value="<?php echo htmlentities($result20->name_hi); ?>">
								</div>


							</div>
	

					<input type="hidden" id="edid" name="edid" class="form-control" value="<?php echo htmlentities($result20->id); ?>">
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