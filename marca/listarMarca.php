<?php

include("../config/conexao.php");

$resultado = mysqli_query($conexao,
"SELECT * FROM marca ORDER BY id DESC");

include("../includes/header.php");
include("../includes/menu.php");

?>

<div class="container">

    <div class="container-box">

        <div class="d-flex justify-content-between">

            <h2>Marcas</h2>

            <a href="cadastrarMarca.php"
            class="btn btn-success">

                Nova Marca

            </a>

        </div>

        <hr>

        <table class="table table-bordered">

            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>

            <?php
            while($marca =
            mysqli_fetch_assoc($resultado)){
            ?>

            <tr>

                <td>
                    <?= $marca['id'] ?>
                </td>

                <td>
                    <?= $marca['nome'] ?>
                </td>

                <td>

                    <a
                    href="editarMarca.php?id=<?= $marca['id'] ?>"
                    class="btn btn-warning btn-sm">
                        Editar
                    </a>

                    <a
                    href="excluirMarca.php?id=<?= $marca['id'] ?>"
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
