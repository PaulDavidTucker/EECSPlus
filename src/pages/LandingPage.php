
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
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
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


    <div class="jumbotron" id="jumbotron">
        <h1 class="display-4">Welcome, <?php echo $username; ?></h1>
        <p class="lead">Welcome to EECS Plus! Here you can report issues with services, browse the status of products or simply view the site.</p>
            <!--Jumbotron for main page
    STYLE ATTRIBUTE LEFT EMPTY TO ALLOW JS TO DYNAMICALLY UPDATE COLOURS WHEN DARKMODE IS ENABLED
        <hr class="my-4">
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe sint perspiciatis doloremque accusamus adipisci. Officiis, eaque in ea sapiente, consectetur repellat consequatur assumenda deleniti commodi cupiditate, quasi explicabo quis eligendi?</p>
        <p class="lead">
          <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
        </p>
        
    -->
    </div>


    <div class="container">
        <!-- Row of columns, can add more if needed. Use JS to make columns appear or disapear when logged in -->
        <div class="row">
          <div class="col-md-4">
            <h2>Apply for ECs</h2>
            <p>

            </p>
            <p><a class="btn btn-secondary" href="ApplyEC.php" role="button">click &raquo;</a></p>
          </div>
          <div class="col-md-4">
            <h2>Report Issue</h2>
            <p> </p>
            <p><a class="btn btn-secondary" href="ReportIssues.php" role="button">click &raquo;</a></p>
          </div>
          <div class="col-md-4">
            <h2>Heading</h2>
            <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
            <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
          </div>
        </div>

        <hr>

      </div> <!-- container end -->

    
    <script src="../js/LPutils.js" type="module"></script>
    <!--Scripts for button functionality-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

    <footer class="container">
        <p>&copy; Group 26 QMUL EECS</p>
  </footer>
</html>


<!---->