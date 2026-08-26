<?php

include("../conexao.php");

$sql = "SELECT * FROM clientes ORDER BY id_cliente DESC";

$resultado = $conexao->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Clientes</title>

</head>

<body>

    <h1>Clientes Cadastrados</h1>

    <a href="cadastrar.php">
        <button>Cadastrar Cliente</button>
    </a>

    <br><br>

    <table border="1" cellpadding="10">

        <tr>

            <th>ID</th>

            <th>Nome</th>

            <th>Telefone</th>

            <th>E-mail</th>

            <th>Ações</th>

        </tr>

        <?php while ($cliente = $resultado->fetch_assoc()) { ?>

            <tr>

                <td>
                    <?php echo $cliente["id_cliente"]; ?>
                </td>

                <td>
                    <?php echo $cliente["nome"]; ?>
                </td>

                <td>
                    <?php echo $cliente["telefone"]; ?>
                </td>

                <td>
                    <?php echo $cliente["email"]; ?>
                </td>

                <td>

                    <a href="editar.php?id=<?php echo $cliente["id_cliente"]; ?>">
                        Editar
                    </a>

                    |

                    <a
                        href="excluir.php?id=<?php echo $cliente["id_cliente"]; ?>"
                        onclick="return confirm('Tem certeza que deseja excluir este cliente?')"
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