
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

    <?php include 'sideNav.html';?>
    
    <div class="col py-3">
        <!-- Page Content -->
        <div id="page-content-wrapper">

            <?php include 'topNav.html';?>

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
