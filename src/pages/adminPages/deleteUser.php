<?php

function deleteUser($id){
  echo "Deleting User with id:  " . $id;

  $conn = new mysqli("eecs-plus.cyvzc0wdkfgr.eu-north-1.rds.amazonaws.com:3306","admin","password123","eecs");
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $sql1 = "DELETE FROM `eecs`.`ECs` WHERE `userID` = '$id'";
  $sql2 = "DELETE FROM `eecs`.`issues` WHERE `userID` = '$id'";
  $sql3 = "DELETE FROM `eecs`.`user` WHERE `id` = '$id'";
  
  $conn->query($sql1);
  
  $conn->query($sql2);

 

  if ($conn->query($sql3) === TRUE) {
    echo "  User Deleted successfully";
    header("refresh:3;url=editUser.php");
  } else {
    echo "Error: " . $sql3 . "<br>" . $conn->error;
  }
}

if(isset($_GET['id'])) {
  deleteUser($_GET['id']);
}

?>