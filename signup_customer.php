
<?php
session_start();
//include()
//store user input
$email= $_POST["email_address"];
//echo $email;
$password= $_POST["password"];
$fname = $_POST["first_name"];
$lname= $_POST["last_name"];
//Establish connection to mysql server
if ( !( $database = mysqli_connect( "localhost:3306","root", "root" ) ) )
{
    die( "<p>Could not connect to database</p>" );
}

if ( !mysqli_select_db( $database, "db" ) )
{
    die( "<p>Could not open  database</p>" );
}


if(!empty($email) && !empty($password))
{
    $query = "INSERT INTO accounts (username, password_hash, fname, lname) VALUES ('$email', '$password', '$fname', '$lname')";
}

if ($database->query($query) === TRUE) {
    echo "New record created successfully";
}
header("Location: login_customer.html");
exit;

?>