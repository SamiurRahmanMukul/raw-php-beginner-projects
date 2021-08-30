<?php

$err_msg = "";

// validation check then set error message
if (isset($_GET['error'])) {
    if (isset($_GET['error']) == "emptyInput") {
        $err_msg = "Sorry! Registration form all filed is required. Please input all field. Thanks";
    } else if (isset($_GET['error']) == "invalidUsername") {
        $err_msg = "Sorry! Your define 'Username' in invalid. Please input correct 'Username'. Thanks";
    } else if (isset($_GET['error']) == "invalidEmail") {
        $err_msg = "Sorry! Your define 'Email' in invalid. Please input correct 'Email'. Thanks";
    } else if (isset($_GET['error']) == "passwordDoNotMatch") {
        $err_msg = "Sorry! Your define 'Password' and 'Re-Password' not match. Please input correct 'Password'. Thanks";
    } else if (isset($_GET['error']) == "stmtFailedAlreadyExists") {
        $err_msg = "Sorry! Your define 'Username' or 'Email' already exists. Please define unique 'Username' and 'Email'. Thanks";
    } else if (isset($_GET['error']) == "stmtFailed") {
        $err_msg = "Sorry! Something went to wrong. Unsuccessfully to create new user. Try to again. Thanks";
    } else {
        $err_msg = "Sorry! Something went to wrong. Try to again. Thanks";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- webpage title -->
    <title>Login System / Registration</title>

    <!-- external CSS -->
    <link rel="stylesheet" href="./../style/style.css" />

    <!-- linking favicon -->
    <link
      rel="shortcut icon"
      href="./../../public/assets/img/favicon.ico"
      type="image/x-icon"
    />
  </head>
  <body>
    <!-- form section -->
    <section class="form-container">
      <!-- form title -->
      <h1 class="form-title">Login System / Registration</h1>

      <div class="valid-msg">
        <h4><?php echo $err_msg; ?></h2>
      </div>

      <!-- form input-group -->
      <form action="./../config/registration.inc.php" method="post">
        <!-- input group / name -->
        <label for="name">Your Name</label>
        <input
          type="text"
          name="name"
          id=""
          placeholder="Type here your full name"
        />
        <!-- input group / email -->
        <label for="email">Your Email</label>
        <input
          type="email"
          name="email"
          id=""
          placeholder="Type here your email"
        />
        <!-- input group / phone -->
        <label for="userName">Your Username</label>
        <input
          type="text"
          name="userName"
          id=""
          placeholder="Type here your defined username"
        />
        <!-- input group / password -->
        <label for="password">Password</label>
        <input
          type="password"
          name="password"
          id=""
          placeholder="Type here a password"
        />
        <!-- input group / re-password -->
        <label for="re-password">Re-Password</label>
        <input
          type="password"
          name="re-password"
          id=""
          placeholder="Retype your password here"
        />
        <!-- input group / submit button -->
        <button type="submit" class="btn-submit">Registration</button>
      </form>

      <!-- go-login page -->
      <div class="go-login">
        Are you already registration? <a href="./login.php">LogIn Now</a>
      </div>
    </section>

    <!-- script / JS -->
    <script src="./../script/main.js"></script>
  </body>
</html>
