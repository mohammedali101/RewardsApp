<?php
session_start();
// Insert db connection for rewards later
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="styles.css"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Rewards</title>
</head>
<body>
    <div class="header">
        <h1>SaveBig</h1>
        <p>View rewards that are currently available for your account!</p>
    </div>
    <div class="leftcol">
        <h3>Options</h3>
        <ul>
            <li><a href="customer_homepage.php">Customer Homepage</a></li>
            <li><a href="available_rewards.php">Available Rewards</a></li>
            <li><a href="view_offers.php">View Offers</a></li>
        </ul>
    </div>
    <div class="mainContent">
        <h2>Available Rewards</h2>
        <?php
        if ($result->num_rows > 0) {
            echo "<ul>";
            while ($row = $result->fetch_assoc()) {
                echo "<li><strong>" . htmlspecialchars($row["reward_name"]) . "</strong>: " . htmlspecialchars($row["description"]) . " - <em>" . $row["points_required"] . " points</em></li>";
            }
            // review if / else statement
            echo "</ul>";
        } else {
            echo "<p>No rewards available at the moment.</p>";
        }
        $conn->close();
        ?>
    </div>
</body>
</html>