
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



if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['userType']) && isset($_POST['ConfirmPassword'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $userType = $_POST['userType'];
    $confrimPassword = $_POST['ConfirmPassword'];

    if ($password != $confrimPassword){
        echo "Passwords do not match";
        header("refresh:0.9;url=addUser.php");
        
    }
    else{
        addUser($username, $password, $userType);

    }

    
}



  // add user to database


  function addUser($username, $password, $userType){
    $conn = new mysqli("eecs-plus.cyvzc0wdkfgr.eu-north-1.rds.amazonaws.com:3306","admin","password123","eecs");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO `user` (`userName`, `password`, `userType`) VALUES ('$username', '$password', '$userType');";

    try {
        if ($conn->query($sql) === TRUE) {
          echo "Updated successfully";
          header("refresh:0.5;url=addUser.php");
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } catch (Exception $e) {
        if ($e->getCode() == 1062) {
            echo "Username already exists";
            header("refresh:0.5;url=addUser.php");
        } else {
            echo "Error: " . $e->getMessage();
            header("refresh:0.5;url=addUser.php");
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
                        </div
    ><div class="col py-3">
                            <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Add New User</h2>
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
            
        <form action="" method="post" target="_self">

      
                        <div class="form-outline mb-4">
                        <input type="text" class="form-control" placeholder="username" 
                        name="username" required maxlength="50" />

                        </div>
                        <div class="form-outline mb-4">
                        <input type="password" class="form-control" placeholder="password" 
                        name="password" required minlength="4" maxlength="20" />

                        </div>

                        <div class="form-outline mb-4">
                        <input type="password" class="form-control" placeholder="Confirm Password" 
                        name="ConfirmPassword" required minlength="4" maxlength="20" />
                        </div>


                        <select name="userType" class="form-select form-select-sm mb-3" required>
                            <option value="">Select User Type</option>
                            <option value="Student">Student</option>
                            <option value="Faculty">Faculty</option>
                            <option value="Admin">Admin</option>
                        </select>
                        </div>
      
                        <div class="text-center pt-1 mb-5 pb-1">
                          <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" id="addUserSumbmits" type="submit">Submit</button>
    
                        </div>
      

      
                      </form>
        
        </div>

      
    </div>


  
    

</body>
<script >





</script>

    <!--Scripts for button functionality-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>
