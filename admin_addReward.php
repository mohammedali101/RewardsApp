<?php
session_start();
if ( !( $database = mysqli_connect( "localhost:3306","root", "root" ) ) )
{
    die( "<p>Could not connect to database</p>" );
}

if ( !mysqli_select_db( $database, "db" ) )
{
    die( "<p>Could not open  database</p>" );
}
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="styles.css"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Reward</title>
</head>
<body>
    <div class="header">
        <h1>SaveBig</h1>
        <p>Add Rewards</p>

    </div>
    <div class="leftcol">
        
        <h3> Admin Options</h3>
        <ul>
            <li><a href="admin_lookup.php"> Account Lookup </a>  </li>
            <li><a href="admin_view.php"> View All Accounts</a> </li>
            <li><a href="admin_addUser.php"> Add a new User</a></li>
            <li><a href="admin_Delete.php"> Delete a User</a></li>
        </ul>

    </div>

    <div class="mainContent">
        <form action="addRewardFunction.php" method=POST>
            <div id="container">
            Reward Name <input type="text" name="rewardName" required><br><br>
            Reward Price <input type="number" name="rewardPrice" required><br><br>
            Reward Image <input type="file" name="rewardImage" required><br><br>
            </div>
        </form>

    </div>
</body>
</html>