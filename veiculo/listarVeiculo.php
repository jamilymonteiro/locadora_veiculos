<?php

include("../config/conexao.php");

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

ORDER BY veiculo.id DESC
";

$resultado = mysqli_query($conexao, $sql);

include("../includes/header.php");
include("../includes/menu.php");

?>

<div class="container">

    <div class="container-box">

        <div class="d-flex justify-content-between">

            <h2>Veículos</h2>

            <a href="veiculosDisponiveis.php"
            class="btn btn-primary">
                Veículos Disponíveis
            </a>

            <a href="cadastrarVeiculo.php"
            class="btn btn-success">
                Novo Veículo
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
                <th>Status</th>
                <th>Ações</th>

            </tr>

            <?php
            while($veiculo =
            mysqli_fetch_assoc($resultado)){
            ?>

            <tr>

                <td>
                    <?= $veiculo['id'] ?>
                </td>

                <td>
                    <?= $veiculo['modelo'] ?>
                </td>

                <td>
                    <?= $veiculo['ano_fabricacao'] ?>
                </td>

                <td>
                    <?= $veiculo['placa'] ?>
                </td>

                <td>
                    <?= $veiculo['marca'] ?>
                </td>

                <td>
                    <?= $veiculo['categoria'] ?>
                </td>

                <td>
                    R$ <?= $veiculo['valor_diaria'] ?>
                </td>

                <td>

                    <?php
                    if($veiculo['status']){
                        echo "Disponível";
                    }else{
                        echo "Indisponível";
                    }
                    ?>

                </td>

                <td>

                    <a
                    href="editarVeiculo.php?id=<?= $veiculo['id'] ?>"
                    class="btn btn-warning btn-sm">
                        Editar
                    </a>

                    <a
                    href="excluirVeiculo.php?id=<?= $veiculo['id'] ?>"
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