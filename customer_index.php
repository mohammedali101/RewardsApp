<?php
session_start();
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="styles.css"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Home</title>
</head>
<body>
    <div class="header">
        <img src="logo.png" style="width: 500px; height: 300px;" alt="logo">
        <h1>SaveBig</h1>
        <p>Customer Home</p>

    </div>
        <!-- Include the navigation menu for customers -->
        <?php include("customer_navigate.php"); ?>
        <!-- 
    <div class="leftcol">
        <h3>Options</h3>
        <ul>
            <li><a href="customer_homepage.php">Customer Homepage</a></li>
            <li><a href="available_rewards.php">Available Rewards</a></li>
            <li><a href="view_offers.php">View Offers</a></li>
        </ul>
    </div> -->

    <div class="mainContent">
        <h2><?php echo "Welcome, " . $_SESSION["firstName"] . " " . $_SESSION["lastName"] . "";?></h2>
        <p>Navigate through the menu to manage your account, check rewards that you are eligible for, 
        and view exclusive offers that are available!</p>

    </div>
</body>
</html>