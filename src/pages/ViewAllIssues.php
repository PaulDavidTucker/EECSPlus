<?php 
session_start();

$username = $_SESSION['username'];
$userType = $_SESSION['user_type'];

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
                    <?php
                      if ($userType !== 'Faculty') {
                        echo '<a class="dropdown-item" href="ViewEC.php">View your ECs</a>';
                      }
                      ?>
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
      <h1>All Issues</h1>
    </div>

    <div class="container-fluid text-center">
    <div class="container mb-2" id="ec-details">
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
        $query = "
        SELECT `issues`.`id`,
        `issues`.`userID`,
        `issues`.`description`,
        `issues`.`status`,
        `issues`.`timeCreated`,
        `issues`.`issueType`,
        `user`.`userName`,
        `user`.`userType`
        FROM `eecs`.`issues`
        JOIN `eecs`.`user` ON `issues`.`userID` = `user`.`id`;
        ";

        $result = mysqli_query($conn, $query);

        if ($result -> num_rows == 0) {
            echo "<h3>No issues!</h3>";
        } else {
            //Display the data in a table
            echo "<table id='issueTable' class='table table-hover'>";
            echo "<thead><tr><th>ID</th><th>User ID</th><th>UserName</th><th>User Type</th></th><th>Status</th><th>Issue Type</th><th>Time Created</th></tr></thead><tbody>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["userID"] . "</td>";
                echo "<td>" . $row["userName"] . "</td>";
                echo "<td>" . $row["userType"] . "</td>";
                echo "<td style='display:none'>" . $row["description"] . "</td>";
                echo "<td  >" . $row["status"] . "</td>";;
                echo "<td >" . $row["issueType"] . "</td>";
                echo "<td>" . $row["timeCreated"] . "</td>";
            }
            echo "</tbody></table>";
        }

        mysqli_close($conn);    

        ?>
    </div>
</div>
      
      
      
    </div>


</body>



<footer class="container">
    <p></p>
    <p>&copy; Group 26 QMUL EECS</p>
</footer>





<script >


const table = document.getElementById("issueTable");

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
        const description = rowArray[4].innerHTML;
        const status = rowArray[5].innerHTML;
        const issueType = rowArray[6].innerHTML;
        const timeCreated = rowArray[7].innerHTML;


        // Create the HTML for the details
        const html = `
        <div class="container">
        <form action="" method="post" >
  <table class="table table-bordered">
    <tbody>
        <tr>
            <th scope="row">ID</th>
            <td>${id}</td>
        </tr>
        <tr>
            <th scope="row">User ID</th>
            <td>${userID}</td>
        </tr>
        <tr>
            <th scope="row">Username</th>
            <td>${username}</td>
        </tr>
        <tr>
            <th scope="row">User Type</th>
            <td>${userType}</td>
        <tr>
            <th scope="row">Description</th>
            <td>${description}</td>
        </tr>
        <tr>
            <th scope="row">Status</th>
            <td>${status}</td>
        </tr>
        <tr>
            <th scope="row">Issue Type</th>
            <td>${issueType}</td>
        </tr>
        <tr>
            <th scope="row">Time Created</th>
            <td>${timeCreated}</td>
        </tr>

    </tbody>
  </table>
      
        <button class="btn btn-secondary mb-2"  type="button" onclick="location.reload()">Back</button>
    </form>
    
</div>  `;

        // Render the HTML in the #ec-details div
        const ecDetails = document.getElementById('ec-details');
        ecDetails.innerHTML = html;
    });

}


</script>
</html>
