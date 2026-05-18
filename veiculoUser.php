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
                <th>Ano</th>
                <th>Placa</th>
                <th>Marca</th>
                <th>Categoria</th>
                <th>Valor Diária</th>
            </tr>

            <?php

            $sql = "SELECT * FROM vw_veiculos_disponiveis";

            $resultado = mysqli_query($conexao, $sql);

            while($dados = mysqli_fetch_assoc($resultado)){
            ?>

            <tr>
                <td><?= $dados['modelo'] ?></td>
                <td><?= $dados['ano_fabricacao'] ?></td>
                <td><?= $dados['placa'] ?></td>
                <td><?= $dados['marca'] ?></td>
                <td><?= $dados['categoria'] ?></td>
                <td>R$ <?= $dados['valor_diaria'] ?></td>
            </tr>

            <?php } ?>

        </table>

    </div>

</div>

<?php
include("includes/footer.php");
?>