<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="./assets/img/logo.png" type="image/x-icon" rel="shortcut icon">
    <title>Application</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="./assets/js/script.js"></script>
</head>
<body>
    <div class="main-container">
        <?php
            // Loads this when logged in. 
            if(isset($_SESSION['userID'])) {
                $username = $_SESSION['userName'];
                header("Location: ./display.php?id=".$username); 
            } else {
            // Loads this when logged out.
                echo '<h1>Login Page</h1>';
                echo '
                    <form class="form" action="./scripts/script_login.php" method="post">';
                    if(isset($_GET['error'])){
                        if($_GET['error'] == "wrongpw") {
                            echo '<p>Invalid Password</p>';
                        } else if($_GET['error'] == "nouser") {
                            echo '<p>Invalid Username</p>';
                        }
                    }
                echo '
                        <input class="input-field" type="text" name="username" placeholder="Username">
                        <input class="input-field" type="password" name="password" placeholder="Password">
                        <br><br><br><br>
                        <button class="button" type="submit" name="login-submit">Login</button>
                        <a class="button" href="register.php">Register</a>
                    </form>
                    ';
            }
        ?>
    </div>
</body>
</html>