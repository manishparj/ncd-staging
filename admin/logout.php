<?php
session_start();
$_SESSION = array();

// if (ini_get("session.use_cookies")) {
// $params = session_get_cookie_params();
// setcookie(session_name(), '', time() - 60*60,
//     $params["path"], $params["domain"],
//     $params["secure"], $params["httponly"]
// );
// }

// Destroy the session
session_destroy();
setcookie("PHPSESSID", "", time() - 3600, "/");

// Clear cache headers
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Proxies

// Redirect to the desired page
header("Location: index.php"); // Replace 'index.php' with your desired page
exit;
?>
