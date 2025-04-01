<?php
// Start the session
session_start();

$email = $_POST["user"];

// Connect to the database
if (!( $database = mysqli_connect("localhost:3306", "root", "root") )) {
    die("<p>Could not connect to the database</p>");
}

if (!mysqli_select_db($database, "db")) {
    die("<p>Could not open the database</p>");
}

$sql= "DELETE FROM accounts WHERE username='$email'";
if ($database->query($sql) === TRUE) {
    header("Location: admin_Delete.php");
  
    $database->close();
}

?>