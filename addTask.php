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
    <title>Add Task</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="./assets/js/script.js"></script>
</head>
<body>
    <div class="main-container">
        <div class="edit-container">
            <?php 
                $userID = $_SESSION['userID'];
                // Update the edit page
                if(isset($_POST['add-ok'])) {
                    $updated_name = $_POST['add-name'];
                    $updated_date = $_POST['add-date'];
                    $updated_desc = $_POST['add-desc'];
                    $update_state = $_POST['add-state'];
                    $updated_query = "INSERT INTO tasks (taskName, dueDate, taskDesc, taskState, idUser)
                    VALUES ('$updated_name', '$updated_date', '$updated_desc', $update_state, '$userID')";
                    mysqli_query($conn, $updated_query);
                    header("Location: ./display.php");
                }
            ?>
        
            <form action="" method="post">
                <h2>Task name</h2>
                <input type="text" class="edit-name" name="add-name" placeholder="Enter task here" required/>
                <h2>Description</h2>
                <textarea name="add-desc" type="text" class="edit-desc" placeholder="Enter description here"></textarea>
                <br>
                <div class="small-container">
                    <div class="date-container">
                        <h2>Due Date</h2>
                        <input class="edit-date" type="date" name="add-date" required/>
                    </div>
                    <div class="state-container">
                        <h2>State</h2>
                        <select class="edit-state" type="text" name="add-state">
                            <option value="0" selected>To be Done</option>
                            <option value="1">Done</option>
                        </select>
                    </div>
                </div>
                <br><br>
                <button type="submit" class="button" name="add-ok">Ok</button>
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