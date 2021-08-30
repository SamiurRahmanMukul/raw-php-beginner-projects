<?php

$serverName = "sql6.freemysqlhosting.net";
$dbName = "sql6431367";
$port = 3306;
$userName = "sql6431367";
$password = "hmlJ5CVNuK";

$connect = mysqli_connect($serverName, $dbName, $password, $userName);

if (!$connect) {
    die("Sorry! connection failed." . mysqli_connect_error());
}
