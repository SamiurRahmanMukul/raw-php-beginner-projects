<?php

$todoJsonFile = './app/config/todo.json';

$todo_s = [];

if (file_exists($todoJsonFile)) {
    $todoJSON = file_get_contents($todoJsonFile);
    $todo_s = json_decode($todoJSON, true);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo App / PHP Project</title>

    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="shortcut icon" href="./assets/img/favicon.png" type="image/png">
</head>
<body>
    <!-- header section -->
    <header class="header-section">
        <div class="brand-info">
            <h1 class="brand-title">Todo App / PHP & File System</h1>
        </div>
    </header>

    <!-- main / body section -->
    <main class="main-section">
        <!-- section input group -->
        <div class="form-container">
            <form action="./app/pages/new-todo.php" method="post">
                <input type="text" name="todo-text" placeholder="Enter here your ToDo text" required class="todo-text">
                <button type="submit" class="todo-submit">Add Todo</button>
            </form>
        </div> <hr class="hr-line">

        <!-- section todo item view -->
        <section class="todo-section">
            <?php foreach ($todo_s as $todoName => $todo): ?>
                <div class="todo-item">
                    <form action="./app/pages/change-status.php" method="post" class="todo-form">
                        <input type="hidden" name="todo_name" value="<?php echo $todoName ?>">
                        <input type="checkbox" <?php echo $todo['completed'] ? 'checked' : ''; ?>>
                    </form>

                    <?php echo $todoName ?>;

                    <!-- <a href="./app/pages/delete-todo.php?todo_name=<?php echo $todoName; ?>" class="todo-delete">Delete</a> -->

                    <form action="./app/pages/delete-todo.php" method="post" class="todo-form">
                        <input type="hidden" name="todo_name" value="<?php echo $todoName ?>">
                        <button class="todo-delete">Delete</button>
                    </form>
                </div>
            <?php endforeach;?>
        </section>
    </main>

    <script>
        const checkboxes = document.querySelectorAll('input[type=checkbox]');

        checkboxes.forEach(ch => {
            ch.onclick = function() {
                this.parentNode.submit();
            };
        });
    </script>
</body>
</html>
