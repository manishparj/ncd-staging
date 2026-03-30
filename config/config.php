<?php
  $conn=mysqli_connect("database","root","icmr@#2022","web_admin");

// DB credentials.
define('DB_HOST','database');
define('DB_USER','root');
define('DB_PASS','icmr@#2022');
define('DB_NAME','web_admin');
// Establish database connection.
try
{
$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}

?>
