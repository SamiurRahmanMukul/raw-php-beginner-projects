<?php

/* echo '<pre>';
var_dump($_POST);
echo '</pre>'; */

$todoText = $_POST['todo-text'] ?? '';
$todoText = trim($todoText);

if ($todoText) {
    $jsonFile = "./../config/todo.json";

    if (file_exists($jsonFile)) {
        $todoJSON = file_get_contents($jsonFile);

        // makes associative array
        $jsonArray = json_decode($todoJSON, true);
    }

    // include text in json file
    $jsonArray[$todoText] = ['completed' => false];
    file_put_contents($jsonFile, json_encode($jsonArray, JSON_PRETTY_PRINT));
}

header("Location: ./../../index.php");
