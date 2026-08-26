<?php

include("../conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST["nome"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"];

    $sql = "INSERT INTO clientes
            (nome, telefone, email)
            VALUES (?, ?, ?)";

    $stmt = $conexao->prepare($sql);

    $stmt->bind_param(
        "sss",
        $nome,
        $telefone,
        $email
    );

    if ($stmt->execute()) {

        header("Location: listar.php");
        exit;

    } else {

        echo "Erro ao cadastrar cliente.";

    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastrar Cliente</title>

</head>

<body>

    <h1>Cadastro de Cliente</h1>

    <form method="POST">

        <label for="nome">Nome:</label>

        <br>

        <input
            type="text"
            id="nome"
            name="nome"
            required
        >

        <br><br>

        <label for="telefone">Telefone:</label>

        <br>

        <input
            type="text"
            id="telefone"
            name="telefone"
            required
        >

        <br><br>

        <label for="email">E-mail:</label>

        <br>

        <input
            type="email"
            id="email"
            name="email"
        >

        <br><br>

        <button type="submit">
            Cadastrar Cliente
        </button>

    </form>

    <br>

    <a href="listar.php">
        Voltar para clientes
    </a>

</body>

</html>