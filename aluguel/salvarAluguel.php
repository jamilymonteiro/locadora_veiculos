<?php

include("../config/conexao.php");

$id_cliente = $_POST['id_cliente'];
$id_veiculo = $_POST['id_veiculo'];

$data_inicio = $_POST['data_inicio'];
$data_fim = $_POST['data_fim'];

$pagamento_tipo = $_POST['pagamento_tipo'];

$valor = 500;

mysqli_query($conexao,

"INSERT INTO pagamento
(valor, data, pagamento_tipo)

VALUES
(
$valor,
CURDATE(),
'$pagamento_tipo'
)");

$id_pagamento =
mysqli_insert_id($conexao);

mysqli_query($conexao,

"INSERT INTO aluguel
(
data_inicio,
data_fim,
status,
id_pagamento,
id_cliente,
id_veiculo
)

VALUES
(
'$data_inicio',
'$data_fim',
'ATIVO',
$id_pagamento,
$id_cliente,
$id_veiculo
)");

$id_aluguel =
mysqli_insert_id($conexao);

mysqli_query($conexao,

"INSERT INTO contrato
(
data_emissao,
termos,
id_aluguel
)

VALUES
(
CURDATE(),
'Contrato de locação gerado automaticamente.',
$id_aluguel
)");

mysqli_query($conexao,

"UPDATE veiculo
SET status = false
WHERE id = $id_veiculo");

header("Location: listarAluguel.php");
?>