

<?php 
session_start();

if (isset($_SESSION['user_id'])) {
  if ($row['userType'] == 'Admin') {
    header('Location: pages/adminLanding.php');
  } else {
    header('Location: pages/LandingPage.php');
}
  
}

$dbhost = "eecs-plus.cyvzc0wdkfgr.eu-north-1.rds.amazonaws.com:3306";
$dbuser = "admin";
$dbpass = "password123";
$dbname = "eecs";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
	die("failed to connect!");
}

if (isset($_POST['username']) && isset($_POST['password'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  login($username, $password);
}

function login($username, $password) {
  $conn = new mysqli("eecs-plus.cyvzc0wdkfgr.eu-north-1.rds.amazonaws.com:3306","admin","password123","eecs");
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $sql = "SELECT * FROM user WHERE userName = '$username' AND password = '$password'";
  $result = $conn->query($sql);

  if ($result->num_rows == 1) {
      $row = $result->fetch_assoc();
      // Set session variables, UserID is the ID collected from the database
      $_SESSION['user_id'] = $row['id'];
      $_SESSION['user_type'] = $row['userType'];
      $_SESSION['username'] = $username;
      if ($row['userType'] == 'Admin') {
          header('Location: pages/adminLanding.php');
      } else {
          header('Location: pages/LandingPage.php');
      }
      exit();
  } else {
      echo "Invalid username or password.";
  }

  $conn->close();
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EECSPlus Home</title>
    <link rel="icon" type="image" href="assets/QMUL Logo.png">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
    <section class="h-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div id="test" class="col-xl-10">
              <div class="card rounded-3 text-black">
                <div class="row g-0">
                  <div class="col-lg-6">
                    <div class="card-body p-md-5 mx-md-4"> 
      
                      <div class="text-center">
                        <img src="assets/QMUL Logo.png"
                          style="width: 10em;" alt="logo">
                        <h4 class="mt-1 mb-5 pb-1">Queen Mary University of London </h4>
                        <h3 class="mt-1 mb-5 pb-1">EECS feedback system login</h3>
                      </div>
                      
                      <!--Action script to be added here. Method is post by default becuase idk what we want to do yet
                      target is self atm beucase we want login to authenticate not open new window-->
                      <form action="" method="post" target="_self">
                        <p>Please login to your account</p>
      
                        <div class="form-outline mb-4">
                          <input type="text" class="form-control"
                            placeholder="Username or Email address" name="username" />
                          <label class="form-label">Username</label>
                        </div>
      
                        <div class="form-outline mb-4">
                          <input type="password" class="form-control" name="password" />
                          <label class="form-label">Password</label>
                        </div>
      
                        <div class="text-center pt-1 mb-5 pb-1">
                          <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" id="LoginButton" type="submit">Log
                            in</button>
                          <a class="text-muted" href="#!">Forgot password?</a>
                        </div>
      
                        <div class="d-flex align-items-center justify-content-center pb-4">
                          <p class="mb-0 me-2 pr-4">Don't have an account?</p>
                          <button type="button" id="AdminLogin" class="btn btn-outline-danger">Create new</button>
                        </div>
      
                      </form>
      
                    </div>
                  </div>
                  <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                    <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                      <h4 class="mb-4">Check out our latest newsboard!</h4>
                      <p class="small mb-0">EECS Plus is a website that provides a platform for students and faculty to report any issues with EECS services and facilities.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

</body>
<!--

<script type="module" src="js/index.js"></script>
<script type="module" src="js/classes.js"></script>



-->


</html>


