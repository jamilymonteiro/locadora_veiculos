<?php

include("../config/conexao.php");

$id = $_GET['id'];

$sql = "

SELECT
contrato.*,

cliente.nome AS cliente,
cliente.cpf,

veiculo.modelo,
veiculo.placa,

aluguel.data_inicio,
aluguel.data_fim,
pagamento.pagamento_tipo

FROM contrato

INNER JOIN aluguel
ON contrato.id_aluguel = aluguel.id

INNER JOIN cliente
ON aluguel.id_cliente = cliente.id

INNER JOIN veiculo
ON aluguel.id_veiculo = veiculo.id

INNER JOIN pagamento
ON aluguel.id_pagamento = pagamento.id

WHERE contrato.id = $id

";

$resultado = mysqli_query($conexao, $sql);

$contrato = mysqli_fetch_assoc($resultado);

include("../includes/header.php");
include("../includes/menu.php");

?>

<div class="container">

    <div class="container-box">

        <h2>
            Contrato de Locação
        </h2>

        <hr>

        <p>
            <strong>Cliente:</strong>
            <?= $contrato['cliente'] ?>
        </p>

        <p>
            <strong>CPF:</strong>
            <?= $contrato['cpf'] ?>
        </p>

        <p>
            <strong>Veículo:</strong>
            <?= $contrato['modelo'] ?>
        </p>

        <p>
            <strong>Placa:</strong>
            <?= $contrato['placa'] ?>
        </p>

        <p>
            <strong>Data início:</strong>
            <?= $contrato['data_inicio'] ?>
        </p>

        <p>
            <strong>Data fim:</strong>
            <?= $contrato['data_fim'] ?>
        </p>

        <p>
            <strong>Forma de pagamento:</strong>
            <?= $contrato['pagamento_tipo'] ?>
        </p>

        <hr>
        <h4>Termos</h4>
        <p>
            <?= $contrato['termos'] ?>
        </p>

        <hr>
        <button
        type="button"
        class="btn btn-secondary"
        onclick="history.back()">
            Voltar
        </button>

    </div>

</div>

<?php
include("../includes/footer.php");
?>