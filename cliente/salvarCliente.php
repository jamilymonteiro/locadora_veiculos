<?php

include("../config/conexao.php");

$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];

$sql = "INSERT INTO cliente
(nome, cpf, telefone, email)

VALUES
('$nome', '$cpf',
'$telefone', '$email')";

mysqli_query($conexao, $sql);

header("Location: listarCliente.php");
?>