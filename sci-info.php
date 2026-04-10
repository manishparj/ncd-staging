<?php
// Before including config
try {
    include('config/config.php');
} catch (Exception $e) {
    error_log("Config loading failed: " . $e->getMessage());
    showGenericError();
    exit();
}

/* ================= RATE LIMITING FOR ERROR REQUESTS ================= */
// Start session for rate limiting tracking if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Rate limiting configuration
define('ERROR_RATE_LIMIT_WINDOW', 900); // 15 minutes in seconds
define('ERROR_RATE_LIMIT_MAX_ATTEMPTS', 10); // Max 10 error page requests per window
define('ERROR_RATE_LIMIT_BLOCK_DURATION', 3600); // Block for 1 hour after exceeding

// Create rate limit tracking directory
$rateLimitDir = __DIR__ . '/logs/ratelimit/';
if (!is_dir($rateLimitDir)) {
    @mkdir($rateLimitDir, 0755, true);
}

// Function to get client identifier (IP + optional user agent fingerprint)
function getClientIdentifier() {
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    // Add user agent fingerprint to prevent session hijacking
    $ua = $_SERVER['HTTP_USER_AGENT'] ?? '';
    $fingerprint = md5($ip . $ua);
    return $fingerprint;
}

// Function to check if client is blocked due to excessive errors
function isClientBlocked() {
    $clientId = getClientIdentifier();
    $blockFile = __DIR__ . '/logs/ratelimit/blocked_' . $clientId . '.lock';
    
    if (file_exists($blockFile)) {
        $blockTime = (int)@file_get_contents($blockFile);
        if (time() - $blockTime < ERROR_RATE_LIMIT_BLOCK_DURATION) {
            return true;
        } else {
            @unlink($blockFile);
        }
    }
    return false;
}

// Function to block a client
function blockClient() {
    $clientId = getClientIdentifier();
    $blockFile = __DIR__ . '/logs/ratelimit/blocked_' . $clientId . '.lock';
    @file_put_contents($blockFile, time());
    
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    error_log("Client blocked due to excessive error requests: " . $ip);
}

// Function to track error page requests
function trackErrorRequest() {
    $clientId = getClientIdentifier();
    $timestamp = time();
    $trackFile = __DIR__ . '/logs/ratelimit/errors_' . $clientId . '.log';
    
    $attempts = [];
    if (file_exists($trackFile)) {
        $data = @file_get_contents($trackFile);
        if ($data !== false) {
            $attempts = unserialize($data);
            if (!is_array($attempts)) {
                $attempts = [];
            }
        }
    }
    
    // Clean old attempts outside the window
    $attempts = array_filter($attempts, function($attemptTime) use ($timestamp) {
        return $attemptTime > ($timestamp - ERROR_RATE_LIMIT_WINDOW);
    });
    
    // Add current attempt
    $attempts[] = $timestamp;
    @file_put_contents($trackFile, serialize($attempts));
    
    $attemptCount = count($attempts);
    
    // Progressive delay for repeated errors (defense in depth)
    if ($attemptCount >= 5) {
        $delay = min(($attemptCount - 4) * 2, 10); // 2,4,6,8,10 seconds max
        sleep($delay);
    }
    
    // If exceeded limit, block the client
    if ($attemptCount > ERROR_RATE_LIMIT_MAX_ATTEMPTS) {
        blockClient();
        return false;
    }
    
    return $attemptCount;
}

// Function to reset error tracking on successful page load
function resetErrorTracking() {
    $clientId = getClientIdentifier();
    $trackFile = __DIR__ . '/logs/ratelimit/errors_' . $clientId . '.log';
    if (file_exists($trackFile)) {
        @unlink($trackFile);
    }
}

// Function to get remaining allowed attempts
function getRemainingErrorAttempts() {
    $clientId = getClientIdentifier();
    $trackFile = __DIR__ . '/logs/ratelimit/errors_' . $clientId . '.log';
    $timestamp = time();
    
    $attempts = [];
    if (file_exists($trackFile)) {
        $data = @file_get_contents($trackFile);
        if ($data !== false) {
            $attempts = unserialize($data);
            if (!is_array($attempts)) {
                $attempts = [];
            }
        }
    }
    
    $validAttempts = array_filter($attempts, function($attemptTime) use ($timestamp) {
        return $attemptTime > ($timestamp - ERROR_RATE_LIMIT_WINDOW);
    });
    
    $used = count($validAttempts);
    return max(0, ERROR_RATE_LIMIT_MAX_ATTEMPTS - $used);
}

// Check if client is blocked before processing anything
if (isClientBlocked()) {
    showRateLimitError();
    exit();
}

/* ================= SECURITY HEADERS ================= */
header("X-Content-Type-Options: nosniff");
header("X-Frame-Options: SAMEORIGIN");
header("X-XSS-Protection: 1; mode=block");
header("Content-Security-Policy: default-src 'self'; img-src 'self' data:; style-src 'self' 'unsafe-inline'; script-src 'self';");

/* ================= ERROR HANDLING - SECURE MODE ================= */
// Turn off all error reporting for production
error_reporting(0);
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/logs/php_errors.log');

// Create logs directory if not exists
$logDir = __DIR__ . '/logs';
if (!is_dir($logDir)) {
    @mkdir($logDir, 0755, true);
}

// Custom error handler with rate limiting
set_error_handler(function($errno, $errstr, $errfile, $errline) {
    // Track this error request
    $attemptCount = trackErrorRequest();
    
    if ($attemptCount === false) {
        // Client is now blocked
        showRateLimitError();
        exit();
    }
    
    // Log the error internally but never display to user (remove path info)
    $relativeFile = basename($errfile);
    $logMessage = sprintf("[%s] Error [%d] in %s on line %d", 
        date('Y-m-d H:i:s'), $errno, $relativeFile, $errline);
    error_log($logMessage);
    
    // Return true to prevent default PHP error handler
    return true;
});

// Custom exception handler with rate limiting
set_exception_handler(function($exception) {
    $attemptCount = trackErrorRequest();
    
    if ($attemptCount === false) {
        showRateLimitError();
        exit();
    }
    
    // Log minimal exception details - no stack trace, no file paths
    $logMessage = sprintf("[%s] Uncaught Exception: %s",
        date('Y-m-d H:i:s'),
        get_class($exception)
    );
    error_log($logMessage);
    
    // Show generic error message to user
    showGenericError();
    exit();
});

// Handle fatal errors with rate limiting
register_shutdown_function(function() {
    $error = error_get_last();
    if ($error !== null && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) {
        $attemptCount = trackErrorRequest();
        
        // Log minimal info - only error type and line number
        error_log(sprintf("[%s] Fatal Error type: %d in file: %s line: %d", 
            date('Y-m-d H:i:s'), 
            $error['type'], 
            basename($error['file']), 
            $error['line']
        ));
        
        showGenericError();
    }
});

// Function to show generic error message without revealing details
function showGenericError($customMessage = null) {
    if (!headers_sent()) {
        http_response_code(500);
    }
    
    // Display a user-friendly, non-informative error message
    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="robots" content="noindex, nofollow">
        <title>Service Unavailable</title>
        <style>
            body { font-family: Arial, sans-serif; text-align: center; padding: 50px; background: #f5f5f5; }
            .error-container { max-width: 500px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
            h1 { color: #333; }
            p { color: #666; }
        </style>
    </head>
    <body>
        <div class="error-container">
            <h1>Something went wrong</h1>
            <p>We are unable to process your request at this time. Please try again later.</p>
            <p><a href="javascript:history.back()">Go Back</a></p>
        </div>
    </body>
    </html>';
    exit();
}

// Rate limit exceeded error function
function showRateLimitError() {
    if (!headers_sent()) {
        http_response_code(429);
        header('Retry-After: 3600');
    }
    
    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="robots" content="noindex, nofollow">
        <title>Too Many Requests</title>
        <style>
            body {
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Arial, sans-serif;
                text-align: center;
                padding: 50px 20px;
                background: #f5f5f5;
                margin: 0;
            }
            .error-container {
                max-width: 500px;
                margin: 0 auto;
                background: #ffffff;
                padding: 40px 30px;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            }
            h1 {
                color: #d9534f;
                font-size: 24px;
                margin-bottom: 15px;
                font-weight: 500;
            }
            p {
                color: #888;
                line-height: 1.5;
                margin-bottom: 20px;
            }
            .back-link {
                display: inline-block;
                color: #4a90e2;
                text-decoration: none;
                padding: 8px 16px;
                border-radius: 4px;
                transition: background 0.2s;
            }
            .back-link:hover {
                background: #f0f0f0;
            }
        </style>
    </head>
    <body>
        <div class="error-container">
            <h1>429 Too Many Requests</h1>
            <p>You have made too many requests. Please wait for 1 hour before trying again.</p>
            <a href="javascript:history.back()" class="back-link">← Go Back</a>
        </div>
    </body>
    </html>';
    exit();
}

// Function for database error handling
function handleDatabaseError($errorInfo, $query = null) {
    // Track this error
    trackErrorRequest();
    
    // Log the actual error (without sensitive query details)
    error_log(sprintf("[Database Error] Code: %s", 
        print_r($errorInfo, true)
    ));
    
    // Show generic error
    showGenericError();
    return false;
}

/* ================= INPUT VALIDATION - STRONG WHITELIST ================= */

// Validate emp_id - must be positive integer with proper error handling
$id = null;
if (isset($_POST['emp_id']) || isset($_GET['emp_id'])) {
    $inputId = $_POST['emp_id'] ?? $_GET['emp_id'] ?? null;
    $id = filter_var($inputId, FILTER_VALIDATE_INT);
    
    if ($id === false || $id === null || $id < 1) {
        // Log the invalid attempt without revealing to user
        error_log("Invalid emp_id received from IP: " . ($_SERVER['REMOTE_ADDR'] ?? 'unknown'));
        trackErrorRequest();
        showGenericError();
        exit();
    }
} else {
    trackErrorRequest();
    showGenericError();
    exit();
}

// Validate name - only allow letters, numbers, spaces, hyphens, and dots
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
if (!empty($name)) {
    // Strict whitelist for name - only alphanumeric, spaces, hyphens, dots, and underscores
    if (!preg_match('/^[a-zA-Z0-9\s\-\._]+$/u', $name)) {
        error_log("Invalid name parameter received from IP: " . ($_SERVER['REMOTE_ADDR'] ?? 'unknown'));
        trackErrorRequest();
        showGenericError();
        exit();
    }
    // Limit length
    if (strlen($name) > 100) {
        $name = substr($name, 0, 100);
    }
}

/* ================= HELPER FUNCTIONS ================= */

// Function for safe HTML output
function safe($input, $encoding = ENT_QUOTES | ENT_HTML5) {
    return htmlspecialchars($input ?? '', $encoding, 'UTF-8');
}

// Function for safe output in HTML attributes
function safeAttr($input) {
    return htmlspecialchars($input ?? '', ENT_QUOTES, 'UTF-8');
}

// Function to sanitize and validate text content (for pre tags)
function sanitizeTextContent($input) {
    if (empty($input)) return '';
    return htmlspecialchars($input, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

// Function to validate email (if displayed)
function validateAndSanitizeEmail($email) {
    if (empty($email)) return '';
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return $email;
    }
    return '';
}

// Function to validate URL
function validateAndSanitizeUrl($url) {
    if (empty($url)) return '';
    $url = filter_var($url, FILTER_SANITIZE_URL);
    if (filter_var($url, FILTER_VALIDATE_URL)) {
        return $url;
    }
    return '';
}

// Safe database query wrapper with error handling
function safeQuery($dbh, $sql, $params = []) {
    try {
        $query = $dbh->prepare($sql);
        foreach ($params as $key => $value) {
            $query->bindValue($key, $value);
        }
        $query->execute();
        return $query;
    } catch (PDOException $e) {
        error_log("Database query failed");
        trackErrorRequest();
        showGenericError();
        exit();
    }
}

/* ================= FETCH EMPLOYEE DATA USING PREPARED STATEMENT ================= */
try {
    $sql = "SELECT * FROM emp_details WHERE emp_id = :id LIMIT 1";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    
    if (empty($results)) {
        // Log but show generic message
        error_log("Employee not found for ID: " . $id);
        trackErrorRequest();
        showGenericError();
        exit();
    }
} catch (PDOException $e) {
    error_log("Employee fetch error occurred");
    trackErrorRequest();
    showGenericError();
    exit();
}

/* ================= FETCH PROFILE DATA ================= */
$profileData = null;
try {
    $sql9 = "SELECT * FROM emp_profile WHERE emp_id = :emp_id LIMIT 1";
    $query9 = $dbh->prepare($sql9);
    $query9->bindParam(':emp_id', $id, PDO::PARAM_INT);
    $query9->execute();
    $profileResults = $query9->fetchAll(PDO::FETCH_OBJ);
    if (!empty($profileResults)) {
        $profileData = $profileResults[0];
    }
} catch (PDOException $e) {
    // Non-critical - log but continue
    error_log("Profile fetch warning occurred");
    $profileData = null;
}

// Reset error tracking on successful page load
resetErrorTracking();
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; img-src 'self' data:; style-src 'self' 'unsafe-inline'; script-src 'self' 'unsafe-inline' 'unsafe-eval';">
    <title>Scientist | ICMR-NIIRNCD</title>
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
    <link rel="stylesheet" href="./sci-info.css">
    <link rel="stylesheet" href="./config/footer.css">
    <link rel="stylesheet" href="assets/datatables/dataTables.bootstrap4.css">
</head>

<body id="bg">

    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="assets/img/logo/loaderlogo.jpg" alt="Loading...">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->

    <?php include('config/header.php'); ?>

    <main>
        <!-- slider Area Start-->
        <div class="slider-area">
            <div class="single-slider slider-height2 d-flex align-items-center" style="background-image:url(assets/img/hero/services_hero.jpg);">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap text-center">
                                <h2>Scientists</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- slider Area End-->

        <section>
            <div class="container mt-5">
                <?php foreach ($results as $result) { 
                    // Safely extract and validate all fields with null coalescing
                    $empName = safe($result->emp_name ?? '');
                    $empDesignation = safe(strtoupper($result->emp_desig ?? ''));
                    $researchInterest = safe($result->research_interest ?? '');
                    $googleScholar = validateAndSanitizeUrl($result->googlescholar ?? '');
                    $empEmail = validateAndSanitizeEmail($result->emp_email ?? '');
                    $empContact = safe($result->emp_contact ?? '');
                    $empImage1 = isset($result->emp_image) ? basename($result->emp_image) : '';
                    $empImage = preg_replace('/[^a-zA-Z0-9._-]/', '', $empImage1);
                    
                    // Validate image path to prevent directory traversal
                    $imagePath = "admin/img/our_team/";
                    if (!empty($name) && !empty($empImage)) {
                        $safeFolder = preg_replace('/[^a-zA-Z0-9\-_]/', '', $name);
                        $fullImagePath = $imagePath . $safeFolder . "/" . $empImage;
                        // Additional validation to ensure path is safe
                        $fullImagePath = str_replace(['..', './'], '', $fullImagePath);
                    } else {
                        $fullImagePath = "assets/img/default-avatar.png";
                    }
                ?>
                
                <!-- LEFT: IMAGE TILE -->
                <div class="row mb-4">
                    <div class="col-lg-3">
                        <div class="profile-card profile-image p-2">
                            <img src="<?php echo safeAttr($fullImagePath); ?>" 
                                 class="img-fluid" 
                                 alt="Photo of <?php echo $empName; ?>"
                                 onerror="this.src='assets/img/default-avatar.png'">
                        </div>
                    </div>

                    <!-- RIGHT: DETAILS TILE -->
                    <div class="col-lg-9">
                        <div class="profile-card p-4 profile-details">
                            <h3><?php echo $empName; ?></h3>

                            <div class="info-line">
                                <i class="fa fa-user"></i>
                                <span><strong>Designation:</strong> <?php echo $empDesignation; ?></span>
                            </div>

                            <?php if (!empty($researchInterest) && $researchInterest !== '') { ?>
                            <div class="info-line">
                                <i class="fa fa-flask"></i>
                                <span><strong>Research Interest:</strong> <?php echo $researchInterest; ?></span>
                            </div>
                            <?php } ?>

                            <?php if (!empty($googleScholar)) { ?>
                            <div class="info-line">
                                <i class="fa fa-graduation-cap"></i>
                                <span>
                                    <a href="<?php echo safeAttr($googleScholar); ?>" 
                                       target="_blank" 
                                       rel="noopener noreferrer">
                                        Google Scholar Profile <i class="fa fa-external-link"></i>
                                    </a>
                                </span>
                            </div>
                            <?php } ?>

                            <?php if (!empty($empEmail)) { ?>
                            <div class="info-line">
                                <i class="fa fa-envelope"></i>
                                <span><strong>Email:</strong> 
                                    <a href="mailto:<?php echo safeAttr($empEmail); ?>">
                                        <?php echo $empEmail; ?>
                                    </a>
                                </span>
                            </div>
                            <?php } ?>

                            <?php if (!empty($empContact)) { ?>
                            <div class="info-line">
                                <i class="fa fa-phone"></i>
                                <span><strong>Tel:</strong> <?php echo $empContact; ?></span>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <!-- BRIEF INTRO -->
                <?php if ($profileData && !empty($profileData->brief_intro)) { 
                    $briefIntro = sanitizeTextContent($profileData->brief_intro);
                ?>
                <div class="row mt-5">
                    <div class="col-lg-12 profile-card p-4">
                        <h2><i class="fa fa-user"></i>&nbsp;Brief Introduction</h2>
                        <div class="line"></div>
                        <div class="card-text">
                            <?php echo nl2br(sanitizeTextContent($profileData->brief_intro ?? '')); ?>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <!-- ACADEMIC QUALIFICATIONS -->
                <?php if ($profileData && !empty($profileData->academic)) { ?>
                <div class="row mt-5">
                    <div class="col-lg-12 profile-card p-4">
                        <h2><i class="fa fa-graduation-cap"></i>&nbsp;Academic Qualifications & Training</h2>
                        <div class="line"></div>
                        <pre class="sanitized-content"><?php echo nl2br(sanitizeTextContent($profileData->academic ?? '')); ?></pre>
                    </div>
                </div>
                <?php } ?>

                <!-- PUBLICATIONS -->
                <?php if ($profileData && !empty($profileData->publication)) { ?>
                <div class="row mt-5">
                    <div class="col-lg-12 profile-card p-4">
                        <h2><i class="fa fa-book"></i>&nbsp;Publications</h2>
                        <div class="line"></div>
                        <pre class="sanitized-content"><?php echo nl2br(sanitizeTextContent($profileData->publication ?? '')); ?></pre>
                    </div>
                </div>
                <?php } ?>

                <!-- COMPLETED PROJECTS -->
                <?php if ($profileData && !empty($profileData->comp_project)) { ?>
                <div class="row mt-5">
                    <div class="col-lg-12 profile-card p-4">
                        <h2><i class="fa fa-paper-plane"></i>&nbsp;Completed Projects</h2>
                        <div class="line"></div>
                        <pre class="sanitized-content"><?php echo nl2br(sanitizeTextContent($profileData->comp_project ?? '')); ?></pre>
                    </div>
                </div>
                <?php } ?>

                <!-- ONGOING PROJECTS -->
                <?php if ($profileData && !empty($profileData->ong_project)) { ?>
                <div class="row mt-5">
                    <div class="col-lg-12 profile-card p-4">
                        <h2><i class="fa fa-spinner"></i>&nbsp;Ongoing Projects</h2>
                        <div class="line"></div>
                        <pre class="sanitized-content"><?php echo nl2br(sanitizeTextContent($profileData->ong_project ?? '')); ?></pre>
                    </div>
                </div>
                <?php } ?>

                <?php } ?>
            </div>
        </section>
    </main>

    <footer>
        <?php include('./config/footer.php'); ?>
    </footer>

    <!-- JS here -->
    <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/jquery.slicknav.min.js"></script>
    <script src="./assets/js/owl.carousel.min.js"></script>
    <script src="./assets/js/slick.min.js"></script>
    <script src="./assets/js/wow.min.js"></script>
    <script src="./assets/js/animated.headline.js"></script>
    <script src="./assets/js/jquery.magnific-popup.js"></script>
    <script src="./assets/js/jquery.scrollUp.min.js"></script>
    <script src="./assets/js/jquery.nice-select.min.js"></script>
    <script src="./assets/js/jquery.sticky.js"></script>
    <script src="./assets/js/contact.js"></script>
    <script src="./assets/js/jquery.form.js"></script>
    <script src="./assets/js/jquery.validate.min.js"></script>
    <script src="./assets/js/mail-script.js"></script>
    <script src="./assets/js/jquery.ajaxchimp.min.js"></script>
    <script src="./assets/js/jquery-2.2.4.min.js"></script>
    <script src="./assets/js/plugins.js"></script>
    <script src="./assets/js/main.js"></script>
    <script src="./assets/js/active.js"></script>
    <script src="./assets/js/datatables-demo.js"></script>
    <script src="./assets/datatables/jquery.dataTables.min.js"></script>
    <script src="./assets/datatables/dataTables.bootstrap4.min.js"></script>
    
    <style>
        .sanitized-content {
            white-space: pre-wrap;
            word-wrap: break-word;
            font-family: inherit;
            background: transparent;
            border: none;
            padding: 0;
        }
        .profile-card {
            transition: all 0.3s ease;
        }
        .info-line {
            margin-bottom: 10px;
            padding: 5px 0;
        }
        .info-line i {
            width: 25px;
            color: #007bff;
        }
        .line {
            height: 2px;
            background: #007bff;
            width: 50px;
            margin: 10px 0 20px;
        }
    </style>

    <script>
        $(document).ready(function() {
            $('#btn1').click(function() {
                $("#bg").css("fontSize", "18px");
                $(".card-text").css("fontSize", "18px");
                $(".sanitized-content").css("fontSize", "18px");
            });

            $('#btn2').click(function() {
                $("#bg").css("fontSize", "16px");
                $(".card-text").css("fontSize", "16px");
                $(".sanitized-content").css("fontSize", "16px");
            });

            $('#btn3').click(function() {
                $("#bg").css("fontSize", "13px");
                $(".card-text").css("fontSize", "13px");
                $(".sanitized-content").css("fontSize", "13px");
            });
        });
    </script>
</body>
</html>