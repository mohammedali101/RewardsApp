<?php
// Start the session
session_start();

$email = $_POST["email"];
$password = $_POST["password"];

// Connect to the database
if (!( $database = mysqli_connect("localhost:3306", "root", "root") )) {
    die("<p>Could not connect to the database</p>");
}

if (!mysqli_select_db($database, "db")) {
    die("<p>Could not open the database</p>");
}

// Check if the field has been filled out by user or is empty
if (!empty($email) && !empty($password)) {
    // Use a prepared statement to avoid SQL injection
    $stmt = $database->prepare("SELECT * FROM accounts WHERE username = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check passwords
    if ($result && mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);

        if (password_verify($password, $user_data['password_hash'])) { // verify passwords
            // If password matches, store the ID in the session
            $_SESSION['user_id'] = $user_data['ID'];
            header("Location: index_test.html");
            exit;
        } else {
            header("Location: login_admin.html?error=Incorrect password");
            exit;
        }
    } else {
        header("Location: login_admin.html?error=Admin not found");
        exit;
    }

} else {
    header("Location: login_admin.html?error=Enter a valid username and password");
    exit;
}
?>
