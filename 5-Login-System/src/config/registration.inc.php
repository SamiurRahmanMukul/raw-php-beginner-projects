<?php

// db config file include
require_once './dbh.inc.php';
require_once './functions.inc.php';

// get data at form
$name = $_POST["name"];
$email = $_POST["email"];
$userName = $_POST["userName"];
$password = $_POST["password"];
$rePassword = $_POST["re-password"];

// validation check
// empty field
if (emptyInputRegistration($name, $email, $userName, $password, $rePassword) !== false) {
    header("Location: ./../app/registration.php?error=emptyInput");
    exit();
}
// incorrect / invalid username
if (invalidUid($userName) !== false) {
    header("Location: ./../app/registration.php?error=invalidUsername");
    exit();
}
// incorrect / invalid email
if (invalidEmail($email) !== false) {
    header("Location: ./../app/registration.php?error=invalidEmail");
    exit();
}
// password not match
if (pwdMatch($password, $rePassword) !== false) {
    header("Location: ./../app/registration.php?error=passwordDoNotMatch");
    exit();
}

// username and email already exits
if (uidExists($connect, $userName, $email) !== false) {
    header("Location: ./../app/registration.php");
    exit();
}

// create a new user
createUser($connect, $name, $email, $userName, $password);

// when all functionality done go login page
header("Location: ./../app/login.php");
