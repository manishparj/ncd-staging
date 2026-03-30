<?php
include('config/config.php');
error_reporting(0);

?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Contact | ICMR-NIIRNCD </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">

    <link rel="stylesheet" href="assets/css/flaticon.css">

    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="stylenav.css">
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Validation function
            function validateForm() {
                var name = $("#name").val();
                var email = $("#email").val();
                var mobile = $("#subject").val();
                var message = $("#message").val();
                var captcha = $("#captcha").val();

                // Regular expression to validate email address
                var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

                // Regular expression to validate mobile number (10 digits)
                var mobileRegex = /^[0-9]{10}$/;

                // Check if name is empty
                if (name == "") {
                    alert("Name must be filled out");
                    return false;
                }

                // Check if email is empty and valid
                if (email == "") {
                    alert("Email must be filled out");
                    return false;
                } else if (!emailRegex.test(email)) {
                    alert("Invalid email address");
                    return false;
                }

                // Check if mobile number is empty and valid
                if (mobile == "") {
                    alert("Mobile number must be filled out");
                    return false;
                } else if (!mobileRegex.test(mobile)) {
                    alert("Invalid mobile number (10 numeric digits required)");
                    return false;
                }

                // Check if message is empty and within 250 characters limit
                if (message == "") {
                    alert("Message must be filled out");
                    return false;
                } else if (message.length > 250) {
                    alert("Message should be less than 250 characters");
                    return false;
                }

                var stg1 = document.getElementById('capt').value;
                var captcha = document.getElementById('captcha').value;

                // Check if captcha is empty
                if (captcha == "") {
                    alert("Please enter the captcha");
                    return false;
                } else if (stg1 != captcha) {
                    alert("Incorrect captcha");
                    return false;
                }

                // All validation passed
                return true;
            }

            // Event delegation for form submission
            $("#contactForm").on("submit", function(event) {
                event.preventDefault(); // Prevent the default form submission behavior

                // Call the validation function before submitting
                if (validateForm()) {
                    var form = $(this);
                    var formData = form.serialize();

                    $.ajax({
                        type: "POST",
                        url: "process_form.php", // Replace with the URL of your PHP processing script
                        data: formData,
                        success: function(response) {
                            $("#responseMessage").html(response);
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert("Error: " + errorThrown);
                        }
                    });
                }
            });
        });

        function cap() {
            var alpha = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i',
                'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '!', '@', '#', '$', '%', '^', '&', '*', '+'
            ];
            var a = alpha[Math.floor(Math.random() * 71)];
            var b = alpha[Math.floor(Math.random() * 71)];
            var c = alpha[Math.floor(Math.random() * 71)];
            var d = alpha[Math.floor(Math.random() * 71)];
            var e = alpha[Math.floor(Math.random() * 71)];
            var f = alpha[Math.floor(Math.random() * 71)];

            var final = a + b + c + d + e + f;
            document.getElementById("capt").value = final;
        }
    </script>

</head>

<body>
    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="assets/img/logo/loaderlogo.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->

    <?php include('config/header.php'); ?>
    <main>
        <!-- slider Area Start-->
        <div class="slider-area">
            <!-- Mobile Menu -->
            <div class="single-slider slider-height2 d-flex align-items-center" style="background-image:url(assets/img/hero/services_hero.jpg);">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap text-center">
                                <h2>Contact us</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- slider Area End-->
        <!-- ================ contact section start ================= -->
        <section class="contact-section">
            <div class="container">
                <div class="d-none d-sm-block mb-5 pb-4">
                    <div style="">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4255.999377738954!2d73.0276054281912!3d26.23391291055097!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39418b8f0bc41b59%3A0x452d769037ea5042!2sNational%20Institute%20for%20Implementation%20Research%20on%20Non-Communicable%20Diseases!5e0!3m2!1sen!2sin!4v1622014051415!5m2!1sen!2sin" width="100%" height="400px" style="border:0;" allowfullscreen="" loading="lazy">
                        </iframe>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h2 class="contact-title">Get in Touch</h2>
                    </div>
                    <div class="col-lg-8">
                        <?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
                        <div id="responseMessage"></div>
                        <form class="form-contact contact_form" id="contactForm" method="post" autocomplete="off">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">Message (max 250 characters):</label>
                                        <textarea class="form-control w-100" name="message" id="message" rows="4" cols="50" maxlength="250" placeholder=" Enter Message" required></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input class="form-control" name="name" id="name" type="text" placeholder='Enter your name' placeholder="Enter your name" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input class="form-control" name="email" id="email" type="email" placeholder='Enter email address' required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Mobile</label>
                                        <input class="form-control" id="subject" name="subject" type="tel" pattern="[0-9]{10}" placeholder="Enter Mobile No.">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Enter Captcha:</label>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <input type="text" class="form-control" readonly id="capt">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <input class="form-control" type="text" id="captcha" name="captcha" required>
                                            </div>
                                            <small>Captcha not visible <img src="refresh.jpg" width="40px" onclick="cap()"></small>

                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mt-3">
                                    <button type="submit" class="button button-contactForm boxed-btn">Send</button>
                                    <!-- <button name="submit" type="submit" onclick="validcap()" class="button button-contactForm boxed-btn">Send</button> -->
                                </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 offset-lg-1">
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-home"></i></span>
                        <div class="media-body">
                            <h3>Address</h3>
                            <p>New Pali Road, Jodhpur 342005, INDIA</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                        <div class="media-body">
                            <h3>Tel.: +91-291-2722403</h3>
                            <p>Mon to Fri 9am to 5:30 pm</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-email"></i></span>
                        <div class="media-body">
                            <h3>director-niirncd[at]icmr[dot]gov[dot]in</h3>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
        <!-- ================ contact section end ================= -->
    </main>
    <footer>
        <!-- Footer Start-->

        <!-- footer-bottom aera -->
        <?php include('./config/footer.php'); ?>

        <!-- Footer End-->
    </footer>

    <!-- JS here -->

    <!-- All JS Custom Plugins Link Here here -->
    <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>

    <!-- Jquery, Popper, Bootstrap -->
    <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="./assets/js/jquery.slicknav.min.js"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="./assets/js/owl.carousel.min.js"></script>
    <script src="./assets/js/slick.min.js"></script>
    <!-- Date Picker -->
    <script src="./assets/js/gijgo.min.js"></script>
    <!-- One Page, Animated-HeadLin -->
    <script src="./assets/js/wow.min.js"></script>
    <script src="./assets/js/animated.headline.js"></script>
    <script src="./assets/js/jquery.magnific-popup.js"></script>

    <!-- Scrollup, nice-select, sticky -->
    <script src="./assets/js/jquery.scrollUp.min.js"></script>
    <script src="./assets/js/jquery.nice-select.min.js"></script>
    <script src="./assets/js/jquery.sticky.js"></script>

    <!-- contact js -->
    <script src="./assets/js/contact.js"></script>
    <script src="./assets/js/jquery.form.js"></script>
    <script src="./assets/js/jquery.validate.min.js"></script>
    <script src="./assets/js/mail-script.js"></script>
    <script src="./assets/js/jquery.ajaxchimp.min.js"></script>

    <!-- Jquery Plugins, main Jquery -->
    <script src="./assets/js/main.js"></script>
    <script src="./assets/js/jquery-2.2.4.min.js"></script>
    <script src="./assets/js/plugins.js"></script>
    <script src="./assets/js/active.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            setTimeout(function() {
                $('.succWrap').slideUp("slow");
            }, 3000);
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#btn1').click(function() {
                $("#bg").css("fontSize", "18px");
                $(".media-body").css("fontSize", "18px");
            });

            $('#btn2').click(function() {
                $("#bg").css("fontSize", "16px");
                $(".media-body").css("fontSize", "16px");
            });

            $('#btn3').click(function() {
                $("#bg").css("fontSize", "13px");
                $(".media-body").css("fontSize", "13px");
            });
        });
    </script>

</body>

</html>