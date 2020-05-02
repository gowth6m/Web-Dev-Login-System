<?php 
    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "15gpym15";
    $dbname = "cwapp";

    $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

    if (!$conn) {
        die("Connection failed: ".mysqli_connect_error());
    }

    // // Create connection
    // $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    // // Check connection
    // if ($conn->connect_error) {
    //     die("Connection failed: " . $conn->connect_error);
    // }
?>