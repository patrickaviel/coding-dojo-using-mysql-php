<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- PATRICK AVIEL PERALTA -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodingDojo</title>
    <meta name="description" content="CodingDojo">
    <meta name="author" content="Patrick Peralta">
    <link rel="stylesheet" href="style.css">
    <style>
        
    </style>
</head>
<body>
    <div class="main-container">
        <h1>Welcome to CodingDojo!</h1>
        <div class="container">

            <form action="process.php" method="post" class="register">
                <input type="hidden" name="action" value="register">
                <h2>Don't have an account?</h2>
                <h3>Register Now!</h3>
                <p>First Name:
<?php
                    if(isset($_SESSION['fname_error'])){
                        echo "<span class='fail'>{$_SESSION['fname_error']}</span>";
                    }
                    unset($_SESSION['fname_error']);
?>
                </p>
                <input type="text" name="first_name" placeholder="Enter your first name">

                <p>Last Name:
<?php
                    if(isset($_SESSION['lname_error'])){
                        echo "<span class='fail'>{$_SESSION['lname_error']}</span>";
                    }
                    unset($_SESSION['lname_error']);
?>
                </p>
                <input type="text" name="last_name" placeholder="Enter your last name">

                <p>Email:
<?php
                    if(isset($_SESSION['email_error'])){
                        echo "<span class='fail'>{$_SESSION['email_error']}</span>";
                    }
                    unset($_SESSION['email_error']);
?>
                </p>
                <input type="text" name="email" placeholder="Enter your email">

                <p>Password:
<?php
                    if(isset($_SESSION['pass_error'])){
                        echo "<span class='fail'>{$_SESSION['pass_error']}</span>";
                    }
                    unset($_SESSION['pass_error']);
?>
                </p>
                <input type="password" name="password" placeholder="Enter your password">

                <p>Confirm Password:
<?php
                    if(isset($_SESSION['cpass_error'])){
                        echo "<span class='fail'>{$_SESSION['cpass_error']}</span>";
                    }
                    unset($_SESSION['cpass_error']);
?>
                </p>
                <input type="password" name="c_password" placeholder="Enter again your password" >

                <input type="submit" value="Register">
<?php
                    if(isset($_SESSION['message'])){
                        echo "<p class='success'>{$_SESSION['message']}</p>";
                    }
                    unset($_SESSION['message']);
                    if(isset($_SESSION['reg_message'])){
                        echo "<p class='fail'>{$_SESSION['reg_message']}</p>";
                    }
                    unset($_SESSION['reg_message']);
?>
            </form>

            <form action="process.php" method="post" class="login">
            <input type="hidden" name="action" value="login">
                <h2>Login</h2>
                <p>Email:</p>
                <input type="text" name="email" placeholder="Email">
<?php
                    if(isset($_SESSION['lg_email_error'])){
                        echo "<span class='fail'>{$_SESSION['lg_email_error']}</span>";
                    }
                    unset($_SESSION['lg_email_error']);
?>
                <p>Password:</p>
                <input type="password" name="password" placeholder="Password">
<?php
                    if(isset($_SESSION['lg_error'])){
                        echo "<span class='fail'>{$_SESSION['lg_error']}</span>";
                    }
                    unset($_SESSION['lg_error']);
?>
                <input type="submit" value="Login">
            </form>

        </div>
    </div>
</body>
</html>