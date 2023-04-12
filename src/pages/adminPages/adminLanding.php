<?php 
session_start();

$username = $_SESSION['username'];

if (!isset($_SESSION['user_id']  )) {
  header('Location: ../index.php');
  exit();
}

elseif ($_SESSION['user_type'] != 'Admin'){
    header('Location: ../pages/LandingPage.php');
    exit();
  }
   
  $conn = mysqli_connect("eecs-plus.cyvzc0wdkfgr.eu-north-1.rds.amazonaws.com:3306","admin","password123","eecs");

  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

$query = "SELECT COUNT(*) FROM ECs where Status ='Pending'";
$result = $conn -> query($query);
$row = $result -> fetch_assoc();
$numPendingEC =  $row['COUNT(*)'];


$query = "SELECT COUNT(*) FROM ECs ";
$result = $conn -> query($query);
$sec = $result -> fetch_assoc();

$numECs =  $sec['COUNT(*)'];


$query = "SELECT COUNT(*) FROM issues";
$result = $conn -> query($query);
$thrd = $result -> fetch_assoc();

$numissuesSubmitted = $thrd['COUNT(*)'];

$conn -> close();

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="icon" type="image" href="../assets/QMUL Logo.png">
    <link rel="stylesheet" href="../css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    <!--Icons stylesheet-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>
<body>

    <?php include 'sideNav.html';?>

    <div class="col py-3">
        <!-- Page Content -->
        <div id="page-content-wrapper">

            <?php include 'topNav.html';?>

            <div class="container-fluid px-4">
                <div class="row g-3 my-2">
                    <div class="col-md-3">
                        <div class="p-3 bg-white border shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2"><?php echo $numECs?></h3>
                                <p class="fs-5">Total ECs</p>
                            </div>
                            <i class="bi bi-hand-thumbs-up p-1"></i>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="p-3 bg-white border shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2"><?php echo $numPendingEC?></h3>
                                <p class="fs-5">Pending EC</p>
                            </div>
                            <i
                                class="bi bi-alarm p-1"></i>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="p-3 bg-white border shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2"><?php echo $numissuesSubmitted?> </h3>
                                <p class="fs-5">Issues Submitted</p>
                            </div>
                            <i class="bi bi-ticket-detailed p-1"></i>
                        </div>
                    </div>


                <div class="row my-5">
                    <h3 class="fs-4 mb-3">Recently Viewed EC</h3>
                    <div class="col">
                        <?php

                        $conn = mysqli_connect("eecs-plus.cyvzc0wdkfgr.eu-north-1.rds.amazonaws.com:3306","admin","password123","eecs");

                        if (!$conn) {
                            die("Connection failed: " . mysqli_connect_error());
                        }

                        
                        
                        

                        //Retrieve data from the database
                        $query = "
                        SELECT `ECs`.`id`,
                        `ECs`.`userID`,
                        `ECs`.`ModuleName`,
                        `ECs`.`description`,
                        `ECs`.`DateCreated`,
                        `ECs`.`DeadLine`,
                        `ECs`.`RequestedExtentionDeadline`,
                        `ECs`.`isSelfCertified`,
                        `ECs`.`Status`,
                        `user`.`userName`,
                        `user`.`userType`
                        FROM `eecs`.`ECs` 
                        JOIN `eecs`.`user` ON `ECs`.`userID` = `user`.`id` 
                        ORDER BY `ECs`.`id` DESC LIMIT 5
                        ;";
                        $result = mysqli_query($conn, $query);

                        if ($result -> num_rows == 0) {
                            echo "<h3>There are no ECs!</h3>";
                        } else {
                            //Display the data in a table
                            echo "<table id='ecTable' class='table table-hover'>";
                            echo "<thead><tr><th>ID</th><th>User ID</th><th>UserName</th><th>User Type</th><th>Module Name</th><th>Status</th><th>Date Created</th></tr></thead><tbody>";
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row["id"] . "</td>";
                                echo "<td>" . $row["userID"] . "</td>";
                                echo "<td>" . $row["userName"] . "</td>";
                                echo "<td>" . $row["userType"] . "</td>";
                                echo "<td>" . $row["ModuleName"] . "</td>";
                                echo "<td style='display:none;' >" . $row["description"] . "</td>";
                                echo "<td style='display:none;'>" . $row["DeadLine"] . "</td>";
                                echo "<td style='display:none;'>" . $row["RequestedExtentionDeadline"] . "</td>";
                                echo "<td style='display:none;'>" . $row["isSelfCertified"] . "</td>";
                                echo "<td>" . $row["Status"] . "</td>";
                                echo "<td>" . $row["DateCreated"] . "</td>";
                                
                                
                                echo "</tr>";
                            }
                            echo "</tbody></table>";
                        }
                
                        mysqli_close($conn);

                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
                </div>
            </div>
        </div>

  
    

</body>

    <!--Scripts for button functionality-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
