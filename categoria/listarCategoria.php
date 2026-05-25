<?php

include("../config/conexao.php");

$resultado = mysqli_query($conexao,
"SELECT * FROM categoria");

include("../includes/header.php");
include("../includes/menu.php");

?>

<div class="container">

    <div class="container-box">

        <div class="d-flex justify-content-between">

            <h2>Categorias</h2>

            <a href="cadastrarCategoria.php"
            class="btn btn-success">

                Nova Categoria

            </a>

        </div>

        <hr>

        <table class="table table-bordered">

            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>

            <?php
            while($categoria =
            mysqli_fetch_assoc($resultado)){
            ?>

            <tr>

                <td>
                    <?= $categoria['id'] ?>
                </td>

                <td>
                    <?= $categoria['nome'] ?>
                </td>

                <td>
                    <?= $categoria['descricao'] ?>
                </td>

                <td>

                    <a
                    href="editarCategoria.php?id=<?= $categoria['id'] ?>"
                    class="btn btn-warning btn-sm">

                        Editar

                    </a>

                    <a
                    href="excluirCategoria.php?id=<?= $categoria['id'] ?>"
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