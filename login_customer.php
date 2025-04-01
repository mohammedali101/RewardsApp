<?php 
session_start();
$email= $_POST["email"];
$password= $_POST["password"];

if ( !( $database = mysqli_connect( "localhost:3306","root", "password") ) )
    die( "<p>Could not connect to database</p>" );
if ( !mysqli_select_db( $database, "db" ) )
    {
        die( "<p>Could not open  database</p>" );
    }

    //Find email and password in database
    if(!empty($email) && !empty($password))
    {
        $query="SELECT * from accounts where username='$email' limit 1";
        $result=mysqli_query($database, $query);
        
        if($result){
            if(mysqli_num_rows($result) > 0){
                $user_data= mysqli_fetch_assoc($result);

                if($user_data['password_hash']=== $password){
                    $_SESSION['user_id'] = $user_data['ID'];
                    $_SESSION['firstName'] = $user_data['fname'];
                    $_SESSION['lastName'] = $user_data['lname'];
                    $_SESSION['username'] = $email;
                    header("Location: customer_index.php");
                    die;
                }
            }
        }
    }
    else{
        header("Location: login_customer.html");
        echo "Enter a valid username and password";
        die;
    }
    header("Location: login_customer.html");
    echo "Enter a valid username and password";
        die;



?>