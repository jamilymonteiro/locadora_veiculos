<?php

/* include("../config/conexao.php");

$id_aluguel = $_GET['id'];
$id_veiculo = $_GET['veiculo'];

mysqli_query($conexao,

"UPDATE aluguel
SET status = 'INATIVO'
WHERE id = $id_aluguel");

mysqli_query($conexao,

"UPDATE veiculo
SET status = true
WHERE id = $id_veiculo");

header("Location: listarAluguel.php");
*/

include("../config/conexao.php");

$id_aluguel = $_GET['id'];
$id_veiculo = $_GET['veiculo'];

mysqli_query(
$conexao,
"CALL sp_encerrar_aluguel($id_aluguel, $id_veiculo)"
);

header("Location: listarAluguel.php");

?>