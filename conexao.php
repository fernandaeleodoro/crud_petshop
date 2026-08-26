<?php

$host = "localhost";
$db = "aumigos";
$user = "root";
$pass = "root";

try {

    $pdo = new PDO(
        "mysql:host=$host;dbname=$db;charset=utf8mb4",
        $user,
        $pass
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {

    die("Erro na conexão: " . $e->getMessage());

}
?>
