<?php

require_once "function.php";

$id = $_GET["id"] ?? null;
if (!$id) {
    header("Location: ./../../index.php");
    exit();
}

// connection database
$pdo = new PDO(
    "mysql:host=sql6.freemysqlhosting.net;port=3306;dbname=sql6431367", "sql6431367", "hmlJ5CVNuK"
);

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$statement = $pdo->prepare("SELECT * FROM products WHERE id = :id");
$statement->bindValue(":id", $id);
$statement->execute();
$product = $statement->fetch(PDO::FETCH_ASSOC);

$title = $product["title"];
$description = $product["description"];
$price = $product["price"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $price = $_POST["price"];

    $image = $_FILES["image"] ?? null;
    $imagePath = "";

    if (!is_dir("images")) {
        mkdir("images");
    }

    if ($image) {
        if ($product["image"]) {
            unlink($product["image"]);
        }
        $imagePath = "images/" . randomString(8) . "/" . $image["name"];
        mkdir(dirname($imagePath));
        move_uploaded_file($image["tmp_name"], $imagePath);
    }

    if (!$title) {
        $errors[] = "Product title is required";
    }

    if (!$price) {
        $errors[] = "Product price is required";
    }

    if (empty($errors)) {
        $statement = $pdo->prepare("UPDATE products SET title = :title,
                                        image = :image,
                                        description = :description,
                                        price = :price WHERE id = :id");
        $statement->bindValue(":title", $title);
        $statement->bindValue(":image", $imagePath);
        $statement->bindValue(":description", $description);
        $statement->bindValue(":price", $price);
        $statement->bindValue(":id", $id);

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
    <title>Update Your Product</title>

    <!-- External CSS -->
    <!-- <link rel="stylesheet" href="./../css/style.css"> -->
    <!-- css reload in php file -->
    <link rel="stylesheet" href="./../css/style.css?v=<?php echo time(); ?>">

    <!-- Favicon -->
    <link rel="shortcut icon" href="./../img/favicon.png" type="image/png">
  </head>
  <body>
    <div class="container">
      <h2 id="header">Update Product <b><?php echo $product[
    "title"
]; ?></b></h2>

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
        <!-- display product image -->
        <?php if ($product["image"]): ?>
          <img class="img-product" src="<?php echo $product[
    "image"
]; ?>" alt="product-image">
        <?php endif;?>

        <!-- // go back home button -->
        <p><a href="./../../index.php" type='button' class="btn btn-dark">Go Back To Product</a></p>

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
          <button type="submit" class="btn btn-md btn-primary">Update</button>
        </div>
      </form>
    </div>
  </body>
</html>
