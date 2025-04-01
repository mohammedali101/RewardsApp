<?php
session_start();
$servername = "localhost";
$db_username = "root";  // Change to your DB username
$db_password = "password";  // Change to your DB password
$dbname = "db";  // Change to your database name

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if user is logged in, if not take back to login page
if (!isset($_SESSION["username"])) {
    header("Location: login_customer.php");
    exit();
}

// Fetch customer details
$username = $_SESSION["username"];
$user_info = null;

$stmt = $conn->prepare("SELECT * FROM accounts WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

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
        <h1>SaveBig</h1>
        <p>Customer Home</p>
    </div>

    <div class="leftcol">
        <h3>Options</h3>
        <ul>
            <li><a href="customer_homepage.php">Homepage</a></li>
            <li><a href="available_rewards.php">Available Rewards</a></li>
            <li><a href="view_offers.php">View Offers</a></li>
            <li><a href="customer_profile.php">My Profile</a></li>
        </ul>
    </div>

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
    </div>
</body>
</html>
