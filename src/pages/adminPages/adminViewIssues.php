



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




  if (isset($_POST['status']) && isset($_POST['id'])) {
    $status = $_POST['status'];
    $id = $_POST['id'];
    
  
    updateIssue($id, $status);
  }
  
  function updateIssue($id, $status){
    $conn = new mysqli("eecs-plus.cyvzc0wdkfgr.eu-north-1.rds.amazonaws.com:3306","admin","password123","eecs");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $sql = "UPDATE `eecs`.`issues`
    SET `status` = '$status'
    WHERE `id` = '$id';";
  
    if ($conn->query($sql) === TRUE) {
      echo "Updated successfully";
      header("refresh:0.3;url=adminViewIssues.php");
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }


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
        <div class="container-fluid">
                    <div class="row flex-nowrap">
                        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                                <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                                    <span class="fs-5 d-none d-sm-inline">Menu</span>
                                </a>
                                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                                    <li class="nav-item">
                                        <a href="../adminLanding.php" class="nav-link align-middle px-0">
                                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="viewAllECs.php" class="nav-link px-0 align-middle">
                                            <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">View EC's</span></a>
                                    </li>
                                    <li>
                                        <a href="adminViewIssues.php" class="nav-link px-0 align-middle">
                                            <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">View Issues</span></a>
                                    </li>
                                    <li>
                                        <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                            <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline">User Functions</span></a>
                                            <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                                            <li class="w-100">
                                                <a href="../../pages/ApplyEC.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Submit EC</span></a>
                                            </li>
                                            <li>
                                                <a href="../../pages/ReportIssues.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Submit Issue</span></a>
                                            </li>
                                            <li>
                                                <a href="../../pages/ViewYourIssues.php" class="nav-link px-0"> <span class="d-none d-sm-inline">View Submitted Issues</span></a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#" class="nav-link px-0 align-middle">
                                            <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Edit User details</span> </a>
                                    </li>
                                    <li>
                                        <a href="addUser.php" class="nav-link px-0 align-middle">
                                            <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">New User</span> </a>
                                    </li>
                                </ul>
                                <hr>
                            </div>
                        </div>
                <div class="col py-3">
                            <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">View Issues</h2>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="../../assets/QMUL Logo.png" alt="hugenerd" width="30" height="30" class="rounded-circle">
                                <i class="fas fa-user me-2"></i><?php echo $username ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                                <li><a class="dropdown-item" href="../../logout.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            

            <div class="container-fluid text-center">
    <div class="container mb-2" id="ec-details">
        <?php 

        $username = $_SESSION['username'];

        if (!isset($_SESSION['user_id']  ) ) {
            header('Location: ../index.php');
            exit();
        } elseif ($_SESSION['user_type'] != 'Admin') {
            header('Location: ../../index.php');
            exit();
        }

        $conn = mysqli_connect("eecs-plus.cyvzc0wdkfgr.eu-north-1.rds.amazonaws.com:3306","admin","password123","eecs");

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $ID = $_SESSION['user_id'];
        //Retrieve data from the database
        $query = "
        SELECT `issues`.`id`,
        `issues`.`userID`,
        `issues`.`description`,
        `issues`.`status`,
        `issues`.`timeCreated`,
        `issues`.`issueType`,
        `user`.`userName`,
        `user`.`userType`
        FROM `eecs`.`issues`
        JOIN `eecs`.`user` ON `issues`.`userID` = `user`.`id`;
        ";

        $result = mysqli_query($conn, $query);

        if ($result -> num_rows == 0) {
            echo "<h3>No issues!</h3>";
        } else {
            //Display the data in a table
            echo "<table id='issueTable' class='table table-hover'>";
            echo "<thead><tr><th>ID</th><th>User ID</th><th>UserName</th><th>User Type</th></th><th>Status</th><th>Issue Type</th><th>Time Created</th></tr></thead><tbody>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["userID"] . "</td>";
                echo "<td>" . $row["userName"] . "</td>";
                echo "<td>" . $row["userType"] . "</td>";
                echo "<td style='display:none'>" . $row["description"] . "</td>";
                echo "<td  >" . $row["status"] . "</td>";;
                echo "<td >" . $row["issueType"] . "</td>";
                echo "<td>" . $row["timeCreated"] . "</td>";
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


  
    

</body>
<script >

function deleteIssue(id) {
    
  if (confirm("Are you sure you want to delete this Issue?")) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        alert(this.responseText);
        window.location.href = "adminViewIssues.php";
      }
    };
    
    xhttp.open("GET", "deleteIssue.php?id=" + id, true);
    xhttp.send();
  }
}
const table = document.getElementById("issueTable");

const rows = table.getElementsByTagName("tr");

for (let i = 0; i < rows.length; i++) {
    rows[i].addEventListener("click", function () {
        const currentRow = table.rows[i];
        const rowArray = currentRow.getElementsByTagName("td");

        // Get the values of the relevant columns
        const id = rowArray[0].innerHTML;
        const userID = rowArray[1].innerHTML;
        const username = rowArray[2].innerHTML;
        const userType = rowArray[3].innerHTML;
        const description = rowArray[4].innerHTML;
        const status = rowArray[5].innerHTML;
        const issueType = rowArray[6].innerHTML;
        const timeCreated = rowArray[7].innerHTML;


        // Create the HTML for the details
        const html = `
        <div class="container">
        <form action="" method="post" >
  <table class="table table-bordered">
    <tbody>
        <tr>
            <th scope="row">ID</th>
            <td>${id}</td>
        </tr>
        <tr>
            <th scope="row">User ID</th>
            <td>${userID}</td>
        </tr>
        <tr>
            <th scope="row">Username</th>
            <td>${username}</td>
        </tr>
        <tr>
            <th scope="row">User Type</th>
            <td>${userType}</td>
        <tr>
            <th scope="row">Description</th>
            <td>${description}</td>
        </tr>
        <tr>
            <th scope="row">Status</th>
            <td>${status}</td>
        </tr>
        <tr>
            <th scope="row">Issue Type</th>
            <td>${issueType}</td>
        </tr>
        <tr>
            <th scope="row">Time Created</th>
            <td>${timeCreated}</td>
        </tr>

    </tbody>
  </table>
    
        <select class="form-select mb-2" name="status">
            <option value="Pending">Pending</option>
            <option value="Resolved">Resolved</option>
        </select>
        <button class="btn btn-primary mb-2" type="submit">Save</button>
        <button class="btn btn-secondary mb-2"  type="button" onclick="location.reload()">Cancel</button>
        <button class="btn btn-secondary mb-2" type="button" onclick=deleteIssue('${id}')>Delete</button>
    </form>
    
</div>  `;

        // Render the HTML in the #ec-details div
        const ecDetails = document.getElementById('ec-details');
        ecDetails.innerHTML = html;
    });

}


</script>

    <!--Scripts for button functionality-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>