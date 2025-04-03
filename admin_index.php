<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home</title>
    <link rel="stylesheet" type="text/css" href="styles.css"/>
</head>

<body>
<div class= header>
    <img src="logo.png" style="width: 500px; height: 150px;" alt="logo">
    <h1>SaveBig</h1>
    <p>Admin Index</p>
    </div>
    
        <div class="leftcol">
        
        
            <h3> Admin Options</h3>
            <ul>
                <li><a href="admin_lookup.php"> Account Lookup </a>  </li>
                <li><a href="admin_view.php"> View All Accounts</a> </li>
                <li><a href="admin_addUser.php"> Add a new User</a></li>
                <li><a href="admin_Delete.php"> Delete a User</a></li>
                <li><a href="admin_addReward.php"> Add a Reward</a></li>
                <li><a href="admin_viewRewards.php"> View Rewards</a></li>
            </ul>

        </div>

        <div class="mainContent">
            <h2><?php echo "Welcome, " . $_SESSION["firstName"] . " " . $_SESSION["lastName"] . "";?></h2>
            <p>Welcome to SaveBig! Provide great rewards for your loyal customers and keep your business thriving!</p>
            <p>As an Administrator, you can perform actions such as Viewing all Accounts, Lookup and Adjusting Points of a User, and more.</p>
            <p>This the Administrator Homepage. You can access Administrator Actions from the links on the left.</p>
        </div>
    
</body>
</html>
