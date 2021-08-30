<?php

session_start();
if (!isset($_SESSION["usersId"])) {
    header("Location: ./login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- webpage title -->
    <title>Login System / Blog</title>

    <!-- external CSS -->
    <link rel="stylesheet" href="./../style/style.css" />

    <!-- linking favicon -->
    <link
      rel="shortcut icon"
      href="./../../public/assets/img/favicon.ico"
      type="image/x-icon"
    />

    <!-- font-awesome CDN -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    />
  </head>
  <body>
    <!-- header section -->
    <header class="header-section">
      <div class="container">
        <!-- navbar section -->
        <nav class="navbar-section">
          <!-- navbar branding -->
          <div class="nav-brand">
            <a href="./../../index.php"><h1>Login System</h1></a>
          </div>

          <!-- navbar menu links -->
          <div class="nav-menu">
            <ul class="nav-links">
              <li><a href="./../../index.php"">Home</a></li>
              <li><a href="./blog.php" id="active-link">Find Blog</a></li>
              <li><a href="./discover.php">About Us</a></li>

              <?php
if (isset($_SESSION["usersId"])) {
    echo '<li><a href="./profile.php">Your Profile</a></li>';
    echo '<li><a href="./../config/logout.inc.php">LogOut</a></li>';
} else {
    echo '<li><a href="./registration.php">Registration</a></li>';
    echo '<li><a href="./login.php">LogIn</a></li>';
}
?>
            </ul>
          </div>

          <!-- navbar toggle button -->
          <!-- <button class="nav-toggle">
            <i class="fas fa-bars"></i>
          </button> -->
        </nav>
      </div>
    </header>

    <!-- main / body section -->
    <!-- <main class="main-section">
      <div class="container"></div>
    </main> -->

    <!-- footer section -->
    <!-- <footer class="footer-section">
      <div class="container"></div>
    </footer> -->

    <!-- script / js -->
    <script src="./../script/main.js"></script>
  </body>
</html>
