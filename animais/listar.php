<?php

include("../conexao.php");

$sql = "SELECT
            animais.id_animal,
            animais.nome,
            animais.especie,
            animais.raca,
            animais.idade,
            clientes.nome AS dono

        FROM animais

        INNER JOIN clientes
        ON animais.id_cliente = clientes.id_cliente

        ORDER BY animais.id_animal DESC";

$resultado = $conexao->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Animais</title>

</head>

<body>

    <h1>Animais Cadastrados</h1>

    <a href="cadastrar.php">
        <button>Cadastrar Animal</button>
    </a>

    <br><br>

    <table border="1" cellpadding="10">

        <tr>

            <th>ID</th>

            <th>Nome</th>

            <th>Espécie</th>

            <th>Raça</th>

            <th>Idade</th>

            <th>Dono</th>

            <th>Ações</th>

        </tr>

        <?php while ($animal = $resultado->fetch_assoc()) { ?>

            <tr>

                <td>
                    <?php echo $animal["id_animal"]; ?>
                </td>

                <td>
                    <?php echo $animal["nome"]; ?>
                </td>

                <td>
                    <?php echo $animal["especie"]; ?>
                </td>

                <td>
                    <?php echo $animal["raca"]; ?>
                </td>

                <td>
                    <?php echo $animal["idade"]; ?>
                </td>

                <td>
                    <?php echo $animal["dono"]; ?>
                </td>

                <td>

                    <a
                        href="editar.php?id=<?php echo $animal["id_animal"]; ?>"
                    >
                        Editar
                    </a>

                    |

                    <a
                        href="excluir.php?id=<?php echo $animal["id_animal"]; ?>"
                        onclick="return confirm('Tem certeza que deseja excluir este animal?')"
                    >
                        Excluir
                    </a>

                </td>

            </tr>

        <?php } ?>

    </table>

    <br>

    <a href="../index.php">
        Voltar para o início
    </a>

</body>

</html>