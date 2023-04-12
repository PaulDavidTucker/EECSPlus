<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Status = $_POST["Status"];
    $id = $_POST["id"];

    $conn = mysqli_connect("eecs-plus.cyvzc0wdkfgr.eu-north-1.rds.amazonaws.com:3306","admin","password123","eecs");

    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    $query = sprintf("UPDATE `EECS_Services`
    SET `Status`='%s'
    WHERE `id`='%s'",
    mysqli_real_escape_string($conn, $Status),
    intval($id));
     
    $result = mysqli_query($conn, $query);

    if ($result) {
        mysqli_close($conn);
        header("Location: editEECSServices.php");
        exit;
    } else {
        echo "Error updating Status: ".mysqli_error($conn);
        mysqli_close($conn);
    }

}

?>
