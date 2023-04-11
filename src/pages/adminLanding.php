
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

$numECs =  $row['COUNT(*)'];

$query = "SELECT COUNT(*) FROM ECs where Status ='Approved' || Status ='Not Approved'";
$result = $conn -> query($query);
$sec = $result -> fetch_assoc();


$numPendingEC =  $sec['COUNT(*)'];

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
        <div class="container-fluid">
            <div class="row flex-nowrap">
                <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                        <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                            <span class="fs-5 d-none d-sm-inline">Menu</span>
                        </a>
                        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                            <li class="nav-item">
                                <a href="adminLanding.php" class="nav-link align-middle px-0">
                                    <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
                                </a>
                            </li>
                            <li>
                                <a href="adminPages/viewAllECs.php" class="nav-link px-0 align-middle">
                                    <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">View EC's</span></a>
                            </li>
                            <li>
                                <a href="adminPages/adminViewIssues.php" class="nav-link px-0 align-middle">
                                    <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">View Issues</span></a>
                            </li>
                            <li>
                                <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                    <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline">User Functions</span></a>
                                    <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                                    <li class="w-100">
                                        <a href="../pages/ApplyEC.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Submit EC</span></a>
                                    </li>
                                    <li>
                                        <a href="../pages/ReportIssues.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Submit Issue</span></a>
                                    </li>
                                    <li>
                                        <a href="../pages/ViewYourIssues.php" class="nav-link px-0"> <span class="d-none d-sm-inline">View Submitted Issues</span></a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="nav-link px-0 align-middle">
                                    <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Edit User details</span> </a>
                            </li>
                            <li>
                                    <a href="adminPages/addUser.php" class="nav-link px-0 align-middle">
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
                    <h2 class="fs-2 m-0">Dashboard</h2>
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
                                <img src="../assets/QMUL Logo.png" alt="hugenerd" width="30" height="30" class="rounded-circle">
                                <i class="fas fa-user me-2"></i><?php echo $username ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                                <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

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
                        <table class="table bg-white rounded shadow-sm  table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" width="50">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Student Id</th>
                                    <th scope="col">Complete</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Abishana Ravindran</td>
                                    <td>21038475</td>
                                    <td>Pending</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Person 2</td>
                                    <td>34124</td>
                                    <td>Complete</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Person 3</td>
                                    <td>65756</td>
                                    <td>Complete</td>
                                </tr>
                                <tr>
                                    <th scope="row">4</th>
                                    <td>Person 4</td>
                                    <td>234345</td>
                                    <td>Pending</td>
                                </tr>
                                </tr>
                            </tbody>
                        </table>
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
</html>