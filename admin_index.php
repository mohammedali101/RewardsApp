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
    <div class="container">
        <img src="logo.png" style="width: 500px; height: 300px;" alt="logo">
        
        <fieldset>
            <legend>Admin Options</legend>
            
                <li><a href="admin_lookup.php" class="button">Account Lookup</a></li>
                <li><a href="admin_view.php" class="button">View All Accounts</a></li>
                <li><a href="admin_addUser.php" class="button">Add a New User</a></li>
            
        </fieldset>
        
        <fieldset>
            <legend>Welcome Message</legend>
            <h2><?php echo "Welcome, " . $_SESSION["firstName"] . " " . $_SESSION["lastName"] . "";?></h2>
            <p>This is the Administrator Homepage. You can access Administrator Actions from the options above.</p>
        </fieldset>
    </div>
</body>
</html>
