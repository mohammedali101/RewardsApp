<?php
session_start();
$servername = "localhost";
$db_username = "root";  
$db_password = "root";  
$dbname = "db";  

$conn = new mysqli($servername, $db_username, $db_password, $dbname);
$sql = " SELECT * FROM accounts ORDER BY ID ASC ";
$result = $conn->query($sql);
$conn->close();
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="styles.css"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Accounts</title>
</head>
<body>
    <div class="header">
    <img src="logo.png" style="width: 500px; height: 300px;" alt="logo">
        <h1>SaveBig</h1>
        <p>View Accounts</p>

    </div>
    <div class="box">
    <div class="leftcol">
        
        <h3> Admin Options</h3>
        <ul>
            <li><a href="admin_index.php"> Admin Home</a> </li>
            <li><a href="admin_lookup.php"> Account Lookup </a>  </li>
            <li><a href="admin_addUser.php"> Add a new User</a></li>
            <li><a href="admin_Delete.php"> Delete a User</a></li>
        </ul>

    </div>

    <div class="mainContent">
        <div class="viewTable">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Balance</th>

                </tr>

                <?php
                    while($rows=$result->fetch_assoc())
                    {
                ?>
                <tr>
                    <td><?php echo $rows['ID'];?></td>
                    <td><?php echo $rows['username'];?></td>
                    <td><?php echo $rows['fname'];?></td>
                    <td><?php echo $rows['lname'];?></td>
                    <td><?php echo $rows['balance'];?></td>
                </tr>
                <?php
                    }
                ?>
            </table>

        </div>

    </div>
    </div>
</body>
</html>