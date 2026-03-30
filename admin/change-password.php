<?php
session_start();
error_reporting(0);
include('inc/config.php');
if(strlen($_SESSION['alogin'])==0)
	{
header('location:index.php');
}
else{
// Code for change password
if(isset($_POST['submit']))
	{
$password=md5($_POST['password']);
$newpassword=md5($_POST['newpassword']);
$username=$_SESSION['alogin'];
$sql ="SELECT Password FROM admin WHERE UserName=:username and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':username', $username, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
$con="update admin set Password=:newpassword where UserName=:username";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1-> bindParam(':username', $username, PDO::PARAM_STR);
$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
$chngpwd1->execute();
$msg="Your Password succesfully changed";
}
else {
$error="Your current password is not valid.";
}
}
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#3e454c">

    <title>Admin Change Password</title>


    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <script type="text/javascript">
    function valid() {
        if (document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
            alert("New Password and Confirm Password Field do not match  !!");
            document.chngpwd.confirmpassword.focus();
            return false;
        }
        return true;
    }
    </script>
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

<body>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include('inc/sidebar.php'); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include('inc/top.php'); ?>
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-md-12">


                            <div class="row">
                                <div class="col-md-10">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">Change-password</div>
                                        <div class="panel-body">
                                            <form method="post" name="chngpwd" class="form-horizontal"
                                                onSubmit="return valid();">


                                                <?php if($error){?><div class="errorWrap">
                                                    <strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php }
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Current Password</label>
                                                    <div class="col-sm-8">
                                                        <input type="password" class="form-control" name="password"
                                                            id="password" required>
                                                    </div>
                                                </div>
                                                <div class="hr-dashed"></div>

                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">New Password</label>
                                                    <div class="col-sm-8">
                                                        <input type="password" class="form-control" name="newpassword"
                                                            id="newpassword" required>
                                                    </div>
                                                </div>
                                                <div class="hr-dashed"></div>

                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Confirm Password</label>
                                                    <div class="col-sm-8">
                                                        <input type="password" class="form-control"
                                                            name="confirmpassword" id="confirmpassword" required>
                                                    </div>
                                                </div>
                                                <div class="hr-dashed"></div>



                                                <div class="form-group">
                                                    <div class="col-sm-8 col-sm-offset-4">

                                                        <button class="btn btn-primary" name="submit" type="submit">Save
                                                            changes</button>
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

        <!-- Loading Scripts -->



</body>

</html>
<?php } ?>
