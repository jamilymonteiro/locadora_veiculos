<?php

include("../config/conexao.php");

$resultado = mysqli_query($conexao,
"SELECT * FROM cliente
ORDER BY id DESC");

include("../includes/header.php");
include("../includes/menu.php");

?>

<div class="container">

    <div class="container-box">

        <div class="d-flex
        justify-content-between">

            <h2>Clientes</h2>

            <a href="cadastrarCliente.php"
            class="btn btn-success">

                Novo Cliente

            </a>

        </div>

        <hr>

        <table class="table table-bordered">

            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Telefone</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>

            <?php
            while($cliente =
            mysqli_fetch_assoc($resultado)){
            ?>

            <tr>

                <td>
                    <?= $cliente['id'] ?>
                </td>

                <td>
                    <?= $cliente['nome'] ?>
                </td>

                <td>
                    <?= $cliente['cpf'] ?>
                </td>

                <td>
                    <?= $cliente['telefone'] ?>
                </td>

                <td>
                    <?= $cliente['email'] ?>
                </td>

                <td>

                    <a
                    href="editarCliente.php?id=<?= $cliente['id'] ?>"
                    class="btn btn-warning btn-sm">

                        Editar

                    </a>

                    <a
                    href="excluirCliente.php?id=<?= $cliente['id'] ?>"
                    class="btn btn-danger btn-sm">

                        Excluir

                    </a>

                </td>

            </tr>

            <?php } ?>

        </table>

    </div>

</div>

<?php
include("../includes/footer.php");
?>