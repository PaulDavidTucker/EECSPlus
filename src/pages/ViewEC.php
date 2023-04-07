<?php 
session_start();

$username = $_SESSION['username'];

if (!isset($_SESSION['user_id']  ) ) {
  header('Location: ../index.php');
  exit();
}
elseif ($_SESSION['user_type'] == 'Admin'){
  header('Location: ../pages/adminLanding.php');
  exit();
}

?>


<!DOCTYPE html>
<html lang="en" id="html">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EECSPlus</title>
    <link rel="icon" type="image" href="../assets/QMUL Logo.png">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</head>

<body>

    <!--NavBar for top of page-->
    <nav class="navbar navbar-expand-lg navbar-light gradient-custom-navbar" id="nav">
        <a class="navbar-brand ml-1" href="../index.php">
            <img src="../assets/QMUL Logo.png" alt="Logo not found" width="30" height="30" class="d-inline-block align-text-top">
            EECSPlus 
        </a>
        <a class="ml-auto mr-1" href="../logout.php">
          <button type="button" id="LogoutButton" class="btn btn-outline-light ">
            <img src="../assets/icons/person.svg" alt="Logout">
            Logout
        </button>
        </a>
        
            <button class="navbar-toggler mr-1" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                <li class="nav-item active ml-1">
                    <a class="nav-link" href="LandingPage.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item ml-1">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown ml-1">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dropdown
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="#">View your ECs</a>
                      <a class="dropdown-item" href="#">View your issues</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">View all issues</a>
                    </div>
                </li>
                <li class="nav-item ml-1 mt-2">
                  <div class="form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="darkModeCheckBox"  checked="true"  >
                    <label class="form-check-label" for="darkModeCheckBox">Dark Mode</label>
                  </div>
                </li>
                </ul>
                <form class="form-inline my-2 my-lg-0 ml-1 mr-1">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        
        
    </nav>

    

    
    <script src="../js/index.js" type="module"></script>
    <script src="../js/LPutils.js" type="module"></script>
    <!--Scripts for button functionality-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>


    <div class="container-fluid text-center">
      <h1>View your ECs</h1>
    </div>

    <div class="container mb-2">
      <?php 


      $username = $_SESSION['username'];

      if (!isset($_SESSION['user_id']  ) ) {
        header('Location: ../index.php');
        exit();
      }
      elseif ($_SESSION['user_type'] == 'Admin'){
        header('Location: ../pages/adminLanding.php');
        exit();
      }

      $conn = mysqli_connect("eecs-plus.cyvzc0wdkfgr.eu-north-1.rds.amazonaws.com:3306","admin","password123","eecs");

      if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      }

      $ID = $_SESSION['user_id'];
      //Retrieve data from the database
      $query = "SELECT * FROM ECs WHERE userID = '$ID'";
      $result = mysqli_query($conn, $query);

        //Display the data in a table
        echo "<table id='ecTable' class='table table-hover'>";
        echo "<tr><th scope=",'col',">Module Name</th><th scope=",'col',">Extension Deadline</th><th scope=",'col',">Self Certified</th><th scope=",'col',">Status</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr class='clickableRow'>";
          echo "<td>" . $row["ModuleName"] . "</td>";
          echo "<td>" . $row["RequestedExtentionDeadline"] . "</td>";
          echo "<td>" . ($row["isSelfCertified"] == 'true' ? 'Yes' : 'No') . "</td>";
          echo "<td>" . $row["Status"] . "</td>";
          echo "</tr>";
        }
        echo "</table>";

      mysqli_close($conn);


      ?>

      
    </div>
    
    <div id="OptionsBar" class="container">
      <div class="row">
        <div class="col">
          <form action="../scripts/withdrawEC.php" method="post" target="_self">
            <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
              Modify
            </button>
          </form>
          
        </div>
        <div class="col">
          <form action="" method="post">
              <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Withdraw
              </button>
            </form>
        </div>
        <div class="col">
        <form action="" method="post">
            <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
              More Details
            </button>
          </form>
        </div>
      </div>
      
      
      
    </div>


</body>



<footer class="container">
    <p></p>
    <p>&copy; Group 26 QMUL EECS</p>
</footer>

</html>
