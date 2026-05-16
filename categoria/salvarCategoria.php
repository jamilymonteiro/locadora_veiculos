<?php

include("../config/conexao.php");

$nome = $_POST['nome'];
$descricao = $_POST['descricao'];

$sql = "INSERT INTO categoria
(nome, descricao)

VALUES
('$nome', '$descricao')";

mysqli_query($conexao, $sql);

header("Location: listarCategoria.php");

?>