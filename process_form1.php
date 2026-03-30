<?php

include('config/config.php');



// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     if ($_POST['captcha'] == $_SESSION['captcha']) {
//         // CAPTCHA is correct, process the form submission
//         // ... Your form processing code here ...
//     } else {
//         // CAPTCHA is incorrect, show an error message
//         echo "CAPTCHA verification failed. Please try again.";
//     }
// }

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if the request is a POST request
    // Retrieve form data and sanitize inputs
    $name = isset($_POST["name"]) ? trim($_POST["name"]) : '';
    $email = isset($_POST["email"]) ? trim($_POST["email"]) : '';
    $subject = isset($_POST["subject"]) ? trim($_POST["subject"]) : '';
    $message = isset($_POST["message"]) ? trim($_POST["message"]) : '';
    //echo $name.$email.$subject.$message;

    // Check if the required fields are not empty
    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
        // Prepare the SQL query to insert data into the database
        $sqlnoti = "INSERT INTO user_contact_list (name, email, mobile, msg) VALUES (:name, :email, :subject, :message)";
        $querynoti = $dbh->prepare($sqlnoti);

        // Bind the parameters to the query
        $querynoti->bindParam(':name', $name, PDO::PARAM_STR);
        $querynoti->bindParam(':email', $email, PDO::PARAM_STR);
        $querynoti->bindParam(':subject', $subject, PDO::PARAM_STR);
        $querynoti->bindParam(':message', $message, PDO::PARAM_STR);

        // Execute the query
        if ($querynoti->execute()) {
            // Get the last inserted ID
            $lastInsertId = $dbh->lastInsertId();
            if ($lastInsertId != '') {
                echo "<div class='alert alert-success' style='text-align:center'>Form submitted successfully!</div>";
            } else {
                echo "<div class='alert alert-danger' style='text-align:center'>Error: Failed submition.</div>";
            }
        } else {
            echo "Error: Failed to execute the database query.";
        }
    } else {
        echo "<div class='alert alert-danger' style='text-align:center'>Error: (*) fields are mandatory. Please try again.</div>";
    }
} else {
    echo "Error: Invalid request method.";
}
?>
