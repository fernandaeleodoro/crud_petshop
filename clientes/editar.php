<?php

include("../conexao.php");

$id = $_GET["id"];

$sql = "SELECT * FROM clientes
        WHERE id_cliente = ?";

$stmt = $conexao->prepare($sql);

$stmt->bind_param("i", $id);

$stmt->execute();

$resultado = $stmt->get_result();

$cliente = $resultado->fetch_assoc();

if (!$cliente) {

    die("Cliente não encontrado.");

}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST["nome"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"];

    $sql = "UPDATE clientes

            SET nome = ?,
                telefone = ?,
                email = ?

            WHERE id_cliente = ?";

    $stmt = $conexao->prepare($sql);

    $stmt->bind_param(
        "sssi",
        $nome,
        $telefone,
        $email,
        $id
    );

    if ($stmt->execute()) {

        header("Location: listar.php");
        exit;

    } else {

        echo "Erro ao atualizar cliente.";

    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar Cliente</title>

</head>

<body>

    <h1>Editar Cliente</h1>

    <form method="POST">

        <label for="nome">Nome:</label>

        <br>

        <input
            type="text"
            id="nome"
            name="nome"
            value="<?php echo $cliente["nome"]; ?>"
            required
        >

        <br><br>

        <label for="telefone">Telefone:</label>

        <br>

        <input
            type="text"
            id="telefone"
            name="telefone"
            value="<?php echo $cliente["telefone"]; ?>"
            required
        >

        <br><br>

        <label for="email">E-mail:</label>

        <br>

        <input
            type="email"
            id="email"
            name="email"
            value="<?php echo $cliente["email"]; ?>"
        >

        <br><br>

        <button type="submit">
            Salvar Alterações
        </button>

    </form>

    <br>

    <a href="listar.php">
        Voltar
    </a>

</body>

</html>