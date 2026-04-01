<?php
session_start();
error_reporting(0);
include('inc/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

if(isset($_POST['submit']))
{
    $text1 = $_POST['text1'];
    $text2 = $_POST['text2'];
    $has_multiple_images = isset($_POST['has_multiple_images']) ? 1 : 0;
    
    // Insert slider record first
    $sqlnoti = "INSERT INTO slider(messages, messages2, has_multiple_images) VALUES (?, ?, ?)";
    $querynoti = $dbh->prepare($sqlnoti);
    $querynoti->execute([$text1, $text2, $has_multiple_images]);
    $lastInsertId = $dbh->lastInsertId();
    
    if($lastInsertId) {
        // Handle file uploads
        $upload_dir = "../assets/img/hero/";
        
        // Check if multiple images are being uploaded
        if($has_multiple_images && !empty($_FILES['multiple_images']['name'][0])) {
            $image_files = $_FILES['multiple_images'];
            $image_count = count($image_files['name']);
            
            for($i = 0; $i < $image_count; $i++) {
                if($image_files['error'][$i] == 0) {
                    $file_name = $image_files['name'][$i];
                    $file_tmp = $image_files['tmp_name'][$i];
                    $new_file_name = strtolower(str_replace(' ', '-', $file_name));
                    $final_file = time() . '_' . $new_file_name;
                    
                    if(move_uploaded_file($file_tmp, $upload_dir . $final_file)) {
                        $is_cover = ($i == 0) ? 1 : 0; // First image as cover
                        
                        // Insert image record
                        $sql_img = "INSERT INTO slider_images(slider_id, image_path, image_order, is_cover) VALUES (?, ?, ?, ?)";
                        $query_img = $dbh->prepare($sql_img);
                        $query_img->execute([$lastInsertId, $final_file, $i, $is_cover]);
                    }
                }
            }
            // Also handle cover photo separately if provided
            if(!empty($_FILES['cover_photo']['name'])) {
                $cover_file = $_FILES['cover_photo']['name'];
                $cover_tmp = $_FILES['cover_photo']['tmp_name'];
                $cover_new = strtolower(str_replace(' ', '-', $cover_file));
                $cover_final = time() . '_cover_' . $cover_new;
                
                if(move_uploaded_file($cover_tmp, $upload_dir . $cover_final)) {
                    // Update the cover photo in slider_images
                    $sql_update_cover = "UPDATE slider_images SET is_cover = 0 WHERE slider_id = ?";
                    $query_update = $dbh->prepare($sql_update_cover);
                    $query_update->execute([$lastInsertId]);
                    
                    $sql_cover = "INSERT INTO slider_images(slider_id, image_path, image_order, is_cover) VALUES (?, ?, 0, 1)";
                    $query_cover = $dbh->prepare($sql_cover);
                    $query_cover->execute([$lastInsertId, $cover_final]);
                }
            }
        } else {
            // Single image upload (backward compatibility)
            if(!empty($_FILES['a_pdf']['name'])) {
                $file = $_FILES['a_pdf']['name'];
                $file_loc = $_FILES['a_pdf']['tmp_name'];
                $folder = "../assets/img/hero/";
                $new_file_name = strtolower($file);
                $final_file = str_replace(' ', '-', $new_file_name);
                
                if(move_uploaded_file($file_loc, $folder . $final_file)) {
                    $sql_update = "UPDATE slider SET doc_upload = ? WHERE id = ?";
                    $query_update = $dbh->prepare($sql_update);
                    $query_update->execute([$final_file, $lastInsertId]);
                }
            }
        }
        
        echo "<script type='text/javascript'>alert('Record inserted successfully!'); window.location.href='viewslider.php';</script>";
    } else {
        $error = "(*)fields are mandatory. Please try again";
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

    <title>Admin-Dashboard - Add Slider</title>

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
        
        .image-preview {
            margin-top: 10px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        
        .image-preview-item {
            position: relative;
            width: 100px;
            height: 100px;
            border: 1px solid #ddd;
            border-radius: 4px;
            overflow: hidden;
        }
        
        .image-preview-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .image-preview-item .remove-img {
            position: absolute;
            top: 2px;
            right: 2px;
            background: rgba(255,0,0,0.7);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            text-align: center;
            line-height: 18px;
            cursor: pointer;
            font-size: 12px;
        }
        
        .multiple-images-section {
            display: none;
            margin-top: 20px;
            padding: 15px;
            background: #f8f9fc;
            border-radius: 8px;
        }
        
        .single-image-section {
            display: block;
        }
        
        .switch-mode {
            margin-bottom: 15px;
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
                            <h3 class="page-title">Insert new slider record</h3>
                            <div class="row" style="padding: 40px;">
                                <div class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">Slider Information</div>
                                        <?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } ?>

                                        <div class="panel-body">
                                            <form method="post" class="form-horizontal" enctype="multipart/form-data" id="sliderForm">

                                                <div class="form-row">
                                                    <div class="form-group col-md-2">
                                                        <label class="control-label">Title:<span style="color:red">*</span></label>
                                                    </div>
                                                    <div class="form-group col-md-10">
                                                        <textarea id="text1" name="text1" rows="4" cols="100" placeholder="Banner Title here.." style="padding:10px;" required></textarea>
                                                    </div>
                                                    
                                                    <div class="form-group col-md-2">
                                                        <label class="control-label">Title dates:</label>
                                                    </div>
                                                    <div class="form-group col-md-10">
                                                        <input type="text" id="text2" name="text2" class="form-control" placeholder="Banner dates here.." style="padding:10px;">
                                                    </div>
                                                </div>

                                                <!-- Upload Mode Selection -->
                                                <div class="form-row switch-mode">
                                                    <div class="form-group col-md-12">
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="custom-control-input" id="has_multiple_images" name="has_multiple_images">
                                                            <label class="custom-control-label" for="has_multiple_images">Enable Multiple Images (Gallery Mode)</label>
                                                        </div>
                                                        <small class="text-muted">Enable this to upload multiple photos for this slider event</small>
                                                    </div>
                                                </div>

                                                <!-- Single Image Upload Section -->
                                                <div id="singleImageSection" class="single-image-section">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-2">
                                                            <label class="control-label">Upload Image:</label>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <input type="file" name="a_pdf" id="a_pdf" accept="image/*" />
                                                            <small class="text-muted">Upload a single image for this slider</small>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Multiple Images Upload Section -->
                                                <div id="multipleImagesSection" class="multiple-images-section">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-2">
                                                            <label class="control-label">Cover Photo:</label>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <input type="file" name="cover_photo" id="cover_photo" accept="image/*" />
                                                            <small class="text-muted">This will be the main/cover image for the slider</small>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-row">
                                                        <div class="form-group col-md-2">
                                                            <label class="control-label">Additional Photos:</label>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <input type="file" name="multiple_images[]" id="multiple_images" multiple accept="image/*" />
                                                            <small class="text-muted">You can select multiple images. First image will be used as cover if cover photo not specified</small>
                                                        </div>
                                                    </div>
                                                    
                                                    <div id="imagePreview" class="image-preview"></div>
                                                </div>

                                                <div id="dd" style="display:block;">
                                                    <div class="form-row">
                                                        <div class="col-md-2 col-sm-offset-2">
                                                            <button class="btn btn-primary" name="submit" type="submit" onclick="return confirm('Do you want to final submit');">Submit</button>
                                                            <a href="viewslider.php" class="btn btn-secondary">Cancel</a>
                                                        </div>
                                                    </div>
                                                </div>

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
        
        // Toggle between single and multiple image upload
        $('#has_multiple_images').change(function() {
            if($(this).is(':checked')) {
                $('#singleImageSection').hide();
                $('#multipleImagesSection').show();
                $('#a_pdf').prop('required', false);
                $('#cover_photo').prop('required', false);
                $('#multiple_images').prop('required', true);
            } else {
                $('#singleImageSection').show();
                $('#multipleImagesSection').hide();
                $('#a_pdf').prop('required', true);
                $('#multiple_images').prop('required', false);
            }
        });
        
        // Preview images before upload
        $('#multiple_images').on('change', function() {
            previewImages(this, '#imagePreview');
        });
        
        $('#cover_photo').on('change', function() {
            previewImages(this, '#imagePreview', true);
        });
        
        function previewImages(input, previewContainer, isCover = false) {
            if (input.files) {
                if(!isCover) {
                    $(previewContainer).empty();
                }
                var filesAmount = input.files.length;
                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();
                    reader.onload = function(event) {
                        var previewHtml = $('<div class="image-preview-item"><img src="' + event.target.result + '"><span class="remove-img">×</span></div>');
                        $(previewContainer).append(previewHtml);
                        
                        // Add remove functionality
                        previewHtml.find('.remove-img').click(function() {
                            $(this).parent().remove();
                        });
                    }
                    reader.readAsDataURL(input.files[i]);
                }
            }
        }
    </script>
    
    <style>
        .custom-control-switch {
            margin-bottom: 10px;
        }
        .custom-control-input:checked ~ .custom-control-label::before {
            background-color: #003679;
            border-color: #003679;
        }
    </style>
</body>

</html>
<?php } ?>