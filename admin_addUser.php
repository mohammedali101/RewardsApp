<?php
session_start();
$_SESSION['admin']='true';
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="styles.css"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
</head>
<body>
    <div class="header">
    <img src="logo.png" style="width: 500px; height: 150px;" alt="logo">
        <h1>SaveBig</h1>
        <p>Add User</p>

    </div>
    <div class="box">
    <div class="leftcol">
        
        <h3> Admin Options</h3>
        <ul>
            <li><a href="admin_index.php"> Account Home </a>  </li>
            <li><a href="admin_lookup.php"> Account Lookup </a>  </li>
            <li><a href="admin_view.php"> View All Accounts</a> </li>
            <li><a href="admin_Delete.php"> Delete a User</a></li>
        </ul>

    </div>

    <div class="mainContent">
    <script>
        // Array of previously used passwords (this could be fetched from a database in a real scenario)
        const previousPasswords = ['Password123!', 'oldPassword2020', 'Admin2023@'];
    
        // Password visibility toggle function
        function togglePassword() {
            var passwordField = document.getElementById('password');
            var confirmPasswordField = document.getElementById('confirm_password');
            var passwordToggle = document.getElementById('password_toggle');
            if (passwordField.type === "password") {
                passwordField.type = "text";
                confirmPasswordField.type = "text";
                passwordToggle.innerText = "Hide Passwords";
            } else {
                passwordField.type = "password";
                confirmPasswordField.type = "password";
                passwordToggle.innerText = "Show Passwords";
            }
        }
    
        // Password strength indicator function
        function checkPasswordStrength() {
            var password = document.getElementById('password').value;
            var strengthText = document.getElementById('password_strength');
            var strength = "Weak";
            var valid = true;
    
            // Validate length and characters
            var lengthValid = password.length >= 8;
            var upperCaseValid = /[A-Z]/.test(password);
            var lowerCaseValid = /[a-z]/.test(password);
            var numberValid = /[0-9]/.test(password);
            var specialValid = /[!@#$%^&*(),.?":{}|<>]/.test(password);
            var notPreviousPassword = !previousPasswords.includes(password);

            if (!lengthValid) {
                strength = "Weak (Password must be at least 8 characters long)";
                valid = false;
            } else if (!upperCaseValid || !lowerCaseValid || !numberValid || !specialValid) {
                strength = "Weak (Password must include at least one uppercase letter, one lowercase letter, one special character, and one number)";
                valid = false;
            } else if (!notPreviousPassword) {
                strength = "Weak (This password has been used previously)";
                valid = false;
            } else {
                strength = "Strong";  // If all conditions are met, the password is strong
            }
    
            strengthText.innerText = "Password Strength: " + strength;
            return valid;
        }
    </script>    


    <form action="signup_customer.php" method="POST">
        <div id="container">
            <fieldset>
                <legend>Sign up a new user!</legend>
                <br>
                <!-- Basic Information Fields -->
                First Name: <input type="text" name="first_name" required><br><br>
                Last Name: <input type="text" name="last_name" required><br><br>
                Email Address: <input type="email" name="email_address" required><br><br>
                
                <!-- Password Fields with Strength Indicator and Visibility Toggle -->
                Password: <input type="password" id="password" name="password" required oninput="checkPasswordStrength()"><br>
                <span id="password_strength">Password Strength: </span><br><br>
                
                Confirm Password: <input type="password" id="confirm_password" name="confirm_password" required><br><br>
                
                <!-- Password Visibility Toggle Button -->
                <button type="button" id="password_toggle" onclick="togglePassword()">Show Passwords</button><br><br>
                
                <!-- Terms and Conditions Checkbox -->
                <label for="terms">
                    <input type="checkbox" id="terms" name="terms" required>
                    I agree to the <a href="#">Terms and Conditions</a> and <a href="#">Privacy Policy</a>.
                </label><br><br>

                <!-- Submit Button -->
                <input type="submit" value="Sign Up">
            </fieldset>
        </div>
    </form>

    </div>
    </div>
</body>
</html>