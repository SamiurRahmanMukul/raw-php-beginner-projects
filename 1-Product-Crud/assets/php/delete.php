<?php

// connection database
$pdo = new PDO(
    "mysql:host=sql6.freemysqlhosting.net;port=3306;dbname=sql6431367", "sql6431367", "hmlJ5CVNuK"
);

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id = $_POST["id"] ?? null;

if (!$id) {
    header("Location: ./../../index.php");
    exit();
}

// delete product using MySQL delete query
$statement = $pdo->prepare("DELETE FROM products WHERE id = :id");
$statement->bindValue(":id", $id);
$statement->execute();

// after delete successfully go back index.php
header("Location: ./../../index.php");
