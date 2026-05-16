<?php

include("../config/conexao.php");

$nome = $_POST['nome'];

$sql = "INSERT INTO marca(nome)
VALUES('$nome')";

mysqli_query($conexao, $sql);

header("Location: listarMarca.php");
?>