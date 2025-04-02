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

// Initialize variables
$user_info = null;
$error = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search_username = trim($_POST['username']);

    // Validate input
    if (!empty($search_username)) {
        // Prepare and execute query
        $stmt = $conn->prepare("SELECT * FROM accounts WHERE username = ?");
        $stmt->bind_param("s", $search_username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user_info = $result->fetch_assoc();
        } else {
            $error = "No account found with that username.";
        }

        $stmt->close();
    } else {
        $error = "Please enter a username.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="styles.css"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Account Deletion</title>
</head>
<body>
<div class="header">
<img src="logo.png" style="width: 500px; height: 150px;" alt="logo">
        <h1>SaveBig</h1>
        <p>Account Deletion</p>
</div>
    <div class="leftcol">
        
        <h3> Admin Options</h3>
        <ul>
            <li><a href="admin_index.php"> Account Home </a>  </li>
            <li><a href="admin_lookup.php"> Lookup </a>  </li>
            <li><a href="admin_view.php"> View All Accounts</a> </li>
            <li><a href="admin_addUser.php"> Add a new User</a></li>
        </ul>

    </div>

    <div class="mainContent">
    <!-- Search Form -->
    <form action="" method="POST">
        <label for="username">Enter Username:</label>
        <input type="text" id="username" name="username" required>
        <button type="submit">Search</button>
    </form>

    <hr>

    <!-- Display User Info -->
    <?php if ($user_info): ?>
        <h3>Account Details</h3>
        <p><strong>Username:</strong> <?= htmlspecialchars($user_info["username"]) ?></p>
        <p><strong>Name:</strong> <?= "" . htmlspecialchars($user_info["fname"] . " " . htmlspecialchars($user_info["lname"])) ?></p>
        <p><strong>Balance:</strong> <?= htmlspecialchars($user_info["balance"]) ?></p>
        <form action="deleteUser.php" method="POST">
            <input name="user" type="hidden" value="<?= htmlspecialchars($user_info["username"]) ?>"/>
            <button type="submit">Delete User</button>
        </form>
    <?php elseif ($error): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>
    </div>
</body>
</html>
