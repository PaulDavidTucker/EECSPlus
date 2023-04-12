<?php

function deleteEC($id){
  echo "Deleting EC with id: " . $id;

  $conn = new mysqli("eecs-plus.cyvzc0wdkfgr.eu-north-1.rds.amazonaws.com:3306","admin","password123","eecs");
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $sql = "DELETE FROM `eecs`.`ECs`
          WHERE `id` = '$id';";
  
  if ($conn->query($sql) === TRUE) {
    echo "Updated successfully";
    header("refresh:3;url=viewAllECs.php");
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

if(isset($_GET['id'])) {
  deleteEC($_GET['id']);
}

?>