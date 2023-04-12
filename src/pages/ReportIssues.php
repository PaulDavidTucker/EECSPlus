<?php

use Status as GlobalStatus;

session_start();

//enumarations
enum issueType{
    const EE = "EE";
    const ITL = "ITL";
    const ITS = "ITS";
};

enum status { 
    const Pending = "Pending";
    const Approved = "Resolved";
};

//check if user is logged in
$username = $_SESSION['username'];
$userType = $_SESSION['user_type'];

if (!isset($_SESSION['user_id']  ) ) {
  header('Location: ../index.php');
  exit();
}


if(isset($_POST['description'])&& isset($_POST['type'])){
    $description = $_POST['description'];
    $issueType = $_POST['type'];


    reportIssue($description,$issueType);

}

function reportIssue($description,$issueType){
    $conn = new mysqli("eecs-plus.cyvzc0wdkfgr.eu-north-1.rds.amazonaws.com:3306","admin","password123","eecs");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //Variables to add in issues database
    $USERID = $_SESSION['user_id'];
    $status = "Pending";

    $sql = "INSERT INTO issues (UserID, `description`, `status`, issueType) VALUES ('$USERID', '$description', '$status', '$issueType')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        header("refresh:0.9;url=ReportIssues.php");
        if ($_SESSION['user_type'] == 'Admin'){
            header('Location: ../pages/adminPages/adminLanding.php');
            exit();
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
    <?php include 'topNav.php';?>

    <div class="jumbotron" id="jumbotron">
        <h1 class="text-center mb-4">Report Issues</h1>
        <form action="" method = "post"  target = "_self">

            <div class="form-outline mb-4">
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="10" 
            placeholder="description" name="description" required minlength ="10" maxlength="300"></textarea>
            </div>

            <div class="form-outline mb-4">
            <select name="type" id="type" class="form-select form-select-sm mb-3" required>
              <option value="" disabled selected hidden>Department</option>
              <option value="EE">EE</option>
              <option value="ITL">ITL</option>
              <option value="ITS">ITS</option>
            </select>
            </div>

            <div class="text-center pt-1 mb-5 pb-1">
                <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" id="submitIssue" type="submit">Submit</button>
            </div>

        </form>
    </div>



    <script src="../js/LPutils.js" type="module"></script>
    <!--Scripts for button functionality-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

</body>

<!-- Footer -->
<?php include 'footer.php';?>

</html>