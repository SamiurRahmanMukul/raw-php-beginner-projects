<?php

require_once "function.php";

// connection database
$pdo = new PDO(
    "mysql:host=sql6.freemysqlhosting.net;port=3306;dbname=sql6431367", "sql6431367", "hmlJ5CVNuK"
);

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$errors = [];

$title = "";
$description = "";
$price = "";

// request method check
// echo $_SERVER["REQUEST_METHOD"] === "POST" . "<br/>";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $price = $_POST["price"];

    $image = $_FILES["image"] ?? null;
    $imagePath = "";

    if (!is_dir("images")) {
        mkdir("images");
    }

    if ($image && $image["tmp_name"]) {
        $imagePath = "images/" . randomString(8) . "/" . $image["name"];
        mkdir(dirname($imagePath));
        move_uploaded_file($image["tmp_name"], $imagePath);
    }

    // required check
    if (!$title) {
        $errors[] = "Product title is required";
    }
    if (!$price) {
        $errors[] = "Product price is required";
    }

    // if no error database insert data
    if (empty($errors)) {
        // method one
        /* $statement = $pdo->exec("INSERT INTO products (title, image, description, price, create_date)
        VALUES ('$title, $image, $description, $price, $date')"); */

        // method two
        $statement = $pdo->prepare("INSERT INTO products (title, image, description, price, create_date)
                                VALUES (:title, :image, :description, :price, :date)");
        $statement->bindValue(":title", $title);
        $statement->bindValue(":image", $imagePath);
        $statement->bindValue(":description", $description);
        $statement->bindValue(":price", $price);
        $statement->bindValue(":date", date("Y-m-d H:i:s"));

        $statement->execute();
        header("Location: ./../../index.php");
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Webpage Title -->
    <title>Create New Product</title>

    <!-- External CSS -->
    <link rel="stylesheet" href="./../css/style.css">

    <!-- Favicon -->
    <link rel="shortcut icon" href="./../img/favicon.png" type="image/png">
  </head>
  <body>
    <div class="container">
      <h2 id="header">Create New Product</h2>

      <!-- // go back home button -->
      <p><a href="./../../index.php" type='button' class="btn btn-dark">Go Back To Product</a></p>

      <!-- required / validation alert -->
      <?php if (!empty($errors)): ?>
      <div class="alert alert-danger">
          <?php foreach ($errors as $error): ?>
              <div><?php echo $error; ?></div>
          <?php endforeach;?>
      </div>
    <?php endif;?>

    <!-- bootstrap form -->
      <form method="post" enctype="multipart/form-data" class="form-control">
        <div class="form-group">
            <label>Product Image</label><br>
            <input type="file" name="image">
        </div> <br>
        <div class="form-group">
            <label>Product title</label>
            <input type="text" name="title" class="form-control" value="<?php echo $title; ?>">
        </div> <br>
        <div class="form-group">
            <label>Product description</label>
            <textarea class="form-control" name="description"><?php echo $description; ?></textarea>
        </div> <br>
        <div class="form-group">
            <label>Product price</label>
            <input type="number" step=".01" name="price" class="form-control" value="<?php echo $price; ?>">
        </div> <br>

        <div class="d-grid gap-2">
          <button type="submit" class="btn btn-md btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </body>
</html>
