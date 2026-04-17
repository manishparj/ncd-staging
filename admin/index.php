<?php
error_reporting(0);

/* ================= SESSION SECURITY ================= */
session_start();

// Regenerate session ID to prevent fixation
if (empty($_SESSION['initialized'])) {
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
        'secure' => false, // Set to true if using HTTPS
        'httponly' => true,
        'samesite' => 'Strict'
    ]
);

/* ================= RATE LIMITING & ACCOUNT LOCKOUT ================= */
include('inc/config.php');

// Create temp directory for rate limiting
$tempDir = __DIR__ . '/temp/';
if (!file_exists($tempDir)) {
    mkdir($tempDir, 0755, true);
}

// Function to track failed login attempts
function trackFailedAttempt($email = null) {
    $ip = $_SERVER['REMOTE_ADDR'];
    $timestamp = time();
    $window = 900; // 15 minutes window
    
    global $tempDir;
    $rateFile = $tempDir . 'attempts_' . md5($ip . ($email ?: ''));
    
    $attempts = [];
    if (file_exists($rateFile)) {
        $data = file_get_contents($rateFile);
        $attempts = unserialize($data);
        if (!is_array($attempts)) {
            $attempts = [];
        }
    }
    
    // Clean old attempts
    $attempts = array_filter($attempts, function($attempt) use ($timestamp, $window) {
        return $attempt > ($timestamp - $window);
    });
    
    // Add current attempt
    $attempts[] = $timestamp;
    file_put_contents($rateFile, serialize($attempts));
    
    return count($attempts);
}

// Function to check if account is locked
function isAccountLocked($email) {
    if (!$email) return false;
    
    global $dbh;
    
    // Check database for account lock
    $sql = "SELECT account_locked_until FROM admin WHERE UserName = :email";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_OBJ);
    
    if ($result && !empty($result->account_locked_until)) {
        $lockTime = strtotime($result->account_locked_until);
        if ($lockTime && time() < $lockTime) {
            return true;
        }
    }
    
    // Also check file-based lock as fallback
    global $tempDir;
    $lockFile = $tempDir . 'lock_' . md5($email);
    
    if (file_exists($lockFile)) {
        $lockTime = (int)file_get_contents($lockFile);
        $lockDuration = 1800; // 30 minutes lockout
        if (time() - $lockTime < $lockDuration) {
            return true;
        } else {
            @unlink($lockFile);
        }
    }
    
    return false;
}

// Function to lock account
function lockAccount($email) {
    if ($email) {
        global $dbh;
        
        // Lock in database
        $lockUntil = date('Y-m-d H:i:s', time() + 1800); // 30 minutes from now
        $sql = "UPDATE admin SET account_locked_until = :lockuntil WHERE UserName = :email";
        $query = $dbh->prepare($sql);
        $query->bindParam(':lockuntil', $lockUntil);
        $query->bindParam(':email', $email);
        $query->execute();
        
        // Also create file-based lock
        global $tempDir;
        $lockFile = $tempDir . 'lock_' . md5($email);
        file_put_contents($lockFile, time());
        
        error_log("Account locked: " . $email . " from IP: " . $_SERVER['REMOTE_ADDR']);
    }
}

// Function to reset failed attempts
function resetFailedAttempts($email = null) {
    global $dbh;
    
    $ip = $_SERVER['REMOTE_ADDR'];
    global $tempDir;
    
    $rateFile = $tempDir . 'attempts_' . md5($ip . ($email ?: ''));
    @unlink($rateFile);
    
    if ($email) {
        $lockFile = $tempDir . 'lock_' . md5($email);
        @unlink($lockFile);
        
        // Reset in database
        $sql = "UPDATE admin SET login_attempts = 0, account_locked_until = NULL WHERE UserName = :email";
        $query = $dbh->prepare($sql);
        $query->bindParam(':email', $email);
        $query->execute();
    }
}

// Function to verify password - FIXED VERSION
// Function to verify password - ENHANCED VERSION
function verifyPassword($input, $storedHash, $email) {
    // Trim any whitespace
    $input = trim($input);
    $storedHash = trim($storedHash);
    
    // Check if it's MD5 (32 characters hex)
    if (preg_match('/^[a-f0-9]{32}$/i', $storedHash)) {
        // Legacy MD5
        $inputMd5 = md5($input);
        if ($inputMd5 === $storedHash) {
            error_log("MD5 password verified for: " . $email);
            return true;
        }
        error_log("MD5 verification failed for: " . $email . " - Input MD5: " . $inputMd5 . " vs Stored: " . $storedHash);
        return false;
    } 
    // Check if it's bcrypt (starts with $2y$ or $2a$)
    elseif (strpos($storedHash, '$2y$') === 0 || strpos($storedHash, '$2a$') === 0) {
        $result = password_verify($input, $storedHash);
        error_log("Bcrypt verification for " . $email . ": " . ($result ? "SUCCESS" : "FAILED"));
        return $result;
    }
    // Plain text or other format
    else {
        error_log("Unknown hash format for " . $email . ": " . substr($storedHash, 0, 20) . "...");
        // Try direct comparison as last resort
        return ($input === $storedHash);
    }
}

/* ================= CSRF PROTECTION ================= */
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

/* ================= LOGIN PROCESSING ================= */
if (isset($_POST['login'])) {
    
    // CSRF Validation
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        error_log("CSRF attack detected from IP: " . $_SERVER['REMOTE_ADDR']);
        echo "<script>alert('Invalid request. Please try again.');</script>";
    } 
    // Check honeypot (bot detection)
    elseif (!empty($_POST['honeypot'])) {
        error_log("Bot detected from IP: " . $_SERVER['REMOTE_ADDR']);
        echo "<script>alert('Invalid request');</script>";
    }
    else {
        // CAPTCHA VALIDATION
        $userCaptcha = isset($_POST['captcha_input']) ? trim($_POST['captcha_input']) : '';
        
        if (empty($userCaptcha) || !isset($_SESSION['captcha']) ||
            strtolower($userCaptcha) !== strtolower($_SESSION['captcha'])) {
            
            error_log("CAPTCHA failed from IP: " . $_SERVER['REMOTE_ADDR']);
            echo "<script>alert('Invalid CAPTCHA. Please try again.');</script>";
            
            // Regenerate CAPTCHA after failure
            $_SESSION['captcha'] = generateCaptcha(6);
        }
        else {
            // Destroy captcha after correct validation
            unset($_SESSION['captcha']);
            
            // Rate limiting by IP
            $attemptCount = trackFailedAttempt();
            if ($attemptCount > 45) {
                sleep(3);
                if ($attemptCount > 20) {
                    header('HTTP/1.1 429 Too Many Requests');
                    die("Too many login attempts. Please try again after 15 minutes.");
                }
            }
            
            // Validate input
            $email = isset($_POST['exampleInputEmail']) ? trim($_POST['exampleInputEmail']) : '';
            $password = isset($_POST['exampleInputPassword']) ? $_POST['exampleInputPassword'] : '';
            
            // Basic validation
            if (empty($email) || empty($password)) {
                echo "<script>alert('Please enter both username and password.');</script>";
            } else {
                // Check if account is locked
                if (isAccountLocked($email)) {
                    echo "<script>alert('Account is temporarily locked due to multiple failed attempts. Please try again after 30 minutes.');</script>";
                } else {
                    // Get user from database
                    $sql = "SELECT UserName, Password, login_attempts FROM admin WHERE UserName = :email";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':email', $email, PDO::PARAM_STR);
                    $query->execute();
                    $user = $query->fetch(PDO::FETCH_OBJ);
                    
                    $passwordValid = false;
                    
                    if ($user) {
                        $passwordValid = verifyPassword($password, $user->Password, $email);
                    }
                    
                    if ($user && $passwordValid) {
                        // Check if password needs migration (MD5 to bcrypt)
                        if (preg_match('/^[a-f0-9]{32}$/i', $user->Password)) {
                            // Migrate to bcrypt
                            $newHash = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);
                            $updateSql = "UPDATE admin SET Password = :newhash WHERE UserName = :email";
                            $updateQuery = $dbh->prepare($updateSql);
                            $updateQuery->bindParam(':newhash', $newHash);
                            $updateQuery->bindParam(':email', $email);
                            $updateQuery->execute();
                        }
                        
                        // Update last_login and reset attempts (use only existing columns)
                        $updateSql = "UPDATE admin SET last_login = NOW() WHERE UserName = :email";
                        $updateQuery = $dbh->prepare($updateSql);
                        $updateQuery->bindParam(':email', $email);
                        $updateQuery->execute();
                        
                        // Reset rate limiting
                        resetFailedAttempts($email);
                        
                        // Clear any existing session data
                        $_SESSION = array();
                        
                        // Regenerate session ID on login
                        session_regenerate_id(true);
                        
                        // Set session variables
                        $_SESSION['alogin'] = $email;
                        $_SESSION['login_time'] = time();
                        $_SESSION['ip_address'] = $_SERVER['REMOTE_ADDR'];
                        $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
                        $_SESSION['authenticated'] = true;
                        
                        // Generate session token (if column exists)
                        $newSessionToken = bin2hex(random_bytes(32));
                        $_SESSION['session_token'] = $newSessionToken;
                        
                        // Try to save token to database if column exists
                        try {
                            $updateToken = "UPDATE admin SET session_token = :token WHERE UserName = :username";
                            $tokenQuery = $dbh->prepare($updateToken);
                            $tokenQuery->bindParam(':token', $newSessionToken);
                            $tokenQuery->bindParam(':username', $email);
                            $tokenQuery->execute();
                        } catch (PDOException $e) {
                            // Column doesn't exist - that's fine, continue
                            error_log("Session token column not found: " . $e->getMessage());
                        }
                        
                        // Log successful login
                        error_log("Successful login for user: " . $email . " from IP: " . $_SERVER['REMOTE_ADDR']);
                        
                        // NOW redirect
                        echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
                        exit();
                        
                    } else {
                        // Failed login - update attempt count if user exists
                        $currentAttempts = 0;
                        if ($user) {
                            $currentAttempts = intval($user->login_attempts) + 1;
                            try {
                                $updateSql = "UPDATE admin SET login_attempts = :attempts WHERE UserName = :email";
                                $updateQuery = $dbh->prepare($updateSql);
                                $updateQuery->bindParam(':attempts', $currentAttempts);
                                $updateQuery->bindParam(':email', $email);
                                $updateQuery->execute();
                            } catch (PDOException $e) {
                                // Column might not exist
                                error_log("login_attempts column not found: " . $e->getMessage());
                            }
                        } else {
                            // User doesn't exist, still track by IP
                            $currentAttempts = $attemptCount;
                        }
                        
                        $remaining = 5 - $currentAttempts;
                        
                        if ($currentAttempts >= 5) {
                            lockAccount($email);
                            echo "<script>alert('Too many failed attempts. Account locked for 30 minutes.');</script>";
                        } else {
                            echo "<script>alert('Invalid credentials. You have " . max(1, $remaining) . " attempt(s) remaining.');</script>";
                        }
                        
                        // Log failed attempt
                        error_log("Failed login attempt for user: " . $email . " from IP: " . $_SERVER['REMOTE_ADDR']);
                    }
                }
            }
        }
    }
}
function generateCaptcha($length = 6) {
    $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghjkmnpqrstuvwxyz23456789'; // no confusing chars
    $captcha = '';
    for ($i = 0; $i < $length; $i++) {
        $captcha .= $chars[random_int(0, strlen($chars) - 1)];
    }
    return $captcha;
}

if (empty($_SESSION['captcha']) || isset($_GET['refresh_captcha'])) {
    $_SESSION['captcha'] = generateCaptcha(6);
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
    
    <!-- Security Headers -->
    <meta http-equiv="X-Content-Type-Options" content="nosniff">
    <meta http-equiv="X-Frame-Options" content="DENY">
    
    <title>Login - ICMR-NIIRNCD Admin Panel</title>

    <!-- Custom fonts-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
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
                                    
                                    <form class="user" method="post" autocomplete="off">
                                        <!-- CSRF Token -->
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
                                        
                                        <!-- Honeypot field -->
                                        <div style="display: none;">
                                            <input type="text" name="honeypot" id="honeypot">
                                        </div>
                                        <div class="form-group text-center">
    <label><strong>Enter CAPTCHA</strong></label>
    <div style="font-size: 24px; letter-spacing: 3px; font-weight: bold; background: #f0f0f0; padding: 15px 25px; display: inline-block; font-family: monospace; -webkit-user-select: none; user-select: none;">
          <style>
    .pseudo‑text::before {
  content: "<?php echo $_SESSION['captcha']; ?>";
  display: inline-block;
  font-size: 24px;
  color: #333;
  padding: 20px;
  background: #f0f0f0;

  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}
  </style>
       
        <div class="pseudo‑text"></div>
    </div>
    <br><br>
    <input type="text" name="captcha_input" class="form-control form-control-user"
           placeholder="Enter CAPTCHA"
           required autocomplete="off">
    
    <br>
    <a href="?refresh_captcha=1">Refresh CAPTCHA</a>
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

    <!-- JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    
    <script>
        // Honeypot check
        document.querySelector('form').addEventListener('submit', function(e) {
            if (document.getElementById('honeypot').value.length > 0) {
                e.preventDefault();
                alert('Invalid request');
            }
        });
        
        // Client-side rate limiting
        let loginAttempts = 0;
        let lastAttemptTime = 0;
        
        document.querySelector('form').addEventListener('submit', function(e) {
            const now = Date.now();
            if (loginAttempts >= 3 && (now - lastAttemptTime) < 60000) {
                e.preventDefault();
                alert('Too many login attempts. Please wait 1 minute.');
                return false;
            }
            loginAttempts++;
            lastAttemptTime = now;
        });
    </script>
</body>
</html>