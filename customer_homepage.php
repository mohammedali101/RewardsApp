<?php
session_start();

// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION["username"])) {
    header("Location: login_customer.php");
    exit();
}

// Handle logout
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: Welcome_page.html");
    exit();
}

// Read customer details
$username = $_SESSION["username"];
$servername = "localhost";
$db_username = "root";  
$db_password = "root";  
$dbname = "db";  

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT * FROM accounts WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user_info = null;

if ($result->num_rows > 0) {
    $user_info = $result->fetch_assoc();
}

$stmt->close();
$conn->close(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="styles.css"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <div class="header">
    <img src="logo.png" style="width: 500px; height: 300px;" alt="logo">
        <h1>SaveBig</h1>
        <p>Customer Home</p>
    </div>

    
    <?php include("customer_navigate.php"); ?>
    

    <div class="mainContent">
        <?php if ($user_info): ?>
            <h2>Welcome, <?= htmlspecialchars($user_info["fname"]) . " " . htmlspecialchars($user_info["lname"]) ?>!</h2>
            <p>Your current balance: <strong>$<?= htmlspecialchars($user_info["balance"]) ?></strong></p>
        <?php else: ?>
            <h2>Welcome!</h2>
            <p>We couldn't fetch your details. Please try again later.</p>
        <?php endif; ?>

        <p>Navigate through the menu to manage your account, check rewards that you are eligible for, 
        and view exclusive offers that are available!</p>
    
        <form action="" method="POST">
        <button type="submit" name="logout" class="logout-btn">Logout</button>
        </form>
    </div>
</body>
</html>