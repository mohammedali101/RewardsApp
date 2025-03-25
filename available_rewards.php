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
    </div>

    <script>
        // JS function for purchases
        function buyReward(rewardName) {
            alert('You have selected the "' + rewardName + '" reward!');
        }
    </script>
</body>
</html>