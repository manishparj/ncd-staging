<?php
include('config/config.php');
error_reporting(0);
//session_start();

if (isset($_POST['captcha']) && isset($_SESSION['captcha'])) {
    $userInput = strtolower($_POST['captcha']); // Convert user input to lowercase for case-insensitive comparison
    $captchaText = strtolower($_SESSION['captcha']); // Convert stored CAPTCHA text to lowercase

    if ($userInput === $captchaText) {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $inputFields = ['name', 'email', 'subject', 'message'];
        
            // Initialize an array to store field-specific error messages
            $fieldErrors = [];
        
            // Sanitize and validate input fields
            $allowedPattern = '/^[a-zA-Z0-9\s@.-]+$/';
        
            foreach ($inputFields as $field) {
                if (isset($_POST[$field])) {
                    $value = trim($_POST[$field]);
                    if (!empty($value) && preg_match($allowedPattern, $value)) {
                        // Data is valid, store it in the $data array
                        $data[$field] = $value;
                    } else {
                        // Data is not valid, store an error message for the field
                        $fieldErrors[$field] = "Invalid $field. (*) fields, special characters are not allowed.";
                    }
                } else {
                    // Field is missing in the POST data, store an error message
                    $fieldErrors[$field] = "$field. (*) are mandatory.";
                }
            }
        
            // Check if there are any field-specific errors
            if (empty($fieldErrors)) {
                // Your existing code for database insertion
                $sql = "INSERT INTO user_contact_list (name, email, mobile, msg) VALUES (:name, :email, :subject, :message)";
                $query = $dbh->prepare($sql);
        
                // Bind the parameters to the query
                foreach ($data as $field => $value) {
                    $query->bindParam(':' . $field, $value, PDO::PARAM_STR);
                }
        
                // Execute the query
                if ($query->execute()) {
                    $lastInsertId = $dbh->lastInsertId();
                    if ($lastInsertId !== '') {
                        echo "<div class='alert alert-success' style='text-align:center'>Form submitted successfully!</div>";
                    } else {
                        echo "<div class='alert alert-danger' style='text-align:center'>Error: Failed submission.</div>";
                    }
                } else {
                    echo "Error: Failed to execute the database query.";
                }
            } else {
                // Output individual error messages for each field
                foreach ($fieldErrors as $field => $errorMessage) {
                    echo "<div class='alert alert-danger' style='text-align:center'>$errorMessage</div>";
                }
            }
        } else {
            echo "<div class='alert alert-danger' style='text-align:center'>Error: Invalid request method.</div>";

        }

    } else {
        echo "<div class='alert alert-danger' style='text-align:center'>CAPTCHA Verification Failed. Please try again.</div>";

    }

    // Clear the CAPTCHA text from the session
    unset($_SESSION['captcha']);
} else {
    echo "<div class='alert alert-danger' style='text-align:center'>CAPTCHA Verification Failed. Please try again.</div>";
}
