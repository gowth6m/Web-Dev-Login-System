<?php
if(isset($_POST['register-submit'])) {
    require '../config/db_config.php';

    $username = $_POST['user-id'];
    $password = $_POST['user-pw'];
    $password_repeat = $_POST['user-pw-repeat'];

    if (empty($username) || empty($password) || empty($password_repeat)) {
        header("Location: ../register.php?error=emptyfields&user-id=".$username);
        exit();
    }

    else if ($password !== $password_repeat) {
        header("Location: ../register.php?error=passwordcheck&user-id=".$username);
        exit();
    }

    else {
        $sql = "SELECT nameUser FROM users WHERE nameUser=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../register.php?error=sqlerror&user-id=".$username);
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0) {
                header("Location: ../register.php?error=usertaken&user-id=".$username);
                exit();
            } else {
                $sql = "INSERT INTO users (nameUser, pwUser) VALUES (?,?)";
                $stmt= mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../register.php?error=sqlerror");
                    exit();
                } else {
                    $hashedPw = password_hash($password, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "ss", $username, $hashedPw);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../register.php?register=sucess");
                    // header("Location: ../index.php");
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_stmt_close($conn);
} else {
    header("Location: ../register.php");
    exit();
}
?>