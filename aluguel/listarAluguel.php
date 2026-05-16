<?php

include("../config/conexao.php");

$sql = "

SELECT
aluguel.*,
cliente.nome AS cliente,
veiculo.modelo AS veiculo

FROM aluguel

INNER JOIN cliente
ON aluguel.id_cliente = cliente.id

INNER JOIN veiculo
ON aluguel.id_veiculo = veiculo.id

";

$resultado = mysqli_query($conexao, $sql);

include("../includes/header.php");
include("../includes/menuAdmin.php");

?>

<div class="container">

    <div class="container-box">

        <div class="d-flex justify-content-between">

            <h2>Aluguéis</h2>

            <a href="cadastrarAluguel.php"
            class="btn btn-success">

                Novo Aluguel

            </a>

        </div>

        <hr>

        <table class="table table-bordered">

            <tr>

                <th>ID</th>
                <th>Cliente</th>
                <th>Veículo</th>
                <th>Início</th>
                <th>Fim</th>
                <th>Status</th>
                <th>Ações</th>

            </tr>

            <?php
            while($aluguel =
            mysqli_fetch_assoc($resultado)){
            ?>

            <tr>

                <td>
                    <?= $aluguel['id'] ?>
                </td>

                <td>
                    <?= $aluguel['cliente'] ?>
                </td>

                <td>
                    <?= $aluguel['veiculo'] ?>
                </td>

                <td>
                    <?= $aluguel['data_inicio'] ?>
                </td>

                <td>
                    <?= $aluguel['data_fim'] ?>
                </td>

                <td>
                    <?= $aluguel['status'] ?>
                </td>
                <td>
                    <?php
                    if($aluguel['status'] == 'ATIVO'){
                    ?>

                    <a
                    href="finalizarAluguel.php?id=<?= $aluguel['id'] ?>&veiculo=<?= $aluguel['id_veiculo'] ?>"
                    class="btn btn-danger btn-sm">

                        Finalizar

                    </a>

                    <?php } ?>

                </td>

            </tr>

            <?php } ?>

        </table>

    </div>

</div>

<?php
include("../includes/footer.php");
?>