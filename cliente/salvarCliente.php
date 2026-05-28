<?php

include("../config/conexao.php");

$id = $_POST['id'] ?? '';
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];

if(!empty($id)){
    $sql = "UPDATE cliente SET
    nome = '$nome',
    cpf = '$cpf',
    telefone = '$telefone',
    email = '$email'
    WHERE id = $id";

}else{
    $sql = "CALL sp_cadastrar_cliente(
    '$nome',
    '$cpf',
    '$telefone',
    '$email')";
    
}

mysqli_query($conexao, $sql);

header("Location: listarCliente.php");

?>