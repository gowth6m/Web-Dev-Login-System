<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="./assets/img/logo.png" type="image/x-icon" rel="shortcut icon">
    <title>Register</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="./assets/js/script.js"></script>
</head>
<body>
    <div class="main-container">
        <div class="register">
            <h1>Register</h1>
            <form class="form" action="./scripts/script_register.php" method="post">
                <?php 
                    if(isset($_GET['error'])){
                        if($_GET['error'] == "emptyfields") {
                            echo '<p>Fill in all fields!</p>';
                        } else if($_GET['error'] == "passwordcheck") {
                            echo '<p>Password does not match!</p>';
                        } else if($_GET['error'] == "usertaken") {
                            echo '<p>Username already taken!</p>';
                        }   
                    }
                ?>
                <input class="input-field" type="text" name="user-id" placeholder="Username">
                <input class="input-field" type="password" name="user-pw" placeholder="Password">
                <input class="input-field" type="password" name="user-pw-repeat" placeholder="Re-enter Password">
                <br><br>
                <button class="button" type="submit" name="register-submit">Register</button>
                <a class="button" href="index.php" name="cancel-submit">Back</a>
            </form>
            <br>
        </div>
    </div>
</body>
</html>