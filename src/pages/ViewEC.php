<?php 
session_start();

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
elseif ($_SESSION['user_type'] == 'Admin'  ){
  header('Location: ../pages/adminPages/adminLanding.php');
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

    <div class="container-fluid text-center">
      <h1>View your ECs</h1>
    </div>

    <div class="container-fluid text-center">
      <div class="container mb-2" id="yourEC-details">
          <?php 

          $username = $_SESSION['username'];
          
          if (!isset($_SESSION['user_id']  ) ) {
            header('Location: ../index.php');
            exit();
          }
          elseif ($_SESSION['user_type'] == 'Admin'){
            header('Location: ../pages/adminPages/adminLanding.php');
            exit();
          }

          $conn = mysqli_connect("eecs-plus.cyvzc0wdkfgr.eu-north-1.rds.amazonaws.com:3306","admin","password123","eecs");

          if (!$conn) {
              die("Connection failed: " . mysqli_connect_error());
          }

          $ID = $_SESSION['user_id'];
          //Retrieve data from the database
          $query = "
          SELECT `ECs`.`id`,
          `ECs`.`userID`,
          `ECs`.`ModuleName`,
          `ECs`.`description`,
          `ECs`.`DateCreated`,
          `ECs`.`DeadLine`,
          `ECs`.`RequestedExtentionDeadline`,
          `ECs`.`isSelfCertified`,
          `ECs`.`Status`,
          `user`.`userName`,
          `user`.`userType`
          FROM `eecs`.`ECs`
          JOIN `eecs`.`user` ON `ECs`.`userID` = `user`.`id` WHERE `ECs`.`userID` = '$ID';

          
          
          ";
          $result = mysqli_query($conn, $query);

          if ($result -> num_rows == 0) {
              echo "<h3>You have no ECs!</h3>";
          } else {
              //Display the data in a table
              echo "<table id='YourIssuesTable' class='table table-hover'>";
              echo "<thead><tr><th>ID</th><th>Module Name</th><th>Status</th><th>Date Created</th></tr></thead><tbody>";
              while ($row = mysqli_fetch_assoc($result)) {
                  echo "<tr>";
                  echo "<td>" . $row["id"] . "</td>";
                  echo "<td style='display:none;'>" . $row["userID"] . "</td>";
                  echo "<td style='display:none;'>" . $row["userName"] . "</td>";
                  echo "<td style='display:none;'>" . $row["userType"] . "</td>";
                  echo "<td>" . $row["ModuleName"] . "</td>";
                  echo "<td style='display:none;' >" . $row["description"] . "</td>";
                  echo "<td style='display:none;'>" . $row["DeadLine"] . "</td>";
                  echo "<td style='display:none;'>" . $row["RequestedExtentionDeadline"] . "</td>";
                  echo "<td style='display:none;'>" . $row["isSelfCertified"] . "</td>";
                  echo "<td>" . $row["Status"] . "</td>";
                  echo "<td>" . $row["DateCreated"] . "</td>";
                  
                  
                  echo "</tr>";
              }
              echo "</tbody></table>";
          }

          mysqli_close($conn);


          ?>
      </div>
</div>
        


</body>



<footer class="container">
    <p></p>
    <p>&copy; Group 26 QMUL EECS</p>
</footer>

<script >

function deleteEC(id) {
    console.log(id);
  if (confirm("Are you sure you want to delete this EC?")) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        alert(this.responseText);
        window.location.href = "ViewEC.php";
      }
    };
    
    xhttp.open("GET", "adminPages/deleteEC.php?id=" + id, true);
    xhttp.send();
  }
}


const table = document.getElementById("YourIssuesTable");

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
        const moduleName = rowArray[4].innerHTML;
        const Descirption = rowArray[5].innerHTML;
        const deadline = rowArray[7].innerHTML;
        const extensionDeadline = rowArray[7].innerHTML;
        const selfCertified = rowArray[8].innerHTML;
        const status = rowArray[9].innerHTML;
        const dateCreated = rowArray[10].innerHTML;

        // Create the HTML for the details
        const html = `
        <div class="container">
        <form action="" method="post" >
  <table class="table table-bordered">
    <tbody>
      <tr>
        <th>ID:</th>
        <td >${id}</td>
        <input type="hidden" name="id" value="${id}">
      </tr>
      <tr>
        <th>User ID:</th>
        <td>${userID}</td>
        
      </tr>
      <tr>
        <th>username:</th>
        <td>${username}</td>
        
      </tr>

      <tr>
        <th>User Type:</th>
        <td>${userType}</td>
        
      </tr>
      <tr>
        <th>Module Name:</th>
        <td>${moduleName}</td>
      </tr>
      <tr>
        <th>EC Description:</th>
        <td>${Descirption}</td>
      </tr>
      <tr>
        <th>Work Deadline:</th>
        <td>${deadline}</td>
      </tr>
      <tr>
        <th>Requested Extension Date:</th>
        <td>${extensionDeadline}</td>
      </tr>
      <tr>
        <th>Self Certified:</th>
        <td>${selfCertified}</td>
      </tr>
      <tr>
        <th>Status:</th>
        <td>${status}</td>
      </tr>
      <tr>
        <th>Date Created:</th>
        <td>${dateCreated}</td>
      </tr>
    </tbody>
  </table>
    
        <button class="btn btn-secondary mb-2"  type="button" onclick="location.reload()">Back</button>
        <button class="btn btn-secondary mb-2" type="button" onclick=deleteEC('${id}')>Delete</button>
    </form>
    
</div>  `;

        // Render the HTML in the #ec-details div
        const ecDetails = document.getElementById('yourEC-details');
        ecDetails.innerHTML = html;
    });




}





</script>



    
<script src="../js/index.js" type="module"></script>
    <script src="../js/LPutils.js" type="module"></script>
    <!--Scripts for button functionality-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

</html>
