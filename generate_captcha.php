<?php
//ini_set('session.save_path', $_SERVER['DOCUMENT_ROOT'].'/temp');
session_start();

// Generate a random CAPTCHA text
$captchaText = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz1234567890"), 0, 6); // 6 characters in the CAPTCHA

// Store the CAPTCHA text in the session for verification
$_SESSION['captcha'] = $captchaText;

// Create a blank image with a white background
$image = imagecreatetruecolor(120, 40);
$bgColor = imagecolorallocate($image, 255, 255, 255);
imagefill($image, 0, 0, $bgColor);

// Add random lines to the image
for ($i = 0; $i < 5; $i++) {
    $lineColor = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
    imageline($image, rand(0, 120), rand(0, 40), rand(0, 120), rand(0, 40), $lineColor);
}

// Add the CAPTCHA text to the image
$textColor = imagecolorallocate($image, 0, 0, 0);
imagestring($image, 5, 40, 10, $captchaText, $textColor);

// Set the content type to display the image
header('Content-type: image/png');

// Display the image
imagepng($image);

// Clean up and free memory
imagedestroy($image);
?>
