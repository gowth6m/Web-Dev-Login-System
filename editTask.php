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
    <title>Edit Task</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="./assets/js/script.js"></script>
</head>
<body>
    <div class="main-container">
        <div class="edit-container">
            <?php 
                $userID = $_SESSION['userID'];
                $taskID = $_SESSION['idTask'];
                $task_query= mysqli_query($conn, "SELECT * FROM tasks WHERE idTask=$taskID");
                $current_task = mysqli_fetch_array($task_query);
                echo "<h1>Task: ".$current_task['taskName']."</h1>";
                // Update the edit page
                if(isset($_GET['edit-ok'])) {
                    $updated_desc = $_GET['edit-desc'];
                    $updated_date = $_GET['edit-date'];
                    $update_state = $_GET['edit-state'];
                    mysqli_query($conn, "UPDATE tasks SET taskDesc='$updated_desc', dueDate='$updated_date' WHERE idTask='$taskID'");
                    mysqli_query($conn, "UPDATE tasks SET taskState=$update_state WHERE idTask='$taskID'");
                    header("Location: ./display.php");
                }
            ?>
            <h2>Description</h2>
            <form action="" method="get">
                <textarea name="edit-desc" type="text" class="edit-desc"><?php echo $current_task['taskDesc']; ?></textarea>
                <br>
                <div class="small-container">
                    <div class="date-container">
                        <h2>Due Date</h2>
                        <input class="edit-date" type="date" name="edit-date" value="<?php echo $current_task['dueDate']?>">
                    </div>
                    <div class="state-container">
                        <h2>State</h2>
                        <select class="edit-state" type="text" name="edit-state" value="<?php echo $current_task['taskState']?>">
                            <option value="0" <?php if($current_task['taskState']==0){ echo 'selected'; }?>>To be Done</option>
                            <option value="1" <?php if($current_task['taskState']==1){ echo 'selected'; }?>>Done</option>
                        </select>
                    </div>
                </div>
                <br>
                <button type="submit" class="button" name="edit-ok">Ok</button>
                <a class="button" href="./display.php" name="edit-cancel">Cancel</a>
            </form>
            <br>
        </div>
        <br>
        <form action="./scripts/script_logout.php" method="post">
            <button class="button" type="submit" name="logout-submit">Logout</button>
        </form>
    </div>
</body>
</html>