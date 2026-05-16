<?php
include("includes/header.php");
include("includes/menu.php");
include("config/conexao.php");
?>

<div class="container">

    <div class="container-box">

        <h2>Veículos Disponíveis</h2>

        <hr>

        <table class="table">

            <tr>
                <th>Modelo</th>
                <th>Placa</th>
                <th>Marca</th>
                <th>Categoria</th>
                <th>Valor Diária</th>
                <th>Status</th>
            </tr>

            <?php

            $sql = "

            SELECT
            veiculo.*,
            marca.nome AS marca,
            categoria.nome AS categoria

            FROM veiculo

            INNER JOIN marca
            ON veiculo.id_marca = marca.id

            INNER JOIN categoria
            ON veiculo.id_categoria = categoria.id

            WHERE veiculo.status = true

            ";

            $resultado = mysqli_query($conexao, $sql);

            while($dados = mysqli_fetch_assoc($resultado)){
            ?>

            <tr>
                <td><?= $dados['modelo'] ?></td>
                <td><?= $dados['placa'] ?></td>
                <td><?= $dados['marca'] ?></td>
                <td><?= $dados['categoria'] ?></td>
                <td>R$ <?= $dados['valor_diaria'] ?></td>
                <td>

                    <?php
                    if($dados['status'] == 1){
                        echo "Disponível";
                    }else{
                        echo "Indisponível";
                    }
                ?>

                </td>
            </tr>

            <?php } ?>

        </table>

    </div>

</div>

<?php
include("includes/footer.php");
?>