<?php

include("../config/conexao.php");

$sql = "

SELECT
contrato.*,

cliente.nome AS cliente,

veiculo.modelo AS veiculo,

aluguel.data_inicio,
aluguel.data_fim

FROM contrato

INNER JOIN aluguel
ON contrato.id_aluguel = aluguel.id

INNER JOIN cliente
ON aluguel.id_cliente = cliente.id

INNER JOIN veiculo
ON aluguel.id_veiculo = veiculo.id

ORDER BY contrato.id DESC
";

$resultado = mysqli_query($conexao, $sql);

include("../includes/header.php");
include("../includes/menu.php");

?>

<div class="container">

    <div class="container-box">

        <h2>Contratos</h2>

        <hr>

        <table class="table table-bordered">

            <tr>

                <th>ID</th>
                <th>Cliente</th>
                <th>Veículo</th>
                <th>Emissão</th>
                <th>Ações</th>

            </tr>

            <?php
            while($contrato =
            mysqli_fetch_assoc($resultado)){
            ?>

            <tr>

                <td>
                    <?= $contrato['id'] ?>
                </td>

                <td>
                    <?= $contrato['cliente'] ?>
                </td>

                <td>
                    <?= $contrato['veiculo'] ?>
                </td>

                <td>
                    <?= $contrato['data_emissao'] ?>
                </td>

                <td>

                    <a
                    href="visualizarContrato.php?id=<?= $contrato['id'] ?>"
                    class="btn btn-primary btn-sm">
                        Visualizar
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