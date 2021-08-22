<?php

$connection = require_once './Connection.php';
$connection->deleteNote($_POST['id']);

header("Location: ./../index.php");

?>
