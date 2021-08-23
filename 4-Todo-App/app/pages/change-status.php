<?php

$jsonFile = file_get_contents('./../config/todo.json');
$jsonArray = json_decode($jsonFile, true);

$todoName = $_POST['todo_name'];
$jsonArray[$todoName]['completed'] = !$jsonArray[$todoName]['completed'];

file_put_contents('./../config/todo.json', json_encode($jsonArray, JSON_PRETTY_PRINT));

header('Location: ./../../index.php');
