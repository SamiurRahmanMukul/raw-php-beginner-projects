<?php

// required needed files
require_once './dbh.inc.php';
require_once './functions.inc.php';

// get data in form
$userNameOrEmail = $_POST['nameOrEmail'];
$password = $_POST['password'];

if (emptyInputLogin($nameOrEmail, $password) !== false) {
    header("Location: ./../app/login.php?error=emptyInput");
    exit();
} else {
    userLogIn($connect, $userNameOrEmail, $password);
}
