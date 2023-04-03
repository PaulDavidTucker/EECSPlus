<?php
session_start();

// Destroy all session data
$_SESSION = array();
session_destroy();

// Redirect to login page
header("location: index.php");
exit();
?>