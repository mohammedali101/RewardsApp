<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve form data
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $email_address = htmlspecialchars($_POST['email_address']);
    $password = htmlspecialchars($_POST['password']);
    $confirm_password = htmlspecialchars($_POST['confirm_password']);
    $terms_accepted = isset($_POST['terms']) ? true : false;

    // Initialize validation flag
    $valid = true;
    $errorMessages = [];

    // Password validation
    if (empty($password) || empty($confirm_password)) {
        $errorMessages[] = "Password fields cannot be empty.";
        $valid = false;
    } elseif ($password !== $confirm_password) {
        $errorMessages[] = "Passwords do not match.";
        $valid = false;
    } else {
        // Password Strength Check
        if (strlen($password) < 8) {
            $errorMessages[] = "Password must be at least 8 characters long.";
            $valid = false;
        }
        if (!preg_match('/[A-Z]/', $password)) {
            $errorMessages[] = "Password must contain at least one uppercase letter.";
            $valid = false;
        }
        if (!preg_match('/[a-z]/', $password)) {
            $errorMessages[] = "Password must contain at least one lowercase letter.";
            $valid = false;
        }
        if (!preg_match('/[0-9]/', $password)) {
            $errorMessages[] = "Password must contain at least one number.";
            $valid = false;
        }
        if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
            $errorMessages[] = "Password must contain at least one special character.";
            $valid = false;
        }
    }

    // Check if terms and conditions are accepted
    if (!$terms_accepted) {
        $errorMessages[] = "You must agree to the terms and conditions.";
        $valid = false;
    }

    // If validation passes, process the data (save to the database)
    if ($valid) {
        // Connect to the database
        $database = mysqli_connect("localhost:3306", "root", "root", "db");

        if (!$database) {
            die("<p>Could not connect to database</p>");
        }

        // Hash the password before storing it
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare the SQL query to insert the new user
        $query = "INSERT INTO accounts (first_name, last_name, username, password_hash) 
                  VALUES ('$first_name', '$last_name', '$email_address', '$hashed_password')";

        // Execute query
        if ($database->query($query) === TRUE) {
            echo "<p>New record created successfully</p>";
        } else {
            echo "<p>Error: " . $database->error . "</p>";
        }

        // Close the database connection and diplay error if validation fails 
        mysqli_close($database);
    } else {
        echo "<ul>";
        foreach ($errorMessages as $message) {
            echo "<li>$message</li>";
        }
        echo "</ul>";
    }
}
?>