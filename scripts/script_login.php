<?php
if(isset($_POST['login-submit'])) {
    require "../config/db_config.php";

    $username = $_POST['username'];
    $password = $_POST['password'];

    if(empty($username) || empty($password)) {
        header("Location: ../index.php?error=emptyfields");
        exit();
    } else {
        $sql = "SELECT idUser, nameUser, pwUser FROM users WHERE nameUser=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../index.php?error=sqlerror");
            exit();
        }   else {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $idUser, $nameUser, $pwUser);
            $result = array();
            while(mysqli_stmt_fetch($stmt)) {
                $row['idUser'] = $idUser;
                $row['nameUser'] = $nameUser;
                $row['pwUser'] = $pwUser;
            }
            if (!empty($row)) {
                if ($password !== $row['pwUser']) {
                    mysqli_stmt_close($stmt);
                    header("Location: ../index.php?error=wrongpw");
                    exit();
                } else if ($password == $row['pwUser']) {
                    session_start();
                    $_SESSION['userID'] = $row['idUser'];
                    $_SESSION['userName'] = $row['nameUser'];
                    mysqli_stmt_close($stmt);
                    header("Location: ../index.php?login=success");
                    exit();
                } else {
                    mysqli_stmt_close($stmt);
                    header("Location: ../index.php?error=wrongpw");
                    exit();
                }
            } else {
                mysqli_stmt_close($stmt);
                header("Location: ../index.php?error=nouser");
                exit();
            }
        }
    }

} else {
    header("Location: ../index.php");
    exit();
}