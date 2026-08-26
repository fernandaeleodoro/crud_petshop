<?php

include("../conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST["nome"];
    $especie = $_POST["especie"];
    $raca = $_POST["raca"];
    $idade = $_POST["idade"];
    $id_cliente = $_POST["id_cliente"];

    $sql = "INSERT INTO animais
            (nome, especie, raca, idade, id_cliente)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $conexao->prepare($sql);

    $stmt->bind_param(
        "sssii",
        $nome,
        $especie,
        $raca,
        $idade,
        $id_cliente
    );

    if ($stmt->execute()) {

        header("Location: listar.php");
        exit;

    } else {

        echo "Erro ao cadastrar animal.";

    }
}

$clientes = $conexao->query(
    "SELECT * FROM clientes ORDER BY nome"
);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastrar Animal</title>

</head>

<body>

    <h1>Cadastro de Animal</h1>

    <form method="POST">

        <label for="nome">Nome do animal:</label>

        <br>

        <input
            type="text"
            id="nome"
            name="nome"
            required
        >

        <br><br>

        <label for="especie">Espécie:</label>

        <br>

        <select
            id="especie"
            name="especie"
            required
        >

            <option value="">
                Selecione
            </option>

            <option value="Cachorro">
                Cachorro
            </option>

            <option value="Gato">
                Gato
            </option>

            <option value="Pássaro">
                Pássaro
            </option>

            <option value="Outro">
                Outro
            </option>

        </select>

        <br><br>

        <label for="raca">Raça:</label>

        <br>

        <input
            type="text"
            id="raca"
            name="raca"
        >

        <br><br>

        <label for="idade">Idade:</label>

        <br>

        <input
            type="number"
            id="idade"
            name="idade"
            min="0"
        >

        <br><br>

        <label for="id_cliente">
            Dono do animal:
        </label>

        <br>

        <select
            id="id_cliente"
            name="id_cliente"
            required
        >

            <option value="">
                Selecione o cliente
            </option>

            <?php while ($cliente = $clientes->fetch_assoc()) { ?>

                <option
                    value="<?php echo $cliente["id_cliente"]; ?>"
                >

                    <?php echo $cliente["nome"]; ?>

                </option>

            <?php } ?>

        </select>

        <br><br>

        <button type="submit">
            Cadastrar Animal
        </button>

    </form>

    <br>

    <a href="listar.php">
        Voltar para animais
    </a>

</body>

</html>