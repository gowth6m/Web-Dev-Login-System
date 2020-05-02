<?php 
    session_start();
    require './config/db_config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="./assets/img/logo.png" type="image/x-icon" rel="shortcut icon">
    <title>Display Tasks</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="./assets/js/script.js"></script>
</head>
<body>
    <div class="main-container">
        <?php 
            echo '<h1>Welcome '.ucfirst($_SESSION['userName']).'</h1>';
        ?>

        <div class="display-container">
            <a href="./addTask.php" class="add-task-button">Add Task</a>
            <table class="display-table">
                <thead>
                    <tr>
                        <th>State</th>
                        <th>Name & Date</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>

                <tbody>
                    <?php 
                        $userID = $_SESSION['userID'];
                        $current_user_tasks = mysqli_query($conn, "SELECT * FROM tasks WHERE idUser='$userID'") 
                            or die("Could not fetch".mysqli_error($conn));
                        if(isset($_GET['display-del'])) {
                            $id = $_GET['display-del'];
                            $deleteQuery = mysqli_query($conn, "DELETE FROM tasks WHERE idTask=$id")
                                or die("Could not delete".mysqli_error($conn));
                            header("Location: ./display.php");
                        }
                        if(isset($_GET['display-edit'])) {
                            $_SESSION['idTask'] = $_GET['display-edit'];
                            header("Location: ./editTask.php");
                        }

                        while ($row = mysqli_fetch_array($current_user_tasks)) {
                    ?>
                    <tr>
                        <form action="" method="get">
                            <th><?php 
                                if($row['taskState'] == 0) {
                                    echo 'To be done';
                                } else if($row['taskState'] == 1) {
                                    echo 'Done';
                                }
                            ?></th>
                            <th><?php echo $row['taskName']." <div>(Date:".$row['dueDate'].")</div>";?></th>
                            <th><button type="submit" name="display-edit" class="display-table-button" value="<?php echo $row['idTask']?>">Edit</button></th>
                            <th><button type="submit" name="display-del" class="display-table-button" value="<?php echo $row['idTask']?>">Delete</button></th>
                        </form>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        
        <br>
        <form action="./scripts/script_logout.php" method="post">
            <button class="button" type="submit" name="logout-submit">Logout</button>
        </form>
    </div>
</body>
</html>