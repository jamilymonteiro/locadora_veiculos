<?php

include("../config/conexao.php");

$modelo = $_POST['modelo'];
$ano = $_POST['ano_fabricacao'];
$placa = $_POST['placa'];
$valor = $_POST['valor_diaria'];
$id_marca = $_POST['id_marca'];
$id_categoria = $_POST['id_categoria'];

if (isset($_POST['id']) && !empty($_POST['id'])) {
    $id = (int) $_POST['id'];
    $sql = "UPDATE veiculo
    SET modelo = '$modelo',
        ano_fabricacao = $ano,
        placa = '$placa',
        valor_diaria = $valor,
        id_marca = $id_marca,
        id_categoria = $id_categoria
    WHERE id = $id";

} else {
    $sql = "CALL sp_cadastrar_veiculo(
    '$modelo',
    $ano,
    '$placa',
    $valor,
    $id_marca,
    $id_categoria)";
}

mysqli_query($conexao, $sql);

header("Location: listarVeiculo.php");

?>