		<!-- Tenders page edit-model code -->
<?php
include('inc/config.php');
error_reporting(0);
$famID=$_GET['famID'];
$famAddr=$_GET['famAddr'];


$sql9 = "SELECT * from info_hi where id = $famID";
$query9 = $dbh -> prepare($sql9);
$query9->execute();
$results9=$query9->fetchAll(PDO::FETCH_OBJ);
if($query9->rowCount() > 0)
{
foreach($results9 as $result20)
{
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
                    <textarea id="title" name="title" rows="4" cols="100" placeholder="type/paste here.."
                        style="padding:10px;"><?php echo htmlentities($result20->title); ?></textarea>
                </div>
            </div>

            <!-- uploading date & pdf  -->
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>upload date</label>
                    <input type="date" id="upldate" name="upldate" class="form-control"
                        value="<?php echo htmlentities($result20->upl_date); ?>">
                </div>
                <div class="form-group col-md-3">
                    <label>upload main pdf</label>
                    <input type="file" id="uplmdoc" name="uplmdoc" class="form-control" accept="application/pdf">
                </div>
                <div class="form-group col-md-3">
                    <label>View Previous pdf</label>
                    <a href="hi_doc/<?php echo htmlentities($famAddr); ?>" target="_blank">
                        <p class="form-control"><u> Previous pdf</u>&nbsp;<i class="fa fa-file-pdf-o" aria-hidden="true"
                                style="color:red"></i></p>
                    </a>
                </div>
            </div>

            <!-- status & last date-->
            <div class="form-row">

                <div class="form-group col-md-6" style="display: none;">
                    <label>Status<span style="color:red">*</span></label>
                    <select id="status" name="status" class="form-control">
                        <option value="<?php echo htmlentities($result20->status); ?>">
                            <?php echo htmlentities($result20->status); ?></option>
                        <option value="Open">Open</option>
                        <option value="Close">Close</option>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label>Last date<span style="color:red">*</span></label>
                    <input type="date" id="lastdt" name="lastdt" class="form-control"
                        value="<?php echo htmlentities($result20->last_dt); ?>">
                </div>
            </div>

			<hr class="sidebar-divider">


            <?php
			$sql8 = "SELECT * from doc_hi where doc_id = $result20->id";
			$query8 = $dbh -> prepare($sql8);
			$query8->execute();
			$results8=$query8->fetchAll(PDO::FETCH_OBJ);
			if($query8->rowCount() > 0)
			{
			foreach($results8 as $result18)
			{				?>

            <!-- pdf-1 -->
			<div class="form-row">
            	<div class="col-md-6">
                	<label>name of pdf-1</label>
                    <input type="text" id="az" name="az" class="form-control" value="<?php echo htmlentities($result18->doc_nm_a);?>">
				</div>
                
				<div class="col-md-6">
                	<label class="control-label">upload pdf<span style="color:red">*</span></label>
                	<input type="file" id="uplaz" name="uplaz" class="form-control" accept="application/pdf">
            	</div>
			</div>
			<hr class="sidebar-divider">

            <!-- pdf-2 -->

			<div class="form-row">
            	<div class="col-md-6">
                	<label>name of pdf-2</label>
                    <input type="text" id="bz" name="bz" class="form-control" value="<?php echo htmlentities($result18->doc_nm_b);?>">
				</div>
                
				<div class="col-md-6">
                	<label class="control-label">upload pdf<span style="color:red">*</span></label>
                    <input type="file" id="uplbz" name="uplbz" class="form-control" accept="application/pdf">
            	</div>
			</div>
			<hr class="sidebar-divider">

            <!-- pdf-3 -->
			
			<div class="form-row">
            	<div class="col-md-6">
                	<label>name of pdf-3</label>
                    <input type="text" id="cz" name="cz" class="form-control" value="<?php echo htmlentities($result18->doc_nm_c);?>">
				</div>
                
				<div class="col-md-6">
                	<label class="control-label">upload pdf<span style="color:red">*</span></label>
                    <input type="file" id="uplcz" name="uplcz" class="form-control" accept="application/pdf">
            	</div>
			</div>
			<hr class="sidebar-divider">

            <!-- pdf-4 -->

			<div class="form-row">
            	<div class="col-md-6">
                	<label>name of pdf-4</label>
                    <input type="text" id="dz" name="dz" class="form-control" value="<?php echo htmlentities($result18->doc_nm_d);?>">
				</div>
                
				<div class="col-md-6">
                	<label class="control-label">upload pdf<span style="color:red">*</span></label>
                    <input type="file" id="upldz" name="upldz" class="form-control" accept="application/pdf">
            	</div>
			</div>
			<hr class="sidebar-divider">

            <!-- pdf-5 -->
			<div class="form-row">
            	<div class="col-md-6">
                	<label>name of pdf-5</label>
                    <input type="text" id="ez" name="ez" class="form-control" value="<?php echo htmlentities($result18->doc_nm_e);?>">
				</div>
                
				<div class="col-md-6">
                	<label class="control-label">upload pdf<span style="color:red">*</span></label>
                    <input type="file" id="uplez" name="uplez" class="form-control" accept="application/pdf">
            	</div>
			</div>
			<hr class="sidebar-divider">

            <!-- pdf-6 -->
			<div class="form-row">
            	<div class="col-md-6">
                	<label>name of pdf-6</label>
                    <input type="text" id="fz" name="fz" class="form-control" value="<?php echo htmlentities($result18->doc_nm_f);?>">
				</div>
                
				<div class="col-md-6">
                	<label class="control-label">upload pdf<span style="color:red">*</span></label>
                    <input type="file" id="uplfz" name="uplfz" class="form-control" accept="application/pdf">
            	</div>
			</div>
			<hr class="sidebar-divider">


            <!-- pdf-7 -->
			<div class="form-row">
            	<div class="col-md-6">
                	<label>name of pdf-7</label>
                    <input type="text" id="gz" name="gz" class="form-control" value="<?php echo htmlentities($result18->doc_nm_g);?>">
				</div>
                
				<div class="col-md-6">
                	<label class="control-label">upload pdf<span style="color:red">*</span></label>
                    <input type="file" id="uplgz" name="uplgz" class="form-control" accept="application/pdf">
            	</div>
			</div>
			<hr class="sidebar-divider">

            <!-- pdf-8 -->
			<div class="form-row">
            	<div class="col-md-6">
                	<label>name of pdf-8</label>
                    <input type="text" id="hz" name="hz" class="form-control" value="<?php echo htmlentities($result18->doc_nm_h);?>">
				</div>
                
				<div class="col-md-6">
                	<label class="control-label">upload pdf<span style="color:red">*</span></label>
                    <input type="file" id="uplhz" name="uplhz" class="form-control" accept="application/pdf">
            	</div>
			</div>



            <!-- <div class="form-group">
				<label class="col-sm-2 control-label">name of pdf</label>
				<div class="col-sm-4">
					<input type="text" id="iz" name="iz" class="form-control" value="<?php //echo htmlentities($result18->doc_nm_i);?>">
				</div>

			<label class="col-sm-2 control-label">upload pdf</label>
			<div class="col-sm-4">
				<input type="file" id="upliz" name="upliz" class="form-control" accept="application/pdf"  >
			</div>
			</div>


			<div class="form-group">
				<label class="col-sm-2 control-label">name of pdf</label>
				<div class="col-sm-4">
					<input type="text" id="jz" name="jz" class="form-control" value="<?php //echo htmlentities($result18->doc_nm_j);?>">
				</div>

			<label class="col-sm-2 control-label">upload pdf</label>
			<div class="col-sm-4">
				<input type="file" id="upljz" name="upljz" class="form-control" accept="application/pdf"  >
			</div>
			</div> -->


            <?php }} ?>

            <input type="hidden" id="edid" name="edid" class="form-control"
                value="<?php echo htmlentities($result20->id);?>">
            <input type="hidden" id="typ" name="typ" class="form-control"
                value="<?php echo htmlentities($result20->type);?>">
            <input type="hidden" id="pdf_file" name="pdf_file" class="form-control"
                value="<?php echo htmlentities($result20->doc_main);?>">
            <input type="hidden" id="apform" name="apform" value="application_form_temp.pdf">

            <?php }} ?>

				<div class="form-row">
            <div class="col-md-4">
                    <button class="btn btn-primary" name="submit" type="submit" onclick="return confirm('Do you want to Update');">update</button>
            </div>
			</div>
        </form>
    </div>
</div>