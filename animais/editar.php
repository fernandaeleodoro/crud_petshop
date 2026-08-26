<?php

include("../conexao.php");

$id = $_GET["id"];

$sql = "SELECT * FROM animais
        WHERE id_animal = ?";

$stmt = $conexao->prepare($sql);

$stmt->bind_param("i", $id);

$stmt->execute();

$resultado = $stmt->get_result();

$animal = $resultado->fetch_assoc();

if (!$animal) {

    die("Animal não encontrado.");

}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST["nome"];
    $especie = $_POST["especie"];
    $raca = $_POST["raca"];
    $idade = $_POST["idade"];
    $id_cliente = $_POST["id_cliente"];

    $sql = "UPDATE animais

            SET nome = ?,
                especie = ?,
                raca = ?,
                idade = ?,
                id_cliente = ?

            WHERE id_animal = ?";

    $stmt = $conexao->prepare($sql);

    $stmt->bind_param(
        "sssiii",
        $nome,
        $especie,
        $raca,
        $idade,
        $id_cliente,
        $id
    );

    if ($stmt->execute()) {

        header("Location: listar.php");
        exit;

    } else {

        echo "Erro ao atualizar animal.";

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

    <title>Editar Animal</title>

</head>

<body>

    <h1>Editar Animal</h1>

    <form method="POST">

        <label for="nome">
            Nome do animal:
        </label>

        <br>

        <input
            type="text"
            id="nome"
            name="nome"
            value="<?php echo $animal["nome"]; ?>"
            required
        >

        <br><br>

        <label for="especie">
            Espécie:
        </label>

        <br>

        <select
            id="especie"
            name="especie"
            required
        >

            <option
                value="Cachorro"
                <?php
                if ($animal["especie"] == "Cachorro") {
                    echo "selected";
                }
                ?>
            >
                Cachorro
            </option>

            <option
                value="Gato"
                <?php
                if ($animal["especie"] == "Gato") {
                    echo "selected";
                }
                ?>
            >
                Gato
            </option>

            <option
                value="Pássaro"
                <?php
                if ($animal["especie"] == "Pássaro") {
                    echo "selected";
                }
                ?>
            >
                Pássaro
            </option>

            <option
                value="Outro"
                <?php
                if ($animal["especie"] == "Outro") {
                    echo "selected";
                }
                ?>
            >
                Outro
            </option>

        </select>

        <br><br>

        <label for="raca">
            Raça:
        </label>

        <br>

        <input
            type="text"
            id="raca"
            name="raca"
            value="<?php echo $animal["raca"]; ?>"
        >

        <br><br>

        <label for="idade">
            Idade:
        </label>

        <br>

        <input
            type="number"
            id="idade"
            name="idade"
            value="<?php echo $animal["idade"]; ?>"
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

            <?php while ($cliente = $clientes->fetch_assoc()) { ?>

                <option
                    value="<?php echo $cliente["id_cliente"]; ?>"

                    <?php

                    if (
                        $cliente["id_cliente"]
                        ==
                        $animal["id_cliente"]
                    ) {
                        echo "selected";
                    }

                    ?>

                >

                    <?php echo $cliente["nome"]; ?>

                </option>

            <?php } ?>

        </select>

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