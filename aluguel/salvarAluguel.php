<?php

include("../config/conexao.php");

$id_cliente = $_POST['id_cliente'];
$id_veiculo = $_POST['id_veiculo'];
$data_inicio = $_POST['data_inicio'];
$data_fim = $_POST['data_fim'];
$pagamento_tipo = $_POST['pagamento_tipo'];

$sql = "CALL sp_realizar_aluguel(
'$data_inicio',
'$data_fim',
$id_cliente,
$id_veiculo,
'$pagamento_tipo'
)";

if(!mysqli_query($conexao, $sql)){

    die(mysqli_error($conexao));

}

header("Location: listarAluguel.php");

?>