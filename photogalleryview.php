<?php
include('config/config.php');

/* ================= SECURITY HEADERS ================= */
header("X-Content-Type-Options: nosniff");
header("X-Frame-Options: SAMEORIGIN");
header("X-XSS-Protection: 1; mode=block");
header("Content-Security-Policy: default-src 'self'; img-src 'self' data:; style-src 'self' 'unsafe-inline'; script-src 'self' 'unsafe-inline';");

/* ================= ERROR HANDLING ================= */
ini_set('display_errors', 0);
error_reporting(E_ALL);
ini_set('log_errors', 1);
// Update this path to a valid location on your server
ini_set('error_log', __DIR__ . '/../logs/php-error.log');

/* ================= RATE LIMITING ================= */
session_start();

function isRateLimitExceeded($limit = 30, $timeWindow = 60) {
    $ip = $_SERVER['REMOTE_ADDR'];
    $key = 'rate_limit_' . $ip;
    
    if (!isset($_SESSION[$key])) {
        $_SESSION[$key] = [];
    }
    
    // Clean old entries
    $currentTime = time();
    $_SESSION[$key] = array_filter($_SESSION[$key], function($timestamp) use ($currentTime, $timeWindow) {
        return $timestamp > ($currentTime - $timeWindow);
    });
    
    // Check limit
    if (count($_SESSION[$key]) >= $limit) {
        return true;
    }
    
    // Add current request
    $_SESSION[$key][] = $currentTime;
    return false;
}

// Apply rate limiting
if (isRateLimitExceeded(30, 60)) {
    http_response_code(429);
    die("Too many requests. Please try again after 60 seconds.");
}

/* ================= INPUT VALIDATION WITH STRONG WHITELIST ================= */
$id = filter_input(INPUT_GET, 'eventid', FILTER_VALIDATE_INT);

// Strong whitelist validation - only allow positive integers within expected range
if ($id === false || $id === null || $id < 1 || $id > 999999) {
    error_log("Invalid event ID attempted: " . ($id !== null ? $id : 'null'));
    die("Invalid Event ID");
}

/* ================= FETCH GALLERY USING PREPARED STATEMENT ================= */
$sql = "SELECT * FROM photo_gallery WHERE id = :id LIMIT 1";
$query = $dbh->prepare($sql);
$query->bindParam(':id', $id, PDO::PARAM_INT);
$query->execute();
$result = $query->fetch(PDO::FETCH_OBJ);

if (!$result) {
    error_log("Gallery not found for ID: " . $id);
    die("Gallery not found");
}

/* ================= FETCH IMAGES USING PREPARED STATEMENT ================= */
$sql1 = "SELECT * FROM gallery WHERE img_id = :img_id ORDER BY id ASC";
$query1 = $dbh->prepare($sql1);
$query1->bindParam(':img_id', $result->id, PDO::PARAM_INT);
$query1->execute();
$resultspg = $query1->fetchAll(PDO::FETCH_OBJ);

/* ================= SAFE OUTPUT VALUES ================= */
$rawTitle = ucwords(str_replace('-', ' ', $result->title));
$displayTitle = htmlspecialchars($rawTitle, ENT_QUOTES | ENT_HTML5, 'UTF-8');
$displayYear = htmlspecialchars($result->year, ENT_QUOTES | ENT_HTML5, 'UTF-8');

// IMPORTANT: Keep the original folder name as stored in database
// Don't modify the folder name - use it as-is from the database
$folderName = $result->title;
$originalFolderName = $folderName;

/* ================= VALIDATE FOLDER EXISTS - FIXED FOR UTF-8 ================= */
$baseContentPath = realpath('content');
if ($baseContentPath === false) {
    error_log("Content directory not found");
    die("Configuration error");
}

// For UTF-8 folder names (like Hindi), we need to check without realpath() modification
$fullFolderPath = "content/" . $folderName;

// Check if folder exists using file_exists (works with UTF-8)
if (!file_exists($fullFolderPath) || !is_dir($fullFolderPath)) {
    error_log("Folder not found for gallery ID: " . $id . " - Path: " . $fullFolderPath);
    die("Gallery configuration error");
}

/* ================= VALIDATE AND SANITIZE IMAGE PATHS - FIXED FOR SPACES ================= */
$validImages = [];
$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'JPG', 'JPEG', 'PNG', 'GIF', 'WEBP'];

foreach ($resultspg as $img) {
    // Get the original filename (preserve spaces)
    $filename = $img->imgs;
    
    // Check file extension against whitelist (case-insensitive)
    $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    if (!in_array($extension, $allowedExtensions)) {
        error_log("Blocked invalid file extension: " . $extension . " for gallery ID: " . $id);
        continue;
    }
    
    // Build the full path - don't modify the filename (preserve spaces)
    $imagePath = "content/" . $folderName . "/" . $filename;
    
    // URL-encode the path for HTML attributes (but not for file checking)
    $encodedImagePath = "content/" . rawurlencode($folderName) . "/" . rawurlencode($filename);
    
    // Check if file exists using original path (PHP handles UTF-8 and spaces on filesystem)
    if (file_exists($imagePath) && is_file($imagePath) && is_readable($imagePath)) {
        $validImages[] = [
            'path' => $imagePath,
            'encoded_path' => $encodedImagePath, // For HTML output
            'filename' => $filename
        ];
    } else {
        error_log("Image file not found or unreadable for gallery ID: " . $id . ", file: " . $filename);
        // Try alternative encoding methods for Hindi characters
        $alternativePath = "content/" . $folderName . "/" . urldecode($filename);
        if (file_exists($alternativePath) && is_file($alternativePath) && is_readable($alternativePath)) {
            $validImages[] = [
                'path' => $alternativePath,
                'encoded_path' => "content/" . rawurlencode($folderName) . "/" . rawurlencode($filename),
                'filename' => $filename
            ];
            error_log("Found image with alternative encoding: " . $filename);
        }
    }
}

// Check if we have any valid images
if (empty($validImages)) {
    error_log("No valid images found for gallery ID: " . $id . " in folder: " . $folderName);
    // Don't die here - just show "no images" message to user
}
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Photo Gallery | ICMR-NIIRNCD</title>
    <meta name="description" content="Photo gallery - <?php echo $displayTitle; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" href="stylenav.css">
    <link rel="stylesheet" href="./config/footer.css">
    <link rel="stylesheet" href="./config/header.css"/>
    <style>
        /* Premium Album Container */
        .premium-gallery {
            animation: fadeUp .6s ease both;
        }

        /* Album Image Card */
        .album-image {
            position: relative;
            width: 100%;
            aspect-ratio: 4 / 3;
            background-size: cover;
            background-position: center;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 12px 28px rgba(0,0,0,0.12);
            transition: all .4s ease;
        }

        /* Hover zoom */
        .album-image:hover {
            transform: translateY(-6px);
            box-shadow: 0 22px 48px rgba(0,0,0,0.25);
        }

        /* Overlay */
        .album-image .overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(
                to bottom,
                rgba(0,0,0,0.1),
                rgba(0,0,0,0.6)
            );
            opacity: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity .35s ease;
        }

        .album-image:hover .overlay {
            opacity: 1;
        }

        /* View Icon */
        .view-icon {
            font-size: 30px;
            color: #fff;
            transform: scale(0.8);
            transition: transform .3s ease;
        }

        .album-image:hover .view-icon {
            transform: scale(1);
        }

        /* Mobile optimization */
        @media (max-width: 576px) {
            .album-image {
                border-radius: 12px;
            }
        }

        /* Entrance animation */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(25px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

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
        <div class="single-slider slider-height2 d-flex align-items-center"
             data-background="assets/img/hero/contact_hero.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2><?php echo $displayTitle . ' ' . $displayYear; ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider Area End-->

    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">
            <div class="row g-3 premium-gallery">

                <?php if (!empty($validImages)): ?>
                    <?php foreach ($validImages as $image): ?>
                        <div class="col-6 col-md-4 col-lg-3">
                            <a href="<?php echo htmlspecialchars($image['encoded_path'], ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?>"
                               class="img-pop-up gallery-link"
                               data-gallery="gallery-<?php echo $id; ?>">
                                <div class="album-image"
                                     style="background-image:url('<?php echo htmlspecialchars($image['encoded_path'], ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?>')">
                                    <div class="overlay">
                                        <span class="view-icon">🔍</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12 text-center">
                        <p class="text-muted">No images found in this gallery.</p>
                        <?php if (isset($folderName)): ?>
                            <p class="text-muted small">Debug: Folder path: content/<?php echo htmlspecialchars($folderName); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
                        </main>

        <?php include('./config/footer.php'); ?>

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
    <script src="./assets/js/plugins.js"></script>
    <script src="./assets/js/main.js"></script>
    <script src="./assets/js/active.js"></script>

</body>
</html>