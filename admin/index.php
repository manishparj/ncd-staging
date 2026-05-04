<?php
error_reporting(0);

/* ================= SESSION SECURITY ================= */
session_start();

// Regenerate session ID to prevent fixation
if (empty($_SESSION['initialized']) && $_SERVER['REQUEST_METHOD'] !== 'POST') {
    session_regenerate_id(true);
    $_SESSION['initialized'] = true;
}

// Set secure session cookie parameters
$currentCookieParams = session_get_cookie_params();
setcookie(
    'PHPSESSID',
    session_id(),
    [
        'expires' => 0,
        'path' => $currentCookieParams['path'],
        'domain' => $currentCookieParams['domain'],
        'secure' => false,
        'httponly' => true,
        'samesite' => 'Strict'
    ]
);

/* ================= RATE LIMITING & ACCOUNT LOCKOUT ================= */
include('inc/config.php');

// Function to check if account is locked
function isAccountLocked($email) {
    if (!$email) return false;
    
    global $dbh;
    
    $sql = "SELECT account_locked_until FROM admin WHERE username = :email";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_OBJ);
    
    if ($result && !empty($result->account_locked_until)) {
        $lockTime = strtotime($result->account_locked_until);
        if ($lockTime && time() < $lockTime) {
            return true;
        } else {
            // Lock expired, reset attempts
            resetFailedAttempts($email);
            return false;
        }
    }
    
    return false;
}

// Function to lock account
function lockAccount($email) {
    if ($email) {
        global $dbh;
        
        $lockUntil = date('Y-m-d H:i:s', time() + 1800);
        $sql = "UPDATE admin SET account_locked_until = :lockuntil, login_attempts = 5 WHERE username = :email";
        $query = $dbh->prepare($sql);
        $query->bindParam(':lockuntil', $lockUntil);
        $query->bindParam(':email', $email);
        $query->execute();
        
        error_log("Account locked: " . $email . " from IP: " . $_SERVER['REMOTE_ADDR']);
    }
}

// Function to reset failed attempts
function resetFailedAttempts($email) {
    global $dbh;
    
    $sql = "UPDATE admin SET login_attempts = 0, account_locked_until = NULL, last_failed_attempt = NULL WHERE username = :email";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email);
    $query->execute();
}

// Function to increment failed attempts
function incrementFailedAttempts($email) {
    global $dbh;
    
    $sql = "UPDATE admin SET login_attempts = login_attempts + 1, last_failed_attempt = NOW() WHERE username = :email";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email);
    $query->execute();
    
    // Get current attempts
    $sql2 = "SELECT login_attempts FROM admin WHERE username = :email";
    $query2 = $dbh->prepare($sql2);
    $query2->bindParam(':email', $email);
    $query2->execute();
    $result = $query2->fetch(PDO::FETCH_OBJ);
    
    return $result ? $result->login_attempts : 0;
}

// Function to get IP-based rate limiting
function checkIpRateLimit() {
    $ip = $_SERVER['REMOTE_ADDR'];
    $timestamp = time();
    $window = 900; // 15 minutes
    $maxAttempts = 20;
    
    global $dbh;
    
    // Check if login_attempts_ip table exists, if not, skip IP rate limiting
    try {
        $cleanSql = "DELETE FROM login_attempts_ip WHERE attempt_time < :cutoff";
        $cleanQuery = $dbh->prepare($cleanSql);
        $cutoff = date('Y-m-d H:i:s', $timestamp - $window);
        $cleanQuery->bindParam(':cutoff', $cutoff);
        $cleanQuery->execute();
        
        $countSql = "SELECT COUNT(*) as count FROM login_attempts_ip WHERE ip_address = :ip AND attempt_time > :cutoff";
        $countQuery = $dbh->prepare($countSql);
        $countQuery->bindParam(':ip', $ip);
        $countQuery->bindParam(':cutoff', $cutoff);
        $countQuery->execute();
        $result = $countQuery->fetch(PDO::FETCH_OBJ);
        
        return $result && $result->count > $maxAttempts;
    } catch (PDOException $e) {
        // Table might not exist, skip IP rate limiting
        return false;
    }
}

// Function to log IP attempt
function logIpAttempt() {
    global $dbh;
    
    try {
        $ip = $_SERVER['REMOTE_ADDR'];
        $sql = "INSERT INTO login_attempts_ip (ip_address, attempt_time) VALUES (:ip, NOW())";
        $query = $dbh->prepare($sql);
        $query->bindParam(':ip', $ip);
        $query->execute();
    } catch (PDOException $e) {
        // Table might not exist, silently fail
    }
}

// Function to verify password
function verifyPassword($input, $storedHash, $email) {
    $input = trim($input);
    $storedHash = trim($storedHash);
    
    // Check if it's MD5 (32 characters hex)
    if (preg_match('/^[a-f0-9]{32}$/i', $storedHash)) {
        $inputMd5 = md5($input);
        if ($inputMd5 === $storedHash) {
            error_log("MD5 password verified for: " . $email);
            return true;
        }
        error_log("MD5 verification failed for: " . $email);
        return false;
    } 
    // Check if it's bcrypt
    elseif (strpos($storedHash, '$2y$') === 0 || strpos($storedHash, '$2a$') === 0) {
        $result = password_verify($input, $storedHash);
        error_log("Bcrypt verification for " . $email . ": " . ($result ? "SUCCESS" : "FAILED"));
        return $result;
    }
    else {
        error_log("Unknown hash format for " . $email);
        return ($input === $storedHash);
    }
}

// Generate CAPTCHA function
function generateCaptcha($length = 6) {
    $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghjkmnpqrstuvwxyz23456789';
    $captcha = '';
    for ($i = 0; $i < $length; $i++) {
        $captcha .= $chars[random_int(0, strlen($chars) - 1)];
    }
    return $captcha;
}

/* ================= CSRF PROTECTION ================= */
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Generate CAPTCHA if it doesn't exist or refresh requested
if (empty($_SESSION['captcha']) || isset($_GET['refresh_captcha'])) {
    $_SESSION['captcha'] = generateCaptcha(6);
}

/* ================= LOGIN PROCESSING ================= */
$error_message = '';

// IMPORTANT: Clear any previous session data that might interfere
if (isset($_GET['clear']) && $_GET['clear'] == 1) {
    session_destroy();
    header("Location: index.php");
    exit();
}

if (isset($_POST['login'])) {
    
    // CSRF Validation
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        error_log("CSRF attack detected from IP: " . $_SERVER['REMOTE_ADDR']);
        $error_message = 'Invalid request. Please try again.';
    } 
    elseif (!empty($_POST['honeypot'])) {
        error_log("Bot detected from IP: " . $_SERVER['REMOTE_ADDR']);
        $error_message = 'Invalid request';
    }
    else {
        // CAPTCHA VALIDATION
        $userCaptcha = isset($_POST['captcha_input']) ? trim($_POST['captcha_input']) : '';
        
        if (empty($userCaptcha) || !isset($_SESSION['captcha']) ||
            strtolower($userCaptcha) !== strtolower($_SESSION['captcha'])) {
            
            error_log("CAPTCHA failed from IP: " . $_SERVER['REMOTE_ADDR']);
            $error_message = 'Invalid CAPTCHA. Please try again.';
            $_SESSION['captcha'] = generateCaptcha(6);
        }
        else {
            // Destroy captcha and generate new one
            unset($_SESSION['captcha']);
            $_SESSION['captcha'] = generateCaptcha(6);
            
            // IP-based rate limiting
            if (checkIpRateLimit()) {
                $error_message = 'Too many login attempts from your IP. Please try again after 15 minutes.';
            }
            
            if (empty($error_message)) {
                // Validate input
                $email = isset($_POST['exampleInputEmail']) ? trim($_POST['exampleInputEmail']) : '';
                $password = isset($_POST['exampleInputPassword']) ? $_POST['exampleInputPassword'] : '';
                
                if (empty($email) || empty($password)) {
                    $error_message = 'Please enter both username and password.';
                } else {
                    // Log this IP attempt
                    logIpAttempt();
                    
                    if (isAccountLocked($email)) {
                        $error_message = 'Account is temporarily locked. Please try again after 30 minutes.';
                    } else {
                        // Get user data
                        $sql = "SELECT username, password, login_attempts, is_active FROM admin WHERE username = :email";
                        $query = $dbh->prepare($sql);
                        $query->bindParam(':email', $email, PDO::PARAM_STR);
                        $query->execute();
                        $user = $query->fetch(PDO::FETCH_OBJ);
                        
                        $passwordValid = false;
                        
                        if ($user) {
                            // Check if account is active
                            if (isset($user->is_active) && $user->is_active == 0) {
                                $error_message = 'Account is disabled. Please contact administrator.';
                            } else {
                                $passwordValid = verifyPassword($password, $user->password, $email);
                            }
                        }
                        
                        if ($user && $passwordValid) {
                            // SUCCESSFUL LOGIN
                            
                            // CRITICAL FIX: Reset failed attempts BEFORE any other operations
                            resetFailedAttempts($email);
                            
                            // Check if password needs migration
                            if (preg_match('/^[a-f0-9]{32}$/i', $user->password)) {
                                $newHash = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);
                                $updateSql = "UPDATE admin SET password = :newhash WHERE username = :email";
                                $updateQuery = $dbh->prepare($updateSql);
                                $updateQuery->bindParam(':newhash', $newHash);
                                $updateQuery->bindParam(':email', $email);
                                $updateQuery->execute();
                            }
                            
                            // Update last_login
                            $updateSql = "UPDATE admin SET last_login = NOW() WHERE username = :email";
                            $updateQuery = $dbh->prepare($updateSql);
                            $updateQuery->bindParam(':email', $email);
                            $updateQuery->execute();
                            
                            // IMPORTANT: Destroy old session completely before creating new one
                            session_regenerate_id(true);
                            
                            // Clear and set fresh session variables
                            $_SESSION = array();
                            
                            $_SESSION['alogin'] = $email;
                            $_SESSION['login_time'] = time();
                            $_SESSION['ip_address'] = $_SERVER['REMOTE_ADDR'];
                            $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
                            $_SESSION['authenticated'] = true;
                            $_SESSION['session_id'] = session_id();
                            
                            // Generate session token
                            $newSessionToken = bin2hex(random_bytes(32));
                            $_SESSION['session_token'] = $newSessionToken;
                            
                            // Save token to database if column exists
                            try {
                                $checkColumn = "SHOW COLUMNS FROM admin LIKE 'session_token'";
                                $checkStmt = $dbh->prepare($checkColumn);
                                $checkStmt->execute();
                                if ($checkStmt->rowCount() > 0) {
                                    $updateToken = "UPDATE admin SET session_token = :token WHERE username = :username";
                                    $tokenQuery = $dbh->prepare($updateToken);
                                    $tokenQuery->bindParam(':token', $newSessionToken);
                                    $tokenQuery->bindParam(':username', $email);
                                    $tokenQuery->execute();
                                }
                            } catch (PDOException $e) {
                                error_log("Session token column not found: " . $e->getMessage());
                            }
                            
                            // Regenerate CSRF token for new session
                            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                            
                            error_log("Successful login for user: " . $email . " from IP: " . $_SERVER['REMOTE_ADDR']);
                            
                            echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
                            exit();
                            
                        } else {
                            // FAILED LOGIN
                            
                            if ($user) {
                                // Increment failed attempts in database
                                $currentAttempts = incrementFailedAttempts($email);
                                
                                if ($currentAttempts >= 5) {
                                    lockAccount($email);
                                    $error_message = 'Too many failed attempts. Account locked for 30 minutes.';
                                } else {
                                    $remaining = 5 - $currentAttempts;
                                    $error_message = 'Invalid credentials. You have ' . max(1, $remaining) . ' attempt(s) remaining.';
                                }
                            } else {
                                // User doesn't exist - show generic message
                                $error_message = 'Invalid credentials.';
                                error_log("Failed login attempt for non-existent user: " . $email . " from IP: " . $_SERVER['REMOTE_ADDR']);
                            }
                        }
                    }
                }
            }
        }
    }
    
    // Regenerate CSRF token after failed attempt
    if (!empty($error_message)) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
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
    
    <meta http-equiv="X-Content-Type-Options" content="nosniff">
    <meta http-equiv="X-Frame-Options" content="DENY">
    
    <title>Login - ICMR-NIIRNCD Admin Panel</title>

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    
    <style>
        .captcha-text {
            font-size: 28px;
            letter-spacing: 5px;
            font-weight: bold;
            background: #f0f0f0;
            padding: 15px 25px;
            display: inline-block;
            font-family: monospace;
            user-select: none;
            -webkit-user-select: none;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-6 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row" style="justify-content:space-around">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h3 text-gray-900 mb-4">ICMR-NIIRNCD Jodhpur</h1>
                                        <h2 class="h4 text-gray-900 mb-4">Admin-panel</h2>
                                    </div>
                                    
                                    <?php if (!empty($error_message)): ?>
                                        <div class="alert-danger">
                                            <?php echo htmlspecialchars($error_message); ?>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <form class="user" method="post" autocomplete="off">
                                        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                                        
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" 
                                                   id="exampleInputEmail" name="exampleInputEmail" 
                                                   placeholder="Enter username..."
                                                   required
                                                   autocomplete="off">
                                        </div>
                                        
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" 
                                                   id="exampleInputPassword" name="exampleInputPassword" 
                                                   placeholder="Password"
                                                   required
                                                   autocomplete="off">
                                        </div>
                                        
                                        <div style="display: none;">
                                            <input type="text" name="honeypot" id="honeypot">
                                        </div>
                                        
                                        <div class="form-group text-center">
                                            <label><strong>Enter CAPTCHA</strong></label><br>
                                            <div class="captcha-text">
                                                <?php echo htmlspecialchars($_SESSION['captcha']); ?>
                                            </div>
                                            <br><br>
                                            <input type="text" name="captcha_input" class="form-control form-control-user"
                                                   placeholder="Enter CAPTCHA"
                                                   required autocomplete="off"
                                                   style="max-width: 200px; margin: 0 auto;">
                                            <br>
                                            <a href="?refresh_captcha=1" style="font-size: 14px;">Refresh CAPTCHA</a>
                                        </div>
                                        
                                        <button class="btn btn-primary btn-user btn-block" name="login" type="submit">
                                            Login
                                        </button>
                                    </form>
                                    
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    
    <script>
        // Clear form fields and any stored state on page load
        window.addEventListener('load', function() {
            // Clear all form fields
            document.getElementById('exampleInputEmail').value = '';
            document.getElementById('exampleInputPassword').value = '';
            var captchaInput = document.querySelector('input[name="captcha_input"]');
            if (captchaInput) {
                captchaInput.value = '';
            }
            document.getElementById('honeypot').value = '';
            
            // Clear browser autofill completely
            setTimeout(function() {
                document.getElementById('exampleInputEmail').value = '';
                document.getElementById('exampleInputPassword').value = '';
            }, 100);
        });
        
        // Honeypot check
        document.querySelector('form').addEventListener('submit', function(e) {
            if (document.getElementById('honeypot').value.length > 0) {
                e.preventDefault();
                alert('Invalid request');
            }
        });
        
        // Prevent back button from showing cached page
        if (window.history && window.history.pushState) {
            window.history.pushState('forward', null, './');
            window.history.forward(1);
            window.addEventListener('popstate', function() {
                window.location.reload();
            });
        }
    </script>
</body>

</html>