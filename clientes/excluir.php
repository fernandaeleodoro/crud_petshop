<?php

include("../conexao.php");

$id = $_GET["id"];

$sql = "DELETE FROM clientes
        WHERE id_cliente = ?";

$stmt = $conexao->prepare($sql);

$stmt->bind_param("i", $id);

$stmt->execute();

header("Location: listar.php");

exit;

?>