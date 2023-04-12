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




  if (isset($_POST['username']) && isset($_POST['id']) ) {
    $username = $_POST['username'];
    $id = $_POST['id'];

    if($username != ""){
        updateUserName($id, $username);;
    }


  }


  
  if ( isset($_POST['id']) && isset($_POST['password']) && isset($_POST['ConfirmPassword'])) {

    $password = $_POST['password'];
    $id = $_POST['id'];
    $ConfirmPassword = $_POST['ConfirmPassword'];
    
    
    if($password == ""){
        exit();
      }

    if ($password != $ConfirmPassword) {
      echo " Passwords do not match  ";
      header("refresh:2;url=editUser.php");
      
    }
    if($password.ob_get_length()<5){
        echo " Password must be at least 5 characters long  ";
        header("refresh:2;url=editUser.php");
    }
    if($password.ob_get_length()>20){
        echo " Password must be no more than 20 characters long  ";
        header("refresh:2;url=editUser.php");
    }
    else{
        updatePassword($id,$password );

    }
    
  
    
  }







  
  function updatePassword($id ,$password){
    $conn = new mysqli("eecs-plus.cyvzc0wdkfgr.eu-north-1.rds.amazonaws.com:3306","admin","password123","eecs");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
   
    $sql = "UPDATE `eecs`.`user`
    SET `password` = '$password'
    WHERE `id` = '$id';";
  
    if ($conn->query($sql) === TRUE) {
      echo "Password Updated successfully  ";
      header("refresh:2;url=editUser.php");
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn -> close();
}
  
  function updateUserName($id , $username){
    $conn = new mysqli("eecs-plus.cyvzc0wdkfgr.eu-north-1.rds.amazonaws.com:3306","admin","password123","eecs");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }




    $sql = "UPDATE `eecs`.`user`
    SET `userName` = '$username'
    WHERE `id` = '$id';";
  
  try {
    if ($conn->query($sql) === TRUE) {
      echo "Username Updated successfully   ";
      header("refresh:2;url=editUser.php");
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
    } catch (Exception $e) {
        if ($e->getCode() == 1062) {
            echo "Username already exists";
            header("refresh:2;url=editUser.php");
        } else {
            echo "Error: " . $e->getMessage();
            header("refresh:2;url=editUser.php");
        }
    }

    $conn -> close();
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

                                            <li>
                                                <a href="../../pages/ReportIssues.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Submit Issue</span></a>
                                            </li>
                                            <li>
                                                <a href="../../pages/ViewYourIssues.php" class="nav-link px-0"> <span class="d-none d-sm-inline">View Submitted Issues</span></a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="editUser.php" class="nav-link px-0 align-middle">
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
                    <h2 class="fs-2 m-0">User Details</h2>
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
            

            <div class="container-fluid text-left">
                <div class="container mb-2" id="user-details">
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
                    SELECT id, userName, userType
                    FROM `eecs`.`user`
                    WHERE userType IN ('Student', 'Faculty');
                    

                    ";
                    $result = mysqli_query($conn, $query);

                    if ($result -> num_rows == 0) {
                        echo "<h3>You have no ECs!</h3>";
                    } else {
                        //Display the data in a table
                        echo "<table id='userTable' class='table table-hover'>";
                        echo "<thead><tr><th>ID</th><th>UserName</th><th>User Type</th></tr></thead><tbody>";
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["userName"] . "</td>";
                            echo "<td>" . $row["userType"] . "</td>";
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


  
    

</body>
<script >

function deleteUser(id) {
    console.log(id);
  if (confirm("Are you sure you want to delete this User?")) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        alert(this.responseText);
        window.location.href = "editUser.php";
      }
    };
    
    xhttp.open("GET", "deleteUser.php?id=" + id, true);
    xhttp.send();
  }
}


const table = document.getElementById("userTable");

const rows = table.getElementsByTagName("tr");

for (let i = 0; i < rows.length; i++) {
    rows[i].addEventListener("click", function () {
        const currentRow = table.rows[i];
        const rowArray = currentRow.getElementsByTagName("td");

        // Get the values of the relevant columns
        const id = rowArray[0].innerHTML;
        const username = rowArray[1].innerHTML;
        const userType = rowArray[2].innerHTML;


        // Create the HTML for the details
        const html = `
        <div class="container">
        <form action="" method="post" target="_self" >
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th class="text-left">ID</th>
                    <td >${id}</td>
                    <input type="hidden" name="id" value="${id}">
                </tr>
                <tr>
                    <th>username</th>
                    <td><input type="text" class="form-control" placeholder="${username} " 
                    name="username"  maxlength="50" /></td>
                </tr>
                <tr>
                    <th>Change Password</th>
                        <td><input type="password" class="form-control" placeholder="password" 
                            name="password"  minlength="3" maxlength="20" />
                        </td>
                    
                </tr>
                <tr>
                    <th>Confirm Changed password:</th>
                    <td>
                        <input type="password" class="form-control" placeholder="Confirm Password" 
                        name="ConfirmPassword"  minlength="3" maxlength="20" />
                    
                    </td>

                </tr>

                <tr>
                    <th class="text-left" >User Type</th>
                    <td>${userType}</td>
                    
                </tr>
                </tbody>
            </table>

            <div class="container-fluid text-center">
    
                <button class="btn btn-primary mb-2" type="submit">Save</button>
                <button class="btn btn-secondary mb-2"  type="button" onclick="location.reload()">Cancel</button>
                <button class="btn btn-secondary mb-2" type="button" onclick=deleteUser('${id}')>Delete</button>
            </div>
    </form>
    
</div>  `;

        // Render the HTML in the #user-details div
        const ecDetails = document.getElementById('user-details');
        ecDetails.innerHTML = html;
    });




}





</script>

    <!--Scripts for button functionality-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>
