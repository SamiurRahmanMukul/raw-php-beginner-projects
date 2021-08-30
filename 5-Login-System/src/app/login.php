<?php

$err_msg = "";

// validation check then set error message
if (isset($_GET['error'])) {
    if ($_GET['error'] == 'emptyInput') {
        $err_msg = "Sorry! Login form all filed is required. Please input all field. Thanks";
    } else if ($_GET['error'] == 'wrongLogin') {
        $err_msg = "Sorry! LogIn failed. Incorrect your Username or Password. Try to again. Thanks";
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
    <title>Login System / LogIn</title>

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
      <h1 class="form-title">Login System / LogIn</h1>

      <!-- validation message -->
      <div class="valid-msg">
        <h4><?php echo $err_msg; ?></h2>
      </div>

        <form action="./../config/login.inc.php" method="post">
          <!-- input group / email -->
          <label for="nameOrEmail">Your Email / Username</label>
          <input
            type="text"
            name="nameOrEmail"
            id=""
            placeholder="Type here your email or username"
          />
          <!-- input group / password -->
          <label for="password">Password</label>
          <input
            type="password"
            name="password"
            id=""
            placeholder="Type here a password"
          />
          <!-- input group / submit button -->
          <button type="submit" class="btn-submit">LogIn</button>

        </form>

        <!-- go-login page -->
        <div class="go-login">
          Are you not registration? <a href="./registration.php">Registration Now</a>
        </div>
    </section>

    <!-- script / JS -->
    <script src="./../script/main.js"></script>
  </body>
</html>
