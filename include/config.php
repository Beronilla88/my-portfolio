<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "kkk";

$sqlink = mysqli_connect($host, $username, $password, $database);


if (!$sqlink) {
    die('Could not connect: ' . mysqli_connect_error());
} 
?>
