<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $status = $_POST["status"];
    $service_id = $_POST["service_id"];

    $conn = mysqli_connect("eecs-plus.cyvzc0wdkfgr.eu-north-1.rds.amazonaws.com:3306","admin","password123","eecs");

    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    // Update the database with the new status
    $query = "UPDATE 'EECS_Services' 
    SET Status = '$status'
    WHERE service_id = '$service_id' ";
    $result = mysqli_query($conn, $query);

    mysqli_close($conn);

    if ($result) {
        header("Location: EECSService.php");
        exit;
    } else {
        echo "Error updating status: " . mysqli_error($conn);
    }
}

?>
