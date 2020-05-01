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
    <title>Display</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="./assets/js/script.js"></script>
</head>
<body>
    <div class="main-container">
        <div class="edit-container">
            <br>
            <?php 
                require './config/db_config.php';
                $userID = $_SESSION['userID'];
                $taskID = $_SESSION['idTask'];

                $task_query= mysqli_query($conn, "SELECT * FROM tasks WHERE idTask=$taskID");
                $current_task = mysqli_fetch_array($task_query);
                echo "<h1>Task: ".$current_task['taskName']."</h1>";
                echo "<br>";
                echo $current_task['dueDate'];
                echo "<br>";
                echo $current_task['description'];
                echo "<br>";
                echo $current_task['state'];
            ?>

            <br>
            <a class="button" href="./display.php" name="edit-ok">Ok</a>
            <a class="button" href="./display.php" name="edit-cancel">Cancel</a>
            <br><br>
        </div>
        <br>
        <form action="./scripts/script_logout.php" method="post">
            <button class="button" type="submit" name="logout-submit">Logout</button>
        </form>
    </div>
</body>
</html>