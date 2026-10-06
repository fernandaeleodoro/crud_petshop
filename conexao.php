<?php

$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "crud_petshop";

$conn = mysqli_connect($host, $usuario, $senha, $banco);

if (!$conn) {
    die("Erro na conexão: " . mysqli_connect_error());
}

?>


