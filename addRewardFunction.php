
<?php
session_start();
//include()
//store user input
$name = $_POST["rewardName"];
$price = $_POST["rewardPrice"];
$image = $_POST["rewardImage"];

//Establish connection to mysql server
if ( !( $database = mysqli_connect( "localhost:3306","root", "root" ) ) )
{
    die( "<p>Could not connect to database</p>" );
}

if ( !mysqli_select_db( $database, "db" ) )
{
    die( "<p>Could not open  database</p>" );
}

if(!empty($name) && !empty($price))
{
    $query = "INSERT INTO rewards (product_name, product_price, product_img) VALUES ('$name', '$price', '$image')";
}

if ($database->query($query) === TRUE) {
    echo "New record created successfully";
}

header("Location: admin_addReward.php");

exit;

?>