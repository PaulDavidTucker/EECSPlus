
<?php 
session_start();

$username = $_SESSION['username'];
$_SESSION['pagename'] = "Edit EECS Services";

if (!isset($_SESSION['user_id']  )) {
  header('Location: ../index.php');
  exit();
}

elseif ($_SESSION['user_type'] != 'Admin'){
    header('Location: ../pages/LandingPage.php');
    exit();
  }

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

            <?php include 'topNav.php';?>

            <div class="container-fluid text-center">
                <div class="container mb-2">
                    <?php 
                    
                    $conn = mysqli_connect("eecs-plus.cyvzc0wdkfgr.eu-north-1.rds.amazonaws.com:3306","admin","password123","eecs");
            
                    if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                    }
            
                    //Retrieve data from the database
                    $query = "SELECT * FROM EECS_Services";
                    $result = mysqli_query($conn, $query);
            
                    // Display the data in a table
                    echo "<table id='ecTable' class='table table-hover'>";
                    echo "<tr><th scope='col'>Service</th><th scope='col'>Description</th><th scope='col'>Current Status</th><th scope='col'>New Status</th></tr>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr class='clickableRow'>";
                        echo "<td>" . $row["Service"] . "</td>";
                        echo "<td>" . $row["Description"] . "</td>";
                        echo "<td>" . $row["Status"] . "</td>";

                        echo "<td>
                            <form action='updateEECSService.php' method='post' target='_self'>
                                <input type='hidden' name='id' value='" . $row["id"] . "'>";
                        echo "<select name='Status' id='Status' class='form-select form-select-sm mb-3' required>
                                        <option value='' selected disabled hidden>Select Status</option>";
                        if ($row["Status"] !== "Running") {
                            echo "<option value='Running'>Running</option>";
                        }
                        if ($row["Status"] !== "Suspended") {
                            echo "<option value='Suspended'>Suspended</option>";
                        }
                        if ($row["Status"] !== "Unavailable") {
                            echo "<option value='Unavailable'>Unavailable</option>";
                        }
                        echo "</select>";
                        echo "<input class='btn btn-primary btn-block fa-lg gradient-custom-2 mb-3' id='LoginButton' type='submit'>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";

                    mysqli_close($conn);  
                                     
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</script>

    <!--Scripts for button functionality-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>
