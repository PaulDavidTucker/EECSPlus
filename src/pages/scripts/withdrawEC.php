<?php
session_start();

$conn = mysqli_connect("eecs-plus.cyvzc0wdkfgr.eu-north-1.rds.amazonaws.com:3306","admin","password123","eecs");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

