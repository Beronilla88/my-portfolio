<?php
//DATABASE CONNECTION
$host = "localhost";
$username = "root";
$password = "";
$database = "kkk";

$sqlink = mysqli_connect($host, $username, $password, $database) or die('Could not connect' . mysqli_connect_error());

?>