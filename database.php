<?php

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "kachow";
$dbName = "login_register";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("This page does not work;");
}

?>
