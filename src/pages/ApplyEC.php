
<?php

session_start();



//check if user is logged in
$username = $_SESSION['username'];
$userType = $_SESSION['user_type'];

if (!isset($_SESSION['user_id']  ) ) {
  header('Location: ../index.php');
  exit();
}
elseif($_SESSION['user_type'] == 'Faculty'){
  header('Location: ../pages/LandingPage.php');
  exit();

}

elseif ($_SESSION['user_type'] == 'Admin'){
  header('Location: ../pages/adminLanding.php');
  exit();
}


if (isset($_POST['moduleName']) && isset($_POST['description']) && isset($_POST['DeadLine'])&& isset($_POST['RequestedExtentionDeadline']) && isset($_POST['type'])) {
  $module = $_POST['moduleName'];
  $description = $_POST['description'];
  $deadline = date('Y-m-d', strtotime($_POST['DeadLine']));
  $extentiondeadline = date('Y-m-d', strtotime($_POST['RequestedExtentionDeadline']));
  if ($_POST['type'] == "Self Certified") {
    $isselfcertified = "true";
  } else {
    $isselfcertified = "false";
  }

  // if deadline is before today's date echo "deadline is before today's date"
  // elisf deadline is before extention deadline echo "deadline is before extention deadline"
  // elif extention deadline is greater than 2 weeks of the deadline echo "extention deadline is greater than 2 weeks"
  // else submitEC($module, $description,$deadline, $extentiondeadline, $isselfcertified);

  if($deadline < date('Y-m-d')){
    echo "deadline is before today's date";
    header("refresh:1.5;url=ApplyEC.php");
  }
  elseif($deadline > $extentiondeadline){
    echo "deadline is before extention deadline";
    header("refresh:1.5;url=ApplyEC.php");
  }
  elseif($extentiondeadline > date('Y-m-d', strtotime($deadline. ' + 14 days'))){
    echo "extention deadline is greater than 2 weeks";
    header("refresh:1.5;url=ApplyEC.php");
  }
  else{
    submitEC($module, $description,$deadline, $extentiondeadline, $isselfcertified);
  }
  

}

function submitEC($module, $description,$deadline, $extentiondeadline, $isselfcertified){
  $conn = new mysqli("eecs-plus.cyvzc0wdkfgr.eu-north-1.rds.amazonaws.com:3306","admin","password123","eecs");
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  //Vars needed to add EC to database
  $USERID = $_SESSION['user_id'];
  $status = "Pending";

  //Uncomment to see what was inserted for debugging
  //echo "Inserted values ",$USERID, " ",$module," ",$description, " ",$extentiondeadline," ",$isselfcertified," ", Status::Pending;
  //Insert EC into database
  $sql = "INSERT INTO ECs (userID,ModuleName,description,DeadLine,RequestedExtentionDeadline,isSelfCertified,Status) VALUES ('$USERID','$module', '$description', '$deadline','$extentiondeadline', '$isselfcertified', '$status')";

  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    header("refresh:0.9;url=ApplyEC.php");
    if ($_SESSION['user_type'] == 'Admin'){
      header('Location: ../pages/adminLanding.php');
      
    }
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }


  $conn->close();
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
          <button type="button" id="LogoutButton" class="btn btn-outline-dark ">
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
                <li class="nav-item dropdown ml-1">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Submit
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php
                      if ($userType !== 'Faculty') {
                        echo '<a class="dropdown-item" href="ApplyEC.php">Submit ECs</a>';
                      }
                      ?>
                      <a class="dropdown-item" href="ReportIssues.php">Submit Issue</a>
                    </div>
                </li>
                <li class="nav-item dropdown ml-1">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    View
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="EECSServices.php">View EECS Services</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="ViewEC.php">View your ECs</a>
                      <a class="dropdown-item" href="ViewYourIssues.php">View your issues</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="ViewAllIssues.php">View all issues</a>
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


    <div class="jumbotron" id="jumbotron">
      <h1 class="text-center mb-4">Apply for ECs</h1>
        <!-- aplication form fill out  module name , description ,  ExtentionDeadline , dropdown menu for if it self certfied or not-->
        <form action="" method="post" target="_self" onsubmit="return validateForm()">

        <div class="form-outline mb-4">
          <input type="text" class="form-control" placeholder="module name" name="moduleName" required maxlength="100" />
        </div>

        <div class="form-outline mb-4">
          <textarea class="form-control" id="exampleFormControlTextarea1" rows="10" placeholder="description" name="description" required maxlength="500"></textarea>
        </div>

        <div class="form-outline mb-4">
          <label for="DeadLine"> Deadline </label>
          <input type="date" class="form-control" id="dealine" name="DeadLine" placeholder="Deadline - MM/DD/YYYY">
        </div>

        <div class="form-outline mb-4">
        <label for="RequestedExtentionDeadline"> Requested Extention </label>
          <input type="date" class="form-control" id="RequestedExtentionDeadline" name="RequestedExtentionDeadline" placeholder="Requested Extension Date - MM/DD/YYYY">
        </div>

        <div class="form-outline mb-4">
          <select name="type" id="type" class="form-select form-select-sm mb-3" required maxlength="20" minlength="3">
            <option value="Self Certified">Self Certified</option>
            <option value="Manual">Manual</option>
          </select>
        </div>

        <div class="text-center pt-1 mb-5 pb-1">
          <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" id="submitEC" type="submit">Submit</button>
        </div>

      </form>   


        




    </div>

    <script>
  function validateForm() {
    var moduleName = document.forms[0]["moduleName"].value;
    var description = document.forms[0]["description"].value;
    var deadline = document.forms[0]["DeadLine"].value;
    var extension = document.forms[0]["RequestedExtentionDeadline"].value;
    var type = document.forms[0]["type"].value;

    if (moduleName == "" || description == "" || deadline == "" || extension == "" || type == "") {
      alert("All fields are required!");
      return false;
    }

    return true;
  }
</script>




    
    <script src="../js/LPutils.js" type="module"></script>
    <!--Scripts for button functionality-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

</body>

    <footer class="container">
        <p>&copy; Group 26 QMUL EECS</p>
  </footer>
</html>
