<?php

$connection = require_once './Connection.php';

$id = $_POST['id'] ?? '';
if ($id) {
    $connection->updateNote($id, $_POST);
} else {
    $connection->addNotes($_POST);
}

header("Location: ./../index.php");
