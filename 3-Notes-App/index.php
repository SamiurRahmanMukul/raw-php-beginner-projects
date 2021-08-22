<?php

$connection = require_once './config/Connection.php';
$notes = $connection->getNotes();

$currentNote = [
    'id' => '',
    'title' => '',
    'description' => '',
];

if (isset($_GET['id'])) {
    $currentNote = $connection->getNoteById($_GET['id']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- webpage title -->
    <title>Notes App / PHP & MySQL</title>

    <!-- external css -->
    <link rel="stylesheet" href="./assets/css/style.css">

    <!-- favicon -->
    <link rel="shortcut icon" href="./assets/img/favicon.png" type="image/png">
</head>
<body>
    <!-- header -->
    <div class="container">
        <h1 class="heading"> Notes App / PHP & MySQL</h1>
    </div>

    <!-- notes input group -->
    <div class="container-form">
        <form action="./config/create-note.php" method="post" class="new-notes">
            <input type="hidden" name="id" value="<?php echo $currentNote['id']; ?>">

            <input type="text" name="title" placeholder="Note Title" required autocomplete="off" value="<?php echo $currentNote['title']; ?>" class="title">

            <textarea name="description" cols="30" rows="4" placeholder="Note Description" required class="description"><?php echo $currentNote['description']; ?></textarea>

            <button type="submit" class="submit-btn">
                <?php echo $currentNote['id'] ? "Update Note" : "New Note" ?>
            </button>
        </form>
    </div>

    <!-- notes view -->
    <div class="container-notes">
        <?php foreach ($notes as $note): ?>
            <div class="notes">
                <!-- note delete button -->
                <form action="./config/delete-note.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $note['id']; ?>">
                    <button class="note-delete">X</button>
                </form>

                <!-- note title -->
                <div class="note-title">
                    <a href="?id=<?php echo $note['id'] ?>"><?php echo $note['title']; ?></a>
                </div>
                <!-- note description -->
                <div class="note-description">
                    <p><?php echo $note['description']; ?></p>
                </div>
                <!-- note write date -->
                <small class="note-time"><?php echo $note['create_date']; ?></small>
            </div>
        <?php endforeach;?>
    </div>
</body>
</html>
