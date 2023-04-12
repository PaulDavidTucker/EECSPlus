<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image" href="../assets/QMUL Logo.png">
    <link rel="stylesheet" href="../css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    <!--Icons stylesheet-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>

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

</html>