<?php
// fix_password.php - Run this to reset password to MD5 (working version)
include('inc/config.php');

echo "<h2>Password Fix Tool</h2>";

// Reset to MD5 (the working version)
$md5Password = md5('admin123');

// Check current password
$sql = "SELECT UserName, Password FROM admin WHERE UserName = 'admin'";
$query = $dbh->prepare($sql);
$query->execute();
$user = $query->fetch(PDO::FETCH_OBJ);

if ($user) {
    echo "<p>Current password hash: " . $user->Password . "</p>";
    echo "<p>Hash length: " . strlen($user->Password) . " characters</p>";
    
    if (strlen($user->Password) == 32) {
        echo "<p style='color:green'>✓ Already using MD5</p>";
    } else {
        echo "<p style='color:orange'>⚠ Using bcrypt hash - resetting to MD5 for compatibility</p>";
    }
    
    // Reset to MD5
    $updateSql = "UPDATE admin SET Password = :password, login_attempts = 0, account_locked_until = NULL WHERE UserName = 'admin'";
    $updateQuery = $dbh->prepare($updateSql);
    $updateQuery->bindParam(':password', $md5Password);
    
    if ($updateQuery->execute()) {
        echo "<p style='color:green'>✓ Password reset to MD5 hash</p>";
        echo "<p>MD5 of 'admin123': <code>" . $md5Password . "</code></p>";
    } else {
        echo "<p style='color:red'>✗ Failed to update password</p>";
    }
} else {
    // Create admin user
    $insertSql = "INSERT INTO admin (UserName, Password, login_attempts) VALUES ('admin', :password, 0)";
    $insertQuery = $dbh->prepare($insertSql);
    $insertQuery->bindParam(':password', $md5Password);
    
    if ($insertQuery->execute()) {
        echo "<p style='color:green'>✓ Admin user created with MD5 password</p>";
    }
}

// Clear rate limiting
$tempDir = __DIR__ . '/temp/';
if (file_exists($tempDir)) {
    $files = glob($tempDir . '*');
    foreach ($files as $file) {
        if (is_file($file)) {
            unlink($file);
        }
    }
    echo "<p style='color:green'>✓ Rate limiting cleared</p>";
}

// Clear session
session_start();
session_destroy();

echo "<p style='color:green; font-size:18px;'>✓ Fix complete!</p>";
echo "<p><strong>Login credentials:</strong></p>";
echo "<ul>";
echo "<li>Username: <code>admin</code></li>";
echo "<li>Password: <code>admin123</code></li>";
echo "</ul>";
echo "<p><a href='login.php' style='font-size:18px;'>→ Click here to login</a></p>";
?>