<?php
session_start();
// Insert db connection for offers later
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="styles.css"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Offers</title>
</head>
<body>
    <div class="header">
        <h1>SaveBig</h1>
        <p>View offers that are available</p>
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
        <h2>View Offers</h2>
        <?php
        if ($result->num_rows > 0) {
            echo "<ul>";
            while ($row = $result->fetch_assoc()) {
                echo "<li><strong>" . htmlspecialchars($row["offer_name"]) . "</strong>: " . htmlspecialchars($row["description"]) . " - <em>Good until " . $row["expiry_date"] . "</em></li>";
            }
            echo "</ul>";
        } else {
            echo "<p>We're sorry! There are no offers currently available at this time.</p>";
        }
        $conn->close();
        ?>
    </div>
</body>
</html>
