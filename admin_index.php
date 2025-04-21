<?php
session_start();
$servername = "localhost";
$db_username = "root";  
$db_password = "root";  
$dbname = "db";  

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle logout
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: Welcome_page.html");
    exit();
}

// Fetch admin details
$username = $_SESSION["user_id"];
$user_info = null;
$stmt = $conn->prepare("SELECT * FROM admins WHERE ID = ?");
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home</title>
    <link rel="stylesheet" type="text/css" href="styles.css"/>
</head>

<body>
<div class= header>
    <img src="logo.png" style="width: 500px; height: 300px;" alt="logo">
    <h1>SaveBig</h1>
    <p>Admin Index</p>
    </div>

<!-- Navigate to admin pages -->
<?php include("admin_navigate.php"); ?>
    <!-- 
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
        </div> -->

        <div class="mainContent">
            <h2><?php echo "Welcome, " . $_SESSION["firstName"] . " " . $_SESSION["lastName"] . "";?></h2>
            <p>Welcome to SaveBig! Provide great rewards for your loyal customers and keep your business thriving!</p>
            <p>As an Administrator, you can perform actions such as Viewing all Accounts, Lookup and Adjusting Points of a User, and more.</p>
            <p>This the Administrator Homepage. You can access Administrator Actions from the links on the left.</p>
            <form action="" method="POST">
        <button type="submit" name="logout" class="logout-btn">Logout</button>
        </form>
        </div>
        
    
</body>
</html>
