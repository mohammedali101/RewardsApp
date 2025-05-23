<?php
session_start(); 
$servername = "localhost";
$db_username = "root";  
$db_password = "root";  
$dbname = "db"; 

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection FIRST
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login_customer.php');
    exit;
}

$username = $_SESSION["username"];
$user_info = null;

$stmt = $conn->prepare("SELECT * FROM accounts WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user_info = $result->fetch_assoc();
} 

$stmt->close();

// Handle reward purchase
if (isset($_POST['buyReward'])) {
    $reward_id = $_POST['reward_id'];
    $customer_id = $_SESSION['user_id'];
    $price= $_POST['price'];
    $customerBalance=$user_info['balance'];

    if($customerBalance > $price){
        $newBal = $customerBalance - $price;
        $sql= "UPDATE accounts SET balance='$newBal' WHERE ID='$customer_id'";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Yay! You purchased a reward!');</script>";
           
        }

    }
   
    else {
        echo "<script>alert('You do not have enough points for this purchase!');</script>";
    }
}

// Get all rewards
$sql = "SELECT * FROM rewards ORDER BY ID ASC";
$result = $conn->query($sql);
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
    <img src="logo.png" style="width: 500px; height: 300px;" alt="logo">
        <h1>SaveBig</h1>
        <p>View rewards that are currently available for your account!</p>
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
        <h2>Available Rewards</h2>
        <div class="viewTable">
            <table>
                <tr>
                    <th>Reward ID</th>
                    <th>Item Name</th>
                    <th>Review Cost</th>
                    <th>View Image</th>
                    <th>Make Purchase</th>
                </tr>

                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?php echo $row['ID']; ?></td>
                        <td><?php echo $row['product_name']; ?></td>
                        <td><?php echo $row['product_price']; ?> points</td>
                        <td><img src="<?php echo htmlspecialchars($row['product_img']); ?>" alt="Stored Image" style="width:100px;height:auto;"></td>
                        <td>
                            <form method="post" action="">
                                <input type="hidden" name="price" value="<?=$row['product_price']; ?>">
                                <input type="hidden" name="reward_id" value="<?=$row['ID']; ?>">
                                <!-- Buy button below allows customer to purchase a reward -->
                                <button type="submit" name="buyReward">Buy</button> 
                            </form>
                        </td>
                    </tr>

                <?php

                    }
                } else {
                    echo "<tr><td colspan='5'>Sorry! There are no rewards available at this time. Please try again later.</td></tr>";
                }
                ?>
            </table>
            <p>Your current balance: <strong>$<?= htmlspecialchars($user_info["balance"]) ?></strong></p>
        </div>
    </div>
    <?php 
    $conn->close();
    ?>
</body>
</html>

<!--
    <ul>
        <li>
            <strong>BOGO Free</strong>: Get an exclusive offer to buy one, get one free on a select item of your choice!
            <em>50 points</em>
            <button class="buy-btn" onclick="buyReward('BOGO Free')">Buy</button>
        </li>
        <li>
            <strong>Discount Coupon</strong>: Save up to 20% off on your next purchase with this exclusive discount!
            <em>50 points</em>
            <button class="buy-btn" onclick="buyReward('Discount Coupon')">Buy</button>
        </li>
        <li>
            <strong>Gift Card</strong>: Redeem a gift card for up to $100 at select stores!
            <em>100 points</em>
            <button class="buy-btn" onclick="buyReward('Gift Card')">Buy</button>
        </li>
        <li>
            <strong>PS5</strong>: Enjoy an all new PS5 on us! This reward comes with a console, controller, and 1 year subscription for PS Plus
            <em>2000 points</em>
            <button class="buy-btn" onclick="buyReward('PS5')">Buy</button>
        </li>
        <li>
            <strong>iPhone 16 Pro Max</strong>: Save up big and redeem your points to earn an unlocked iPhone 16 Pro Max for all networks on us!
            <em>2000 points</em>
            <button class="buy-btn" onclick="buyReward('iPhone 16 Pro Max')">Buy</button>
        </li>
    </ul>

    <p>Make a purchase today to claim your rewards now!</p>

    <script>
        // JS function for purchases
        function buyReward(rewardName) {
            alert('You have selected the "' + rewardName + '" reward!');
        }
    </script>
-->