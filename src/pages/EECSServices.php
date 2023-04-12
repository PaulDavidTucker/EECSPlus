<?php 
session_start();

$username = $_SESSION['username'];
$userType = $_SESSION['user_type'];

if (!isset($_SESSION['user_id']  ) ) {
  header('Location: ../index.php');
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
    <?php include 'topNav.php';?>
    
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
      <h1>EECS Services</h1>
    </div>

    <div class="container mb-2">
      <?php   

      $conn = mysqli_connect("eecs-plus.cyvzc0wdkfgr.eu-north-1.rds.amazonaws.com:3306","admin","password123","eecs");

      if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      }

      //Retrieve data from the database
      $query = "SELECT * FROM EECS_Services";
      $result = mysqli_query($conn, $query);

      if($_SESSION['user_type']!='Admin'){
        //Display the data in a table
        echo "<table id='ecTable' class='table table-hover'>";
        echo "<tr><th scope=",'col',">Service</th><th scope=",'col',">Description</th><th scope=",'col',">Status</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr class='clickableRow'>";
          echo "<td>" . $row["Service"] . "</td>";
          echo "<td>" . $row["Description"] . "</td>";
          echo "<td>" . $row["Status"] . "</td>";
          echo "</tr>";
        }
        echo "</table>";
      }

      else{
        echo "<table id='ecTable' class='table table-hover'>";
        echo "<tr><th scope=",'col',">Service</th><th scope=",'col',">Description</th><th scope=",'col',">Status</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr class='clickableRow'>";
          echo "<td>" . $row["Service"] . "</td>";
          echo "<td>" . $row["Description"] . "</td>";
          echo "<td>
                <form action ='' method ='post' targer = '_self'>
                    <select name='status' id ='status'  class = 'form-select form-select-sm mb-3'>
                    <option value=''>" . $row["Status"] . "</option>";
                    if($row["Status"]!=="Running"){ echo "<option value='Running'>Running</option>";}
                    if($row["Status"]!=="Suspended"){echo "<option value='Suspended'>Suspended</option>";}
                    if($row["Status"]!=="Unavailable"){echo "<option value='Unavailable'>Unavailable</option>";}          
          echo "<input class='btn btn-primary btn-block fa-lg gradient-custom-2 mb-3' id='LoginButton' type='submit'>";          
          echo "</td>";
          echo "</tr>";
        }
        echo "</table>";



      }
      mysqli_close($conn);

      ?>      
    </div>

    <?php
        if($_SESSION['user_type']=='Admin'){
    ?>
    <div id="OptionsBar" class="container">
      <div class = "row justify-content-center">
        <div class="col-2 mx-auto">
          <form action="" method="" target="">
            <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
              Update
            </button>
          </form>
        </div>
      </div>
    </div>

    <?php
        }
    ?>
    
</body>



<!-- Footer -->
<?php include 'footer.php';?>

</html>
