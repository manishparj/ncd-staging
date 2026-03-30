<?php

//session_start();
 error_reporting(0);
// setcookie('cookie_name', 'cookie_value', [
//     'expires' => time() + 3600, // Expiry time in seconds
//     'path' => '/', // Cookie path
//     'domain' => '', // Cookie domain
//     'secure' => true, // Set the 'Secure' attribute
//     'httponly' => true, // Set the 'HttpOnly' attribute
//     'samesite' => 'Strict' // Set the 'SameSite' attribute
//     ]); 
     
// Set session cookies with secure, SameSite, and HTTPOnly flags
// $session_name = session_name();
// $secure = true; // Set to true if accessing content over HTTPS
// $same_site = 'Lax'; // Set to 'Lax' or 'Strict' as required by the application


// // Get current session cookie parameters
// $params = session_get_cookie_params();

// // Set session cookie parameters
// session_set_cookie_params(
//     $params["lifetime"],
//     $params["path"],
//     $params["domain"],
//     $secure,
//     true // Set HTTPOnly flag to true
// );

// Start the session with updated settings
//session_start();

// include('inc/config.php');
// if($_SESSION['alogin']!="")
// {
//     echo'<script>window.location="dashboard.php"</script>';
// }else{
  
if (isset($_POST['login'])) {
    // $email = $_POST['exampleInputEmail'];
    // $password = $_POST['exampleInputPassword'];
    //session_start();
    session_start();  
$currentCookieParams = session_get_cookie_params();  
$sidvalue = session_id();  
setcookie(  
    'PHPSESSID',//name  
    $sidvalue,//value  
    0,//expires at end of session  
    $currentCookieParams['path'],//path  
    $currentCookieParams['domain'],//domain  
    true,
    true
   );  
   include('inc/config.php');
   $email=$_POST['exampleInputEmail'];
    $password=md5($_POST['exampleInputPassword']);
    $sql ="SELECT UserName,Password FROM admin WHERE UserName=:email and Password=:password";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':email', $email, PDO::PARAM_STR);
    $query-> bindParam(':password', $password, PDO::PARAM_STR);
    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
    {
    $_SESSION['alogin']=$email;
    echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
    } else{

    echo "<script>alert('Invalid Details');</script>";

    }


}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <script>
                        window.history.forward();
                        function preventBack() {
                            window.history.forward();
                        }
                        setTimeout("preventBack()", 0);
                        window.onunload = function () { null };
                    </script>

</head>

<body class="">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-6 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row" style="justify-content:space-around">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h3 text-gray-900 mb-4">ICMR-NIIRNCD Jodhpur</h1>
                                        <h2 class="h4 text-gray-900 mb-4">Admin-panel</h2>

                                    </div>
                                    <form class="user" method="post" autocomplete="off">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="exampleInputEmail" name="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter username...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="exampleInputPassword" name="exampleInputPassword" placeholder="Password">
                                        </div>
                                        <div class="form-group">

                                        </div>
                                        <button class="btn btn-primary btn-user btn-block" name="login" type="submit">
                                            Login
                                        </button>


                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <!-- <a class="small" href="#">Forgot Password?</a> -->
                                    </div>
                                    <div class="text-center">
                                        <!-- <a class="small" href="#">Create an Account!</a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
<?php //}?>
