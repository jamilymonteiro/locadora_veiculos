<?php

include("../config/conexao.php");

$sql = "SELECT * FROM vw_veiculos_disponiveis";

$resultado = mysqli_query($conexao, $sql);

include("../includes/header.php");
include("../includes/menu.php");

?>

<div class="container">

    <div class="container-box">

        <div class="d-flex justify-content-between">
            <h2>Veículos Disponíveis</h2>

            <a
            href="listarVeiculo.php"
            class="btn btn-secondary">
                Voltar
            </a>

        </div>

        <hr>

        <table class="table table-bordered">

            <tr>
                <th>ID</th>
                <th>Modelo</th>
                <th>Ano</th>
                <th>Placa</th>
                <th>Marca</th>
                <th>Categoria</th>
                <th>Diária</th>
            </tr>

            <?php
            while($veiculo =
            mysqli_fetch_assoc($resultado)){
            ?>

            <tr>
                <td><?= $veiculo['id'] ?></td>
                <td><?= $veiculo['modelo'] ?></td>
                <td><?= $veiculo['ano_fabricacao'] ?></td>
                <td><?= $veiculo['placa'] ?></td>
                <td><?= $veiculo['marca'] ?></td>
                <td><?= $veiculo['categoria'] ?></td>
                <td>
                    R$ <?= $veiculo['valor_diaria'] ?>
                </td>

            </tr>

            <?php } ?>

        </table>

    </div>

</div>

<?php
include("../includes/footer.php");
?>