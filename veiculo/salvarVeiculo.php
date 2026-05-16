<?php

include("../config/conexao.php");

$modelo = $_POST['modelo'];
$ano = $_POST['ano_fabricacao'];
$placa = $_POST['placa'];
$valor = $_POST['valor_diaria'];

$id_marca = $_POST['id_marca'];
$id_categoria = $_POST['id_categoria'];

$sql = "
INSERT INTO veiculo
(
modelo,
ano_fabricacao,
placa,
status,
valor_diaria,
id_marca,
id_categoria
)

VALUES
(
'$modelo',
$ano,
'$placa',
true,
$valor,
$id_marca,
$id_categoria
)
";

mysqli_query($conexao, $sql);

header("Location: listarVeiculo.php");

?>