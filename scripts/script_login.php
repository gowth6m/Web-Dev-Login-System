<?php
if(isset($_POST['login-submit'])) {
    require "../config/db_config.php";

    $username = $_POST['username'];
    $password = $_POST['password'];

    if(empty($username) || empty($password)) {
        header("Location: ../index.php?error=emptyfields");
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE nameUser=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../index.php?error=sqlerror");
            exit();
        }   else {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                $pwCheck = password_verify($password, $row['pwUser']);
                if ($pwCheck == false) {
                    header("Location: ../index.php?error=wrongpw");
                    exit();
                } else if ($pwCheck == true) {
                    session_start();
                    $_SESSION['userID'] = $row['idUser'];
                    $_SESSION['userName'] = $row['nameUser'];
                    header("Location: ../index.php?login=success");
                    exit();
                } else {
                    header("Location: ../index.php?error=wrongpw");
                    exit();
                }
            } else {
                header("Location: ../index.php?error=nouser");
                exit();
            }
        }

    }

} else {
    header("Location: ../index.php");
    exit();
}