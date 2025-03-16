<?php
session_start();
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="styles.css"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home</title>
</head>
<body>
    <div class="header">
        <h1>SaveBig</h1>
        <p>Admin Home</p>

    </div>
    <div class="leftcol">
        
        <h3> Admin Options</h3>
        <ul>
            <li><a href="admin_lookup.php"> Account Lookup </a>  </li>
            <li><a href="admin_view.php"> View All Accounts</a> </li>
            <li><a href="admin_addUser.php"> Add a new User</a></li>
        </ul>

    </div>

    <div class="mainContent">
        <h2><?php echo "Welcome, " . $_SESSION["firstName"] . " " . $_SESSION["lastName"] . "";?></h2>
        <p>This the Administrator Homepage. You can access Administrator Actions from the links on the left.</p>

    </div>
</body>
</html>