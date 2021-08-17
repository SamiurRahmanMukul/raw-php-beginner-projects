<?php

// connection database
$pdo = new PDO(
    "mysql:host=sql6.freemysqlhosting.net;port=3306;dbname=sql6431367", "sql6431367", "hmlJ5CVNuK"
);

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// ! search in product
$search = $_GET["search"] ?? "";
if ($search) {
    $statement = $pdo->prepare(
        "SELECT * FROM products WHERE title LIKE :title ORDER BY create_date DESC"
    );
    $statement->bindValue(":title", "%$search%");
} else {
    $statement = $pdo->prepare(
        "SELECT * FROM products ORDER BY create_date DESC"
    );
}

$statement->execute();
$products = $statement->fetchAll(PDO::FETCH_ASSOC);

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
    <title>Products Crud</title>

    <!-- External CSS -->
    <link rel="stylesheet" href="./assets/css/style.css">

    <!-- Favicon -->
    <link rel="shortcut icon" href="./assets/img/favicon.png" type="image/png">
  </head>
  <body>
    <div class="container">
      <h2 id="header">Products Crud / PHP Project</h2>

      <!-- functionality options -->
      <div class="controller">
        <a href="./assets/php/create.php" class="btn btn-lg btn-success">Create New Product</a>
      </div>

      <!-- bootstrap input group / search product -->
      <form action="" method="get">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Search your specific product" name="search" value="<?php echo $search; ?>">
          <button class="btn btn-primary" type="submit">Search Product</button>
        </div>
      </form>

      <!-- bootstrap table -->
      <table class="table table-dark table-striped table-hover">
        <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Image</th>
          <th scope="col">Title</th>
          <th scope="col">Price</th>
          <th scope="col">Create Date</th>
          <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($products as $i => $product) {?>
          <tr>
            <th scope="row"><?php echo $i + 1; ?></th>
            <td>
                <?php if ($product["image"]): ?>
                    <img src="<?php echo "./assets/php/" .
        $product["image"]; ?>" alt="<?php echo $product[
        "title"
    ]; ?>" class="img-container">
                <?php endif;?>
            </td>
            <td><?php echo $product["title"]; ?></td>
            <td><?php echo $product["price"]; ?></td>
            <td><?php echo $product["create_date"]; ?></td>

            <!-- action button => edit / delete -->
            <td>
              <!-- // update button -->
              <a href="./assets/php/update.php?id=<?php echo $product[
        "id"
    ]; ?>" type="button" class="btn btn-sm btn-outline-primary">Edit</a>

              <!-- // delete button -->
              <form style="display: inline-block;" action="./assets/php/delete.php" method="post">
                <input type="hidden" name="id" value="<?php echo $product[
        "id"
    ]; ?>">
                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
              </form>
            </td>
          </tr>
        <?php }?>
        </tbody>
      </table>
    </div>
  </body>
</html>
