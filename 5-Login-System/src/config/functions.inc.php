<?php

// *Registration Form
// make function for check required empty
function emptyInputRegistration($name, $email, $userName, $password, $rePassword) {
    $result = false;

    if (empty($name) || empty($email) || empty($userName) || empty($password) || empty($rePassword)) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

// make function to check username validation
function invalidUid($userName) {
    $result = false;

    if (!preg_match("/^[a-zA-Z0-0]*$/", $userName)) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

// make function to check email validation
function invalidEmail($email) {
    $result = false;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

// make function to check password and re-password match
function pwdMatch($password, $rePassword) {
    $result = false;

    if ($password !== $rePassword) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

// make function to check username already exits in database
function uidExists($connect, $userName, $email) {
    $sql = "SELECT * FROM users WHERE usersName = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($connect);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ./../app/registration.php?error=stmtFailedAlreadyExists");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $userName, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

// make function to create a new user
function createUser($connect, $name, $email, $userName, $password) {
    $sql = "INSERT INTO users (usersName, usersEmail, usersUid, UsersPwd) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($connect);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ./../app/registration.php?error=stmtFailed");
        exit();
    }

    // hashed / encrypted password
    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $userName, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: ./../app/login.php");
    exit();
}

// *LogIn Form
// make function to required empty
function emptyInputLogin($nameOrEmail, $password) {
    $result = false;

    if (empty($nameOrEmail) || empty($password)) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

// make function to login mechanism
function userLogIn($connect, $userNameOrEmail, $password) {
    $uidExists = uidExists($connect, $userNameOrEmail, $userNameOrEmail);

    if ($uidExists === false) {
        header("Location: ./../app/login.php?error=wrongLogin");
        exit();
    }

    $hashedPwd = $uidExists['userPwd'];
    $checkPwd = password_verify($password, $hashedPwd);

    if ($checkPwd === false) {
        header("Location: ./../app/login.php?error=wrongLogin");
        exit();
    } else if ($checkPwd === false) {
        session_start();
        $_SESSION["usersId"] = $uidExists["usersId"];
        $_SESSION["usersUid"] = $uidExists["usersUid"];
        header("Location: ./../../index.php");
        exit();
    }
}
