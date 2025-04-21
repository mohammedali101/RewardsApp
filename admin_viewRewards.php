<?php
session_start();
$servername = "localhost";
$db_username = "root";  
$db_password = "root";  
$dbname = "db";  

$conn = new mysqli($servername, $db_username, $db_password, $dbname);
$sql = " SELECT * FROM rewards ORDER BY ID ASC ";
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
    <title>View Rewards</title>
</head>
<body>
    <div class="header">
    <img src="logo.png" style="width: 500px; height: 300px;" alt="logo">
        <h1>SaveBig</h1>
        <p>View Rewards</p>

    </div>
    <div class="box">
    <!-- Navigate -->
    <?php include("admin_navigate.php"); ?> 
<!-- 
    <div class="leftcol">
        
        <h3> Admin Options</h3>
        <ul>
            <li><a href="admin_index.php"> Account Home </a>  </li>
            <li><a href="admin_lookup.php"> Lookup </a>  </li>
            <li><a href="admin_view.php"> View All Accounts</a> </li>
            <li><a href="admin_addUser.php"> Add a new User</a></li>
            <li><a href="admin_addReward.php"> Add a Reward</a></li>
            <li><a href="admin_viewRewards.php"> View Rewards</a></li>
        </ul>

    </div> -->

    <div class="mainContent">
        <div class="viewTable">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Image</th>

                </tr>

                <?php
                    while($rows=$result->fetch_assoc())
                    {
                ?>
                <tr>
                    <td><?php echo $rows['ID'];?></td>
                    <td><?php echo $rows['product_name'];?></td>
                    <td><?php echo $rows['product_price'];?></td>
                    <td><img src="<?php echo htmlspecialchars($rows['product_img']); ?>" alt="Stored Image"></td>
                   
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