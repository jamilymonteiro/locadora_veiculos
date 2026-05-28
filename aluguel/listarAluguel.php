<?php

include("../config/conexao.php");

$sql = "SELECT * FROM vw_listaralugueis";

$resultado = mysqli_query($conexao, $sql);

include("../includes/header.php");
include("../includes/menu.php");

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
                <th>Valor Diária</th>
                <th>Dias</th>
                <th>Total</th>
                <th>Multa</th>
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
                    R$ <?= number_format($aluguel['valor_diaria'], 2, ',', '.') ?>
                </td>

                <td>
                    <?= $aluguel['dias'] ?>
                </td>

                <td>
                    R$ <?= number_format($aluguel['total'], 2, ',', '.') ?>
                </td>

                <td>
                    <?php
                    if($aluguel['multa'] > 0){?>
                        R$
                        <?= number_format($aluguel['multa'], 2, ',', '.') ?>
                    <?php }else{ ?>
                        Sem multa
                    <?php } ?>
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